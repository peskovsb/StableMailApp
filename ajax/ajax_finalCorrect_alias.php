<?
session_start();
require 'db.php';


//--Params-----------------------------

$user_id = $_POST['cor_userid'];
$username = trim($_POST['cor_username']);
$datefrom = $_POST['cor_datefrom'];
$dateto = $_POST['cor_dateto'];
$autoCheck = $_POST['cor_autoanswer'];
$repl_msg = preg_replace('/\r\n/','<br />',$_POST['field_TtextAutoLetter']);
$bcc_names = $username.'@bioline.ru';
$bcc_maps = $username.'@autoreply.bioline.ru';

//--Params-----------------------------

//print_r($_GET);

//--AutoAnswer


foreach($_POST as $key => $arGet){
	if (preg_match("/_alias_/", $key)) {
		$aliasArr[$key] = $arGet;
	}
}

//print_r($aliasArr);


$count=0;

foreach($aliasArr as $key=>$items){
		if($items == null){
			unset($aliasArr[$key]);
		}
	
}

//--AutoAnswer



if($autoCheck=='1'){
	$autoCheck='1';
}else{
	$autoCheck='0';
}


/*if($autoCheck=='1'){
	foreach($aliasArr as $key=>$items){
		if(preg_match("/@autoreply/", $items)){
			$email = '';
				break;
		}else{
			$email = $username . '@autoreply.bioline.ru, ';
				break;
		}
	}
}else{
	$noAutoCheck = '1';
}*/

foreach($aliasArr as $items){
$count++;
	if(count($aliasArr)==$count){
		$email .= trim($items);
	}else{
		$email .= trim($items) .', ';	
	}
}


class mainpage_query{
	public $arrBest;
	public $db;
	public $dbIt;
	function __construct(){
		$this->db = new Database();
		$this->dbIt = new DatabaseItDept();
	}
	function getAllfromtable($user_id,$username,$datefrom,$email,$datefrom,$dateto){
		$sql = 'UPDATE aliases SET username=:username, alias=:alias, aliasdatefrom=:aliasdatefrom, aliasdateto=:aliasdateto WHERE alias_id=:alias_id';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':username'=>$username,':alias'=>$email, ':aliasdatefrom'=>date('Y-m-d',strtotime($datefrom)),':aliasdateto'=>date('Y-m-d',strtotime($dateto)),':alias_id'=>$user_id));
	}
	function writeInAutoReply($username,$bcc_maps,$repl_msg,$autoCheck){
		$sql = 'INSERT INTO bcc (`bcc_name`,`bcc_maps`,`bcc_autoreply_text`,`active`) VALUES (:reply_login,:bcc_maps,:reply_msg,:active_chk)';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':reply_login'=>$username,':bcc_maps'=>$bcc_maps,':reply_msg'=>$repl_msg,':active_chk'=>$autoCheck));
	}
	function checkIfExAutoReply($username){
		$sql = 'SELECT `bcc_id` FROM bcc WHERE bcc_name = :reply_login';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':reply_login'=>$username));
		$this->arrCheckRepl = $tb->fetch(PDO::FETCH_ASSOC);
		return $this->arrCheckRepl;
	}
	function UpdAutoReply($username,$repl_msg){
		$sql = 'UPDATE bcc SET bcc_autoreply_text=:reply_msg WHERE bcc_name = :reply_login';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':reply_login'=>$username,':reply_msg'=>$repl_msg));
	}
	function ChangeChk($username,$autoCheck){
		$sql = 'UPDATE bcc SET active=:active_chk WHERE bcc_name = :reply_login';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':reply_login'=>$username,':active_chk'=>$autoCheck));
	}
	function writeLoging($inneruserId,$rzlt){
		$sql = 'INSERT INTO loging (`tmlog`,`login_id`,`moving`,`rzlt`,`vargroup`,`ipuser`) VALUES (NOW(),:login_id,"редактирование",:rzlt,"2","'.$_SERVER["REMOTE_ADDR"].'")';
		$tb = $this->dbIt->connection->prepare($sql);
		$tb->execute(array(':login_id'=>$inneruserId,':rzlt'=>$rzlt));
	}	
}

$getData = new mainpage_query();
$arrLogin = $getData ->getAllfromtable($user_id,$username,$datefrom,$email,$datefrom,$dateto);

$getData ->writeLoging($_SESSION['user_id'],$username);

//--auto replay msg
	$arrCheck = $getData ->checkIfExAutoReply($bcc_names);
		if($arrCheck['bcc_id']){
			if(!$repl_msg==''){
				$getData ->UpdAutoReply($bcc_names,$repl_msg);
			}
			$arrChkBox = $getData -> ChangeChk($bcc_names,$autoCheck);
		}else{
			$arrInsertRepl = $getData ->writeInAutoReply($bcc_names,$bcc_maps,$repl_msg,$autoCheck);
		}		

?>