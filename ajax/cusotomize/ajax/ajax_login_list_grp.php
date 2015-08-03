<?
require '../../db.php';

$showlist = $_GET['showalllist'];

/*if($_GET['showalllist']){
	$sql = 'SELECT * FROM inner_users ORDER BY user_id DESC';
}else{		
	$sql = 'SELECT * FROM inner_users ORDER BY user_id DESC LIMIT 5';
}*/

class mainpage_query{
	public $arrBest;
	public $arrChecked;
	public $arrModify;
	public $db;
	function __construct(){
		$this->db = new DatabaseItDept();
	}

	function getDatafromtable($showlist){
		if($showlist){
			$sql = 'SELECT * FROM levels ORDER BY level_id DESC';
		}else{		
			$sql = 'SELECT * FROM levels ORDER BY level_id DESC LIMIT 5';
		}
		$tb = $this->db->connection->prepare($sql);
		$tb->execute();
		$this->arrBest = $tb->fetchAll(PDO::FETCH_ASSOC);
		$count = 0;
		$this->arrModify = $this->arrBest;
		foreach($this->arrBest as $Items){
			$sql = 'SELECT * FROM operations WHERE oper_connect_id = :oper_id';
			$tb = $this->db->connection->prepare($sql);
			$tb->execute(array(':oper_id'=>$Items['level_id']));
			$this->arrChecked = $tb->fetch(PDO::FETCH_ASSOC);
			
			
			$this->arrModify[$count]['oper_create_post'] = $this->arrChecked['oper_create_post'];
			$this->arrModify[$count]['oper_view_post'] = $this->arrChecked['oper_view_post'];
			$this->arrModify[$count]['oper_correct_post'] = $this->arrChecked['oper_correct_post'];
			$this->arrModify[$count]['oper_create_forw'] = $this->arrChecked['oper_create_forw'];
			$this->arrModify[$count]['oper_view_forw'] = $this->arrChecked['oper_view_forw'];
			$this->arrModify[$count]['oper_correct_forw'] = $this->arrChecked['oper_correct_forw'];
			$this->arrModify[$count]['komment_group'] = $this->arrChecked['komment_group'];
			$count++;
		}
		return $this->arrModify;
	}	
}
$getData = new mainpage_query();

$getter = $getData ->getDatafromtable($showlist);

echo json_encode($getter);
?>