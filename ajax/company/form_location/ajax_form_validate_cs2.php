<?
require '../../db.php';
require 'arrFields.php';

if($_POST[$arrayForm['umail']['name']]){
	$db = new DatabaseItDept();
	$sql = 'SELECT * FROM staff WHERE staff_mail = :staff_mail';
	$tb = $db->connection->prepare($sql);
	$tb->execute(array(':staff_mail'=>$_POST[$arrayForm['umail']['name']]));
	$getData = $tb->fetch(PDO::FETCH_ASSOC);	
}

//array_pop($_POST);

foreach($_POST as $f_key => $f_Items){
//echo $f_Items;
	switch($f_key){
		case 'submform':
			break;
		case $prefix.'umail':
		//echo $getData['id'];
			if($getData['staff_id']){
				$rezArr[0][$f_key]['mistakeIU'] = 'mistake';
				$rezArr[0][$f_key]['msg'] = 'Такой почтовый ящик уже есть в системе';
			}else{
				if(preg_match("/[\s,*?&^%>@<+\$'№#`~=!АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя]/", $f_Items)){
					$rezArr[0][$f_key]['mistakeIU'] = 'mistake';
					$rezArr[0][$f_key]['msg'] = 'Поле '.$f_key.' имеет запрещенные символы';
				}else{
					if($_POST['submform']){
						if(strlen($f_Items)>'0'){
							$rezArr[0][$f_key]['mistakeIU'] = 'nomistake';
						}else{
							$rezArr[0][$f_key]['mistakeIU'] = 'mistake';
							$rezArr[0][$f_key]['msg'] = 'Поле "'.$f_key.'" не должно быть пустым';
						}
					}else{
						$rezArr[0][$f_key]['mistakeIU'] = 'nomistake';
					}
				}
			}
				break;
		case $prefix.'upass':
			if(preg_match("/[\s,*?&^%>@<+\$'№#`~=!АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя]/", $f_Items)){
				$rezArr[0][$f_key]['mistakeIU'] = 'mistake';
				$rezArr[0][$f_key]['msg'] = 'Поле '.$f_key.' имеет запрещенные символы';
			}else{
				$rezArr[0][$f_key]['mistakeIU'] = 'nomistake';
			}
				break;
		case $prefix.'lastname':
		case $prefix.'firstname':
		case $prefix.'secondname':
			if(preg_match("/[,\*?&^%><+\$#`~=!A-z'\"]/", $f_Items)){
				$rezArr[0][$f_key]['mistakeIU'] = 'mistake';
				$rezArr[0][$f_key]['msg'] = 'Поле "'.$f_key.'" имеет запрещенные символы';
			}else{
				if($_POST['submform']){
					if(strlen($f_Items)>'0'){
						$rezArr[0][$f_key]['mistakeIU'] = 'nomistake';
					}else{
						$rezArr[0][$f_key]['mistakeIU'] = 'mistake';
						$rezArr[0][$f_key]['msg'] = 'Поле '.$f_key.' не должно быть пустым';
					}
				}else{
					$rezArr[0][$f_key]['mistakeIU'] = 'nomistake';
				}
			}
				break;
		default:
		//echo $f_Items.'<br>';
		//if($f_Items){echo 'est';}else{echo 'no est';}
			if(preg_match("/[,\*?&^%><+\$'#`~=!]/", $f_Items)){
				$rezArr[0][$f_key]['mistakeIU'] = 'mistake';
				$rezArr[0][$f_key]['msg'] = 'Поле '.$f_key.' имеет запрещенные символы';
			}else{
				if($_POST['submform']){
					if(strlen($f_Items)>'0'){
						$rezArr[0][$f_key]['mistakeIU'] = 'nomistake';
					}else{
						$rezArr[0][$f_key]['mistakeIU'] = 'mistake';
						$rezArr[0][$f_key]['msg'] = 'Поле "'.$f_key.'" не должно быть пустым';
					}
				}else{
					$rezArr[0][$f_key]['mistakeIU'] = 'nomistake';
				}
			}
	}	
}

echo json_encode($rezArr);
?>