<?session_start();
//--itdept DB
//require '../../../db.php';
require 'arrFields.php';
require '../../../../../ajax/db.php';
require '../../../../../ajax/secfile.php';

$db = new DatabaseItDept();

//--Params
$staff_id = $_GET['id'];


$sql = 'SELECT * FROM staff WHERE staff_id = :staff_id';
$tb = $db->connection->prepare($sql);
$tb->execute(array(':staff_id'=>$staff_id));
$arRezlt = $tb->fetch(PDO::FETCH_ASSOC);
	

//echo '<pre>'; print_r($arRezlt);echo '</pre>';
?>
<div class="wrapper-staff-tasher-data" style="position:relative;">
<form id="deact-user">
	<h2>Диактивировть пользователя</h2>
	<input type="hidden" value="<?=$arRezlt['staff_id'];?>" name="staff_id_trasher">
	<div style="float:left;width:155px;">
		<p>Причина</p>
		<select class="list-trasher" style="width:130px;" name="staff_type_trasher">
			<option value="0">Уволен</option>
			<option value="1">Декрет</option>
		</select>
	</div>
	<div style="float:left;width:152px;">
		<p>Дата:</p>
		<input id="trash_datefail" class="field-tpl" type="text" value="<?=date('d-m-Y');?>" style="width:100%;" name="staff_date_trasher">
	</div>
		<div style="clear:both"></div>
			<input class="btn red" style="color: #fff; margin: 35px auto; display: block; width: 130px;float:left;" type="submit" value="Деактивировать">
			<!--<a class="btn red" style="color: #fff; margin: 35px auto; display: block; width: 100px;float:left;" href="javascript:void(0);">Деактивировать</a>-->
			<a class="cancelbtn" style="margin: 35px 0; display: block; width: 130px; float: left; padding: 6px 12px; color: #000; margin-left: 21px;" onclick="$.fancybox({ closeClick  : true});" href="javascript:void(0);">Отмена</a>

		<div style="clear:both"></div>
</form>
</div>
<script>
$(function() {
	 
	$( "#trash_datefail" ).datepicker({
		//minDate: 0, //work since
		dateFormat: "dd-mm-yy",      changeMonth: true,
      changeYear: true
	});



});
</script>