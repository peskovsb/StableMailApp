<?
session_start();

//--mail DB
//require '../../db.php';

//--itdept DB
require '../../db.php';
require 'arrFields.php';


$db = new DatabaseItDept();

$sql = 'INSERT INTO groups (`department_id`,`group_name`) VALUES (:department_id,:group_name)';
$tb = $db->connection->prepare($sql);
$tb->execute(array(':department_id'=>$_POST['gr_department'],':group_name'=>$_POST['gr_grps']));


?>