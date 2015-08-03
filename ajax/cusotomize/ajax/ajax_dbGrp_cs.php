<?
require '../../db.php';



//--VARS
$nameGroup = trim($_GET['nameGroup']);
$grp_createuser = trim($_GET['grp-createuser']);
$grp_view = trim($_GET['grp-view']);
$grp_view2 = trim($_GET['grp-view2']);
$grp_correct = trim($_GET['grp-correct']);
$grp_correct2 = trim($_GET['grp-correct2']);
$grp_createuser2 = trim($_GET['grp-createuser2']);


class mainpage_query{
	public $arrBest;
	public $rezArr;
	public $db;
	function __construct(){
		$this->db = new DatabaseItDept();
	}
	
	function getAllfromtable($nameGroup,$grp_createuser,$grp_view,$grp_view2,$grp_correct,$grp_correct2,$grp_createuser2){
		$sql = 'SELECT * FROM levels WHERE level_name = :level_name';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':level_name'=>$nameGroup));
		$this->arrBest = $tb->fetch(PDO::FETCH_ASSOC);
		if($this->arrBest['level_id']){
			$this->rezArr[0]['level']['exitsIU'] = 'noway';
			$this->rezArr[0]['level']['mistakeIU'] = 'mistake';
			$this->rezArr[0]['level']['msg'] = 'Такая группа уже существует';
		}else{
			if(preg_match("/[\s,*?&^%><+\$№#`~=!АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя]/", $nameGroup)){
				$this->rezArr[0]['level']['mistakeIU'] = 'mistake';
				$this->rezArr[0]['level']['msg'] = 'Группа не должена использовать знаки русского алфавита и различные символы';
			}else{
				$this->rezArr[0]['level']['mistakeIU'] = 'nomistake';
			}
		}
		return $this->rezArr;
	}	
/*		function getDatafromtable($login_request){
		$sql = 'SELECT * FROM inner_users WHERE user_login = :login ORDER BY user_id DESC';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':login'=>$login_request));
		$this->arrBest = $tb->fetch(PDO::FETCH_ASSOC);
		return $this->arrBest;
	}	*/	
}
$getData = new mainpage_query();
$arrGetter = $getData ->getAllfromtable($nameGroup,$grp_createuser,$grp_view,$grp_view2,$grp_correct,$grp_correct2,$grp_createuser2);
echo json_encode($arrGetter);



?>
