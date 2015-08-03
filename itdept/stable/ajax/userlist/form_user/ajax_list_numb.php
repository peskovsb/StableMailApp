<?
require '../../../../../ajax/db.php';

if($_GET['typePage']){
	$typePage = $_GET['typePage'];
}else{
	$typePage = '0';
}

if($_GET['staff_search']){
	$searchData = $_GET['staff_search'];
}
if($_GET['staff_option']){
	$searchOption = $_GET['staff_option'];
}

class mainpage_CountDB{
	public $arrC;
	public $arrBest;
	public $db;
	function __construct(){
		$this->db = new DatabaseItDept();
	}
	function getSumm($typePage,$searchOption,$searchData,$varComp,$varDep,$varLoc){
	
	//--Part Filtering
	$counter = 0;
	$strExp = '';
		if($varLoc!=0){
			if($counter !=0){
				$strExp .= ' AND staff_location = :varLoc';
			}else{
				$strExp = 'staff_location = :varLoc';
			}
			$arrExc['varLoc'] = $varLoc;
			$counter ++;
		}
		if($varComp!=0){
			if($counter !=0){
				$strExp .= ' AND staff_company_id = :varComp';
			}else{
				$strExp = 'staff_company_id = :varComp';
			}
			$arrExc['varComp'] = $varComp;
			$counter ++;
		}
		if($varDep!=0){
			if($counter !=0){
				$strExp .= ' AND staff_depart_id = :varDep';
			}else{
				$strExp = 'staff_depart_id = :varDep';
			}
			$arrExc['varDep'] = $varDep;
		}		
	//--End--	
	
	switch($typePage){
		case '0':
			if($searchData){
				if($searchOption == '0'){	
					$sql = 'SELECT COUNT(staff_id) as DbSumm FROM staff WHERE staff_active = :staff_active AND staff_lastname LIKE :paramname';
					$tb = $this->db->connection->prepare($sql);
					$tb->execute(array(':staff_active'=>$typePage,':paramname'=>$searchData.'%'));
				}else if($searchOption == '1'){
					$sql = 'SELECT COUNT(staff_id) as DbSumm FROM staff WHERE staff_active = :staff_active AND staff_name LIKE :paramname';
					$tb = $this->db->connection->prepare($sql);
					$tb->execute(array(':staff_active'=>$typePage,':paramname'=>$searchData.'%'));
				}else if($searchOption == '2'){
					$sql = 'SELECT COUNT(staff_id) as DbSumm FROM staff WHERE staff_active = :staff_active AND staff_secondname LIKE :paramname';
					$tb = $this->db->connection->prepare($sql);
					$tb->execute(array(':staff_active'=>$typePage,':paramname'=>$searchData.'%'));
				}
			}else{
				if(count($arrExc)>0){
					$sql = 'SELECT COUNT(staff_id) as DbSumm FROM staff WHERE staff_active = :staff_active AND '.$strExp.'';
					$tb = $this->db->connection->prepare($sql);
					$arrExc['staff_active'] = $typePage;
					$tb->execute($arrExc);
				}else{
					$sql = 'SELECT COUNT(staff_id) as DbSumm FROM staff WHERE staff_active = :staff_active';
					$tb = $this->db->connection->prepare($sql);
					$tb->execute(array(':staff_active'=>$typePage));
				}			
			}
		break;
		case '1':
			if($searchData){
				if($searchOption == '0'){	
					$sql = 'SELECT COUNT(staff_id) as DbSumm FROM staff WHERE staff_active = :staff_active AND staff_datedeactive = "0000-00-00 00:00:00" AND staff_typedeactive = "" AND staff_lastname LIKE :paramname';
					$tb = $this->db->connection->prepare($sql);
					$tb->execute(array(':staff_active'=>$typePage,':paramname'=>$searchData.'%'));
				}else if($searchOption == '1'){
					$sql = 'SELECT COUNT(staff_id) as DbSumm FROM staff WHERE staff_active = :staff_active AND staff_datedeactive = "0000-00-00 00:00:00" AND staff_typedeactive = "" AND staff_name LIKE :paramname';
					$tb = $this->db->connection->prepare($sql);
					$tb->execute(array(':staff_active'=>$typePage,':paramname'=>$searchData.'%'));
				}else if($searchOption == '2'){
					$sql = 'SELECT COUNT(staff_id) as DbSumm FROM staff WHERE staff_active = :staff_active AND staff_datedeactive = "0000-00-00 00:00:00" AND staff_typedeactive = "" AND staff_secondname LIKE :paramname';
					$tb = $this->db->connection->prepare($sql);
					$tb->execute(array(':staff_active'=>$typePage,':paramname'=>$searchData.'%'));
				}
			}else{
				if(count($arrExc)>0){
					$sql = 'SELECT COUNT(staff_id) as DbSumm FROM staff WHERE staff_active = :staff_active AND staff_datedeactive = "0000-00-00 00:00:00" AND staff_typedeactive = "" AND '.$strExp.'';
					$tb = $this->db->connection->prepare($sql);
					$arrExc['staff_active'] = $typePage;
					$tb->execute($arrExc);
				}else{
					$sql = 'SELECT COUNT(staff_id) as DbSumm FROM staff WHERE staff_active = :staff_active AND staff_datedeactive = "0000-00-00 00:00:00" AND staff_typedeactive = ""';
					$tb = $this->db->connection->prepare($sql);
					$tb->execute(array(':staff_active'=>$typePage));
				}
			}			
		break;
		case '2':
			if($searchData){
				if($searchOption == '0'){	
					$sql = 'SELECT COUNT(staff_id) as DbSumm FROM staff WHERE (staff_active = :staff_active OR staff_typedeactive = "0" OR staff_typedeactive = "1") AND staff_lastname LIKE :paramname';
					$tb = $this->db->connection->prepare($sql);
					$tb->execute(array(':staff_active'=>$typePage,':paramname'=>$searchData.'%'));
				}else if($searchOption == '1'){
					$sql = 'SELECT COUNT(staff_id) as DbSumm FROM staff WHERE (staff_active = :staff_active OR staff_typedeactive = "0" OR staff_typedeactive = "1") AND staff_name LIKE :paramname';
					$tb = $this->db->connection->prepare($sql);
					$tb->execute(array(':staff_active'=>$typePage,':paramname'=>$searchData.'%'));
				}else if($searchOption == '2'){
					$sql = 'SELECT COUNT(staff_id) as DbSumm FROM staff WHERE (staff_active = :staff_active OR staff_typedeactive = "0" OR staff_typedeactive = "1") AND staff_secondname LIKE :paramname';
					$tb = $this->db->connection->prepare($sql);
					$tb->execute(array(':staff_active'=>$typePage,':paramname'=>$searchData.'%'));
				}
			}else{
				if(count($arrExc)>0){
					$sql = 'SELECT COUNT(staff_id) as DbSumm FROM staff WHERE (staff_active = :staff_active OR staff_typedeactive = "0" OR 		staff_typedeactive = "1") AND '.$strExp.'';
					$tb = $this->db->connection->prepare($sql);					
					$arrExc['staff_active'] = $typePage;
					$tb->execute($arrExc);	
				}else{
					$sql = 'SELECT COUNT(staff_id) as DbSumm FROM staff WHERE staff_active = :staff_active OR staff_typedeactive = "0" OR 		staff_typedeactive = "1"';
					$tb = $this->db->connection->prepare($sql);
					$tb->execute(array(':staff_active'=>$typePage));				
				}	
			}		
		break;
		case '3':
			if($searchData){
				if($searchOption == '0'){	
					$sql = 'SELECT COUNT(staff_id) as DbSumm FROM staff WHERE staff_lastname LIKE :paramname';
					$tb = $this->db->connection->prepare($sql);
					$tb->execute(array(':paramname'=>$searchData.'%'));
				}else if($searchOption == '1'){
					$sql = 'SELECT COUNT(staff_id) as DbSumm FROM staff WHERE staff_name LIKE :paramname';
					$tb = $this->db->connection->prepare($sql);
					$tb->execute(array(':paramname'=>$searchData.'%'));
				}else if($searchOption == '2'){
					$sql = 'SELECT COUNT(staff_id) as DbSumm FROM staff WHERE staff_secondname LIKE :paramname';
					$tb = $this->db->connection->prepare($sql);
					$tb->execute(array(':paramname'=>$searchData.'%'));
				}
			}else{
				if(count($arrExc)>0){
					$sql = 'SELECT COUNT(staff_id) as DbSumm FROM staff WHERE '.$strExp.'';
					$tb = $this->db->connection->prepare($sql);
					$tb->execute($arrExc);
				}else{
					$sql = 'SELECT COUNT(staff_id) as DbSumm FROM staff';
					$tb = $this->db->connection->prepare($sql);
					$tb->execute();					
				}
			}
		break;
		default:
			$sql = 'SELECT COUNT(staff_id) as DbSumm FROM staff';
			$tb = $this->db->connection->prepare($sql);
			$tb->execute();			
	}
		
		//return $sql;

		$this->arrBest = $tb->fetch(PDO::FETCH_ASSOC);
		return $this->arrBest;
	}		
}

//-- We count DB for DESC
$getSumm = new mainpage_CountDB();
$DBsum = $getSumm -> getSumm($typePage,$_GET['staff_option'],$searchData,$_GET['valComp_filt'],$_GET['valDep_filt'],$_GET['valLoca_filt']);

echo json_encode($DBsum)
?>