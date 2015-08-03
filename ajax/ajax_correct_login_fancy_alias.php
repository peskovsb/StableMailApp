<?
session_start();
require 'db.php';
require 'secfile.php';
if($userLevel['oper_correct_forw']==0){
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
		$sql = 'SELECT * FROM aliases WHERE alias_id = :alias_id';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':alias_id'=>$param));
		$this->arrBest = $tb->fetch(PDO::FETCH_ASSOC);
		return $this->arrBest;
	}
	function getTextData(){
		$sql = 'SELECT `active`,`bcc_autoreply_text` FROM bcc WHERE bcc_name = :reply_login';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':reply_login'=>$this->arrBest['username'].'@bioline.ru'));
		$this->arrC = $tb->fetch(PDO::FETCH_ASSOC);
		return $this->arrC;
	}
}

function br2nl($string)
{
	return str_replace("<br />","\r\n", $string);
}

$getData = new mainpage_query();
$arrLogin = $getData ->getAllfromtable($param);
$arrMsg = $getData ->getTextData();
?>

<div class="delete-user-fancy-box">
<?

//explode Array
$arrExpld = explode(',',$arrLogin['alias']);


	if($arrMsg['active']=='1'){
		$chkBox = '1';
	}
?>
<form id="a_CorrForm" action="#" method="POST">
	<table>
		<tr>
			<input type="hidden" name="cor_userid" id="user_id_id" value="<?=$arrLogin['alias_id']?>">
			<input type="hidden" name="user_prev_name" id="user_prev_name" value="<?=$arrLogin['username']?>">
			<td><label for="cor_username">username</label></td>
			<td style="position:relative;">
			<input autocomplete="off" class="field-tpl widthfldupd" id="cor_username" type="text" name="cor_username" value="<?=$arrLogin['username']?>">
			<div class="usernamerez">
				<!-- username rezult here -->
			</div>
			</td>
		</tr>
		<tr id="fiels-area-0" class="createdfield">
			<td class="field-cover" style="vertical-align:top;padding-top:5px;"><label for="cor_email">alias</label></td>
			<td style="position:relative;">
				<input autocomplete="off" data-memo="0" data-getvalid="" data-numfld="0" class="field-tpl aliasaddedfld" type="text" name="field_alias_0" id="field_alias_0" value="<?=trim($arrExpld[0])?>" style="border-color: rgb(204, 204, 204);">
					<div class="aliasrez alblock_0"></div>
			</td>
		</tr>
			<?
			$contrDel = '0';
			foreach($arrExpld as $itemsAlias){
				
				if($contrDel != '0'){
			?>
				<tr id="fiels-area-<?=$contrDel?>" class="createdfield">
					<td class="field-cover" style="vertical-align:top;padding-top:5px;"><label for="cor_email"></label></td>
					<td style="position:relative;">
						<input autocomplete="off" data-memo="<?=$contrDel?>" data-getvalid="" data-numfld="<?=$contrDel?>" class="field-tpl aliasaddedfld" type="text" name="field_alias_<?=$contrDel?>" id="field_alias_<?=$contrDel?>" value="<?=trim($itemsAlias)?>" style="border-color: rgb(204, 204, 204);">
							<div class="aliasrez alblock_<?=$contrDel?>"></div>
							<i data-numfild="<?=$contrDel?>" id="del_fld_0" style="color: rgb(204, 17, 17);" class="fa fa-times delladdmailfld"></i>
					</td>
				</tr>
				<?}?>
				<?$contrDel++;?>
			<?}?>
		<tr class="btnrow-more-alias">
			<td></td>
			<td><div class="btn-container" style="width:340px;margin-bottom:10px;"><a id="moreIdAlias" onclick="$alCounter=<?=$contrDel;?>" class="btn-more-valuesAlias" href="javascript:void(0);">Еще...</a></div></td>
		</tr>			
		<tr>
		<td><label for="cor_date">Дата с</label></td>
			<td><input style="width:145px;" class="field-tpl widthfldupd" id="cor_datefrom" type="text" name="cor_datefrom" value="<?echo date("d-m-Y",  strtotime($arrLogin['aliasdatefrom']))=='01-01-1970' ? '' : date("d-m-Y",  strtotime($arrLogin['aliasdatefrom']));?>"> <label style="margin: 0;" for="cor_date">по</label> <input style="width:145px;" class="field-tpl widthfldupd" id="cor_dateto" type="text" name="cor_dateto" value="<?echo date("d-m-Y",  strtotime($arrLogin['aliasdateto']))=='01-01-1970' ? '' : date("d-m-Y",  strtotime($arrLogin['aliasdateto']));?>"></td>
		</tr>
		<tr>
			<td style="width: 80px;"><label for="cor_autoanswer">Включить автоответ</label></td>
			<td style="position:relative;">
				<input autocomplete="off" id="cor_autoanswer" <?if($chkBox=='1'){echo 'checked';}?> type="checkbox" name="cor_autoanswer" value="1">
			</td>
		</tr>
		<tr class="autotextarea" <?if($chkBox=='1'){echo 'style="display: table-row;"';}?>>
			<td></td>
			<td style="position:relative;">
				<textarea rows="10" class="field-tpl" name="field_TtextAutoLetter" id="field_TtextAutoLetter" style="width: 310px;"><?=br2nl($arrMsg['bcc_autoreply_text'])?></textarea>
			</td>
		</tr>		
	</table>

	
	
<!--	<div class="header-delete-user-fancybox">Вы уверены, что хотите удалить именно этого пользователя?</div>
	<div class="result-blocks"><b>id пользователя: </b><b style="color:#0044cc"><?=$arrLogin['user_id']?></b></div>
	<div class="result-blocks"><b>login: </b><?=$arrLogin['login']?></div>
	<div class="result-blocks"><b>email: </b><?=$arrLogin['email']?></div>-->
	<div class="btns-fin-corr-container">
		<input type="submit" class="CorrectFinUser" id="setFocBtn" name="corr_form" value="Редактировать"> <a onclick="$.fancybox({ closeClick  : true});" class="NotToDell" href="javascript:void(0);">Отмена</a>
	</div>
</div>
</form>

	<script>

  $(function() {

  		var def = new Date();
		var mm2 = def.getMonth() + 1;
		if(mm2<10){
			mm2='0'+mm2;
		}
		var dd2 = def.getDate() + 1;
		var yy2 = def.getFullYear();
		var myDateString2 = dd2 + '-' + mm2 + '-' + yy2; //(US)
  
     $( "#cor_datefrom" ).datepicker({
	 minDate: 0,
	dateFormat: "dd-mm-yy", 
	onClose: function( selectedDate ) {
		from = selectedDate.split("-");
		f = new Date(from[2], from[1] - 1, from[0]);
		var d = new Date(f);
		var mm = d.getMonth() + 1;
		if(mm<10){
			mm='0'+mm;
		}
		var dd = d.getDate() + 1;
		var yy = d.getFullYear();
		var myDateString = dd + '-' + mm + '-' + yy; //(US)
		//alert(myDateString);

        $( "#cor_dateto" ).datepicker( "option", "minDate", myDateString );
      }
 });
 $( "#cor_dateto" ).datepicker({
 minDate: myDateString2,
 dateFormat: "dd-mm-yy",
	onClose: function( selectedDate ) {
        $( "#cor_datefrom" ).datepicker( "option", "maxDate", selectedDate );
      }
 });
  });
  </script>	