<?
session_start();
require '../../../../ajax/db.php';
//require '../../../../ajax/db.php';
require '../../../../ajax/secfile.php';
require 'form_user/pref_comp.php';
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

/*echo 'all: '.$CountAll['DbSumm'].'<br>';
echo 'deactive: '.$CountDeactive['DbSumm'].'<br>';
echo 'waiting: '.$CountWaiting['DbSumm'].'<br>';
echo 'active: '.$CountActive['DbSumm'].'<br>';*/
?>
	<?if($userLevel['oper_create_staff']==1){?><a class="btn green" style="margin-right:15px;float:left;" id="staff_createuser" href="javascript:void(0);">Новый сотрудник</a><?}?>
	<?$prefix='staff_'?>
	<div class="<?=$prefix?>show-el-page-wrapper">
		<select class="<?=$prefix?>sel-page-wrap-opt" style=" padding: 8px 9px;margin-top:-1px; margin-right:15px;">
			<option value="30">30</option>
			<option selected="selected" value="50">50</option>
			<option value="150">150</option>
			<option value="300">300</option>
		</select>
	</div>
	<div class="<?=$prefix?>status-wwrapper">
		<ul>
			<li>
				<a data-stats="3" class="<?=$prefix?>statuscheck <?=$prefix?>activeShowElPage" href="javascript:void(0);">все <span data-max-summ="<?=$CountAll['DbSumm']?>" id="all-numb-summ" style="font-size:10px;"><?if($CountAll['DbSumm']){?>(<?=$CountAll['DbSumm']?>)<?}?></span></a>
			</li>
			<li>
				<a data-stats="0" class="<?=$prefix?>statuscheck" href="javascript:void(0);">в ожидании <span data-max-summ="<?=$CountWaiting['DbSumm']?>" id="waiting-numb-summ" style="font-size:10px;"><?if($CountWaiting['DbSumm']){?>(<?=$CountWaiting['DbSumm']?>)<?}?></span></a>
			</li>
			<li>
				<a data-stats="1" class="<?=$prefix?>statuscheck" href="javascript:void(0);">активные <span data-max-summ="<?=$CountActive['DbSumm']?>" id="active-numb-summ" style="font-size:10px;"><?if($CountActive['DbSumm']){?>(<?=$CountActive['DbSumm']?>)<?}?></span></a>
			</li>
			<li style="border-right:none;">
				<a data-stats="2" class="<?=$prefix?>statuscheck" href="javascript:void(0);">неактивные <span data-max-summ="<?=$CountDeactive['DbSumm']?>" id="deactive-numb-summ" style="font-size:10px;"><?if($CountDeactive['DbSumm']){?>(<?=$CountDeactive['DbSumm']?>)<?}?></span></a>
			</li>
		</ul>
			<div style="clear:both"></div>
		<select name="stats-staff" id="stats-staff" style="display:none;">
			<option value="0">в ожидании</option>
			<option value="1">активные</option>
			<option value="2">неактивные</option>
			<option value="3" selected>все</option>
		</select>
	</div>
	<a class="right-option" onclick="$('.staff_filter-wrapper').toggle(0,function(){if(!$('.staff_filter-wrapper').hasClass('opendFilter')){$('#staff_comp-list option[value=0]').prop('selected', true); $('#staff_dep-list option[value=0]').prop('selected', true); $('#staff_loca-list option[value=0]').prop('selected', true); valComp_filt = 0; valDep_filt = 0; valLoca_filt = 0;valChange = $('.'+prefix+'sel-page-wrap-opt').val(); valStatus = $('#stats-staff').val(); valSearchType = $('#staff_paramsearch').val(); valSearchData = $('#staff_searchinp').val(); OutBlocks(1,valChange,valStatus,valSearchType,valSearchData,valComp_filt,valDep_filt,valLoca_filt);
