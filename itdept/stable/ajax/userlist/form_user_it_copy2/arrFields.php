<?
$prefix = 'it_';
$formName = $prefix.'FormCreateInnerUser';
$arrayForm = array(
	'lastname' => 
		array(
			'name' => $prefix.'lastname',
			'title' => 'Фамилия',
			'require' => '1'
		),
	'firstname' => 
		array(
			'name' => $prefix.'firstname',
			'title' => 'Имя',
			'require' => '1'
		),
	'secondname' => 
		array(
			'name' => $prefix.'secondname',
			'title' => 'Отчество',
			'require' => '1'
		),
	'company' => 
		array(
			'name' => $prefix.'company',
			'title' => 'Компания',
			'require' => '1'
		),
	'location' => 
		array(
			'name' => $prefix.'location',
			'title' => 'Расположение',
			'require' => '1'
		),
	/*'phone' => 
		array(
			'name' => $prefix.'phone',
			'title' => 'Телефон'
		),*/
	'executive' => 
		array(
			'name' => $prefix.'executive',
			'title' => 'Руководитель',
			'require' => '1'
	),
	'department' => 
		array(
			'name' => $prefix.'department',
			'title' => 'Отдел',
			'require' => '1'
		),
	'groupdep' => 
		array(
			'name' => $prefix.'groupdep',
			'title' => 'Группа отдела'
		),
	'mob_phone' => 
		array(
			'name' => $prefix.'mob_phone',
			'title' => 'Моб. Телефон'
		),
	'ats' => 
		array(
			'name' => $prefix.'ats',
			'title' => 'Внутренний телефон'
		),
	'post' => 
		array(
			'name' => $prefix.'post',
			'title' => 'Должность',
			'require' => '1'
		),
	'mail' => 
		array(
			'name' => $prefix.'mail',
			'title' => 'Почта'
		),
	'motiv' => 
		array(
			'name' => $prefix.'motiv',
			'title' => 'Мотив'
		),
	'one_c' => 
		array(
			'name' => $prefix.'one_c',
			'title' => '1 С'
		),
	'notebook' => 
		array(
			'name' => $prefix.'notebook',
			'title' => 'Ноутбук'
		),
	'mobphone' => 
		array(
			'name' => $prefix.'mobphone',
			'title' => 'Мобильный'
		),
	'limit' => 
		array(
			'name' => $prefix.'limit',
			'title' => 'Лимит'
		),
	'dateenter' => 
		array(
			'name' => $prefix.'dateenter',
			'title' => 'Дата выхода',
			'require' => '1'
		),
	'umail' => 
		array(
			'name' => $prefix.'umail',
			'title' => 'Логин'
		),
	'upass' => 
		array(
			'name' => $prefix.'upass',
			'title' => 'Пароль'
		),
	'already_work' => 
		array(
			'name' => $prefix.'already_work',
			'title' => 'Уже работает'
		),
	'itletter' => 
		array(
			'name' => $prefix.'itletter',
			'title' => 'Письмо в IT'
		)
);
?>