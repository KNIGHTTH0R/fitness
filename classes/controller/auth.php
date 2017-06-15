<?php

namespace Controller;
class Auth extends \Controller {

	public function login() {
		$this->handleLoginPost();
		$this->handleRegisterPost();

		return $this->View->fetch('auth/login.tpl');
	}

    public function logout() {
		unset($_SESSION['auth']);
		$this->redirect();
	}

	public function handleLoginPost() {
		if (!isset($_POST['login']))
		 	return;

		if (empty($_POST['login']['username'])
				|| empty($_POST['login']['password'])) {
			\Message::add('Invalid login');
			return;
		}

		$result = $this->DB->execute('
			SELECT iduser, dtpassword, dtfirst_name, dtlast_name, dttype, dtenabled
			FROM tblfitness_user
			WHERE iduser = :username
			   OR dtemail = :username
			LIMIT 1
		', array(
			'username' => $_POST['login']['username']
		));
        $result = $result->fetchAll();

		if (!$result || !isset($result[0])) {
			\Message::add('Invalid login');
			return;
		}

		if (preg_match('/^md5:(.*)$/', $result[0]['dtpassword'], $matches)) {
			// old md5 passwords
			if (md5($_POST['login']['password']) != $matches[1]) {
				\Message::add('Invalid login');
				return;
			}
			// update to new system
			$this->DB->execute('
				UPDATE tblfitness_user
				SET dtpassword = :password
				WHERE iduser = :user
			', array(
				'password' => password_hash($_POST['login']['password'], PASSWORD_DEFAULT),
				'user' => $result[0]['iduser']
			));
		} else {
			if (!password_verify($_POST['login']['password'], $result[0]['dtpassword'])) {
				\Message::add('Invalid login');
				return;
			}
		}

		$_SESSION['auth']['user'] = $result[0]['iduser'];
        $_SESSION['auth']['type'] = $result[0]['dttype'];
		$_SESSION['auth']['name'] = $result[0]['dtfirst_name'].' '.$result[0]['dtlast_name'];
		$_SESSION['auth']['enabled'] = !!$result[0]['dtenabled'];

		if (isset($_SESSION['request'])) {
			$url = $_SESSION['request'];
			unset($_SESSION['request']);
		} else {
			$url = null;
		}
		$this->redirect($url);
	}

	public function handleRegisterPost() {
		if (!isset($_POST['register']))
		 	return;

        if (empty($_POST['register']['lastName'])
	            || empty($_POST['register']['firstName'])
	            || empty($_POST['register']['eMail'])
				|| empty($_POST['register']['tel'])
				|| empty($_POST['register']['street'])
				|| empty($_POST['register']['city'])
				|| empty($_POST['register']['zip'])
				|| empty($_POST['register']['country'])
	            || empty($_POST['register']['password'])
	            || empty($_POST['register']['password2'])) {
			\Message::add('Fill in all fields marked with an *');
			return;
		}

		if (!filter_var($_POST['register']['eMail'], FILTER_VALIDATE_EMAIL)) {
            \Message::add('Invalid email format');
            return;
        }

        if ($_POST['register']['password'] != $_POST['register']['password2']) {
			\Message::add('The passwords do not match');
			return;
		}

		if (strlen($_POST['register']['password']) < 6) {
			\Message::add('The password is to short. Minimum length is 6');
			return;
		}

		if (!empty($_POST['register']['birthdate']) && !preg_match('/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/', $_POST['register']['birthdate'])) {
            \Message::add('Invalid birthdate format');
            return;
        }

		$birthdate = $_POST['register']['birthdate']? implode('-', array_reverse(explode('/', $_POST['register']['birthdate']))) : NULL;

        try {

            $result = $this->DB->execute('
				INSERT
				INTO tblfitness_user
                  (dtlast_name, dtfirst_name, dtpassword, dtemail, dttel, dtbirthdate, dtstreet, dtcity, dtzip, dtcountry, dtenabled)
                VALUES
                  (:last_name, :first_name, :password, :email, :tel, :birthdate, :street, :city, :zip, :country, :enabled)
			', array(
				'last_name'  => $_POST['register']['lastName'],
                'first_name' => $_POST['register']['firstName'],
                'password'   => password_hash($_POST['register']['password'], PASSWORD_DEFAULT),
                'email'      => $_POST['register']['eMail'],
				'tel'      	 => $_POST['register']['tel'],
				'birthdate'  => $birthdate,
				'street'     => $_POST['register']['street'],
				'city'       => $_POST['register']['city'],
				'zip'      	 => $_POST['register']['zip'],
				'country'    => $_POST['register']['country'],
				'enabled'    => 1
			));

			\Message::add('Registration successful. You can now login', 'success');

			\Mail::get('admin:user:registration')
				->setValues($_POST['register'])
				->send(\Config::MAIL_ADMIN);

            $this->redirect('auth/login');

        } catch (\Exception $e) {
			throw $e;
            switch ($e->getCode()) {

                case '23000':
                    \Message::add('User already exists');
                    break;

                default:
                    \Message::add('Error while saving');
                    break;
            }

        }

	}

}
