<?
require '../../../db.php';
$db = new DatabaseItDept();
$sql = 'SELECT * FROM location WHERE location_id = :location_id';
$tb = $db->connection->prepare($sql);
$tb->execute(array(':location_id'=>$_POST['loc']));
$arrDistr = $tb->fetch(PDO::FETCH_ASSOC);

for($i=1;$i<=254;$i++){
    //*** Query to Get right USER
    //---------------------------------
    // WHERE staff.staff_location = 1 AND ip = {$this}
    $sql = 'SELECT * FROM ip LEFT JOIN comp ON ip.comp_id = comp.comp_id LEFT JOIN staff ON ip.staff_id = staff.staff_id LEFT JOIN location ON location.location_id = staff.staff_location WHERE location.location_id = :location_id AND ip.ip = :ip;';
    $tb = $db->connection->prepare($sql);
    $tb->execute(array(':location_id'=>$_POST['loc'],':ip'=>$i));
    $arrAll = $tb->fetch(PDO::FETCH_ASSOC);
    echo '<Pre>';print_r($arrAll);echo '</pre>';
    if(!$arrAll["ip_id"]){
        ?>
        <option value="<?=$i?>">192.168.<?=$arrDistr['location_subnetwork']?>.<?=$i?></option>
    <?}
}?>
