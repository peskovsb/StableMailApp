<?
session_start();
require 'db.php';
require 'secfile.php';
if($userLevel['oper_correct_post']==0){
	exit;
}

//--Params-----------------------------

$user_id = $_GET['cor_userid'];
$login = $_GET['cor_login'];
$password = $_GET['cor_pass'];
$email = $_GET['cor_email'];
if($_GET['cor_name']){$username = trim($_GET['cor_name']);}else{$username='';}
if($_GET['cor_sername']){$sername = trim($_GET['cor_sername']);}else{$sername='';}
$mailbox = $_GET['cor_mailbox'];
$userdate = $_GET['cor_date'];
$domain_id = $_GET['cor_domid'];
$active = $_GET['cor_active'];
$profile_create = $_GET['profile-take-cor'];

//--Params-----------------------------



class mainpage_query{
	public $arrBest;
	public $db;
	public $dbIt;
	function __construct(){
		$this->db = new Database();
		$this->dbIt = new DatabaseItDept();
	}
	function getAllfromtable($user_id,$login,$password,$email,$username,$sername,$mailbox,$userdate,$domain_id,$active,$profile_create){
		$sql = 'SELECT * from staff WHERE staff_id = :staff_id';
		$tb = $this->dbIt->connection->prepare($sql);
		$tb->execute(array(':staff_id'=>$profile_create));
		$userData = $tb->fetch(PDO::FETCH_ASSOC);
		if($profile_create != 0){
			$sername = $userData['staff_lastname'];
			$username = $userData['staff_name'];
		}		
		
		$sql = 'UPDATE users SET login=:login, password=:password, email=:email, sername=:sername, name=:username, mailbox=:mailbox, userdate=:userdate, domain_id=:domain_id, active=:active, staff_id=:staff_id WHERE user_id=:user_id';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':user_id'=>$user_id,':login'=>$login,':password'=>$password,':email'=>$email,':username'=>$username,':sername'=>$sername,':mailbox'=>$mailbox,':userdate'=>date('Y-m-d',strtotime($userdate)),':domain_id'=>$domain_id,':active'=>$active,':staff_id'=>$profile_create));
		/*$this->arrBest = $tb->fetch(PDO::FETCH_ASSOC);
		return $this->arrBest;*/
	}	
	function writeLoging($inneruserId,$rzlt){
		$sql = 'INSERT INTO loging (`tmlog`,`login_id`,`moving`,`rzlt`,`vargroup`,`ipuser`) VALUES (NOW(),:login_id,"редактирование",:rzlt,"1","'.$_SERVER["REMOTE_ADDR"].'")';
		$tb = $this->dbIt->connection->prepare($sql);
		$tb->execute(array(':login_id'=>$inneruserId,':rzlt'=>$rzlt));
	}
	function writeLogingBlocking($inneruserId,$rzlt){
		$sql = 'INSERT INTO loging (`tmlog`,`login_id`,`moving`,`rzlt`,`vargroup`) VALUES (NOW(),:login_id,"блокирование",:rzlt,"1")';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':login_id'=>$inneruserId,':rzlt'=>$rzlt));
	}
}

$getData = new mainpage_query();
$arrLogin = $getData ->getAllfromtable($user_id,$login,$password,$email,$username,$sername,$mailbox,$userdate,$domain_id,$active,$profile_create);

$getData ->writeLoging($_SESSION['user_id'],$login);

if(empty($active)){
	$getData ->writeLogingBlocking($_SESSION['user_id'],$login);
}
?>