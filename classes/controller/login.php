<?php

namespace Controller;
class Login extends \Controller {

	public function index() {
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
			if ($result && isset($result[0])
					&& password_verify($_POST['password'], $result[0]['dtpassword'])) {
				$_SESSION['iduser'] = $iduser;
				header('Location: http://'.$_SERVER['HTTP_HOST'].\Config::BASEURL.'admin');
				return;
			}
		}

		return $this->View->fetch('login/form.tpl');
	}

}

?>
