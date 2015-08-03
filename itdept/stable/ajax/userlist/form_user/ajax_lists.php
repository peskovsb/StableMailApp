<?
require '../../../../../ajax/db.php';

if($_POST['pagi']){
	$pagiPage = $_POST['pagi'];
}else{
	$pagiPage = 1;
}

if($_POST['limit']){
	$limit = $_POST['limit'];
}else{
	$limit = 30;
}

if($_POST['type']){
	$typePage = $_POST['type'];
}else{
	$typePage = 0;
}
if($_POST['staff_search']){
	$searchData = $_POST['staff_search'];
}
if($_POST['staff_option']){
	$searchOption = $_POST['staff_option'];
}
//echo $_POST['staff_option'];
class mainpage_query{
	public $arrBest;
	public $arrCheckRepl;
	public $db;
	public $db_infoline;
	public $pagiPage;
	public $limit;
	public $typePage;
	public $searchData;
	public $searchOption;
	function __construct($pagiPage,$limit,$typePage,$searchOption,$searchData){
		$this->db = new DatabaseItDept();
		$this->dbMail = new Database();
		//$this->db_infoline = new DatabaseInfoline();
		$this->pagiPage = $pagiPage;
		$this->limit = $limit;
		$this->typePage = $typePage;
		$this->searchData = $searchData;
		$this->searchOption = $searchOption;
	}

