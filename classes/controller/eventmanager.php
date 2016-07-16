<?php

namespace Controller;
class Eventmanager extends Backend {

    protected $types = array('coach', 'admin');

    public function before() {
        parent::before();

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
        $result = $this->DB->execute('
            SELECT idevent, dtname, dtdescription, dtdate, dtduration, dtvisible, dtarchive, e.dtlimit, COUNT(fiuser) AS dtusercount
            FROM tblfitness_event AS e
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

        //group by week & do some formatting
        $weeks = array();
        while ($event = array_shift($events)) {
            $time = strtotime($event['dtdate']);

            $date = strftime('%A', $time).' - '.date('d/m/Y', $time);
            $event['from']  = date('H:i', $time);
            $event['to']    = date('H:i', $time + ($event['dtduration'] * 60));

            $year = date('Y', $time);
            $week_number = date('W', $time);
            $group_key = $year.'-'.$week_number;
            if (!isset($weeks[$group_key])) {
                $weekday = date('w', $time);
                $monday = $time - (($weekday-1) * 60 * 60 * 24);
                $sunday = $monday + (6 * 60 * 60 * 24);
                $weeks[$group_key]['label'] = date('d/m/Y', $monday).' - '.date('d/m/Y', $sunday);
            }

            $weeks[$group_key]['events'][$date][] = $event;
        }

        // show archive weeks in reverse order
        if ($archive) {
            krsort($weeks);
        }

        $this->View->assign(array(
            'archive' => $archive,
            'weeks' => $weeks
        ));
        return $this->View->fetch('eventmanager/list.tpl');
	}

    public function archive() {
        return $this->listing(true);
    }

    public function edit($idevent = null) {
        if (isset($_SESSION['event_edit'])) {
            $event = $_SESSION['event_edit'];
            $event['idevent'] = $idevent;
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

        if (!preg_match('/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/', $_POST['dtdate'])) {
            \Message::add('Invalid date format');
            $_SESSION['event_edit'] = $_POST;
            $this->redirect('eventmanager/edit/'.$idevent);
        }

        if (!preg_match('/^[0-9]{2}:[0-9]{2}$/', $_POST['dttime'])) {
            \Message::add('Invalid time format');
            $_SESSION['event_edit'] = $_POST;
            $this->redirect('eventmanager/edit/'.$idevent);
        }

        if (!preg_match('/^[0-9]+$/', $_POST['dtduration'])) {
            \Message::add('Invalid duration format');
            $_SESSION['event_edit'] = $_POST;
            $this->redirect('eventmanager/edit/'.$idevent);
        }

        if ($idevent && !preg_match('/^[0-9]+$/', $_POST['dtlimit'])) {
            \Message::add('Invalid limit format');
            $_SESSION['event_edit'] = $_POST;
            $this->redirect('eventmanager/edit/'.$idevent);
        }

        $date = implode('-', array_reverse(explode('/', $_POST['dtdate']))).' '.$_POST['dttime'].':00';

        if ($idevent) {
            $this->DB->execute('
                UPDATE tblfitness_event
                SET fievent_type = :event_type,
                    dtdate = :date,
                    dtduration = :duration,
                    dtlimit = :limit
                WHERE idevent = :event
            ', array(
                'event' => $idevent,
                'date' => $date,
                'event_type' => $_POST['fievent_type'],
                'duration' => $_POST['dtduration'],
                'limit' => $_POST['dtlimit']?: null
            ));
        } else {
            $this->DB->execute('
                INSERT
                INTO tblfitness_event
                  (fievent_type, dtdate, dtduration, dtlimit)
                SELECT :event_type, :date, :duration, dtlimit
                FROM tblfitness_event_type
                WHERE idevent_type = :event_type
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

    public function subscriptions($idevent) {
        $result = $this->DB->execute('
            SELECT *
            FROM tblfitness_event
            WHERE idevent = :event
        ', array(
            'event' => $idevent
        ));
        if (!$result || !isset($result[0]))
            $this->redirect('eventmanager');
        $event = $result[0];

        $result = $this->DB->execute('
            SELECT iduser, dtlast_name, dtfirst_name, dtemail, dttel
            FROM tblfitness_user
            INNER JOIN tblfitness_user2event
              ON iduser = fiuser
              AND fievent = :event
            ORDER BY dtlast_name, dtfirst_name
        ', array(
            'event' => $idevent
        ));
        $users = $result->fetchAll();

        $result = $this->DB->execute('
            SELECT iduser, dtlast_name, dtfirst_name
            FROM tblfitness_user
            LEFT JOIN tblfitness_user2event
              ON iduser = fiuser
              AND fievent = :event
            WHERE fievent IS NULL
            ORDER BY dtlast_name, dtfirst_name
        ', array(
            'event' => $idevent
        ));
        $newusers = $result->fetchAll();

        $this->View->assign(array(
            'idevent' => $idevent,
            'users' => $users,
            'newusers' => $newusers,
            'complete' => $event['dtlimit'] && intval($event['dtlimit']) <= count($users)
        ));
        return $this->View->fetch('eventmanager/subscriptions.tpl');
    }

    public function unsubscribe($idevent, $iduser) {
        try {
            $this->DB->execute('
                DELETE
                FROM tblfitness_user2event
                WHERE fiuser = :user
                  AND fievent = :event
            ', array(
                'user' => $iduser,
                'event' => $idevent
            ));
        } catch (\Exception $e) {}

        $this->redirect('eventmanager/subscriptions/'.$idevent);
    }

    public function subscribe($idevent) {
        if (empty($_POST['fiuser']))
            $this->redirect('eventmanager/subscriptions/'.$idevent);

        try {
            $this->DB->execute('
                INSERT
                INTO tblfitness_user2event
                  (fiuser, fievent)
                VALUES
                  (:user, :event)
            ', array(
                'user' => $_POST['fiuser'],
                'event' => $idevent
            ));
        } catch (\Exception $e) {}

        $this->redirect('eventmanager/subscriptions/'.$idevent);
    }

}
