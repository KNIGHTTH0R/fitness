<?php

namespace Controller;
class Event extends \Controller {

    public function index() {
        $this->redirect('event/listing');
    }

	public function listing() {

        $result = $this->DB->execute('
            SELECT idevent, dtname, dtdescription, dtdate, dtduration
            FROM tblfitness_event
            WHERE dtdate >= NOW()
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
        return $this->View->fetch('event/list.tpl');

	}

}
