<?
require '../../db.php';
$db = new DatabaseItDept();
$sql = 'DELETE FROM groups WHERE gr_id = :gr_id';
$tb = $db->connection->prepare($sql);
$tb->execute(array(':gr_id'=>$_POST['dep_id']));
?>