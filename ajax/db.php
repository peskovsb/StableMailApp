<?
class Database {
	//-----DB params------
	private $host = 'localhost';
	private $user = 'root';
	private $password = '';
	private $db = 'mailapp_stable';
	
	//------***----------
   public $connection;

   public function __construct() {
		try {
			$options = array(
				PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
			); 
			$this->connection = new PDO('mysql:host='.$this->host.';dbname='.$this->db, $this->user, $this->password, $options);
			$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}
   }
}

class DatabaseItDept {
	//-----DB params------
	private $host = 'localhost';
	private $user = 'root';
	private $password = '';
	private $db = 'itdept_stable';
	
	//------***----------
   public $connection;

   public function __construct() {
		try {
			$options = array(
				PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
			); 
			$this->connection = new PDO('mysql:host='.$this->host.';dbname='.$this->db, $this->user, $this->password, $options);
			$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}
   }
}
?>
