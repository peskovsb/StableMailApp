<?
session_start();
$messageTOIT = 'peskov@bioline.ru';
$subject = 'Заявка в IT отдел, добавление нового сотрудника';

//--mail DB
require '../../../../../ajax/db.php';
require '../../../../../ajax/secfile.php';

//--itdept DB
require '../../../db.php';
require 'arrFields.php';

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
		case $prefix.'groupdep':
			if($_POST[$f_Items['name']] == '0'){
				$rezArr[0][$f_key]['mistakeIU'] = 'mistake';
				$rezArr[0][$f_key]['msg'] = 'Поле '.$f_Items['title'].' не выбрано';
					$mistake = 1;
			}else{
				$rezArr[0][$f_key]['mistakeIU'] = 'nomistake';
			}
			break;
		case $prefix.'executive':
			$rezArr[0][$f_key]['mistakeIU'] = 'nomistake';
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
			if(strlen($_POST[$f_Items['name']])>'0'){
				$rezArr[0][$f_key]['mistakeIU'] = 'nomistake';
			}else{
				$rezArr[0][$f_key]['mistakeIU'] = 'mistake';
					$rezArr[0][$f_key]['msg'] = 'Поле '.$f_Items['title'].' не должно быть пустым';
						$mistake = 1;
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

if(isset($_POST['staff_motiv'])){
	$motiv = '1';
}else{
	$motiv = '0';
}

if(isset($_POST['staff_one_c'])){
	$one_c = '1';
}else{
	$one_c = '0';
}

if(isset($_POST['staff_notebook'])){
	$notebook = '1';
}else{
	$notebook = '0';
}

if(isset($_POST['staff_mobphone'])){
	$mobphone = '1';
}else{
	$mobphone = '0';
}

//--Params
$login 				=		 trim($_POST[$arrayForm['umail']['name']]);
$domain 			= 		'bioline.ru';  //-- Test domain
$emails 			= 		 $login.'@'.$domain;
$domain_id			= 		 1;
$password 			=		 trim($_POST[$arrayForm['upass']['name']]);
$user_name 			=		 trim($_POST[$arrayForm['firstname']['name']]);
$user_secondname 	=		 trim($_POST[$arrayForm['secondname']['name']]);
$user_last_name 	=		 trim($_POST[$arrayForm['lastname']['name']]);
$active 			= 		 1;
$mailbox 			= 		 '/mail/virtual/' . $emails . '/Maildir/';
$company			=		  $_POST[$arrayForm['company']['name']];
$location			=		  $_POST[$arrayForm['location']['name']];
$department			=		  $_POST[$arrayForm['department']['name']];
$executive			=		  $_POST[$arrayForm['executive']['name']];
$dateenter			=		  trim($_POST[$arrayForm['dateenter']['name']]);
$limit				=		  trim($_POST[$arrayForm['limit']['name']]);

$dateenter = date('Y-m-d',strtotime($dateenter));

if(isset($_POST[$arrayForm['umail']['name']])){
	if($userLevel['oper_create_post']!=0){
		$sql = 'INSERT INTO users (`domain_id`,`login`,`password`,`email`,`name`,`sername`,`active`,`mailbox`,`userdate`) VALUES (:domain_id,:login,:password,:email,:name,:sername,:active,:mailbox,now())';
		$tb = $dbMail->connection->prepare($sql);
		$tb->execute(array(':domain_id'=>$domain_id,':login'=>$login,':password'=>$password,':email'=>$emails,':name'=>$user_name,':sername'=>$user_last_name,':active'=>$active,':mailbox'=>$mailbox));
		
		$sql = 'INSERT INTO loging (`tmlog`,`login_id`,`moving`,`rzlt`,`vargroup`,`ipuser`) VALUES (NOW(),:login_id,"создание",:rzlt,"1","'.$_SERVER["REMOTE_ADDR"].'")';
		$tb = $dbMail->connection->prepare($sql);
		$tb->execute(array(':login_id'=>$_SESSION['user_id'],':rzlt'=>$login));
		
	}
}



//echo $limit;
	$db = new DatabaseItDept();

	$sql = 'INSERT INTO staff (`staff_name`,`staff_secondname`,`staff_lastname`,`staff_company_id`,`staff_depart_id`,`staff_active`,`staff_formsignd`,`staff_enterdate`,`staff_motiv`,`staff_one_c`,`staff_notebook`,`staff_mobphone`,`staff_limit`) VALUES (:staff_name,:staff_secondname,:staff_lastname,:staff_company_id,:staff_depart_id,:staff_active,now(),:staff_enterdate,:staff_motiv,:staff_one_c,:staff_notebook,:staff_mobphone,:staff_limit)';
	$tb = $db->connection->prepare($sql);
	$tb->execute(array(':staff_name'=>$user_name,':staff_secondname'=>$user_secondname,':staff_lastname'=>$user_last_name,':staff_company_id'=>$company,':staff_depart_id'=>$department,':staff_active'=>$already_work,':staff_enterdate'=>$dateenter,':staff_motiv'=>$motiv,':staff_one_c'=>$one_c,':staff_notebook'=>$notebook,':staff_mobphone'=>$mobphone,':staff_limit'=>$limit));


		$sql = 'INSERT INTO loging (`tmlog`,`login_id`,`moving`,`rzlt`,`vargroup`,`ipuser`) VALUES (NOW(),:login_id,"создание",:rzlt,"3","'.$_SERVER["REMOTE_ADDR"].'")';
		$tb = $dbMail->connection->prepare($sql);
		//$tb->execute(array(':login_id'=>$_SESSION['user_id'],':rzlt'=>$user_last_name.' '.substr($user_name,1).'. '.substr($user_secondname,1).'.'));
		$tb->execute(array(':login_id'=>$_SESSION['user_id'],':rzlt'=>$user_last_name.' '.mb_substr($user_name,0,1).'. '.mb_substr($user_secondname,0,1).'.'));
	
	
	
	$messageIT = nl2br(trim($_POST[$prefix.'itletter']));
	
	$headers= "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/plain; charset=utf-8\r\n";

	$headers .= "From: CUSTUMERS APP <no-reply@bioline.ru>\r\n";	
	
	mail($messageTOIT, $subject, $messageIT, $headers);
	
if(isset($_POST['staff_topic'])){
	$userTo = $emails;
	$subjectTest = trim($_POST['staff_topic']);
	$testmessage = nl2br(trim($_POST['staff_textmail']));
	mail($userTo, $subjectTest, $testmessage, $headers);
}
}
?>