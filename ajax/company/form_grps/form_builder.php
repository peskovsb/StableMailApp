<?
session_start();
require '../../db.php';
require 'arrFields.php';

$db = new DatabaseItDept();
$sql = 'SELECT * FROM company';
$tb = $db->connection->prepare($sql);
$tb->execute();
$getData = $tb->fetchAll(PDO::FETCH_ASSOC);

$sql = 'SELECT * FROM department ORDER by department_name ASC';
$tb = $db->connection->prepare($sql);
$tb->execute();
$getDeps = $tb->fetchAll(PDO::FETCH_ASSOC);
?>

<form class="formpadding" id="<?=$formName?>">
	<h1 class="form-header">Создать Группу</h1>
	<table>
		<?foreach($arrayForm as $f_Items){?>
		<?if($f_Items['name'] == $prefix.'соmpany'){?>
				<tr id="build-depart-fields">
					<td class="field-cover">
						<label for="<?=$f_Items['name']?>"><?=$f_Items['title']?></label>
					</td>
					<td style="position:relative;">
						<select class="field-tpl" name="<?=$f_Items['name']?>" id="<?=$f_Items['name']?>">
							<option value="0">-- Выберите компанию --</option>
							<?
							foreach($getData as $f_item){?>						
								<option <?if($_GET["comp"]==$f_item["company_id"]){?>selected<?}?> value="<?=$f_item['company_id']?>"><?=$f_item['company_name']?></option>
							<?}?>
						</select>
						<i style="  margin-left: 10px;color: rgb(0, 153, 0);" class="fa fa-check-circle exelfiledIU"></i>
					</td>
				</tr>
			<?}else if($f_Items['name'] == $prefix.'depart'){?>
				<tr id="dep-form">
					<td class="field-cover">
						<label for="gr_department">Отдел</label>
					</td>
					<td style="position:relative;width:358px">
						<select class="field-tpl" name="gr_department" id="gr_department" style="border-color: rgb(204, 204, 204);">
							<option value="0">-- Выберите Отдел --</option>
							<?foreach($getDeps as $Deps){?>
								<option <?if($_GET["dep"]==$Deps["department_id"]){?>selected<?}?> value="<?=$Deps["department_id"]?>"><?=$Deps["department_name"]?></option>
							<?}?>
															
						</select>
						<i style="  margin-left: 10px;color: rgb(0, 153, 0);" class="fa fa-check-circle exelfiledIU"></i>
					</td>
				</tr>
			<?}else{?>
				<tr>
					<td class="field-cover">
						<label for="<?=$f_Items['name']?>"><?=$f_Items['title']?></label>
					</td>
					<td style="position:relative;">
						<input class="field-tpl" type="text" name="<?=$f_Items['name']?>" id="<?=$f_Items['name']?>" value="">
						<i style="  margin-left: 10px;color: rgb(0, 153, 0);" class="fa fa-check-circle exelfiledIU"></i>
					</td>
				</tr>
			<?}?>
		<?}?>
		<tr class="btnarea">
			<td style="vertical-align: bottom;" colspan="2">
				<div style="margin: 20px auto 0;">
					<a id="<?=$prefix?>clearform" class="btn red" style="float:right">Очистить Форму</a>
					<input class="btn green" type="submit" name="<?=$prefix?>sendform" value="Создать Группу">
						<div style="clear:both"></div>
				</div>
			</td>
		</tr>		
	</table>
</form>
<script>
/*$(function () {
	$('#<?=$prefix?>city').kladr({
		type: $.kladr.type.city
	});
});*/

</script>
<script>

$(function() {
	 
	$( "#staff_dateenter" ).datepicker({
		//minDate: 0, //work since
		dateFormat: "dd-mm-yy", 
		onClose: function( selectedDate ) {
		from = selectedDate.split("-");
		f = new Date(from[2], from[1] - 1, from[0]);
		var d = new Date(f);
		var mm = d.getMonth() + 1;
		if(mm<10){
			mm='0'+mm;
		}
		var dd = d.getDate() + 1;
		var yy = d.getFullYear();
		var myDateString = dd + '-' + mm + '-' + yy; //(US)
		//alert(myDateString);
		$("#staff_dateenter").focus();
		$("#chk-still-work").focus();
		}
	});



});
/*LimInp.onkeypress = function(e) {
  e = e || event;

  if (e.ctrlKey || e.altKey || e.metaKey) return;

  var chr = getChar(e);

  // с null надо осторожно в неравенствах,
  // т.к. например null >= '0' => true
  // на всякий случай лучше вынести проверку chr == null отдельно
  if (chr == null) return;

  if (chr < '0' || chr > '9') {
    return false;
  }
}*/

