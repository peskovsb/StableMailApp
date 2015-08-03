<?
session_start();
require 'db.php';
require 'secfile.php';
if($userLevel['oper_create_post']==0){
	exit;
}

//--Params-----------------------------

$domain_id			= 		 1;

$login 				=		 $_POST['field_email'];

//$domain 			= 		 $_POST['diff-mails'];

$domain 			= 		'bioline.ru';  //-- Test domain

$emails 			= 		 $login.'@'.$domain;

$password 			=		 $_POST['field_password'];

if($_POST['field_name']){
	$user_name 		= 		 $_POST['field_name'];	
}else{
	$user_name 		= 	     '';	
}

if($_POST['field_Lname']){
	$user_last_name = 		 $_POST['field_Lname'];	
}else{
	$user_last_name = 		 '';		
}


$active 			= 		 1;

$checkBox			= 		 $_POST['field_Tname'];

$fieldTheme			= 		 $_POST['field_Theme'];

$Fletter			= 		 $_POST['field_TtextLetter'];

$mailbox 			= 		 '/mail/virtual/' . $emails . '/Maildir/';

$profile_create 	= 		 $_POST['profile-create'];

// ------------------------------------------------

//print_r($_GET);

/*echo '<pre>';
	print_r($_SESSION['user_id']);
echo '</pre>';*/

function slaap($seconds) 
{ 
    $seconds = abs($seconds); 
    if ($seconds < 1): 
       usleep($seconds*1000000); 
    else: 
       sleep($seconds); 
    endif;    
} 

slaap(0.2);

class main_query{
	public $arrBest;
	public $db;
	public $dbIt;
	function __construct(){
		$this->db = new Database();
		$this->dbIt = new DatabaseItDept();
	}
	function checkfromtable($login_check){
		$sql = 'SELECT `user_id` FROM users WHERE login = :login';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':login'=>$login_check));
		$this->arrBest = $tb->fetch(PDO::FETCH_ASSOC);
		return $this->arrBest;
	}		
	function writeDate($domain_id,$login,$domain,$password,$emails,$user_name,$user_last_name,$active,$mailbox,$profile_create){		
		$sql = 'SELECT * from staff WHERE staff_id = :staff_id';
		$tb = $this->dbIt->connection->prepare($sql);
		$tb->execute(array(':staff_id'=>$profile_create));
		$userData = $tb->fetch(PDO::FETCH_ASSOC);
		if($profile_create != 0){
			$user_last_name = $userData['staff_lastname'];
			$user_name = $userData['staff_name'];
		}
		
		$sql = 'INSERT INTO users (`domain_id`,`login`,`password`,`email`,`name`,`sername`,`active`,`mailbox`,`userdate`,`staff_id`) VALUES (:domain_id,:login,:password,:email,:name,:sername,:active,:mailbox,now(),:staff_id)';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':domain_id'=>$domain_id,':login'=>$login,':password'=>$password,':email'=>$emails,':name'=>$user_name,':sername'=>$user_last_name,':active'=>$active,':mailbox'=>$mailbox,':staff_id'=>$profile_create));
	}
	function writeLoging($inneruserId,$rzlt){
		$sql = 'INSERT INTO loging (`tmlog`,`login_id`,`moving`,`rzlt`,`vargroup`,`ipuser`) VALUES (NOW(),:login_id,"создание",:rzlt,"1","'.$_SERVER["REMOTE_ADDR"].'")';
		$tb = $this->dbIt->connection->prepare($sql);
		$tb->execute(array(':login_id'=>$inneruserId,':rzlt'=>$rzlt));
	}
	function getAllfromtable($login_request){
		$sql = 'SELECT `user_id`,`email`,`email`, CONCAT(`sername`," ",`name`) as fio, `password` FROM users WHERE login = :login';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':login'=>$login_request));
		$this->arrBest = $tb->fetch(PDO::FETCH_ASSOC);
		return $this->arrBest;
	}	
}
$workData = new main_query();
$checkLogin = $workData ->getAllfromtable($login);
if(!$checkLogin['user_id']){
$writer = $workData -> writeDate($domain_id,$login,$domain,$password,$emails,$user_name,$user_last_name,$active,$mailbox,$profile_create);
}
$getter = $workData ->getAllfromtable($login);

$workData ->writeLoging($_SESSION['user_id'],$login);

//--Mail Sender
if($checkBox=='1'){
	$to= $emails;

	$subject = 'Добро пожаловать в группу компаний "БиоЛайн"';


	$headers= "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/plain; charset=utf-8\r\n";

	$headers .= "From: ".$emails."\r\n";

	mail($to, $subject, $Fletter, $headers);
}

require 'template_right_side.php';
?>