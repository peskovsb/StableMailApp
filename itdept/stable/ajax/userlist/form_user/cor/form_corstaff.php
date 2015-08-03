<?session_start();
//--itdept DB
//require '../../../../db.php';
//require 'arrFields.php';
require '../../../../../../ajax/db.php';
require '../../../../../../ajax/secfile.php';
require '../pref_comp.php';


$db = new DatabaseItDept();
$dbMail = new Database();
//$db_infoline = new DatabaseInfoline();

//--Params
$staff_id = $_GET['id'];


$sql = 'SELECT * FROM staff WHERE staff_id = :staff_id';
$tb = $db->connection->prepare($sql);
$tb->execute(array(':staff_id'=>$staff_id));
$arRezlt = $tb->fetch(PDO::FETCH_ASSOC);

	$sql = 'SELECT * FROM company WHERE company_id = :company_id';
	$tb = $db->connection->prepare($sql);
	$tb->execute(array(':company_id'=>$arRezlt['staff_company_id']));
	$detaStep = $tb->fetch(PDO::FETCH_ASSOC);
	$arRezlt['staff_company_id'] = $detaStep['company_name'];
	$arRezlt['staff_comp_real_id'] = $detaStep['company_id'];
	unset($detaStep);

	$sql = 'SELECT * FROM department WHERE department_id = :department_id';
	$tb = $db->connection->prepare($sql);
	$tb->execute(array(':department_id'=>$arRezlt['staff_depart_id']));
	$detaStep = $tb->fetch(PDO::FETCH_ASSOC);
	$arRezlt['staff_depart_id'] = $detaStep['department_name'];
	$arRezlt['staff_comp_dep_id'] = $detaStep['department_id'];
//echo '<pre>'; print_r($detaStep);echo '</pre>';	
	unset($detaStep);

	$sql = 'SELECT * FROM groups WHERE gr_id = :gr_id';
	$tb = $db->connection->prepare($sql);
	$tb->execute(array(':gr_id'=>$arRezlt['staff_group_id']));
	$detaStep = $tb->fetch(PDO::FETCH_ASSOC);
	$arRezlt['staff_group_id'] = $detaStep['group_name'];
	$arRezlt['staff_group_real_id'] = $detaStep['gr_id'];
//echo '<pre>'; print_r($detaStep);echo '</pre>';	
	unset($detaStep);

	$sql = 'SELECT * FROM company WHERE company_id = :company_id';
	$tb = $db->connection->prepare($sql);
	$tb->execute(array(':company_id'=>$arRezlt['staff_dopcomp1']));
	$detaStep = $tb->fetch(PDO::FETCH_ASSOC);
	$arRezlt['staff_dopcomp1'] = $detaStep['company_name'];
//echo '<pre>'; print_r($detaStep);echo '</pre>';	
	unset($detaStep);

	$sql = 'SELECT * FROM company WHERE company_id = :company_id';
	$tb = $db->connection->prepare($sql);
	$tb->execute(array(':company_id'=>$arRezlt['staff_dopcomp2']));
	$detaStep = $tb->fetch(PDO::FETCH_ASSOC);
	$arRezlt['staff_dopcomp2'] = $detaStep['company_name'];
//echo '<pre>'; print_r($detaStep);echo '</pre>';	
	unset($detaStep);

	$sql = 'SELECT * FROM location WHERE location_id = :location_id';
	$tb = $db->connection->prepare($sql);
	$tb->execute(array(':location_id'=>$arRezlt['staff_location']));
	$detaStep = $tb->fetch(PDO::FETCH_ASSOC);
	$arRezlt['staff_location'] = $detaStep['location_name'];
