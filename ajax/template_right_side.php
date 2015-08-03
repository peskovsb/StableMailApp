<?
//--Params -- Items---
//--`user_id`
//--`email`
//--`fio`
//--`password`

//*******
//echo '<span class="close-justadded"></span>';
echo '<h1 class="result-header">Рузультат добавления в базу данных</h1>';
	echo '<div class="result-blocks"><b>id пользователя: </b><b style="color:#0044cc">'.$getter['user_id'].'</b></div>';
	echo '<div class="result-blocks"><b>email: </b>'.$getter['email'].'</div>';
	echo '<div class="result-blocks"><b>ФИО: </b>'.$getter['fio'].'</div>';
	echo '<div class="result-blocks"><b>Пароль: </b>'.$getter['password'].'</div>';
	if($checkBox=='1'){echo '<div style="color:#090" class="result-blocks"><b>Письмо отправлено</b></div>';}	
?>
