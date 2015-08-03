<?
require '../../db.php';

$param = $_GET['finDel'];

class mainpage_query{
	public $arrBest;
	public $db;
	function __construct(){
		$this->db = new DatabaseItDept();
	}
	function Deletefromtable($param){
		$sql = 'DELETE FROM inner_users WHERE user_id=:user_id';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':user_id'=>$param));
	}
}


$dellData = new mainpage_query();
$dellData ->Deletefromtable($param);
?>
