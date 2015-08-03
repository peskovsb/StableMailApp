<?
require '../../db.php';

function generateSalt() {
    $salt = '';
    $length = rand(5,10); // длина соли (от 5 до 10 сомволов)
    for($i=0; $i<$length; $i++) {
         $salt .= chr(rand(33,126)); // символ из ASCII-table
    }
    return $salt;
}

//--VARS
$login_request = trim($_GET['cor_login_IU']);
$loginid_before = trim($_GET['cor_userid']);
$field_inner_pass = trim($_GET['cor_changepass_IU']);
$field_inner_levels = trim($_GET['cor_level']);
$field_inner_surname = trim($_GET['cor_sername_IU']);
$field_inner_name = trim($_GET['cor_name_IU']);
$field_inner_active = trim($_GET['cor_active_IU']);

if($field_inner_active=='1'){
	$field_inner_active='1';
}else{
	$field_inner_active='0';
}



$salt = generateSalt();
$pass_write = md5(md5($field_inner_pass).$salt);

class mainpage_query{
	public $arrBest;
	public $arrCheckRepl;
	public $db;
	function __construct(){
		$this->db = new DatabaseItDept();
	}
	
	function getAllfromtable($login_request,$field_inner_levels,$field_inner_surname,$field_inner_name,$loginid_before,$field_inner_active){
		$sql = 'UPDATE inner_users SET user_login=:login, user_level=:level, user_name=:name, user_surname=:surname, active=:active WHERE user_id=:user_id';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':user_id'=>$loginid_before,':login'=>$login_request,':level'=>$field_inner_levels,':name'=>$field_inner_name,':surname'=>$field_inner_surname,':active'=>$field_inner_active));
	}
	function PassCorrect($pass_write,$loginid_before,$salt){
		$sql = 'UPDATE inner_users SET user_pass=:pass, salt=:salt WHERE user_id=:user_id';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':pass'=>$pass_write,':salt'=>$salt,':user_id'=>$loginid_before));
	}		
	function SidCorrect($loginid_before){
		$sql = 'UPDATE inner_users SET sid=1 WHERE user_id=:user_id';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':user_id'=>$loginid_before));
	}		
}
$getData = new mainpage_query();
$arrLogin = $getData ->getAllfromtable($login_request,$field_inner_levels,$field_inner_surname,$field_inner_name,$loginid_before,$field_inner_active);

//if pass strlength>5 and all the Condtions srart function

if(strlen($field_inner_pass)>5){
	$arrLogin = $getData ->PassCorrect($pass_write,$loginid_before,$salt);
}

if($field_inner_active == 0){
	$getData -> SidCorrect($loginid_before);
}

//$getter = $getData ->getDatafromtable($login_request);

/*$levels = array(
	'1'=>'admin',
	'2'=>'users'
);*/

?>