<?
session_start();
require 'db.php';
require 'secfile.php';
if($userLevel['oper_correct_forw']==0){
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
	
		//--SELECT userName
		$sql = 'SELECT `username` FROM aliases WHERE alias_id = :alias_id';
		$tb2 = $this->db->connection->prepare($sql);
		$tb2->execute(array(':alias_id'=>$param));
		$this->arrBest = $tb2->fetch(PDO::FETCH_ASSOC);		
		
		//-- Update
		$sql = 'UPDATE bcc SET active=0 WHERE bcc_name=:alias_id';
		$tb3 = $this->db->connection->prepare($sql);
		$tb3->execute(array(':alias_id'=>$this->arrBest['username'].'@bioline.ru'));		
	
		//--Deleting...
		$sql = 'DELETE FROM aliases WHERE alias_id=:alias_id';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':alias_id'=>$param));
		//$this->arrBest = $tb->fetch(PDO::FETCH_ASSOC);
		//return $this->arrBest;	
		
	}
	function getDatafromtableUsers($username){
		$sql = 'SELECT * FROM aliases WHERE alias_id = :login';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':login'=>$username));
		$this->arrBest = $tb->fetch(PDO::FETCH_ASSOC);
		return $this->arrBest;
	}		
	function writeLoging($inneruserId,$rzlt){
		$sql = 'INSERT INTO loging (`tmlog`,`login_id`,`moving`,`rzlt`,`vargroup`,`ipuser`) VALUES (NOW(),:login_id,"мн. удаление",:rzlt,"2","'.$_SERVER["REMOTE_ADDR"].'")';
		$tb = $this->dbIt->connection->prepare($sql);
		$tb->execute(array(':login_id'=>$inneruserId,':rzlt'=>$rzlt));
	}	
}

//print_r($_GET);
$dellData = new mainpage_query();
foreach($_GET as $DelUsers){
	$count++;
		$userGet = $dellData -> getDatafromtableUsers($DelUsers);
	if(count($_GET)==$count){
		$email .= $userGet['username'];
	}else{
		$email .= $userGet['username'] .', ';
	}
	$dellData ->Deletefromtable($DelUsers);
}
$dellData ->writeLoging($_SESSION['user_id'],$email);
?>


