<?
//-- params
$formId = 'ipForm';
$prefix = 'ip';
$formBuild = $prefix.'_'.$formId;

$formArr = array(
	'ip_id' => 
		array(
			'name' => $prefix.'_ip_id',
			'title' => 'IP адрес'
		),
	'staff_id' => 
		array(
			'name' => $prefix.'_user_id',
			'title' => 'Пользователь'
		),
	'comp_name' => 
		array(
			'name' => $prefix.'_comp_id',
			'title' => 'Компьютер'
		)
);
?>