<?
session_start();
require '../db.php';
define('USERS_TABLE','inner_users');
define('SID',session_id());

class login_module{
	public $arrCheck;
	public $db;
	function __construct(){
		$this->db = new Database();
	}
	/*function checkUser($uid){
		$sql = 'SELECT `sid` FROM '.USERS_TABLE.' WHERE user_id = :user_id';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':user_id'=>$uid));
		$this->arrCheck = $tb->fetch(PDO::FETCH_ASSOC);
		return $this->arrCheck['sid']==SID ? true : false;
	}*/
	function logout() {
		unset($_SESSION['user_login']);
		unset($_SESSION['user_id']);
		unset($_SESSION['user_level']);
		unset($_SESSION['active']);
		unset($_SESSION['user_datereg']);
		unset($_SESSION['wrongpass']);
		setcookie("savelogin", "", time() - 3600); 
		setcookie("savepass", "", time() - 3600); 
		setcookie("SID", "", time() - 3600); 
		die(header('Location: '.$_SERVER['PHP_SELF']));
	}
}
class login_module_cookie{
	public $arrCheck;
	public $db;
	function __construct(){
		$this->db = new Database();
	}
	/*function checkUser($uid){
		$sql = 'SELECT `sid` FROM '.USERS_TABLE.' WHERE user_id = :user_id';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':user_id'=>$uid));
		$this->arrCheck = $tb->fetch(PDO::FETCH_ASSOC);
		return $this->arrCheck['sid']==$_COOKIE['SID'] ? true : false;
	}*/
	function logout() {
		unset($_SESSION['user_login']);
		unset($_SESSION['user_id']);
		unset($_SESSION['user_level']);
		unset($_SESSION['active']);
		unset($_SESSION['user_datereg']);
		unset($_SESSION['wrongpass']);
		setcookie("savelogin", "", time() - 3600); 
		setcookie("savepass", "", time() - 3600); 
		setcookie("SID", "", time() - 3600); 
		//die(header('Location: '.$_SERVER['PHP_SELF']));
	}
}

if($_COOKIE['savelogin'] AND $_COOKIE['savepass']){
$getData = new login_module_cookie();
//$arrCheck = $getData ->checkUser($_SESSION['user_id']);
	if(!$arrCheck){$brw['status']='other';}else{$brw['status']='OK';}
}else{
$getData = new login_module();
//$arrCheck = $getData ->checkUser($_SESSION['user_id']);
	if(!$arrCheck){$brw['status']='other';}else{$brw['status']='OK';}
}
echo json_encode($brw);
?>