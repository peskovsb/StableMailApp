<?
session_start();
require 'db.php';
require 'secfile.php';
require '../itdept/stable/ajax/userlist/form_user/pref_comp.php';
if($userLevel['oper_correct_post']==0){
	exit;
}

$param = $_GET['corrParam'];

class mainpage_query{
	public $arrBest;
	public $db;
	function __construct(){
		$this->db = new Database();
	}
	function getAllfromtable($param){
		$sql = 'SELECT * FROM users WHERE user_id = :user_id';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':user_id'=>$param));
		$this->arrBest = $tb->fetch(PDO::FETCH_ASSOC);
		return $this->arrBest;
	}
}

$getData = new mainpage_query();
$arrLogin = $getData ->getAllfromtable($param);

// -- IT DEPT
$ITdept = new DatabaseItDept();
//$sql = 'SELECT * FROM staff LEFT JOIN department ON staff.staff_depart_id = department.department_id WHERE staff_id = :staff_id';
$sql = 'SELECT * FROM staff LEFT JOIN department ON staff.staff_depart_id = department.department_id ORDER by staff_lastname ASC';
$tb = $ITdept->connection->prepare($sql);
//$tb->execute(array(':staff_id'=>$arrLogin['con_user_id']));
$tb->execute();
$arrAll = $tb->fetchAll(PDO::FETCH_ASSOC);

/*echo '<pre>';
	print_r($arrAll);
echo '</pre>';

$arrAll['staff_company_id'];
$arrAll['staff_lastname']
$arrAll['staff_name']
$arrAll['staff_secondname']*/
//echo $param;
?>

<div class="delete-user-fancy-box">
<form id="m_CorrForm" action="#" method="POST">
	<table>
		<tr>
			<input type="hidden" name="cor_userid" id="user_id_id" value="<?=$arrLogin['user_id']?>">
			<td><label for="cor_login">Login</label></td>
			<td><input class="field-tpl widthfldupd" id="cor_login" type="text" name="cor_login" value="<?=$arrLogin['login']?>"></td>
		</tr>
		<tr>
			<td><label for="cor_email">Email</label></td>
			<td><input class="field-tpl widthfldupd" id="cor_email" type="text" name="cor_email" value="<?=$arrLogin['email']?>"></td>
		</tr>
		<tr>
			<td><label for="cor_pass">Пароль</label></td>
			<td><input class="field-tpl widthfldupd" id="cor_pass" type="text" name="cor_pass" value="<?=$arrLogin['password']?>"></td>
		</tr>
		<tr>
			<td><label for="cor_name">Имя</label></td>
			<td><input <?if($arrLogin['staff_id']!=0){?>disabled style="opacity:0.5"<?}?> class="field-tpl widthfldupd" id="cor_name" type="text" name="cor_name" value="<?=$arrLogin['name']?>"></td>
		</tr>
		<tr>
			<td><label for="cor_sername">Фамилия</label></td>
			<td><input <?if($arrLogin['staff_id']!=0){?>disabled style="opacity:0.5"<?}?> class="field-tpl widthfldupd" id="cor_sername" type="text" name="cor_sername" value="<?=$arrLogin['sername']?>"></td>
		</tr>
		<tr>
			<td><label for="cor_mailbox">MailBox</label></td>
			<td style="position:relative;"><div class="fogy-stopclicker"></div><input type="checkbox" id="passnextmailbox" class="canIgonext"><input class="field-tpl widthfldupd" id="cor_mailbox" type="text" name="cor_mailbox" value="<?=$arrLogin['mailbox']?>"></td>
		</tr>
		<tr>
			<td><label for="cor_date">Дата</label></td>
			<td><input class="field-tpl widthfldupd" id="cor_date" type="text" name="cor_date" value="<?=date("d-m-Y",  strtotime($arrLogin['userdate']))?>"></td>
		</tr>
		<tr>
			<td><label for="cor_domid">Domain_id</label></td>
			<td><input class="field-tpl widthfldupd" disabled id="cor_domid" type="text" name="cor_domid" value="<?=$arrLogin['domain_id']?>"></td>
		</tr>
		<tr>
			<td><label for="cor_domid">Профиль</label></td>
			<td>
				<select name="profile-take-cor" id="profile-take-cor" class="field-tpl widthfldupd">
					<option value="0">-- Профиль --</option>
					<?foreach($arrAll as $Items){?>
						<option <?if($arrLogin['staff_id'] == $Items['staff_id']){?>selected<?}?> value="<?=$Items['staff_id']?>"><?=$Items['staff_lastname']?> <?=$Items['staff_name']?> <?=$arrAll['staff_secondname']?> (<?=$Items['staff_post']?> - <?=$pref_comp[$Items['staff_company_id']]?>)</option>
						
					<?}?>
				</select>
			</td>
		</tr>
		<tr>
			<td><label for="cor_active">Active</label></td>
			<td><input class="field-tpl" id="cor_active" type="checkbox" name="cor_active" <?if($arrLogin['active']=='1'){?>checked<?}?> value="1">
			</td>
		</tr>
	</table>

	
	
<!--	<div class="header-delete-user-fancybox">Вы уверены, что хотите удалить именно этого пользователя?</div>
	<div class="result-blocks"><b>id пользователя: </b><b style="color:#0044cc"><?=$arrLogin['user_id']?></b></div>
	<div class="result-blocks"><b>login: </b><?=$arrLogin['login']?></div>
	<div class="result-blocks"><b>email: </b><?=$arrLogin['email']?></div>-->
	<div class="btns-fin-corr-container">
		<input type="submit" class="CorrectFinUser" name="corr_form" value="Редактировать"> <a onclick="$.fancybox({ closeClick  : true});" class="NotToDell" href="javascript:void(0);">Отмена</a>
	</div>
</div>
</form>

	<script>
  $(function() {
    $( "#cor_date" ).datepicker({dateFormat: "dd-mm-yy"});
  });
  </script>	