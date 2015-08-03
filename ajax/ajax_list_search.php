<?
session_start();
require 'db.php';
require 'secfile.php';
if($userLevel['oper_view_post']==0){
	exit;
}

$search = $_GET['searchword'];
$methodSearch = $_GET['methodSearch'];

if($_GET['blocked']){
	$blocked = ' active=0 AND';
}else if($_GET['active']){	
	$blocked = ' active=1 AND';
}else{
	$blocked = '';
}

class mainpage_query{
	public $arrBest;
	public $db;
	function __construct(){
		$this->db = new Database();
	}
	function getAllfromtableLogin($search,$blocked){
		$sql = 'SELECT *, DATE_FORMAT(userdate,"%d-%m-%Y") as userdate FROM users WHERE'.$blocked.' login LIKE :keyword';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':keyword'=>'%'.$search.'%'));
		$this->arrBest = $tb->fetchAll(PDO::FETCH_ASSOC);
		return $this->arrBest;
	}
	function getAllfromtableEmail($search,$blocked){
		$sql = 'SELECT *, DATE_FORMAT(userdate,"%d-%m-%Y") as userdate FROM users WHERE'.$blocked.' email LIKE :keyword';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':keyword'=>'%'.$search.'%'));
		$this->arrBest = $tb->fetchAll(PDO::FETCH_ASSOC);
		return $this->arrBest;
	}
	function getAllfromtableName($search,$blocked){
		$sql = 'SELECT *, DATE_FORMAT(userdate,"%d-%m-%Y") as userdate FROM users WHERE'.$blocked.' name LIKE :keyword';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':keyword'=>'%'.$search.'%'));
		$this->arrBest = $tb->fetchAll(PDO::FETCH_ASSOC);
		return $this->arrBest;
	}
	function getAllfromtableSername($search,$blocked){
		$sql = 'SELECT *, DATE_FORMAT(userdate,"%d-%m-%Y") as userdate FROM users WHERE'.$blocked.' sername LIKE :keyword';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':keyword'=>'%'.$search.'%'));
		$this->arrBest = $tb->fetchAll(PDO::FETCH_ASSOC);
		return $this->arrBest;
	}
}

if($search){

$getData = new mainpage_query();

if($methodSearch=='login'){
$arrSearch = $getData ->getAllfromtableLogin($search,$blocked);
}

if($methodSearch=='email'){
$arrSearch = $getData ->getAllfromtableEmail($search,$blocked);
}

if($methodSearch=='name'){
$arrSearch = $getData ->getAllfromtableName($search,$blocked);
}

if($methodSearch=='sername'){
$arrSearch = $getData ->getAllfromtableSername($search,$blocked);
}

if(count($arrSearch)==0){
	$arrSearch['mistake'] = 'mistake';
}else{

}

echo json_encode($arrSearch);

}
?>