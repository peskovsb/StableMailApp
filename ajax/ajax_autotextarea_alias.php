<?
require 'db.php';

$login_req = $_GET['login_request'].'@bioline.ru';

class alias_text{
	public $arrC;
	public $db;
	function __construct(){
		$this->db = new Database();
	}
	function getTextData($login_req){
		$sql = 'SELECT `bcc_autoreply_text` FROM bcc WHERE bcc_name = :reply_login';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':reply_login'=>$login_req));
		$this->arrC = $tb->fetch(PDO::FETCH_ASSOC);
		return $this->arrC;
	}
}

function br2nl($string)
{
	return str_replace("<br />","\r\n", $string);
	//return preg_replace('/<br \/>/','\r\n',$string);
}
//-- We count DB for DESC
$getText = new alias_text();
$BDtext = $getText -> getTextData($login_req);

$rendText = br2nl($BDtext);
//$rendText =$BDtext;

echo json_encode($rendText)
?>