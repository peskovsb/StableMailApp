<?
session_start();
require 'db.php';
require 'secfile.php';
if($userLevel['oper_create_forw']==0){
	exit;
}

$email_request = $_GET['cor_username'];
$formid = $_GET['formid'];

foreach($_GET as $key => $arGet){
	if (preg_match("/_alias_/", $key)) {
		$aliasArr[$key] = $arGet;
	}
}

/*echo '<pre>';
print_r($_GET);
echo '</pre>';*/



//--cheking emails if are the same
/*$mistakeCpounter = 0;
foreach($email as $chkEmail){
	foreach($email as $chkEmail2){
		if($chkEmail == $chkEmail2){
			$mistakeCpounter++;
		}
	}
}*/

class mainpage_query{
	public $arrBest;
	public $db;
	function __construct(){
		$this->db = new Database();
	}
	function getAllfromtable($email_request){
		$sql = 'SELECT * FROM users WHERE email = :email';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':email'=>$email_request));
		$this->arrBest = $tb->fetch(PDO::FETCH_ASSOC);
		return $this->arrBest;
	}
	function getLoginfromtable($login_request){
		$sql = 'SELECT * FROM users WHERE login = :login';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':login'=>$login_request));
		$this->arrBest = $tb->fetch(PDO::FETCH_ASSOC);
		return $this->arrBest;
	}
	function CheckUsernamefromtable($login_request){
		$sql = 'SELECT * FROM aliases WHERE username = :login';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':login'=>$login_request));
		$this->arrBest = $tb->fetch(PDO::FETCH_ASSOC);
		return $this->arrBest;
	}
}
$getData = new mainpage_query();

$cntr = 0;
$sameElements = 0;

$takeAlias = $getData ->CheckUsernamefromtable($email_request);

if($takeAlias['alias_id']){
	
	//--validation Login
	$rezArr['exitsAlias'] = 'noway';
	
}else{
	
	//--validation Aliases
	foreach($aliasArr as $key=>$arItems){
		if(preg_match("/[\s,*?&^%><+\$№#`~=!АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя]/", $arItems)){
			if($key == 'field_alias_0' AND $_GET['cor_autoanswer']=='1'){
				//nothing
			}else{
				$rezArr[$cntr]['mfadetectr'] = 'mistake';
				$rezArr[$cntr]['idsarchr'] = $key;			
			}
		}
		$sameElements = 0;
			//-- finding same elements detecting them marking as mistake
			foreach($aliasArr as $arAllInner){
				if($arItems == $arAllInner){
					$sameElements++;
					if($sameElements=='2'){
						$rezArr[$cntr]['mfadetectr'] = 'mistake';
						$rezArr[$cntr]['idsarchr'] = $key;
						$sameElements = 0;
					}
				}
			}			
	$cntr++;
	}

	if(count($rezArr) == 0){
		$rezArr['nomistakes'] = 'nomistakes';
	}


	/*if($arrLogin['user_id']){
		if($formid == $arrLogin['user_id']){
			$rezArr['login'] = 'same';
		}else{
			$rezArr['login'] = 'exists';
		}
	}else{
		$rezArr['login'] = 'no';
	}*/
}
	$arrLogin = $getData ->getLoginfromtable($email_request);
	//echo $email_request;
	if($arrLogin['user_id']){
		$rezArr['login'] = 'yeslogin';
	}else{
		$rezArr['login'] = 'nologin';
	}


echo json_encode($rezArr);
?>