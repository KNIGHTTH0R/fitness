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
            INNER JOIN tblfitness_event_type
               ON idevent_type = fievent_type
            LEFT JOIN tblfitness_user2event
               ON idevent = fievent
              AND fiuser = :user
            WHERE dtdate >= NOW()
              AND dtarchive = 0
              AND dtvisible = 1
            GROUP BY idevent
            ORDER BY dtdate ASC
        ', array(
            'user' => $user
        ));
        $events = $result->fetchAll();

        //group by week & do some formatting
        $weeks = array();
        while ($event = array_shift($events)) {
            $time = strtotime($event['dtdate']);

            $date = strftime('%A', $time).' - '.date('d/m/Y', $time);
            $event['from']  = date('H:i', $time);
            $event['to']    = date('H:i', $time + ($event['dtduration'] * 60));
            $event['duration'] = round($event['dtduration'] / 60, 1);

            $week_number = date('W', $time);
            if (!isset($weeks[$week_number])) {
                $weekday = date('w', $time);
                $monday = $time - (($weekday-1) * 60 * 60 * 24);
                $sunday = $monday + (6 * 60 * 60 * 24);
                $weeks[$week_number]['label'] = date('d/m/Y', $monday).' - '.date('d/m/Y', $sunday);
            }

            $weeks[$week_number]['events'][$date][] = $event;
        }

        $this->View->assign(array(
            'weeks' => $weeks
        ));
        return $this->View->fetch('event/list.tpl');
	}

    public function subscribe($idevent) {
        $isAuth = $this->forceAuth();

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
        $isAuth = $this->forceAuth();

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
