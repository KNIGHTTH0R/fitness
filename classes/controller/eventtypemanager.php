<?php

namespace Controller;
class Eventtypemanager extends Backend {

    protected $types = array('coach', 'admin');

    public function before() {
        parent::before();

        $this->View->assign('subMenu', array(
            'left' => array(
                array('link', \Config::BASEURL.'eventtypemanager', 'List'),
                array('link', \Config::BASEURL.'eventtypemanager/edit', 'Create')
            )
        ));
    }

    public function index() {
        $this->redirect('eventtypemanager/listing');
    }

	public function listing() {
        $result = $this->DB->execute('
            SELECT idevent_type, dtname
            FROM tblfitness_event_type
            ORDER BY dtname ASC
        ');
        $types = $result->fetchAll();

        $this->View->assign(array(
            'types' => $types
        ));
        return $this->View->fetch('eventtypemanager/list.tpl');
    }

    public function edit($idevent_type = null) {
        if (isset($_SESSION['eventtype_edit'])) {
            $type = $_SESSION['eventtype_edit'];
            $type['idevent_type'] = $idevent_type;
            unset($_SESSION['eventtype_edit']);
        } else if ($idevent_type) {
            $result = $this->DB->execute('
                SELECT *
                FROM tblfitness_event_type
                WHERE idevent_type = :event_type
            ', array(
                'event_type' => $idevent_type
            ));
            $types = $result->fetchAll();
            if (isset($types[0])) {
                $type = $types[0];
            } else {
                $type = false;
            }
        } else {
            $type = false;
        }

        $this->View->assign(array(
            'type' => $type
        ));
        return $this->View->fetch('eventtypemanager/edit.tpl');
    }

    public function save($idevent_type = null) {
        if (empty($_POST))
            $this->redirect('eventtypemanager');

        if (empty($_POST['dtname'])) {
            \Message::add('You need to fill in the name');
            $_SESSION['eventtype_edit'] = $_POST;
            $this->redirect('eventtypemanager/edit/'.$idevent_type);
        }

        if ($idevent_type) {
            $this->DB->execute('
                UPDATE tblfitness_event_type
                SET dtname = :name,
                    dtdescription = :description
                WHERE idevent_type = :event_type
            ', array(
                'name' => $_POST['dtname'],
                'description' => $_POST['dtdescription']?: NULL,
                'event_type' => $idevent_type
            ));
        } else {
            $this->DB->execute('
                INSERT
                INTO tblfitness_event_type
                  (dtname, dtdescription)
                VALUES
                  (:name, :description)
            ', array(
                'name' => $_POST['dtname'],
                'description' => $_POST['dtdescription']?: NULL
            ));
        }
        $this->redirect('eventtypemanager');
    }

    public function delete($idevent_type) {
        try {
            $this->DB->execute('
                DELETE
                FROM tblfitness_event_type
                WHERE idevent_type = :event_type
            ', array(
                'event_type' => $idevent_type
            ));
        } catch(\Exception $e) {

            switch ($e->getCode()) {

                case '23000':
                    \Message::add('Delete classes of this type first');
                    break;

            }

        }
        $this->redirect('eventtypemanager');
    }

}
