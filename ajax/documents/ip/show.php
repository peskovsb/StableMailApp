<?
require '../left-menu.php';
require '../../db.php';
require '../../../itdept/stable/ajax/userlist/form_user/pref_comp.php';
$db = new DatabaseItDept();
$sql = 'SELECT * FROM location';
$tb = $db->connection->prepare($sql);
$tb->execute();
$arrDistr = $tb->fetchAll(PDO::FETCH_ASSOC);
//echo '<pre>';print_r($arrLoc);echo '</pre>';

$sql = 'SELECT * FROM comp';
$tb = $db->connection->prepare($sql);
$tb->execute();
$arrComp = $tb->fetchAll(PDO::FETCH_ASSOC);
?>
<?$prefix_tbl = 'ip';?>
<style>
.table-tpl .<?=$prefix_tbl?>_ElementTbl-1{width:12%}
.table-tpl .<?=$prefix_tbl?>_ElementTbl-2{width:30%}
.table-tpl .<?=$prefix_tbl?>_ElementTbl-3{width:18%}
.table-tpl .<?=$prefix_tbl?>_ElementTbl-4{width:10%}
.table-tpl .<?=$prefix_tbl?>_ElementTbl-5{width:30%}
</style>
<div class="round-wrapper">
<form id="field-add-Ip">
	<select name="takeLoc" id="ipLocation" class="staff_sel-page-wrap-opt" style="margin-bottom: 3px;margin-top: 3px;
">
		<?
		$counter = 0;
		foreach($arrDistr as $Items){?>
			<?if($Items['location_subnetwork']>=0 AND $Items['location_subnetwork']!=''){?>
				<?$counter++;
				if($counter == 1){
					$getFirstSubnetwork = $Items['location_subnetwork'];
					$getFirstIdLocation = $Items['location_id'];
				}
				?>

				<option value="<?=$Items["location_id"]?>"><?=$Items["location_name"]?></option>
			<?}?>
		<?}?>
	</select>
<?
$sql = 'SELECT * FROM staff WHERE staff_location = :staff_location';
$tb = $db->connection->prepare($sql);
$tb->execute(array(':staff_location'=>$getFirstIdLocation));
$arrStaff = $tb->fetchAll(PDO::FETCH_ASSOC);
//echo '<pre>';print_r($arrLoc);echo '</pre>';
?>
		<input type="hidden" name="loc_id" value="<?=$getFirstIdLocation?>">
		<select name="ipFreeIp" id="ipFreeIp" class="staff_sel-page-wrap-opt" style="margin-right:10px;">
		<?
		for($i=1;$i<=254;$i++){

		//*** Query to Get right USER
		//---------------------------------
		// WHERE staff.staff_location = 1 AND ip = {$this}
		$sql = 'SELECT * FROM ip LEFT JOIN comp ON ip.comp_id = comp.comp_id LEFT JOIN staff ON ip.staff_id = staff.staff_id LEFT JOIN location ON location.location_id = staff.staff_location WHERE location.location_id = :location_id AND ip.ip = :ip;';
		$tb = $db->connection->prepare($sql);
		$tb->execute(array(':location_id'=>$getFirstIdLocation,':ip'=>$i));
		$arrAll = $tb->fetch(PDO::FETCH_ASSOC);
			echo '<Pre>';print_r($arrAll);echo '</pre>';
			if(!$arrAll["ip_id"]){
			?>
				<option value="<?=$i?>">192.168.<?=$getFirstSubnetwork?>.<?=$i?></option>
			<?}
		}?>
		</select>
		<select name="ipCompCreate" id="ipCompCreate" class="staff_sel-page-wrap-opt" style="margin-right: 10px">
			<option value="0">-- Компьютер --</option>
			<?foreach($arrComp as $comp){?>
				<option value="<?=$comp['comp_id']?>"><?=$comp['comp_name']?></option>
			<?}?>
		</select>
		<select name="ipStaffUser" id="ipStaffUser" class="staff_sel-page-wrap-opt" style="width:167px;margin-right: 10px;">
			<option value="0">-- Сотрудник --</option>
			<?foreach($arrStaff as $StItems){?>
				<option value="<?=$StItems['staff_id']?>"><?=$StItems['staff_lastname']?> <?=$StItems['staff_name']?> <?=$StItems['staff_secondname']?> (<?=$StItems['staff_post']?> - <?=$pref_comp[$StItems['staff_company_id']]?>)</option>
			<?}?>
		</select>
		<input type="submit" style="height: 32px; line-height: 14px; display: block; margin-top: 3px; margin-right: 5px;" class="btn green" id="FastAddIp" href="javascript:void(0);" value="Добавить">
		<div class="clearfox"></div>
</form>
	<table class="table-tpl" border="1" bordercolor="#ccc">
		<thead>
			<tr>
				<th class="<?=$prefix_tbl?>_ElementTbl-1">IP</th>
				<th class="<?=$prefix_tbl?>_ElementTbl-3">Компьютер</th>
				<th class="<?=$prefix_tbl?>_ElementTbl-2">Пользователь</th>
				<th class="<?=$prefix_tbl?>_ElementTbl-5">Комментарий</th>
				<th class="<?=$prefix_tbl?>_ElementTbl-4">Действие</th>
			</tr>
		</thead>
		<tbody>
			<tr id="start-tr" style="opacity:0;">
				<td class="<?=$prefix_tbl?>_ElementTbl-1">111.111.1.111</td>
				<td class="<?=$prefix_tbl?>_ElementTbl-3">Aaaaaaa</td>
				<td class="<?=$prefix_tbl?>_ElementTbl-2">Aaaaaaaaa aaaaa</td>
				<td class="<?=$prefix_tbl?>_ElementTbl-4"><a class="btn-correct-tbl" href="javascript:void(0);"><i class="fa fa-wrench"></i></td>			
			</tr>
		</tbody>
	</table>
</div>