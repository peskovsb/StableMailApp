<?
session_start();

//--itdept DB
require '../../db.php';

$db = new DatabaseItDept();
$sql = 'SELECT * FROM groups WHERE department_id = :department_id ORDER by groups.group_name';
$tb = $db->connection->prepare($sql);
$tb->execute(array(':department_id'=>$_POST['compId']));
$arrAll = $tb->fetchAll(PDO::FETCH_ASSOC);
/*echo '<pre>';
	print_r($arrAll);
echo '</pre>';*/
$sql = 'SELECT * FROM department WHERE department_id = :department_id';
$tb = $db->connection->prepare($sql);
$tb->execute(array(':department_id'=>$_POST['compId']));
$arrCompany = $tb->fetch(PDO::FETCH_ASSOC);


$pref_tbl = 'grps';
foreach($arrAll as $Items){?>
	<div class="wrapper-node">
		<div class="node-basic-tree third-node-tree" data-id_f="<?=$Items["gr_id"]?>">
			<div class="inner-third-node-tree">
				<div class="line-third-tree"></div>
				<div class="text-node-tree left-margin-tree"><?=$Items["group_name"]?></div> <i id="cor-<?=$pref_tbl?>-field" class="fa fa-wrench correct-wrech"></i> <i id="del-<?=$pref_tbl?>-field" class="fa fa-trash-o correct-trash"></i><div style="clear:both"></div>
			</div>
		</div>
	</div>	
<?}?>
		<div class="wrapper-node">
			<div class="node-basic-tree third-node-tree-add">
				<div class="inner-third-node-tree-add">
					<div class="line-third-tree-add"></div>
					<div class="text-node-tree"><a data-comp-id="<?=$arrCompany["company_id"]?>" data-dep-id="<?=$_POST['compId']?>" id="create_grps" class="round-btn-add" href="javascript:void(0);">Добавить группу</a></div>
					<div style="clear:both"></div>
				</div>
			</div>
		</div>	