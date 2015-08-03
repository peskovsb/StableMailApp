<?
session_start();
require 'db.php';
require 'secfile.php';
if($userLevel['oper_correct_post']==0){
	exit;
}

$login_request = $_GET['login_request'];
$formid = $_GET['formid'];

class mainpage_query{
	public $arrBest;
	public $db;
	function __construct(){
		$this->db = new Database();
	}
	function getAllfromtable($login_request){
		$sql = 'SELECT `user_id` FROM users WHERE login = :login';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':login'=>$login_request));
		$this->arrBest = $tb->fetch(PDO::FETCH_ASSOC);
		return $this->arrBest;
	}
}
$getData = new mainpage_query();
$arrLogin = $getData ->getAllfromtable($login_request);
if($arrLogin['user_id']){
	if($formid == $arrLogin['user_id']){
		$rezArr['login'] = 'same';
	}else{
		$rezArr['login'] = 'exists';
	}
}else{
	$rezArr['login'] = 'no';
}

echo json_encode($rezArr);
?>