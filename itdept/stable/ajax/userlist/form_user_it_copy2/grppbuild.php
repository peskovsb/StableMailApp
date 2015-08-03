<?
require '../../../db.php';
require 'arrFields.php';

$db = new DatabaseItDept();
	$sql = 'SELECT * FROM groups WHERE department_id = :department_id';
	$tb = $db->connection->prepare($sql);
	$tb->execute(array(':department_id'=>$_POST['depId']));
	$getData = $tb->fetchAll(PDO::FETCH_ASSOC);	
	//print_r($getData);
if(count($getData)>0){
?>
<tr id="groups-form">
	<td class="field-cover">
		<label for="<?=$prefix?>department">Группу</label>
	</td>
	<td style="position:relative;width:358px">
		<select class="field-tpl" name="<?=$prefix?>groupdep" id="<?=$prefix?>groupdep">
			<option value="0">-- Выберите Группу --</option>
			<?foreach($getData as $f_item){?>
				<option value="<?=$f_item['gr_id']?>"><?=$f_item['group_name']?></option>
			<?}?>								
		</select>
		<i style="  margin-left: 10px;color: rgb(0, 153, 0);" class="fa fa-check-circle exelfiledIU"></i>
	</td>
</tr>
<?}?>