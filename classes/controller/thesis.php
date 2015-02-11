<?php

namespace Controller;
class Thesis extends \Controller {

	public function detail($idthesis) {
		if (!empty($_SESSION['iduser'])) {
			if (isset($_POST['save'])) {
				$this->DB->Execute('
					UPDATE tblthesis
					SET dtvalidated = ?
					WHERE idthesis = ?
				', array(
					isset($_POST['dtvalidated'])? 1 : 0,
					$idthesis
				));
			}
		}
	
		$thesis = $this->DB->GetRow('
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
			WHERE idthesis = ?
		', array(
			$idthesis
		));
		if (!$thesis)
			return;
		if (!$thesis['dtvalidated'] && empty($_SESSION['iduser']))
			return;
			
		$this->View->assign(array(
			'thesis' => $thesis,
			'pdfFile' => is_file(\Config::ROOT.'/files/pdf/'.$thesis['idthesis'])? \Config::BASEURL.'form/pdf/'.$thesis['idthesis'] : false,
			'admin' => !empty($_SESSION['iduser']),
			'datetime' => date('d/m/Y H:i', strtotime($thesis['dtdatetime'])),
			'last_update' => !empty($thesis['dtlast_update'])? date('d/m/Y H:i', strtotime($thesis['dtlast_update'])) : '',
			'edit' => \Config::BASEURL.'form/hash/'.$thesis['dthash']
		));
		return $this->View->fetch('thesis/detail.tpl');
	}
	
	public function search() {
		if (!empty($_POST['search'])) {
			$_SESSION['search'] = $_POST;
			header('Location: http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
			return;
		}
		if (!empty($_SESSION['search'])) {
			$where = array();
			if (!empty($_SESSION['search']['fikeyword'])) {
				$where[] = 'AND (fikeyword1 = '.$this->DB->qstr($_SESSION['search']['fikeyword']).'
								OR fikeyword2 = '.$this->DB->qstr($_SESSION['search']['fikeyword']).'
								OR fikeyword3 = '.$this->DB->qstr($_SESSION['search']['fikeyword']).')';
			}
			if (!empty($_SESSION['search']['fiuniversity'])) {
				$where[] = 'AND fiuniversity = '.$this->DB->qstr($_SESSION['search']['fiuniversity']);
			}
			if (!empty($_SESSION['search']['dtsearch'])) {
				$fields = array(
					'dtname',
					'dtfirstname',
					'dtemail',
					'dttel',
					'dtaddress',
					'dttitle',
					'dtyear',
					'dtresearch',
					'dtsummary'
				);
				$parts = preg_split('/\s/', $_SESSION['search']['dtsearch'], null, PREG_SPLIT_NO_EMPTY);	
				foreach ($parts as $part) {
					$or = array();
					foreach ($fields as $field) {
						$or[] = $field.' LIKE '.$this->DB->qstr('%'.$part.'%');
					}
					$where[] = 'AND ('.implode(' OR'."\n", $or).')';
				}
			}
			$sql = ('
				SELECT t.idthesis, t.dtname, t.dtfirstname, t.dtyear, t.dttitle, u.dtuniversity, c.dtcity
				FROM tblthesis AS t
				LEFT JOIN tblcity AS c
				  ON t.ficity = c.idcity
				LEFT JOIN tbluniversity AS u
				  ON t.fiuniversity = u.iduniversity
				WHERE t.dtvalidated = 1
				  '.implode("\n", $where).'
				ORDER BY t.dtname ASC, t.dtfirstname ASC
				LIMIT 100
			');
			$results = $this->DB->GetAll($sql);
			foreach ($results as &$result) {
				$result['link'] = \Config::BASEURL.'thesis/detail/'.$result['idthesis'];
			}
			$this->View->assign('results', $results);
		}
		$this->View->assign(array(
			'options' => array(
				'fiuniversity' => $this->DB->GetAll('
					SELECT iduniversity AS id, dtuniversity AS value
					FROM tbluniversity
					WHERE dtvalidated = 1
					ORDER BY dtuniversity ASC
				'),
				'fikeyword' => $this->DB->GetAll('
					SELECT idkeyword AS id, dtkeyword AS value
					FROM tblkeyword
					WHERE dtvalidated = 1
					ORDER BY dtkeyword ASC
				')
			),
			'search' => isset($_SESSION['search'])? $_SESSION['search'] : false
		));
		return $this->View->fetch('thesis/search.tpl');
	}

}

?>