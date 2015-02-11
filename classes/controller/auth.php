<?php

namespace Controller;
class Auth extends \Controller {

	public function login() {
		if (!empty($_POST['username']) && !empty($_POST['password'])) {
			$result = $this->DB->execute('
				SELECT iduser, dtpassword
				FROM tblfitness_user
				WHERE iduser = :username
				   OR dtemail = :username
				LIMIT 1
			', array(
				'username' => $_POST['username']
			));
            $result = $result->fetchAll();
			if ($result
                    && isset($result[0])
					&& password_verify($_POST['password'], $result[0]['dtpassword'])) {
				$_SESSION['auth']['user'] = $result[0]['iduser'];
                $_SESSION['auth']['type'] = $result[0]['dttype'];
				$this->redirect();
			}
		}

		return $this->View->fetch('auth/login/form.tpl');
	}

    public function logout() {
		unset($_SESSION['auth']);
		$this->redirect();
	}

    public function register() {
        if (isset($_POST['lastName'])) {
            if (empty($_POST['lastName'])
                || empty($_POST['firstName'])
                || empty($_POST['eMail'])
                || empty($_POST['password'])
                || empty($_POST['password2'])) {

                echo 'Fill in all fields';

            } elseif ($_POST['password'] != $_POST['password2']) {

                echo 'Passwords do not match';

            } else {

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
                            echo 'User already exists';
                            break;

                        default:
                            echo 'Error while saving';
                            break;
                    }

                }

            }
        }

        return $this->View->fetch('auth/register/form.tpl');
    }

}
