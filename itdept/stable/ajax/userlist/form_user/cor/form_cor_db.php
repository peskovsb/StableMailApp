<?session_start();
//--itdept DB
//require '../../../../db.php';
//require 'arrFields.php';
require '../../../../../../ajax/db.php';
require '../../../../../../ajax/secfile.php';

$db = new DatabaseItDept();

/*
$_POST['staff_id']
$_POST['staff_lastname']
$_POST['staff_name']
$_POST['staff_secondname']
$_POST['staff_post']
$_POST['staff_company_id']
$_POST['staff_dopcomp1']
$_POST['staff_dopcomp2']
$_POST['staff_department']
$_POST['staff_group_id']
$_POST['staff_location']
$_POST['staff_ats']
$_POST['staff_mobnumber']
$_POST['staff_enterdate']
$_POST['staff_status']
$_POST['staff_datedeactive']
*/

	$date_month = date('d-m',strtotime($_POST['staff_user_dr']));
	$date = DateTime::createFromFormat('!d-m', $_POST['staff_user_dr']);
	$userbdate = date_format($date, 'U');

	
switch($_POST['staff_status']){
	case '0': $status_staff = '0';$status_type = '';
		break;
	case '1': $status_staff = '1';$status_type = '';
		break;
	case '2': $status_staff = '1';$status_type = '0';
		break;
	case '3': $status_staff = '1';$status_type = '1';
		break;
}

//echo date('Y-m-d',strtotime($_POST['staff_datedeactive'])).' 00:00:00';

$sql = 'UPDATE staff SET staff_dr=:staff_dr, staff_lastname=:staff_lastname, staff_name=:staff_name, staff_secondname=:staff_secondname, staff_company_id=:staff_company_id, staff_depart_id=:staff_depart_id, staff_group_id=:staff_group_id, staff_post=:staff_post, staff_dopcomp1=:staff_dopcomp1, staff_dopcomp2=:staff_dopcomp2, staff_location=:staff_location, staff_ats=:staff_ats, staff_mobnumber=:staff_mobnumber, staff_enterdate=:staff_enterdate, staff_datedeactive=:staff_datedeactive, staff_active=:staff_active, staff_typedeactive=:staff_typedeactive WHERE staff_id =:staff_id';
$tb = $db->connection->prepare($sql);
$tb->execute(array(':staff_lastname'=>$_POST['staff_cor_lastname'], ':staff_name'=>$_POST['staff_name'], ':staff_secondname'=>$_POST['staff_secondname'], ':staff_company_id'=>$_POST['staff_company_id'],':staff_depart_id'=>$_POST['staff_department'],':staff_id'=>$_POST['staff_id'],':staff_group_id'=>$_POST['staff_group_id'],':staff_post'=>$_POST['staff_post'],':staff_dopcomp1'=>$_POST['staff_dopcomp1'],':staff_dopcomp2'=>$_POST['staff_dopcomp2'],':staff_location'=>$_POST['staff_location'],':staff_ats'=>$_POST['staff_ats'],':staff_mobnumber'=>$_POST['staff_mobnumber'],':staff_enterdate'=>date('Y-m-d',strtotime($_POST['staff_enterdate'])).' 00:00:00', ':staff_datedeactive'=>date('Y-m-d',strtotime($_POST['staff_datedeactive'])).' 00:00:00', ':staff_active'=>$status_staff, ':staff_typedeactive'=>$status_type, ':staff_dr'=>$userbdate));