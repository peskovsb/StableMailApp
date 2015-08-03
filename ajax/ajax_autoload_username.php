<?
session_start();
require 'db.php';
require 'secfile.php';
if($userLevel['oper_create_forw']==0 AND $userLevel['oper_correct_forw']==0){
	exit;
}
//$login_request = 'sa';
$login_request = $_GET['login_request'];

class mainpage_query{
	public $arrBest;
	public $db;
	function __construct(){
		$this->db = new Database();
	}
	function getAllfromtable($login_request){
		$sql = 'SELECT `user_id`,`login` FROM users WHERE login LIKE :login';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':login'=>'%'.$login_request.'%'));
		$this->arrBest = $tb->fetchAll(PDO::FETCH_ASSOC);
		return $this->arrBest;
	}
}

//-- Relevant Search Starts
if($login_request){

//-- Get Data From Main Class & Func
$getData = new mainpage_query();
$arrLogin = $getData ->getAllfromtable($login_request);

$mainResult[] = $arrLogin;
$counter=0;
	foreach($mainResult[0] as $Items){
		if (preg_match("/^$login_request/", $Items['login'])) {
			$matchArr[$counter]['user_id'] = $Items['user_id'];
			$matchArr[$counter++]['login'] = $Items['login'];
		}
	}
	
	//-- sort this array ASC
	if($matchArr){
		asort($matchArr);
	}
	
	//-- DELETE All matched elements from original array
	if($matchArr){
		foreach($matchArr as $mItems){
			for ($i=0;$i<=count($mainResult[0]);$i++){
				if($mItems['login']==$mainResult[0][$i]['login']){
					unset($mainResult[0][$i]['login']);
					unset($mainResult[0][$i]['user_id']);
					break;
				}
			};
		}
	}
	
	//-- Add to Matched array transformed array
	foreach($mainResult[0] as $finalRez){
		if($finalRez['user_id']){
			$matchArr[$counter]['user_id'] = $finalRez['user_id'];
			$matchArr[$counter++]['login'] = $finalRez['login'];
		}
	}
	$newCounter=0;
	foreach($matchArr as $BadFix){
		$Search[$newCounter]['user_id'] = $BadFix['user_id'];
		$Search[$newCounter++]['login'] = $BadFix['login'];
	}
	
	//-- make JSON
	echo json_encode($Search);
}
?>