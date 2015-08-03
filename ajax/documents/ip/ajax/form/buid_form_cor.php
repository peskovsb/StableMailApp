<?
require 'formArr.php';
require '../../../../db.php';
require '../../../../../itdept/stable/ajax/userlist/form_user/pref_comp.php';
require 'script_js.php';
$db = new DatabaseItDept();
$sql = 'SELECT * FROM ip LEFT JOIN comp ON ip.comp_id = comp.comp_id LEFT JOIN staff ON ip.staff_id = staff.staff_id LEFT JOIN location ON location.location_id = staff.staff_location WHERE ip.ip_id = :ip_id;';
$tb = $db->connection->prepare($sql);
$tb->execute(array(':ip_id'=>$_GET['id']));
$arrAll = $tb->fetch(PDO::FETCH_ASSOC);

$sql = 'SELECT * FROM staff WHERE staff_location = :staff_location ORDER by staff_lastname';
$tb = $db->connection->prepare($sql);
$tb->execute(array(':staff_location'=>$arrAll['staff_location']));
$arrStaff = $tb->fetchAll(PDO::FETCH_ASSOC);

$sql = 'SELECT * FROM comp';
$tb = $db->connection->prepare($sql);
$tb->execute();
$arrComp = $tb->fetchAll(PDO::FETCH_ASSOC);

//echo '<pre>';print_r($arrAll); echo '</pre>';
//echo '<pre>';print_r($pref_comp); echo '</pre>';
?>
<div id="wrapper-<?=$formBuild?>">
	<form id="<?=$formBuild?>-cor">
		<div class="form-wrapper-main">
			<input type="hidden" name="id_id" value="<?=$_GET['id']?>">
			<input type="hidden" name="ip_location" value="<?=$arrAll['staff_location']?>">
			<input type="hidden" name="ip_prev" value="<?=$arrAll["ip"]?>">
			<table class="form-tbl">
					<?foreach($formArr as $key => $Items){?>
						<tr>
							<td><label for="<?=$Items["name"]?>"><?=$Items["title"]?>:</label></td>
							<td style="position: relative;">
								<?if($key=='staff_id'){?>
									<select class="field-tpl widthform" name="<?=$Items["name"]?>" id="<?=$Items["name"]?>">
										<?foreach($arrStaff as $StItems){?>
											<option <?=$arrAll["staff_id"]==$StItems["staff_id"]?'selected':''?> value="<?=$StItems['staff_id']?>"><?=$StItems['staff_lastname']?> <?=$StItems['staff_name']?> <?=$StItems['staff_secondname']?> (<?=$StItems['staff_post']?> - <?=$pref_comp[$StItems['staff_company_id']]?>)</option>
										<?}?>
									</select>
								<?}else if($key == 'comp_name'){?>
									<select class="field-tpl widthform" name="<?=$Items["name"]?>" id="<?=$Items["name"]?>">
										<?foreach($arrComp as $CompItems){?>
											<option <?=$arrAll["comp_id"]==$CompItems["comp_id"]?'selected':''?> value="<?=$CompItems['comp_id']?>"><?=$CompItems["comp_name"]?></option>
										<?}?>
									</select>
								<?}else{?>
									<input style="width:60px;" class="field-tpl widthform" name="<?=$Items["name"]?>" id="<?=$Items["name"]?>" type="text" value="<?=$arrAll["ip"]?>">
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