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
foreach($_GET as $DelUsers){
	$arrUsers[] = $getData ->getAllfromtable($DelUsers);
}

//-- make string
$cnt = 0;
$string = '';
foreach($_GET as $userDellNumbers){
$cnt++;
	if($cnt == count($_GET)){
		$string .= 'del_user_'. $cnt . '=' . $userDellNumbers;
	}else{
		$string .= 'del_user_'. $cnt . '=' . $userDellNumbers . '&' ;
	}
	
}
//echo $string;
?>

<div class="delete-user-fancy-box" style="width:260px;">
	<div class="header-delete-user-fancybox">Вы уверены, что хотите удалить именно этот список переадресаций?</div>
	<?foreach($arrUsers as $UserMassList){?>
		<div class="result-blocks">username: <b style="color:#c11"><?=$UserMassList['username']?></b></div>
	<?}?>
	<div class="btns-fin-container">
		<a class="dellFinUser" onclick="funcMassDelUserAlias('<?=$string?>');" href="javascript:void(0);">Уалить</a> <a onclick="$.fancybox({ closeClick  : true});" class="NotToDell" href="javascript:void(0);">Отмена</a>
	</div>
</div>

