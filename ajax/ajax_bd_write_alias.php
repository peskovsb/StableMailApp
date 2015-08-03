<?
require 'db.php';

//--Params-----------------------------


$username 			=		 $_GET['field_username'];
$datefrom 			=		 $_GET['field_datefrom'];
$dateto 			=		 $_GET['field_dateto'];


// ------------------------------------------------

array_shift($_GET);
array_shift($_GET);
array_shift($_GET);

$count=0;

foreach($_GET as $key=>$items){
		if($items == null){
			unset($_GET[$key]);
		}
	
}
foreach($_GET as $items){
$count++;
	if(count($_GET)==$count){
		$emails .= $items;
	}else{
		$emails .= $items .', ';
	}
}

function slaap($seconds) 
{ 
    $seconds = abs($seconds); 
    if ($seconds < 1): 
       usleep($seconds*1000000); 
    else: 
       sleep($seconds); 
    endif;    
} 

slaap(0.2);

class main_query{
	public $arrBest;
	public $db;
	function __construct(){
		$this->db = new Database();
	}		
	function writeDate($username,$emails,$datefrom,$dateto){
		$sql = 'INSERT INTO aliases (`username`,`alias`,`aliasdatefrom`,`aliasdateto`) VALUES (:username,:alias,:aliasdatefrom,:aliasdateto)';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':username'=>$username,':alias'=>$emails,':aliasdatefrom'=>date("Y-m-d H:i:s", strtotime($datefrom)),':aliasdateto'=>date("Y-m-d H:i:s", strtotime($dateto))));
	}
	function getAllfromtable($username){
		$sql = 'SELECT `alias_id`,`username`,`alias` FROM aliases WHERE username = :login ORDER BY alias_id DESC';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':login'=>$username));
		$this->arrBest = $tb->fetch(PDO::FETCH_ASSOC);
		return $this->arrBest;
	}	
}

$workData = new main_query();

$writer = $workData -> writeDate($username,$emails,$datefrom,$dateto);

$getter = $workData ->getAllfromtable($username);

require 'template_right_side_alias.php';
?>