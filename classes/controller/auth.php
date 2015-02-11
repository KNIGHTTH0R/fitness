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
			if ($result
                    && isset($result[0])
					&& password_verify($_POST['password'], $result[0]['dtpassword'])) {
				$_SESSION['auth']['user'] = $result[0]['iduser'];
                $_SESSION['auth']['type'] = $result[0]['dttype'];
				$this->redirect();
			}
		}

		return $this->View->fetch('login/form.tpl');
	}

    public function logout() {
		unset($_SESSION['auth']);
		$this->redirect();
	}

}
