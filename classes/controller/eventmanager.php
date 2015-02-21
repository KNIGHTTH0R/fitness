<?php

namespace Controller;
class Eventmanager extends Backend {

    public function index() {
        $this->redirect('eventmanager/listing');
    }

	public function listing() {
        $isAuth = $this->isAuth();
        $user = $isAuth? $isAuth['user'] : NULL;

        $result = $this->DB->execute('
            SELECT idevent, dtname, dtdescription, dtdate, dtduration, COUNT(fiuser) AS dtusercount
            FROM tblfitness_event
            INNER JOIN tblfitness_event_type
               ON idevent_type = fievent_type
            LEFT JOIN tblfitness_user2event
               ON idevent = fievent
            GROUP BY idevent
            ORDER BY dtdate ASC
        ');
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
        return $this->View->fetch('eventmanager/list.tpl');
	}

    public function copyToNextWeek($idevent) {
        $this->DB->execute('
            INSERT INTO tblfitness_event
               (fievent_type, dtdate, dtduration)
            SELECT fievent_type, DATE_ADD(dtdate, INTERVAL 7 DAY), dtduration
            FROM tblfitness_event
            WHERE idevent = :event
        ', array(
            'event' => $idevent
        ));
        $this->redirect('eventmanager');
    }

}
