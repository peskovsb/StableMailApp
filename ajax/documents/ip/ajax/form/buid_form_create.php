<?
require 'formArr.php';
require '../../../../db.php';
require '../../../../../itdept/stable/ajax/userlist/form_user/pref_comp.php';
require 'script_js.php';
$db = new DatabaseItDept();

$sql = 'SELECT * FROM staff WHERE staff_location = :staff_location ORDER by staff_lastname';
$tb = $db->connection->prepare($sql);
$tb->execute(array(':staff_location'=>$_GET['loc']));
$arrStaff = $tb->fetchAll(PDO::FETCH_ASSOC);

$sql = 'SELECT * FROM comp';
$tb = $db->connection->prepare($sql);
$tb->execute();
$arrComp = $tb->fetchAll(PDO::FETCH_ASSOC);

//echo '<pre>';print_r($arrAll); echo '</pre>';
//echo '<pre>';print_r($pref_comp); echo '</pre>';
?>
<div id="wrapper-<?=$formBuild?>">
	<form id="<?=$formBuild?>-create">
		<div class="form-wrapper-main">
			<input type="hidden" name="ip_location" value="<?=$_GET['loc']?>">
			<table class="form-tbl">
					<?foreach($formArr as $key => $Items){?>
						<tr>
							<td><label for="<?=$Items["name"]?>"><?=$Items["title"]?>:</label></td>
							<td style="position: relative;">
								<?if($key=='staff_id'){?>
									<select class="field-tpl widthform" name="<?=$Items["name"]?>" id="<?=$Items["name"]?>">
										<?foreach($arrStaff as $StItems){?>
											<option value="<?=$StItems['staff_id']?>"><?=$StItems['staff_lastname']?> <?=$StItems['staff_name']?> <?=$StItems['staff_secondname']?> (<?=$StItems['staff_post']?> - <?=$pref_comp[$StItems['staff_company_id']]?>)</option>
										<?}?>
									</select>
								<?}else if($key == 'comp_name'){?>
									<select class="field-tpl widthform" name="<?=$Items["name"]?>" id="<?=$Items["name"]?>">
										<?foreach($arrComp as $CompItems){?>
											<option value="<?=$CompItems['comp_id']?>"><?=$CompItems["comp_name"]?></option>
										<?}?>
									</select>
								<?}else{?>
									<input style="width:60px;" class="field-tpl widthform" name="<?=$Items["name"]?>" id="<?=$Items["name"]?>-create" type="text" value="<?=$_GET['ip']?>">
								<?}?>
							</td>
						</tr>			
					<?}?>
					<tr class="lastrow-tbl">
						<td></td>
						<td><input class="bluebtn" type="submit" value="Сохранить" style="margin:0;"> <a style="margin-left:20px;" onclick="$.fancybox({ closeClick  : true});" class="NotToDell" href="javascript:void(0);">Отмена</a></td>
					</tr>
			</table>
		</div>
	</form>
</div>