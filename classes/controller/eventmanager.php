<?php

namespace Controller;
class Eventmanager extends Backend {

    public function before() {
        $this->View->assign('subMenu', array(
            'left' => array(
                array('link', \Config::BASEURL.'eventmanager', 'List'),
                array('link', \Config::BASEURL.'eventmanager/edit', 'Create')
            ),
            'right' => array(
                array('link', \Config::BASEURL.'eventmanager/archive', 'Archive')
            )
        ));
    }

    public function index() {
        $this->redirect('eventmanager/listing');
    }

	public function listing($archive = false) {
        $isAuth = $this->isAuth();
        $user = $isAuth? $isAuth['user'] : NULL;

        $result = $this->DB->execute('
            SELECT idevent, dtname, dtdescription, dtdate, dtduration, dtvisible, dtarchive, COUNT(fiuser) AS dtusercount
            FROM tblfitness_event
            INNER JOIN tblfitness_event_type
               ON idevent_type = fievent_type
            LEFT JOIN tblfitness_user2event
               ON idevent = fievent
            WHERE dtarchive = :archive
            GROUP BY idevent
            ORDER BY dtdate ASC
        ', array(
            'archive' => $archive? 1 : 0
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
            'archive' => $archive,
            'events' => $events
        ));
        return $this->View->fetch('eventmanager/list.tpl');
	}

    public function archive() {
        return $this->listing(true);
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

    public function hide($idevent) {
        $this->DB->execute('
            UPDATE tblfitness_event
            SET dtvisible = 0
            WHERE idevent = :event
        ', array(
            'event' => $idevent
        ));
        $this->redirect('eventmanager');
    }

    public function show($idevent) {
        $this->DB->execute('
            UPDATE tblfitness_event
            SET dtvisible = 1
            WHERE idevent = :event
        ', array(
            'event' => $idevent
        ));
        $this->redirect('eventmanager');
    }

    public function moveToArchive($idevent) {
        $this->DB->execute('
            UPDATE tblfitness_event
            SET dtarchive = 1,
                dtvisible = 0
            WHERE idevent = :event
        ', array(
            'event' => $idevent
        ));
        $this->redirect('eventmanager');
    }

    public function returnFromArchive($idevent) {
        $this->DB->execute('
            UPDATE tblfitness_event
            SET dtarchive = 0,
                dtvisible = 0
            WHERE idevent = :event
        ', array(
            'event' => $idevent
        ));
        $this->redirect('eventmanager');
    }

    public function delete($idevent) {
        $this->DB->execute('
            DELETE
            FROM tblfitness_user2event
            WHERE fievent = :event
        ', array(
            'event' => $idevent
        ));
        $this->DB->execute('
            DELETE
            FROM tblfitness_event
            WHERE idevent = :event
        ', array(
            'event' => $idevent
        ));
        $this->redirect('eventmanager');
    }

}
