<?
require 'db.php';

$search = $_GET['searchword'];
$methodSearch = $_GET['methodSearch'];

class mainpage_query{
	public $arrBest;
	public $db;
	function __construct(){
		$this->db = new Database();
	}
	function getAllfromtableLogin($search){
		$sql = 'SELECT *, DATE_FORMAT(userdate,"%d-%m-%Y") as userdate FROM users WHERE login LIKE :keyword';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':keyword'=>'%'.$search.'%'));
		$this->arrBest = $tb->fetchAll(PDO::FETCH_ASSOC);
		return $this->arrBest;
	}
	function getAllfromtableEmail($search){
		$sql = 'SELECT *, DATE_FORMAT(userdate,"%d-%m-%Y") as userdate FROM users WHERE email LIKE :keyword';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':keyword'=>'%'.$search.'%'));
		$this->arrBest = $tb->fetchAll(PDO::FETCH_ASSOC);
		return $this->arrBest;
	}
}

if($search){

$getData = new mainpage_query();

if($methodSearch=='login'){
$arrSearch = $getData ->getAllfromtableLogin($search);
}

if($methodSearch=='email'){
$arrSearch = $getData ->getAllfromtableEmail($search);
}

if(count($arrSearch)==0){
	$arrSearch['mistake'] = 'mistake';
}else{

}

echo json_encode($arrSearch);

}
?>