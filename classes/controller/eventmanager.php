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

    public function edit($idevent = null) {
        if (isset($_SESSION['event_edit'])) {
            $event = $_SESSION['event_edit'];
            unset($_SESSION['event_edit']);
        } else if ($idevent) {
            $result = $this->DB->execute('
                SELECT *
                FROM tblfitness_event
                WHERE idevent = :event
            ', array(
                'event' => $idevent
            ));
            $events = $result->fetchAll();
            if (isset($events[0])) {
                $event = $events[0];
                $time = strtotime($event['dtdate']);
                $event['dttime'] = date('H:i', $time);
                $event['dtdate'] = date('d/m/Y', $time);
            } else {
                $event = false;
            }
        } else {
            $event = false;
        }

        $result = $this->DB->execute('
            SELECT idevent_type, dtname
            FROM tblfitness_event_type
            ORDER BY dtname
        ', array(
            'event' => $idevent
        ));
        $types = $result->fetchAll();

        $this->View->assign(array(
            'event' => $event,
            'types' => $types
        ));
        return $this->View->fetch('eventmanager/edit.tpl');
    }

    public function save($idevent = null) {
        if (empty($_POST))
            $this->redirect('eventmanager');

        if (empty($_POST['fievent_type'])
                || empty($_POST['dtdate'])
                || empty($_POST['dttime'])
                || empty($_POST['dtduration'])) {
            \Message::add('You need to fill in all fields');
            $_SESSION['event_edit'] = $_POST;
            $this->redirect('eventmanager/edit/'.$idevent);
        }

        $date = implode('-', array_reverse(explode('/', $_POST['dtdate']))).' '.$_POST['dttime'].':00';

        if ($idevent) {
            $this->DB->execute('
                UPDATE tblfitness_event
                SET fievent_type = :event_type,
                    dtdate = :date,
                    dtduration = :duration
                WHERE idevent = :event
            ', array(
                'event' => $idevent,
                'date' => $date,
                'event_type' => $_POST['fievent_type'],
                'duration' => $_POST['dtduration']
            ));
        } else {
            $this->DB->execute('
                INSERT
                INTO tblfitness_event
                  (fievent_type, dtdate, dtduration)
                VALUES
                  (:event_type, :date, :duration)
            ', array(
                'date' => $date,
                'event_type' => $_POST['fievent_type'],
                'duration' => $_POST['dtduration']
            ));
        }
        $this->redirect('eventmanager');
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
