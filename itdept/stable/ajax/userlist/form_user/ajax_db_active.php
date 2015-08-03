<?
session_start();

//--mail DB
require '../../../../../ajax/db.php';
require '../../../../../ajax/secfile.php';

//--itdept DB
//require '../../../db.php';
require 'arrFields.php';



$db = new DatabaseItDept();

$sql = 'UPDATE staff SET staff_active=1 WHERE staff_id=:staff_id';
$tb = $db->connection->prepare($sql);
$tb->execute(array(':staff_id'=>$_POST['staff_id']));
?>