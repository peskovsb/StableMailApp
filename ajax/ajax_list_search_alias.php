<?
session_start();
require 'db.php';
require 'secfile.php';
if($userLevel['oper_view_forw']==0){
	exit;
}

$search = $_GET['searchword'];
$methodSearch = $_GET['methodSearch'];

class mainpage_query{
	public $arrBest;
	public $db;
	function __construct(){
		$this->db = new Database();
	}
	function getAllfromtableLogin($search){
		$sql = 'SELECT aliases.*, DATE_FORMAT(aliasdatefrom,"%d-%m-%Y") as aliasdatefrom, DATE_FORMAT(aliasdateto,"%d-%m-%Y") as aliasdateto, bcc.active FROM aliases LEFT JOIN bcc ON CONCAT(aliases.username, "@bioline.ru")=bcc.bcc_name WHERE aliases.username LIKE :keyword';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':keyword'=>'%'.$search.'%'));
		$this->arrBest = $tb->fetchAll(PDO::FETCH_ASSOC);
		return $this->arrBest;
	}
	function getAllfromtableEmail($search){
		$sql = 'SELECT aliases.*, DATE_FORMAT(aliasdatefrom,"%d-%m-%Y") as aliasdatefrom, DATE_FORMAT(aliasdateto,"%d-%m-%Y") as aliasdateto, bcc.active FROM aliases LEFT JOIN bcc ON CONCAT(aliases.username, "@bioline.ru")=bcc.bcc_name WHERE aliases.alias LIKE :keyword';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':keyword'=>'%'.$search.'%'));
		$this->arrBest = $tb->fetchAll(PDO::FETCH_ASSOC);
		return $this->arrBest;
	}
}

if($search){

$getData = new mainpage_query();

if($methodSearch=='username'){
$arrSearch = $getData ->getAllfromtableLogin($search);
}

if($methodSearch=='alias'){
$arrSearch = $getData ->getAllfromtableEmail($search);
}


if(count($arrSearch)==0){
	$arrSearch['mistake'] = 'mistake';
}else{

}

echo json_encode($arrSearch);

}
?>