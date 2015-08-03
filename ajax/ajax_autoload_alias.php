<?
session_start();
require 'db.php';
require 'secfile.php';
if($userLevel['oper_create_forw']==0){
	exit;
}

//$email_request = 'sa';
$email_request = $_GET['email_request'];

class mainpage_query{
	public $arrBest;
	public $db;
	function __construct(){
		$this->db = new Database();
	}
	function getAllfromtable($email_request){
		$sql = 'SELECT `user_id`,`email` FROM users WHERE email LIKE :email';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':email'=>'%'.$email_request.'%'));
		$this->arrBest = $tb->fetchAll(PDO::FETCH_ASSOC);
		return $this->arrBest;
	}
}

//-- Relevant Search Starts
if($email_request){

//-- Get Data From Main Class & Func
$getData = new mainpage_query();
$arremail = $getData ->getAllfromtable($email_request);

$mainResult[] = $arremail;
$counter=0;
	foreach($mainResult[0] as $Items){
		if (preg_match("/^$email_request/", $Items['email'])) {
			$matchArr[$counter]['user_id'] = $Items['user_id'];
			$matchArr[$counter++]['email'] = $Items['email'];
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
				if($mItems['email']==$mainResult[0][$i]['email']){
					unset($mainResult[0][$i]['email']);
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
			$matchArr[$counter++]['email'] = $finalRez['email'];
		}
	}
	$newCounter=0;
	foreach($matchArr as $BadFix){
		$Search[$newCounter]['user_id'] = $BadFix['user_id'];
		$Search[$newCounter++]['email'] = $BadFix['email'];
	}
	
	//-- make JSON
	echo json_encode($Search);
}
?>