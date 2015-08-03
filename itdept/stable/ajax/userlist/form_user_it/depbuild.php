<?
require '../../../../../ajax/db.php';
require 'arrFields.php';

$db = new DatabaseItDept();
	$sql = 'SELECT * FROM department WHERE company_id = :company_id';
	$tb = $db->connection->prepare($sql);
	$tb->execute(array(':company_id'=>$_POST['compId']));
	$getData = $tb->fetchAll(PDO::FETCH_ASSOC);	
	//print_r($getData);
?>
<tr id="dep-form">
	<td class="field-cover">
		<label for="<?=$prefix?>department">Отдел</label>
	</td>
	<td style="position:relative;width:358px">
		<select class="field-tpl" name="<?=$prefix?>department" id="<?=$prefix?>department">
			<option value="0">-- Выберите Отдел --</option>
			<?foreach($getData as $f_item){?>
				<option value="<?=$f_item['department_id']?>"><?=$f_item['department_name']?></option>
			<?}?>								
		</select>
		<i style="  margin-left: 10px;color: rgb(0, 153, 0);" class="fa fa-check-circle exelfiledIU"></i>
	</td>
</tr>