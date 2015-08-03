<?
require '../../db.php';

if($_GET['pagi']){
	$pagiPage = $_GET['pagi'];
}else{
	$pagiPage = 1;
}

if($_GET['limit']){
	$limit = $_GET['limit'];
}else{
	$limit = 30;
}

class mainpage_query{
	public $arrBest;
	public $arrCheckRepl;
	public $db;
	public $pagiPage;
	public $limit;
	function __construct($pagiPage,$limit){
		$this->db = new DatabaseItDept();
		$this->pagiPage = $pagiPage;
		$this->limit = $limit;
	}

	function getDatafromtable(){
		$this->pagiPage = ($this->pagiPage-1) * $this->limit;
		$sql = 'SELECT * FROM loging ORDER BY id DESC LIMIT '.$this->pagiPage.','.$this->limit;
		$tb = $this->db->connection->prepare($sql);
		$tb->execute();
		$this->arrBest = $tb->fetchAll(PDO::FETCH_ASSOC);
		return $this->arrBest;
	}	
	function getUserById($userid){
		$sql = 'SELECT * FROM inner_users WHERE user_id = :user_id';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':user_id'=>$userid));
		$this->arrBest = $tb->fetch(PDO::FETCH_ASSOC);
		return $this->arrBest;
	}		
}
$getData = new mainpage_query($pagiPage,$limit);

$getter = $getData ->getDatafromtable();

$counter = 0;
foreach($getter as $arItMs){
$userLogin = $getData -> getUserById($arItMs['login_id']);	
if(!$getter[$counter]['ipuser']){$getter[$counter]['ipuser'] = 'NULL';} 
		$getter[$counter]['login_id'] = $userLogin['user_login'];
		$getter[$counter]['tmlog'] = date("d-m-y H:i:s",  strtotime($arItMs['tmlog']));
	$counter ++;
}

echo json_encode($getter);
?>