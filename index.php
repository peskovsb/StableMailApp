<?session_start();
require_once 'ajax/db.php';
//--starting login module;
require 'ajax/login/login.php';
require 'ajax/secfile.php';
require 'itdept/stable/ajax/userlist/form_user/pref_comp.php';


$db = new DatabaseItDept();
$sql = 'SELECT * FROM levels ORDER BY level_id DESC';
		$tb = $db->connection->prepare($sql);
		$tb->execute();
		$arrLevels = $tb->fetchAll(PDO::FETCH_ASSOC);
		
		$lvls = array();
		foreach($arrLevels as $Items){
			$lvls[$Items['level_id']] = $Items['level_name'];
		}
		
// -- IT DEPT
//$sql = 'SELECT * FROM staff LEFT JOIN department ON staff.staff_depart_id = department.department_id WHERE staff_id = :staff_id';
$sql = 'SELECT * FROM staff LEFT JOIN department ON staff.staff_depart_id = department.department_id ORDER by staff_lastname ASC';
$tb = $db->connection->prepare($sql);
//$tb->execute(array(':staff_id'=>$arrLogin['con_user_id']));
$tb->execute();
$arrAll = $tb->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/fontawesome/css/font-awesome.css">
	<script src="js/jquery-1.11.2.min.js"></script><style type="text/css"></style>
	
	<!-- Fancy Box 2.1.5 -->
		<script type="text/javascript" src="js/fancybox/jquery.fancybox.js?v=2.1.5"></script>
		<link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox.css?v=2.1.5" media="screen">
		
	<!-- DatePicker -->
		<link rel="stylesheet" href="css/jquery-ui.css">
		<script type="text/javascript" src="js/jquery-ui.js"></script>
		<script type="text/javascript" src="js/local_ru_ui.js"></script>
		<script>
