<?session_start();
//--itdept DB
//require '../../../db.php';
require 'arrFields.php';
require '../../../../../ajax/db.php';
require '../../../../../ajax/secfile.php';


$db = new DatabaseItDept();
$dbMail = new Database();
//$db_infoline = new DatabaseInfoline();

//--Params
$staff_id = $_GET['id'];

$Month_r = array( 
"01" => "января", 
"02" => "февраля", 
"03" => "марта", 
"04" => "апреля", 
"05" => "мая", 
"06" => "июня", 
"07" => "июля", 
"08" => "августа", 
"09" => "сентября", 
"10" => "октября", 
"11" => "ноября", 
"12" => "декабря");

$sql = 'SELECT * FROM staff WHERE staff_id = :staff_id';
$tb = $db->connection->prepare($sql);
$tb->execute(array(':staff_id'=>$staff_id));
$arRezlt = $tb->fetch(PDO::FETCH_ASSOC);

	$sql = 'SELECT * FROM company WHERE company_id = :company_id';
	$tb = $db->connection->prepare($sql);
	$tb->execute(array(':company_id'=>$arRezlt['staff_company_id']));
	$detaStep = $tb->fetch(PDO::FETCH_ASSOC);
	$arRezlt['staff_company_id'] = $detaStep['company_name'];
	unset($detaStep);

	$sql = 'SELECT * FROM department WHERE department_id = :department_id';
	$tb = $db->connection->prepare($sql);
	$tb->execute(array(':department_id'=>$arRezlt['staff_depart_id']));
	$detaStep = $tb->fetch(PDO::FETCH_ASSOC);
	$arRezlt['staff_depart_id'] = $detaStep['department_name'];
//echo '<pre>'; print_r($detaStep);echo '</pre>';	
	unset($detaStep);

	$sql = 'SELECT * FROM groups WHERE gr_id = :gr_id';
	$tb = $db->connection->prepare($sql);
	$tb->execute(array(':gr_id'=>$arRezlt['staff_group_id']));
	$detaStep = $tb->fetch(PDO::FETCH_ASSOC);
	$arRezlt['staff_group_id'] = $detaStep['group_name'];
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
		$arRezlt['status'] = 'Уволеный';
		$colorStaff = '#c11';
	}
	if($arRezlt['staff_active'] == '1' AND $arRezlt['staff_typedeactive'] == '1'){
		$arRezlt['status'] = 'Декрет';		
		$colorStaff = '#F960D4';
	}
	

//echo '<pre>'; print_r($arRezlt);echo '</pre>';
?>
<div class="wrapper-staff-data" style="width:600px;position:relative;">
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
		<h1><?=$arRezlt['staff_lastname']?> <?=$arRezlt['staff_name']?> <?=$arRezlt['staff_secondname']?></h1>
		<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;" class="tbl-staff">
			<tr>
				<td><div class="staff-fontf staff-first-row">Должность: </div></td>
				<td><div class="staff-fontf staff-second-row font-wght"><?=$arRezlt['staff_post']?></div></td>
			</tr>
			<tr>
				<td style="vertical-align:middle;"><div class="staff-fontf staff-first-row">Компания: </div></td>
				<td><div class="staff-fontf staff-second-row" style="font-size:16px;font-weight:bold;color: #009999;"><?=$arRezlt['staff_company_id']?></div></td>
			</tr>
			<?if($arRezlt['staff_dopcomp1']){?>
			<tr>
				<td><div class="staff-fontf staff-first-row">Компания 1: </div></td>
				<td><div class="staff-fontf staff-second-row"><?=$arRezlt['staff_dopcomp1']?></div></td>
			</tr>
			<?}?>
			<?if($arRezlt['staff_dopcomp2']){?>
			<tr>
				<td><div class="staff-fontf staff-first-row">Компания 2: </div></td>
				<td><div class="staff-fontf staff-second-row"><?=$arRezlt['staff_dopcomp2']?></div></td>
			</tr>
			<?}?>
			<tr>
				<td><div class="staff-fontf staff-first-row">Отдел: </div></td>
				<td><div class="staff-fontf staff-second-row"><?=$arRezlt['staff_depart_id']?></div></td>
			</tr>
			<?if($arRezlt['staff_group_id']){?>
			<tr>
				<td><div class="staff-fontf staff-first-row">Группа: </div></td>
				<td><div class="staff-fontf staff-second-row"><?=$arRezlt['staff_group_id']?></div></td>
			</tr>
			<?}?>
			<tr>
				<td><div class="staff-fontf staff-first-row">Локация: </div></td>
				<td><div class="staff-fontf staff-second-row"><?=$arRezlt['staff_location']?></div></td>
			</tr>
			<?if($arRezlt['staff_ats']){?>
			<tr>
				<td style="vertical-align:middle;"><div class="staff-fontf staff-first-row">Телефон: </div></td>
				<td><div class="staff-fontf staff-second-row"><?=$arRezlt['staff_ats']?></div></td>
			</tr>
			<?}?>
			<?if($arRezlt['staff_mobnumber']){?>
			<tr>
				<td><div class="staff-fontf staff-first-row">Мобильный: </div></td>
				<td><div class="staff-fontf staff-second-row"><?=$arRezlt['staff_mobnumber']?></div></td>
			</tr>
			<?}?>
			<tr>
				<td><div class="staff-fontf staff-first-row">Дата выхода: </div></td>
				<td><div class="staff-fontf staff-second-row"><?=date('d-m-Y',strtotime($arRezlt['staff_enterdate']))?></div></td>
			</tr>
			<?if($arRezlt['staff_dr']!=0){?>
			<tr>
				<td><div class="staff-fontf staff-first-row">День рождения: </div></td>
				<td><div class="staff-fontf staff-second-row"><?=date('d',$arRezlt['staff_dr'])?> <?=$Month_r[date('m',$arRezlt['staff_dr'])]?></div></td>
			</tr>
			<?}?>
			<?if($arRezlt['staff_email']){?>
			<tr>
				<td><div class="staff-fontf staff-first-row">Email: </div></td>
				<td><div class="staff-fontf staff-second-row"><?=$arRezlt['staff_email']?></div></td>
			</tr>
			<?}?>

			<tr>
				<td><div class="staff-fontf staff-first-row">Статус: </div></td>
				<td><div class="staff-fontf staff-second-row status-staff-rzl" style="color:<?=$colorStaff?>"><?=$arRezlt['status']?></div></td>
			</tr>
			<tr>
				<td data-staffid = "<?=$arRezlt['staff_id']?>"><?if($userLevel['oper_correct_staff']!='0'){?><a id="staff_corusr" class="bluebtn" href="javascript:void(0);">Редактировать</a><?}?></td>
				<td>
					<?if($arRezlt['staff_active'] == '0' AND $arRezlt['staff_datedeactive'] == '0000-00-00 00:00:00' AND $arRezlt['staff_typedeactive']==''){?><a onclick="actstaff(<?=$arRezlt['staff_id']?>);" class="greenbtn" href="javascript:void(0);">Активировать</a><?}?>
				</td>
			</tr>
		</table>
	</div>
		<div style="clear:both"></div>
</div>
