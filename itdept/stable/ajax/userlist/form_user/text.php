<?
//--itdept DB
require '../../../../../ajax/db.php';
require 'arrFields.php';

if (!function_exists('mb_ucfirst') && extension_loaded('mbstring'))
{
    function mb_ucfirst($str, $encoding='UTF-8')
    {
        $str = mb_ereg_replace('^[\ ]+', '', $str);
        $str = mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding).
               mb_substr($str, 1, mb_strlen($str), $encoding);
        return $str;
    }
}

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
	
	
	
	$sql5 = 'SELECT * FROM company WHERE company_id = :company_id';
	
	$tb = $db->connection->prepare($sql5);
	$tb->execute(array(':company_id'=>trim($_POST['staff_dop_comp1'])));
	$getData5 = $tb->fetch(PDO::FETCH_ASSOC);
	
	
	
	
	$sql6 = 'SELECT * FROM company WHERE company_id = :company_id';
	
	$tb = $db->connection->prepare($sql6);
	$tb->execute(array(':company_id'=>trim($_POST['staff_dop_comp2'])));
	$getData6 = $tb->fetch(PDO::FETCH_ASSOC);
	


$message = 'Уважаемый IT отдел

';
if(trim($_POST['staff_dateenter'])){

$dt_st = explode('-',trim($_POST['staff_dateenter']));

$returnEntr = mktime($dt_st[1], $dt_st[0], $dt_st[2]);
$returnCur = mktime(date('m'), date('d'), date('Y'));

if($returnEntr<=$returnCur){
	$word_change = 'вышел';
}else{
	$word_change = 'выйдет';
}

$message .= trim($_POST['staff_dateenter']).' '.$word_change.' новый сотрудник
';}$message .= '<b>'.trim($_POST['staff_lastname']).' '.trim($_POST['staff_firstname']).' '.trim($_POST['staff_secondname']).'</b>
';
if(trim($getData['company_name'])){$message .=  '
Компания: <b style="color:#009999">'.$getData['company_name'].'</b>
';}
if(trim($getData5['company_name'])){$message .=  'Дополнительная компания 1: <b>'.$getData5['company_name'].'</b>
';}
if(trim($getData6['company_name'])){$message .=  'Дополнительная компания 2: <b>'.$getData6['company_name'].'</b>
';}
if(trim($getData2['location_name'])){$message .= 'Расположение: <b>'.$getData2['location_name'].'</b>
';}
if(trim($getData3['department_name'])){$message .= 'Отдел: <b>'.$getData3['department_name'].'</b>
';}
if(trim($getData4['group_name'])){$message .= 'Группа отдела: <b>'.$getData4['group_name'].'</b>
';}
if($_POST['staff_executive']){$message .= 'Руководитель: <b>'.trim($_POST['staff_executive']).'</b>
';}
if($_POST['staff_post']){$message .= 'Должность: <b>'.mb_ucfirst(trim($_POST['staff_post'])).'</b>
';}

if(trim($_POST['staff_umail']) AND trim($_POST['staff_upass'])){
$message .= '
e-mail: <b>'.trim($_POST['staff_umail']).'@bioline.ru</b>
';
$message .= 'пароль: <b>'.trim($_POST['staff_upass']).'</b>
';
}

if(trim($_POST['staff_motiv']) || trim($_POST['staff_st_comp']) || trim($_POST['staff_st_phone']) || trim($_POST['staff_one_c']) || trim($_POST['staff_notebook']) || trim($_POST['staff_mobphone'])){
$message .= '
<u>Также сотруднику нужно предоставить:</u>
';
if(trim($_POST['staff_st_comp'])){$message .= '- Стационарный компьютер
';}
if(trim($_POST['staff_st_phone'])){$message .= '- Стационарный телефон
';}
if(trim($_POST['staff_motiv'])){$message .= '- Мотив
';}
if(trim($_POST['staff_one_c'])){$message .= '- 1C
';}
if(trim($_POST['staff_notebook'])){$message .= '- Ноутбук
';}
if(trim($_POST['staff_mobphone'])){$message .= '- Мобильный телефон';}if(trim($_POST['staff_limit'])){$message .= ' (Лимит: '.trim($_POST['staff_limit']).')
';}
}

echo strip_tags($message);
?>