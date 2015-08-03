<?
require '../../../../../ajax/db.php';
require 'arrFields.php';
require 'pref_comp.php';

$db = new DatabaseItDept();
if($_POST['depId'] == 0){
	$sql = 'SELECT * FROM groups ORDER by group_name ASC';
}else{
	$sql = 'SELECT * FROM groups WHERE department_id = :department_id';	
}

	$tb = $db->connection->prepare($sql);
	$tb->execute(array(':department_id'=>$_POST['depId']));
	$getData = $tb->fetchAll(PDO::FETCH_ASSOC);	
	//print_r($getData);
?>

	<option value="0">-- Группа --</option>
	<?foreach($getData as $f_item){?>
		<option value="<?=$f_item['gr_id']?>"><?=$f_item['group_name']?></option>
	<?}?>