<?
require '../../db.php';
$db = new DatabaseItDept();
?>
<h2>Питер - Офис</h2>
<script src="../../../js/jquery-1.11.2.min.js"></script>
<?
$staff_loc = '1';

//*** BUILD District IPs
//--------------------------
$sql = 'SELECT * FROM location WHERE location_id = :location_id;';
$tb = $db->connection->prepare($sql);
$tb->execute(array(':location_id'=>$staff_loc));
$arrDistr = $tb->fetch(PDO::FETCH_ASSOC);

/*echo '<pre>';
	print_r($arrDistr);
echo '</pre>';*/



?>
<table border="1" cellpadding="5">
	<th>IP</th>
	<th>User</th>
	<th>comp_name</th>

<div id="table-drawing">

			<?for($i=1;$i<=254;$i++){?>
			<?
				//*** Query to Get right USER
				//---------------------------------
				// WHERE staff.staff_location = 1 AND ip = {$this}
				$sql = 'SELECT * FROM ip LEFT JOIN comp ON ip.comp_id = comp.comp_id LEFT JOIN staff ON ip.staff_id = staff.staff_id LEFT JOIN location ON location.location_id = staff.staff_location WHERE location.location_id = :location_id AND ip.ip = :ip;';
				$tb = $db->connection->prepare($sql);
				$tb->execute(array(':location_id'=>$staff_loc,':ip'=>$i));
				$arrAll = $tb->fetch(PDO::FETCH_ASSOC);
				/*
				echo '<pre>';
					print_r($arrAll);
				echo '</pre>';*/		
			?>
				<tr>
					<td>192.168.<?=$arrDistr["location_subnetwork"]?>.<?=$i?></td>
					<td><?=$arrAll["staff_lastname"]?> <?=$arrAll["staff_name"]?></td> 				
					<td><?=$arrAll["comp_name"]?></td>
				</tr>
			<?}?>	
<div>			
	</table>
