<?php

namespace Controller;
class Form extends \Controller {

	public function index() {
		$this->redirectToPage();
	}
	
	public function hash($hash) {
		$values = $this->DB->GetRow('
			SELECT t.*, c.dtcity, u.dtuniversity, k1.dtkeyword AS dtkeyword1, k2.dtkeyword AS dtkeyword2, k3.dtkeyword AS dtkeyword3
			FROM tblthesis AS t
			LEFT JOIN tblcity AS c
			  ON ficity = idcity
			LEFT JOIN tbluniversity AS u
			  ON fiuniversity = iduniversity
			LEFT JOIN tblkeyword AS k1
			  ON fikeyword1 = k1.idkeyword
			LEFT JOIN tblkeyword AS k2
			  ON fikeyword2 = k2.idkeyword
			LEFT JOIN tblkeyword AS k3
			  ON fikeyword3 = k3.idkeyword
			WHERE dthash = ?
		', array(
			$hash
		));
		if ($values) {
			$_SESSION['idthesis'] = $values['idthesis'];	
			$_SESSION['form'][0] = array(
				'dtname' => $values['dtname'],
				'dtfirstname' => $values['dtfirstname'],
				'dtemail' => $values['dtemail'],
				'dttel' => $values['dttel'],
				'dtaddress' => $values['dtaddress']
			);
			$_SESSION['form'][1] = array(
				'dttitle' => $values['dttitle'],
				'dtcity' => $values['dtcity'],
				'dtuniversity' => $values['dtuniversity'],
				'dtyear' => $values['dtyear'],
				'dtresearch' => $values['dtresearch'],
				'dtsummary' => $values['dtsummary'],
				'dtkeyword1' => $values['dtkeyword1'],
				'dtkeyword2' => $values['dtkeyword2'],
				'dtkeyword3' => $values['dtkeyword3'],
				'dtpdf' => $values['dtpdf']
			);
			$_SESSION['form'][2] = array(
				'dtdisplay_email' => $values['dtdisplay_email'],
				'dtdisplay_tel' => $values['dtdisplay_tel'],
				'dtdisplay_address' => $values['dtdisplay_address'],
				'dtdisplay_pdf' => $values['dtdisplay_pdf'],
				'dtvalidated' => $values['dtvalidated']
			);
		} else {
			if (isset($_SESSION['idthesis']))
				unset($_SESSION['idthesis']);
			if (isset($_SESSION['form']))
				unset($_SESSION['form']);
		}
		$this->redirectToPage();
	}
	
	public function pdf($idthesis) {
		$thesis = $this->DB->GetRow('
			SELECT *
			FROM tblthesis
			WHERE idthesis = ?
		', array($idthesis));
		if (!$thesis)
			return;
		if (!$thesis['dtdisplay_pdf'] && //settings?
				empty($_SESSION['iduser']) && //admin?
				(empty($_SESSION['idthesis']) || $_SESSION['idthesis'] != $idthesis)) { //edit?
			$this->redirectToPage();
			return;
		}
		if (!is_file(\Config::ROOT.'/files/pdf/'.$idthesis))
			return;
		header('Content-type: application/pdf');
		header('Content-Disposition: attachment; filename="'.$thesis['dtpdf'].'"');
		header('Content-Length: '.filesize(\Config::ROOT.'/files/pdf/'.$idthesis));
		readfile(\Config::ROOT.'/files/pdf/'.$idthesis);
	}
	
	public function pdf_temp($filename) {
		if (!is_file(\Config::ROOT.'/files/pdf_temp/'.session_id()))
			return;
		header('Content-type: application/pdf');
		header('Content-Disposition: attachment; filename="'.$filename.'"');
		header('Content-Length: '.filesize(\Config::ROOT.'/files/pdf_temp/'.session_id()));
		readfile(\Config::ROOT.'/files/pdf_temp/'.session_id());
	}

	public function page($page = 1) {
		//check if last page has been filled in
		if ($page > 1 && !isset($_SESSION['form'][$page-2])) {
			if (empty($_SESSION['form'])) {
				$page = 1;
			} else {
				$page = max(array_keys($_SESSION['form'])) + 2;
			}
			$this->redirectToPage($page);
			return false;
		}
		
		switch($page) {
			case 1:
				$this->savePage1();
				return $this->getPage1();
			case 2:
				$this->savePage2();
				return $this->getPage2();
			case 3:
				$this->savePage3();
				return $this->getPage3();
		}
	}
	
	public function savePage1() {
		if (	empty($_POST['dtname']) ||
				empty($_POST['dtfirstname']) ||
				empty($_POST['dtemail']) ||
				empty($_POST['dttel']) ||
				empty($_POST['dtaddress']))
			return false;
		$_SESSION['form'][0] = $_POST;
		$this->redirectToPage(2);
	}
	
	public function getPage1() {
		$values = array();
		if (isset($_SESSION['form'][0]))
			$values = $_SESSION['form'][0];
		if (!empty($_POST))
			$values = $_POST;
			
		//fetch form
		$this->View->assign(array(
			'title' => 'Formulaire de contact RentaEco',
			'label' => array(
				'name' => 'Nom:',
				'firstname' => 'Prénom:',
				'email' => 'E-Mail:',
				'tel' => 'Numéro de téléphone:',
				'address' => 'Adresse:',
				'next' => 'Suivant'
			),
			'value' => $values
		));
		if (count($values) > 0) {
			$this->View->assign('required', array(
				'dtname' 		=> empty($values['dtname'])? 		true : false,
				'dtfirstname' 	=> empty($values['dtfirstname'])? 	true : false,
				'dtemail' 		=> empty($values['dtemail'])? 		true : false,
				'dttel' 		=> empty($values['dttel'])? 		true : false,
				'dtaddress' 	=> empty($values['dtaddress'])? 	true : false
			));
		}
		return $this->View->fetch('form/page1.tpl');
	}
	
	public function savePage2() {
		if (	empty($_POST['dttitle']) ||
				empty($_POST['dtcity']) ||
				empty($_POST['dtuniversity']) ||
				empty($_POST['dtyear']) ||
				empty($_POST['dtresearch']) ||
				empty($_POST['dtsummary']) ||
				empty($_POST['dtkeyword1']))
			return false;
		
		if (!empty($_SESSION['form'][1]['dtpdf']))
			$_POST['dtpdf'] = $_SESSION['form'][1]['dtpdf'];

		if (!empty($_POST['deletePdf'])) {
			if (is_file(\Config::ROOT.'/files/pdf_temp/'.session_id()))
				unlink(\Config::ROOT.'/files/pdf_temp/'.session_id());
			$_POST['dtpdf'] = null;
		}
			
		if (isset($_FILES['dtpdf']) && !empty($_FILES['dtpdf']['name'])) {
			if ($_FILES['dtpdf']['error'] == UPLOAD_ERR_OK) {
				$extension = strtolower(pathinfo($_FILES['dtpdf']['name'], PATHINFO_EXTENSION));
				if ($extension == 'pdf') {
					move_uploaded_file($_FILES['dtpdf']['tmp_name'], \Config::ROOT.'/files/pdf_temp/'.session_id());
					$_POST['dtpdf'] = $_FILES['dtpdf']['name'];
				}
			}	
		}
			
		$_SESSION['form'][1] = $_POST;
		$this->redirectToPage(3);
	}
	
	public function getPage2() {
		$values = array();
		if (isset($_SESSION['form'][1]))
			$values = $_SESSION['form'][1];
		if (!empty($_POST))
			$values = $_POST;
			
		$pdfFile = null;
		if (!empty($values['dtpdf'])) {
			if (!empty($_SESSION['idthesis']) && is_file(\Config::ROOT.'/files/pdf/'.$_SESSION['idthesis']))
				$pdfFile = \Config::BASEURL.'form/pdf/'.$_SESSION['idthesis'];
			if (is_file(\Config::ROOT.'/files/pdf_temp/'.session_id()))
				$pdfFile = \Config::BASEURL.'form/pdf_temp/'.$values['dtpdf'];
		}
		/*
		//prepare list of cities
		$cities = array();
		$cities['all']['data'] = $this->DB->GetAll('
			SELECT dtcity
			FROM tblcity
			WHERE dtvalidated = 1
			ORDER BY dtcity ASC
		');
		*/
		//prepare list of universities
		$universities = array();
		$universities['all']['data'] = $this->DB->GetAll('
			SELECT dtuniversity
			FROM tbluniversity
			WHERE dtvalidated = 1
			ORDER BY dtuniversity ASC
		');
		
		$cities = $this->DB->GetAll('
			SELECT idcity, dtcity
			FROM tblcity
			WHERE dtvalidated = 1
			ORDER BY dtcity ASC
		');
		foreach ($cities as $city) {
			$result = $this->DB->GetAll('
				SELECT dtuniversity
				FROM tbluniversity
				WHERE dtvalidated = 1
				  AND ficity = ?
				ORDER BY dtuniversity ASC
			', array(
				$city['idcity']
			));
			if (count($result) == 0)
				continue;
			$universities[$city['dtcity']]['data'] = $result;
		}
		
		//fetch form
		$this->View->assign(array(
			'title' => 'Informations sur le mémoire',
			'label' => array(
				'title' => 'Titre du mémoire / thèse:',
				'city' => 'Ville:',
				'year' => 'Année de publication:',
				'research' => 'Domaine de recherche:',
				'university' => 'Université:',
				'summary' => 'Un brève résumé de votre travail (max 300 charactères):',
				'keyword1' => 'Mots clés 1:',
				'keyword2' => 'Mots clés 2:',
				'keyword3' => 'Mots clés 3:',
				'pdf' => 'Import de l\'étude (Format PDF):',
				'delete' => 'Delete',
				'next' => 'Suivant'
			),
			'value' => $values,
			'options' => array(
				'dtcity' => $this->DB->GetCol('
					SELECT dtcity
					FROM tblcity
					WHERE dtvalidated = 1
					ORDER BY dtcity ASC
				'),
				'dtkeyword' => $this->DB->GetCol('
					SELECT dtkeyword
					FROM tblkeyword
					WHERE dtvalidated = 1
					ORDER BY dtkeyword ASC
				')
			),
			//'cities' => json_encode($cities),
			'universities' => json_encode($universities),
			'pdfFile' => $pdfFile
		));
		if (count($values) > 0) {
			$this->View->assign('required', array(
				'dttitle' 		=> empty($values['dttitle'])? 		true : false,
				'dtcity' 		=> empty($values['dtcity'])? 		true : false,
				'dtuniversity' 	=> empty($values['dtuniversity'])? 	true : false,
				'dtyear' 		=> empty($values['dtyear'])? 		true : false,
				'dtresearch' 	=> empty($values['dtresearch'])? 	true : false,
				'dtsummary' 	=> empty($values['dtsummary'])? 	true : false,
				'dtkeyword1' 	=> empty($values['dtkeyword1'])? 	true : false
			));
		}
		return $this->View->fetch('form/page2.tpl');
	}
	
	public function savePage3() {
		if (!isset($_POST['save']))
			return false;
		unset($_POST['save']);
		$_SESSION['form'][2] = $_POST;
		header('Location: http://'.$_SERVER['HTTP_HOST'].\Config::BASEURL.'form/save');
	}
	
	public function getPage3() {
		$values = array();
		if (isset($_SESSION['form'][2]))
			$values = $_SESSION['form'][2];
		if (!empty($_POST))
			$values = $_POST;
	
		//fetch form
		$this->View->assign(array(
			'title' => 'Coordonnées de l\'auteur / Import du mémoire',
			'label' => array(
				'display_email' => 'Affichage de l\'Email:',
				'display_tel' => 'Affichage du Numéro de téléphone:',
				'display_address' => 'Affichage de l\'adresse:',
				'display_pdf' => 'Etude téléchargable (si import du mémoire):',
				'validated' => 'Validated:',
				'save' => 'Sauvegarder'
			),
			'value' => $values,
			'admin' => !empty($_SESSION['iduser'])
		));
		return $this->View->fetch('form/page3.tpl');
	}
	
	public function save() {
		if (empty($_SESSION['form']) || !isset($_SESSION['form'][2])) {
			$this->redirectToPage();
			return false;
		}
	
		//values
		$values = array_merge(
			$_SESSION['form'][0],
			$_SESSION['form'][1],
			$_SESSION['form'][2]
		);
		$values['dtdisplay_email'] 		= isset($values['dtdisplay_email'])? 	1 : 0;
		$values['dtdisplay_tel'] 		= isset($values['dtdisplay_tel'])? 		1 : 0;
		$values['dtdisplay_address'] 	= isset($values['dtdisplay_address'])? 	1 : 0;
		$values['dtdisplay_pdf'] 		= isset($values['dtdisplay_pdf'])? 		1 : 0;
		$values['dtvalidated']			= !empty($_SESSION['iduser']) &&
										  isset($values['dtvalidated'])? 		1 : 0;
		
		//get listing id's
		
		//dtcity
		$values['ficity'] = $this->DB->GetOne('
			SELECT idcity
			FROM tblcity
			WHERE dtcity = ?
		', array(
			$values['dtcity']
		));
		if (!$values['ficity']) {
			$this->DB->Execute('
				INSERT
				INTO tblcity
				  (dtcity)
				VALUES
				  (?)
			', array(
				$values['dtcity']
			));
			$values['ficity'] = $this->DB->Insert_ID();
		}
		//unset($values['dtcity']);
		
		//dtuniversity
		$values['fiuniversity'] = $this->DB->GetOne('
			SELECT iduniversity
			FROM tbluniversity
			WHERE dtuniversity = ?
		', array(
			$values['dtuniversity']
		));
		if (!$values['fiuniversity']) {

			$this->DB->Execute('
				INSERT
				INTO tbluniversity
				  (dtuniversity, ficity)
				VALUES
				  (?,?)
			', array(
				$values['dtuniversity'], $values['ficity']
			));
			$values['fiuniversity'] = $this->DB->Insert_ID();
		}
		unset($values['dtcity']);
		unset($values['dtuniversity']);
		
		//dtkeyword
		for($i=1; $i<=3; $i++) {
			if (empty($values['dtkeyword'.$i])) {
				$values['fikeyword'.$i] = null;
				unset($values['dtkeyword'.$i]);
				continue;
			}
			$values['fikeyword'.$i] = $this->DB->GetOne('
				SELECT idkeyword
				FROM tblkeyword
				WHERE dtkeyword = ?
			', array(
				$values['dtkeyword'.$i]
			));
			if (!$values['fikeyword'.$i]) {
				$this->DB->Execute('
					INSERT
					INTO tblkeyword
					  (dtkeyword)
					VALUES
					  (?)
				', array(
					$values['dtkeyword'.$i]
				));
				$values['fikeyword'.$i] = $this->DB->Insert_ID();
			}
			unset($values['dtkeyword'.$i]);
		}
		
		$saved = false;
		if (!empty($_SESSION['idthesis'])) {			
			//set last update time
			$values['dtlast_update'] = date('Y-m-d H:i:s');
			
			if ($this->DB->AutoExecute('tblthesis', $values, 'UPDATE', 'idthesis = '.$this->DB->qstr($_SESSION['idthesis']))) {
				$saved = $_SESSION['idthesis'];
			}
		} else {				
			//generate new hash
			$values['dthash'] = md5(uniqid(rand(), TRUE));
			
			//insert time
			$values['dtdatetime'] = date('Y-m-d H:i:s');
		
			if ($this->DB->AutoExecute('tblthesis', $values, 'INSERT')) {
				$saved = $this->DB->Insert_ID();
			}
		}
		
		$values = $this->DB->GetRow('
			SELECT *
			FROM tblthesis
			WHERE idthesis = ?
		', array(
			$saved
		));
		
		if ($values && $saved) {
			if (isset($_SESSION['idthesis']))
				unset($_SESSION['idthesis']);
			if (isset($_SESSION['form']))
				unset($_SESSION['form']);
				
			if (empty($values['dtpdf']) && is_file(\Config::ROOT.'/files/pdf/'.$saved)) {
				unlink(\Config::ROOT.'/files/pdf/'.$saved);
			}
			
			if (is_file(\Config::ROOT.'/files/pdf_temp/'.session_id())) {
				rename(\Config::ROOT.'/files/pdf_temp/'.session_id(), \Config::ROOT.'/files/pdf/'.$saved);
			}
			
			$this->View->assign(array(
				'editLink' => 'http://'.$_SERVER['HTTP_HOST'].\Config::BASEURL.'form/hash/'.$values['dthash']
			));
			return $this->View->fetch('form/save.tpl');
		}
		
		$this->redirectToPage(3);
	}
	
	public function redirectToPage($page = 1) {
		header('Location: http://'.$_SERVER['HTTP_HOST'].\Config::BASEURL.'form/page/'.$page);
	}

}

?>