<?
require '../../db.php';
$db = new DatabaseItDept();
$sql = 'DELETE FROM location WHERE location_id = :location_id';
$tb = $db->connection->prepare($sql);
$tb->execute(array(':location_id'=>$_POST['dep_id']));
?>