$(function(){
	$.datepicker.setDefaults(
		$.extend($.datepicker.regional["ru"])
	);
});		
		</script>
		
	<!-- Input MASK -->
	<script src="js/inputmask.js" type="text/javascript"></script>
	<script src="js/jquery.inputmask.js" type="text/javascript"></script>		
	<!-- Jquery Cookie -->		
		<script type="text/javascript" src="js/jquery.cookie.js"></script>
		
		<script>
			function OutUsers (data){
			levelArr = [];
			<?foreach($lvls as $keyLvl => $lvItems){?>
				levelArr[<?=$keyLvl?>] = '<?=$lvItems?>';
			<?}?>
			/*levelArr = [];
			levelArr[1] = 'admin';
			levelArr[2] = 'users';*/

				$.each( data, function( key, val ) {
					$('.startOutUsers').before('<li class="row-container-btu usridin'+val.user_id+'"> <div class="rowmainstl first-row-btu">'+val.user_id+'</div> <div class="rowmainstl second-row-btu">'+val.user_login+'</div> <div class="rowmainstl fourth-row-btu">'+levelArr[val.user_level]+'</div> <div class="rowmainstl fifth-row-btu">'+val.user_surname+' '+val.user_name+'</div> <div class="rowmainstl sixth-row-btu">  <a style="float:right" data-userid="'+val.user_id+'" class="del-iu"  href="javascript:void(0);"><i class="fa fa-trash-o"></i></a> <a style="float:right;margin-right: 7px;" data-userid="'+val.user_id+'" class="cor-iu" href="javascript:void(0);"><i class="fa fa-wrench"></i></a> <div style="clear:both"></div> </div> <div style="clear:both"></div> </li>');
				});
				
				UserLogs = $('#logsbtnlister').attr('data-userlogs');
				$('.usridin'+UserLogs).addClass('activeloguser');
				
			};	
			
			
			/*
			POSTS OUTP
			----------------------------------*/
			function OutPut (data){
			countr = 0;



			  $.each( data, function( key, val ) {
			  
			  if(val.active == 0){
				activOp = ' actOp';
			  }else{
				activOp = '';
			  }
			  
			  countr++;
			  if(val.user_id == MassDellIntems[val.user_id]){
					colozizer = 'style="background-color: rgb(255, 229, 229);"';
					checher = 'checked="checked"';
			  }else{
					colozizer = '';
					checher = '';
			  }
			  if(val.staff_id != '0'){
				  user_icon = '<i id="eyetracking" class="fa fa-user usericonmail"></i>';
			  }else{
				  user_icon = '';
			  }
			  
				$('<tr '+colozizer+' class="rowpoz_'+countr+' clearfix'+activOp+'" id="fildid_'+val.user_id+'"><td class="fist-point-id">'+val.user_id+'</td><td class="second-point-id">'+val.userdate+'</td><td class="third-point-id"><?if($userLevel['oper_correct_post']==1){?><a data-corr="'+val.user_id+'" class="m_link_from_log_corr" href="javascript:void(0);" style="color:#444;font-weight:bold;text-decoration:none;">'+val.login+'</a><?}else{?><span style="color:#444;font-weight:bold;text-decoration:none;">'+val.login+'</span><?}?></td><td class="fourth-point-id"><?if($_SESSION['user_level'] == '2'){?><a id="btnidcopy'+val.user_id+'" class="showhiddenpass" href="javascript:void(0);">Показать пароль</a><div onmouseout="moseGoneOut(\'passidcopy'+val.user_id+'\');" class="hiddentestletterPass" id="passidcopy'+val.user_id+'">'+val.password+'</div><?}?></td><td class="fifth-point-id">'+val.email+'</td><td class="sixes-point-id">'+val.name+'</td><td class="seventh-point-id">'+val.sername+'</td><td class="seventh_2-point-id" data-staffid="'+val.staff_id+'">'+user_icon+'</td><td class="btn-wrapper-correct"><?if($userLevel['oper_correct_post']==1){?><a data-corr="'+val.user_id+'" href="javascript:void(0);" class="m_CorrBtn" id="cor_list_'+val.user_id+'"><i class="fa fa-wrench"></i></a> <a data-dell="'+val.user_id+'" class="m_DelBtn" id="m_del_list_'+val.user_id+'" href="javascript:void(0);"><i class="fa fa-trash-o"></i></a></td><td class="last-ckbox-btn"><input '+checher+' value="'+val.user_id+'" data-massdel="'+val.user_id+'" class="m_MassDellCkBox" type="checkbox" name="m_ck_list_'+val.user_id+'"><?}?></td></tr>').insertAfter('#start-list');
			});	
			if(countr<1){
				$('<tr><td colspan="9"><p id="pagistoper" class="hidepagi"><b>Заблокированных пользователей нет</b></p></td></tr>').insertAfter('#start-list');
			}
			
		}	

		/*
		search OUTP
		----------------------------------*/

			$(document).on('submit','#searchform',function(){

				SearchType = $('#type-search-main').val();
				
				if(SearchType == '1'){
					methodSearch = 'login';
				}	
				if(SearchType == '2'){
					methodSearch = 'email';
				}
				if(SearchType == '3'){
					methodSearch = 'name';
				}
				if(SearchType == '4'){
					methodSearch = 'sername';
				}
				
				
				if($('#q-searchmain').val().length>0){
				
				
				
				$('#tbl-box-container').hide();
				$('.pagenation-wrapper').hide();
				ClearStart();
			//alert(methodSearch);
			if($('.tbbtab2').hasClass('activeShowElPage')){

				$.getJSON( "ajax/ajax_list_search.php",{blocked:'1', methodSearch: methodSearch,  searchword:$('#q-searchmain').val()}, function( data ) {
					 $.each( data, function( key, val ) {
					 
						  if(val.active == 0){
							activOp = ' actOp';
						  }else{
							activOp = '';
						  }					 
						  if(val.staff_id != '0'){
							  user_icon = '<i id="eyetracking" class="fa fa-user usericonmail"></i>';
						  }else{
							  user_icon = '';
						  } 
					 
					 if(val.mistake = 'mistake'){
							$('<tr '+colozizer+' class="rowpoz_'+countr+' clearfix'+activOp+'" id="fildid_'+val.user_id+'"><td class="fist-point-id">'+val.user_id+'</td><td class="second-point-id">'+val.userdate+'</td><td class="third-point-id"><?if($userLevel['oper_correct_post']==1){?><a data-corr="'+val.user_id+'" class="m_link_from_log_corr" href="javascript:void(0);" style="color:#444;font-weight:bold;text-decoration:none;">'+val.login+'</a><?}else{?><span style="color:#444;font-weight:bold;text-decoration:none;">'+val.login+'</span><?}?></td><td class="fourth-point-id"><?if($_SESSION['user_level'] == '2'){?><a id="btnidcopy'+val.user_id+'" class="showhiddenpass" href="javascript:void(0);">Показать пароль</a><div onmouseout="moseGoneOut(\'passidcopy'+val.user_id+'\');" class="hiddentestletterPass" id="passidcopy'+val.user_id+'">'+val.password+'</div><?}?></td><td class="fifth-point-id">'+val.email+'</td><td class="sixes-point-id">'+val.name+'</td><td class="seventh-point-id">'+val.sername+'</td><td class="seventh_2-point-id" data-staffid="'+val.staff_id+'">'+user_icon+'</td><td class="btn-wrapper-correct"><?if($userLevel['oper_correct_post']==1){?><a data-corr="'+val.user_id+'" href="javascript:void(0);" class="m_CorrBtn" id="cor_list_'+val.user_id+'"><i class="fa fa-wrench"></i></a> <a data-dell="'+val.user_id+'" class="m_DelBtn" id="m_del_list_'+val.user_id+'" href="javascript:void(0);"><i class="fa fa-trash-o"></i></a></td><td class="last-ckbox-btn"><input '+checher+' value="'+val.user_id+'" data-massdel="'+val.user_id+'" class="m_MassDellCkBox" type="checkbox" name="m_ck_list_'+val.user_id+'"><?}?></td></tr>').insertAfter('#start-list');
					}	
					if(val.mistake != 'mistake'){
						$('#tbl-box-container').html('<p><b>Такого пользователя здесь не найдено!</b></p>');
					}	
					 });
				});
			}else if($('.tbbtabl0').hasClass('activeShowElPage')){
				$.getJSON( "ajax/ajax_list_search.php",{active:'1', methodSearch: methodSearch,  searchword:$('#q-searchmain').val()}, function( data ) {
					 $.each( data, function( key, val ) {
					 
						  if(val.active == 0){
							activOp = ' actOp';
						  }else{
							activOp = '';
						  }							 
						  if(val.staff_id != '0'){
							  user_icon = '<i id="eyetracking" class="fa fa-user usericonmail"></i>';
						  }else{
							  user_icon = '';
						  } 
					 
					 if(val.mistake = 'mistake'){
							$('<tr '+colozizer+' class="rowpoz_'+countr+' clearfix'+activOp+'" id="fildid_'+val.user_id+'"><td class="fist-point-id">'+val.user_id+'</td><td class="second-point-id">'+val.userdate+'</td><td class="third-point-id"><?if($userLevel['oper_correct_post']==1){?><a data-corr="'+val.user_id+'" class="m_link_from_log_corr" href="javascript:void(0);" style="color:#444;font-weight:bold;text-decoration:none;">'+val.login+'</a><?}else{?><span style="color:#444;font-weight:bold;text-decoration:none;">'+val.login+'</span><?}?></td><td class="fourth-point-id"><?if($_SESSION['user_level'] == '2'){?><a id="btnidcopy'+val.user_id+'" class="showhiddenpass" href="javascript:void(0);">Показать пароль</a><div onmouseout="moseGoneOut(\'passidcopy'+val.user_id+'\');" class="hiddentestletterPass" id="passidcopy'+val.user_id+'">'+val.password+'</div><?}?></td><td class="fifth-point-id">'+val.email+'</td><td class="sixes-point-id">'+val.name+'</td><td class="seventh-point-id">'+val.sername+'</td><td class="seventh_2-point-id" data-staffid="'+val.staff_id+'">'+user_icon+'</td><td class="btn-wrapper-correct"><?if($userLevel['oper_correct_post']==1){?><a data-corr="'+val.user_id+'" href="javascript:void(0);" class="m_CorrBtn" id="cor_list_'+val.user_id+'"><i class="fa fa-wrench"></i></a> <a data-dell="'+val.user_id+'" class="m_DelBtn" id="m_del_list_'+val.user_id+'" href="javascript:void(0);"><i class="fa fa-trash-o"></i></a></td><td class="last-ckbox-btn"><input '+checher+' value="'+val.user_id+'" data-massdel="'+val.user_id+'" class="m_MassDellCkBox" type="checkbox" name="m_ck_list_'+val.user_id+'"><?}?></td></tr>').insertAfter('#start-list');
					}	
					if(val.mistake != 'mistake'){
						$('#tbl-box-container').html('<p><b>Такого пользователя здесь не найдено!</b></p>');
					}	
					 });
				});

				
			}else{
										
				$.getJSON( "ajax/ajax_list_search.php",{ methodSearch: methodSearch,  searchword:$('#q-searchmain').val()}, function( data ) {
					 $.each( data, function( key, val ) {
					 
						  if(val.active == 0){
							activOp = ' actOp';
						  }else{
							activOp = '';
						  }		 					 
						  if(val.staff_id != '0'){
							  user_icon = '<i id="eyetracking" class="fa fa-user usericonmail"></i>';
						  }else{
							  user_icon = '';
						  }
					 
					 if(val.mistake = 'mistake'){
							$('<tr '+colozizer+' class="rowpoz_'+countr+' clearfix'+activOp+'" id="fildid_'+val.user_id+'"><td class="fist-point-id">'+val.user_id+'</td><td class="second-point-id">'+val.userdate+'</td><td class="third-point-id"><?if($userLevel['oper_correct_post']==1){?><a data-corr="'+val.user_id+'" class="m_link_from_log_corr" href="javascript:void(0);" style="color:#444;font-weight:bold;text-decoration:none;">'+val.login+'</a><?}else{?><span style="color:#444;font-weight:bold;text-decoration:none;">'+val.login+'</span><?}?></td><td class="fourth-point-id"><?if($_SESSION['user_level'] == '2'){?><a id="btnidcopy'+val.user_id+'" class="showhiddenpass" href="javascript:void(0);">Показать пароль</a><div onmouseout="moseGoneOut(\'passidcopy'+val.user_id+'\');" class="hiddentestletterPass" id="passidcopy'+val.user_id+'">'+val.password+'</div><?}?></td><td class="fifth-point-id">'+val.email+'</td><td class="sixes-point-id">'+val.name+'</td><td class="seventh-point-id">'+val.sername+'</td><td class="seventh_2-point-id" data-staffid="'+val.staff_id+'">'+user_icon+'</td><td class="btn-wrapper-correct"><?if($userLevel['oper_correct_post']==1){?><a data-corr="'+val.user_id+'" href="javascript:void(0);" class="m_CorrBtn" id="cor_list_'+val.user_id+'"><i class="fa fa-wrench"></i></a> <a data-dell="'+val.user_id+'" class="m_DelBtn" id="m_del_list_'+val.user_id+'" href="javascript:void(0);"><i class="fa fa-trash-o"></i></a></td><td class="last-ckbox-btn"><input '+checher+' value="'+val.user_id+'" data-massdel="'+val.user_id+'" class="m_MassDellCkBox" type="checkbox" name="m_ck_list_'+val.user_id+'"><?}?></td></tr>').insertAfter('#start-list');
					}	
					if(val.mistake != 'mistake'){
						$('#tbl-box-container').html('<p><b>Такого пользователя здесь не найдено!</b></p>');
					}	
					 });
				});
										
			}	
					
				setTimeout(function(){ $('#tbl-box-container').fadeIn(600); }, 100);	
				
				}else{
						ClearStart();

			if($('.tbbtab2').hasClass('activeShowElPage')){
						$.getJSON( "ajax/ajax_list_mainpage.php",{blocked:'1'}, function( data ) {

						 
						  OutPut (data)
						});	
			}else if($('.tbbtabl0').hasClass('activeShowElPage')){			
						$.getJSON( "ajax/ajax_list_mainpage.php",{active:'1'}, function( data ) {
						  OutPut (data)
						});				
			}else{
						$.getJSON( "ajax/ajax_list_mainpage.php", function( data ) {

						 
						  OutPut (data)
						});	
			}
						
					setTimeout(function(){ $('#tbl-box-container').fadeIn(600);$('.pagenation-wrapper').fadeIn(600); }, 100);
				}
				//alert($('#q-searchmain').val());
				return false;
			});		


			/*search KEYUP
			----------------------------------*/
			
			$(document).on('keyup','#q-searchmain',function(){
				$('#tbl-box-container').html($(this).val());

				SearchType = $('#type-search-main').val();
				console.log(SearchType);
				
				if(SearchType == '1'){
					methodSearch = 'login';
				}	
				if(SearchType == '2'){
					methodSearch = 'email';
				}
				if(SearchType == '3'){
					methodSearch = 'name';
				}
				if(SearchType == '4'){
					methodSearch = 'sername';
				}
				
				//------
				
				$('#tbl-box-container').hide();
				$('.pagenation-wrapper').hide();
				ClearStart();
				

				
				if($('#q-searchmain').val().length>0){

			if($('.tbbtab2').hasClass('activeShowElPage')){

				$.getJSON( "ajax/ajax_list_search.php",{blocked:'1', methodSearch: methodSearch,  searchword:$('#q-searchmain').val()}, function( data ) {
					 $.each( data, function( key, val ) {
					 
						  if(val.active == 0){
							activOp = ' actOp';
						  }else{
							activOp = '';
						  }			 					 
						  if(val.staff_id != '0'){
							  user_icon = '<i id="eyetracking" class="fa fa-user usericonmail"></i>';
						  }else{
							  user_icon = '';
						  }	 
					 
					 if(val.mistake = 'mistake'){
							$('<tr '+colozizer+' class="rowpoz_'+countr+' clearfix'+activOp+'" id="fildid_'+val.user_id+'"><td class="fist-point-id">'+val.user_id+'</td><td class="second-point-id">'+val.userdate+'</td><td class="third-point-id"><?if($userLevel['oper_correct_post']==1){?><a data-corr="'+val.user_id+'" class="m_link_from_log_corr" href="javascript:void(0);" style="color:#444;font-weight:bold;text-decoration:none;">'+val.login+'</a><?}else{?><span style="color:#444;font-weight:bold;text-decoration:none;">'+val.login+'</span><?}?></td><td class="fourth-point-id"><?if($_SESSION['user_level'] == '2'){?><a id="btnidcopy'+val.user_id+'" class="showhiddenpass" href="javascript:void(0);">Показать пароль</a><div onmouseout="moseGoneOut(\'passidcopy'+val.user_id+'\');" class="hiddentestletterPass" id="passidcopy'+val.user_id+'">'+val.password+'</div><?}?></td><td class="fifth-point-id">'+val.email+'</td><td class="sixes-point-id">'+val.name+'</td><td class="seventh-point-id">'+val.sername+'</td><td class="seventh_2-point-id" data-staffid="'+val.staff_id+'">'+user_icon+'</td><td class="btn-wrapper-correct"><?if($userLevel['oper_correct_post']==1){?><a data-corr="'+val.user_id+'" href="javascript:void(0);" class="m_CorrBtn" id="cor_list_'+val.user_id+'"><i class="fa fa-wrench"></i></a> <a data-dell="'+val.user_id+'" class="m_DelBtn" id="m_del_list_'+val.user_id+'" href="javascript:void(0);"><i class="fa fa-trash-o"></i></a></td><td class="last-ckbox-btn"><input '+checher+' value="'+val.user_id+'" data-massdel="'+val.user_id+'" class="m_MassDellCkBox" type="checkbox" name="m_ck_list_'+val.user_id+'"><?}?></td></tr>').insertAfter('#start-list');
					}	
					if(val.mistake != 'mistake'){
						$('#tbl-box-container').html('<p><b>Такого пользователя здесь не найдено!</b></p>');
					}	
					 });
				});
			}else if($('.tbbtabl0').hasClass('activeShowElPage')){
				$.getJSON( "ajax/ajax_list_search.php",{active:'1', methodSearch: methodSearch,  searchword:$('#q-searchmain').val()}, function( data ) {
					 $.each( data, function( key, val ) {
					 
						  if(val.active == 0){
							activOp = ' actOp';
						  }else{
							activOp = '';
						  }			 					 
						  if(val.staff_id != '0'){
							  user_icon = '<i id="eyetracking" class="fa fa-user usericonmail"></i>';
						  }else{
							  user_icon = '';
						  }	 
					 
					 if(val.mistake = 'mistake'){
							$('<tr '+colozizer+' class="rowpoz_'+countr+' clearfix'+activOp+'" id="fildid_'+val.user_id+'"><td class="fist-point-id">'+val.user_id+'</td><td class="second-point-id">'+val.userdate+'</td><td class="third-point-id"><?if($userLevel['oper_correct_post']==1){?><a data-corr="'+val.user_id+'" class="m_link_from_log_corr" href="javascript:void(0);" style="color:#444;font-weight:bold;text-decoration:none;">'+val.login+'</a><?}else{?><span style="color:#444;font-weight:bold;text-decoration:none;">'+val.login+'</span><?}?></td><td class="fourth-point-id"><?if($_SESSION['user_level'] == '2'){?><a id="btnidcopy'+val.user_id+'" class="showhiddenpass" href="javascript:void(0);">Показать пароль</a><div onmouseout="moseGoneOut(\'passidcopy'+val.user_id+'\');" class="hiddentestletterPass" id="passidcopy'+val.user_id+'">'+val.password+'</div><?}?></td><td class="fifth-point-id">'+val.email+'</td><td class="sixes-point-id">'+val.name+'</td><td class="seventh-point-id">'+val.sername+'</td><td class="seventh_2-point-id" data-staffid="'+val.staff_id+'">'+user_icon+'</td><td class="btn-wrapper-correct"><?if($userLevel['oper_correct_post']==1){?><a data-corr="'+val.user_id+'" href="javascript:void(0);" class="m_CorrBtn" id="cor_list_'+val.user_id+'"><i class="fa fa-wrench"></i></a> <a data-dell="'+val.user_id+'" class="m_DelBtn" id="m_del_list_'+val.user_id+'" href="javascript:void(0);"><i class="fa fa-trash-o"></i></a></td><td class="last-ckbox-btn"><input '+checher+' value="'+val.user_id+'" data-massdel="'+val.user_id+'" class="m_MassDellCkBox" type="checkbox" name="m_ck_list_'+val.user_id+'"><?}?></td></tr>').insertAfter('#start-list');
					}	
					if(val.mistake != 'mistake'){
						$('#tbl-box-container').html('<p><b>Такого пользователя здесь не найдено!</b></p>');
					}	
					 });
				});
				
			}else{
										
				$.getJSON( "ajax/ajax_list_search.php",{ methodSearch: methodSearch,  searchword:$('#q-searchmain').val()}, function( data ) {
					 $.each( data, function( key, val ) {
					 
						  if(val.active == 0){
							activOp = ' actOp';
						  }else{
							activOp = '';
						  }				 					 
						  if(val.staff_id != '0'){
							  user_icon = '<i id="eyetracking" class="fa fa-user usericonmail"></i>';
						  }else{
							  user_icon = '';
						  } 
					 
					 if(val.mistake = 'mistake'){
							$('<tr '+colozizer+' class="rowpoz_'+countr+' clearfix'+activOp+'" id="fildid_'+val.user_id+'"><td class="fist-point-id">'+val.user_id+'</td><td class="second-point-id">'+val.userdate+'</td><td class="third-point-id"><?if($userLevel['oper_correct_post']==1){?><a data-corr="'+val.user_id+'" class="m_link_from_log_corr" href="javascript:void(0);" style="color:#444;font-weight:bold;text-decoration:none;">'+val.login+'</a><?}else{?><span style="color:#444;font-weight:bold;text-decoration:none;">'+val.login+'</span><?}?></td><td class="fourth-point-id"><?if($_SESSION['user_level'] == '2'){?><a id="btnidcopy'+val.user_id+'" class="showhiddenpass" href="javascript:void(0);">Показать пароль</a><div onmouseout="moseGoneOut(\'passidcopy'+val.user_id+'\');" class="hiddentestletterPass" id="passidcopy'+val.user_id+'">'+val.password+'</div><?}?></td><td class="fifth-point-id">'+val.email+'</td><td class="sixes-point-id">'+val.name+'</td><td class="seventh-point-id">'+val.sername+'</td><td class="seventh_2-point-id" data-staffid="'+val.staff_id+'">'+user_icon+'</td><td class="btn-wrapper-correct"><?if($userLevel['oper_correct_post']==1){?><a data-corr="'+val.user_id+'" href="javascript:void(0);" class="m_CorrBtn" id="cor_list_'+val.user_id+'"><i class="fa fa-wrench"></i></a> <a data-dell="'+val.user_id+'" class="m_DelBtn" id="m_del_list_'+val.user_id+'" href="javascript:void(0);"><i class="fa fa-trash-o"></i></a></td><td class="last-ckbox-btn"><input '+checher+' value="'+val.user_id+'" data-massdel="'+val.user_id+'" class="m_MassDellCkBox" type="checkbox" name="m_ck_list_'+val.user_id+'"><?}?></td></tr>').insertAfter('#start-list');
					}	
					if(val.mistake != 'mistake'){
						$('#tbl-box-container').html('<p><b>Такого пользователя здесь не найдено!</b></p>');
					}	
					 });
				});
										
			}	
				

				$('#tbl-box-container').fadeIn(100);
				
				}else{
						ClearStart();
			if($('.tbbtab2').hasClass('activeShowElPage')){
						$.getJSON( "ajax/ajax_list_mainpage.php",{blocked:'1'}, function( data ) {

						 
						  OutPut (data)
						});	
			}else if($('.tbbtabl0').hasClass('activeShowElPage')){			
						$.getJSON( "ajax/ajax_list_mainpage.php",{active:'1'}, function( data ) {
						  OutPut (data)
						});				
			}else{
						$.getJSON( "ajax/ajax_list_mainpage.php", function( data ) {

						 
						  OutPut (data)
						});	
			}

						
						setTimeout(function(){ $('#tbl-box-container').fadeIn(600);
							if($('#pagistoper').hasClass('hidepagi')){
								$('.pagenation-wrapper').hide();
							}else{
								$('.pagenation-wrapper').fadeIn(600);
							}
						}, 100);
				}
				
			});				

			
			/*OUTPUT ALIAS
			----------------------------------*/

			function OutPutAlias (data){
			countr = 0;
						  $.each( data, function( key, val ) {
						  countr++;
						  if(val.alias_id == MassDellIntems[val.alias_id]){
								colozizer = 'style="background-color: rgb(255, 229, 229);"';
								checher = 'checked="checked"';
						  }else{
								colozizer = '';
								checher = '';
						  }
						  if(val.active=="1"){
							  autoreply_active = '<i style="  font-size: 14px; color: #009999; line-height: 29px;" class="fa fa-exchange"></i>';
						  }else{
							  autoreply_active = '';
						  }
						  
			$('<tr '+colozizer+' class="rowpoz_'+countr+' clearfix" id="fildid_'+countr+'"><td class="fist-alias-point-id">'+val.alias_id+'</td><td class="second-alias-point-id">'+val.aliasdatefrom+'</td> 	<td class="second-2-alias-point-id">'+val.aliasdateto+'</td><td class="third-alias-point-id"><a data-corr="'+val.alias_id+'" class="a_link_from_log_corr" href="javascript:void(0);" style="color:#444;font-weight:bold;text-decoration:none;">'+val.username+'</a></td> 	<td class="fourth-alias-point-id">'+val.alias+'</td> <td class="fourth_2-alias-point-id"> '+autoreply_active+' </td>	<td class="btn-wrapper-correct"><?if($userLevel['oper_correct_forw']==1){?><a data-corr="'+val.alias_id+'" href="javascript:void(0);" class="a_CorrBtn" id="cor_list_'+val.alias_id+'"><i class="fa fa-wrench"></i></a> <a data-dell="'+val.alias_id+'" class="a_DelBtn" id="a_del_list_'+val.alias_id+'" href="javascript:void(0);"><i class="fa fa-trash-o"></i></a></td><td class="last-ckbox-btn"><input '+checher+' value="'+val.alias_id+'" data-massdel="'+val.alias_id+'" class="a_MassDellCkBox" type="checkbox" name="a_ck_list_'+val.alias_id+'"><?}?></td> </tr>').insertAfter('#start-list-alias');
						  });
			}
			
			/*SEARCH KEYUP ALIAS
			-------------------------------------------*/
				$(document).on('keyup','#q-searchmainAlias',function(){

					SearchType = $('#type-search-mainAlias').val();
					console.log(SearchType);
					
					if(SearchType == '1'){
						methodSearch = 'username';
					}	
					if(SearchType == '2'){
						methodSearch = 'alias';
					}
					
					//------
					
					$('#tbl-box-alias-container').hide();
					$('.pagenation-wrapperAlias').hide();
					ClearStartAlias();
					

					
					if($('#q-searchmainAlias').val().length>0){
					
					$.getJSON( "ajax/ajax_list_search_alias.php",{ methodSearch: methodSearch,  searchword:$('#q-searchmainAlias').val()}, function( data ) {
						 $.each( data, function( key, val ) {
						 if(val.mistake = 'mistake'){
							 
								  if(val.active=="1"){
									  autoreply_active = '<i style="  font-size: 14px; color: #009999; line-height: 29px;" class="fa fa-exchange"></i>';
								  }else{
									  autoreply_active = '';
								  }
							$('<tr '+colozizer+' class="rowpoz_'+countr+' clearfix" id="fildid_'+countr+'"><td class="fist-alias-point-id">'+val.alias_id+'</td><td class="second-alias-point-id">'+val.aliasdatefrom+'</td> 	<td class="second-2-alias-point-id">'+val.aliasdateto+'</td><td class="third-alias-point-id"><a data-corr="'+val.alias_id+'" class="a_link_from_log_corr" href="javascript:void(0);" style="color:#444;font-weight:bold;text-decoration:none;">'+val.username+'</a></td> 	<td class="fourth-alias-point-id">'+val.alias+'</td> <td class="fourth_2-alias-point-id"> '+autoreply_active+' </td>	<td class="btn-wrapper-correct"><?if($userLevel['oper_correct_forw']==1){?><a data-corr="'+val.alias_id+'" href="javascript:void(0);" class="a_CorrBtn" id="cor_list_'+val.alias_id+'"><i class="fa fa-wrench"></i></a> <a data-dell="'+val.alias_id+'" class="a_DelBtn" id="a_del_list_'+val.alias_id+'" href="javascript:void(0);"><i class="fa fa-trash-o"></i></a></td><td class="last-ckbox-btn"><input '+checher+' value="'+val.alias_id+'" data-massdel="'+val.alias_id+'" class="a_MassDellCkBox" type="checkbox" name="a_ck_list_'+val.alias_id+'"><?}?></td> </tr>').insertAfter('#start-list-alias');
						}	
						if(val.mistake != 'mistake'){
							$('#tbl-box-alias-container').html('<p><b>Такого пользователя здесь не найдено!</b></p>');
						}	
						 });
					});
					$('#tbl-box-alias-container').fadeIn(100);
					
					}else{
							ClearStartAlias();

							$.getJSON( "ajax/ajax_list_mainpage_alias.php", function( data ) {

							 
							  OutPutAlias (data)
							});	
							
						setTimeout(function(){ $('#tbl-box-alias-container').fadeIn(600);$('.pagenation-wrapperAlias').fadeIn(600); }, 100);
					}
					
				});	

				
				/*SUBM ALIAS SEARCH
				-------------------------------------------*/


					$(document).on('submit','#searchformAlias',function(){

						SearchType = $('#type-search-mainAlias').val();
						console.log(SearchType);
						
						if(SearchType == '1'){
							methodSearch = 'username';
						}	
						if(SearchType == '2'){
							methodSearch = 'alias';
						}
						
						//------
						
						$('#tbl-box-alias-container').hide();
						$('.pagenation-wrapperAlias').hide();
						ClearStartAlias();
						

						
						if($('#q-searchmainAlias').val().length>0){
						
						$.getJSON( "ajax/ajax_list_search_alias.php",{ methodSearch: methodSearch,  searchword:$('#q-searchmainAlias').val()}, function( data ) {
							 $.each( data, function( key, val ) {
							 if(val.mistake = 'mistake'){
								  if(val.active=="1"){
									  autoreply_active = '<i style="  font-size: 14px; color: #009999; line-height: 29px;" class="fa fa-exchange"></i>';
								  }else{
									  autoreply_active = '';
								  }
							$('<tr '+colozizer+' class="rowpoz_'+countr+' clearfix" id="fildid_'+countr+'"><td class="fist-alias-point-id">'+val.alias_id+'</td><td class="second-alias-point-id">'+val.aliasdatefrom+'</td> 	<td class="second-2-alias-point-id">'+val.aliasdateto+'</td><td class="third-alias-point-id"><a data-corr="'+val.alias_id+'" class="a_link_from_log_corr" href="javascript:void(0);" style="color:#444;font-weight:bold;text-decoration:none;">'+val.username+'</a></td> 	<td class="fourth-alias-point-id">'+val.alias+'</td> <td class="fourth_2-alias-point-id"> '+autoreply_active+' </td>	<td class="btn-wrapper-correct"><?if($userLevel['oper_correct_forw']==1){?><a data-corr="'+val.alias_id+'" href="javascript:void(0);" class="a_CorrBtn" id="cor_list_'+val.alias_id+'"><i class="fa fa-wrench"></i></a> <a data-dell="'+val.alias_id+'" class="a_DelBtn" id="a_del_list_'+val.alias_id+'" href="javascript:void(0);"><i class="fa fa-trash-o"></i></a></td><td class="last-ckbox-btn"><input '+checher+' value="'+val.alias_id+'" data-massdel="'+val.alias_id+'" class="a_MassDellCkBox" type="checkbox" name="a_ck_list_'+val.alias_id+'"><?}?></td> </tr>').insertAfter('#start-list-alias');
							}	
							if(val.mistake != 'mistake'){
								$('#tbl-box-alias-container').html('<p><b>Такого пользователя здесь не найдено!</b></p>');
							}	
							 });
						});
						$('#tbl-box-alias-container').fadeIn(100);
						
						}else{
								ClearStartAlias();

								$.getJSON( "ajax/ajax_list_mainpage_alias.php", function( data ) {

								 
								  OutPutAlias (data)
								});	
								
							setTimeout(function(){ $('#tbl-box-alias-container').fadeIn(600);$('.pagenation-wrapperAlias').fadeIn(600); }, 100);
						}
						return false;
					});					

			
		</script>
	

		<!-- JS MainScript-->
		<script src="js/mainscript.js"></script>
		<!-- JS Costomize-->
		<script type="text/javascript" src="ajax/cusotomize/customize.js"></script>
		
		<script>
			/*
			Staff ZONE
			------------------------------------*/

			prefixForm = 'staff_';

			$(document).on('click','#'+prefixForm+'createuser',function(){
				$.fancybox({
					//maxWidth    : 713,
						minHeight   : 250,
						fitToView   : false,
						autoSize    : true,
						autoScale   : true,
						openEffect  : 'none',
						openSpeed : 1,			
						closeEffect : 'none',
						scrolling   : false,
						padding     : 0,
						helpers : {
							overlay : {
								closeClick : false
							}
						},
					href: 'itdept/stable/ajax/userlist/form_user/form_builder.php',
					type: 'ajax'
				});	
			});


			$(document).on('click','#'+prefixForm+'createuser_from_it',function(){
				$.fancybox({
					//maxWidth    : 713,
						minHeight   : 250,
						fitToView   : false,
						autoSize    : true,
						autoScale   : true,
						openEffect  : 'none',
						openSpeed : 1,			
						closeEffect : 'none',
						scrolling   : false,
						padding     : 0,
						helpers : {
							overlay : {
								closeClick : false
							}
						},
					href: 'itdept/stable/ajax/userlist/form_user_it/form_builder.php',
					type: 'ajax'
				});	
			});
			
			
			$(document).on('click','#'+prefixForm+'clearform',function(){
				$.fancybox({ closeClick  : true});
				setTimeout(function(){
				$.fancybox({
					//maxWidth    : 713,
						minHeight   : 250,
						fitToView   : false,
						autoSize    : true,
						autoScale   : true,
						openEffect  : 'none',
						openSpeed : 1,			
						closeEffect : 'none',
						scrolling   : false,
						padding     : 0,
					href: 'itdept/stable/ajax/userlist/form_user/form_builder.php',
					type: 'ajax'
				});		
				},300);

			});
				$(document).on('click','#it_clearform',function(){
					$.fancybox({ closeClick  : true});
					setTimeout(function(){
					$.fancybox({
						//maxWidth    : 713,
							minHeight   : 250,
							fitToView   : false,
							autoSize    : true,
							autoScale   : true,
							openEffect  : 'none',
							openSpeed : 1,			
							closeEffect : 'none',
							scrolling   : false,
							padding     : 0,
						href: 'itdept/stable/ajax/userlist/form_user_it/form_builder.php',
						type: 'ajax'
					});		
					},300);

				});	
				
				
				
				/* DRAWING TABLE func
				-------------------------------------------*/
				function drawTable (folder,page,search,loc){
				timeStmp = $('#first-row-drawing').attr('data-timeStmp');
				
					$.ajax({
						dataType: "HTML",
						data: {page: page,loc: loc},
						type: "POST",
						url : "ajax/documents/"+folder+"/ajax/ajax_list.php",
							success : function (data) {
								//-- HTML data
								$('#start-tr').after(data).hide();
								//$('.val').hide();
								$('.val').fadeIn(800);	
								$('.val[data-timeStmp="'+timeStmp+'"]').remove();					
							}
						});	
						
				}				
				
				
		</script>
		<?require 'itdept/stable/ajax/userlist/form_user/outandpagi.php';?>
		<?
		//-- UserFields
		require 'itdept/stable/ajax/userlist/form_user/arrFields.php';
		require 'itdept/stable/ajax/userlist/form_user/scriptField.php';
		?>

		<?
		//-- UserFields
		require 'itdept/stable/ajax/userlist/form_user_it/arrFields.php';
		require 'itdept/stable/ajax/userlist/form_user_it/scriptField.php';
		?>

		<?
		//-- department
		require 'ajax/company/form_department/arrFields.php';
		require 'ajax/company/form_department/scriptField.php';
		?>
		<?
		//-- company
		require 'ajax/company/form_location/arrFields.php';
		require 'ajax/company/form_location/scriptField.php';
		?>
		<?
		//-- company
		require 'ajax/company/form_grps/arrFields.php';
		require 'ajax/company/form_grps/scriptField.php';
		?>
		
		<?if($userLevel['oper_correct_post']==0){?>
			<style>
				.fourth-point-id{display:none!important;}
				.seventh-point-id + th{display:none!important;}
				.btn-wrapper-correct{display:none!important;}
				.table-boxmails{width: 1035px; overflow: hidden;}
				.tbl-box-container{width: 1035px; overflow: hidden;}
			</style>
		<?}?>
		<script>
			$(document).ready(function(){
				//---- LIST MAIN ---------------------------------
			<?if($userLevel['oper_view_staff']==1){?>
				$('#innercontainerIU').hide();
				$('.pagenation-wrapper-IU').hide();
				$('.staff_pagenation-wrapper').hide();
				
				$('.link-hidden-IU').hide();
				$('.link-hidden-IU-logs').hide();
				$('#maiApplication').css({'padding':'0px'});
				$('#maiApplication').css({'padding-bottom':'50px'});
				//$('#maiApplication').css({'height':'initial'});
				$('html').css({'min-height':'100%'});
				$('body').css({'min-height':'100%'});
				up();
					$('.post-server a').removeClass('activeMenu');
					//$('.nav-menu-top li a').removeClass('activeMenu');
					$(this).addClass('activeMenu');
					$('.datacont').hide();
					//$('.ajaxcont').html('');
					$('.ajaxcont').show();
					
					$('.root-icon-iu-sidebarmenu,.IU-brance-link').removeClass('IU-active');
					$('.IU-loging-btn').addClass('IU-active');		
					//$('html').css({'overflow-y':'scroll'});		
					$('#staff_table').hide();	
					//$('.ajaxcont').html('<img src="loading_dark_large.gif" style="margin:50px auto 0;display:block;">');
						//setTimeout(function(){
							$.ajax({
							  url: "itdept/stable/ajax/userlist/show.php",
							  success: function(data){
								valChange = $('.'+prefix+'sel-page-wrap-opt').val();
								//$('.ajaxcont').hide();
								$('.ajaxcont').html(data);					
								//$('.ajaxcont').fadeIn(700);
								//$('#staff_table').html('123');
								OutBlocks('1',50,3,'','','','','');
								staffBuildPagi('3','','');
							  }
						});
						
					//},400);	
			<?}else if($userLevel['oper_view_post']==1){?>
				$('#tbl-box-container').hide();
				$('.pagenation-wrapper').hide();
				ClearStart();

					$.getJSON( "ajax/ajax_list_mainpage.php",{active:'1'}, function( data ) {
					  OutPut (data)
					});	
					
				setTimeout(function(){ $('#tbl-box-container').fadeIn(600);$('.pagenation-wrapper').fadeIn(600); }, 100);	
				BuildPaginNaviActive('30');			
			<?}else{?>

					$('#boxalias').show();
					$('#boxmails').hide();
		ClearStartAlias();
		$('#tbl-box-alias-container').hide();
		//alert('123');	
		//ClearStart();

			$.getJSON( "ajax/ajax_list_mainpage_alias.php", function( data ) {

			 
			  OutPutAlias (data)
			});	
			
		setTimeout(function(){ $('#tbl-box-alias-container').fadeIn(600);$('.pagenation-wrapperAlias').fadeIn(600); }, 100);
			<?}?>
			});		
		</script>
	
