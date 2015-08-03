<?
session_start();
require 'db.php';
require 'secfile.php';
if($userLevel['oper_correct_post']==0){
	exit;
}

$param = $_GET['delParam'];

class mainpage_query{
	public $arrBest;
	public $db;
	public $dbIt;
	function __construct(){
		$this->db = new Database();
		$this->dbIt = new DatabaseItDept();
	}
	function Deletefromtable($param){
		$sql = 'DELETE FROM users WHERE user_id=:user_id';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':user_id'=>$param));
		//$this->arrBest = $tb->fetch(PDO::FETCH_ASSOC);
		//return $this->arrBest;
	}

	function getDatafromtableUsers($username){
		$sql = 'SELECT * FROM users WHERE user_id = :login';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':login'=>$username));
		$this->arrBest = $tb->fetch(PDO::FETCH_ASSOC);
		return $this->arrBest;
	}	
	function writeLoging($inneruserId,$rzlt){
		$sql = 'INSERT INTO loging (`tmlog`,`login_id`,`moving`,`rzlt`,`vargroup`,`ipuser`) VALUES (NOW(),:login_id,"мн. удаление",:rzlt,"1","'.$_SERVER["REMOTE_ADDR"].'")';
		$tb = $this->dbIt->connection->prepare($sql);
		$tb->execute(array(':login_id'=>$inneruserId,':rzlt'=>$rzlt));
	}
}

//print_r($_GET);

$count=0;

$dellData = new mainpage_query();
foreach($_GET as $DelUsers){
	$count++;
		$userGet = $dellData -> getDatafromtableUsers($DelUsers);
	if(count($_GET)==$count){
		$email .= $userGet['login'];
	}else{
		$email .= $userGet['login'] .', ';
	}
	$dellData ->Deletefromtable($DelUsers);	
}
$dellData ->writeLoging($_SESSION['user_id'],$email);
?>


