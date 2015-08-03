<?
require '../../../db.php';
require 'arrFields.php';

if($_GET[$arrayForm['umail']['name']]){
	$db = new DatabaseItDept();
	$sql = 'SELECT * FROM staff WHERE staff_mail = :staff_mail';
	$tb = $db->connection->prepare($sql);
	$tb->execute(array(':staff_mail'=>$_GET[$arrayForm['umail']['name']]));
	$getData = $tb->fetch(PDO::FETCH_ASSOC);	
}


foreach($arrayForm as $f_key => $f_Items){
//echo $_GET[$f_Items['name']];
	switch($f_Items['name']){
		case $prefix.'umail':
		//echo $getData['id'];
			if($getData['staff_id']){
				$rezArr[0][$f_key]['mistakeIU'] = 'mistake';
				$rezArr[0][$f_key]['msg'] = 'Такой почтовый ящик уже есть в системе';
			}else{
				if(preg_match("/[\s,*?&^%>@<+\$'№#`~=!АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя]/", $_GET[$f_Items['name']])){
					$rezArr[0][$f_key]['mistakeIU'] = 'mistake';
					$rezArr[0][$f_key]['msg'] = 'Поле '.$f_Items['title'].' имеет запрещенные символы';
				}else{
					$rezArr[0][$f_key]['mistakeIU'] = 'nomistake';
				}
			}
				break;
		case $prefix.'upass':
			if(preg_match("/[\s,*?&^%>@<+\$'№#`~=!АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя]/", $_GET[$f_Items['name']])){
				$rezArr[0][$f_key]['mistakeIU'] = 'mistake';
				$rezArr[0][$f_key]['msg'] = 'Поле '.$f_Items['title'].' имеет запрещенные символы';
			}else{
				$rezArr[0][$f_key]['mistakeIU'] = 'nomistake';
			}
				break;
		case $prefix.'lastname':
		case $prefix.'firstname':
		case $prefix.'secondname':
			if(preg_match("/[,\*?&^%><+\$#`~=!A-z'\"]/", $_GET[$f_Items['name']])){
				$rezArr[0][$f_key]['mistakeIU'] = 'mistake';
				$rezArr[0][$f_key]['msg'] = 'Поле '.$f_Items['title'].' имеет запрещенные символы';
			}else{
				$rezArr[0][$f_key]['mistakeIU'] = 'nomistake';
			}
				break;
		default:
			if(preg_match("/[,\*?&^%><+\$'#`~=!]/", $_GET[$f_Items['name']])){
				$rezArr[0][$f_key]['mistakeIU'] = 'mistake';
				$rezArr[0][$f_key]['msg'] = 'Поле '.$f_Items['title'].' имеет запрещенные символы';
			}else{
				$rezArr[0][$f_key]['mistakeIU'] = 'nomistake';
			}
	}	
}

echo json_encode($rezArr);
?>