<?
require '../../db.php';
$db = new DatabaseItDept();
$sql = 'UPDATE department SET department_name=:department_name, company_id=:company_id WHERE department_id = :department_id';
$tb = $db->connection->prepare($sql);
$tb->execute(array(':department_id'=>$_POST['dep_id'],':company_id'=>$_POST['fld-comp-department-cor'],':department_name'=>$_POST['fld-dep-department-cor']));
?>