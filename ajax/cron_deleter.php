<?
require 'db.php';

class mainpage_query{
	public $arrBest;
	public $items;
	public $db;
	function __construct(){
		$this->db = new Database();
	}
	function deleteRows(){
		$sql = 'SELECT * FROM aliases WHERE DATE_FORMAT(aliasdateto, "%Y-%m-%d") < DATE_FORMAT(NOW(), "%Y-%m-%d") AND aliasdateto!="0000-00-00 00:00:00"';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute();
		$this->arrBest = $tb->fetchAll(PDO::FETCH_ASSOC);
		foreach($this->arrBest as $Items){
		$userName = $Items['username'].'@bioline.ru';
			$sql = 'UPDATE bcc SET active=0 WHERE bcc_name = :bcc_name';
			$tb = $this->db->connection->prepare($sql);
			$tb->execute(array(':bcc_name'=>$userName));
		}
		
		//--DELLPART
		$sql = 'DELETE FROM aliases WHERE DATE_FORMAT(aliasdateto, "%Y-%m-%d") < DATE_FORMAT(NOW(), "%Y-%m-%d") AND aliasdateto!="0000-00-00 00:00:00"';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute();
	}
}


$dateWork = new mainpage_query();
$dateWork->deleteRows();