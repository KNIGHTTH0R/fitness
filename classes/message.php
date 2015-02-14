<?php

class Message {

	public static function add($message, $type = 'danger') {
		$_SESSION['message'][] = array(
			'message' => $message,
			'type' => $type
		);
	}

    public static function render() {
        if (!isset($_SESSION['message']))
            return false;

        $view = \View::getInstance();
        $messages = array();
        foreach ($_SESSION['message'] as $message) {
            $view->assign(array(
                'message' => $message['message'],
                'type' => $message['type']
            ));
            $messages[] = $view->fetch('message.tpl');
        }
        unset($_SESSION['message']);
        return implode("\n", $messages);
    }

}
