<?
require '../../db.php';
$db = new DatabaseItDept();
?>
<html>
<style>

.round-wrapper{margin:auto;width:65%;}
.table-tpl thead th{	
text-align: left;
    padding: 10px 10px;
    background: rgb(240,240,240);
    background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
    background: -moz-linear-gradient(top, rgba(240,240,240,1) 0%, rgba(222,222,222,1) 100%);
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(240,240,240,1)), color-stop(100%,rgba(222,222,222,1)));
    background: -webkit-linear-gradient(top, rgba(240,240,240,1) 0%,rgba(222,222,222,1) 100%);
    background: -o-linear-gradient(top, rgba(240,240,240,1) 0%,rgba(222,222,222,1) 100%);
    background: -ms-linear-gradient(top, rgba(240,240,240,1) 0%,rgba(222,222,222,1) 100%);
    background: linear-gradient(to bottom, rgba(240,240,240,1) 0%,rgba(222,222,222,1) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f0f0f0', endColorstr='#dedede',GradientType=0 );
    border-top: 1px solid #DEDEDE;
    border-bottom: 1px solid #D0D0D0;
}
.table-tpl thead th:first-child{    border-left: 1px solid #DEDEDE;}
.table-tpl thead th:last-child{     border-right: 1px solid #DEDEDE;}
.round-wrapper{
	-webkit-border-radius: 4px 4px 0 0;
	-moz-border-radius: 4px 4px 0 0;
	border-radius: 4px 4px 0 0;
	/*overflow:hidden;*/
	border-bottom:1px solid #D0D0D0;
}
.start-tr{height:0;width:0;}
.table-tpl{border:1px solid #EAEAEA;}
.table-tpl tbody td{padding:5px 10px;}

.val:hover{background:#ccc;}

.btn-correct-tbl{
	width: 10px;
    color: #000;
    text-decoration: none;
    display: inline-block;
    padding: 4px 12px;
    margin-bottom: 0;
    font-size: 14px;
    line-height: 20px;
    color: #333333;
    text-align: center;
    text-shadow: 0 1px 1px rgba(255,255,255,0.75);
    vertical-align: middle;
    cursor: pointer;
    background-color: #f5f5f5;
    background-image: -moz-linear-gradient(top,#ffffff,#e6e6e6);
    background-image: -webkit-gradient(linear,0 0,0 100%,from(#ffffff),to(#e6e6e6));
    background-image: -webkit-linear-gradient(top,#ffffff,#e6e6e6);
    background-image: -o-linear-gradient(top,#ffffff,#e6e6e6);
    background-image: linear-gradient(to bottom,#ffffff,#e6e6e6);
    background-repeat: repeat-x;
    border: 1px solid #cccccc;
    border-color: #e6e6e6 #e6e6e6 #bfbfbf;
    border-color: rgba(0,0,0,0.1) rgba(0,0,0,0.1) rgba(0,0,0,0.25);
    border-bottom-color: #b3b3b3;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffffff',endColorstr='#ffe6e6e6',GradientType=0);
    filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
    -webkit-box-shadow: inset 0 1px 0 rgba(255,255,255,0.2),0 1px 2px rgba(0,0,0,0.05);
    -moz-box-shadow: inset 0 1px 0 rgba(255,255,255,0.2),0 1px 2px rgba(0,0,0,0.05);
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.2),0 1px 2px rgba(0,0,0,0.05);
    margin: 0;
}
</style>

<h2>Питер - Офис</h2>

<script src="../../../js/jquery-1.11.2.min.js"></script>

<link rel="stylesheet" type="text/css" href="../../../css/style.css">
<?
$staff_loc = '1';

//*** BUILD District IPs
//--------------------------
$sql = 'SELECT * FROM location WHERE location_id = :location_id;';
$tb = $db->connection->prepare($sql);
$tb->execute(array(':location_id'=>$staff_loc));
$arrDistr = $tb->fetch(PDO::FETCH_ASSOC);

/*echo '<pre>';
	print_r($arrDistr);
echo '</pre>';*/



?>

<script>

$(document).ready(function(){
	/*setTimeout(function(){
	$('#start-tr').after('<?for($i=1;$i<=254;$i++){?> <? $sql = 'SELECT * FROM ip LEFT JOIN comp ON ip.comp_id = comp.comp_id LEFT JOIN staff ON ip.staff_id = staff.staff_id LEFT JOIN location ON location.location_id = staff.staff_location WHERE location.location_id = :location_id AND ip.ip = :ip;'; $tb = $db->connection->prepare($sql); $tb->execute(array(':location_id'=>$staff_loc,':ip'=>$i)); $arrAll = $tb->fetch(PDO::FETCH_ASSOC);  ?> <tr class="val"> <td>192.168.<?=$arrDistr["location_subnetwork"]?>.<?=$i?></td> <td><?=$arrAll["staff_lastname"]?> <?=$arrAll["staff_name"]?></td> 				 <td><?=$arrAll["comp_name"]?></td> </tr> <?}?>');	
		
	},500)
	setTimeout(function(){
		$(".val").remove();
		$(".val").hide();
	$('#start-tr').after('<?for($i=1;$i<=254;$i++){?> <? $sql = 'SELECT * FROM ip LEFT JOIN comp ON ip.comp_id = comp.comp_id LEFT JOIN staff ON ip.staff_id = staff.staff_id LEFT JOIN location ON location.location_id = staff.staff_location WHERE location.location_id = :location_id AND ip.ip = :ip;'; $tb = $db->connection->prepare($sql); $tb->execute(array(':location_id'=>2,':ip'=>$i)); $arrAll = $tb->fetch(PDO::FETCH_ASSOC);  ?> <tr class="val"> <td>192.168.<?=$arrDistr["location_subnetwork"]?>.<?=$i?></td> <td><?=$arrAll["staff_lastname"]?> <?=$arrAll["staff_name"]?></td> 				 <td><?=$arrAll["comp_name"]?></td> </tr> <?}?>');
		//$('.val').fadeIn(600);
		$(".val").hide();
		$('.val').fadeIn(600);
		
	},1500)
	setTimeout(function(){
		$(".val").remove();
		
	$('#start-tr').after('<?for($i=1;$i<=24;$i++){?> <? $sql = 'SELECT * FROM ip LEFT JOIN comp ON ip.comp_id = comp.comp_id LEFT JOIN staff ON ip.staff_id = staff.staff_id LEFT JOIN location ON location.location_id = staff.staff_location WHERE location.location_id = :location_id AND ip.ip = :ip;'; $tb = $db->connection->prepare($sql); $tb->execute(array(':location_id'=>2,':ip'=>$i)); $arrAll = $tb->fetch(PDO::FETCH_ASSOC);  ?> <tr class="val"> <td>192.168.<?=$arrDistr["location_subnetwork"]?>.<?=$i?></td> <td>123123</td> 				 <td><?=$arrAll["comp_name"]?></td> </tr> <?}?>').fadeIn('600');
		//$('.val').fadeIn(600);
		$(".val").hide();
		$('.val').fadeIn(600);
		
	},2500);*/
	
	drawTable('ip','','','1');

});

$(document).on('change','#ipLocation',function(){
	dataLoc = $(this).val();
	drawTable('ip','','',dataLoc);
})

	/* DRAWING TABLE func
	-------------------------------------------*/
	function drawTable (folder,page,search,loc){
	timeStmp = $('#first-row-drawing').attr('data-timeStmp');
	
		$.ajax({
			dataType: "HTML",
			data: {page: page,loc: loc},
			type: "POST",
			url : "../"+folder+"/ajax/ajax_list.php",
				success : function (data) {
					//-- HTML data
					$('#start-tr').after(data).hide();
					//$('.val').hide();
					$('.val').fadeIn(400);	
					$('.val[data-timeStmp="'+timeStmp+'"]').remove();					
				}
			});	
			
	}
</script>

<select name="takeLoc" id="ipLocation">
	<option value="1">Питер</option>
	<option value="2">Питер - лахта (склад, мебель)</option>
	<option value="6">Екатеринбург - офис</option>
	<option value="8">Нижний Новгород - офис</option>
	<option value="11">Самара - офис</option>
</select>
<?$prefix_tbl = 'ip';?>
<style>
.table-tpl .<?=$prefix_tbl?>_ElementTbl-1{width:12%}
.table-tpl .<?=$prefix_tbl?>_ElementTbl-2{width:70%}
.table-tpl .<?=$prefix_tbl?>_ElementTbl-3{width:18%}
.table-tpl .<?=$prefix_tbl?>_ElementTbl-4{width:10%}
</style>
<div class="round-wrapper">
	<table class="table-tpl" border="1" bordercolor="#ccc">
		<thead>
			<tr>
				<th class="<?=$prefix_tbl?>_ElementTbl-1">IP</th>
				<th class="<?=$prefix_tbl?>_ElementTbl-2">User</th>
				<th class="<?=$prefix_tbl?>_ElementTbl-3">comp_name</th>
				<th class="<?=$prefix_tbl?>_ElementTbl-4">Действие</th>
			</tr>
		</thead>
		<tbody>
			<tr id="start-tr" style="opacity:0;">
				<td class="<?=$prefix_tbl?>_ElementTbl-1">111.111.1.111</td>
				<td class="<?=$prefix_tbl?>_ElementTbl-2">Aaaaaaaaa aaaaa</td> 				
				<td class="<?=$prefix_tbl?>_ElementTbl-3">Aaaaaaa</td>
				<td class="<?=$prefix_tbl?>_ElementTbl-4"><a class="btn-correct-tbl" href="javascript:void(0);"><i class="fa fa-wrench"></i></td>			
			</tr>
		</tbody>
	</table>
</div>
</html>
