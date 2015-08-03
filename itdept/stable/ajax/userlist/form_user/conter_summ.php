<?
require '../../../../../ajax/db.php';
$db = new DatabaseItDept();

$sql = 'SELECT COUNT(staff_id) as DbSumm FROM staff';
$tb = $db->connection->prepare($sql);
$tb->execute();
$CountAll = $tb->fetch(PDO::FETCH_ASSOC);

$sql = 'SELECT COUNT(staff_id) as DbSumm FROM staff WHERE staff_typedeactive = "0" OR staff_typedeactive = "1"';
$tb = $db->connection->prepare($sql);
$tb->execute();
$CountDeactive = $tb->fetch(PDO::FETCH_ASSOC);

$sql = 'SELECT COUNT(staff_id) as DbSumm FROM staff WHERE staff_active = 0 AND staff_datedeactive = "0000-00-00 00:00:00" AND staff_typedeactive = ""';
$tb = $db->connection->prepare($sql);
$tb->execute();
$CountWaiting = $tb->fetch(PDO::FETCH_ASSOC);

$sql = 'SELECT COUNT(staff_id) as DbSumm FROM staff WHERE staff_active = 1 AND staff_datedeactive = "0000-00-00 00:00:00" AND staff_typedeactive = ""';
$tb = $db->connection->prepare($sql);
$tb->execute();
$CountActive = $tb->fetch(PDO::FETCH_ASSOC);

$arrSumm['summer']['deactive'] = $CountDeactive['DbSumm'];
$arrSumm['summer']['active'] = $CountActive['DbSumm'];
$arrSumm['summer']['waiting'] = $CountWaiting['DbSumm'];
$arrSumm['summer']['all'] = $CountAll['DbSumm'];

echo json_encode($arrSumm);
?>