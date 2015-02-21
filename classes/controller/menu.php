<?php

namespace Controller;
class Menu extends \Controller {

	public function index() {
        $isAuth = $this->isAuth();
        $menu = array();

        $menu['left'][] = array('link', \Config::BASEURL.'event', 'Classes');

        if ($isAuth) {
            $menu['right'][] = array('text', 'Signed in as '.$isAuth['name']);
            $menu['right'][] = array('link', \Config::BASEURL.'auth/logout', 'Logout');
        } else {
            $menu['right'][] = array('link', \Config::BASEURL.'auth/login', 'Login');
        }

        $this->View->assign(array(
            'menu' => $menu
        ));
        return $this->View->fetch('menu.tpl');
    }

}
