<?
session_start();
require 'db.php';
require 'secfile.php';


$db = new Database();
$sql = 'SELECT user_id,email as value FROM users WHERE email LIKE :email';
	$tb = $db->connection->prepare($sql);
	$tb->execute(array(':email'=>$_GET['term'].'%'));
	$arrData = $tb->fetchAll(PDO::FETCH_ASSOC);
	
	//echo '<pre>';print_r($arrData);	echo '</pre>';
	echo json_encode($arrData);
?>