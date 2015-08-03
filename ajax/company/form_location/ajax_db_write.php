<?
session_start();

//--mail DB
//require '../../db.php';

//--itdept DB
require '../../db.php';
require 'arrFields.php';

$db = new DatabaseItDept();

$sql = 'INSERT INTO location (`location_name`,`location_subnetwork`) VALUES (:location,:location_subnetwork)';
$tb = $db->connection->prepare($sql);
$tb->execute(array(':location'=>$_POST['loca_location'],':location_subnetwork'=>$_POST['cr-loc-subnet']));
?>