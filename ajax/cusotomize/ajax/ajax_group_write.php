<?
require '../../db.php';



//--VARS
$nameGroup = trim($_GET['nameGroup']);
$grp_createuser = trim($_GET['grp-createuser']);
$grp_view = trim($_GET['grp-view']);
$grp_view2 = trim($_GET['grp-view2']);
$grp_view3 = trim($_GET['grp-view3']);
$grp_correct = trim($_GET['grp-correct']);
$grp_correct2 = trim($_GET['grp-correct2']);
$grp_correct3 = trim($_GET['grp-correct3']);
$grp_createuser2 = trim($_GET['grp-createuser2']);
$grp_createuser3 = trim($_GET['grp-createuser3']);
$komment_group = trim($_GET['komment_group']);


class mainpage_query{
	public $arrBest;
	public $rezArr;
	public $db;
	function __construct(){
		$this->db = new DatabaseItDept();
	}
	
	function getAllfromtable($nameGroup,$grp_createuser,$grp_view,$grp_view2,$grp_correct,$grp_correct2,$grp_createuser2,$komment_group,$grp_createuser3,$grp_correct3,$grp_view3){
		if($grp_view == 'on'){$grp_view='1';}else{$grp_view='0';}
		if($grp_view2 == 'on'){$grp_view2='1';}else{$grp_view2='0';}
		if($grp_view3 == 'on'){$grp_view3='1';}else{$grp_view3='0';}
		if($grp_correct == 'on'){$grp_correct='1';}else{$grp_correct='0';}
		if($grp_correct2 == 'on'){$grp_correct2='1';}else{$grp_correct2='0';}
		if($grp_correct3 == 'on'){$grp_correct3='1';}else{$grp_correct3='0';}
		if($grp_createuser == 'on'){$grp_createuser='1';}else{$grp_createuser='0';}
		if($grp_createuser2 == 'on'){$grp_createuser2='1';}else{$grp_createuser2='0';}
		if($grp_createuser3 == 'on'){$grp_createuser3='1';}else{$grp_createuser3='0';}
		
			//-- WRITING DB
			$sql = 'INSERT INTO levels (level_name) VALUES (:level_name)';
			$tb = $this->db->connection->prepare($sql);
			$tb->execute(array(':level_name'=>$nameGroup));	

			$sql = 'SELECT * FROM levels WHERE level_name = :level_name ORDER BY level_id DESC';
			$tb = $this->db->connection->prepare($sql);
			$tb->execute(array(':level_name'=>$nameGroup));
			$this->arrBest = $tb->fetch(PDO::FETCH_ASSOC);	
			
			$sql = 'INSERT INTO operations (oper_connect_id,oper_create_post,oper_view_post,oper_correct_post,oper_create_forw,oper_view_forw,oper_correct_forw,komment_group,oper_view_staff,oper_correct_staff,oper_create_staff) VALUES (:oper_connect_id,:oper_create_post,:oper_view_post,:oper_correct_post,:oper_create_forw,:oper_view_forw,:oper_correct_forw,:komment_group,:oper_view_staff,:oper_correct_staff,:oper_create_staff)';
			$tb = $this->db->connection->prepare($sql);
			$tb->execute(array(':oper_connect_id'=>$this->arrBest['level_id'],':oper_create_post'=>$grp_createuser,':oper_view_post'=>$grp_view,':oper_correct_post'=>$grp_correct,':oper_create_forw'=>$grp_createuser2,':oper_view_forw'=>$grp_view2,'oper_correct_forw'=>$grp_correct2,':oper_create_staff'=>$grp_createuser3,':oper_view_staff'=>$grp_view3,':oper_correct_staff'=>$grp_correct3,':komment_group'=>$komment_group));	
	}	
}
$getData = new mainpage_query();
$arrGetter = $getData ->getAllfromtable($nameGroup,$grp_createuser,$grp_view,$grp_view2,$grp_correct,$grp_correct2,$grp_createuser2,$komment_group,$grp_createuser3,$grp_correct3,$grp_view3);
?>
