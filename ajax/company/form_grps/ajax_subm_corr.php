<?
require '../../db.php';
$db = new DatabaseItDept();
$sql = 'UPDATE groups SET group_name=:group_name, department_id=:department_id WHERE gr_id = :gr_id';
$tb = $db->connection->prepare($sql);
$tb->execute(array(':gr_id'=>$_POST['dep_id'],':group_name'=>$_POST['fld-name-grps-cor'], ':department_id'=>$_POST['fld-comp-grps-cor']));
?>