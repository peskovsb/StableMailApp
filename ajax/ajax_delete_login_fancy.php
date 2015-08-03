<?
session_start();
require 'db.php';
require 'secfile.php';
if($userLevel['oper_correct_post']==0){
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
		$sql = 'SELECT * FROM users WHERE user_id = :user_id';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':user_id'=>$param));
		$this->arrBest = $tb->fetch(PDO::FETCH_ASSOC);
		return $this->arrBest;
	}
}

$getData = new mainpage_query();
$arrLogin = $getData ->getAllfromtable($param);
?>

<div class="delete-user-fancy-box" style="width:260px;">
	<div class="header-delete-user-fancybox">Вы уверены, что хотите удалить именно этого пользователя?</div>
	<div class="result-blocks"><b>id пользователя: </b><b style="color:#0044cc"><?=$arrLogin['user_id']?></b></div>
	<div class="result-blocks"><b>login: </b> <b style="color:#0044cc"><?=$arrLogin['login']?></b></div>
	<div class="result-blocks"><b>email:</b> <b style="color:#c11"><?=$arrLogin['email']?></b></div>
	<div class="btns-fin-container">
		<a class="dellFinUser" onclick="funcDelUser('<?=$arrLogin['user_id']?>');" href="javascript:void(0);">Уалить</a> <a onclick="$.fancybox({ closeClick  : true});" class="NotToDell" href="javascript:void(0);">Отмена</a>
	</div>
</div>