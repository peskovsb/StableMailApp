<?
//--mail DB
//require '../../../../../ajax/db.php';

//--itdept DB
require '../../db.php';
require 'arrFields.php';

if($_POST[$arrayForm['umail']['name']]){
	$dbMail = new Database();
	$db = new DatabaseItDept();
	
	$sql = 'SELECT * FROM users WHERE login = :staff_mail';
	$tb = $dbMail->connection->prepare($sql);
	$tb->execute(array(':staff_mail'=>trim($_POST[$arrayForm['umail']['name']])));
	$getData = $tb->fetch(PDO::FETCH_ASSOC);	
	//print_r($getData);
}


foreach($arrayForm as $f_key => $f_Items){
//echo $_POST[$f_Items['name']];
	switch($f_Items['name']){
		case $prefix.'umail':
		//echo $getData['id'];
			if($getData['user_id']){
				$rezArr[0][$f_key]['mistakeIU'] = 'mistake';
				$rezArr[0][$f_key]['msg'] = 'Такой почтовый ящик уже есть в системе';
			}else{
				if(preg_match("/[\s,*?&^%>@<+\$'№#`~=!АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя]/", $_POST[$f_Items['name']])){
					$rezArr[0][$f_key]['mistakeIU'] = 'mistake';
					$rezArr[0][$f_key]['msg'] = 'Не все необходимые поля заполнены';
				}else{
					if($_POST['submform']){
						if(strlen($_POST[$f_Items['name']])>'0'){
							$rezArr[0][$f_key]['mistakeIU'] = 'nomistake';
						}else{
							$rezArr[0][$f_key]['mistakeIU'] = 'mistake';
							$rezArr[0][$f_key]['msg'] = 'Не все необходимые поля заполнены';
						}
					}else{
						$rezArr[0][$f_key]['mistakeIU'] = 'nomistake';
					}
				}
			}
				break;
		case $prefix.'upass':
			if(preg_match("/[\s,*?&^%>@<+\$'№#`~=!АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя]/", $_POST[$f_Items['name']])){
				$rezArr[0][$f_key]['mistakeIU'] = 'mistake';
				$rezArr[0][$f_key]['msg'] = 'Не все необходимые поля заполнены';
			}else{
				$rezArr[0][$f_key]['mistakeIU'] = 'nomistake';
			}
				break;
		case $prefix.'lastname':
		case $prefix.'firstname':
		case $prefix.'secondname':
			if(preg_match("/[,\*?&^%><+\$#`~=!A-z0-9'\"]/", $_POST[$f_Items['name']])){
				$rezArr[0][$f_key]['mistakeIU'] = 'mistake';
				$rezArr[0][$f_key]['msg'] = 'Не все необходимые поля заполнены';
			}else{
				if($_POST['submform']){
					if(strlen($_POST[$f_Items['name']])>'0'){
						$rezArr[0][$f_key]['mistakeIU'] = 'nomistake';
					}else{
						$rezArr[0][$f_key]['mistakeIU'] = 'mistake';
						$rezArr[0][$f_key]['msg'] = 'Не все необходимые поля заполнены';
					}
				}else{
					$rezArr[0][$f_key]['mistakeIU'] = 'nomistake';
				}
			}
				break;
		default:
			if(preg_match("/[,\*?&^%><+\$'#`~=!]/", $_POST[$f_Items['name']])){
				$rezArr[0][$f_key]['mistakeIU'] = 'mistake';
				$rezArr[0][$f_key]['msg'] = 'Не все необходимые поля заполнены';
			}else{
				if($_POST['submform']){
					if(strlen($_POST[$f_Items['name']])>'0'){
						$rezArr[0][$f_key]['mistakeIU'] = 'nomistake';
					}else{
						$rezArr[0][$f_key]['mistakeIU'] = 'mistake';
						$rezArr[0][$f_key]['msg'] = 'Не все необходимые поля заполнены';
					}
				}else{
					$rezArr[0][$f_key]['mistakeIU'] = 'nomistake';
				}
			}
	}	
}

echo json_encode($rezArr);
?>