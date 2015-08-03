<?
require '../../db.php';

if($_GET['showalllist']){
	$sql = 'SELECT * FROM inner_users ORDER BY user_id DESC';
}else{		
	$sql = 'SELECT * FROM inner_users ORDER BY user_id DESC LIMIT 5';
}

class mainpage_query{
	public $arrBest;
	public $arrCheckRepl;
	public $db;
	function __construct(){
		$this->db = new DatabaseItDept();
	}

	function getDatafromtable($sql){
		//$sql = 'SELECT * FROM inner_users ORDER BY user_id DESC LIMIT 5';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute();
		$this->arrBest = $tb->fetchAll(PDO::FETCH_ASSOC);
		return $this->arrBest;
	}		
}
$getData = new mainpage_query();

$getter = $getData ->getDatafromtable($sql);

echo json_encode($getter);
?>