staffBuildPagi(valStatus,valSearchType,valSearchData,valComp_filt,valDep_filt,valLoca_filt);}});$('.staff_filter-wrapper').toggleClass('opendFilter');" href="javascript:void(0);" style="  margin-right: 26px;"><i class="fa fa-cog"></i></a>
	<div class="<?=$prefix?>search-wrapepr">
	<form id="<?=$prefix?>searchform">
		<select name="<?=$prefix?>option" id="<?=$prefix?>paramsearch">
			<option value="0">Фамилия</option>
			<option value="1">Имя</option>
			<option value="2">Отчество</option>
		</select>
		<input id="<?=$prefix?>searchinp" class="field-tpl" type="text" name="<?=$prefix?>search" style="  padding: 9px 9px;  margin-top: -1px;-webkit-border-radius: 0px 4px 4px 0px; -moz-border-radius: 0px 4px 4px 0px; border-radius: 0px 4px 4px 0px;width:385px;">
	</form>
	</div>
	
	<div style="clear:both"></div>
	<div class="staff_filter-wrapper opendFilter" style="display:none;float:right;margin-right: 26px;">
		<select id="staff_comp-list" style="  padding: 8px 9px;margin-top:-1px;margin-right: 0; border-right: 0; -webkit-border-radius: 4px 0px 0px 4px; -moz-border-radius: 4px 0px 0px 4px; border-radius: 4px 0px 0px 4px;width:198px;  float: left;">
			<option value="0">-- Компания --</option>
			<?				
				$sql = 'SELECT * FROM company';
				$tb = $db->connection->prepare($sql);
				$tb->execute();
				$getData = $tb->fetchAll(PDO::FETCH_ASSOC);	
				foreach($getData as $items){
			?>
				<option value="<?=$items['company_id']?>"><?=$items['company_name']?></option>
			<?}?>
			
		</select>
		<select id="staff_dep-list" style="  padding: 8px 9px;margin-top:-1px;margin-right: 0; border-right: 0; -webkit-border-radius: 0px 0px 0px 0px; -moz-border-radius: 0px 0px 0px 0px; width:195px;  float: left;">
			<option value="0">-- Отдел --</option>
			<?				
				$sql = 'SELECT * FROM department ORDER by department_name ASC';
				$tb = $db->connection->prepare($sql);
				$tb->execute();
				$getData = $tb->fetchAll(PDO::FETCH_ASSOC);	
				foreach($getData as $items){
			?>
				<option value="<?=$items['department_id']?>"><?=$items['department_name']?> (<?=$pref_comp[$items['company_id']]?>)</option>
			<?}?>
			
		</select>
		<select id="staff_loca-list" style="  padding: 8px 9px;margin-top:-1px;-webkit-border-radius: 0px 4px 4px 0px; -moz-border-radius: 0px 4px 4px 0px; border-radius: 0px 4px 4px 0px;width:145px;  float: left;">
			<option value="0">-- Локация --</option>
			<?				
				$sql = 'SELECT * FROM location';
				$tb = $db->connection->prepare($sql);
				$tb->execute();
				$getData = $tb->fetchAll(PDO::FETCH_ASSOC);	
				foreach($getData as $items){
			?>
				<option value="<?=$items['location_id']?>"><?=$items['location_name']?></option>
			<?}?>
			
		</select>	
	</div>
	<div style="clear:both"></div>
	<!--<ul class="header-table"><li class="<?=$prefix?>row-container <?=$prefix?>header_id"><div class="<?=$prefix?>rowmain <?=$prefix?>header-first-row"><div class="<?=$prefix?>paddingrow">id</div></div> <div class="<?=$prefix?>rowmain <?=$prefix?>header-second-row"><div class="<?=$prefix?>paddingrow">Данные</div></div> <div class="<?=$prefix?>rowmain <?=$prefix?>header-third-row"><div class="<?=$prefix?>paddingrow">Компания</div></div> <div class="<?=$prefix?>rowmain <?=$prefix?>header-fourth-row"><div class="<?=$prefix?>paddingrow">Отдел/Группа</div></div> <div class="<?=$prefix?>rowmain <?=$prefix?>header-fifth-row"><div class="<?=$prefix?>paddingrow">Действие</div></div></li></ul>	-->
	<div id="<?=$prefix?>table" style="display:none;"></div>
	<div style="clear:both"></div>
	<div class="<?=$prefix?>pagenation-wrapper" style="display:none;"></div>
	<div style="clear:both"></div>