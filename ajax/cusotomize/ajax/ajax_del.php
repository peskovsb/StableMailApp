<?
require '../../db.php';

$user_id = $_GET['delParam'];

class mainpage_query{
	public $arrBest;
	public $arrCheckRepl;
	public $db;
	function __construct(){
		$this->db = new DatabaseItDept();
	}

	function getDatafromtable($login_request){
		$sql = 'SELECT * FROM inner_users WHERE user_id = :loginID';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':loginID'=>$login_request));
		$this->arrBest = $tb->fetch(PDO::FETCH_ASSOC);
		return $this->arrBest;
	}		
}
$getData = new mainpage_query();

$getter = $getData ->getDatafromtable($user_id);
?>

<!-- Rezult adding to the DB Showing -->
<div class="delete-user-fancy-box" style="width:260px;">
	<div class="header-delete-user-fancybox">Вы уверены, что хотите удалить именно этого пользователя?</div>
	<div class="result-blocks"><b>id пользователя: </b><b style="color:#0044cc"><?=$getter['user_id']?></b></div>
	<div class="result-blocks"><b>login: </b> <b style="color:#0044cc"><?=$getter['user_login']?></b></div>
	<div class="result-blocks"><b>ФИО:</b> <b style="color:#c11"><?=$getter['user_surname']?> <?=$getter['user_name']?></b></div>
	<div class="btns-fin-container">
		<a class="dellFinUser" onclick="funcDelUserIE('<?=$getter['user_id']?>');" href="javascript:void(0);">Уалить</a> <a onclick="$.fancybox({ closeClick  : true});" class="NotToDell" href="javascript:void(0);">Отмена</a>
	</div>
</div>