</head>
	<body onload="setFocus()">
	
<div id="topnav">
	<div class="vieport" style="margin-top:0; background:#000;">

		<?if(USER_LOGGED) {?>
				<div class="authmsg">
					<p>Добро пожаловать, <a href="javasctipt:void(0);"><?=$_SESSION['user_login']?></a> (<?=$logGroups[$_SESSION['user_level']]?>) <a href="?logout">Выйти</a></p>
				</div>
		<?}
		if($_SESSION['user_level'] == '2'){?>
			<div class="post-server">
				<a id="custsystem" href="javascript:void(0);"><i class="fa fa-cog"></i> Настройки системы</a>
				<!--<a href="javascript:void(0);"><i class="fa fa-envelope-o"></i> Почтовый сервер</a>-->
					<div style="clear:both"></div>
			</div>
		<?}?>		
		<ul class="nav-menu-top">
			<?if($userLevel['oper_view_staff']==1){?><li><a href="javascript:void(0);" id="BoxesCustBtn" class="activeMenu">Сотрудники</a></li><?}?>
			<li><a href="javascript:void(0);" id="BoxesFirstBtn">Почта</a></li>
			<!--<?if($userLevel['oper_view_post']==1){?><li><a href="javascript:void(0);" id="BoxesFirstBtn" class="activeMenu">Ящики</a></li><?}?>
			<?if($userLevel['oper_view_forw']==1){?><li><a href="javascript:void(0);" id="BoxesSecondBtn">Переадресация</a></li><?}?>-->
			<!--<li><a href="javascript:void(0);">Транспорт</a></li>-->
			<?if($_SESSION['user_level'] == '2'){?><li><a id="BoxesDocsBtn" href="javascript:void(0)">Документы</a></li><?}?>
			<div class="clearfox"></div>
		</ul>
	</div>
