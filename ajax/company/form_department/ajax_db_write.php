<?
session_start();

//--mail DB
//require '../../db.php';

//--itdept DB
require '../../db.php';
require 'arrFields.php';


$db = new DatabaseItDept();

$sql = 'INSERT INTO department (`company_id`,`department_name`) VALUES (:company_id,:department_name)';
$tb = $db->connection->prepare($sql);
$tb->execute(array(':company_id'=>$_POST['comp_compn'],':department_name'=>$_POST['comp_depart']));


?>