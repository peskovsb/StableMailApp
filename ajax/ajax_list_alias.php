<?
require 'db.php';

//$login_request = $_GET['login_request'];

class mainpage_query{
	public $arrBest;
	public $db;
	function __construct(){
		$this->db = new Database();
	}
	function getAllfromtable(){
		$sql = 'SELECT * FROM alias';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':login'=>$login_request));
		$this->arrBest = $tb->fetchAll(PDO::FETCH_ASSOC);
		return $this->arrBest;
	}
}
$getData = new mainpage_query();
$arrLogin = $getData ->getAllfromtable();
echo json_encode($arrLogin)
?>