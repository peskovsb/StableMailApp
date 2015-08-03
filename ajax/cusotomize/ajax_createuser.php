<?
require '../db.php';
$db = new DatabaseItDept();
$sql = 'SELECT * FROM levels ORDER BY level_id DESC';
		$tb = $db->connection->prepare($sql);
		$tb->execute();
		$arrLevels = $tb->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- TPL VIEW -->
<form id="FormCreateInnerUser" action="#" method="POST" style="float:left;">
	<table>
		<tr>
			<td class="field-cover">
				<label for="field_inner_login">Логин</label>
			</td>
			<td style="position:relative;">
				<input class="field-tpl" type="text" name="field_inner_login" id="field_inner_login" value="">
				<i style="color: rgb(0, 153, 0);" class="fa fa-check exelfiledIU"></i>
			</td>
		</tr>
		<tr>
			<td class="field-cover">
				<label for="field_inner_pass">Пароль</label>
			</td>
			<td style="position:relative;">
				<a onclick="$('#field_inner_pass').val(str_rand());document.getElementById('field_inner_pass').focus();" title="сгенерировать случайный пароль" class="genpass" id="pasIUgenerator" href="javascript:void(0);"><i style="  font-size: 20px;" class="fa fa-cog"></i></a>
				<input class="field-tpl" type="text" name="field_inner_pass" id="field_inner_pass" value="" style="  padding-right: 25px;  width: 190px;">
				<i style="color: rgb(0, 153, 0);" class="fa fa-check exelfiledIU"></i>
			</td>
		</tr>
		<tr>
			<td class="field-cover">
				<label for="field_inner_levels">Уровень доступа</label>
			</td>
			<td style="position:relative;">
				<select name="field_inner_levels" id="field_inner_list" class="super-fire-list select-list" style="width:190px">
					<option selected="selected" value="1">--Выберите уровень--</option>
					<?foreach($arrLevels as $Items){?>
						<option value="<?=$Items['level_id']?>"><?=$Items['level_name']?></option>
					<?}?>
				</select>
				<i style="color: rgb(0, 153, 0);" class="fa fa-check exelfiledIU"></i>
			</td>
		</tr>
		<tr>
			<td class="field-cover">
				<label for="field_inner_surname">Фамилия</label>
			</td>
			<td style="position:relative;">
				<input class="field-tpl" type="text" name="field_inner_surname" id="field_inner_surname" value="">
				<i style="color: rgb(0, 153, 0);" class="fa fa-check exelfiledIU"></i>
			</td>
		</tr>
		<tr class="lastfld">
			<td class="field-cover">
				<label for="field_inner_name">Имя</label>
			</td>
			<td style="position:relative;">
				<input class="field-tpl" type="text" name="field_inner_name" id="field_inner_name" value="">
				<i style="color: rgb(0, 153, 0);" class="fa fa-check exelfiledIU"></i>
			</td>
		</tr>
		<tr class="btnarea">
			<td style="vertical-align: bottom;" colspan="2">
				<div style="margin:auto;width:320x;">
					<input id="FormIUSender" class="submbtnstyle" type="submit" name="sendIUform" value="Сохранить" style="margin-top:10px;width:auto;">			
					<a onclick="clearAllInnerUser();" class="clearfieldsIU btn-danger" style="margin-top:10px;  width: auto;">Очистить Форму</a>
				</div>
			</td>
		</tr>
	</table>
</form>