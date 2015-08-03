<?
require '../../db.php';



class mainpage_CountDB{
	public $arrC;
	public $arrBest;
	public $db;
	function __construct(){
		$this->db = new DatabaseItDept();
	}
	function getDatafromtable($varCat,$varMove){
	$arrMove = array(
		'1'=>'создание',
		'2'=>'множественное удаление',
		'3'=>'удаление',
		'4'=>'блокирование',
		'5'=>'редактирование',
	);	
	$counter = 0;
	$strExp = '';
		if($this->arrUserLogin['user_id']){
				if($counter !=0){
					$strExp .= ' AND login_id = :user_id';
					$passed = 1;
				}else{
					$strExp = 'login_id = :user_id';
					$passed = 1;
				}
				$arrExc['user_id'] = $this->arrUserLogin['user_id'];
			$counter ++;
		}

		if($varMove!=0){
			if($counter !=0){
				$strExp .= ' AND moving = :varMove';
				$passed = 1;
			}else{
				$strExp = 'moving = :varMove';
				$passed = 1;
			}
			$arrExc['varMove'] = $arrMove[$varMove];
			$counter ++;
		}
		if($varCat!=0){
			if($counter !=0){
				$strExp .= ' AND vargroup = :varCat';
				$passed = 1;
			}else{
				$strExp = 'vargroup = :varCat';
				$passed = 1;
			}
			$arrExc['varCat'] = $varCat;
			$counter ++;
		}		
		$sql = 'SELECT COUNT(id) as DbSumm FROM loging WHERE '.$strExp;
		//return $sql;
		$tb = $this->db->connection->prepare($sql);
		$tb->execute($arrExc);
		$this->arrBest = $tb->fetch(PDO::FETCH_ASSOC);
		return $this->arrBest;
	}
	function getSumm(){
		$sql = 'SELECT COUNT(id) as DbSumm FROM loging';
	
		$tb = $this->db->connection->prepare($sql);
		$tb->execute();
		$this->arrC = $tb->fetch(PDO::FETCH_ASSOC);
		return $this->arrC;
	}
	function getUserLogin($userId){
		$sql = 'SELECT * FROM inner_users WHERE user_login LIKE :userid';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':userid'=>$userId.'%'));
		$this->arrUserLogin = $tb->fetch(PDO::FETCH_ASSOC);
	}		
}

//-- We count DB for DESC
$getSumm = new mainpage_CountDB();

if($_GET['IU-filteruser']){
	$arrUser = $getSumm->getUserLogin($_GET['IU-filteruser']);	
}

if($_GET['IU-filtercats'] OR $_GET['IU-filtermoves']){
	$BDsumm = $getSumm -> getDatafromtable($_GET['IU-filtercats'],$_GET['IU-filtermoves']);
}else{
	if($_GET['IU-filteruser']){
		$BDsumm = $getSumm -> getDatafromtable($_GET['IU-filtercats'],$_GET['IU-filtermoves']);
	}else{
		$BDsumm = $getSumm -> getSumm();
	}
}

echo json_encode($BDsumm)
?>