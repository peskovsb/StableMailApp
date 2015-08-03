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
if($arrLogin['user_id']){echo json_encode($arrLogin);}
?>