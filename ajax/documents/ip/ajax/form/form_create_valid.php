<?
require '../../../../db.php';
$db = new DatabaseItDept();
$sql = 'SELECT * FROM ip LEFT JOIN comp ON ip.comp_id = comp.comp_id LEFT JOIN staff ON ip.staff_id = staff.staff_id LEFT JOIN location ON location.location_id = staff.staff_location WHERE location.location_id = :location_id AND ip.ip = :ip;';
$tb = $db->connection->prepare($sql);
$tb->execute(array(':ip'=>$_POST['ip_ip_id'],':location_id'=>$_POST['ip_location']));
$arrAll = $tb->fetch(PDO::FETCH_ASSOC);

if(strlen($_POST['ip_ip_id'])>0 AND $_POST['ip_ip_id']!=0){
    if($arrAll['ip_id']){
            $rezArr[0]['ip_ip']['mistakeIU'] = 'mistake';
            $rezArr[0]['ip_ip']['msg'] = 'Такой IP уже используется';
    }else{
        $rezArr[0]['ip_ip']['mistakeIU'] = 'nomistake';
    }
}else{
    $rezArr[0]['ip_ip']['mistakeIU'] = 'mistake';
    $rezArr[0]['ip_ip']['msg'] = 'Поле не должно быть пустым';
}
//echo '<pre>'; print_r($arrAll);echo '</pre>';
echo json_encode($rezArr);

?>