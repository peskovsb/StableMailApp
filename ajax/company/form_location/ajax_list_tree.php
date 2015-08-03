<?
session_start();

//--itdept DB
require '../../db.php';

$db = new DatabaseItDept();
$sql = 'SELECT * FROM department WHERE company_id = :company_id';
$tb = $db->connection->prepare($sql);
$tb->execute(array(':company_id'=>$_POST['compId']));
$arrAll = $tb->fetchAll(PDO::FETCH_ASSOC);
echo '<pre>';
	print_r($arrAll);
echo '</pre>';
?>