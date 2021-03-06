﻿<?
//session_start();

//--itdept DB
require '../../db.php';
$db = new DatabaseItDept();
$sql = 'SELECT * FROM groups LEFT JOIN department ON groups.department_id = department.department_id LEFT JOIN company ON department.company_id = company.company_id WHERE groups.gr_id = :gr_id;';
$tb = $db->connection->prepare($sql);
$tb->execute(array(':gr_id'=>$_GET['id']));
$arrAll = $tb->fetch(PDO::FETCH_ASSOC);

$sql = 'SELECT * FROM company';
$tb = $db->connection->prepare($sql);
$tb->execute();
$arrComp = $tb->fetchAll(PDO::FETCH_ASSOC);

$sql = 'SELECT * FROM department WHERE company_id = :company_id ORDER by department_name';
$tb = $db->connection->prepare($sql);
$tb->execute(array(':company_id'=>$arrAll["company_id"]));
$arrDep = $tb->fetchAll(PDO::FETCH_ASSOC);


/*echo '<pre>';
	print_r($arrAll);
echo '</pre>';*/

$prefix_form = 'grps';
?>
<form class="formpadding" id="form-sb-<?=$prefix_form?>-cor">
<input name="dep_id" type="hidden" value="<?=$arrAll['gr_id']?>">
	<h1 class="form-header">Редактировать группу</h1>
	<table>
		<tr>
			<td class="field-cover">
				<label for="fld-<?=$prefix_form?>-cor">Компания</label>
			</td>
			<td>
				<select class="field-tpl" name="fld-comp-r-<?=$prefix_form?>-cor" id="comp_corr-list">
					<?foreach($arrComp as $Items){?>
						<option <?if($arrAll['company_id'] == $Items['company_id']){?>selected<?}?> value="<?=$Items['company_id']?>"><?=$Items['company_name']?></option>
					<?}?>
				</select>
			</td>
		</tr>
		<tr>
			<td class="field-cover">
				<label for="fld-<?=$prefix_form?>-cor">Отдел</label>
			</td>
			<td>
				<select class="field-tpl" name="fld-comp-<?=$prefix_form?>-cor" id="cor-dep-list">
					<?foreach($arrDep as $Items){?>
						<option <?if($arrAll['department_id'] == $Items['department_id']){?>selected<?}?> value="<?=$Items['department_id']?>"><?=$Items['department_name']?></option>
					<?}?>
				</select>
			</td>
		</tr>
		<tr>
			<td class="field-cover">
				<label for="fld-<?=$prefix_form?>-cor">Группа</label>
			</td>
			<td>
				<input class="field-tpl" type="text" name="fld-name-<?=$prefix_form?>-cor" id="cor-grps-inp-list" value="<?=$arrAll['group_name']?>">
			</td>
		</tr>
		<tr class="btnarea">
			<td style="vertical-align: bottom;" colspan="2">
				<div style="margin: 20px auto 0;">
					<input class="bluebtn" type="submit" value="Редактировать">
						<div style="clear:both"></div>
				</div>
			</td>
		</tr>
	</table>
</form>
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