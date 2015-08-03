<?
require '../../db.php';
$db = new DatabaseItDept();
$sql = 'DELETE FROM department WHERE department_id = :department_id';
$tb = $db->connection->prepare($sql);
$tb->execute(array(':department_id'=>$_POST['dep_id']));
?>