//echo '<pre>'; print_r($detaStep);echo '</pre>';	
	unset($detaStep);
	
	$sql = 'SELECT * FROM users WHERE staff_id = :staff_id';
	$tb = $dbMail->connection->prepare($sql);
	$tb->execute(array(':staff_id'=>$arRezlt['staff_id']));
	$detaStep = $tb->fetch(PDO::FETCH_ASSOC);
	$arRezlt['staff_email_id'] = $detaStep['user_id'];
	$arRezlt['staff_email'] = $detaStep['email'];
	unset($detaStep);	
	
	/*$sql = 'SELECT * FROM infoline_users WHERE lastname = :lastname AND firstname = :firstname AND middlename =:middlename';
	$tb = $db_infoline->connection->prepare($sql);
	$tb->execute(array(':lastname'=>$arRezlt['staff_lastname'],':firstname'=>$arRezlt['staff_name'],':middlename'=>$arRezlt['staff_secondname']));
	$avatar = $tb->fetch(PDO::FETCH_ASSOC);
	if($avatar['avatar']){$arRezlt['staff_avatar'] = $avatar['avatar'];}else{$arRezlt['staff_avatar']='no-image.jpg';}*/


	
	//echo $arRezlt['staff_datedeactive'];
	if($arRezlt['staff_active'] == '0' AND $arRezlt['staff_datedeactive'] == '0000-00-00 00:00:00' AND $arRezlt['staff_typedeactive']==''){
		$arRezlt['status'] = 'В ожидании';
		$colorStaff = '#C09700';
	}
	if($arRezlt['staff_active'] == '1' AND $arRezlt['staff_datedeactive'] == '0000-00-00 00:00:00' AND $arRezlt['staff_typedeactive']==''){
		$arRezlt['status'] = 'Активный';
		$colorStaff = '#090';
	}
	if($arRezlt['staff_active'] == '1' AND $arRezlt['staff_typedeactive'] == '0'){
		$arRezlt['status'] = 'Уволенный';
		$colorStaff = '#c11';
	}
	if($arRezlt['staff_active'] == '1' AND $arRezlt['staff_typedeactive'] == '1'){
		$arRezlt['status'] = 'Декрет';		
		$colorStaff = '#F960D4';
	}

$statusArr = array(
	'0' => 'В ожидании',
	'1' => 'Активный',
	'2' => 'Уволенный',
	'3' => 'Декрет'
);	


