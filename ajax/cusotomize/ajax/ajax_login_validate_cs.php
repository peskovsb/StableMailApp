<?
require '../../db.php';

//--VARS
$login_request = trim($_GET['field_inner_login']);
$field_inner_pass = trim($_GET['field_inner_pass']);
$field_inner_levels = trim($_GET['field_inner_levels']);
$field_inner_surname = trim($_GET['field_inner_surname']);
$field_inner_name = trim($_GET['field_inner_name']);

/*echo '<pre>';
	print_r($_GET);
echo '</pre>';*/

class mainpage_query{
	public $arrBest;
	public $db;
	function __construct(){
		$this->db = new DatabaseItDept();
	}
	function getLoginfromtable($login_request){
		$sql = 'SELECT * FROM inner_users WHERE user_login = :login';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':login'=>$login_request));
		$this->arrBest = $tb->fetch(PDO::FETCH_ASSOC);
		return $this->arrBest;
	}
}
$getData = new mainpage_query();
$takeUser = $getData ->getLoginfromtable($login_request);

//--userPHPvalidation
if($takeUser['user_id']){
	$rezArr[0]['login']['exitsIU'] = 'noway';
	$rezArr[0]['login']['mistakeIU'] = 'mistake';
	$rezArr[0]['login']['msg'] = 'Такой логин уже есть в системе';
}else{
	$rezArr[0]['login']['exitsIU'] = 'goyes';
		if(preg_match("/[\s,*?&^%><+\$№#`~=!АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя]/", $login_request)){
			$rezArr[0]['login']['mistakeIU'] = 'mistake';
			$rezArr[0]['login']['msg'] = 'Логин не должен использовать знаки русского алфавита и различные символы';
		}else{
			$rezArr[0]['login']['mistakeIU'] = 'nomistake';
		}
}

//--PassPHPvalidation
if(preg_match("/[\s,*?&^%><+\$№#`~=!АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя]/", $field_inner_pass)){
	$rezArr[0]['pass']['mistakeIU'] = 'mistake';
	$rezArr[0]['pass']['msg'] = 'Пароль не должен использовать знаки русского алфавита и различные символы';
}else{
	if(strlen($field_inner_pass)>'0' AND strlen($field_inner_pass)<='5'){
		$rezArr[0]['pass']['mistakeIU'] = 'mistake';
		$rezArr[0]['pass']['msg'] = 'Пароль должен быть равен, либо длинее 6 знаков';
	}else{
		$rezArr[0]['pass']['mistakeIU'] = 'nomistake';
	}
}

//--LastNPHPvalidation
if(preg_match("/[,\*?&^%><+\$#`~=!]/", $field_inner_surname)){
	$rezArr[0]['last']['mistakeIU'] = 'mistake';
	$rezArr[0]['last']['msg'] = 'Фамилия не должна иметь запрещенные символы';
}else{
	$rezArr[0]['last']['mistakeIU'] = 'nomistake';
}

//--FirstNPHPvalidation
if(preg_match("/[,\*?&^%><+\$#`~=!]/", $field_inner_name)){
	$rezArr[0]['first']['mistakeIU'] = 'mistake';
	$rezArr[0]['first']['msg'] = 'Имя не должно иметь запрещенные символы';
}else{
	$rezArr[0]['first']['mistakeIU'] = 'nomistake';
}

echo json_encode($rezArr);
?>