<?
require '../../../../db.php';
$db = new DatabaseItDept();
$sql = 'SELECT * FROM ip LEFT JOIN comp ON ip.comp_id = comp.comp_id LEFT JOIN staff ON ip.staff_id = staff.staff_id LEFT JOIN location ON location.location_id = staff.staff_location WHERE location.location_id = :location_id AND ip.ip = :ip;';
$tb = $db->connection->prepare($sql);
$tb->execute(array(':ip'=>$_POST['ip_ip_id'],':location_id'=>$_POST['ip_location']));
$arrAll = $tb->fetch(PDO::FETCH_ASSOC);

$mistake = 0;
if(strlen($_POST['ip_ip_id'])>0 AND $_POST['ip_ip_id']!=0){
    if($arrAll['ip_id']){
            $mistake = 1;
    }else{
        $mistake = 0;
    }
}else{
    $mistake = 1;
}

if($mistake!=1) {
    $sql = 'INSERT INTO ip (ip,comp_id,staff_id) VALUES(:ip,:comp_id,:staff_id)';
    $tb = $db->connection->prepare($sql);
    $tb->execute(array(':comp_id' => $_POST['ip_comp_id'], ':staff_id' => $_POST['ip_user_id'], ':ip' => $_POST['ip_ip_id']));
}
?>
