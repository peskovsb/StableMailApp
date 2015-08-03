<?
session_start();

//--itdept DB
require '../../db.php';

$db = new DatabaseItDept();
$sql = 'SELECT * FROM department LEFT JOIN company using(company_id);';
$tb = $db->connection->prepare($sql);
$tb->execute();
$arrAll = $tb->fetchAll(PDO::FETCH_ASSOC);
/*echo '<pre>';
	print_r($arrAll);
echo '</pre>';*/
echo json_encode($arrAll);
?>