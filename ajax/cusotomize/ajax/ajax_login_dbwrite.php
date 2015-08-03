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
$login_request = trim($_GET['field_inner_login']);
$field_inner_pass = trim($_GET['field_inner_pass']);
$field_inner_levels = trim($_GET['field_inner_levels']);
$field_inner_surname = trim($_GET['field_inner_surname']);
$field_inner_name = trim($_GET['field_inner_name']);

$salt = generateSalt();
$pass_write = md5(md5($field_inner_pass).$salt);

class mainpage_query{
	public $arrBest;
	public $arrCheckRepl;
	public $db;
	function __construct(){
		$this->db = new DatabaseItDept();
	}
	
	function getAllfromtable($login_request,$pass_write,$field_inner_levels,$salt,$field_inner_surname,$field_inner_name){
		$sql = 'INSERT INTO inner_users (`user_login`,`user_pass`,`active`,`user_level`,`user_datereg`,`salt`,`user_name`,`user_surname`) VALUES (:username,:pass,1,:user_level,NOW(),:salt,:user_name,:user_surname)';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':username'=>$login_request,':pass'=>$pass_write,':user_level'=>$field_inner_levels,':salt'=>$salt,':user_name'=>$field_inner_name,':user_surname'=>$field_inner_surname));
	}	
	function getDatafromtable($login_request){
		$sql = 'SELECT * FROM inner_users WHERE user_login = :login ORDER BY user_id DESC';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':login'=>$login_request));
		$this->arrBest = $tb->fetch(PDO::FETCH_ASSOC);
		return $this->arrBest;
	}	
	function getDataGrps($grpLevel){
		$sql = 'SELECT * FROM levels WHERE level_id = :level';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':level'=>$grpLevel));
		$this->arrBest = $tb->fetch(PDO::FETCH_ASSOC);
		return $this->arrBest;
	}		
}
$getData = new mainpage_query();
$arrLogin = $getData ->getAllfromtable($login_request,$pass_write,$field_inner_levels,$salt,$field_inner_surname,$field_inner_name);

$getter = $getData ->getDatafromtable($login_request);
$getterGrp = $getData ->getDataGrps($getter['user_level']);
?>

<!-- Rezult adding to the DB Showing -->
<div class="content-wrapper-alias" style="display: block;">
<h1 class="result-header">Рузультат добавления в базу данных</h1>

	<div class="result-blocks"><b>id пользователя: </b><b style="color:#0044cc"><?=$getter['user_id']?></b></div>
	<div class="result-blocks"><b>username: </b><?=$getter['user_login']?></div>
	<div class="result-blocks"><b>Фамилия: </b><?=$getter['user_surname']?></div>
	<div class="result-blocks"><b>Имя: </b><?=$getter['user_name']?></div>
	<div class="result-blocks"><b>Уровень: </b><?=$getterGrp['level_name']?></div>
</div>