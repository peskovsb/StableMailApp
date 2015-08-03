<?
session_start();

//--itdept DB
require '../../db.php';

$db = new DatabaseItDept();
$sql = 'SELECT * FROM groups LEFT JOIN department ON  groups.department_id = department.department_id LEFT JOIN company ON department.company_id = company.company_id;';
$tb = $db->connection->prepare($sql);
$tb->execute();
$arrAll = $tb->fetchAll(PDO::FETCH_ASSOC);
/*echo '<pre>';
	print_r($arrAll);
echo '</pre>';*/
echo json_encode($arrAll);
?>