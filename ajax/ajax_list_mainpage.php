<?
session_start();
require 'db.php';
require 'secfile.php';
if($userLevel['oper_view_post']==0){
	exit;
}

//-- PARAMS
//print_r($_COOKIE);
if($_COOKIE['showpages']){
	$limit = $_COOKIE['showpages'];
}else{$limit = 30;}
	if($_COOKIE['pageM']){
		$pagiPage = $_COOKIE['pageM'];
	}else{
		$pagiPage = $_GET['pagipage'];
	}
	//$pagiPage = $_GET['pagipage'];
	
if($pagiPage){
	$getPage = $pagiPage;
	$pagiPage = ($pagiPage-1) * $limit;
}else{
	$pagiPage = '0';
}

if($_GET['blocked']){
	$blocked = 'WHERE active = "0"';
}else if($_GET['active']){
	$blocked = 'WHERE active = "1"';
}else{
	$blocked = '';
}

/*if($_GET['active']){
	$blocked = 'WHERE active = "1"';
}else{
	$blocked = '';
}*/

//echo $BDsumm['DbSumm']-($getPage*$limit);

//$login_request = $_GET['login_request'];

if($_COOKIE['sortparam'] AND $_COOKIE['typeparam']){
	$sortParam = $_COOKIE['sortparam'];
	$typeparam = $_COOKIE['typeparam'];
}else{
	$sortParam = $_GET['sortparam'];
	$typeparam = $_GET['typeparam'];
}


	if($sortParam AND $typeparam){
			$sql = 'SELECT * FROM users '.$blocked.' ORDER by '.$typeparam.' '.$sortParam.' LIMIT '.$pagiPage.','.$limit;
	}else{
		$sql = 'SELECT * FROM users '.$blocked.' ORDER by user_id DESC'.' LIMIT '.$pagiPage.','.$limit;
	}


class mainpage_query{
	public $arrBest;
	public $db;
	function __construct(){
		$this->db = new Database();
	}
	function getAllfromtable($sql){
		
		$tb = $this->db->connection->prepare($sql);
		$tb->execute();
		$this->arrBest = $tb->fetchAll(PDO::FETCH_ASSOC);
		return $this->arrBest;
	}
}
$getData = new mainpage_query();
$arrLogin = $getData -> getAllfromtable($sql);

$arrList = array();
$counter = 0;
foreach($arrLogin as $Items){
	$arrList[] = $Items;
}
foreach($arrList as $arItMs){
	//if(date("m-d-Y",  strtotime($arItMs['userdate']) === '01-01-1970')){
		//$arrList[$counter]['userdate'] = '00-00-0000';
	//}else{
	
		$arrList[$counter]['userdate'] = date("d-m-Y",  strtotime($arItMs['userdate']));
	if(date("d-m-Y",  strtotime($arItMs['userdate'])) == '01-01-1970'){$arrList[$counter]['userdate'] = '00-00-0000';}	
	//}
	$counter ++;
}
//-- Reverse Array For defeting Jquery-Bug
$arrList = array_reverse ($arrList);


echo json_encode($arrList)
?>