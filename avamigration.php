<?require 'ajax/db.php';

class DatabaseInfoline {
	//-----DB params------
	private $host = 'server69.hosting.reg.ru';
	private $user = 'u8062747_default';
	private $password = 'fbmgOQOK';
	private $db = 'u8062747_default';
	
	//------***----------
   public $connection;

   public function __construct() {
		try {
			$options = array(
				PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
			); 
			$this->connection = new PDO('mysql:host='.$this->host.'; dbname='.$this->db.'; port=3306', $this->user, $this->password, $options);
			$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}
   }
}

$db_infoline = new DatabaseInfoline();
$db_dept = new DatabaseItDept();
$sql = 'SELECT * FROM infoline_users';
$tb = $db_infoline->connection->prepare($sql);
$tb->execute();
$data = $tb->fetchAll(PDO::FETCH_ASSOC);


//----
//**** AVATAR Migration
//----
//echo '<pre>';print_r($data);echo '<pre>';
/*foreach($data as $items){
$param1 = $items['lastname'];
$param2 = $items['firstname'];
$param3 = $items['middlename'];
$param4 = $items['cb_localphone'];
	$sql = 'UPDATE staff SET staff_avatar=:staff_avatar WHERE staff_lastname = :lastname AND staff_name = :firstname AND staff_secondname =:middlename AND staff_ats=:cb_localphone';
	$tb = $db_dept->connection->prepare($sql);
	$tb->execute(array(':lastname'=>$param1,':firstname'=>$param2,':middlename'=>$param3, ':cb_localphone'=>$param4, ':staff_avatar'=>$items['avatar']));
}*/

//----
//**** Happy Birthday Migration
//----

/*foreach($data as $items){
$param1 = $items['lastname'];
$param2 = $items['firstname'];
$param3 = $items['middlename'];
$param4 = $items['cb_localphone'];
	$sql = 'UPDATE staff SET staff_dr=:staff_dr WHERE staff_lastname = :lastname AND staff_name = :firstname AND staff_secondname =:middlename AND staff_ats=:cb_localphone';	
	$tb = $db_dept->connection->prepare($sql);
	$tb->execute(array(':lastname'=>$param1,':firstname'=>$param2,':middlename'=>$param3, ':cb_localphone'=>$param4, ':staff_dr'=>$items['cb_birthday1']));
}*/
?>