<?
session_start();

//--itdept DB
require '../../db.php';

$db = new DatabaseItDept();
$sql = 'SELECT department.department_name,department.department_id as depID, groups.group_name FROM department LEFT JOIN groups ON department.department_id = groups.department_id WHERE company_id = :company_id GROUP BY department.department_id ORDER by department.department_name';
$tb = $db->connection->prepare($sql);
$tb->execute(array(':company_id'=>$_POST['compId']));
$arrAll = $tb->fetchAll(PDO::FETCH_ASSOC);
/*echo '<pre>';
	print_r($arrAll);
echo '</pre>';*/

$pref_tbl = 'grps';
foreach($arrAll as $Items){?>
<?//=count($Items['gr_id'])?>
<?=$Items["department_id"];?>
		<div class="wrapper-node" id="<?=$pref_tbl?>_nodeId<?=$Items["depID"];?>">
			<div class="node-basic-tree second-node-tree" data-id_f="<?=$Items["depID"]?>">
				<div class="line-second-tree"></div>
				<div class="text-node-tree"><span onclick="putNodes('<?=$Items["depID"];?>','<?=$pref_tbl?>')" class="plus-node-tree <?if($Items["group_name"]){?>exists-grps<?}?>">+</span> <?=$Items["department_name"]?></div> <i id="cor-department-field" class="fa fa-wrench correct-wrech"></i> <i id="del-department-field" class="fa fa-trash-o correct-trash"></i><div style="clear:both"></div>
			</div>				
			<div class="ajax_nodes">
				<!-- HERE is Wrapper node -->
			</div>			
		</div>	
<?}?>
		<div class="wrapper-node">
			<div class="node-basic-tree second-node-tree-add">
				<div class="line-second-tree-add"></div>
				<div class="text-node-tree"><a id="create_department" data-comp-id = "<?=$_POST['compId']?>" class="round-btn-add" href="javascript:void(0);">Добавить отдел</a></div>
				<div style="clear:both"></div>
			</div>
		</div>