</div>	

	<div id="form-mail-reg">
		<div style="clearfox"></div>
		<div class="wrapper-form">
			
			<form id="MainForm" action="#" method="POST">
				<table>
					<tr>
					<td class="field-cover">
						<label for="field_email">E-mail</label>
					</td>
					<td>
						<input class="field-tpl" type="text" name="field_email" id="field_email" value="">
						@					
						<!--<select name="diff-mails" class="field-tpl select-list">
							<option value="1">bioline.ru</option>
							<option value="2">biomebel.ru</option>
							<option value="3">mail.ru</option>
							<option value="4">yandex.ru</option>
						</select>-->
						<select name="diff-mails" disabled class="super-fire-list select-list">
							<option selected value="1">bioline.ru</option>
							<option value="2">biomebel.ru</option>
							<option value="3">mail.ru</option>
							<option value="4">yandex.ru</option>
						</select>						
						
					</td>
				</tr>
				
					<!-- Devider Field -->
				
				<tr>					
					<td class="field-cover" style="vertical-align: top;padding-top: 15px;">
						<label for="field_password">Пароль</label>
					</td>
				<td style="position:relative;">
					<input class="field-tpl" type="text" name="field_password" id="field_password" value=""> <i id="normPass" style="color:#090;display:none;" class="fa fa-check"></i> <i id="badPass" style="color:#c11;display:none;" class="fa fa-times"></i><a class="genPass" onclick="$('#field_password').val(str_rand());" href="javascript:void(0);">Сгенерировать пароль</a> <span class="tooltip-pass">(пароль должен быть не менее 6 знаков и не должен содержать символов)</span>
					
				</td>
				</tr>

					<!-- Devider Field -->
				<tr>	
					<td class="field-cover">
						<label for="field_name" style="">Имя</label>
					</td>
					<td>
						<input class="field-tpl" type="text" name="field_name" id="field_name" value="">
						<select class="field-tpl" id="profile-create" name="profile-create" style="margin-left: 18px;  width: 185px;">
							<option value="0">-- Профиль --</option>
							<?foreach($arrAll as $Items){?>
								<option <?if($arrLogin['staff_id'] == $Items['staff_id']){?>selected<?}?> value="<?=$Items['staff_id']?>"><?=$Items['staff_lastname']?> <?=$Items['staff_name']?> <?=$arrAll['staff_secondname']?> (<?=$Items['staff_post']?> - <?=$pref_comp[$Items['staff_company_id']]?>)</option>
								
							<?}?>							
						</select>
					</td>
				</tr>
					<!-- Devider Field -->
				<tr>
					<td class="field-cover">
						<label for="field_Lname" style="">Фамилия</label>
					</td>
					<td>					
						<input class="field-tpl" type="text" name="field_Lname" id="field_Lname" value="">
					</td>
				</tr>
					<!-- Devider Field -->
				<tr>	
					<td class="field-cover">
						<label for="field_Tname" style="">Отправка тестового письма</label>
					</td>
					<td>					
						<input class="field-tpl" type="checkbox" name="field_Tname" id="field_Tname" value="1">
					</td>
				</tr>
					<!-- Devider Field -->
				<tr class="hiddentestletter">	
					<td class="field-cover">
						<label for="field_Theme">Тема:</label>
					</td>
					<td>					
						<input class="field-tpl" type="text" name="field_Theme" id="field_Theme" value="" style="width:385px">
					</td>
				</tr>
					<!-- Devider Field -->
				<tr class="hiddentestletter">	
					<td class="field-cover" style="vertical-align:top">
						<label for="field_TtextLetter">Текст:</label>
					</td>
					<td>					
						<textarea rows="10" class="field-tpl" name="field_TtextLetter" id="field_TtextLetter" style="width:385px"></textarea>
						<p class="text-doptext-zayvki"></p>
					</td>
				</tr>
					<!-- Devider Field -->
				<tr>
					<td class="field-cover lastfield">
						<input id="mainFormSender" class="submbtnstyle" type="submit" name="sendform" value="Сохранить" style="margin-top:10px;">
					</td>
					<td style="vertical-align: bottom;">
						<a onclick="clearAll();" class="clearfields btn-danger" style="margin-top:10px;">Очистить Форму</a>
					</td>
				</tr>
				</table>				
			</form>
		
		<!-- Mail Content Goes -->
			
		<div class="content-wrapper">
			<!-- Result Content -->
		</div>			
			
		</div>	
	</div>



