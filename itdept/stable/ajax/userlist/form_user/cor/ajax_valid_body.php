<?
/*
$_POST['staff_lastname']
$_POST['staff_name']
$_POST['staff_secondname']
$_POST['staff_post']
*/



if(strlen($_POST['staff_cor_lastname'])>0){
	if(preg_match("/[^АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя-\s]/", $_POST['staff_cor_lastname'])){
		
			$rezArr[0]['lastname']['mistakeIU'] = 'mistake';
			$rezArr[0]['lastname']['msg'] = 'Не все необходимые поля заполнены';
				$mistake = 1;
	}else{
		$rezArr[0]['lastname']['mistakeIU'] = 'nomistake';
			
	}
}else{
	$rezArr[0]['lastname']['mistakeIU'] = 'mistake';
}

if(strlen($_POST['staff_name'])>0){
	if(preg_match("/[^АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя-\s]/", $_POST['staff_name'])){
		
			$rezArr[0]['first_name']['mistakeIU'] = 'mistake';
			$rezArr[0]['first_name']['msg'] = 'Не все необходимые поля заполнены';
				$mistake = 1;
	}else{
		$rezArr[0]['first_name']['mistakeIU'] = 'nomistake';
			
	}
}else{
	$rezArr[0]['first_name']['mistakeIU'] = 'mistake';
}

if(strlen($_POST['staff_secondname'])>0){
	if(preg_match("/[^АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя-\s]/", $_POST['staff_secondname'])){
		
			$rezArr[0]['second_name']['mistakeIU'] = 'mistake';
			$rezArr[0]['second_name']['msg'] = 'Не все необходимые поля заполнены';
				$mistake = 1;
	}else{
		$rezArr[0]['second_name']['mistakeIU'] = 'nomistake';
			
	}
}else{
	$rezArr[0]['second_name']['mistakeIU'] = 'mistake';
}


if(strlen($_POST['staff_post'])>0){
	if(preg_match("/[^АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя\sa-zA-Z-_]/", $_POST['staff_post'])){
		
			$rezArr[0]['staff_post']['mistakeIU'] = 'mistake';
			$rezArr[0]['staff_post']['msg'] = 'Не все необходимые поля заполнены';
				$mistake = 1;
	}else{
		$rezArr[0]['staff_post']['mistakeIU'] = 'nomistake';
			
	}
}else{
	$rezArr[0]['staff_post']['mistakeIU'] = 'mistake';
}

if($_POST['staff_department'] == '0'){
	$rezArr[0]['staff_department']['mistakeIU'] = 'nomistake';
}else{
	$rezArr[0]['staff_department']['mistakeIU'] = 'nomistake';
}

?>