//echo '<pre>';print_r($arRezlt);echo '</pre>';
?>
<style>
.widthfix{width:455px;}
</style>
<div id="staff_correct_user">
	<div class="left-part-img">
		<div class="outer-staff-pic">
			<div class="border-staff-pic"><?if($arRezlt['staff_avatar']){?><img src="http://infoline.bioline.ru/images/comprofiler/<?=$arRezlt['staff_avatar']?>"><?}else{?><img src="http://infoline.bioline.ru/images/comprofiler/no-image.jpg"><?}?></div>
		</div>
		<!--<div class="dates-img-low">
			<div class="staff-fontf staff-first-row">Дата выхода: </div></td>
			<div class="staff-fontf staff-second-row"><?=date('d-m-Y',strtotime($arRezlt['staff_enterdate']))?></div>
		</div>
		<div class="img-under-cr">
			<div style="  color: #BEBEBE;  font-style: italic;  font-size: 10px;" class="staff-fontf staff-first-row">Дата создания: </div>
			<div style="  color: #BEBEBE;  font-style: italic;  font-size: 10px;" class="staff-fontf staff-second-row"><?=date('d-m-Y',strtotime($arRezlt['staff_formsignd']))?></div>
		</div>-->
	</div>
	<div class="right-staff-part">
		<form id="staff_corusers">
			<input type="hidden" name="staff_id" value="<?=$arRezlt['staff_id']?>">
			<h1><input placeholder="Фамилия" id="staff_cor_lastname" class="field-tpl" type="text" name="staff_cor_lastname" value="<?=$arRezlt['staff_lastname']?>"> <input id="staff_cor_name" class="field-tpl" type="text" name="staff_name" value="<?=$arRezlt['staff_name']?>" placeholder="Имя"> <input placeholder="Отчество" id="staff_cor_secondname" class="field-tpl" type="text" name="staff_secondname" value="<?=$arRezlt['staff_secondname']?>"></h1>
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;" class="tbl-staff-cor">
				<tr>
					<td><div class="staff-fontf staff-first-row">Должность: </div></td>
					<td><div class="staff-fontf staff-second-row font-wght"><input id="staff_cor_post" class="field-tpl widthfix" type="text" name="staff_post" value="<?=$arRezlt['staff_post']?>"></div></td>
				</tr>
				<tr>
					<td style="vertical-align:middle;"><div class="staff-fontf staff-first-row">Компания: </div></td>
					<td>
						<div class="staff-fontf staff-second-row">
							<select id="comp_corr-list" class="list-trasher widthfix" name="staff_company_id">
							<?
								$sql = 'SELECT * FROM company';
								$tb = $db->connection->prepare($sql);
								$tb->execute();
								$dataDB = $tb->fetchAll(PDO::FETCH_ASSOC);
							foreach($dataDB as $items){?>
								<option <?if($arRezlt['staff_comp_real_id'] == $items['company_id']){?>selected="selected"<?}?> value="<?=$items['company_id']?>"><?=$items['company_name']?></option>
							<?}?>
							</select>
						</div>
					</td>
				</tr>
				<tr>
					<td><div class="staff-fontf staff-first-row">Компания 1: </div></td>
					<td>
						<div class="staff-fontf staff-second-row">
							<select class="list-trasher widthfix" name="staff_dopcomp1">
							<option value="0">-- Дополнительная компания 1 --</option>
							<?
								$sql = 'SELECT * FROM company';
								$tb = $db->connection->prepare($sql);
								$tb->execute();
								$dataDB = $tb->fetchAll(PDO::FETCH_ASSOC);
							foreach($dataDB as $items){?>
								<option <?if($arRezlt['staff_dopcomp1'] == $items['company_name']){?>selected="selected"<?}?> value="<?=$items['company_id']?>"><?=$items['company_name']?></option>
							<?}?>
							</select>
						</div>
					</td>
				</tr>
				<tr>
					<td><div class="staff-fontf staff-first-row">Компания 2: </div></td>
					<td>
						<div class="staff-fontf staff-second-row">
							<select class="list-trasher widthfix" name="staff_dopcomp2">
							<option value="0">-- Дополнительная компания 2 --</option>
							<?
								$sql = 'SELECT * FROM company';
								$tb = $db->connection->prepare($sql);
								$tb->execute();
								$dataDB = $tb->fetchAll(PDO::FETCH_ASSOC);
							foreach($dataDB as $items){?>
								<option <?if($arRezlt['staff_dopcomp2'] == $items['company_name']){?>selected="selected"<?}?> value="<?=$items['company_id']?>"><?=$items['company_name']?></option>
							<?}?>
							</select>
						</div>
					</td>
				</tr>
				<tr>
					<td><div class="staff-fontf staff-first-row">Отдел: </div></td>
					<td>
						<div class="staff-fontf staff-second-row">
							<select id="cor-dep-list" class="list-trasher widthfix" name="staff_department">
							<option value="0">-- Отдел --</option>
							<?
								$sql = 'SELECT * FROM department WHERE company_id = :company_id ORDER by department_name ASC';
								$tb = $db->connection->prepare($sql);
								$tb->execute(array(':company_id'=>$arRezlt['staff_comp_real_id']));
								$dataDB = $tb->fetchAll(PDO::FETCH_ASSOC);
							foreach($dataDB as $items){?>
								<option <?if($arRezlt['staff_comp_dep_id'] == $items['department_id']){?>selected="selected"<?}?> value="<?=$items['department_id']?>"><?=$items['department_name']?> (<?=$pref_comp[$items['company_id']]?>)</option>
							<?}?>
							</select>
						</div>					
					</td>
				</tr>
				<tr>
					<td><div class="staff-fontf staff-first-row">Группа: </div></td>
					<td>
						<div class="staff-fontf staff-second-row">
							<select id="cor-grp-list" class="list-trasher widthfix" name="staff_group_id">
								<option value="0">-- Группа --</option>
							<?
								$sql = 'SELECT * FROM groups WHERE department_id = :department_id';
								$tb = $db->connection->prepare($sql);
								$tb->execute(array(':department_id'=>$arRezlt['staff_comp_dep_id']));
								$dataDB = $tb->fetchAll(PDO::FETCH_ASSOC);
							foreach($dataDB as $items){?>
								<option <?if($arRezlt['staff_group_real_id'] == $items['gr_id']){?>selected="selected"<?}?> value="<?=$items['gr_id']?>"><?=$items['group_name']?></option>
							<?}?>
							</select>
						</div>
					</td>
				</tr>
				<tr>
					<td><div class="staff-fontf staff-first-row">Локация: </div></td>
					<td>
						<div class="staff-fontf staff-second-row">
							<select class="list-trasher widthfix" name="staff_location">
							<?
								$sql = 'SELECT * FROM location';
								$tb = $db->connection->prepare($sql);
								$tb->execute();
								$dataDB = $tb->fetchAll(PDO::FETCH_ASSOC);
							foreach($dataDB as $items){?>
								<option <?if($arRezlt['staff_location'] == $items['location_name']){?>selected="selected"<?}?> value="<?=$items['location_id']?>"><?=$items['location_name']?></option>
							<?}?>
							</select>
						</div>
					</td>
				</tr>
				<tr>
					<td style="vertical-align:middle;"><div class="staff-fontf staff-first-row">Телефон: </div></td>
					<td><div class="staff-fontf staff-second-row">
					<input class="field-tpl widthfix" id="ats-staff" type="text" name="staff_ats" value="<?if($arRezlt['staff_ats'] != '0'){echo $arRezlt['staff_ats'];}?>"></div></td>
				</tr>
				<tr>
					<td><div class="staff-fontf staff-first-row">Мобильный: </div></td>
					<td><div class="staff-fontf staff-second-row">
					<input id="staff_mobnumber" class="field-tpl widthfix" type="text" name="staff_mobnumber" value="<?=$arRezlt['staff_mobnumber']?>"></div></td>
				</tr>
				<tr>
					<td><div class="staff-fontf staff-first-row">Дата выхода: </div></td>
					<td><div class="staff-fontf staff-second-row">
					<input class="field-tpl widthfix" type="text" id="staff_enterdate" name="staff_enterdate" value="<?=date('d-m-Y',strtotime($arRezlt['staff_enterdate']))?>">
					</div></td>
				</tr>
				<tr>
					<td><div class="staff-fontf staff-first-row">День рождения: </div></td>
					<td><div class="staff-fontf staff-second-row">
					<input class="field-tpl widthfix" type="text" id="staff_user_dr" name="staff_user_dr" value="<?if($arRezlt['staff_dr']!=0){echo date('d-m',$arRezlt['staff_dr']);}?>">
					</div></td>
				</tr>
				<?if($arRezlt['staff_email']){?>
				<tr>
					<td><div class="staff-fontf staff-first-row">Email: </div></td>
					<td><div class="staff-fontf staff-second-row">
					<?if($userLevel['oper_correct_post']!=0){?><a data-corr="<?=$arRezlt['staff_email_id']?>" class="m_link_from_log_corr" href="javascript:void(0);" style="color:#444;font-weight:bold;text-decoration:none;"><?=$arRezlt['staff_email']?></a><?}else{?><?=$arRezlt['staff_email']?><?}?>
					</div></td>
					<style>.m_link_from_log_corr:hover{color:#3a87ad!important}</style>
				</tr>
				<?}?>

				<tr id="last-staff-field">
					<td><div class="staff-fontf staff-first-row">Статус: </div></td>
					<td><div class="staff-fontf staff-second-row status-staff-rzl" style="color:<?=$colorStaff?>">
						<select id="staff-cor-status" class="list-trasher widthfix" name="staff_status">
							<?foreach($statusArr as $key => $items){?>
								<option <?if($arRezlt['status'] == $items){?>selected="selected"<?}?> value="<?=$key?>"><?=$items?></option>
							<?}?>
						</select>
						</div></td>
				</tr>
				
				<tr id="datedeact-staff" style="display:<?if($arRezlt['status'] == 'Уволен' || $arRezlt['status'] == 'Декрет'){?><?}else{?>none<?}?>"> 
					<td style="vertical-align:middle;">
						<div class="staff-fontf staff-first-row">Дата ухода: </div>
					</td> 
					<td>
						<div class="staff-fontf staff-second-row"> <input id="data-deact-staff" class="field-tpl widthfix" type="text" name="staff_datedeactive" value="<?if($arRezlt['staff_datedeactive'] != '0000-00-00 00:00:00'){echo date('d-m-Y',strtotime($arRezlt['staff_datedeactive']));}?>"></div>
					</td> 
				</tr>			
				<tr>
					<td><input class="bluebtn" type="submit" value="Сохранить"></td>
					<td>
						
					</td>
				</tr>
			</table>
		</form>
	</div>
		<div style="clear:both"></div>
</div>
<?require 'arFields.php';?>
<?require 'script_js.php';?>