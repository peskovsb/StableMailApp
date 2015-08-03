<?
	require '../../../ajax/db.php';
	$db = new DatabaseItdept();
	$sql = 'SELECT * from location;';
	$tb = $db->connection->prepare($sql);
	$tb->execute();
	$allData = $tb->fetchAll(PDO::FETCH_ASSOC);
	
	require '../menu_tabs.php';
?>

<h2 class="inUheader" style="float:none;">Локации</h2>
<a class="btn green" id="create_location" href="javascript:void(0);">Cоздать Локацию</a>
<?$pref_tbl = 'location';?>
<!--<div id="show_<?=$pref_tbl?>_table" class="markup-table" style="width:650px;display:none;margin-top:10px;">
	<ul>
		<li>
			<div class="marktbl-header pers-mark-tbl-<?=$pref_tbl?> mark-tbl-<?=$pref_tbl?>-1">id</div>
			<div class="marktbl-header pers-mark-tbl-<?=$pref_tbl?> mark-tbl-<?=$pref_tbl?>-2">название</div>
			<div class="marktbl-header pers-mark-tbl-<?=$pref_tbl?> mark-tbl-<?=$pref_tbl?>-3"><span style="padding-right:15px">Действие</span></div>
				<div style="clear:both"></div>
		</li>
	</ul>
	<div id="show_<?=$pref_tbl?>"></div>
</div>
<a data-status="closed" style="width: 125px;" class="btn-link-shower" id="btn-<?=$pref_tbl?>" href="javascript:void(0);" onclick="showlistIU('<?=$pref_tbl?>')">Показать...</a>-->

<div id="show_location_table" class="markup-table" style="width: 650px; margin-top: 10px; display: block;">
	<ul>
		<li>
			<div class="marktbl-header pers-mark-tbl-location mark-tbl-location-1">id</div>
			<div class="marktbl-header pers-mark-tbl-location mark-tbl-location-2">название</div>
			<div class="marktbl-header pers-mark-tbl-location mark-tbl-location-4">IP</div>
			<div class="marktbl-header pers-mark-tbl-location mark-tbl-location-3"><span style="padding-right:15px">Действие</span></div>
				<div style="clear:both"></div>
		</li>
	</ul>
	<div id="show_location">
	<?foreach($allData as $items){?>
		<div class="cover-tbl-row">
			<div class="pers-mark-tbl-location mark-tbl-location-1"><?=$items["location_id"]?></div>
			<div class="pers-mark-tbl-location mark-tbl-location-2"><?=$items["location_name"]?></div>
			<div class="pers-mark-tbl-location mark-tbl-location-4"><?=$items["location_subnetwork"]!=''?'192.168.'.$items["location_subnetwork"].'.0/24':'--'?></div>
			<div data-id_f="<?=$items["location_id"]?>" class="pers-mark-tbl-location mark-tbl-location-3">
				<a class="corr-btn-tbl" id="cor-location-field" href="javascript:void(0)" style="margin-right:7px;"><i class="fa fa-wrench"></i></a>
				<a class="del-btn-tbl redbtn" id="del-location-field" href="javascript:void(0)"><i class="fa fa-trash-o"></i></a>
			</div>
			
			<div style="clear:both"></div>
		</div>
	<?}?>
	</div>
</div>



<br>
<br>
<br>
<br>