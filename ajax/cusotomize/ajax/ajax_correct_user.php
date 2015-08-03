<?
require '../../db.php';

$param = $_GET['corrParam'];

class mainpage_query{
	public $arrBest;
	public $db;
	function __construct(){
		$this->db = new DatabaseItDept();
	}
	function getAllfromtable($param){
		$sql = 'SELECT * FROM inner_users WHERE user_id = :user_id';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':user_id'=>$param));
		$this->arrBest = $tb->fetch(PDO::FETCH_ASSOC);
		return $this->arrBest;
	}
}

$getData = new mainpage_query();
$arrLogin = $getData ->getAllfromtable($param);

$db = new DatabaseItDept();
$sql = 'SELECT * FROM levels ORDER BY level_id DESC';
		$tb = $db->connection->prepare($sql);
		$tb->execute();
		$arrLevels = $tb->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- VIewTemplate Visuality -->

<div class="delete-user-fancy-box">
<form id="IU_CorrForm" action="#" method="POST">
	<table>
		<tr>
			<input type="hidden" name="cor_userid" id="user_id_id" value="<?=$arrLogin['user_id']?>">
			<td><label for="cor_login">Логин</label></td>
			<td><input class="field-tpl widthfldupd" id="cor_login_IU" type="text" name="cor_login_IU" value="<?=$arrLogin['user_login']?>"></td>
		</tr>
		<tr>
			<td><label for="cor_email">Пароль</label></td>
			<td style="position:relative;">
				<a class="btn-chngpass" href="javascript:void(0);">Сменить пароль</a>
				<input placeholder="Задавайте новый пароль здесь..." style="display:none;" class="field-tpl widthfldupd" id="cor_changepass_IU" type="text" name="cor_changepass_IU" value="">
				<a style="display:none;" onclick="$('#cor_changepass_IU').val(str_rand());document.getElementById('cor_changepass_IU').focus();" title="сгенерировать случайный пароль" class="genpass" id="pasIUgenerator" href="javascript:void(0);"><i style="  font-size: 20px;" class="fa fa-cog"></i></a>
			</td>
		</tr>
		<tr>
			<td><label for="cor_name">Уровень</label></td>
			<td>
				<select name="cor_level" id="cor_level" class="super-fire-list select-list" style="width: 190px; border-color: rgb(204, 204, 204);">
					<?foreach($arrLevels as $Items){?>
						<option <?if($arrLogin['user_level']==$Items['level_id']){?>selected<?}?> value="<?=$Items['level_id']?>"><?=$Items['level_name']?></option>
					<?}?>					
				</select>
			</td>
		</tr>
		<tr>
			<td><label for="cor_sername">Фамилия</label></td>
			<td><input class="field-tpl widthfldupd" id="cor_sername_IU" type="text" name="cor_sername_IU" value="<?=$arrLogin['user_surname']?>"></td>
		</tr>
		<tr>
			<td><label for="cor_name">Имя</label></td>
			<td><input class="field-tpl widthfldupd" id="cor_name_IU" type="text" name="cor_name_IU" value="<?=$arrLogin['user_name']?>"></td>
		</tr>
		<tr>
			<td><label for="cor_name">Активность</label></td>
			<td><input <?if($arrLogin['active']){echo 'checked';}?> id="cor_active_IU" type="checkbox" name="cor_active_IU" value="1"></td>
		</tr>
		<tr>
			<td><label for="cor_name"></label></td>
			<td><a id="seezhurn" href="javascript:void(0)" style="color: #3a87ad; font-size: 12px;">Просмотреть журнал логов</a></td>
		</tr>
		<tr class="lastfld">
			<td><label for="cor_active">Дата регистрации</label></td>
			<td><?=date('d/m/Y H:i:s',strtotime($arrLogin['user_datereg']))?></td>
		</tr>
	</table>
	<div class="btns-fin-corr-container">
		<input type="submit" class="CorrectFinUser" name="corr_form" value="Редактировать"> <a onclick="$.fancybox({ closeClick  : true});" class="NotToDell" href="javascript:void(0);">Отмена</a>
	</div>
</form>
</div>
