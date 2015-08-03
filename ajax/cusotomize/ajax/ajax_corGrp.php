<?
require '../../db.php';

$level_id = $_GET['data-grpid'];

$db = new DatabaseItDept();
	$sql = 'SELECT * FROM levels WHERE level_id = :level_id';
	$tb = $db->connection->prepare($sql);
	$tb->execute(array(':level_id'=>$level_id));
	$arrLevels = $tb->fetch(PDO::FETCH_ASSOC);
	
	$sql = 'SELECT * FROM operations WHERE oper_connect_id = :level_id';
	$tb = $db->connection->prepare($sql);
	$tb->execute(array(':level_id'=>$arrLevels['level_id']));
	$arrOperations = $tb->fetch(PDO::FETCH_ASSOC);
	//echo '<pre>';print_r($arrOperations);echo '</pre>';
	
	//echo $arrOperations['oper_view_staff'];
?>


<!--GROUPS START HERE-->
<div class="wrapper-groups-brd">
	<form id="CorGroupManager">
		<div class="wrapper-gr-padding">
			<div class="groupCl">
				<input value="<?=$arrLevels['level_id']?>" id="idGroup" type="hidden" name="idGroup">
				<input value="<?=$arrLevels['level_name']?>" id="FirstNameGroup" type="hidden" name="FirstNameGroup">
				<label style="margin-right:10px;">Название: </label> <input value="<?=$arrLevels['level_name']?>" class="field-tpl" id="nameGroup" type="text" name="nameGroup">
			</div>
			<div class="header-Groups">Права на группу</div>
			<div class="wrapper-groups-tbl">
				<div class="tbl-row-grh tbl-groups-header" style="border-radius: 4px 0 0 4px;overflow: hidden;"><div style="border-left:1px solid #ccc;" class="inner-padd-gr-name">Ящики</div></div>
				<div class="tbl-row-grh tbl-groups-header" style=" overflow: hidden;"><div class="inner-padd-gr-name">Переадресация</div></div>
				<div class="tbl-row-grh tbl-groups-header" style="border-radius: 0px 4px 4px 0px; overflow: hidden;"><div style="border-right:1px solid #ccc;" class="inner-padd-gr-name">Сотрудники</div></div>
				<div class="tbl-row-grh tbl-groups-ell">
					<table class="tbl-inbtl-grp" style="width:auto;">
						<tr>
							<td><label for="grp-createuser">Создание</label></td>
							<td><input id="grp-createuser" type="checkbox" <?if($arrOperations['oper_create_post']){?>checked<?}?> name="grp-createuser"></td>
						</tr>
						<tr>
							<td><label for="grp-view">Просмотр</label></td>
							<td><input id="grp-view" type="checkbox" <?if($arrOperations['oper_view_post']){?>checked<?}?> name="grp-view"></td>
						</tr>
						<tr>
							<td><label for="grp-correct">Редактирование</label></td>
							<td><input id="grp-correct" type="checkbox" <?if($arrOperations['oper_correct_post']){?>checked<?}?> name="grp-correct"></td>
						</tr>
					</table>
				</div>
				<div class="tbl-row-grh tbl-groups-ell">
					<table class="tbl-inbtl-grp" style="width:auto;">
						<tr>
							<td><label for="grp-createuser2">Создание</label></td>
							<td><input id="grp-createuser2" type="checkbox" <?if($arrOperations['oper_create_forw']){?>checked<?}?> name="grp-createuser2"></td>
						</tr>
						<tr>
							<td><label for="grp-view2">Просмотр</label></td>
							<td><input id="grp-view2" type="checkbox" <?if($arrOperations['oper_view_forw']){?>checked<?}?> name="grp-view2"></td>
						</tr>
						<tr>
							<td><label for="grp-correct2">Редактирование</label></td>
							<td><input id="grp-correct2" type="checkbox" <?if($arrOperations['oper_correct_forw']){?>checked<?}?> name="grp-correct2"></td>
						</tr>
					</table>							
				</div>
				<div class="tbl-row-grh tbl-groups-ell">
					<table class="tbl-inbtl-grp" style="width:auto;">
						<tr>
							<td><label for="grp-createuser3">Создание</label></td>
							<td><input id="grp-createuser3" type="checkbox" <?if($arrOperations['oper_create_staff']){?>checked<?}?> name="grp-createuser3"></td>
						</tr>
						<tr>
							<td><label for="grp-view3">Просмотр</label></td>
							<td><input id="grp-view3" type="checkbox" <?if($arrOperations['oper_view_staff']){?>checked<?}?> name="grp-view3"></td>
						</tr>
						<tr>
							<td><label for="grp-correct3">Редактирование</label></td>
							<td><input id="grp-correct3" type="checkbox" <?if($arrOperations['oper_correct_staff']){?>checked<?}?> name="grp-correct3"></td>
						</tr>
					</table>							
				</div>				
					<div style="clear:both"></div>
					<textarea class="field-tpl" name="komment_group" id="komment_group" placeholder="Комментарий к группе" style="width: 100%;  vertical-align: bottom;  border: none;margin-top:10px;-webkit-border-bottom-right-radius: 4px; -webkit-border-bottom-left-radius: 4px; -moz-border-radius-bottomright: 4px; -moz-border-radius-bottomleft: 4px; border-bottom-right-radius: 4px; border-bottom-left-radius: 4px;-webkit-border-top-left-radius: 0px;-webkit-border-top-right-radius: 0px;"><?if($arrOperations['komment_group']){echo $arrOperations['komment_group'];}?></textarea>
			</div>
			<input type="submit" value="Создать группу" style="float:none;  margin-bottom: 10px;" class="BtnCreateInnerGrp2">
		</div>
	</form>
</div>