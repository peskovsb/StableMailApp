<?
session_start();
require 'db.php';
require 'secfile.php';
if($userLevel['oper_create_forw']==0){
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
}

$getData = new mainpage_query();
$arrLogin = $getData ->getAllfromtable($param);

?>

<div class="delete-user-fancy-box">
<?

//explode Array
$arrExpld = explode(',',$arrLogin['alias']);
?>
<form id="a_makeForm" action="#" method="POST">
	<table>
		<tr>
			<td><label for="cor_username">username</label></td>
			<td style="position:relative;">
			<input autocomplete="off" class="field-tpl widthfldupd" id="cor_username" type="text" name="cor_username" value="">
			<div class="usernamerez">
				<!-- username rezult here -->
			</div>
			</td>
		</tr>
		<tr id="fiels-area-0" class="createdfield">
			<td class="field-cover" style="vertical-align:top;padding-top:5px;"><label for="cor_email">alias</label></td>
			<td style="position:relative;">
				<input autocomplete="off" data-memo="0" data-getvalid="" data-numfld="0" class="field-tpl aliasaddedfld" type="text" name="field_alias_0" id="field_alias_0" value="" style="border-color: rgb(204, 204, 204);">
					<div class="aliasrez alblock_0"></div>
			</td>
		</tr>

		<tr class="btnrow-more-alias">
			<td></td>
			<td><div class="btn-container" style="width:340px;margin-bottom:10px;"><a id="moreIdAlias" onclick="$alCounter=1;" class="btn-more-valuesAlias" href="javascript:void(0);">Еще...</a></div></td>
		</tr>		
		<tr>
		<td><label for="cor_date">Дата с</label></td>
			<td><input style="width:145px;" class="field-tpl widthfldupd" id="cor_datefrom" type="text" name="cor_datefrom" value=""> <label style="margin: 0;" for="cor_date">по</label> <input style="width:145px;" class="field-tpl widthfldupd" id="cor_dateto" type="text" name="cor_dateto" value=""></td>
		</tr>
		<tr>
			<td><label for="cor_autoanswer">Включить автоответ</label></td>
			<td style="position:relative;">
				<input autocomplete="off" id="cor_autoanswer" type="checkbox" name="cor_autoanswer" value="1">
			</td>
		</tr>
		<tr class="autotextarea">
			<td></td>
			<td style="position:relative;">
				<textarea rows="10" class="field-tpl" name="field_TtextAutoLetter" id="field_TtextAutoLetter" style="width: 310px;"></textarea>
			</td>
		</tr>		
	</table>


	<div class="btns-fin-corr-container" style="  width: 310px;  padding-left: 110px; margin:15px 0 0 0;">
		<input type="submit" class="CorrectFinUser" id="setFocBtn" name="corr_form" value="Сохранить"> 
		<a onclick="clearAllAlias();" class="clearfieldsAlias btn-danger" style="margin-top:0px; width: 140px;">Очистить Форму</a>
	</div>
	
			<div class="content-wrapper-alias">
				<!-- Result Content -->
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