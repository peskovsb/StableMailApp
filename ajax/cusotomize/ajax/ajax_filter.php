<?
require '../../db.php';

if($_GET['pagi']){
	$pagiPage = $_GET['pagi'];
}else{
	$pagiPage = 1;
}

if($_GET['limit']){
	$limit = $_GET['limit'];
}else{
	$limit = 30;
}

class mainpage_query{
	public $arrBest;
	public $arrUserLogin;
	public $arrCheckRepl;
	public $db;
	public $pagiPage;
	public $limit;	
	function __construct($pagiPage,$limit){
		$this->db = new DatabaseItDept();
		$this->pagiPage = $pagiPage;
		$this->limit = $limit;		
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
		$this->pagiPage = ($this->pagiPage-1) * $this->limit;
		$sql = 'SELECT * FROM loging WHERE '.$strExp.' ORDER BY id DESC LIMIT '.$this->pagiPage.','.$this->limit;
		//return $sql;
		$tb = $this->db->connection->prepare($sql);
		$tb->execute($arrExc);
		$this->arrBest = $tb->fetchAll(PDO::FETCH_ASSOC);
		return $this->arrBest;
	}		
	function getUserLogin($userId){
		$sql = 'SELECT * FROM inner_users WHERE user_login LIKE :userid';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':userid'=>$userId.'%'));
		$this->arrUserLogin = $tb->fetch(PDO::FETCH_ASSOC);
		/*return count($this->arrUserLogin);
		return $this->arrUserLogin['user_id'];*/
		if($this->arrUserLogin['user_id']){
			return $this->arrUserLogin;
		}else{
			$this->arrUserLogin['user_id'] = $userId;
		}
		
	}	
	function getUserById($userid){
		$sql = 'SELECT * FROM inner_users WHERE user_id = :user_id';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':user_id'=>$userid));
		$this->arrBest = $tb->fetch(PDO::FETCH_ASSOC);
		return $this->arrBest;
	}		
}
$getData = new mainpage_query($pagiPage,$limit);


if($_GET['IU-filteruser']){
	$arrUser = $getData->getUserLogin($_GET['IU-filteruser']);
}

$arrData = $getData->getDatafromtable($_GET['IU-filtercats'],$_GET['IU-filtermoves']);

$count = 0;
foreach($arrData as $arrItems){
	$arrAll[] = $arrItems;
	if($_GET['IU-filteruser']){	
		if(!$arrAll[$count]['ipuser']){$arrAll[$count]['ipuser'] = 'NULL';} 	
		$arrAll[$count]['login_id'] = $arrUser['user_login'];
		$arrAll[$count]['login_search'] = $arrUser['user_login'];
		$arrAll[$count]['tmlog'] = date("d-m-y H:i:s",  strtotime($arrItems['tmlog']));
	}else{
		if(!$arrAll[$count]['ipuser']){$arrAll[$count]['ipuser'] = 'NULL';} 	
		$userLogin = $getData -> getUserById($arrItems['login_id']);
		$arrAll[$count]['login_id'] = $userLogin['user_login'];
		$arrAll[$count]['tmlog'] = date("d-m-y H:i:s",  strtotime($arrItems['tmlog']));
	}
			$count++;
}

if(count($arrAll)==0){
	$arrAll = array();
}



//echo $arrUser['user_login'];
//echo '<pre>';print_r($arrData);echo '</pre>';
/*$getter = $getData ->getDatafromtable($sql);

$counter = 0;
foreach($getter as $arItMs){
$userLogin = $getData -> getUserById($arItMs['login_id']);	 
		$getter[$counter]['login_id'] = $userLogin['user_login'];
		$getter[$counter]['tmlog'] = date("d/m/y H:i:s",  strtotime($arItMs['tmlog']));
	$counter ++;
}*/

echo json_encode($arrAll);
?>