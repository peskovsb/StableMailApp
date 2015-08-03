<?
//require 'login/login.php';

$SecDB = new DatabaseItDept();
$sql = 'SELECT * FROM inner_users WHERE user_id = :user_login';
$tb = $SecDB->connection->prepare($sql);
$tb->execute(array('user_login'=>$_SESSION['user_id']));
$userLevel = $tb->fetch(PDO::FETCH_ASSOC);

$sql = 'SELECT * FROM levels WHERE level_id = :level_id';
$tb = $SecDB->connection->prepare($sql);
$tb->execute(array('level_id'=>$userLevel['user_level']));
$userLevel = $tb->fetch(PDO::FETCH_ASSOC);

$sql = 'SELECT * FROM operations WHERE oper_connect_id = :oper_connect_id';
$tb = $SecDB->connection->prepare($sql);
$tb->execute(array('oper_connect_id'=>$userLevel['level_id']));
$userLevel = $tb->fetch(PDO::FETCH_ASSOC);

/*echo '<pre>';
	print_r($userLevel);
echo '</pre>';*/
?>