<?
require '../../../../../ajax/db.php';
require 'arrFields.php';
require 'pref_comp.php';

$db = new DatabaseItDept();
if($_POST['compId'] == 0){
	$sql = 'SELECT * FROM department ORDER by department_name ASC';
}else{
	$sql = 'SELECT * FROM department WHERE company_id = :company_id ORDER by department_name ASC';	
}

	$tb = $db->connection->prepare($sql);
	$tb->execute(array(':company_id'=>$_POST['compId']));
	$getData = $tb->fetchAll(PDO::FETCH_ASSOC);	
	//print_r($getData);
?>

	<option value="0">-- Отдел --</option>
	<?foreach($getData as $f_item){?>
		<?if($_POST['compId'] == 0){?>
			<option value="<?=$f_item['department_id']?>"><?=$f_item['department_name']?> (<?=$pref_comp[$f_item['company_id']]?>)</option>
		<?}else{?>
			<option value="<?=$f_item['department_id']?>"><?=$f_item['department_name']?></option>
		<?}?>
	<?}?>