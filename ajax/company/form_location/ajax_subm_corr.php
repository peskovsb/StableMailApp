<?
require '../../db.php';
$db = new DatabaseItDept();
$sql = 'UPDATE location SET location_name=:location_name, location_subnetwork=:location_subnetwork WHERE location_id = :location_id';
$tb = $db->connection->prepare($sql);
$tb->execute(array(':location_id'=>$_POST['dep_id'],':location_name'=>$_POST['fld-name-location-cor'],':location_subnetwork'=>$_POST['fld-subn-location-cor']));
?>