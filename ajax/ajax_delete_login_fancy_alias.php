<?
session_start();
require 'db.php';
require 'secfile.php';
if($userLevel['oper_correct_forw']==0){
	exit;
}

$param = $_GET['delParam'];

class mainpage_query{
	public $arrBest;
	public $db;
	function __construct(){
		$this->db = new Database();
	}
	function getAllfromtable($param){
		$sql = 'SELECT * FROM aliases WHERE alias_id = :alias_id';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':alias_id'=>$param));
		$this->arrBest = $tb->fetch(PDO::FETCH_ASSOC);
		return $this->arrBest;
	}
}

$getData = new mainpage_query();
$arrLogin = $getData ->getAllfromtable($param);
?>

<div class="delete-user-fancy-box" style="width:260px;">
	<div class="header-delete-user-fancybox">Вы уверены, что хотите удалить именно эту переадресацию?</div>
	<div class="result-blocks"><b>id: </b><b style="color:#0044cc"><?=$arrLogin['alias_id']?></b></div>
	<div class="result-blocks"><b>username: </b> <b style="color:#0044cc"><?=$arrLogin['username']?></b></div>
	<div class="result-blocks" style="width: 280px;"><b>alias:</b> <b style="color:#c11"><?=$arrLogin['alias']?></b></div>
	<div class="btns-fin-container">
		<a class="dellFinUser" onclick="funcDelUserAlias('<?=$arrLogin['alias_id']?>');" href="javascript:void(0);">Уалить</a> <a onclick="$.fancybox({ closeClick  : true});" class="NotToDell" href="javascript:void(0);">Отмена</a>
	</div>
</div>