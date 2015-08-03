<?
	require '../../ajax/db.php';
	$db = new DatabaseItdept();
	$sql = 'SELECT * from company;';
	$tb = $db->connection->prepare($sql);
	$tb->execute();
	$allData = $tb->fetchAll(PDO::FETCH_ASSOC);
	require 'menu_tabs.php';
?>


<h2 class="inUheader">Дерево отделов</h2>
<div style="clear:both"></div>
<?
$pref_tbl = 'department';
foreach($allData as $Items){?>
	<div class="wrapper-node" id="<?=$pref_tbl?>_nodeId<?=$Items["company_id"];?>">
		<div class="node-basic-tree first-node-tree" data-id_f="<?=$Items["company_id"];?>">
			<div class="text-node-tree"><span onclick="putNodes('<?=$Items["company_id"];?>','<?=$pref_tbl?>')" class="plus-node-tree">+</span> <?=$Items["company_name"];?></div> <div style="clear:both"></div>
		</div>
			<div class="ajax_nodes">
				<!-- HERE is Wrapper node -->
			</div>		
	</div> 
<?}?>
