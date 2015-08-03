<?
session_start();
require 'db.php';
require 'secfile.php';
if($userLevel['oper_view_forw']==0){
	exit;
}

//-- PARAMS
//print_r($_COOKIE);
if($_COOKIE['showpagesal']){
	$limit = $_COOKIE['showpagesal'];
}else{$limit = 30;}
	if($_COOKIE['pageA']){
		$pagiPage = $_COOKIE['pageA'];
	}else{
		$pagiPage = $_GET['pagipageAlias'];
	}
if($pagiPage){
	$getPage = $pagiPage;
	$pagiPage = ($pagiPage-1) * $limit;
}else{
	$pagiPage = '0';
}

//echo $limit;

//echo $BDsumm['DbSumm']-($getPage*$limit);

//$login_request = $_GET['login_request'];

if($_COOKIE['sortparamAlias'] AND $_COOKIE['typeparamAlias']){
	$sortParam = $_COOKIE['sortparamAlias'];
	$typeparam = $_COOKIE['typeparamAlias'];
}else{
	$sortParam = $_GET['sortparamAlias'];
	$typeparam = $_GET['typeparamAlias'];
}


	if($sortParam AND $typeparam){
			$sql = 'SELECT aliases.*,bcc.active FROM aliases LEFT JOIN bcc ON CONCAT(aliases.username, "@bioline.ru")=bcc.bcc_name ORDER by '.$typeparam.' '.$sortParam.' LIMIT '.$pagiPage.','.$limit;
	}else{
		$sql = 'SELECT aliases.*,bcc.active FROM aliases LEFT JOIN bcc ON CONCAT(aliases.username, "@bioline.ru")=bcc.bcc_name ORDER by alias_id DESC'.' LIMIT '.$pagiPage.','.$limit;
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
	
		$arrList[$counter]['aliasdatefrom'] = date("d-m-Y",  strtotime($arItMs['aliasdatefrom']));
		$arrList[$counter]['aliasdateto'] = date("d-m-Y",  strtotime($arItMs['aliasdateto']));
	if(date("d-m-Y",  strtotime($arItMs['aliasdatefrom'])) == '01-01-1970'){$arrList[$counter]['aliasdatefrom'] = '00-00-0000';}	
	if(date("d-m-Y",  strtotime($arItMs['aliasdateto'])) == '01-01-1970'){$arrList[$counter]['aliasdateto'] = '00-00-0000';}	
	//}
	$counter ++;
}
//-- Reverse Array For defeting Jquery-Bug
$arrList = array_reverse ($arrList);


echo json_encode($arrList)
?>