// event.type должен быть keypress
function getChar(event) {
  if (event.which == null) { // IE
    if (event.keyCode < 32) return null; // спец. символ
    return String.fromCharCode(event.keyCode)
  }

  if (event.which != 0 && event.charCode != 0) { // все кроме IE
    if (event.which < 32) return null; // спец. символ
    return String.fromCharCode(event.which); // остальные
  }

  return null; // спец. символ
}

$(document).on('keypress','#staff_limit',function(e){
//console.log(hello);
  e = e || event;

  if (e.ctrlKey || e.altKey || e.metaKey) return;

  var chr = getChar(e);

  // с null надо осторожно в неравенствах,
  // т.к. например null >= '0' => true
  // на всякий случай лучше вынести проверку chr == null отдельно
  if (chr == null) return;

  if (chr < '0' || chr > '9') {
    return false;
  }
});

</script>
<style>
*{font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;font-size: 14px;}

.field-tpl{
	background-color: #ffffff;
	border: 1px solid #cccccc;
	-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
	-moz-box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
	box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
	-webkit-transition: border linear 0.2s,box-shadow linear 0.2s;
	-moz-transition: border linear 0.2s,box-shadow linear 0.2s;
	-o-transition: border linear 0.2s,box-shadow linear 0.2s;
	transition: border linear 0.2s,box-shadow linear 0.2s;
	padding: 6px 9px;
	-webkit-border-radius: 4px;
	-moz-border-radius: 4px;
	border-radius: 4px;
	box-sizing: border-box;
	margin-bottom: 10px;
	width:300px;
}

.field-tpl:focus{ border-color: #66afe9!important; outline: 0; -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6); box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6); }
.field-cover label {  margin-right: 20px; display: block; text-align: right;  margin-bottom: 10px;} 
.formpadding{  padding: 10px 30px 30px 30px;float:left;}

.form-header{
  height: 30px;
  line-height: 30px;
  font-size: 18px;
  color: #000;
  padding: 0;
  border-bottom:2px solid #000;
  margin-bottom:20px;
}

.btn {
  display: inline-block;
  padding: 6px 12px;
  margin-bottom: 0;
  font-size: 14px;
  font-weight: 400;
  line-height: 1.42857143;
  text-align: center;
  white-space: nowrap;
  vertical-align: middle;
  -ms-touch-action: manipulation;
  touch-action: manipulation;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  background-image: none;
  border: 1px solid transparent;
  border-radius: 4px;
}

.green { color: #fff; background-color: #5cb85c; border-color: #4cae4c; }
.green:hover{color: #fff; background-color: #449d44; border-color: #398439;}
.red{  color: #fff; background-color: #d9534f; border-color: #d43f3a;}
.red:hover{  color: #fff; background-color: #c9302c; border-color: #ac2925;}
.exelfiledIU{display:none;}
.btn-createpost{ color: #fff; display: inline-block; font-size: 12px; text-decoration: none; background: #3a87ad; padding: 5px 15px; border-radius: 5px;margin-bottom:10px;}
.accs-block{width:148px;float:left;border:1px solid #ccc;/* padding: 10px 0; */ }
.accs-block input{  vertical-align: middle;cursor:pointer;  margin: 10px 0;  margin-left: -20px;}
.accs-block label{  width: 133px; display: block; float: left; padding-left: 15px;cursor:pointer;  padding-top: 10px;  padding-bottom: 10px;} 
#limit-phone label{width:auto;padding-top: 1px;}
#limit-phone input{  width: 60px; padding: 0 5px; vertical-align: middle; margin-left:10px; margin-bottom:0;} 

.cm-mailbox{  float: left; width: 50%;}
.halffield{  width: 155px;}
.half-select{width:121px;}
.genpass-btn{width: 119px; color: #fff; display: inline-block; font-size: 12px; text-align: center; height: 30px; line-height: 30px; -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px; text-decoration: none;background: #3a87ad;} 
#sendtestletter{  margin-bottom: 20px;}
.fa.exelfiledIU{position:relative;top: 0;  right: 0;}
</style>