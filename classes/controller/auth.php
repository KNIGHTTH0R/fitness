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
			SELECT iduser, dtpassword, dtfirst_name, dtlast_name
			FROM tblfitness_user
			WHERE iduser = :username
			   OR dtemail = :username
			LIMIT 1
		', array(
			'username' => $_POST['login']['username']
		));
        $result = $result->fetchAll();
		if (!$result
                || !isset($result[0])
				|| !password_verify($_POST['login']['password'], $result[0]['dtpassword'])) {
			\Message::add('Invalid login');
			return;
		}

		$_SESSION['auth']['user'] = $result[0]['iduser'];
        $_SESSION['auth']['type'] = $result[0]['dttype'];
		$_SESSION['auth']['name'] = $result[0]['dtfirst_name'].' '.$result[0]['dtlast_name'];

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
	            || empty($_POST['register']['password'])
	            || empty($_POST['register']['password2'])) {
			\Message::add('Fill in all fields');
			return;
		}

        if ($_POST['password'] != $_POST['password2']) {
			\Message::add('Passwords do not match');
			return;
		}


        try {

            $result = $this->DB->execute('
				INSERT
				INTO tblfitness_user
                  (dtlast_name, dtfirst_name, dtpassword, dtemail)
                VALUES
                  (:last_name, :first_name, :password, :email)
			', array(
				'last_name'  => $_POST['lastName'],
                'first_name' => $_POST['firstName'],
                'password'   => password_hash($_POST['password'], PASSWORD_DEFAULT),
                'email'      => $_POST['eMail']
			));

            $this->redirect('auth/login');

        } catch (\Exception $e) {

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
