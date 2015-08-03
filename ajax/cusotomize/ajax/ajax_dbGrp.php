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
$grp_correct3 = trim($_GET['grp-correct3']);
$grp_createuser3 = trim($_GET['grp-createuser3']);
$grp_view3 = trim($_GET['grp-view3']);


class mainpage_query{
	public $arrBest;
	public $rezArr;
	public $db;
	function __construct(){
		$this->db = new DatabaseItDept();
	}
	
	function getAllfromtable($nameGroup,$grp_createuser,$grp_view,$grp_view2,$grp_correct,$grp_correct2,$grp_createuser2,$grp_view3,$grp_correct3,$grp_createuser3){
		$sql = 'SELECT * FROM levels WHERE level_name = :level_name';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':level_name'=>$nameGroup));
		$this->arrBest = $tb->fetch(PDO::FETCH_ASSOC);
		if($this->arrBest['level_id']){
			$this->rezArr[0]['level']['exitsIU'] = 'noway';
			$this->rezArr[0]['level']['mistakeIU'] = 'mistake';
			$this->rezArr[0]['level']['msg'] = 'Такая группа уже существует';
			$mistake = 1;
		}else{
			if(preg_match("/[\s,*?&^%><+\$№#`~=!АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя]/", $nameGroup)){
				$this->rezArr[0]['level']['mistakeIU'] = 'mistake';
				$this->rezArr[0]['level']['msg'] = 'Группа не должена использовать знаки русского алфавита и различные символы';
				$mistake = 1;
			}else{
				if(strlen($nameGroup)=='0'){
					$this->rezArr[0]['level']['mistakeIU'] = 'mistake';
					$this->rezArr[0]['level']['msg'] = 'Группа не должна быть с пустым названием';
					$mistake = 1;
				}else{
					$this->rezArr[0]['level']['mistakeIU'] = 'nomistake';
				}
			}
		}
		
		if($grp_view2 != 'on' AND $grp_view != 'on' AND $grp_view3 != 'on'){
			$this->rezArr[0]['view']['mistakeIU'] = 'mistake';
			$this->rezArr[0]['view']['msg'] = 'Нужно выбрать одну из галочек просмотр';
			$mistake = 1;
		}else{
			$this->rezArr[0]['view']['mistakeIU'] = 'nomistake';
		}
			
			return $this->rezArr;	
				
	}	
}
$getData = new mainpage_query();
$arrGetter = $getData ->getAllfromtable($nameGroup,$grp_createuser,$grp_view,$grp_view2,$grp_correct,$grp_correct2,$grp_createuser2,$grp_view3,$grp_correct3,$grp_createuser3);
echo json_encode($arrGetter);



?>