<div style="clear:both"></div>
		
	
<div id="maiApplication">
	<!-- cusctomize -->
	<div class="ajaxcont"></div>

	<div class="vieport datacont" id="boxmails">
	<div class="menu-left-new-part"><a class="boxmailinner activeMenu" href="javascript:void(0)"><i style="  font-size: 16px;" class="fa fa-envelope"></i></a><?if($userLevel['oper_view_forw']==1){?><a class="aliasmlinner" href="javascript:void(0)"><i style="font-size:16px;" class="fa fa-exchange"></i></a><?}?></div>
	<!-- Search Form -->
		<form id="searchform" class="main-search-container" action="#" method="POST">
			<select id="type-search-main" name="mainsearch" style="padding: 8px 9px; margin-top: -1px; margin-left: 15px; border-right: 0; -webkit-border-radius: 4px 0px 0px 4px; -moz-border-radius: 4px 0px 0px 4px; border-radius: 4px 0px 0px 4px; margin-right: 0;">
				<option id="opt_1" value="1">Login</option>
				<option value="2">Email</option>
				<option value="3">Имя</option>
				<option value="4">Фамилия</option>
			</select>
			<input class="field-tpl" style="float:left;padding: 9px; margin-top: -1px; border-radius: 0px 4px 4px 0px; width: 385px; border-color: rgb(204, 204, 204);" type="text" name="q-searchmain" id="q-searchmain" value="" placeholder="Поиск">
			<span class="searchSubmit"  style="  margin-top: -1px; height: 36px;" onclick="$('#searchform').submit();"><span style="  margin-top: 6px;" class="searchicon"></span></span>
			<input type="submit" class="dspl_n">
				<div class="clearfox"></div>
		</form>			
				
		<?if($userLevel['oper_create_post']==1){?><a class="BtnAddMore btn green" href="#form-mail-reg">Добавить</a><?}?>
		<div class="show-el-page-wrapper">
			<select class="sel-page-wrap-opt" style="padding: 8px 9px;margin-top: -1px;margin-right: 15px;">
				<option id="ShowEl30">30</option>
				<option id="ShowEl50">50</option>
				<option id="ShowEl150">150</option>
				<option id="ShowEl300">300</option>
			</select>
			<!--<ul>
				<li><a onclick="ShowFunc('30');" id="ind30" class="show-el-page activeShowElPage" href="javascript:void(0);">30</a></li>
				<li><a onclick="ShowFunc('50');" id="ind50" class="show-el-page" href="javascript:void(0);">50</a></li>
				<li><a onclick="ShowFunc('150');" id="ind150" class="show-el-page" href="javascript:void(0);">150</a></li>
				<li><a onclick="ShowFunc('300');" id="ind300" class="show-el-page" href="javascript:void(0);">300</a></li>					    
			</ul>-->
		</div>
		<div class="tabs-all-blocked">
			<a class="tbbtabl0 activeShowElPage" style="text-decoration: none; color: #000; padding: 9px 7px; display: block;" href="javascript:void(0);">Активные</a><a style="text-decoration: none; color: #000; padding: 9px 7px; display: block;" class="tbbtab2" href="javascript:void(0);">Заблокированные</a><a style="text-decoration: none; color: #000; padding: 9px 7px; display: block;" class="tbbtabl1" href="javascript:void(0);">Все</a>
				<div style="clear:both"></div>
		</div>
			<div style="clear:both"></div>
			<div class="header-tbls" style="  -webkit-border-radius:  5px;   -moz-border-radius: 5px;  border-radius: 5px;  overflow: hidden;">
				<table class="table-boxmails">
						<tr><th class="fist-point-id"><a class="sortingfuncttbl ActiveColorZerSort" onclick="SortFunc('user_id','ASC');" id="SortID" href="javascript:void(0);">ID</a></th><th class="second-point-id"><a class="sortingfuncttbl" onclick="SortFunc('userdate','ASC');" id="SortDate" href="javascript:void(0);">Дата</a></th><th class="third-point-id"><a class="sortingfuncttbl" onclick="SortFunc('login','ASC');" id="SortLogin" href="javascript:void(0);">Login</a></th><th class="fourth-point-id">Pass</th><th class="fifth-point-id"><a class="sortingfuncttbl" onclick="SortFunc('email','ASC');" id="SortEmail" href="javascript:void(0);">Email</a></th><th class="sixes-point-id"><a class="sortingfuncttbl" onclick="SortFunc('name','ASC');" id="SortName" href="javascript:void(0);">Имя</a></th><th class="seventh-point-id"><a class="sortingfuncttbl" onclick="SortFunc('sername','ASC');" id="SortSername" href="javascript:void(0);">Фамилия</a></th><th class="seventh_2-point-id"><i class="fa fa-user"></i></th><th style="width: 80px;">Действие</th><th class="last-ckbox-btn"></th></tr>
					</table></div>
			<div id="tbl-box-container">	
				<!--<table class="table-boxmails">
					<tr id="start-list">
						<th><a onclick="SortFunc('user_id','DESC');" id="SortID" href="javascript:void(0);">ID</a></th>
						<th><a onclick="SortFunc('userdate','DESC');" id="SortDate" href="javascript:void(0);">дата</a></th>
						<th><a onclick="SortFunc('login','DESC');" id="SortLogin" href="javascript:void(0);">login</a></th>
						<th>pass</th>
						<th>email</th>
						<th>действие</th>
						<th></th>
					</tr>
				</table>-->
				<!-- Goes Table -->
			</div>
		<!-- Pagination -->
		<div class="pagenation-wrapper">
			<div class="header-pagi">Страницы:</div>
			<div class="placeforpagination">
				<ul>
					<li id="start-pagi-first"><a  onclick="PagiFunc('1');" class="pagi-block activePagi" href="javascript:void(0);">1</a></li>
				</ul>
					<div style="clear:both"></div>
			</div>
		</div>			
	</div>
	

	<div class="vieport datacont" id="boxalias" style="display:none">
	<div class="menu-left-new-part"><a class="boxmailinner" href="javascript:void(0)"><i style="  font-size: 16px;" class="fa fa-envelope"></i></a><?if($userLevel['oper_view_forw']==1){?><a class="aliasmlinner" href="javascript:void(0)"><i style="font-size:16px;" class="fa fa-exchange"></i></a><?}?></div>
		<form id="searchformAlias" class="main-search-container" action="#" method="POST">
			<select id="type-search-mainAlias" name="mainsearch" style="padding: 8px 9px; margin-top: -1px; margin-left: 15px; border-right: 0; -webkit-border-radius: 4px 0px 0px 4px; -moz-border-radius: 4px 0px 0px 4px; border-radius: 4px 0px 0px 4px; margin-right: 0;">
				<option id="opt_1" value="1">username</option>
				<option value="2">alias</option>
			</select>
			<input class="field-tpl" style="float:left;padding: 9px; margin-top: -1px; border-radius: 0px 4px 4px 0px; width: 385px; border-color: rgb(204, 204, 204);" type="text" name="q-searchmain" id="q-searchmainAlias" value="" placeholder="Поиск">
			<span class="searchSubmit" style="  margin-top: -1px; height: 36px;" onclick="$('#searchformAlias').submit();"><span style="  margin-top: 6px;" class="searchicon"></span></span>
			<input type="submit" class="dspl_n">
				<div class="clearfox"></div>
		</form>		

		<?if($userLevel['oper_create_forw']==1){?><a class="ConnectionCreate btn green" style="margin-bottom:18px;" href="javascript:void(0);">Добавить</a><?}?>
		<div class="show-el-page-wrapper">
			<select class="sel-page-wrap-opt-alias" style="padding: 8px 9px;margin-top: -1px;margin-right: 15px;">
				<option id="ShowElalias30" selected="selected">30</option>
				<option id="ShowElalias50">50</option>
				<option id="ShowElalias150">150</option>
				<option id="ShowElalias300">300</option>
			</select>		
			<!--<ul>
				<li><a onclick="ShowFuncAlias('30');" id="ind30Alias" class="show-el-pageAlias activeShowElPage" href="javascript:void(0);">30</a></li>
				<li><a onclick="ShowFuncAlias('50');" id="ind50Alias" class="show-el-pageAlias" href="javascript:void(0);">50</a></li>
				<li><a onclick="ShowFuncAlias('150');" id="ind150Alias" class="show-el-pageAlias" href="javascript:void(0);">150</a></li>
				<li><a onclick="ShowFuncAlias('300');" id="ind300Alias" class="show-el-pageAlias" href="javascript:void(0);">300</a></li>				    				    
			</ul>-->
		</div>		
			<div style="clear:both;"></div>
			<div class="header-tbls" style="margin-bottom: -1px;">
				<table class="table-boxalias">
						<tr><th class="fist-alias-point-id"><a class="sortingfuncttbl ActiveColorZerSort" onclick="SortFuncAlias('alias_id','ASC');" id="SortAliasID" href="javascript:void(0);">ID</a></th><th class="second-alias-point-id"><a class="sortingfuncttbl" onclick="SortFuncAlias('aliasdatefrom','ASC');" id="SortAliasDateFrom" href="javascript:void(0);">Дата c</a></th><th class="second-2-alias-point-id"><a class="sortingfuncttbl" onclick="SortFuncAlias('aliasdateto','ASC');" id="SortAliasDateTo" href="javascript:void(0);">Дата по</a></th><th class="third-alias-point-id"><a class="sortingfuncttbl" onclick="SortFuncAlias('username','ASC');" id="SortUsername" href="javascript:void(0);">Username</a></th><th class="fourth-alias-point-id">Alias</th><th class="fourth_2-alias-point-id">AR</th><th style="width: 80px;">Действие</th><th class="last-ckbox-btn"></th></tr>
				</table>
			</div>	
			<div id="tbl-box-alias-container">	
				<!--<table class="table-boxmails">
					<tr id="start-list">
						<th><a onclick="SortFunc('user_id','DESC');" id="SortID" href="javascript:void(0);">ID</a></th>
						<th><a onclick="SortFunc('userdate','DESC');" id="SortDate" href="javascript:void(0);">дата</a></th>
						<th><a onclick="SortFunc('login','DESC');" id="SortLogin" href="javascript:void(0);">login</a></th>
						<th>pass</th>
						<th>email</th>
						<th>действие</th>
						<th></th>
					</tr>
				</table>-->
				<!-- Goes Table -->
			</div>
		<div class="pagenation-wrapperAlias">
			<div class="header-pagi">Страницы:</div>
			<div class="placeforpaginationAlias">
				<ul>
					<li id="start-pagi-firstAlias"><a  onclick="PagiFuncAlias('1');" class="pagi-blockAlias activePagi" href="javascript:void(0);">1</a></li>
				</ul>
					<div style="clear:both"></div>
			</div>
		</div>	
	</div>	
</div>		
	
<div class="bottom-bottom-options">
	<a class="m_BtnMassDelete" href="javascript:void(0);">Множественное удаление</a>
</div>	
<div class="bottom-bottom-optionsAlias">
	<a class="a_BtnMassDelete" href="javascript:void(0);">Множественное удаление</a>
</div>	
	</body>
</html>