	function getDatafromtable($varComp,$varDep,$varLoc){
	
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
	
		$this->pagiPage = ($this->pagiPage-1) * $this->limit;
		Switch($this->typePage){
			case '0':
				if($this->searchData){
					if($this->searchOption == '0'){
						$sql = 'SELECT * FROM staff WHERE staff_active = :staff_active AND staff_lastname LIKE :paramname ORDER BY staff_lastname ASC LIMIT '.$this->pagiPage.','.$this->limit;
						$tb = $this->db->connection->prepare($sql);
						$tb->execute(array(':staff_active'=>$this->typePage,':paramname'=>$this->searchData.'%'));
					}else if($this->searchOption == '1'){
						$sql = 'SELECT * FROM staff WHERE staff_active = :staff_active AND staff_name LIKE :paramname ORDER BY staff_lastname ASC LIMIT '.$this->pagiPage.','.$this->limit;
						$tb = $this->db->connection->prepare($sql);
						$tb->execute(array(':staff_active'=>$this->typePage,':paramname'=>$this->searchData.'%'));
					}else if($this->searchOption == '2'){
						$sql = 'SELECT * FROM staff WHERE staff_active = :staff_active AND staff_secondname LIKE :paramname ORDER BY staff_lastname ASC LIMIT '.$this->pagiPage.','.$this->limit;
						$tb = $this->db->connection->prepare($sql);
						$tb->execute(array(':staff_active'=>$this->typePage,':paramname'=>$this->searchData.'%'));
					}
				}else{
					if(count($arrExc)>0){
						$sql = 'SELECT * FROM staff WHERE staff_active = :staff_active AND '.$strExp.' ORDER BY staff_lastname ASC LIMIT '.$this->pagiPage.','.$this->limit;
						$tb = $this->db->connection->prepare($sql);
						$arrExc['staff_active'] = $this->typePage;
						$tb->execute($arrExc);
					}else{
						$sql = 'SELECT * FROM staff WHERE staff_active = :staff_active ORDER BY staff_lastname ASC LIMIT '.$this->pagiPage.','.$this->limit;
						$tb = $this->db->connection->prepare($sql);
						$tb->execute(array(':staff_active'=>$this->typePage));					
					}						
				}			
			break;
			case '1':
				if($this->searchData){
					if($this->searchOption == '0'){
						$sql = 'SELECT * FROM staff WHERE staff_active = :staff_active AND staff_datedeactive = "0000-00-00 00:00:00" AND staff_typedeactive = "" AND staff_lastname LIKE :paramname ORDER BY staff_lastname ASC LIMIT '.$this->pagiPage.','.$this->limit;
						$tb = $this->db->connection->prepare($sql);
						$tb->execute(array(':staff_active'=>$this->typePage,':paramname'=>$this->searchData.'%'));
					}else if($this->searchOption == '1'){
						$sql = 'SELECT * FROM staff WHERE staff_active = :staff_active AND staff_datedeactive = "0000-00-00 00:00:00" AND staff_typedeactive = "" AND staff_name LIKE :paramname ORDER BY staff_lastname ASC LIMIT '.$this->pagiPage.','.$this->limit;
						$tb = $this->db->connection->prepare($sql);
						$tb->execute(array(':staff_active'=>$this->typePage,':paramname'=>$this->searchData.'%'));
					}else if($this->searchOption == '2'){
						$sql = 'SELECT * FROM staff WHERE staff_active = :staff_active AND staff_datedeactive = "0000-00-00 00:00:00" AND staff_typedeactive = "" AND staff_secondname LIKE :paramname ORDER BY staff_lastname ASC LIMIT '.$this->pagiPage.','.$this->limit;
						$tb = $this->db->connection->prepare($sql);
						$tb->execute(array(':staff_active'=>$this->typePage,':paramname'=>$this->searchData.'%'));
					}
				}else{
					if(count($arrExc)>0){
						$sql = 'SELECT * FROM staff WHERE staff_active = :staff_active AND staff_datedeactive = "0000-00-00 00:00:00" AND staff_typedeactive = "" AND '.$strExp.' ORDER BY staff_lastname ASC LIMIT '.$this->pagiPage.','.$this->limit;
						$tb = $this->db->connection->prepare($sql);
						$arrExc['staff_active'] = $this->typePage;
						$tb->execute($arrExc);						
					}else{
						$sql = 'SELECT * FROM staff WHERE staff_active = :staff_active AND staff_datedeactive = "0000-00-00 00:00:00" AND staff_typedeactive = "" ORDER BY staff_lastname ASC LIMIT '.$this->pagiPage.','.$this->limit;
						$tb = $this->db->connection->prepare($sql);
						$tb->execute(array(':staff_active'=>$this->typePage));
					}
				}
			break;
			case '2':
				if($this->searchData){
					if($this->searchOption == '0'){
						$sql = 'SELECT * FROM staff WHERE (staff_active = :staff_active OR staff_typedeactive = "0" OR staff_typedeactive = "1") AND staff_lastname LIKE :paramname ORDER BY  staff_lastname ASC LIMIT '.$this->pagiPage.','.$this->limit;
						$tb = $this->db->connection->prepare($sql);
						$tb->execute(array(':staff_active'=>$this->typePage,':paramname'=>$this->searchData.'%'));	
					}else if($this->searchOption == '1'){
						$sql = 'SELECT * FROM staff WHERE (staff_active = :staff_active OR staff_typedeactive = "0" OR staff_typedeactive = "1") AND staff_name LIKE :paramname ORDER BY  staff_lastname ASC LIMIT '.$this->pagiPage.','.$this->limit;
						$tb = $this->db->connection->prepare($sql);
						$tb->execute(array(':staff_active'=>$this->typePage,':paramname'=>$this->searchData.'%'));	
					}else if($this->searchOption == '2'){
						$sql = 'SELECT * FROM staff WHERE (staff_active = :staff_active OR staff_typedeactive = "0" OR staff_typedeactive = "1") AND staff_secondname LIKE :paramname ORDER BY  staff_lastname ASC LIMIT '.$this->pagiPage.','.$this->limit;
						$tb = $this->db->connection->prepare($sql);
						$tb->execute(array(':staff_active'=>$this->typePage,':paramname'=>$this->searchData.'%'));	
					}
				}else{
					if(count($arrExc)>0){
						$sql = 'SELECT * FROM staff WHERE (staff_active = :staff_active OR staff_typedeactive = "0" OR staff_typedeactive = "1") AND '.$strExp.' ORDER BY  staff_lastname ASC LIMIT '.$this->pagiPage.','.$this->limit;
						$tb = $this->db->connection->prepare($sql);
						$arrExc['staff_active'] = $this->typePage;
						$tb->execute($arrExc);
					}else{
						$sql = 'SELECT * FROM staff WHERE staff_active = :staff_active OR staff_typedeactive = "0" OR staff_typedeactive = "1" ORDER BY  staff_lastname ASC LIMIT '.$this->pagiPage.','.$this->limit;
						$tb = $this->db->connection->prepare($sql);
						$tb->execute(array(':staff_active'=>$this->typePage));
					}
				}
			break;
			case '3':
				if($this->searchData){
					if($this->searchOption == '0'){	
						$sql = 'SELECT * FROM staff WHERE staff_lastname LIKE :paramname ORDER BY staff_lastname ASC LIMIT '.$this->pagiPage.','.$this->limit;
						$tb = $this->db->connection->prepare($sql);
						$tb->execute(array(':paramname'=>$this->searchData.'%'));	
					}else if($this->searchOption == '1'){
						$sql = 'SELECT * FROM staff WHERE staff_name LIKE :paramname ORDER BY staff_lastname ASC LIMIT '.$this->pagiPage.','.$this->limit;
						$tb = $this->db->connection->prepare($sql);
						$tb->execute(array(':paramname'=>$this->searchData.'%'));
					}else if($this->searchOption == '2'){
						$sql = 'SELECT * FROM staff WHERE staff_secondname LIKE :paramname ORDER BY staff_lastname ASC LIMIT '.$this->pagiPage.','.$this->limit;
						$tb = $this->db->connection->prepare($sql);
						$tb->execute(array(':paramname'=>$this->searchData.'%'));
					}
				}else{
					if(count($arrExc)>0){
						$sql = 'SELECT * FROM staff WHERE '.$strExp.' ORDER BY staff_lastname ASC LIMIT '.$this->pagiPage.','.$this->limit;
						$tb = $this->db->connection->prepare($sql);
						$tb->execute($arrExc);
					}else{
						$sql = 'SELECT * FROM staff ORDER BY staff_lastname ASC LIMIT '.$this->pagiPage.','.$this->limit;
						$tb = $this->db->connection->prepare($sql);
						$tb->execute();
					}
						//echo $strExp;
							/*echo '<pre>';
								print_r($arrExc);
							echo '</pre>';*/
				}			
			break;
			default:
				$sql = 'SELECT * FROM staff ORDER BY staff_lastname ASC LIMIT '.$this->pagiPage.','.$this->limit;
				$tb = $this->db->connection->prepare($sql);
				$tb->execute();			
		}	
		$this->arrBest = $tb->fetchAll(PDO::FETCH_ASSOC);
		return $this->arrBest;
	}	
	function getCompanyById($param){
		$sql = 'SELECT * FROM company WHERE company_id = :company_id';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':company_id'=>$param));
		$this->arrBest = $tb->fetch(PDO::FETCH_ASSOC);
		return $this->arrBest;
	}	
	function getGroupyById($param){
		$sql = 'SELECT * FROM groups WHERE gr_id = :gr_id';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':gr_id'=>$param));
		$this->arrBest = $tb->fetch(PDO::FETCH_ASSOC);
		return $this->arrBest;
	}	
	function getDepById($param){
		$sql = 'SELECT * FROM department WHERE department_id = :department_id';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':department_id'=>$param));
		$this->arrBest = $tb->fetch(PDO::FETCH_ASSOC);
		return $this->arrBest;
	}
	/*function getAvatar($param1,$param2,$param3){
		$sql = 'SELECT * FROM infoline_users WHERE lastname = :lastname AND firstname = :firstname AND middlename =:middlename';
		$tb = $this->db_infoline->connection->prepare($sql);
		$tb->execute(array(':lastname'=>$param1,':firstname'=>$param2,':middlename'=>$param3));
		$this->arrBest = $tb->fetch(PDO::FETCH_ASSOC);
		return $this->arrBest;
	}*/
	function getLocation($param){		
		$sql = 'SELECT * FROM location WHERE location_id = :location_id';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':location_id'=>$param));
		$this->arrBest = $tb->fetch(PDO::FETCH_ASSOC);
		return $this->arrBest;
	}
	
	function getMail($param){		
		$sql = 'SELECT * FROM users WHERE staff_id = :staff_id';
		$tb = $this->dbMail->connection->prepare($sql);
		$tb->execute(array(':staff_id'=>$param));
		$this->arrBest = $tb->fetch(PDO::FETCH_ASSOC);
		return $this->arrBest;
	}
}

