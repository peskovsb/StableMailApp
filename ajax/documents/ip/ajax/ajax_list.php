<?
require '../../../db.php';
$db = new DatabaseItDept();

//-- Params
$prefix_tbl = 'ip';
$staff_loc = $_POST['loc'];

//*** BUILD District IPs
//--------------------------
$sql = 'SELECT * FROM location WHERE location_id = :location_id;';
$tb = $db->connection->prepare($sql);
$tb->execute(array(':location_id'=>$staff_loc));
$arrDistr = $tb->fetch(PDO::FETCH_ASSOC);

for($i=1;$i<=254;$i++){

	//*** Query to Get right USER
	//---------------------------------
	// WHERE staff.staff_location = 1 AND ip = {$this}
	$sql = 'SELECT * FROM ip LEFT JOIN comp ON ip.comp_id = comp.comp_id LEFT JOIN staff ON ip.staff_id = staff.staff_id LEFT JOIN location ON location.location_id = staff.staff_location WHERE location.location_id = :location_id AND ip.ip = :ip;';
	$tb = $db->connection->prepare($sql);
	$tb->execute(array(':location_id'=>$staff_loc,':ip'=>$i));
	$arrAll = $tb->fetch(PDO::FETCH_ASSOC);
	
	/*echo '<pre>';
		print_r($arrAll);
	echo '</pre>';	*/
?>
	<tr class="val <?=!$arrAll['ip_id']?'green-tbl-color':'blue-tbl-color'?>" data-timeStmp = "<?=strtotime('now')?>" <?=$i=='1'?'id="first-row-drawing"':''?> style="display:none;">
		<td class="<?=$prefix_tbl?>_ElementTbl-1">192.168.<?=$arrDistr["location_subnetwork"]?>.<?=$i?></td>
		<td class="<?=$prefix_tbl?>_ElementTbl-3"><?=$arrAll["comp_name"]?></td>
		<td class="<?=$prefix_tbl?>_ElementTbl-2"><?=$arrAll["staff_lastname"]?> <?=$arrAll["staff_name"]?></td>
		<td class="<?=$prefix_tbl?>_ElementTbl-5"><?=$arrAll["ip_desc"]?></td>
		<td class="<?=$prefix_tbl?>_ElementTbl-4"><?if($arrAll["ip_id"]){?><a data-ip="<?=$arrAll["ip_id"]?>" class="btn-correct-tbl corIp" href="javascript:void(0);"><i class="fa fa-wrench"></i></a><?}else{?><a data-ip="<?=$i?>" data-loc="<?=$staff_loc?>" class="btn-correct-tbl createIp" href="javascript:void(0);"><i class="fa fa-wrench"></i></a><?}?></td>
	</tr>
<?}?>	


