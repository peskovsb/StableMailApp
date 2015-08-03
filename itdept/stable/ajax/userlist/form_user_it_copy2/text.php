<?
//--itdept DB
require '../../../db.php';
require 'arrFields.php';


$db = new DatabaseItDept();
	$sql = 'SELECT * FROM company WHERE company_id = :company_id';
	
	$tb = $db->connection->prepare($sql);
	$tb->execute(array(':company_id'=>trim($_POST['staff_company'])));
	$getData = $tb->fetch(PDO::FETCH_ASSOC);
	
	
	$sql2 = 'SELECT * FROM location WHERE location_id = :idchoose';
	
	$tb = $db->connection->prepare($sql2);
	$tb->execute(array(':idchoose'=>trim($_POST['staff_location'])));
	$getData2 = $tb->fetch(PDO::FETCH_ASSOC);
	
	
	$sql3 = 'SELECT * FROM department WHERE department_id = :idchoose';
	
	$tb = $db->connection->prepare($sql3);
	$tb->execute(array(':idchoose'=>trim($_POST['staff_department'])));
	$getData3 = $tb->fetch(PDO::FETCH_ASSOC);
	
	
	$sql4 = 'SELECT * FROM groups WHERE gr_id = :idchoose';
	
	$tb = $db->connection->prepare($sql4);
	$tb->execute(array(':idchoose'=>trim($_POST['staff_groupdep'])));
	$getData4 = $tb->fetch(PDO::FETCH_ASSOC);
	


if(trim($_POST['staff_already_work']) == '1'){
	$word_change = 'вышел';
}else{
	$word_change = 'выйдет';
}

$message = 'Уважаемый IT отдел
'.trim($_POST['staff_lastname']).' '.trim($_POST['staff_secondname']).' '.trim($_POST['staff_firstname']).'
';
if(trim($_POST['staff_dateenter'])){$message .= '
'.trim($_POST['staff_dateenter']).' '.$word_change.' новый сотрудник
';}
if(trim($getData['company_name'])){$message .=  '
Компания: '.$getData['company_name'].'
';}
if(trim($getData2['location_name'])){$message .= 'Расположение: '.$getData2['location_name'].'
';}
if(trim($getData3['department_name'])){$message .= 'Отдел: '.$getData3['department_name'].'
';}
if(trim($getData4['group_name'])){$message .= 'Группа отдела: '.$getData4['group_name'].'
';}
if($_POST['staff_executive']){$message .= 'Руководитель: '.trim($_POST['staff_executive']).'
';}

if(trim($_POST['staff_umail']) AND trim($_POST['staff_upass'])){
$message .= '
e-mail: '.trim($_POST['staff_umail']).'@bioline.ru
';
$message .= 'пароль: '.trim($_POST['staff_upass']).'
';
}

if(trim($_POST['staff_motiv']) || trim($_POST['staff_one_c']) || trim($_POST['staff_notebook']) || trim($_POST['staff_mobphone'])){
$message .= '
Также сотруднику нужно предоставить:
';
if(trim($_POST['staff_motiv'])){$message .= '- Мотив
';}
if(trim($_POST['staff_one_c'])){$message .= '- 1C
';}
if(trim($_POST['staff_notebook'])){$message .= '- Ноутбук
';}
if(trim($_POST['staff_mobphone'])){$message .= '- Мобильный телефон';}if(trim($_POST['staff_limit'])){$message .= ' (Лимит: '.trim($_POST['staff_limit']).')
';}}

echo $message;

/*echo 'staff_lastname: '.trim($_POST['staff_lastname']).'
staff_firstname: '.trim($_POST['staff_firstname']).'
staff_secondname: '.trim($_POST['staff_secondname']).'
staff_company: '.trim($_POST['staff_company']).'
staff_location: '.trim($_POST['staff_location']).'
staff_department: '.trim($_POST['staff_department']).'
staff_executive: '.trim($_POST['staff_executive']).'
staff_umail: '.trim($_POST['staff_umail']).'@bioline.ru
staff_upass: '.trim($_POST['staff_upass']).'
staff_topic: '.trim($_POST['staff_topic']).'
staff_testletter_ok: '.trim($_POST['staff_testletter_ok']).'
staff_motiv: '.trim($_POST['staff_motiv']).'
staff_one_c: '.trim($_POST['staff_one_c']).'
staff_notebook: '.trim($_POST['staff_notebook']).'
staff_mobphone: '.trim($_POST['staff_mobphone']).'
staff_limit: '.trim($_POST['staff_limit']).'
staff_dateenter: '.trim($_POST['staff_dateenter']).'
staff_already_work: '.trim($_POST['staff_already_work'])
;*/
?>