$getData = new mainpage_query($pagiPage,$limit,$typePage,$_POST['staff_option'],$searchData);

$getter = $getData ->getDatafromtable($_POST['valComp_filt'],$_POST['valDep_filt'],$_POST['valLoca_filt']);

$counter = 0;
foreach($getter as $arItMs){
$companyName = $getData -> getCompanyById($arItMs['staff_company_id']);
$depName = $getData -> getDepById($arItMs['staff_depart_id']);
$grName = $getData -> getGroupyById($arItMs['staff_group_id']);
//$avatar = $getData -> getAvatar($arItMs['staff_lastname'],$arItMs['staff_name'],$arItMs['staff_secondname']);
$locaName = $getData -> getLocation($arItMs['staff_location']);
$UserMail = $getData -> getMail($arItMs['staff_id']);
	$getter[$counter]['staff_company_id'] = $companyName['company_name'];
	$getter[$counter]['staff_depart_id'] = $depName['department_name'];
	if($arItMs['staff_ats']=='0'){$getter[$counter]['staff_ats'] = '';}
	if($arItMs['staff_group_id']=='0'){$getter[$counter]['staff_group_id'] = '';}else{
		$getter[$counter]['staff_group_id'] = $grName['group_name'];
	}
	if($arItMs['staff_avatar']){$getter[$counter]['staff_avatar'] = $arItMs['staff_avatar'];}else{$getter[$counter]['staff_avatar']='no-image.jpg';}
	$getter[$counter]['staff_location'] = $locaName['location_name'];
	if($arItMs['staff_active'] == '0'){$getter[$counter]['staff_status'] = 'В ожидании';}
	if($arItMs['staff_typedeactive']=='0'){$getter[$counter]['staff_status'] = 'Уволен';}
	if($arItMs['staff_typedeactive']=='1'){$getter[$counter]['staff_status'] = 'Декрет';}
	if($UserMail['email']){$getter[$counter]['staff_email'] = $UserMail['email'];}
$counter ++;
}

/*echo '<pre>';
	print_r($getter);
echo '</pre>';*/
echo json_encode($getter);
?>