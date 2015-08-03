<?
session_start();

//--mail DB
require '../../../../../ajax/db.php';
require '../../../../../ajax/secfile.php';

//--itdept DB
//require '../../../db.php';
require 'arrFields.php';

/*$_POST['staff_id_trasher']
$_POST['staff_type_trasher']
$_POST['staff_date_trasher']*/

$db = new DatabaseItDept();

$sql = 'UPDATE staff SET staff_active=1, staff_datedeactive=:staff_datedeactive, staff_typedeactive=:staff_typedeactive WHERE staff_id=:staff_id';
$tb = $db->connection->prepare($sql);
$tb->execute(array(':staff_id'=>$_POST['staff_id_trasher'],':staff_typedeactive'=>$_POST['staff_type_trasher'],':staff_datedeactive'=>date('Y-m-d',strtotime($_POST['staff_date_trasher']))));
?>