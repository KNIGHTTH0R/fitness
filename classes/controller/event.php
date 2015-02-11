<?php

namespace Controller;
class Event extends \Controller {

    public function index() {
        $this->redirect('event/listing');
    }

	public function listing() {
        $isAuth = $this->isAuth();
        $user = $isAuth? $isAuth['user'] : NULL;

        $result = $this->DB->execute('
            SELECT idevent, dtname, dtdescription, dtdate, dtduration, COUNT(fiuser) AS dtsubscribed
            FROM tblfitness_event
            LEFT JOIN tblfitness_user2event
               ON idevent = fievent
              AND fiuser = :user
            WHERE dtdate >= NOW()
            GROUP BY idevent
            ORDER BY dtdate ASC
        ', array(
            'user' => $user
        ));
        $events = $result->fetchAll();

        //do some formatting
        foreach ($events as &$event) {
            $time = strtotime($event['dtdate']);
            $event['day']   = strftime('%A', $time);
            $event['date']  = date('d/m/Y', $time);
            $event['from']  = date('H:i', $time);
            $event['to']    = date('H:i', $time + ($event['dtduration'] * 60));
            $event['duration'] = round($event['dtduration'] / 60, 1);
        }

        $this->View->assign(array(
            'events' => $events
        ));
        return $this->View->fetch('event/list.tpl');
	}

    public function subscribe($idevent) {
        $isAuth = $this->isAuth();
        if (!$isAuth)
            $this->redirect('auth/login');

        try {
            $this->DB->execute('
                INSERT
                INTO tblfitness_user2event
                  (fiuser, fievent)
                VALUES
                  (:user, :event)
            ', array(
                'user' => $isAuth['user'],
                'event' => $idevent
            ));
        } catch (\Exception $e) {}

        $this->redirect('event');
    }

    public function unsubscribe($idevent) {
        $isAuth = $this->isAuth();
        if (!$isAuth)
            $this->redirect('auth/login');

        try {
            $this->DB->execute('
                DELETE
                FROM tblfitness_user2event
                WHERE fiuser = :user
                  AND fievent = :event
            ', array(
                'user' => $isAuth['user'],
                'event' => $idevent
            ));
        } catch (\Exception $e) {}

        $this->redirect('event');
    }

}
