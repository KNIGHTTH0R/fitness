<?php

namespace Controller;
class Admin extends \Controller {

	public function __construct() {
		parent::__construct();
		if (empty($_SESSION['iduser']))
			header('Location: http://'.$_SERVER['HTTP_HOST'].\Config::BASEURL.'login');
	}

	public function index() {
		header('Location: http://'.$_SERVER['HTTP_HOST'].\Config::BASEURL.'admin/theses');
		return;
	}
	
	private function _interface($content = '') {
		$this->View->assign(array(
			'menu' => array(
				'Cities' => \Config::BASEURL.'admin/cities',
				'Universities' => \Config::BASEURL.'admin/universities',
				'Keywords' => \Config::BASEURL.'admin/keywords',
				'Theses' => \Config::BASEURL.'admin/theses',
				'Logout' => \Config::BASEURL.'logout'
			),
			'content' => $content
		));
		return $this->View->fetch('admin/portal.tpl');
	}
	
	public function cities() {

		if ( !empty($_GET['id']) ) {
			$this->DB->Execute('
				UPDATE tbluniversity
				SET ficity = ?
				WHERE ficity = ?
			', array(
				null,
				$_GET['id']
			));
			$this->DB->Execute('
				UPDATE tblthesis
				SET ficity = ?
				WHERE ficity = ?
			', array(
				null,
				$_GET['id']
			));
			$this->DB->Execute('
				DELETE
				FROM tblcity
				WHERE idcity = ?
			', array(
				$_GET['id']
			));
		}

		if (!empty($_POST['add'])) {
			$this->DB->Execute('
				INSERT
				INTO tblcity
				  (dtcity)
				VALUES
				  (?)
			', array(
				$_POST['add']
			));
		}
		if (!empty($_POST['dtcity'])) {
			foreach ($_POST['dtcity'] as $idcity => $value) {
				if (!empty($_POST['replace'][$idcity])) {
					$this->DB->Execute('
						UPDATE tblthesis
						SET ficity = ?
						WHERE ficity = ?
					', array(
						$_POST['replace'][$idcity],
						$idcity
					));
					$this->DB->Execute('
						DELETE
						FROM tblcity
						WHERE idcity = ?
					', array(
						$idcity
					));
					continue;
				}
				$this->DB->Execute('
					UPDATE tblcity
					SET dtcity = ?,
						dtvalidated = ?
					WHERE idcity = ?
				', array(
					$_POST['dtcity'][$idcity],
					isset($_POST['dtvalidated'][$idcity])? 1 : 0,
					$idcity
				));
			}
		}
	
		$cities = $this->DB->GetAll('
			SELECT *
			FROM tblcity
			ORDER BY dtcity ASC
		');
		$this->View->assign(array(
			'cities' => $cities
		));
		return $this->_interface($this->View->fetch('admin/cities.tpl'));
	}
	
	public function universities() {

		if ( !empty($_GET['id']) ) {
			$this->DB->Execute('
				DELETE
				FROM tbluniversity
				WHERE iduniversity = ?
			', array(
				$_GET['id']
			));
		}

		if (!empty($_POST['add'])) {
			$this->DB->Execute('
				INSERT
				INTO tbluniversity
				  (dtuniversity)
				VALUES
				  (?)
			', array(
				$_POST['add']
			));
		}
		if (!empty($_POST['dtuniversity'])) {
			foreach ($_POST['dtuniversity'] as $iduniversity => $value) {
				if (!empty($_POST['replace'][$iduniversity])) {
					$this->DB->Execute('
						UPDATE tblthesis
						SET fiuniversity = ?
						WHERE fiuniversity = ?
					', array(
						$_POST['replace'][$iduniversity],
						$iduniversity
					));
					$this->DB->Execute('
						DELETE
						FROM tbluniversity
						WHERE iduniversity = ?
					', array(
						$iduniversity
					));
					continue;
				}
				$this->DB->Execute('
					UPDATE tbluniversity
					SET dtuniversity = ?,
						dtvalidated = ?,
						ficity = ?
					WHERE iduniversity = ?
				', array(
					$_POST['dtuniversity'][$iduniversity],
					isset($_POST['dtvalidated'][$iduniversity])? 1 : 0,
					empty($_POST['ficity'][$iduniversity])? null : $_POST['ficity'][$iduniversity],
					$iduniversity
				));
			}
		}
	
		$universities = $this->DB->GetAll('
			SELECT *
			FROM tbluniversity
			ORDER BY dtuniversity ASC
		');
		$cities = $this->DB->GetAll('
			SELECT *
			FROM tblcity
			ORDER BY dtcity ASC
		');
		$this->View->assign(array(
			'universities' => $universities,
			'cities' => $cities
		));
		return $this->_interface($this->View->fetch('admin/universities.tpl'));
	}
	
	public function keywords() {
		if ( !empty($_GET['id']) ) {
			$this->DB->Execute('
				DELETE
				FROM tblkeyword
				WHERE idkeyword = ?
			', array(
				$_GET['id']
			));
		}

		if (!empty($_POST['add'])) {
			$this->DB->Execute('
				INSERT
				INTO tblkeyword
				  (dtkeyword)
				VALUES
				  (?)
			', array(
				$_POST['add']
			));
		}
		if (!empty($_POST['dtkeyword'])) {
			foreach ($_POST['dtkeyword'] as $idkeyword => $value) {
				if (!empty($_POST['replace'][$idkeyword])) {
					$this->DB->Execute('
						UPDATE tblthesis
						SET fikeyword = ?
						WHERE fikeyword = ?
					', array(
						$_POST['replace'][$idkeyword],
						$idkeyword
					));
					$this->DB->Execute('
						DELETE
						FROM tblkeyword
						WHERE idkeyword = ?
					', array(
						$idkeyword
					));
					continue;
				}
				$this->DB->Execute('
					UPDATE tblkeyword
					SET dtkeyword = ?,
						dtvalidated = ?
					WHERE idkeyword = ?
				', array(
					$_POST['dtkeyword'][$idkeyword],
					isset($_POST['dtvalidated'][$idkeyword])? 1 : 0,
					$idkeyword
				));
			}
		}
	
		$keywords = $this->DB->GetAll('
			SELECT *
			FROM tblkeyword
			ORDER BY dtkeyword ASC
		');
		$this->View->assign(array(
			'keywords' => $keywords
		));
		return $this->_interface($this->View->fetch('admin/keywords.tpl'));
	}
	
	public function theses() {
		if ( !empty($_GET['id']) ) {
			$this->DB->Execute('
				DELETE
				FROM tblthesis
				WHERE idthesis = ?
			', array(
				$_GET['id']
			));
		}

		$theses = $this->DB->GetAll('
			SELECT t.*, c.dtcity, u.dtuniversity
			FROM tblthesis AS t
			INNER JOIN tblcity AS c
			  ON ficity = idcity
			INNER JOIN tbluniversity AS u
			  ON fiuniversity = iduniversity
			ORDER BY dtvalidated ASC, dtlast_update DESC, dtdatetime DESC
		');
		foreach ($theses as &$thesis) { 
			$thesis['edit'] = \Config::BASEURL.'form/hash/'.$thesis['dthash'];
			$thesis['detail'] = \Config::BASEURL.'thesis/detail/'.$thesis['idthesis'];
			$thesis['pdfFile'] = is_file(\Config::ROOT.'/files/pdf/'.$thesis['idthesis'])? \Config::BASEURL.'form/pdf/'.$thesis['idthesis'] : null;
		}
		$this->View->assign(array(
			'theses' => $theses
		));
		return $this->_interface($this->View->fetch('admin/theses.tpl'));
	}

}

?>