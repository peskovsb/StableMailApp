<?
function generateSalt() {
    $salt = '';
    $length = rand(5,10); // длина соли (от 5 до 10 сомволов)
    for($i=0; $i<$length; $i++) {
         $salt .= chr(rand(33,126)); // символ из ASCII-table
    }
    return $salt;
}
if($_POST['send_data']){
	$salt = generateSalt();
	$pass = md5(md5($_POST['pass_gen']).$salt);
	echo '<p>Пароль: <b>'.$pass.'</b></p>';
	echo '<p>Соль: <b>'.$salt.'</b></p>';
}else{
?>
<h1>Получить соль и пароль</h1>
<form action="<?=$DOCUMENT_ROOT['PHP_SELF']?>" method="POST">
	<label>Пароль</label><br>
	<input type="text" name="pass_gen"><br><br>
	<input type="submit" name="send_data" value="получить">
</form>
<?
}
?>