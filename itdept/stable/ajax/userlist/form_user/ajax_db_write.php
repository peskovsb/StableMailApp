<?
session_start();
$adressesMAIL = 'fedosova@bioline.ru, it@bioline.ru, belskaya@bioline.ru';
$chairMail = 'kodenuk@bioline.ru';
$receptionMail = 'reception1@bioline.ru, reception2@bioline.ru';



//-- LOGICS GO

if(isset($_POST['staff_chair']) || isset($_POST['staff_table_for'])){
	$adressesMAIL .= ', '.$chairMail;
}
if(isset($_POST['staff_concelar'])){
	$adressesMAIL .= ', '.$receptionMail;
}
if($_POST['other_mail']){
	$messageTOIT = $adressesMAIL.', '.$_POST['other_mail'];
}else{
	$messageTOIT = $adressesMAIL;
}
$subject = 'Заявка о добавлении нового сотрудника';

//--mail DB
require '../../../../../ajax/db.php';
require '../../../../../ajax/secfile.php';

//--itdept DB
//require '../../../db.php';
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

$dbMail = new Database();

if($_POST[$arrayForm['umail']['name']]){
	
	$sql = 'SELECT * FROM users WHERE login = :staff_mail';
	$tb = $dbMail->connection->prepare($sql);
	$tb->execute(array(':staff_mail'=>trim($_POST[$arrayForm['umail']['name']])));
	$getData = $tb->fetch(PDO::FETCH_ASSOC);	
	print_r($getData);
}
//print_r($getData);
$mistake = 0;
foreach($arrayForm as $f_key => $f_Items){
//echo $_POST[$f_Items['name']];
	switch($f_Items['name']){
		case $prefix.'company':
		case $prefix.'department':
		case $prefix.'location':
		case $prefix.'executive':
			if($_POST[$f_Items['name']] == '0'){
				$rezArr[0][$f_key]['mistakeIU'] = 'mistake';
				$rezArr[0][$f_key]['msg'] = 'Поле '.$f_Items['title'].' не выбрано';
					$mistake = 1;
			}else{
				$rezArr[0][$f_key]['mistakeIU'] = 'nomistake';
			}
			break;
		case $prefix.'umail':
		//echo $getData['id'];
		//echo $_POST[$f_Items['name']];
		if(isset($_POST[$f_Items['name']])){
			if($getData['user_id']){
				$rezArr[0][$f_key]['mistakeIU'] = 'mistake';
				$rezArr[0][$f_key]['msg'] = 'Такой почтовый ящик уже есть в системе';
					$mistake = 1;
			}else{
				if(preg_match("/[\s,*?&^%>@<+\$'№#`~=!АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя]/", trim($_POST[$f_Items['name']]))){
					$rezArr[0][$f_key]['mistakeIU'] = 'mistake';
					$rezArr[0][$f_key]['msg'] = 'Поле '.$f_Items['title'].' имеет запрещенные символы';
						$mistake = 1;
				}else{
					if($_POST['submform']){
						if(strlen($_POST[$f_Items['name']])>'0'){
							$rezArr[0][$f_key]['mistakeIU'] = 'nomistake';
						}else{
							$rezArr[0][$f_key]['mistakeIU'] = 'mistake';
							$rezArr[0][$f_key]['msg'] = 'Поле "'.$f_Items['title'].'" не должно быть пустым';
								$mistake = 1;
						}
					}else{
						$rezArr[0][$f_key]['mistakeIU'] = 'nomistake';
					}
				}
			}
		}else{
			$rezArr[0][$f_key]['mistakeIU'] = 'nomistake';
		}
				break;
		case $prefix.'upass':
		if(isset($_POST[$f_Items['name']])){
			if(preg_match("/[\s,*?&^%>@<+\$'№#`~=!АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя]/", trim($_POST[$f_Items['name']]))){
				$rezArr[0][$f_key]['mistakeIU'] = 'mistake';
				$rezArr[0][$f_key]['msg'] = 'Поле '.$f_Items['title'].' имеет запрещенные символы';
					$mistake = 1;
			}else{
				if($_POST['submform']){
					if(strlen($_POST[$f_Items['name']])>'0'){
						$rezArr[0][$f_key]['mistakeIU'] = 'nomistake';
					}else{
						$rezArr[0][$f_key]['mistakeIU'] = 'mistake';
						$rezArr[0][$f_key]['msg'] = 'Поле "'.$f_Items['title'].'" не должно быть пустым';
							$mistake = 1;
					}
				}else{
					$rezArr[0][$f_key]['mistakeIU'] = 'nomistake';
				}
			}
		}else{
			$rezArr[0][$f_key]['mistakeIU'] = 'nomistake';
		}
				break;
		case $prefix.'limit':
		if(isset($_POST[$f_Items['name']])){
			if(preg_match("/[\s,*?&^%>@<+\$'№#`~=!АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя]/", trim($_POST[$f_Items['name']]))){
				$rezArr[0][$f_key]['mistakeIU'] = 'mistake';
				$rezArr[0][$f_key]['msg'] = 'Поле '.$f_Items['title'].' имеет запрещенные символы';
					$mistake = 1;
			}else{
				if($_POST['submform']){
					if(strlen($_POST[$f_Items['name']])>'0'){
						$rezArr[0][$f_key]['mistakeIU'] = 'nomistake';
					}else{
						$rezArr[0][$f_key]['mistakeIU'] = 'mistake';
						$rezArr[0][$f_key]['msg'] = 'Поле "'.$f_Items['title'].'" не должно быть пустым';
							$mistake = 1;
					}
				}else{
					$rezArr[0][$f_key]['mistakeIU'] = 'nomistake';
				}
			}
		}else{
			$rezArr[0][$f_key]['mistakeIU'] = 'nomistake';
		}
				break;
		case $prefix.'itletter':
				$rezArr[0][$f_key]['mistakeIU'] = 'nomistake';
				break;
		case $prefix.'post':	
			if(preg_match("/[,\*?&^%><+\$#`~=!0-9'\"]/", $_POST[$f_Items['name']])){
				$rezArr[0][$f_key]['mistakeIU'] = 'mistake';
				$rezArr[0][$f_key]['msg'] = 'Поле "'.$f_Items['title'].'" имеет запрещенные символы';
					$mistake = 1;
			}else{
				if($_POST['submform'] AND $f_Items['require'] == '1'){
					if(strlen($_POST[$f_Items['name']])>'0'){
						$rezArr[0][$f_key]['mistakeIU'] = 'nomistake';
					}else{
						$rezArr[0][$f_key]['mistakeIU'] = 'mistake';
						$rezArr[0][$f_key]['msg'] = 'Поле '.$f_Items['title'].' не должно быть пустым';
							$mistake = 1;
					}
				}else{
					$rezArr[0][$f_key]['mistakeIU'] = 'nomistake';
				}
			}
			break;				
		case $prefix.'lastname':
		case $prefix.'firstname':
		case $prefix.'secondname':
			if(preg_match("/[,\*?&^%><+\$#`~=!A-z0-9'\"]/", $_POST[$f_Items['name']])){
				$rezArr[0][$f_key]['mistakeIU'] = 'mistake';
				$rezArr[0][$f_key]['msg'] = 'Поле "'.$f_Items['title'].'" имеет запрещенные символы';
					$mistake = 1;
			}else{
				if($_POST['submform'] AND $f_Items['require'] == '1'){
					if(strlen($_POST[$f_Items['name']])>'0'){
						$rezArr[0][$f_key]['mistakeIU'] = 'nomistake';
					}else{
						$rezArr[0][$f_key]['mistakeIU'] = 'mistake';
						$rezArr[0][$f_key]['msg'] = 'Поле '.$f_Items['title'].' не должно быть пустым';
							$mistake = 1;
					}
				}else{
					$rezArr[0][$f_key]['mistakeIU'] = 'nomistake';
				}
			}
				break;
		default:
			if(preg_match("/[,\*?&^%><+\$'#`~=!]/", $_POST[$f_Items['name']])){
				$rezArr[0][$f_key]['mistakeIU'] = 'mistake';
				$rezArr[0][$f_key]['msg'] = 'Поле '.$f_Items['title'].' имеет запрещенные символы';
					$mistake = 1;
			}else{
				if($_POST['submform'] AND $f_Items['require'] == '1'){
					if(strlen($_POST[$f_Items['name']])>'0'){
						$rezArr[0][$f_key]['mistakeIU'] = 'nomistake';
					}else{
						$rezArr[0][$f_key]['mistakeIU'] = 'mistake';
						$rezArr[0][$f_key]['msg'] = 'Поле "'.$f_Items['title'].'" не должно быть пустым';
							$mistake = 1;
					}
				}else{
					$rezArr[0][$f_key]['mistakeIU'] = 'nomistake';
				}
			}
	}	
}
if($mistake != '1'){

if(isset($_POST['staff_already_work'])){
	$already_work = '1';
}else{
	$already_work = '0';
}

if(isset($_POST['staff_st_comp'])){
	$motiv = '1';
	$show_st_comp = '- Стационарный компьютер<br>';
}

if(isset($_POST['staff_st_phone'])){
	$motiv = '1';
	$show_st_phone = '- Стационарный телефон<br>';
}

if(isset($_POST['staff_motiv'])){
	$motiv = '1';
	$show_motiv = '- Мотив<br>';
}else{
	$motiv = '0';
}

if(isset($_POST['staff_one_c'])){
	$one_c = '1';
	$show_onec = '- 1C<br>';
}else{
	$one_c = '0';
}

if(isset($_POST['staff_notebook'])){
	$notebook = '1';
	$show_notebook = '- Ноутбук<br>';
}else{
	$notebook = '0';
}

if(isset($_POST['staff_mobphone'])){
	$mobphone = '1';
	if($_POST['staff_limit']){
		$show_limit = ' (Лимит: '.$_POST['staff_limit'].')';
	}
	$show_mobphone = '- Мобильный телефон'.$show_limit.'<br>';
}else{
	$mobphone = '0';
}

if(isset($_POST['staff_chair'])){
	$chair = '1';
	$show_chair = '- Стул<br>';
}else{
	$chair = '0';
}

if(isset($_POST['staff_table_for'])){
	$table = '1';
	$show_table = '- Стол<br>';
}else{
	$table = '0';
}

if(isset($_POST['staff_concelar'])){
	$cocelar = '1';
	$show_concelar = '- Канцелярия<br>';
}else{
	$cocelar = '0';
}

$db = new DatabaseItDept();

//--Params
$login 				=		 trim($_POST[$arrayForm['umail']['name']]);
$domain 			= 		'bioline.ru';  //-- Test domain
$emails 			= 		 $login.'@'.$domain;
$domain_id			= 		 1;
$password 			=		 trim($_POST[$arrayForm['upass']['name']]);
$user_name 			=		 mb_ucfirst(trim($_POST[$arrayForm['firstname']['name']]));
$user_secondname 	=		 mb_ucfirst(trim($_POST[$arrayForm['secondname']['name']]));
$user_last_name 	=		 mb_ucfirst(trim($_POST[$arrayForm['lastname']['name']]));
$active 			= 		 1;
$mailbox 			= 		 '/mail/virtual/' . $emails . '/Maildir/';
$company			=		  $_POST[$arrayForm['company']['name']];
$location			=		  $_POST[$arrayForm['location']['name']];
$department			=		  $_POST[$arrayForm['department']['name']];
$executive			=		  $_POST[$arrayForm['executive']['name']];
$dateenter			=		  trim($_POST[$arrayForm['dateenter']['name']]);
$datedr				=		  trim($_POST[$arrayForm['user_dr']['name']]);
$limit				=		  trim($_POST[$arrayForm['limit']['name']]);
$st_post			=		  mb_ucfirst(trim($_POST[$arrayForm['post']['name']]));
$dop_comp1			=		  trim($_POST[$arrayForm['dop_comp1']['name']]);
$dop_comp2			=		  trim($_POST[$arrayForm['dop_comp2']['name']]);
$location 			= 		  trim($_POST[$arrayForm['location']['name']]);
$groupdep 			= 		  trim($_POST[$arrayForm['groupdep']['name']]);
$dopinfo 			= 		  $_POST['dop_info_form'];

$dateenter = date('Y-m-d',strtotime($dateenter));

	$date_month = date('d-m',strtotime($datedr));
	$date = DateTime::createFromFormat('!d-m', $datedr);
	$userbdate = date_format($date, 'U');


$sql = 'SELECT * from company WHERE company_id = :company_id';
$tb = $db->connection->prepare($sql);
$tb->execute(array(':company_id'=>$company));
$getCompany = $tb->fetch(PDO::FETCH_ASSOC);

$sql = 'SELECT * from location WHERE location_id = :location_id';
$tb = $db->connection->prepare($sql);
$tb->execute(array(':location_id'=>$location));
$getLoc = $tb->fetch(PDO::FETCH_ASSOC);

$sql = 'SELECT * from department WHERE department_id = :department_id';
$tb = $db->connection->prepare($sql);
$tb->execute(array(':department_id'=>$department));
$getDepartment = $tb->fetch(PDO::FETCH_ASSOC);

if($groupdep){
	$sql = 'SELECT * from groups WHERE gr_id = :gr_id';
	$tb = $db->connection->prepare($sql);
	$tb->execute(array(':gr_id'=>$groupdep));
	$getGroup = $tb->fetch(PDO::FETCH_ASSOC);
	$show_group = 'Группа: <b>'.$getGroup['group_name'].'</b><br>';
}
//echo $limit;
	
	
	$sql = 'INSERT INTO staff (`staff_name`,`staff_secondname`,`staff_lastname`,`staff_company_id`,`staff_group_id`,`staff_depart_id`,`staff_active`,`staff_formsignd`,`staff_enterdate`,`staff_post`,`staff_dopcomp1`,`staff_dopcomp2`,`staff_location`,`staff_dr`) VALUES (:staff_name,:staff_secondname,:staff_lastname,:staff_company_id,:staff_group_id,:staff_depart_id,:staff_active,now(),:staff_enterdate,:staff_post,:staff_dopcomp1,:staff_dopcomp2,:staff_location,:staff_dr)';
	$tb = $db->connection->prepare($sql);
	//$db->connection->beginTransaction();	
	$tb->execute(array(':staff_name'=>$user_name,':staff_secondname'=>$user_secondname,':staff_lastname'=>$user_last_name,':staff_company_id'=>$company,':staff_group_id'=>$groupdep,':staff_depart_id'=>$department,':staff_active'=>$already_work,':staff_enterdate'=>$dateenter,':staff_post'=>$st_post,':staff_dopcomp1'=>$dop_comp1,':staff_dopcomp2'=>$dop_comp2,':staff_location'=>$location,':staff_dr'=>$userbdate));
	//$db->connection->commit();
	$LastInserterID = $db->connection->lastInsertId('staff_id');


if(isset($_POST[$arrayForm['umail']['name']])){
	if($userLevel['oper_create_post']!=0){
		$sql = 'INSERT INTO users (`domain_id`,`login`,`password`,`email`,`name`,`sername`,`active`,`mailbox`,`userdate`,`staff_id`) VALUES (:domain_id,:login,:password,:email,:name,:sername,:active,:mailbox,now(),:staff_id)';
		$tb = $dbMail->connection->prepare($sql);
		$tb->execute(array(':domain_id'=>$domain_id,':login'=>$login,':password'=>$password,':email'=>$emails,':name'=>$user_name,':sername'=>$user_last_name,':active'=>$active,':mailbox'=>$mailbox,':staff_id'=>$LastInserterID));
		
		$sql = 'INSERT INTO loging (`tmlog`,`login_id`,`moving`,`rzlt`,`vargroup`,`ipuser`) VALUES (NOW(),:login_id,"создание",:rzlt,"1","'.$_SERVER["REMOTE_ADDR"].'")';
		$tb = $db->connection->prepare($sql);
		$tb->execute(array(':login_id'=>$_SESSION['user_id'],':rzlt'=>$login));
		$show_mail = 'e-mail: '.$emails.'<br>пароль: '.$password.'<br><br>';


		$userTo = $emails;
		$subjectTest = trim($_POST['staff_topic']);
		$testmessage = '<div style=" font-family:\'Segoe UI\';font-size: 14px;">
Здравствуйте, '.$user_last_name.' '.$user_name.' '.$user_secondname.'<br><br>

Добро пожаловать в группу компаний "Биолайн".<br><br>

Ваши регистрационные данные:<br><br>

Почта:<br>
<b>email:</b> '.$emails.'<br>
<b>пароль:</b> '.$password.'<br><br>

Если у вас возникнут какие-либо проблемы, связанные с IT инфраструктурой компаний, Вы можете обратиться в наш отдел по следующим адресам:<br>
<b>it@bioline.ru</b> - общий адрес для всех типов заявок, кроме 1С и вопросов, связанных с сайтами группы компаний.<br>
<b>1c@bioline.ru</b> - для вопросов, связанных с работой системы "1С".<br>
<b>site@bioline.ru</b> - для вопросов, связанных  с  работой  сайта компании,интернет-магазина и "Инфолайна"<br><br>

Обращаем Ваше внимание на перечень проблем заявки по которым будут приниматься только через указанные выше адреса:<br>
-Создание и редактирование учетных записей пользователей, назначение  полномочий доступа к папкам и файлам;<br>
-Электронная почта (создание и изменение адресов,настройка клиентской части, установка переадресации , автоответы, создание алиасов и.т.д);<br>
-Система "Мотив" (создание пользователей , установка прав и полномочий, создание и редактирование шаблонов, и.т.д.);<br>
-Закупка оборудования и расходных материалов, ремонтные работы;<br>
-Вопросы , связанные с работой офисной телефонной сети;<br>
-Установка ПО, настройка рабочих мест;<br>
-Обеспечение работы системы "1С";<br>
-Вопросы  обеспечения  мобильной  связью (сим-карты,лимиты,подключение дополнительных опций);<br>
-Оплата счетов поставщиков, находящихся в ведении IT-подразделения.<br><br>
По телефону подобные заявки не принимаются.<br>
Данная система позволяет исключить потерю Ваших заявок, равномерно распределять нагрузку между сотрудниками IT-подразделения, а так же информировать Вас о состоянии работ по заявкам. Надеемся на Ваше понимание.
		</div>';

		$headers= "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=utf-8\r\n";

		$headers .= "From: it@bioline.ru>\r\n";

		mail($userTo, $subjectTest, $testmessage, $headers);
	}
}else{
	$show_mail = '';
}
	
	
		$sql = 'INSERT INTO loging (`tmlog`,`login_id`,`moving`,`rzlt`,`vargroup`,`ipuser`) VALUES (NOW(),:login_id,"создание",:rzlt,"3","'.$_SERVER["REMOTE_ADDR"].'")';
		$tb = $db->connection->prepare($sql);
		//$tb->execute(array(':login_id'=>$_SESSION['user_id'],':rzlt'=>$user_last_name.' '.substr($user_name,1).'. '.substr($user_secondname,1).'.'));
		$tb->execute(array(':login_id'=>$_SESSION['user_id'],':rzlt'=>$user_last_name.' '.mb_substr($user_name,0,1).'. '.mb_substr($user_secondname,0,1).'.'));
	
if($dopinfo){
	$dopinfo_text = '<br><u>Дополнительная информация:</u><br><pre>'.$dopinfo.'</pre>';
}
	
	$messageIT = '<div style=" font-family:\'Segoe UI\';font-size: 14px;">
Уважаемые сотрудники!<br><br>

'.$dateenter.' вышел новый сотрудник:<br>
<b>'.$user_last_name.' '.$user_name.' '.$user_secondname.'</b><br><br>

Компания: <b style="color:#009999">'.$getCompany['company_name'].'</b><br>
Расположение: <b>'.$getLoc['location_name'].'</b><br>
Отдел: <b>'.$getDepartment['department_name'].'</b><br>
'.$show_group.'
Руководитель: <b>'.$executive.'</b><br>
Должность: <b>'.$st_post.'</b><br><br>
'.$show_mail.'
<u>Также сотруднику нужно предоставить:</u><br>
'.$show_st_comp.'
'.$show_st_phone.'
'.$show_notebook.'
'.$show_onec.'
'.$show_motiv.'
'.$show_mobphone.'
'.$show_chair.'
'.$show_table.'
'.$show_concelar.'

'.$dopinfo_text.'
	</div>';
	
	$headers= "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=utf-8\r\n";

	$headers .= "From: Отдел по работе с персоналом <belskaya@bioline.ru>\r\n";	
	
	mail($messageTOIT, $subject, $messageIT, $headers);
	

}
?>