<?
require 'db.php';

$login_request = $_GET['login_request'];

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
if(!$arrLogin['user_id']){
	$dishmatch[1]['dismatch'] = 'dismatch';
	$dishmatch[1]['check'] = '0';
	echo json_encode($dishmatch);
}else{
	$dishmatch[1]['dismatch'] = 'match';
	$dishmatch[1]['check'] = '1';
	echo json_encode($dishmatch);
}
?>