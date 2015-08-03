//--validation
/*$(document).on('click',function(){
	$.getJSON( "ajax/login/ajax_valid.php", function( data ) {
		$.each( data, function( key, val ) {
			if(val=='other'){
				document.location.reload();
			}
		});
	});
});*/

$(document).ready(function() {
//-- Constats Params
valid_passw = 0;
valid_passw_r = 0;
valid_email = 0;
valid_mname = 0;
valid_mnameL = 0;

//valid_username = 0;
valid_alias = 0;

mistakesAlias = 0;
mistakesAliasExists = 0;

//--Date picker Plagin
 $( "#field_datefrom" ).datepicker({dateFormat: "dd-mm-yy", 
	onClose: function( selectedDate ) {
        $( "#field_dateto" ).datepicker( "option", "minDate", selectedDate );
      }
 });
 $( "#field_dateto" ).datepicker({dateFormat: "dd-mm-yy",
	onClose: function( selectedDate ) {
        $( "#field_datefrom" ).datepicker( "option", "maxDate", selectedDate );
      }
 });
 

 
	//-- Check Email From DB
	$('#field_email').blur(function(){
	valu = $(this).val();
		$.getJSON( "ajax/ajax_login.php", { login_request: $('#field_email').val()}, function( data ) {
		  var items = [];
		  $.each( data, function( key, val ) {
				if(val){
					$('#mistakeform2').remove();
					$('.select-list').after('<div id="mistakeform2" style="background: #c11;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width: 386px;">Ошибка! Такой логин уже есть в системе! Придумайте другой!</div>');
					$('#field_email').css({'border-color': '#c11'});
					valid_email = 0;
				}
			});
		});
		if(/[\s/'\]\[{><,|.}!@\"+)(*?&^%$;№#`~=АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя]/.exec(valu)){
			valid_email = 0;
			$('#mistakeform2').remove();
			$('.select-list').after('<div id="mistakeform2" style="background: #c11;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width: 386px;">Ошибка! Логин запрещается задавать буквами русского алфамита или пустыми-символами-пробелами!</div>');
			$('#field_email').css({'border-color': '#c11'});
		}else{
			valid_email = 1;
		}
		
	});
	$('#field_email').keyup(function(){
		$('#mistakeform2').remove();
	});

	//--Validation ALgorithm
	
	$('.field-tpl').focus(function(){
		$(this).css({'border-color': '#ccc'})
	});
	
	$('#field_password').blur(function(){
	valu = $(this).val();
	
		if(valu.length<6 || /[\s-/'\]\[{><,|.}_!@\"+)(*?&^%$;№#`~=АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя]/.exec(valu)){
			$(this).next().hide();
			if(valu.length!=0){
				$(this).parent().find('#badPass').show();
			}
			$('#normRPass').hide();
			valid_passw = 0;
		}else{
			$(this).next().show();
			valid_passw = 1;
			/*if(valu == $('#field_r_password').val()){
				$('#normRPass').show();
				valid_passw = 1;
				valid_passw_r = 1;
				$('#field_r_password').css({'border-color': '#ccc'});
			}*/
			$(this).parent().find('#badPass').hide();
		}	
	console.log(valu.length);
	});
	$('#field_password').keyup(function(){
		valu = $(this).val();
		if(valu.length<6 || !/[\s-/'\]\[{><,|.}!@\"+)(*?&^%$;№#`~=АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя]/.exec(valu)){
			$(this).next().hide();
			//$('#normRPass').hide();
			$('#badPass').hide();
		}
		if(valu.length>=6){
			//$('#normRPass').show();
			$('#normPass').show();
			//$('#field_r_password').css({'border-color': '#ccc'});
		}
	});

		$('#field_name').blur(function(){
			valu = $(this).val();
			if(/[^АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя]/.exec(valu)){
				$('#mistakerow').remove();
				$('#mainFormSender').parent().parent().before('<tr id="mistakerow"><td colspan="2"><div class="mistakeform">Ошибка! Чтобы успешно отправить результат нужно заполнить все поля формы! Красным цветом выделены те поля, которые нужно заполнить.</div></td</tr>');
				$('#field_name').css({'border-color': '#c11'});
				valid_mname = 0;
			}else{
				valid_mname = 1;
			}
		});
		$('#field_Lname').blur(function(){
			valu = $(this).val();
			if(/[^АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя]/.exec(valu)){
				$('#mistakerow').remove();
				$('#mainFormSender').parent().parent().before('<tr id="mistakerow"><td colspan="2"><div class="mistakeform">Ошибка! Чтобы успешно отправить результат нужно заполнить все поля формы! Красным цветом выделены те поля, которые нужно заполнить.</div></td</tr>');
				$('#field_Lname').css({'border-color': '#c11'});
				valid_mnameL = 0;
			}else{
				valid_mnameL = 1;
			}
		});

	/*$('#field_r_password').blur(function(){
		valu = $(this).val();
		if(valu == $('#field_password').val() && $('#normPass').css('display') == 'inline-block') {
			$(this).next().show();
			valid_passw_r = 1;
		}else{
			$(this).next().hide();
			$('#normRPass').hide();
			valid_passw_r = 0 ;
		}
	});*/
	/*$('#field_r_password').keyup(function(){
		valu = $(this).val();
		if(valu == $('#field_password').val() && $('#normPass').css('display') == 'inline-block') {
			$(this).next().show();
		}else{
			$(this).next().hide();
			$('#normRPass').hide();
		}
	});*/
	
	//--Main Form Sender BINDER here!!!
	$('#MainForm').submit(function(){
		//-- Check If All Fields are not Empty
	if($('#profile-create').val() == '0'){	
		if(/[^АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя]/.exec($('#field_name').val())){
			$('#mistakerow').remove();
			$('#mainFormSender').parent().parent().before('<tr id="mistakerow"><td colspan="2"><div class="mistakeform">Ошибка! Чтобы успешно отправить результат нужно заполнить все поля формы! Красным цветом выделены те поля, которые нужно заполнить.</div></td</tr>');
			$('#field_name').css({'border-color': '#c11'});
			valid_mname = 0;
		}else{
			valid_mname = 1;
		}	

		if(/[^АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя]/.exec($('#field_Lname').val())){
			$('#mistakerow').remove();
			$('#mainFormSender').parent().parent().before('<tr id="mistakerow"><td colspan="2"><div class="mistakeform">Ошибка! Чтобы успешно отправить результат нужно заполнить все поля формы! Красным цветом выделены те поля, которые нужно заполнить.</div></td</tr>');
			$('#field_Lname').css({'border-color': '#c11'});
			valid_mnameL = 0;
		}else{
			valid_mnameL = 1;
		}
	}
		
		
	if($('#profile-create').val() != '0'){
		valid_mname = 1;
		valid_mnameL = 1;
	}
		
		if($.trim($('#field_email').val()).length<=0 || $.trim($('#field_password').val()).length<=0 || valid_passw == 0 || valid_email == 0 || valid_mname == 0 || valid_mnameL == 0){
			console.log('mistake');
			$('#mistakerow').remove();
			$('#mainFormSender').parent().parent().before('<tr id="mistakerow"><td colspan="2"><div class="mistakeform">Ошибка! Чтобы успешно отправить результат нужно заполнить все поля формы! Красным цветом выделены те поля, которые нужно заполнить.</div></td</tr>');
			//-- red - border bad fields
			if($.trim($('#field_email').val()).length<=0){
				$('#field_email').css({'border-color': '#c11'});
			}
			//-- red - border- bad fields
			if($.trim($('#field_password').val()).length<=0 || valid_passw == 0){
				$('#field_password').css({'border-color': '#c11'});
			}
			//-- red - border- bad fields
			/*if($.trim($('#field_r_password').val()).length<=0 || valid_passw_r == 0){
				$('#field_r_password').css({'border-color': '#c11'});
			}*/
			//-- red - border- bad fields
			if($('#profile-create').val() == '0'){
				if($.trim($('#field_name').val()).length<=0){
					$('#field_name').css({'border-color': '#c11'});
				}
				//-- red - border- bad fields
				if($.trim($('#field_Lname').val()).length<=0){
					$('#field_Lname').css({'border-color': '#c11'});
				}
			}
		}else{
			console.log('no mistake');
			console.log(valid_email);
			$('.mistakeform').remove();

			//-- Ajax Email Check
			$.getJSON( "ajax/ajax_login.php", { login_request: $('#field_email').val()}, function( data ) {
			  var items = [];
			  $.each( data, function( key, val ) {
				if(val){
					$('#mistakeform2').remove();
					$('.select-list').after('<div id="mistakeform2" style="background: #c11;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width: 386px;">Ошибка! Такой логин уже есть в системе! Придумайте другой!</div>');
					$('#field_email').css({'border-color': '#c11'});
					valid_email = 0;
					$('#mistakerow').remove();
					$('#mainFormSender').parent().parent().before('<tr id="mistakerow"><td colspan="2"><div class="mistakeform">Ошибка! Чтобы успешно отправить результат нужно заполнить все поля формы! Красным цветом выделены те поля, которые нужно заполнить.</div></td</tr>');
					}
				});
			});			
			
				//-- here goes Ajax Query
				$.ajax({
				dataType: "HTML",
				data: $(this).serialize(),
				type: "POST",
				url : "ajax/ajax_bd_write.php",
					success : function (data) {
						console.log(data);
						$('.clearfields').text('Добавить еще ящик')
						$('.content-wrapper').show();
						$('.content-wrapper').html(data);
							//--getting back
							setTimeout(function(){
							
							$.cookie('pageM', '1', { expires: 7 });
							$('.pagi-block').removeClass('activePagi');
							$('.placeforpagination li:first-child > a').addClass('activePagi');							
							
								$('#mainFormSender').removeAttr('disabled');
								$('#mainFormSender').css({'opacity':'1'});
								
								//-- getting new Data
								/*$('#tbl-box-container').hide();
								$('.pagenation-wrapper').hide();*/
								
								//--setting active class on tab
								$('.tabs-all-blocked a').removeClass('activeShowElPage');
								$('.tbbtabl0').addClass('activeShowElPage');
								
								/*ClearStart();

									$.getJSON( "ajax/ajax_list_mainpage.php", function( data ) {

									 
									  OutPut (data)
									});	
									
								setTimeout(function(){ $('#tbl-box-container').fadeIn(300);$('.pagenation-wrapper').fadeIn(300); }, 100);*/

								SortFunc('user_id','DESC');
							},200);					
					}
				});	

			//--styling Btn-submit
			$('#mainFormSender').attr('disabled','disabled');
			$('#mainFormSender').css({'opacity':'0.3'});		
				
		}
		return false;
	});

	
//-- A L i a S  Form




$(document).on('keyup','.aliasaddedfld',function(){
DFvalu = $(this).attr('data-numfld');

	$('#mistakeformAlias').remove();
	$(this).css({'border-color': 'ccc'});
});

	$('#field_username').keyup(function(){

	$(this).css({'border-color':'ccc'})
	$('#mistakeformUsername').remove();
	
	//-- If Arrows Up Or Down not Clicked
		if(event.keyCode != 38 && event.keyCode != 40 && event.keyCode != 39 && event.keyCode != 37){
			Clcounter=0;
			$('.usernamerez').html('');
				valu = $(this).val();
				counter = 0;
				$.getJSON( "ajax/ajax_autoload_username.php", { login_request: $('#field_username').val()}, function( data ) {
				  var items = [];
				 
				  $.each( data, function( key, val ) {
				  counter++;
					if(counter > 15){
							$('.usernamerez').append('<div onclick="PasteUser(\''+val.login+'\');" class="hiddingBlocksRez rezultblock countfield-'+counter+' iduser'+val.user_id+'"><a data-username="'+val.login+'" href="javascript:void(0);">'+val.login.replace(new RegExp (valu), "<b>"+valu+"</b>")+'</a></div>');
					}else{
							$('.usernamerez').append('<div onclick="PasteUser(\''+val.login+'\');" class="rezultblock countfield-'+counter+' iduser'+val.user_id+'"><a data-username="'+val.login+'" href="javascript:void(0);">'+val.login.replace(new RegExp (valu), "<b>"+valu+"</b>")+'</a></div>');
					}
					});
					//console.log(counter);
					if(counter > 15){
					$('.usernamerez').append('<div class="resultlist">Результатов: '+counter+' <a class="showerUsers" href="javascript:void(0);">Показать Скрытые</a></div>');
					}else{
					$('.usernamerez').append('<div class="resultlist">Результатов: '+counter+'</div>');
					}
				});
		}
	});
	
	$(document).on('keyup','#cor_username',function(event){
		//console.log($(this).val());
	//-- If Arrows Up Or Down not Clicked
		if(event.keyCode != 38 && event.keyCode != 40 && event.keyCode != 39 && event.keyCode != 37){
			Clcounter=0;
			counter = 0;
			valu = $(this).val();
			$('.usernamerez').html('');
			$.getJSON( "ajax/ajax_autoload_username.php", { login_request: valu}, function( data ) {
			  $.each( data, function( key, val ) {
			  counter++;
				if(counter > 15){
						$('.usernamerez').append('<div onclick="PasteUser(\''+val.login+'\');" class="hiddingBlocksRez rezultblock countfield-'+counter+' iduser'+val.user_id+'"><a data-username="'+val.login+'" href="javascript:void(0);">'+val.login.replace(new RegExp (valu), "<b>"+valu+"</b>")+'</a></div>');
				}else{
						$('.usernamerez').append('<div onclick="PasteUser(\''+val.login+'\');" class="rezultblock countfield-'+counter+' iduser'+val.user_id+'"><a data-username="'+val.login+'" href="javascript:void(0);">'+val.login.replace(new RegExp (valu), "<b>"+valu+"</b>")+'</a></div>');
				}
				});
				if(counter > 15){
					$('.usernamerez').append('<div class="resultlist">Результатов: '+counter+' <a class="showerUsers" href="javascript:void(0);">Показать Скрытые</a></div>');
				}else{
					$('.usernamerez').append('<div class="resultlist">Результатов: '+counter+'</div>');
				}					
			});		
		}
	});
	
	//-- Hover On Links
	$(".usernamerez").mouseover(function(){
		$('.rezultblock a').removeClass('activeHover');
	});

	//-- Shower Users
	$('body').on('click','.showerUsers',function(){
		$('.hiddingBlocksRez').fadeIn(300);
		$(this).hide();
	});


	
	$alCounter=0	
	$(document).on('click','.btn-more-values',function(){
		
		//$alCounter = 1
		
			if($alCounter==0){
				$('#original-alias-wrapper').after('<tr id="fiels-area-0" class="createdfield"><td class="field-cover" style="vertical-align:top;padding-top:5px;"></td><td style="position:relative;"><input data-memo="1" data-getvalid="" data-numfld="'+$alCounter+'" class="field-tpl aliasaddedfld" type="text" name="field_alias_'+$alCounter+'" id="field_alias_'+$alCounter+'" value="" style="border-color: rgb(204, 204, 204);"><div class="aliasrez alblock_'+$alCounter+'"></div><i data-numfild="'+$alCounter+'" id="del_fld_'+$alCounter+'" style="color: rgb(204, 17, 17);" class="fa fa-times delladdmailfld"></i></td></tr>');
			}
			if($alCounter>0){
				mInOne = $alCounter-1;
				$('#fiels-area-'+mInOne).after('<tr id="fiels-area-'+$alCounter+'" class="createdfield"><td class="field-cover" style="vertical-align:top;padding-top:5px;"></td><td style="position:relative;"><input data-memo="1" data-getvalid="" data-numfld="'+$alCounter+'" class="field-tpl aliasaddedfld" type="text" name="field_alias_'+$alCounter+'" id="field_alias_'+$alCounter+'" value="" style="border-color: rgb(204, 204, 204);"><div class="aliasrez alblock_'+$alCounter+'"></div><i data-numfild="'+$alCounter+'" id="del_fld_'+$alCounter+'" style="color: rgb(204, 17, 17);" class="fa fa-times delladdmailfld"></i></td></tr>');
			}
			
	$alCounter++;
	});	
	
	// -- Alias
	
		
	$(document).on('click','.btn-more-valuesAlias',function(){
		
		//$alCounter = 1
		

				$('.btnrow-more-alias').before('<tr id="fiels-area-'+$alCounter+'" class="createdfield"><td class="field-cover" style="vertical-align:top;padding-top:5px;"></td><td style="position:relative;"><input autocomplete="off" data-memo="1" data-getvalid="" data-numfld="'+$alCounter+'" class="field-tpl aliasaddedfld" type="text" name="field_alias_'+$alCounter+'" id="field_alias_'+$alCounter+'" value="" style="border-color: rgb(204, 204, 204);"><div class="aliasrez alblock_'+$alCounter+'"></div><i data-numfild="'+$alCounter+'" id="del_fld_'+$alCounter+'" style="color: rgb(204, 17, 17);" class="fa fa-times delladdmailfld"></i></td></tr>');
	

	$alCounter++;
	$('.btn-more-valuesAlias').attr('onclick','$alCounter='+$alCounter);
	});	

	
//-- Check Username From DB
/*$('#field_username').blur(function(){
valu = $(this).val();
	$.getJSON( "ajax/ajax_username.php", { login_request: $('#field_username').val()}, function( data ) {
	  var items = [];
	  $.each( data, function( key, val ) {
			if(val){
				valid_username = 0;
				console.log(val);
				$('#mistakeformUsername').remove();
				$('#field_username').after('<div id="mistakeformUsername" style="background: #c11;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width: 386px;">Ошибка! Такого логина в системе нет!</div>');
				$('#field_username').css({'border-color': '#c11'});
			}
		});
	
	});
	if(/[\s/'\]\[{><,|.}_!@\"+)(*?&^%$;№#`~=АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя]/.exec(valu)){
		valid_username = 0;
		$('#mistakeformUsername').remove();
		$('#field_username').after('<div id="mistakeformUsername" style="background: #c11;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width: 386px;">Ошибка! Такого логина в системе нет!</div>');
		$('#field_username').css({'border-color': '#c11'});
	}else{
		valid_username = 1;
	}
	
});
$('#field_username').keyup(function(){
	$('#mistakeformUsername').remove();
});*/



//-- Check Mails From DB
/*$(document).on('focus','.aliasaddedfld',function(){

//valu = $('#field_alias_original').val();
valu = $(this).val();
console.log(fieldToInp);
if($.trim($(this).val()).length>0){
DFvalu = $(this).attr('data-numfld');
	$.getJSON( "ajax/ajax_alias.php", { login_request: valu}, function( data ) {
	  var items = [];
	  $.each( data, function( key, val ) {
			if(val){
			console.log(val);
				valid_alias = 0;
				$('#mistakeformAlias').remove();
				$('.btn-container').before('<div id="mistakeformAlias" style="background: #c11;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width: 386px;">Ошибка! Такого Емейла в системе нет!</div>');
				$(this).css({'border-color': '#c11'});
			}
		});
	
	});

}


	if(/[\s/'\]\[{><,|.}_!@\"+)(*?&^%$;№#`~=АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя]/.exec(valu)){
		valid_alias = 0;
		$('#mistakeformAlias').remove();
		$('.btn-container').before('<div id="mistakeformAlias" style="background: #c11;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width: 386px;">Ошибка! Емайл такого формата не допустим!</div>');
		$(this).css({'border-color': '#c11'});
	}else{
		valid_alias = 1;
	}
	
});
*/	
	

	//field_alias_0: $('#field_alias_0').val(), field_alias_1: $('#field_alias_1').val()
	
	//-- Del Fld
	$(document).on('click','.delladdmailfld',function(){
		getNumbFldtoDel = $(this).attr('data-numfild');
		//console.log(getNumbFldtoDel);
		$('#fiels-area-'+getNumbFldtoDel).remove();
	});
	
	//-- Del Fld Alias
	$(document).on('click','.delladdmailfldAlias',function(){
		getNumbFldtoDel = $(this).attr('data-numfild');
		console.log(getNumbFldtoDel);
		$('#fiels-area-'+getNumbFldtoDel).hide();
		$('#field_alias_'+getNumbFldtoDel).val('');
	});
	
	//-- On Key Up - Just Added Field
	$(document).on('keyup','.aliasaddedfld',function(event){
		
		
		valu = $(this).val();
		CurId = $(this).attr('data-numfld');
		
				if(event.keyCode != 38 && event.keyCode != 40 && event.keyCode != 39 && event.keyCode != 37){
					Clcounter=0;
					$('.alblock_'+CurId).html('');
						counter = 0;
						$.getJSON( "ajax/ajax_autoload_alias.php", { email_request: valu }, function( data ) {
						  var items = [];
						 
						  $.each( data, function( key, val ) {
						  counter++;
							if(counter > 15){
									$('.alblock_'+CurId).append('<div onclick="PasteAlias(\''+val.email+'\',\''+CurId+'\');" class="hiddingBlocksRez rezultblock countfield-'+counter+' iduser'+val.user_id+'"><a data-idauto="'+CurId+'" data-username="'+val.email+'" href="javascript:void(0);">'+val.email.replace(new RegExp (valu), "<b>"+valu+"</b>")+'</a></div>');
							}else{
									$('.alblock_'+CurId).append('<div onclick="PasteAlias(\''+val.email+'\',\''+CurId+'\');" class="rezultblock countfield-'+counter+' iduser'+val.user_id+'"><a data-idauto="'+CurId+'" data-username="'+val.email+'" href="javascript:void(0);">'+val.email.replace(new RegExp (valu), "<b>"+valu+"</b>")+'</a></div>');
							}
							});
							if(counter > 15){
								$('.alblock_'+CurId).append('<div class="resultlist">Результатов: '+counter+' <a class="showerUsers" href="javascript:void(0);">Показать Скрытые</a></div>');
							}else{
								$('.alblock_'+CurId).append('<div class="resultlist">Результатов: '+counter+'</div>');
							}
						});
				}
	});
	
valid_username = 0;


	//-- Subm Form Alias
	$(document).on('submit','#MainFormAlias',function(){
	var somevar = 0;
	
	//valid_username = 1;
	//--check username simple
	//alert($('#field_username').val());
		$.getJSON( "ajax/ajax_username.php", { login_request: $('#field_username').val()}, function(data) {
		  var items = [];
		  $.each(data,function( key, val ) {
		  
				if(val.check=='0'){					
					if($.trim($('#field_username').val()).length>0){
						somevar = val.check;

						console.log('if check 0: '+val.check);
						//console.log(val.dismatch);
						//console.log(valid_username);
						$('#mistakeformUsername').remove();
						$('#field_username').after('<div id="mistakeformUsername" style="background: #c11;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width: 386px;">Ошибка! Такого логина в системе нет!</div>');
						$('#field_username').css({'border-color': '#c11'});
							//return false;
					}					
				}
				if(val.check=='1'){
					if($.trim($('#field_username').val()).length>0){
					console.log('if check 1: '+val.check);
						somevar = val.check;

						//console.log(val.check);
						return false;
					}					
				}
			});
			
			
			/*if(/[\s/'\]\[{><,|.}_!@\"+)(*?&^%$;№#`~=АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя]/.exec(valu)){
				valid_username = 0;
				$('#mistakeformUsername').remove();
				$('#field_username').after('<div id="mistakeformUsername" style="background: #c11;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width: 386px;">Ошибка! Логин нужно писать нормальными буквами!</div>');
				$('#field_username').css({'border-color': '#c11'});
			}else{
				valid_username = 1;
			}*/
			//alert(somevar);
			valid_username = somevar;
			//$('#memo').html(somevar);
			$('#field_username').attr('data-memo',valid_username);
			//console.log($('#field_username').attr('data-memo',valid_username));
		});
		
		//console.log(valid_username);

		//console.log(valid_username);

		
			//-- check Original ---
				$.getJSON( "ajax/ajax_alias.php", { login_request: $('#field_alias_original').val(), secret_code: '11111'}, function( data ) {
				//console.log(fenValID);
				  var items = [];
				  $.each( data, function( key, val ) {
						if(val.check=='0'){
						//alert(svcou);
						//GetIdent = $('input[data-getvalid="'+val.secret+'"]').attr('id');
							//if(($('#'+GetIdent).val()).length>0){
							if(($('#field_alias_original').val()).length>0){
								valid_alias = val.check;
								//alert(fenValID);
								//GetIdent = $('input[data-getvalid="'+val.secret+'"]').attr('id');
								console.log(val.secret);
								//alert(GetIdent);
								$('#mistakeformAlias').remove();
								$('.btn-container').before('<div id="mistakeformAlias" style="background: #c11;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width: 386px;">Ошибка! Такого Емейла в системе нет!</div>');
								$('#field_alias_original').css({'border-color': '#c11'});
								//$('.btn-container').after('number: '+svcou++);
								return false;
							//}
							}
						}
						if(val.check=='1'){
							//if($.trim($('#field_alias_'+i).val()).length>0){
							console.log('if check 1: '+val.check);
								valid_alias = val.check;

								//console.log(val.check);
								
							//}					
						}					
					});
					/*if(/[\s/'\]\[{><,|.}_!@\"+)(*?&^%$;№#`~=АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя]/.exec(valu)){
						valid_alias = 0;
						$('#mistakeformUsername').remove();
						$('#field_alias_'+i).after('<div id="mistakeformUsername" style="background: #c11;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width: 386px;">Ошибка! Такой формат емайла недопустим!</div>');
						$('#field_alias_'+i).css({'border-color': '#c11'});
					}else{
						valid_alias = 1;
					}*/					
					$('#field_alias_original').attr('data-memo',valid_alias);
				});			
		
			//--check Alias simple ---
			svcou = 0;
			for(i=0;i<=$alCounter-1;i++){
			
			kate = i;
			fenValID = Math.floor(Math.random()*Math.random()*(9999+9999+1));
			
			$('#field_alias_'+i).attr('data-getvalid',fenValID);
			console.log(fenValID);
				$.getJSON( "ajax/ajax_alias.php", { login_request: $('#field_alias_'+i).val(), secret_code: fenValID}, function( data ) {
				//console.log(fenValID);
				  var items = [];
				  $.each( data, function( key, val ) {
						if(val.check=='0'){
						//alert(svcou);
						GetIdent = $('input[data-getvalid="'+val.secret+'"]').attr('id');
							if(($('#'+GetIdent).val()).length>0){
								valid_alias = val.check;
								//alert(fenValID);
								GetIdent = $('input[data-getvalid="'+val.secret+'"]').attr('id');
								console.log(val.secret);
								//alert(GetIdent);
								$('#mistakeformAlias').remove();
								$('.btn-container').before('<div id="mistakeformAlias" style="background: #c11;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width: 386px;">Ошибка! Такого Емейла в системе нет!</div>');
								$('#'+GetIdent).css({'border-color': '#c11'});
								//$('.btn-container').after('number: '+svcou++);
								$('#'+GetIdent).attr('data-memo',valid_alias);
								$('#field_alias_original').attr('data-memo',valid_alias);
								return false;
							}
						}
						if(val.check=='1'){
							//if($.trim($('#field_alias_'+i).val()).length>0){
							GetIdent = $('input[data-getvalid="'+val.secret+'"]').attr('id');
							
							console.log('if check 1: '+val.check);
								valid_alias = val.check;
								$('#'+GetIdent).attr('data-memo',valid_alias);
								//console.log(val.check);
								//return false;
							//}					
						}					
					});
					/*if(/[\s/'\]\[{><,|.}_!@\"+)(*?&^%$;№#`~=АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя]/.exec(valu)){
						valid_alias = 0;
						$('#mistakeformUsername').remove();
						$('#field_alias_'+i).after('<div id="mistakeformUsername" style="background: #c11;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width: 386px;">Ошибка! Такой формат емайла недопустим!</div>');
						$('#field_alias_'+i).css({'border-color': '#c11'});
					}else{
						valid_alias = 1;
					}*/					
				});				
			}
			

//var ar = new Array();
//setTimeout(function(){ 
var ar = [];

ar['field_username'] = $('#field_username').val();
ar['field_alias_original'] = $('#field_alias_original').val();
for (str = 0; str < $alCounter ; str++){			
		if(str==$alCounter-1){			
			ar['field_alias_'+str] = $('#field_alias_'+str).val();
		}else{
			ar['field_alias_'+str] = $('#field_alias_'+str).val();
		}			
	
}
 //}, 600);			
			
	//-- LineMaker
	stroke = 'field_username: $(\"#field_username\").val(), field_alias_original: $(\"#field_alias_original\").val(), '
	
	for (str = 0; str < $alCounter ; str++){
		if(str==$alCounter-1){
			stroke += 'field_alias_'+str+': $.trim($(\"#field_alias_'+str+'\").val())';
		}else{
			stroke += 'field_alias_'+str+': $.trim($(\'#field_alias_'+str+'\').val()), ';
			
		}
	}
		


	console.log(ar);
	//console.log(somevar);
	
	$(document).on('click','.aliasaddedfld',function(){
		$(this).css({'border-color':'#ccc'});
	});
	//alert($('#memo').html());
	//---------------------------------------****************************************************
	$('.loader').show();
	//SakralKey = 0;
	setTimeout(function(){ 
	//alert($('#field_alias_original').attr('data-memo'));
	$('.loader').hide();
	
	/*if($('input[data-memo=0]')==0){
		alert('no');
	}*/
	
	
	//alert(valid_alias);
		if($.trim($('#field_username').val()).length<=0 || $.trim($('#field_datefrom').val()).length<=0 || $.trim($('#field_dateto').val()).length<=0 || $.trim($('#field_alias_original').val()).length<=0 ||$('#field_username').attr('data-memo') == 0 || $('#field_alias_original').attr('data-memo') == 0 || $('#field_alias_0').attr('data-memo') == 0 || $('#field_alias_1').attr('data-memo') == 0 || $('#field_alias_2').attr('data-memo') == 0 || $('#field_alias_3').attr('data-memo') == 0 || $('#field_alias_4').attr('data-memo') == 0 || $('#field_alias_5').attr('data-memo') == 0 || $('#field_alias_6').attr('data-memo') == 0 || $('#field_alias_7').attr('data-memo') == 0 || $('#field_alias_8').attr('data-memo') == 0 || $('#field_alias_9').attr('data-memo') == 0 || $('#field_alias_10').attr('data-memo') == 0 || $('#field_alias_11').attr('data-memo') == 0 || $('#field_alias_12').attr('data-memo') == 0 || $('#field_alias_13').attr('data-memo') == 0 || $('#field_alias_14').attr('data-memo') == 0 || $('#field_alias_15').attr('data-memo') == 0 || $('#field_alias_16').attr('data-memo') == 0 || $('#field_alias_17').attr('data-memo') == 0 || $('#field_alias_18').attr('data-memo') == 0 || $('#field_alias_19').attr('data-memo') == 0 || $('#field_alias_20').attr('data-memo') == 0 || $('#field_alias_21').attr('data-memo') == 0 || $('#field_alias_22').attr('data-memo') == 0 || $('#field_alias_23').attr('data-memo') == 0 || $('#field_alias_24').attr('data-memo') == 0 || $('#field_alias_25').attr('data-memo') == 0 || $('#field_alias_26').attr('data-memo') == 0 || $('#field_alias_27').attr('data-memo') == 0 || $('#field_alias_28').attr('data-memo') == 0 || $('#field_alias_29').attr('data-memo') == 0 || $('#field_alias_29').attr('data-memo') == 0 || $('#field_alias_30').attr('data-memo') == 0 || $('#field_alias_31').attr('data-memo') == 0 || $('#field_alias_32').attr('data-memo') == 0 || $('#field_alias_33').attr('data-memo') == 0 || $('#field_alias_34').attr('data-memo') == 0 || $('#field_alias_35').attr('data-memo') == 0 || $('#field_alias_36').attr('data-memo') == 0 || $('#field_alias_37').attr('data-memo') == 0 || $('#field_alias_38').attr('data-memo') == 0 || $('#field_alias_39').attr('data-memo') == 0 || $('#field_alias_40').attr('data-memo') == 0){
			console.log('mistake');
			//console.log(valid_alias);
			//console.log(valid_username);
			$('#mistakerowAlias').remove();
			$('#mainFormSenderAlias').parent().parent().before('<tr id="mistakerowAlias"><td colspan="2"><div class="mistakeform">Ошибка! Чтобы успешно отправить результат нужно заполнить все поля формы! Красным цветом выделены те поля, которые нужно заполнить.</div></td</tr>');
			
			//-- red border bad Fields Alias
			if($.trim($('#field_username').val()).length<=0){
				$('#field_username').css({'border-color': '#c11'});
			}
			
			//-- red border bad Fields Alias
			if($.trim($('#field_datefrom').val()).length<=0){
				$('#field_datefrom').css({'border-color': '#c11'});
			}
			
			//-- red border bad Fields Alias
			if($.trim($('#field_dateto').val()).length<=0){
				$('#field_dateto').css({'border-color': '#c11'});
			}
			
			//-- red border bad Fields Alias
			if($.trim($('#field_alias_original').val()).length<=0){
				$('#field_alias_original').css({'border-color': '#c11'});
			}
			
			
		}else{
			console.log('no mistake');
			$('#mistakerowAlias').remove();
			
				//-- here goes Ajax Query
				$.ajax({
				dataType: "HTML",
				data: {field_username: $("#field_username").val(),field_datefrom: $("#field_datefrom").val(), field_dateto: $("#field_dateto").val(), field_alias_original: $.trim($("#field_alias_original").val()), field_alias_0: $.trim($('#field_alias_0').val()), field_alias_1: $.trim($('#field_alias_1').val()), field_alias_2: $.trim($('#field_alias_2').val()), field_alias_3: $.trim($('#field_alias_3').val()), field_alias_4: $.trim($('#field_alias_4').val()), field_alias_5: $.trim($('#field_alias_5').val()), field_alias_6: $.trim($('#field_alias_6').val()), field_alias_7: $.trim($('#field_alias_7').val()), field_alias_8: $.trim($('#field_alias_8').val()), field_alias_9: $.trim($('#field_alias_9').val()), field_alias_10: $.trim($('#field_alias_10').val()), field_alias_11: $.trim($('#field_alias_11').val()), field_alias_12: $.trim($('#field_alias_12').val()), field_alias_13: $.trim($('#field_alias_13').val()), field_alias_14: $.trim($('#field_alias_14').val()), field_alias_15: $.trim($('#field_alias_15').val()), field_alias_16: $.trim($('#field_alias_16').val()), field_alias_17: $.trim($('#field_alias_17').val()), field_alias_18: $.trim($('#field_alias_18').val()), field_alias_19: $.trim($('#field_alias_19').val()), field_alias_20: $.trim($('#field_alias_20').val()), field_alias_21: $.trim($('#field_alias_21').val()), field_alias_22: $.trim($('#field_alias_22').val()), field_alias_23: $.trim($('#field_alias_23').val()), field_alias_24: $.trim($('#field_alias_24').val()), field_alias_25: $.trim($('#field_alias_25').val()), field_alias_26: $.trim($('#field_alias_26').val()), field_alias_27: $.trim($('#field_alias_27').val()), field_alias_28: $.trim($('#field_alias_28').val()), field_alias_29: $.trim($('#field_alias_29').val()), field_alias_30: $.trim($('#field_alias_30').val()), field_alias_31: $.trim($('#field_alias_31').val()), field_alias_32: $.trim($('#field_alias_32').val()), field_alias_33: $.trim($('#field_alias_33').val()), field_alias_34: $.trim($('#field_alias_34').val()), field_alias_35: $.trim($('#field_alias_35').val()), field_alias_36: $.trim($('#field_alias_36').val()), field_alias_37: $.trim($('#field_alias_37').val()), field_alias_38: $.trim($('#field_alias_38').val()), field_alias_39: $.trim($('#field_alias_39').val()), field_alias_40: $.trim($('#field_alias_40').val()), field_alias_41: $.trim($('#field_alias_41').val()), field_alias_42: $.trim($('#field_alias_42').val()), field_alias_43: $.trim($('#field_alias_43').val()), field_alias_44: $.trim($('#field_alias_44').val()), field_alias_45: $.trim($('#field_alias_45').val()), field_alias_46: $.trim($('#field_alias_46').val()), field_alias_47: $.trim($('#field_alias_47').val()), field_alias_48: $.trim($('#field_alias_48').val()), field_alias_49: $.trim($('#field_alias_49').val()), field_alias_50: $.trim($('#field_alias_50').val()), field_alias_51: $.trim($('#field_alias_51').val()), field_alias_52: $.trim($('#field_alias_52').val()), field_alias_53: $.trim($('#field_alias_53').val()), field_alias_54: $.trim($('#field_alias_54').val()), field_alias_55: $.trim($('#field_alias_55').val()), field_alias_56: $.trim($('#field_alias_56').val()), field_alias_57: $.trim($('#field_alias_57').val()), field_alias_58: $.trim($('#field_alias_58').val()), field_alias_59: $.trim($('#field_alias_59').val()), field_alias_60: $.trim($('#field_alias_60').val()), field_alias_61: $.trim($('#field_alias_61').val()), field_alias_62: $.trim($('#field_alias_62').val()), field_alias_63: $.trim($('#field_alias_63').val()), field_alias_64: $.trim($('#field_alias_64').val()), field_alias_65: $.trim($('#field_alias_65').val()), field_alias_66: $.trim($('#field_alias_66').val()), field_alias_67: $.trim($('#field_alias_67').val()), field_alias_68: $.trim($('#field_alias_68').val()), field_alias_69: $.trim($('#field_alias_69').val()), field_alias_70: $.trim($('#field_alias_70').val()), field_alias_71: $.trim($('#field_alias_71').val()), field_alias_72: $.trim($('#field_alias_72').val()), field_alias_73: $.trim($('#field_alias_73').val()), field_alias_74: $.trim($('#field_alias_74').val()), field_alias_75: $.trim($('#field_alias_75').val()), field_alias_76: $.trim($('#field_alias_76').val()), field_alias_77: $.trim($('#field_alias_77').val()), field_alias_78: $.trim($('#field_alias_78').val()), field_alias_79: $.trim($('#field_alias_79').val()), field_alias_80: $.trim($('#field_alias_80').val()), field_alias_81: $.trim($('#field_alias_81').val()), field_alias_82: $.trim($('#field_alias_82').val()), field_alias_83: $.trim($('#field_alias_83').val()), field_alias_84: $.trim($('#field_alias_84').val()), field_alias_85: $.trim($('#field_alias_85').val()), field_alias_86: $.trim($('#field_alias_86').val()), field_alias_87: $.trim($('#field_alias_87').val()), field_alias_88: $.trim($('#field_alias_88').val()), field_alias_89: $.trim($('#field_alias_89').val()), field_alias_90: $.trim($('#field_alias_90').val()), field_alias_91: $.trim($('#field_alias_91').val()), field_alias_92: $.trim($('#field_alias_92').val()), field_alias_93: $.trim($('#field_alias_93').val()), field_alias_94: $.trim($('#field_alias_94').val()), field_alias_95: $.trim($('#field_alias_95').val()), field_alias_96: $.trim($('#field_alias_96').val()), field_alias_97: $.trim($('#field_alias_97').val()), field_alias_98: $.trim($('#field_alias_98').val()), field_alias_99: $.trim($('#field_alias_99').val()), field_alias_100: $.trim($('#field_alias_100').val())},
				type: "GET",
				url : "ajax/ajax_bd_write_alias.php",
					success : function (alias) {
						console.log(alias);
						$('.clearfieldsAlias').text('Добавить еще ящик');
						$('.content-wrapper-alias').show();
						$('.content-wrapper-alias').html(alias);
							//--getting back
							setTimeout(function(){
								$('#mainFormSenderAlias').removeAttr('disabled');
								$('#mainFormSenderAlias').css({'opacity':'1'});
								$('#mistakeformAlias').remove();
								
								//-- getting new Data								
								ClearStartAlias();
								$('#tbl-box-alias-container').hide();
								//alert('123');	
								ClearStart();

									$.getJSON( "ajax/ajax_list_mainpage_alias.php", function( data ) {

									 
									  OutPutAlias (data)
									});	
									
								setTimeout(function(){ $('#tbl-box-alias-container').fadeIn(600); }, 100);									
								
							},500);					
					}
				});
				
			//--styling Btn-submit
			$('#mainFormSenderAlias').attr('disabled','disabled');
			$('#mainFormSenderAlias').css({'opacity':'0.3'});	
		}
	 }, 600);	
		return false;
	});
	
	
	


$('#firstShowEl').attr("selected", "selected");

	
	//BuldUp PagiNavi
	if(getCookie('showpages')=='30'){
		BuildPaginNaviActive('30');
		$('#ShowEl30').attr("selected", "selected");
	}
	if(getCookie('showpages')=='50'){
		BuildPaginNaviActive('50');
		$('#ShowEl50').attr("selected", "selected");
	}
	if(getCookie('showpages')=='150'){
		BuildPaginNaviActive('150');
		$('#ShowEl150').attr("selected", "selected");
	}
	if(getCookie('showpages')=='300'){
		BuildPaginNaviActive('300');
		$('#ShowEl300').attr("selected", "selected");
	}

	
	
	
	
	/*$(document).on('click','.BtnAddMore',function(){
		$('#boxmails').hide();
		$('#form-mail-reg').show();
    });	*/
	$(document).on('click','.BtnAddMore',function(){
		clearAll();
	});
	$('.BtnAddMore').fancybox({
			maxWidth    : 713,
            minHeight   : 250,
            fitToView   : false,
            autoSize    : true,
            autoScale   : true,
            openEffect  : 'none',
			openSpeed : 1,		
            closeEffect : 'none',
            scrolling   : false,		
            padding     : 0
	});	
	
	
	$(document).on('click','.BtnAddMoreAlias',function(){
		clearAllAlias();
	});
	$('.BtnAddMoreAlias').fancybox({
			maxWidth    : 713,
            fitToView   : false,
            autoSize    : true,
            autoScale   : true,
            openEffect  : 'none',
			openSpeed : 1, helpers : { overlay : { locked: false } },			
            closeEffect : 'none',
            scrolling   : false,				
            padding     : 0
	});	
	

		
	//});

	$(document).on('click','#BoxesFirstBtn,.boxmailinner',function(){
	up();
	
	$('.ajaxcont').hide();
	$('.brd-tbl-users').hide();
	$('html').css({'min-height':'1400px'});
	$('#maiApplication').css({'padding-top':'60px'});
	$('#maiApplication').css({'padding-bottom':'50px'});
	$('#maiApplication').css({'padding-left':'75px'});
	$('#maiApplication').css({'height':'initial'});
	$.cookie('pageM', 1, { expires: 7 });
		$('.tabs-all-blocked a').removeClass('activeShowElPage');
		$('.tbbtabl0').addClass('activeShowElPage');	
		$('#q-searchmain').val('');
		$('.bottom-bottom-optionsAlias').hide();
		masDellStroke = '';
		MassDellIntems = new Array();
		if(count(MassDellIntems)>0){
			$('.bottom-bottom-options').show();
		}else{
			$('.bottom-bottom-options').hide();
		}
		$('.post-server a').removeClass('activeMenu');
		$('.nav-menu-top li a').removeClass('activeMenu');
		$('.boxmailinner').removeClass('activeMenu');
		//$(this).addClass('activeMenu');
		$('.boxmailinner').addClass('activeMenu');
		$('.aliasmlinner').removeClass('activeMenu');
		$('#BoxesFirstBtn').addClass('activeMenu');
		$('#boxalias').hide();
		$('#boxmails').show();
		$('#form-mail-reg').hide();
		$('#tbl-box-container').hide();
		$('.pagenation-wrapper').hide();
		ClearStart();

			$.getJSON( "ajax/ajax_list_mainpage.php",{active:'1'}, function( data ) {
			  OutPut (data)
			});	
			
		setTimeout(function(){ $('#tbl-box-container').fadeIn(600);$('.pagenation-wrapper').fadeIn(600); }, 100);	
		BuildPaginNaviActive('30');

		$('#firstShowEl').attr("selected", "selected");

			
			//BuldUp PagiNavi
			if(getCookie('showpages')=='30'){
				BuildPaginNaviActive('30');
				$('#ShowEl30').attr("selected", "selected");
			}
			if(getCookie('showpages')=='50'){
				BuildPaginNaviActive('50');
				$('#ShowEl50').attr("selected", "selected");
			}
			if(getCookie('showpages')=='150'){
				BuildPaginNaviActive('150');
				$('#ShowEl150').attr("selected", "selected");
			}
			if(getCookie('showpages')=='300'){
				BuildPaginNaviActive('300');
				$('#ShowEl300').attr("selected", "selected");
			}
		
		
			// --- Sorting ON START ALIAS ---	
			setTimeout(function(){	
				//--user_id START
			if(getCookie("sortparam") == 'ASC' && getCookie("typeparam") == 'user_id') {
				$('#SortID').attr('onclick','SortFunc(\'user_id\',\'DESC\')');
						$('.sortingfuncttbl').removeClass('ActiveColorZerSort');
						$('#SortID').addClass('ActiveColorZerSort');
			}	

			if(getCookie("sortparam") == 'DESC' && getCookie("sortparam") == 'user_id') {
				$('#SortID').attr('onclick','SortFunc(\'user_id\',\'ASC\')');
						$('.sortingfuncttbl').removeClass('ActiveColorZerSort');
						$('#SortID').addClass('ActiveColorZerSort');
			}
			
			// -- Devider
			
			if(getCookie("sortparam") == 'ASC' && getCookie("typeparam") == 'userdate') {
				$('#SortDate').attr('onclick','SortFunc(\'userdate\',\'DESC\')');
						$('.sortingfuncttbl').removeClass('ActiveColorZerSort');
						$('#SortDate').addClass('ActiveColorZerSort');
			}	

			if(getCookie("sortparam") == 'DESC' && getCookie("sortparam") == 'userdate') {
				$('#SortDate').attr('onclick','SortFunc(\'userdate\',\'ASC\')');
						$('.sortingfuncttbl').removeClass('ActiveColorZerSort');
						$('#SortDate').addClass('ActiveColorZerSort');
			}
			
			// -- Devider
			
			if(getCookie("sortparam") == 'ASC' && getCookie("typeparam") == 'login') {
				$('#SortLogin').attr('onclick','SortFunc(\'login\',\'DESC\')');
						$('.sortingfuncttbl').removeClass('ActiveColorZerSort');
						$('#SortLogin').addClass('ActiveColorZerSort');
			}	

			if(getCookie("sortparam") == 'DESC' && getCookie("sortparam") == 'login') {
				$('#SortLogin').attr('onclick','SortFunc(\'login\',\'ASC\')');
						$('.sortingfuncttbl').removeClass('ActiveColorZerSort');
						$('#SortLogin').addClass('ActiveColorZerSort');
			}
			
			// -- Devider
			
			if(getCookie("sortparam") == 'ASC' && getCookie("typeparam") == 'email') {
				$('#SortEmail').attr('onclick','SortFunc(\'email\',\'DESC\')');
						$('.sortingfuncttbl').removeClass('ActiveColorZerSort');
						$('#SortEmail').addClass('ActiveColorZerSort');
			}	

			if(getCookie("sortparam") == 'DESC' && getCookie("sortparam") == 'email') {
				$('#SortEmail').attr('onclick','SortFunc(\'email\',\'ASC\')');
						$('.sortingfuncttbl').removeClass('ActiveColorZerSort');
						$('#SortEmail').addClass('ActiveColorZerSort');
			}	
			
			// -- Devider
			
			if(getCookie("sortparam") == 'ASC' && getCookie("typeparam") == 'name') {
				$('#SortName').attr('onclick','SortFunc(\'name\',\'DESC\')');
						$('.sortingfuncttbl').removeClass('ActiveColorZerSort');
						$('#SortName').addClass('ActiveColorZerSort');
			}	

			if(getCookie("sortparam") == 'DESC' && getCookie("sortparam") == 'name') {
				$('#SortName').attr('onclick','SortFunc(\'name\',\'ASC\')');
						$('.sortingfuncttbl').removeClass('ActiveColorZerSort');
						$('#SortName').addClass('ActiveColorZerSort');
			}	
			
			// -- Devider
			
			if(getCookie("sortparam") == 'ASC' && getCookie("typeparam") == 'sername') {
				$('#SortSername').attr('onclick','SortFunc(\'sername\',\'DESC\')');
						$('.sortingfuncttbl').removeClass('ActiveColorZerSort');
						$('#SortSername').addClass('ActiveColorZerSort');
			}	

			if(getCookie("sortparam") == 'DESC' && getCookie("sortparam") == 'sername') {
				$('#SortSername').attr('onclick','SortFunc(\'sername\',\'ASC\')');
						$('.sortingfuncttbl').removeClass('ActiveColorZerSort');
						$('#SortSername').addClass('ActiveColorZerSort');
			}	

		
			 }, 100);			
		
		
		
	});
	
	$(document).on('click','#BoxesSecondBtn,.aliasmlinner',function(){
	up();
	
	$('.ajaxcont').hide();
	$('.brd-tbl-users').hide();
	$('html').css({'min-height':'1400px'});
	$('#maiApplication').css({'padding-top':'60px'});
	$('#maiApplication').css({'padding-bottom':'50px'});
	$('#maiApplication').css({'height':'initial'});
	$.cookie('pageA', 1, { expires: 7 });
	$('#q-searchmainAlias').val('');
		$('.bottom-bottom-options').hide();
		masDellStroke = '';
		MassDellIntems = new Array();
		if(count(MassDellIntems)>0){
			$('.bottom-bottom-optionsAlias').show();
		}else{
			$('.bottom-bottom-optionsAlias').hide();
		}	
		$('.post-server a').removeClass('activeMenu');
		$('.nav-menu-top li a').removeClass('activeMenu');
		//$(this).addClass('activeMenu');
		$('.boxmailinner').removeClass('activeMenu');
		$('.aliasmlinner').addClass('activeMenu');
		$('#BoxesFirstBtn').addClass('activeMenu');
		$('#boxalias').show();
		$('#boxmails').hide();
		$('.pagenation-wrapperAlias').hide();
		
		ClearStartAlias();
		$('#tbl-box-alias-container').hide();
		//alert('123');	
		//ClearStart();

			$.getJSON( "ajax/ajax_list_mainpage_alias.php", function( data ) {

			 
			  OutPutAlias (data)
			});	
			
		setTimeout(function(){ $('#tbl-box-alias-container').fadeIn(600);$('.pagenation-wrapperAlias').fadeIn(600); }, 100);

			// --- Sorting ON START ALIAS ---	
			setTimeout(function(){	
				//--user_id START
			if(getCookie("sortparamAlias") == 'ASC' && getCookie("typeparamAlias") == 'alias_id') {
				$('#SortAliasID').attr('onclick','SortFuncAlias(\'alias_id\',\'DESC\')');
						$('.sortingfuncttbl').removeClass('ActiveColorZerSort');
						$('#SortAliasID').addClass('ActiveColorZerSort');
			}	

			if(getCookie("sortparamAlias") == 'DESC' && getCookie("typeparamAlias") == 'alias_id') {
				$('#SortAliasID').attr('onclick','SortFuncAlias(\'alias_id\',\'ASC\')');
						$('.sortingfuncttbl').removeClass('ActiveColorZerSort');
						$('#SortAliasID').addClass('ActiveColorZerSort');
			}	

				//--user_date START
			if(getCookie("sortparamAlias") == 'ASC' && getCookie("typeparamAlias") == 'aliasdatefrom') {
				$('#SortAliasDateFrom').attr('onclick','SortFuncAlias(\'aliasdatefrom\',\'DESC\')');
				//$('#SortDate').css({'color':'#c11'});
				$('.sortingfuncttbl').removeClass('ActiveColorZerSort');
				$('#SortAliasDateFrom').addClass('ActiveColorZerSort');
			}	

			if(getCookie("sortparamAlias") == 'DESC' && getCookie("typeparamAlias") == 'aliasdatefrom') {
				$('#SortAliasDateFrom').attr('onclick','SortFuncAlias(\'aliasdatefrom\',\'ASC\')');
				$('.sortingfuncttbl').removeClass('ActiveColorZerSort');
				$('#SortAliasDateFrom').addClass('ActiveColorZerSort');	
			}	
				
				
				//--login START
			if(getCookie("sortparamAlias") == 'ASC' && getCookie("typeparamAlias") == 'aliasdateto') {
				$('#SortLogin').attr('onclick','SortFuncAlias(\'aliasdateto\',\'DESC\')');
				//$('#SortLogin').css({'color':'#c11'});
				$('.sortingfuncttbl').removeClass('ActiveColorZerSort');
				$('#SortLogin').addClass('ActiveColorZerSort');	
			}	

			if(getCookie("sortparamAlias") == 'DESC' && getCookie("typeparamAlias") == 'aliasdateto') {
				$('#SortAliasDateTo').attr('onclick','SortFuncAlias(\'aliasdateto\',\'ASC\')');
				//$('#SortLogin').css({'color':'#c11'});
				$('.sortingfuncttbl').removeClass('ActiveColorZerSort');
				$('#SortAliasDateTo').addClass('ActiveColorZerSort');	
			}	


				//--email START
			if(getCookie("sortparamAlias") == 'ASC' && getCookie("typeparamAlias") == 'username') {
				$('#SortUsername').attr('onclick','SortFuncAlias(\'username\',\'DESC\')');
				//$('#SortEmail').css({'color':'#c11'});
				$('.sortingfuncttbl').removeClass('ActiveColorZerSort');
				$('#SortUsername').addClass('ActiveColorZerSort');		
			}	

			if(getCookie("sortparamAlias") == 'DESC' && getCookie("typeparamAlias") == 'username') {
				$('#SortUsername').attr('onclick','SortFuncAlias(\'username\',\'ASC\')');
				//$('#SortEmail').css({'color':'#c11'});
				$('.sortingfuncttbl').removeClass('ActiveColorZerSort');
				$('#SortUsername').addClass('ActiveColorZerSort');	
			}
			 }, 100);		
	
		BuildPaginNaviAlias('30');	
	
		//BuldUp PagiNavi
		if(getCookie('showpagesal')=='30'){
			BuildPaginNaviAlias('30');
			$('#ShowElalias30').attr("selected", "selected");			
		}
		if(getCookie('showpagesal')=='50'){
			BuildPaginNaviAlias('50');	
			$('#ShowElalias50').attr("selected", "selected");
		}
		if(getCookie('showpagesal')=='150'){
			BuildPaginNaviAlias('150');	
			$('#ShowElalias150').attr("selected", "selected");
		}
		if(getCookie('showpagesal')=='300'){
			BuildPaginNaviAlias('300');	
			$('#ShowElalias300').attr("selected", "selected");
		}

	});
	
function sblk(iduser){
	$('#'+iduser+'blockidiu').next('.block-correctdel-IU').show();
}


	




function OutLogs (data){
grpArr = [];
grpColArr = [];
movColArr = [];
grpArr[1] = 'Ящики';
grpArr[2] = 'Переадресация';
grpArr[3] = 'Сотрудники';

grpColArr[1] = '#3a87ad';
grpColArr[2] = '#23A1A1;';
grpColArr[3] = '#7949EC;';

movColArr['редактирование'] = '#BEBC06';
movColArr['удаление'] = '#c11';
movColArr['создание'] = '#090';
movColArr['мн. удаление'] = '#AB11CC';
movColArr['блокирование'] = '#A8A8A8';
movColArr['сотрудники'] = '#A8A8A8';

	
cont_lg=0;
	$.each( data, function( key, val ) {
	cont_lg++;
		$('.startOutLogs').before('<li class="row-container-lgt"> <div class="rowlogs frstrow-lg"><div class="paddin-in-tbl">'+val.id+'</div></div> <div class="rowlogs frstrow_two-lg"><div class="paddin-in-tbl">'+val.ipuser+'</div></div> <div class="rowlogs scndrow-lg"><div class="paddin-in-tbl">'+val.tmlog+'</div></div> <div class="rowlogs thrdrow-lg"><div class="paddin-in-tbl"><b>'+val.login_id+'</b></div></div> <div class="rowlogs sixthrow-lg"><div class="paddin-in-tbl"><b style="color:'+grpColArr[val.vargroup]+'">'+grpArr[val.vargroup]+'</b></div></div> <div class="rowlogs forthrow-lg"><div class="paddin-in-tbl"><b style="color:'+movColArr[val.moving]+'">'+val.moving+'</b></div></div> <div class="rowlogs fifthrow-lg"><div class="paddin-in-tbl">'+val.rzlt+'</div></div>  <div style="clear:both"></div></li>');
	});

}

//--Users Toggle List
$(document).on('click','.link-hidden-IU',function(){
//$('div[data-userlogs="2"]').addClass('activeloguser');
	$.getJSON( "ajax/cusotomize/ajax/ajax_login_list.php",{showalllist:'yes'}, function( data2 ) {
		ClearStartIU();
		OutUsers (data2)
		$('.link-hidden-IU').attr('class','link-hidden-IU-close');
		$('.link-hidden-IU-close').text('Скрыть...');
	});
	

});

$(document).on('click','.link-hidden-IU-close',function(){
	$.getJSON( "ajax/cusotomize/ajax/ajax_login_list.php", function( data2 ) {
		ClearStartIU();
		OutUsers (data2)
		$('.link-hidden-IU-close').attr('class','link-hidden-IU');
		$('.link-hidden-IU').text('Показать еще...');
		up();
		
	});
})

//--Groups Toggle List
$(document).on('click','.link-hidden-IU-grp',function(){
//$('div[data-userlogs="2"]').addClass('activeloguser');
	$.getJSON( "ajax/cusotomize/ajax/ajax_login_list_grp.php",{showalllist:'yes'}, function( data2 ) {
		ClearStartGrp();
		OutGroups(data2);
		$('.link-hidden-IU-grp').attr('class','link-hidden-IU-close-grp');
		$('.link-hidden-IU-close-grp').text('Скрыть...');
	});
	

});

$(document).on('click','.link-hidden-IU-close-grp',function(){
	$.getJSON( "ajax/cusotomize/ajax/ajax_login_list_grp.php", function( data2 ) {
		ClearStartGrp();
		OutGroups(data2);
		$('.link-hidden-IU-close-grp').attr('class','link-hidden-IU-grp');
		$('.link-hidden-IU-grp').text('Показать еще...');
		up();
		
	});
});

//--Logs Toggle List
$(document).on('click','.link-hidden-IU-logs',function(){
ThisUserIdIU = $(this).attr('data-userlogs');

	$.getJSON( "ajax/cusotomize/ajax/ajax_login_list_logs.php",{showalllist:'yes',userid:ThisUserIdIU}, function( data2 ) {
		ClearStartIUlogs();
		OutLogs (data2);
		$('.link-hidden-IU-logs').attr('class','link-hidden-IU-logs-close');
		$('.link-hidden-IU-logs-close').text('Скрыть...');
	});
});

$(document).on('click','.link-hidden-IU-logs-close',function(){
ThisUserIdIU = $(this).attr('data-userlogs');
	$.getJSON( "ajax/cusotomize/ajax/ajax_login_list_logs.php",{userid:ThisUserIdIU}, function( data2 ) {
		ClearStartIUlogs();
		OutLogs (data2);
		$('.link-hidden-IU-logs-close').attr('class','link-hidden-IU-logs');
		$('.link-hidden-IU-logs').text('Показать еще...');
		up();
	});
});


function ClearStartIU(){
	$('.lst-brd-btu').html('<li class="row-container-btu startOutUsers"></li>');
}	

function ClearStartIUlogs(){
	$('.lst-log-btu').html('<li class="row-container-btu startOutLogs"></li>');
}	
	
	$(document).on('click','#custsystem,#refrlogs',function(){
	ClearStartIU();
	ClearStartIUlogs();

	$('.pagenation-wrapper-IU').hide();
	
	$('.link-hidden-IU').hide();
	$('.link-hidden-IU-logs').hide();
	//$('#maiApplication').css({'height':'initial'});
	$('html').css({'min-height':'100%'});
	$('body').css({'min-height':'100%'});
	$('#maiApplication').css({'padding-left':'0px'});
	up();
		$('.post-server a').removeClass('activeMenu');
		$('.nav-menu-top li a').removeClass('activeMenu');
		$(this).addClass('activeMenu');
		$('.datacont').hide();
		$('.ajaxcont').show();
		
		$('.root-icon-iu-sidebarmenu,.IU-brance-link').removeClass('IU-active');
		$('.IU-loging-btn').addClass('IU-active');		
		//$('html').css({'overflow-y':'scroll'});		
		
		$.ajax({
		dataType: "HTML",
		type: "POST",
		url : "ajax/cusotomize/ajax_drawpage.php",
			success : function (data) {
				$('.ajaxcont').html(data);
				BuildPagi_IU(false);	
				//-- StartOnload
				//-- StartOnload
				$.getJSON( "ajax/cusotomize/ajax/ajax_login_list_logs.php",{showalllist:'yes'}, function( data2 ) {	
					$('.lst-log-btu').hide();
				/*$('.brd-tbl-users').hide();
				$('.log-system').show();*/			
					//setTimeout(function(){ 
						OutLogs (data2);
						$('.lst-log-btu').fadeIn(700);
						$('.pagenation-wrapper-IU').fadeIn(700);
					//}, 200);
				});
				/*$.getJSON( "ajax/cusotomize/ajax/ajax_login_list_logs.php", function( data2 ) {				
					setTimeout(function(){ 
						OutLogs (data2);
						$('.link-hidden-IU-logs').show();
					}, 200);
				});*/
			}
		});		
	});
	
	$(document).on('click','#BoxesCustBtn',function(){

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
	$('.ajaxcont').css({'width':'1303px'})
	up();
		$('.post-server a').removeClass('activeMenu');
		$('.nav-menu-top li a').removeClass('activeMenu');
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
	});
	
	$(document).on('click','#BoxesDocsBtn,#ipbtn-lm',function(){
	$('.ajaxcont').html('');	
	$('#innercontainerIU').hide();
	$('.pagenation-wrapper-IU').hide();
	
	$('.link-hidden-IU').hide();
	$('.link-hidden-IU-logs').hide();
	$('#maiApplication').css({'padding':'0px'});
	$('#maiApplication').css({'padding-bottom':'50px'});
	$('.ajaxcont').css({'width':'auto'})
	//$('#maiApplication').css({'height':'initial'});
	$('html').css({'min-height':'100%'});
	$('body').css({'min-height':'100%'});
	up();
		//$('.post-server a').removeClass('activeMenu');  // -- here is first-menu-link
		$('.nav-menu-top li a').removeClass('activeMenu');
		$(this).addClass('activeMenu');
		$('.datacont').hide();
		//$('.ajaxcont').html('');
		$('.ajaxcont').show();
			
		//$('.ajaxcont').html('<img src="loading_dark_large.gif" style="margin:50px auto 0;display:block;">');
			//setTimeout(function(){
				$.ajax({
				  url: "ajax/documents/ip/show.php",
				  success: function(data){
					//$('.ajaxcont').hide();
					$('.ajaxcont').html(data);					
					//$('.ajaxcont').fadeIn(700);
					//$('#staff_table').html('123');
					drawTable('ip','','','1');
				  }
			});
			
		//},400);	
	});
	

	
	
	$(document).on('click','.IU-loging-btn',function(){
	ClearStartIU();
	ClearStartIUlogs();
	$('.link-hidden-IU').hide();
	$('.link-hidden-IU-logs').hide();
	$('#maiApplication').css({'padding':'0px'});
	$('html').css({'min-height':'initial'});
	$('body').css({'min-height':'initial'});
	up();

		//$(this).addClass('activeMenu');
		$('.datacont').hide();
		$('.ajaxcont').show();

		$('.root-icon-iu-sidebarmenu,.IU-brance-link').removeClass('IU-active');
		$('.IU-loging-btn').addClass('IU-active');
		//$('html').css({'overflow-y':'scroll'});			

				//-- StartOnload
				$.getJSON( "ajax/cusotomize/ajax/ajax_login_list_logs.php",{showalllist:'yes'}, function( data2 ) {	
	
				$('.brd-tbl-users').hide();
				$('.log-system').show();
				$('#innercontainerIU').hide();				
					//setTimeout(function(){ 
						OutLogs (data2);
						$('.link-hidden-IU-logs').show();
					//}, 200);
				});
	
	});
	
	
	$(document).on('click','.IU-company-btn',function(){

	$('.link-hidden-IU').hide();
	$('.link-hidden-IU-logs').hide();
	$('#maiApplication').css({'padding':'0px'});
	$('html').css({'min-height':'initial'});
	$('body').css({'min-height':'initial'});
	up();

		//$(this).addClass('activeMenu');
		$('.datacont').hide();
		$('.ajaxcont').show();

		$('.root-icon-iu-sidebarmenu,.IU-brance-link').removeClass('IU-active');
		$('.IU-company-btn').addClass('IU-active');
		//$('html').css({'overflow-y':'scroll'});			

			$('.brd-tbl-users').hide();
				$('.log-system').hide();			

				$.ajax({
				  url: "ajax/company/show.php",
				  success: function(data){
						$('#innercontainerIU').html(data);	
						$('#innercontainerIU').show();						
					}
				});		
	
	});	
	

	
	$(document).on('click','.IU-user-btn',function(){
	
	$('.link-hidden-IU').hide();
	$('.link-hidden-IU-logs').hide();
	$('#maiApplication').css({'padding':'0px'});
	$('html').css({'min-height':'initial'});
	$('body').css({'min-height':'initial'});
	up();

		//$(this).addClass('activeMenu');
		$('.datacont').hide();
		$('.ajaxcont').show();

		$('.root-icon-iu-sidebarmenu,.IU-brance-link').removeClass('IU-active');
		//$('.IU-user-btn').parent().parent().addClass('IU-active');				
		$('.IU-user-btn').addClass('IU-active');				

				//-- StartOnload
				$.getJSON( "ajax/cusotomize/ajax/ajax_login_list.php", function( data2 ) {
			ClearStartIU();
				
				$('.log-system').hide();
				$('.brd-tbl-users').show();
				$('#innercontainerIU').hide();
					//OutUsers (data2);
					//setTimeout(function(){ 
						OutUsers (data2);
						$('.link-hidden-IU').show();

					//}, 200);
				});			

				//-- StartOnload
				$.getJSON( "ajax/cusotomize/ajax/ajax_login_list_grp.php", function( data ) {
			ClearStartGrp();
					//OutUsers (data2);
					//setTimeout(function(){ 
						OutGroups(data);
						$('.link-hidden-IU').show();

					//}, 200);
				});
	
	});
	
	//--test
	$(document).on('click','#linktest',function(){
		alert('hello');
	});

// ********* ============	

$(document).on('click','.rolldownoptions',function(){
	$(this).next('.block-correctdel-IU').show();
	//alert('123');
});


//-- Mails Dell BTN	
	
$(document).on('click','.m_DelBtn', function(){
ThisUserId = $(this).attr('data-dell');
    $.fancybox({
        //width: 400,
        maxWidth    : 713,
            minHeight   : 250,
            fitToView   : false,
            autoSize    : true,
            autoScale   : true,
            openEffect  : 'none',
			openSpeed : 1, helpers : { overlay : { locked: false } },			
            closeEffect : 'none',
            scrolling   : false,
            padding     : 0,
        href: 'ajax/ajax_delete_login_fancy.php?delParam='+ThisUserId,
        type: 'ajax'
    });
});
$(document).on('click','.corIp',function(){
	dataIp = $(this).attr('data-ip');
    $.fancybox({
        //width: 400,
        maxWidth    : 713,
            minHeight   : 150,
            fitToView   : false,
            autoSize    : true,
            autoScale   : true,
            openEffect  : 'none',
			openSpeed : 1,			
            closeEffect : 'none',
            scrolling   : false,
            padding     : 0,
        href: 'ajax/documents/ip/ajax/form/buid_form_cor.php?id='+dataIp,
        type: 'ajax'
    });	
});

$(document).on('click','.createIp',function(){
	dataIp = $(this).attr('data-ip');
	dataLoc = $(this).attr('data-loc');
    $.fancybox({
        //width: 400,
        maxWidth    : 713,
            minHeight   : 150,
            fitToView   : false,
            autoSize    : true,
            autoScale   : true,
            openEffect  : 'none',
			openSpeed : 1,
            closeEffect : 'none',
            scrolling   : false,
            padding     : 0,
        href: 'ajax/documents/ip/ajax/form/buid_form_create.php?ip='+dataIp+'&loc='+dataLoc,
        type: 'ajax'
    });
});


//-- Mails Dell BTN	
	
$(document).on('click','.a_DelBtn', function(){
ThisUserId = $(this).attr('data-dell');
    $.fancybox({
        //width: 400,
        maxWidth    : 713,
            minHeight   : 250,
            fitToView   : false,
            autoSize    : true,
            autoScale   : true,
            openEffect  : 'none',
			openSpeed : 1, helpers : { overlay : { locked: false } },			
            closeEffect : 'none',
            scrolling   : false,
            padding     : 0,
        href: 'ajax/ajax_delete_login_fancy_alias.php?delParam='+ThisUserId,
        type: 'ajax'
    });
});	

//-- Mails Correct BTN

$(document).on('click','.m_CorrBtn,.m_link_from_log_corr',function(){
	ThisUserCorId = $(this).attr('data-corr');
    $.fancybox({
        //width: 800,
        maxWidth    : 713,
            minHeight   : 250,
            fitToView   : false,
            autoSize    : true,
            autoScale   : true,
            openEffect  : 'none',
			openSpeed : 1, helpers : { overlay : { locked: false } },			
            closeEffect : 'none',
            scrolling   : false,
            padding     : 0,
			//speedIn: 99999,
        href: 'ajax/ajax_correct_login_fancy.php?corrParam='+ThisUserCorId,
        type: 'ajax'
    });	
});

//-- Mails Correct BTN

$(document).on('click','.a_CorrBtn,.a_link_from_log_corr',function(){
	ThisUserCorId = $(this).attr('data-corr');
    $.fancybox({
        //width: 800,
        maxWidth    : 713,
            minHeight   : 250,
            fitToView   : false,
            autoSize    : true,
            autoScale   : true,
            openEffect  : 'none',
			openSpeed : 1,			
            closeEffect : 'none',
            scrolling   : false,
            padding     : 0,
			//speedIn: 99999,
        href: 'ajax/ajax_correct_login_fancy_alias.php?corrParam='+ThisUserCorId,
        type: 'ajax'
    });	
});

//-- Mails Correct BTN

$(document).on('click','.ConnectionCreate',function(){

    $.fancybox({
        //width: 800,
        maxWidth    : 713,
            minHeight   : 250,
            fitToView   : false,
            autoSize    : true,
            autoScale   : true,
            openEffect  : 'none',
			openSpeed : 1,			
            closeEffect : 'none',
            scrolling   : false,
            padding     : 0,
			//speedIn: 99999,
        href: 'ajax/ajax_alias_mainform.php',
        type: 'ajax'
    });	
});

$(document).on('click','.BtnCreateInnerUser',function(){

    $.fancybox({
        //width: 800,
        maxWidth    : 713,
            minHeight   : 250,
            fitToView   : false,
            autoSize    : true,
            autoScale   : true,
            openEffect  : 'none',
			openSpeed : 1, helpers : { overlay : { locked: false } },			
            closeEffect : 'none',
            scrolling   : false,
            padding     : 0,		
			//speedIn: 99999,
        href: 'ajax/cusotomize/ajax_createuser.php',
        type: 'ajax'
    });	
});

$(document).on('click','.BtnCreateInnerGrp',function(){

    $.fancybox({
        //width: 800,
        maxWidth    : 913,
            minHeight   : 250,
            fitToView   : false,
            autoSize    : true,
            autoScale   : true,
            openEffect  : 'none',
			openSpeed : 1, helpers : { overlay : { locked: false } },			
            closeEffect : 'none',
            scrolling   : false,
            padding     : 0,		
			//speedIn: 99999,
        href: 'ajax/cusotomize/ajax/ajax_crGrp.php',
        type: 'ajax'
    });	
});
	
//Func Count Arr
function count(obj) {
var count = 0; 
for(var prs in obj) 
{ 
	   if(obj.hasOwnProperty(prs)) count++;
} 
return count; 
}
	//masDellStroke = '';
	MassDellIntems = new Array();
$(document).on('change','.m_MassDellCkBox',function(){
	
	
	//MassDellIntems = $(this).val();
	//MassDellIntems.push($(this).val());
	if($(this).is(':checked')){
		MassDellIntems[$(this).val()] = $(this).val();
		$(this).parent().parent().css({'background-color':'#FFE5E5'});
		//masDellStroke += 'delparam_'+$(this).val()+'='+$(this).val()+'&';
	}else{
		delete MassDellIntems[$(this).val()];
		$(this).parent().parent().css({'background':'none'});
		//masDellStroke -= 'delparam_'+$(this).val()+'='+$(this).val()+'&';
	}
	
	if(count(MassDellIntems)>0){
		$('.bottom-bottom-options').show();
	}else{
		$('.bottom-bottom-options').hide();
	}
	
	//console.log(masDellStroke);	
});


$(document).on('change','#cor_autoanswer',function(){
	if($(this).is(':checked')){
		$('.autotextarea').show();
		$.getJSON( "ajax/ajax_autotextarea_alias.php", { login_request: $('#cor_username').val()}, function( data ) {

		  $.each( data, function( key, val ) {
				$('#field_TtextAutoLetter').html(val);
			});
		});		
	}else{
		$('.autotextarea').hide();
		$('#field_TtextAutoLetter').html('');
	}
});

$(document).on('change','.a_MassDellCkBox',function(){
	
	
	//MassDellIntems = $(this).val();
	//MassDellIntems.push($(this).val());
	if($(this).is(':checked')){
		MassDellIntems[$(this).val()] = $(this).val();
		$(this).parent().parent().css({'background-color':'#FFE5E5'});
		//masDellStroke += 'delparam_'+$(this).val()+'='+$(this).val()+'&';
	}else{
		delete MassDellIntems[$(this).val()];
		$(this).parent().parent().css({'background':'none'});
		//masDellStroke -= 'delparam_'+$(this).val()+'='+$(this).val()+'&';
	}
	
	if(count(MassDellIntems)>0){
		$('.bottom-bottom-optionsAlias').show();
	}else{
		$('.bottom-bottom-optionsAlias').hide();
	}
	
	//console.log(masDellStroke);	
});

$(document).on('change','#passnextmailbox',function(){
	if($(this).is(':checked')){
		$('.fogy-stopclicker').hide();
	}else{
		$('.fogy-stopclicker').show();
	}
});

$(document).on('change','#field_Tname',function(){
	if($(this).is(':checked')){
	$(this).val('1');
		$('.hiddentestletter').show();
		$('#field_Theme').val('Добро пожаловать в группу компаний "БиоЛайн"');
		$('#field_TtextLetter').val('Здравствуйте, ' +$('#field_name').val()+ ' '+$('#field_Lname').val()+'\r\n\r\nДобро пожаловать в группу компаний "Биолайн".\r\n\r\nВаши регистрационные данные:\r\n\r\nПочта:\r\n\email: '+$('#field_email').val()+'@bioline.ru'+'\r\nпароль: '+$('#field_password').val()+'\r\n\r\nЕсли у вас возникнут какие-либо проблемы, связанные с IT инфраструктурой компаний, Вы можете обратиться в наш отдел по следующим адресам:\r\n\r\nit@bioline.ru - общий адрес для всех типов заявок, кроме 1С и вопросов, связанных с сайтами группы компаний.\r\n1c@bioline.ru - для вопросов ,связанных с работой системы "1С".\r\nsite@bioline.ru   -   для   вопросов   ,  связанных  с  работой  сайта компании,интернет-магазина и "Инфолайна"\r\n\r\nОбращаем Ваше внимание на перечень проблем заявки по которым будут приниматься только через указанные выше адреса:\r\n\r\n-Создание и редактирование учетных записей пользователей, назначение  полномочий доступа к папкам и файлам;\r\n-Электронная почта (создание и изменение адресов,настройка клиентской части, установка переадресации , автоответы, создание алиасов и.т.д);\r\n-Система "Мотив" (создание пользователей , установка прав и полномочий, создание и редактирование шаблонов, и.т.д.);\r\n-Закупка оборудования и расходных материалов, ремонтные работы;\r\n-Вопросы , связанные с работой офисной телефонной сети;\r\n-Установка ПО, настройка рабочих мест;\r\n-Обеспечение работы системы "1С":\r\n-Вопросы  обеспечения  мобильной  связью (сим-карты,лимиты,подключение дополнительных опций);\r\n-Оплата счетов поставщиков, находящихся в ведении IT-подразделения.\r\n\r\nПо телефону подобные заявки не принимаются.\r\n\r\nДанная система позволяет исключить потерю Ваших заявок, равномерно распределять нагрузку между сотрудниками IT-подразделения, а так же информировать Вас о состоянии работ по заявкам. Надеемся на Ваше понимание.');
	}else{
		$('.hiddentestletter').hide();
		$(this).val('0');
	}	
});

cntrmd = 0;
$(document).on('click','.m_BtnMassDelete',function(){
masDellStroke = '';
count(MassDellIntems);
cnt= 0;
for (var my_array in MassDellIntems){
	//console.log(my_array);
	cnt++;
	if(cnt == count(MassDellIntems)){
		masDellStroke += 'delparam_'+my_array+'='+my_array;
	}else{
		masDellStroke += 'delparam_'+my_array+'='+my_array+'&';
	}
	
	
}


//console.log(MassDellIntems['335']);

    $.fancybox({
        //width: 400,
        maxWidth    : 713,
            minHeight   : 250,
            fitToView   : false,
            autoSize    : true,
            autoScale   : true,
            openEffect  : 'none',
			openSpeed : 1, 	
            closeEffect : 'none',
            scrolling   : false,
            padding     : 0,
        href: 'ajax/ajax_massdelete_login_fancy.php?'+masDellStroke,
        type: 'ajax'
    });
	console.log(masDellStroke);
});

//-- Alias Mass Dell
$(document).on('click','.a_BtnMassDelete',function(){
masDellStroke = '';
count(MassDellIntems);
cnt= 0;
for (var my_array in MassDellIntems){
	//console.log(my_array);
	cnt++;
	if(cnt == count(MassDellIntems)){
		masDellStroke += 'delparam_'+my_array+'='+my_array;
	}else{
		masDellStroke += 'delparam_'+my_array+'='+my_array+'&';
	}
	
	
}


//console.log(MassDellIntems['335']);

    $.fancybox({
        //width: 400,
        maxWidth    : 713,
            minHeight   : 250,
            fitToView   : false,
            autoSize    : true,
            autoScale   : true,
            openEffect  : 'none',
			openSpeed : 1,			
            closeEffect : 'none',
            scrolling   : false,
            padding     : 0,
        href: 'ajax/ajax_massdelete_login_fancy_alias.php?'+masDellStroke,
        type: 'ajax'
    });
	console.log(masDellStroke);
});
	
	
// --- Sorting ON START ---	
	
	//--user_id START
if(getCookie("sortparam") == 'ASC' && getCookie("typeparam") == 'user_id') {
	$('#SortID').attr('onclick','SortFunc(\'user_id\',\'DESC\')');
			$('.sortingfuncttbl').removeClass('ActiveColorZerSort');
			$('#SortID').addClass('ActiveColorZerSort');
}	

if(getCookie("sortparam") == 'DESC' && getCookie("typeparam") == 'user_id') {
	$('#SortID').attr('onclick','SortFunc(\'user_id\',\'ASC\')');
			$('.sortingfuncttbl').removeClass('ActiveColorZerSort');
			$('#SortID').addClass('ActiveColorZerSort');
}	

	//--user_date START
if(getCookie("sortparam") == 'ASC' && getCookie("typeparam") == 'userdate') {
	$('#SortDate').attr('onclick','SortFunc(\'userdate\',\'DESC\')');
	//$('#SortDate').css({'color':'#c11'});
	$('.sortingfuncttbl').removeClass('ActiveColorZerSort');
	$('#SortDate').addClass('ActiveColorZerSort');
}	

if(getCookie("sortparam") == 'DESC' && getCookie("typeparam") == 'userdate') {
	$('#SortDate').attr('onclick','SortFunc(\'userdate\',\'ASC\')');
	$('#SortDate').css({'color':'#c11'});
	$('.sortingfuncttbl').removeClass('ActiveColorZerSort');
	$('#SortDate').addClass('ActiveColorZerSort');	
}	
	
	
	//--login START
if(getCookie("sortparam") == 'ASC' && getCookie("typeparam") == 'login') {
	$('#SortLogin').attr('onclick','SortFunc(\'login\',\'DESC\')');
	//$('#SortLogin').css({'color':'#c11'});
	$('.sortingfuncttbl').removeClass('ActiveColorZerSort');
	$('#SortLogin').addClass('ActiveColorZerSort');	
}	

if(getCookie("sortparam") == 'DESC' && getCookie("typeparam") == 'login') {
	$('#SortLogin').attr('onclick','SortFunc(\'login\',\'ASC\')');
	//$('#SortLogin').css({'color':'#c11'});
	$('.sortingfuncttbl').removeClass('ActiveColorZerSort');
	$('#SortLogin').addClass('ActiveColorZerSort');	
}	


	//--email START
if(getCookie("sortparam") == 'ASC' && getCookie("typeparam") == 'email') {
	$('#SortEmail').attr('onclick','SortFunc(\'email\',\'DESC\')');
	//$('#SortEmail').css({'color':'#c11'});
	$('.sortingfuncttbl').removeClass('ActiveColorZerSort');
	$('#SortEmail').addClass('ActiveColorZerSort');		
}	

if(getCookie("sortparam") == 'DESC' && getCookie("typeparam") == 'email') {
	$('#SortEmail').attr('onclick','SortFunc(\'email\',\'ASC\')');
	//$('#SortEmail').css({'color':'#c11'});
	$('.sortingfuncttbl').removeClass('ActiveColorZerSort');
	$('#SortEmail').addClass('ActiveColorZerSort');	
}

if(getCookie("sortparam") == 'ASC' && getCookie("typeparam") == 'name') {
	$('#SortName').attr('onclick','SortFunc(\'name\',\'DESC\')');
	//$('#SortName').css({'color':'#c11'});
	$('.sortingfuncttbl').removeClass('ActiveColorZerSort');
	$('#SortName').addClass('ActiveColorZerSort');	
}	

if(getCookie("sortparam") == 'DESC' && getCookie("typeparam") == 'name') {
	$('#SortName').attr('onclick','SortFunc(\'name\',\'ASC\')');
	//$('#SortEmail').css({'color':'#c11'});
	$('.sortingfuncttbl').removeClass('ActiveColorZerSort');
	$('#SortName').addClass('ActiveColorZerSort');	
}	
	

if(getCookie("sortparam") == 'ASC' && getCookie("typeparam") == 'sername') {
	$('#SortSername').attr('onclick','SortFunc(\'sername\',\'DESC\')');
	//$('#SortName').css({'color':'#c11'});
	$('.sortingfuncttbl').removeClass('ActiveColorZerSort');
	$('#SortSername').addClass('ActiveColorZerSort');	
}

if(getCookie("sortparam") == 'DESC' && getCookie("typeparam") == 'sername') {
	$('#SortName').attr('onclick','SortFunc(\'sername\',\'ASC\')');
	//$('#SortEmail').css({'color':'#c11'});
	$('.sortingfuncttbl').removeClass('ActiveColorZerSort');
	$('#SortName').addClass('ActiveColorZerSort');	
}		
	
//--------------- END DOC READY!!!!!! -----------------------------
});
function clearAll(){
	$('#field_name,#field_Lname').removeAttr('disabled');
	$('#field_name,#field_Lname').css({'opacity':'1'});
	
	//--clear Mistakes if where
	$('.mistakeform').remove();
	$('#mistakeform2').remove();
	$('.clearfields').text('Очистить Форму');

	$('.field-tpl').css({'border-color': '#ccc'});

	$('#MainForm .field-tpl').val('').removeAttr('checked');
	$('#normPass').hide();
	$('#normRPass').hide();
	$('#badPass').hide();
	$(".select-list :first").attr("selected", "selected");
	$('.content-wrapper').hide();
	return false;
}

function clearAllAlias(){
    $.fancybox({
        //width: 800,
        maxWidth    : 713,
            minHeight   : 250,
            fitToView   : false,
            autoSize    : true,
            autoScale   : true,
            openEffect  : 'none',
			openSpeed : 1, helpers : { overlay : { locked: false } },			
            closeEffect : 'none',
            scrolling   : false,
            padding     : 0,
			//speedIn: 99999,
        href: 'ajax/ajax_alias_mainform.php',
        type: 'ajax'
    });	
}

function clearAllInnerUser(){
    $.fancybox({
        //width: 800,
        maxWidth    : 713,
            minHeight   : 250,
            fitToView   : false,
            autoSize    : true,
            autoScale   : true,
            openEffect  : 'none',
			openSpeed : 1, helpers : { overlay : { locked: false } },			
            closeEffect : 'none',
            scrolling   : false,
            padding     : 0,
			//speedIn: 99999,
        href: 'ajax/cusotomize/ajax_createuser.php',
        type: 'ajax'
    });	
}

//-- Focused On start
function setFocus(){
      document.getElementById("field_email").focus();
}

//-- Clicks On KeyBoard
$(document).keydown(function(event) {
	//-- Arrow Down
	if (event.keyCode == 38) {
		if(Clcounter>1){
			Clcounter--;
		}else{
			Clcounter=counter;
		}
			$('.rezultblock a').removeClass('activeHover');
			$('.countfield-'+Clcounter+' a').addClass('activeHover');		
	}
	//-- Arrow Up
	if (event.keyCode == 40) {
		if(Clcounter<counter){
			Clcounter++;
		}else if(Clcounter==counter){
			Clcounter=1;
		}
		$('.rezultblock a').removeClass('activeHover');
		$('.countfield-'+Clcounter+' a').addClass('activeHover');
	}
	//-- Button Enter
	if(!$('#field_TtextAutoLetter').is(':focus')){
		if (event.keyCode == 13) {
		
			if($('.rezultblock a').hasClass('activeHover')){
				getUserName = $('.rezultblock a.activeHover').attr('data-username');
				IdAutoload = $('.rezultblock a.activeHover').attr('data-idauto');
			}
			if ( $('#cor_username').is(':focus')){
				PasteUser(getUserName);
				}else{
					PasteAlias(getUserName,IdAutoload);
					
				}	
			return false;
		}
	}
});

//-- OnClickWePasteUserIntoField
function PasteUser(UserName){
	$('#cor_username').val(UserName);
	$('.usernamerez').html('');
	document.getElementById("field_alias_0").focus();
}

//-- OnClickWePasteALIASIntoField
function PasteAlias(UserName,IdAutoload){	
	//IdAutoload
	$('#field_alias_'+IdAutoload).val(UserName);
	$('#field_alias_'+IdAutoload).focus();
	$('.aliasrez').html('');
	document.getElementById("setFocBtn").focus();
	//return false;
}

//-- Click Out Of Obj user
$(document).mouseup(function (e){
	if (!$('.block-correctdel-IU').is(e.target) && $('.block-correctdel-IU').has(e.target).length === 0) {
		$('.block-correctdel-IU').hide();
	}
});

//-- Click Out Of Obj alias
$(document).mouseup(function (e){
	if (!$('.aliasrez').is(e.target) && $('.aliasrez').has(e.target).length === 0) {
		$('.aliasrez').html('');
	}
});

	
//-- Function Explode	
function explode( delimiter, string ) {	// Split a string by string

	var emptyArray = { 0: '' };

	if ( arguments.length != 2
		|| typeof arguments[0] == 'undefined'
		|| typeof arguments[1] == 'undefined' )
	{
		return null;
	}

	if ( delimiter === ''
		|| delimiter === false
		|| delimiter === null )
	{
		return false;
	}

	if ( typeof delimiter == 'function'
		|| typeof delimiter == 'object'
		|| typeof string == 'function'
		|| typeof string == 'object' )
	{
		return emptyArray;
	}

	if ( delimiter === true ) {
		delimiter = '1';
	}

	return string.toString().split ( delimiter.toString() );
}

function SortFunc(type,param){


//-- Clear Table
$('#tbl-box-container').hide();
$('.pagenation-wrapper').hide();
	 ClearStart();
	if(type == 'user_id'){
	$.cookie('sortparam', param, { expires: 7 });
	$.cookie('typeparam', type, { expires: 7 });
	
if($('.tbbtab2').hasClass('activeShowElPage')){
		$.getJSON( "ajax/ajax_list_mainpage.php", {blocked:'1', typeparam:type, sortparam: param}, function( data ) {

		  OutPut (data)
			if(param == 'DESC'){
				$('#SortID').attr('onclick','SortFunc(\'user_id\',\'ASC\')');
			}
			if(param == 'ASC'){
				$('#SortID').attr('onclick','SortFunc(\'user_id\',\'DESC\')');
			}
		});
}else if($('.tbbtabl0').hasClass('activeShowElPage')){
		$.getJSON( "ajax/ajax_list_mainpage.php", {active:'1', typeparam:type, sortparam: param}, function( data ) {

		  OutPut (data)
			if(param == 'DESC'){
				$('#SortID').attr('onclick','SortFunc(\'user_id\',\'ASC\')');
			}
			if(param == 'ASC'){
				$('#SortID').attr('onclick','SortFunc(\'user_id\',\'DESC\')');
			}
		});
}else{
		$.getJSON( "ajax/ajax_list_mainpage.php", { typeparam:type, sortparam: param}, function( data ) {

		  OutPut (data)
			if(param == 'DESC'){
				$('#SortID').attr('onclick','SortFunc(\'user_id\',\'ASC\')');
			}
			if(param == 'ASC'){
				$('#SortID').attr('onclick','SortFunc(\'user_id\',\'DESC\')');
			}
		});
}	
	



	}
	if(type == 'userdate'){	
	$.cookie('sortparam', param, { expires: 7 });
	$.cookie('typeparam', type, { expires: 7 });
	
if($('.tbbtab2').hasClass('activeShowElPage')){
		$.getJSON( "ajax/ajax_list_mainpage.php", {blocked:'1', typeparam:type, sortparam: param}, function( data ) {

		 
			OutPut (data)
			if(param == 'DESC'){
				$('#SortDate').attr('onclick','SortFunc(\'userdate\',\'ASC\')');
			}
			if(param == 'ASC'){
				$('#SortDate').attr('onclick','SortFunc(\'userdate\',\'DESC\')');
			}
		});	
}else if($('.tbbtabl0').hasClass('activeShowElPage')){
		$.getJSON( "ajax/ajax_list_mainpage.php", {active:'1', typeparam:type, sortparam: param}, function( data ) {

		 
			OutPut (data)
			if(param == 'DESC'){
				$('#SortDate').attr('onclick','SortFunc(\'userdate\',\'ASC\')');
			}
			if(param == 'ASC'){
				$('#SortDate').attr('onclick','SortFunc(\'userdate\',\'DESC\')');
			}
		});	
}else{
		$.getJSON( "ajax/ajax_list_mainpage.php", { typeparam:type, sortparam: param}, function( data ) {

		 
			OutPut (data)
			if(param == 'DESC'){
				$('#SortDate').attr('onclick','SortFunc(\'userdate\',\'ASC\')');
			}
			if(param == 'ASC'){
				$('#SortDate').attr('onclick','SortFunc(\'userdate\',\'DESC\')');
			}
		});	
}	

	}
	if(type == 'login'){
	$.cookie('sortparam', param, { expires: 7 });
	$.cookie('typeparam', type, { expires: 7 });
	
if($('.tbbtab2').hasClass('activeShowElPage')){
	$.getJSON( "ajax/ajax_list_mainpage.php", {blocked:'1', typeparam:type, sortparam: param}, function( data ) {
	 
		OutPut (data);
		if(param == 'DESC'){
			$('#SortLogin').attr('onclick','SortFunc(\'login\',\'ASC\')');
		}
		if(param == 'ASC'){
			$('#SortLogin').attr('onclick','SortFunc(\'login\',\'DESC\')');
		}
	});
}else if($('.tbbtabl0').hasClass('activeShowElPage')){
	$.getJSON( "ajax/ajax_list_mainpage.php", {active:'1', typeparam:type, sortparam: param}, function( data ) {
	 
		OutPut (data);
		if(param == 'DESC'){
			$('#SortLogin').attr('onclick','SortFunc(\'login\',\'ASC\')');
		}
		if(param == 'ASC'){
			$('#SortLogin').attr('onclick','SortFunc(\'login\',\'DESC\')');
		}
	});
}else{
	$.getJSON( "ajax/ajax_list_mainpage.php", { typeparam:type, sortparam: param}, function( data ) {
	 
		OutPut (data);
		if(param == 'DESC'){
			$('#SortLogin').attr('onclick','SortFunc(\'login\',\'ASC\')');
		}
		if(param == 'ASC'){
			$('#SortLogin').attr('onclick','SortFunc(\'login\',\'DESC\')');
		}
	});
}	
	
	
	}
	if(type == 'email'){
	$.cookie('sortparam', param, { expires: 7 });
	$.cookie('typeparam', type, { expires: 7 });	

if($('.tbbtab2').hasClass('activeShowElPage')){
	$.getJSON( "ajax/ajax_list_mainpage.php", {blocked:'1', typeparam:type, sortparam: param}, function( data ) {

	 
		OutPut (data);
		if(param == 'DESC'){
			$('#SortEmail').attr('onclick','SortFunc(\'email\',\'ASC\')');
		}
		if(param == 'ASC'){
			$('#SortEmail').attr('onclick','SortFunc(\'email\',\'DESC\')');
		}
	});
}else if($('.tbbtabl0').hasClass('activeShowElPage')){
	$.getJSON( "ajax/ajax_list_mainpage.php", {active:'1', typeparam:type, sortparam: param}, function( data ) {

	 
		OutPut (data);
		if(param == 'DESC'){
			$('#SortEmail').attr('onclick','SortFunc(\'email\',\'ASC\')');
		}
		if(param == 'ASC'){
			$('#SortEmail').attr('onclick','SortFunc(\'email\',\'DESC\')');
		}
	});
}else{
	$.getJSON( "ajax/ajax_list_mainpage.php", { typeparam:type, sortparam: param}, function( data ) {

	 
		OutPut (data);
		if(param == 'DESC'){
			$('#SortEmail').attr('onclick','SortFunc(\'email\',\'ASC\')');
		}
		if(param == 'ASC'){
			$('#SortEmail').attr('onclick','SortFunc(\'email\',\'DESC\')');
		}
	});
}

	
	
	}
	if(type == 'name'){
	$.cookie('sortparam', param, { expires: 7 });
	$.cookie('typeparam', type, { expires: 7 });
	
if($('.tbbtab2').hasClass('activeShowElPage')){
		$.getJSON( "ajax/ajax_list_mainpage.php", {blocked:'1', typeparam:type, sortparam: param}, function( data ) {

		 
			OutPut (data);
			if(param == 'DESC'){
				$('#SortName').attr('onclick','SortFunc(\'name\',\'ASC\')');
			}
			if(param == 'ASC'){
				$('#SortName').attr('onclick','SortFunc(\'name\',\'DESC\')');
			}
		});	
}else if($('.tbbtabl0').hasClass('activeShowElPage')){
		$.getJSON( "ajax/ajax_list_mainpage.php", {active:'1', typeparam:type, sortparam: param}, function( data ) {

		 
			OutPut (data);
			if(param == 'DESC'){
				$('#SortName').attr('onclick','SortFunc(\'name\',\'ASC\')');
			}
			if(param == 'ASC'){
				$('#SortName').attr('onclick','SortFunc(\'name\',\'DESC\')');
			}
		});
}else{
		$.getJSON( "ajax/ajax_list_mainpage.php", { typeparam:type, sortparam: param}, function( data ) {

		 
			OutPut (data);
			if(param == 'DESC'){
				$('#SortName').attr('onclick','SortFunc(\'name\',\'ASC\')');
			}
			if(param == 'ASC'){
				$('#SortName').attr('onclick','SortFunc(\'name\',\'DESC\')');
			}
		});	
}	
	

	}
	if(type == 'sername'){
	$.cookie('sortparam', param, { expires: 7 });
	$.cookie('typeparam', type, { expires: 7 });
	
	
if($('.tbbtab2').hasClass('activeShowElPage')){
		$.getJSON( "ajax/ajax_list_mainpage.php", {blocked:'1', typeparam:type, sortparam: param}, function( data ) {

		 
			OutPut (data);
			if(param == 'DESC'){
				$('#SortSername').attr('onclick','SortFunc(\'sername\',\'ASC\')');
			}
			if(param == 'ASC'){
				$('#SortSername').attr('onclick','SortFunc(\'sername\',\'DESC\')');
			}
		});	
}else if($('.tbbtabl0').hasClass('activeShowElPage')){
		$.getJSON( "ajax/ajax_list_mainpage.php", {active:'1', typeparam:type, sortparam: param}, function( data ) {

		 
			OutPut (data);
			if(param == 'DESC'){
				$('#SortSername').attr('onclick','SortFunc(\'sername\',\'ASC\')');
			}
			if(param == 'ASC'){
				$('#SortSername').attr('onclick','SortFunc(\'sername\',\'DESC\')');
			}
		});	
}else{
		$.getJSON( "ajax/ajax_list_mainpage.php", { typeparam:type, sortparam: param}, function( data ) {

		 
			OutPut (data);
			if(param == 'DESC'){
				$('#SortSername').attr('onclick','SortFunc(\'sername\',\'ASC\')');
			}
			if(param == 'ASC'){
				$('#SortSername').attr('onclick','SortFunc(\'sername\',\'DESC\')');
			}
		});	
}	
	
	

	}
	setTimeout(function(){ $('#tbl-box-container').fadeIn(600);$('.pagenation-wrapper').fadeIn(600); }, 100);
	
	//alert(val.sortparam);
}


// -- Ak


function SortFuncAlias(type,param){



//-- Set Pagi On the First Number		
$('.pagi-block').removeClass('activePagi');
$('.placeforpagination li:first-child a').addClass('activePagi');

//-- Clear Table
$('#tbl-box-alias-container').hide();
$('.pagenation-wrapperAlias').hide();
	 ClearStartAlias();
	if(type == 'alias_id'){
	$.cookie('sortparamAlias', param, { expires: 7 });
	$.cookie('typeparamAlias', type, { expires: 7 });
		$.getJSON( "ajax/ajax_list_mainpage_alias.php", { typeparam:type, sortparam: param}, function( data ) {

		  OutPutAlias (data)
			if(param == 'DESC'){
				$('#SortAliasID').attr('onclick','SortFuncAlias(\'alias_id\',\'ASC\')');
			}
			if(param == 'ASC'){
				$('#SortAliasID').attr('onclick','SortFuncAlias(\'alias_id\',\'DESC\')');
			}
		});


	}
	if(type == 'aliasdatefrom'){
	$.cookie('sortparamAlias', param, { expires: 7 });
	$.cookie('typeparamAlias', type, { expires: 7 });
		$.getJSON( "ajax/ajax_list_mainpage_alias.php", { typeparam:type, sortparam: param}, function( data ) {

		  OutPutAlias (data)
			if(param == 'DESC'){
				$('#SortAliasDateFrom').attr('onclick','SortFuncAlias(\'aliasdatefrom\',\'ASC\')');
			}
			if(param == 'ASC'){
				$('#SortAliasDateFrom').attr('onclick','SortFuncAlias(\'aliasdatefrom\',\'DESC\')');
			}
		});


	}
	if(type == 'aliasdateto'){
	$.cookie('sortparamAlias', param, { expires: 7 });
	$.cookie('typeparamAlias', type, { expires: 7 });
		$.getJSON( "ajax/ajax_list_mainpage_alias.php", { typeparam:type, sortparam: param}, function( data ) {

		  OutPutAlias (data)
			if(param == 'DESC'){
				$('#SortAliasDateTo').attr('onclick','SortFuncAlias(\'aliasdateto\',\'ASC\')');
			}
			if(param == 'ASC'){
				$('#SortAliasDateTo').attr('onclick','SortFuncAlias(\'aliasdateto\',\'DESC\')');
			}
		});


	}
	if(type == 'username'){
	$.cookie('sortparamAlias', param, { expires: 7 });
	$.cookie('typeparamAlias', type, { expires: 7 });
		$.getJSON( "ajax/ajax_list_mainpage_alias.php", { typeparam:type, sortparam: param}, function( data ) {

		  OutPutAlias (data)
			if(param == 'DESC'){
				$('#SortUsername').attr('onclick','SortFuncAlias(\'username\',\'ASC\')');
			}
			if(param == 'ASC'){
				$('#SortUsername').attr('onclick','SortFuncAlias(\'username\',\'DESC\')');
			}
		});
	}

	setTimeout(function(){ $('#tbl-box-alias-container').fadeIn(600);$('.pagenation-wrapperAlias').fadeIn(600); }, 100);
	
	//alert(val.sortparam);
}


function PagiFunc(Page){
$('#tbl-box-container').hide();
$('.pagenation-wrapper').hide();

$.cookie('pageM', Page, { expires: 7 });

setTimeout(function(){
if(getCookie("sortparam") == 'DESC'){
	$('#SortID').attr('onclick','SortFunc(\'user_id\',\'ASC\')');
	$('#SortEmail').attr('onclick','SortFunc(\'email\',\'ASC\')');
	$('#SortLogin').attr('onclick','SortFunc(\'login\',\'ASC\')');
	$('#SortDate').attr('onclick','SortFunc(\'userdate\',\'ASC\')');
}else{
	$('#SortID').attr('onclick','SortFunc(\'user_id\',\'DESC\')');
	$('#SortEmail').attr('onclick','SortFunc(\'email\',\'DESC\')');
	$('#SortLogin').attr('onclick','SortFunc(\'login\',\'DESC\')');
	$('#SortDate').attr('onclick','SortFunc(\'userdate\',\'DESC\')');
}

}, 300);
		ClearStart();
		$.getJSON( "ajax/ajax_list_mainpage.php", { pagipage:Page}, function( data ) {
			OutPut (data)

		});	
		setTimeout(function(){ $('#tbl-box-container').fadeIn(600);$('.pagenation-wrapper').fadeIn(600); }, 100);
		
		up();
}
function PagiFunc_blocked(Page){
$('#tbl-box-container').hide();
$('.pagenation-wrapper').hide();

$.cookie('pageM', Page, { expires: 7 });

setTimeout(function(){
if(getCookie("sortparam") == 'DESC'){
	$('#SortID').attr('onclick','SortFunc(\'user_id\',\'ASC\')');
	$('#SortEmail').attr('onclick','SortFunc(\'email\',\'ASC\')');
	$('#SortLogin').attr('onclick','SortFunc(\'login\',\'ASC\')');
	$('#SortDate').attr('onclick','SortFunc(\'userdate\',\'ASC\')');
}else{
	$('#SortID').attr('onclick','SortFunc(\'user_id\',\'DESC\')');
	$('#SortEmail').attr('onclick','SortFunc(\'email\',\'DESC\')');
	$('#SortLogin').attr('onclick','SortFunc(\'login\',\'DESC\')');
	$('#SortDate').attr('onclick','SortFunc(\'userdate\',\'DESC\')');
}

}, 300);
		ClearStart();
		$.getJSON( "ajax/ajax_list_mainpage.php", { blocked:'1', pagipage:Page}, function( data ) {
			OutPut (data)

		});	
		setTimeout(function(){ $('#tbl-box-container').fadeIn(600);$('.pagenation-wrapper').fadeIn(600); }, 100);
		
		up();
}


function PagiFunc_active(Page){
$('#tbl-box-container').hide();
$('.pagenation-wrapper').hide();

$.cookie('pageM', Page, { expires: 7 });

setTimeout(function(){
if(getCookie("sortparam") == 'DESC'){
	$('#SortID').attr('onclick','SortFunc(\'user_id\',\'ASC\')');
	$('#SortEmail').attr('onclick','SortFunc(\'email\',\'ASC\')');
	$('#SortLogin').attr('onclick','SortFunc(\'login\',\'ASC\')');
	$('#SortDate').attr('onclick','SortFunc(\'userdate\',\'ASC\')');
}else{
	$('#SortID').attr('onclick','SortFunc(\'user_id\',\'DESC\')');
	$('#SortEmail').attr('onclick','SortFunc(\'email\',\'DESC\')');
	$('#SortLogin').attr('onclick','SortFunc(\'login\',\'DESC\')');
	$('#SortDate').attr('onclick','SortFunc(\'userdate\',\'DESC\')');
}

}, 300);
		ClearStart();
		$.getJSON( "ajax/ajax_list_mainpage.php", { active:'1', pagipage:Page}, function( data ) {
			OutPut (data)

		});	
		setTimeout(function(){ $('#tbl-box-container').fadeIn(600);$('.pagenation-wrapper').fadeIn(600); }, 100);
		
		up();
}

//--Alias
function PagiFuncAlias(Page){
$('#tbl-box-alias-container').hide();
$('.pagenation-wrapperAlias').hide();

$.cookie('pageA', Page, { expires: 7 });

/*setTimeout(function(){
if(getCookie("sortparam") == 'DESC'){
	$('#SortID').attr('onclick','SortFunc(\'user_id\',\'ASC\')');
	$('#SortEmail').attr('onclick','SortFunc(\'email\',\'ASC\')');
	$('#SortLogin').attr('onclick','SortFunc(\'login\',\'ASC\')');
	$('#SortDate').attr('onclick','SortFunc(\'userdate\',\'ASC\')');
}else{
	$('#SortID').attr('onclick','SortFunc(\'user_id\',\'DESC\')');
	$('#SortEmail').attr('onclick','SortFunc(\'email\',\'DESC\')');
	$('#SortLogin').attr('onclick','SortFunc(\'login\',\'DESC\')');
	$('#SortDate').attr('onclick','SortFunc(\'userdate\',\'DESC\')');
}

}, 300);*/
		ClearStartAlias();
		$.getJSON( "ajax/ajax_list_mainpage_alias.php", { pagipageAlias:Page}, function( data ) {
			OutPutAlias (data)

		});	
		setTimeout(function(){ $('#tbl-box-alias-container').fadeIn(600);$('.pagenation-wrapperAlias').fadeIn(600); }, 100);
		
		up();
}



$(document).on('click','.tbbtab2',function(){

		$('.tabs-all-blocked a').removeClass('activeShowElPage');
		$(this).addClass('activeShowElPage');
		$('#tbl-box-container').hide();
		$('.pagenation-wrapper').hide();
		$('#q-searchmain').val('');

		if($('.sel-page-wrap-opt').val()=='30'){
			ShowFuncBlock($('.sel-page-wrap-opt').val());
		}
		if($('.sel-page-wrap-opt').val()=='50'){
			ShowFuncBlock($('.sel-page-wrap-opt').val());
		}
		if($('.sel-page-wrap-opt').val()=='150'){
			ShowFuncBlock($('.sel-page-wrap-opt').val());
		}
		if($('.sel-page-wrap-opt').val()=='300'){
			ShowFuncBlock($('.sel-page-wrap-opt').val());
		}
		
		setTimeout(function(){ $('#tbl-box-container').fadeIn(600);
			if($('#pagistoper').hasClass('hidepagi')){
				$('.pagenation-wrapper').hide();
			}else{
				$('.pagenation-wrapper').fadeIn(600);
			}
		}, 100);
});

$(document).on('click','.tbbtabl1',function(){

		$('.tabs-all-blocked a').removeClass('activeShowElPage');
		$(this).addClass('activeShowElPage');
		$('#tbl-box-container').hide();
		$('.pagenation-wrapper').hide();
		$('#q-searchmain').val('');

		if($('.sel-page-wrap-opt').val()=='30'){
			ShowFunc($('.sel-page-wrap-opt').val());
		}
		if($('.sel-page-wrap-opt').val()=='50'){
			ShowFunc($('.sel-page-wrap-opt').val());
		}
		if($('.sel-page-wrap-opt').val()=='150'){
			ShowFunc($('.sel-page-wrap-opt').val());
		}
		if($('.sel-page-wrap-opt').val()=='300'){
			ShowFunc($('.sel-page-wrap-opt').val());
		}
		
		setTimeout(function(){ $('#tbl-box-container').fadeIn(600);$('.pagenation-wrapper').fadeIn(600); }, 100);
		
		
});

$(document).on('click','.tbbtabl0',function(){

		$('.tabs-all-blocked a').removeClass('activeShowElPage');
		$(this).addClass('activeShowElPage');
		$('#tbl-box-container').hide();
		$('.pagenation-wrapper').hide();
		$('#q-searchmain').val('');

		if($('.sel-page-wrap-opt').val()=='30'){
			ShowFuncActive($('.sel-page-wrap-opt').val());
		}
		if($('.sel-page-wrap-opt').val()=='50'){
			ShowFuncActive($('.sel-page-wrap-opt').val());
		}
		if($('.sel-page-wrap-opt').val()=='150'){
			ShowFuncActive($('.sel-page-wrap-opt').val());
		}
		if($('.sel-page-wrap-opt').val()=='300'){
			ShowFuncActive($('.sel-page-wrap-opt').val());
		}
		
		setTimeout(function(){ $('#tbl-box-container').fadeIn(600);$('.pagenation-wrapper').fadeIn(600); }, 100);
		
		
});


function ClearStart(){

//--Hightlight types
setTimeout(function(){
		 if(getCookie("typeparam") == 'user_id'){
			$('.sortingfuncttbl').removeClass('ActiveColorZerSort');
			$('#SortID').addClass('ActiveColorZerSort');
		 }
		
		 if(getCookie("typeparam") == 'userdate'){
			$('.sortingfuncttbl').removeClass('ActiveColorZerSort');
			$('#SortDate').addClass('ActiveColorZerSort');
		 }
		 if(getCookie("typeparam") == 'login'){
			$('.sortingfuncttbl').removeClass('ActiveColorZerSort');
			$('#SortLogin').addClass('ActiveColorZerSort');
		 }
		 if(getCookie("typeparam") == 'email'){
			$('.sortingfuncttbl').removeClass('ActiveColorZerSort');
			$('#SortEmail').addClass('ActiveColorZerSort');
		 }
		 if(getCookie("typeparam") == 'name'){
			$('.sortingfuncttbl').removeClass('ActiveColorZerSort');
			$('#SortName').addClass('ActiveColorZerSort');
		 }
		 if(getCookie("typeparam") == 'sername'){
			$('.sortingfuncttbl').removeClass('ActiveColorZerSort');
			$('#SortSername').addClass('ActiveColorZerSort');
		 }
		 },100);

	$('#tbl-box-container').html('');
	$('#tbl-box-container').html('<table class="table-boxmails"><tr id="start-list"></tr></table>');
}

//-- Clear Alias
function ClearStartAlias(){

setTimeout(function(){
		 if(getCookie("typeparamAlias") == 'alias_id'){
			$('.sortingfuncttbl').removeClass('ActiveColorZerSort');
			$('#SortAliasID').addClass('ActiveColorZerSort');
		 }
		
		 if(getCookie("typeparamAlias") == 'aliasdatefrom'){
			$('.sortingfuncttbl').removeClass('ActiveColorZerSort');
			$('#SortAliasDateFrom').addClass('ActiveColorZerSort');
		 }
		 if(getCookie("typeparamAlias") == 'aliasdateto'){
			$('.sortingfuncttbl').removeClass('ActiveColorZerSort');
			$('#SortAliasDateTo').addClass('ActiveColorZerSort');
		 }
		 if(getCookie("typeparamAlias") == 'username'){
			$('.sortingfuncttbl').removeClass('ActiveColorZerSort');
			$('#SortUsername').addClass('ActiveColorZerSort');
		 }
		 },100);

	$('#tbl-box-alias-container').html('');
	$('#tbl-box-alias-container').html('<table class="table-boxmails-Alias"><tr id="start-list-alias"></tr></table>');
}

//--Out ALIAS

//tbl-box-alias-container


// -- Search Main List



	
	//--Test KEYUP
	
	




	
	


function funcDelUser(userId){
	//$('.fancybox-item')click();
	
	
	
		$.ajax({
		dataType: "HTML",
		data: {finDel : userId},
		type: "GET",
		url : "ajax/ajax_finalDell.php",
			success : function (data) {
				$.fancybox({ closeClick  : true});
					$('#boxmails').show();
					$('#form-mail-reg').hide();
					$('#tbl-box-container').hide();
					$('.pagenation-wrapper').hide();
					ClearStart();
						if($('.tbbtab2').hasClass('activeShowElPage')){
							$.getJSON( "ajax/ajax_list_mainpage.php", { blocked:'1'}, function( data ) {
							  OutPut (data);
							});	
						}else if($('.tbbtabl0').hasClass('activeShowElPage')){
							$.getJSON( "ajax/ajax_list_mainpage.php", { active:'1'}, function( data ) {
								OutPut (data);
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
	
	
	
	
	return false;
}


//-- Alias

function funcDelUserAlias(userId){
	//$('.fancybox-item')click();
	
	
	
		$.ajax({
		dataType: "HTML",
		data: {finDel : userId},
		type: "GET",
		url : "ajax/ajax_finalDell_alias.php",
			success : function (data) {
				$.fancybox({ closeClick  : true});

					$('#tbl-box-alias-container').hide();
					$('.pagenation-wrapperAlias').hide();
					ClearStartAlias();
						$.getJSON( "ajax/ajax_list_mainpage_alias.php", function( data ) {

						 
						  OutPutAlias (data)
						});	
					setTimeout(function(){ $('#tbl-box-alias-container').fadeIn(600);$('.pagenation-wrapperAlias').fadeIn(600); }, 100);
			}
		});	
	
	
	
	
	return false;
}

function funcMassDelUser(strokeDelMass){
	//$('.fancybox-item')click();
	
		//-- here goes Ajax Query
		$.ajax({
		dataType: "HTML",
		data: strokeDelMass,
		type: "GET",
		url : "ajax/ajax_finalMassDell.php",
			success : function (data) {
				$.fancybox({ closeClick  : true});
					$('#boxmails').show();
					$('#form-mail-reg').hide();
					$('#tbl-box-container').hide();
					$('.pagenation-wrapper').hide();
					ClearStart();
						if($('.tbbtab2').hasClass('activeShowElPage')){
							$.getJSON( "ajax/ajax_list_mainpage.php", { blocked:'1'}, function( data ) {
							  OutPut (data);
							});	
						}else if($('.tbbtabl0').hasClass('activeShowElPage')){
							$.getJSON( "ajax/ajax_list_mainpage.php", { active:'1'}, function( data ) {
								OutPut (data);
							});							
						}else{
							$.getJSON( "ajax/ajax_list_mainpage.php", function( data ) {
								OutPut (data)
							});																			
						}
						//console.log(arr);
						setTimeout(function(){ $('#tbl-box-container').fadeIn(600);
							if($('#pagistoper').hasClass('hidepagi')){
								$('.pagenation-wrapper').hide();
							}else{
								$('.pagenation-wrapper').fadeIn(600);
							}
						}, 100);							
	masDellStroke = '';
	MassDellIntems = new Array();
$('.bottom-bottom-options').hide();	
			}
		});		
	
	
	return false;
}

function funcMassDelUserAlias(strokeDelMass){
	//$('.fancybox-item')click();
	
		//-- here goes Ajax Query
		$.ajax({
		dataType: "HTML",
		data: strokeDelMass,
		type: "GET",
		url : "ajax/ajax_finalMassDell_alias.php",
			success : function (data) {
				$.fancybox({ closeClick  : true});

					$('#tbl-box-alias-container').hide();
					$('.pagenation-wrapperAlias').hide();
					ClearStartAlias();
						$.getJSON( "ajax/ajax_list_mainpage_alias.php", function( data ) {

						 
						  OutPutAlias (data)
						});	
						//console.log(arr);
					setTimeout(function(){ $('#tbl-box-alias-container').fadeIn(600);$('.pagenation-wrapperAlias').fadeIn(600); }, 100);
	masDellStroke = '';
	MassDellIntems = new Array();
$('.bottom-bottom-optionsAlias').hide();	
			}
		});		
	
	
	return false;
}
$(document).on('click','.close-justadded',function(){
	$('.content-wrapper').hide();
});

$(document).on('submit','#m_CorrForm',function(){


	$.getJSON( "ajax/ajax_login_validate_this.php", { login_request: $('#cor_login').val(), formid: $('#user_id_id').val()}, function( data ) {
	$.each( data, function( key, val ) {
	console.log(val);
	console.log($('#user_id_id').val());
		if(val!='exists'){
			if($.trim($('#cor_login').val()).length>0 && $.trim($('#cor_email').val()).length>0 && $.trim($('#cor_pass').val()).length>0 && $.trim($('#cor_mailbox').val()).length>0){
				if(!$('#cor_login').val().match(/[\sАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя]/) && !$('#cor_email').val().match(/[\sАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя]/) && !$('#cor_pass').val().match(/[\sАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя]/) && !$('#cor_mailbox').val().match(/[\sАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя]/)){
					$.ajax({
					dataType: "HTML",
					data: $('#m_CorrForm').serialize(),
					type: "GET",
					url : "ajax/ajax_finalCorrect.php",
						success : function (data) {
						$('.mistakeform').remove();
							$.fancybox({ closeClick  : true});
							
							if($('#q-searchmain').val().length>0){
								$('#searchform').submit();
							}else{
							
								$('#boxmails').show();
								$('#form-mail-reg').hide();
								$('#tbl-box-container').hide();
								$('.pagenation-wrapper').hide();
								ClearStart();
									if($('.tbbtab2').hasClass('activeShowElPage')){
										$.getJSON( "ajax/ajax_list_mainpage.php", { blocked:'1'}, function( data ) {
											OutPut (data);
										});
									}else if($('.tbbtabl0').hasClass('activeShowElPage')){
										$.getJSON( "ajax/ajax_list_mainpage.php", { active:'1'}, function( data ) {
											OutPut (data);
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
						}
					});
				}
			}else{
				$('.mistakeform').remove();
				$('.btns-fin-corr-container').before('<div class="mistakeform">Ошибка! Чтобы успешно отправить результат нужно заполнить все поля формы!</div>');
			}
		}
		//if(val){console.log('empty val')}
	});	
});	

	return false;

});


//-- here we getting from list data and making pagi
function GetFromList(){
	if($('.sel-page-wrap-opt').val()=='30'){
		ShowFunc($('.sel-page-wrap-opt').val());
	}
	if($('.sel-page-wrap-opt').val()=='50'){
		ShowFunc($('.sel-page-wrap-opt').val());
	}
	if($('.sel-page-wrap-opt').val()=='150'){
		ShowFunc($('.sel-page-wrap-opt').val());
	}
	if($('.sel-page-wrap-opt').val()=='300'){
		ShowFunc($('.sel-page-wrap-opt').val());
	}
}

function GetFromListBlocked(){
	if($('.sel-page-wrap-opt').val()=='30'){
		ShowFunc($('.sel-page-wrap-opt').val());
	}
	if($('.sel-page-wrap-opt').val()=='50'){
		ShowFunc($('.sel-page-wrap-opt').val());
	}
	if($('.sel-page-wrap-opt').val()=='150'){
		ShowFunc($('.sel-page-wrap-opt').val());
	}
	if($('.sel-page-wrap-opt').val()=='300'){
		ShowFunc($('.sel-page-wrap-opt').val());
	}
}


//====================================================
// -- alias correction Form


$(document).on('submit','#a_CorrForm',function(){
	$('.mistakeform').remove();
	$.getJSON( "ajax/ajax_login_validate_this_alias_cor.php", $(this).serialize(), function( data ) {
	$.each( data, function( keying, valing ) {
	//console.log(valing);
		$('#'+valing.idsarchr).css({'border-color':'#c11'});
	
		if(valing=='noway'){
			mistakesAliasExists = '1';
			$('#cor_username').css({'border-color':'#c11'});
		}
		
		
		//console.log($('#cor_username').val());
		//console.log($('#user_prev_name').val());
		if($('#cor_username').val() == $('#user_prev_name').val()){
			mistakesAliasExists = '0';
			//$('#cor_username').css({'border-color':'#ccc'});
		}
	
		if(valing.mfadetectr=='mistake'){
			mistakesAlias = '1';
		}
		
		if(valing=='nomistakes'){
			mistakesAlias = '0';
			mistakesAliasExists = '0';
		}
		if(valing=='nologin'){
			mistakesLoginAlias = '1';
			$('#cor_username').css({'border-color':'#c11'});
			mistakesAlias = '1';
		}
		if(valing=='yeslogin'){
			mistakesLoginAlias = '0';
		}
		
	});
	//-- Vizual Mistakes
	
	if($('#field_alias_0').val().length<=0){
		$('#field_alias_0').css({'border-color':'#c11'});
		mistakesAlias = '1';
	}	
	if($('#cor_username').val().length<=0){
		$('#cor_username').css({'border-color':'#c11'});
		mistakesAlias = '1';
	}	
	/*if($('#cor_datefrom').val().length<=0){
		$('#cor_datefrom').css({'border-color':'#c11'});
		mistakesAlias = '1';
	}	
	if($('#cor_dateto').val().length<=0){
		$('#cor_dateto').css({'border-color':'#c11'});
		mistakesAlias = '1';
	}*/		
	//console.log(mistakesAlias);
	if(mistakesAlias=='1'){
		//-- Vizualizations 
		$('.btnrow-more-alias').after('<tr id="mistakerowAlias"><td colspan="2"><div class="mistakeform">Ошибка! Чтобы успешно отправить результат нужно заполнить все поля формы! Красным цветом выделены те поля, которые нужно заполнить.</div></td></tr>');
	}
	if(mistakesAliasExists=='1'){
		//-- Vizualizations 		
		$('#mistakerowAlias').remove();
		$('#mistakerowAliasExists').remove();
		$('.btnrow-more-alias').after('<tr id="mistakerowAliasExists"><td colspan="2"><div class="mistakeform">Ошибка! Такой логин уже есть существует. Он должен быть уникальным.</div></td></tr>');
	}	
	
	//-- Final Validation
	if(mistakesAlias=='0' && $('#cor_username').val().length>0 && mistakesLoginAlias=='0' && mistakesAliasExists == '0'){
		
		$('#mistakerowAlias').remove();
		//-- Sending Ajax
		//-- here goes Ajax Query
				$.ajax({
				dataType: "HTML",
				data: $('#a_CorrForm').serialize(),
				type: "POST",
				url : "ajax/ajax_finalCorrect_alias.php",
					success : function (data) {
						$.fancybox({ closeClick  : true});

						if($('#q-searchmainAlias').val().length>0){
								$('#searchformAlias').submit();
						}else{	
						
							$('#tbl-box-alias-container').hide();
							$('.pagenation-wrapperAlias').hide();
							ClearStartAlias();
								$.getJSON( "ajax/ajax_list_mainpage_alias.php", function( data ) {

								 
								  OutPutAlias (data)
								});	
								//console.log(arr);
							setTimeout(function(){ $('#tbl-box-alias-container').fadeIn(600);$('.pagenation-wrapperAlias').fadeIn(600); }, 100);
						}
	
					}
				});
	}
	
});		
	return false;

});


//====================================================
// -- alias Make Form


$(document).on('submit','#a_makeForm',function(){
	$.getJSON( "ajax/ajax_login_validate_this_alias.php", $(this).serialize(), function( data ) {
	$.each( data, function( keying, valing ) {
	console.log(valing);
		$('#'+valing.idsarchr).css({'border-color':'#c11'});
	console.log(valing.idsarchr);
		if(valing=='noway'){
			mistakesAliasExists = '1';
			$('#cor_username').css({'border-color':'#c11'});
		}	
		if(valing.mfadetectr=='mistake'){
			mistakesAlias = '1';
		}
		
		if(valing=='nomistakes'){
			mistakesAlias = '0';
			mistakesAliasExists = '0';
		}
		if(valing=='nologin'){
			mistakesLoginAlias = '1';
			$('#cor_username').css({'border-color':'#c11'});
			mistakesAlias = '1';
		}
		if(valing=='yeslogin'){
			mistakesLoginAlias = '0';
		}
		
	});
	//-- Vizual Mistakes
	
	if($('#field_alias_0').val().length<=0){
		$('#field_alias_0').css({'border-color':'#c11'});
		mistakesAlias = '1';
	}	

	if($('#cor_username').val().length<=0){
		$('#cor_username').css({'border-color':'#c11'});
		mistakesAlias = '1';
	}	
	/*if($('#cor_datefrom').val().length<=0){
		$('#cor_datefrom').css({'border-color':'#c11'});
		mistakesAlias = '1';
	}	
	if($('#cor_dateto').val().length<=0){
		$('#cor_dateto').css({'border-color':'#c11'});
		mistakesAlias = '1';
	}*/		
	if(mistakesAlias=='1'){
		//-- Vizualizations 
		$('#mistakerowAlias').remove();
		$('#mistakerowAliasExists').remove();
		$('.btnrow-more-alias').after('<tr id="mistakerowAlias"><td colspan="2"><div class="mistakeform">Ошибка! Поля выделенные красным цветом не прошли валидацию. Попробуйте по другому.</div></td></tr>');
	}
	if(mistakesAliasExists=='1'){
		//-- Vizualizations 		
		$('#mistakerowAlias').remove();
		$('#mistakerowAliasExists').remove();
		$('.btnrow-more-alias').after('<tr id="mistakerowAliasExists"><td colspan="2"><div class="mistakeform">Ошибка! Такой логин уже есть существует. Он должен быть уникальным.</div></td></tr>');
	}
	
	//-- Final Validation
	if(mistakesAlias=='0' && $('#cor_username').val().length>0 && mistakesLoginAlias=='0' && mistakesAliasExists == '0'){
		
		$('#mistakerowAlias').remove();
		//-- Sending Ajax
		//-- here goes Ajax Query
				$.ajax({
				dataType: "HTML",
				data: $('#a_makeForm').serialize(),
				type: "POST",
				url : "ajax/ajax_finaldb_make.php",
					success : function (data) {
					$.cookie('pageA', '1', { expires: 7 });
					$('.pagi-blockAlias').removeClass('activePagi');
					$('.placeforpaginationAlias li:first-child > a').addClass('activePagi');					
						$('.field-tpl').css({'border-color': '#ccc'})
						$('.clearfieldsAlias ').text('Добавить еще ящик');
						$('.content-wrapper-alias').show();
						$('.content-wrapper-alias').html(data);					

							SortFuncAlias('alias_id','DESC');
	
					}
				});
	}
	
});		
	return false;

});

$(document).on('focus','.field-tpl',function(){
	$(this).css({'border-color':'#ccc'});
	$('#mistakerowAlias').remove();
})
//====================================


//--Check Validation Correction Form VISUAL
$(document).on('keyup','#cor_domid',function(){
	$(this).val($(this).val().replace (/\D/, ''));
});


$(document).on('keyup','#cor_login',function(){
	$('#mistakeCorrform').remove();
});

$(document).on('keyup','#cor_email',function(){
	$('#mistakeCorrform2').remove();
});

$(document).on('keyup','#cor_pass',function(){
	$('#mistakeCorrform').remove();
});

$(document).on('keyup','#cor_mailbox',function(){
	$('#mistakeCorrform').remove();
});



checkUser = 0;
//-- Visual Check If Login Exists
$(document).on('blur','#cor_login',function(){
valu = $(this).val();
	$.getJSON( "ajax/ajax_login_validate_this.php", { login_request: $('#cor_login').val(), formid: $('#user_id_id').val()}, function( data ) {
	  var items = [];
	  $.each( data, function( key, val ) {
			if(val=='exists'){
				$('#mistakeCorrform').remove();
				$('#cor_login').after('<div id="mistakeCorrform" style="background: #c11;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width: 290px;">Ошибка! Такой логин уже есть в системе!<br>Придумайте другой!</div>');
				$('#cor_login').css({'border-color': '#c11'});
			}
		});
	});
if($.trim($('#cor_login').val()).length==0){
		$('#mistakeCorrform').remove();
		$('#cor_login').after('<div id="mistakeCorrform" style="background: #c11;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width: 290px;">Ошибка! Поле не должно быть пустым!</div>');
		$('#cor_login').css({'border-color': '#c11'});
	}
	if(valu.match(/[\s/'\]\[{><,|.}!@\"+)(*?&^%$;№#`~=АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя]/)){
		$('#mistakeCorrform').remove();
		$('#cor_login').after('<div id="mistakeCorrform" style="background: #c11;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width: 290px;">Ошибка! Логин запрещается задавать буквами русского алфамита или пустыми-символами-пробелами!</div>');
		$('#cor_login').css({'border-color': '#c11'});
	}	
	
	//--border Color
	if($.trim($('#cor_login').val()).length<=0){
		$('#cor_login').css({'border-color': '#c11'});
	}	
});
$(document).on('focus','#cor_login',function(){
	$(this).css({'border-color': '#ccc'});
});

$(document).on('focus','#cor_email',function(){
	$(this).css({'border-color': '#ccc'});
});

$(document).on('focus','#cor_pass',function(){
	$(this).css({'border-color': '#ccc'});
});

$(document).on('focus','#cor_mailbox',function(){
	$(this).css({'border-color': '#ccc'});
});

$(document).on('blur','#cor_email',function(){
if($.trim($('#cor_email').val()).length==0){
		$('#mistakeCorrform2').remove();
		$('#cor_email').after('<div id="mistakeCorrform2" style="background: #c11;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width: 290px;">Ошибка! Поле не должно быть пустым!</div>');
		$('#cor_email').css({'border-color': '#c11'});
	}
	if($('#cor_email').val().match(/[\sАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя]/)){
		$('#mistakeCorrform2').remove();
		$('#cor_email').after('<div id="mistakeCorrform2" style="background: #c11;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width: 290px;">Ошибка! Email запрещается задавать буквами русского алфамита или пустыми-символами-пробелами!</div>');
		$('#cor_email').css({'border-color': '#c11'});
	}

});

$(document).on('blur','#cor_pass',function(){
if($.trim($('#cor_pass').val()).length==0){
		$('#mistakeCorrform').remove();
		$('#cor_pass').after('<div id="mistakeCorrform" style="background: #c11;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width: 290px;">Ошибка! Поле не должно быть пустым!</div>');
		$('#cor_pass').css({'border-color': '#c11'});
	}
	if($('#cor_pass').val().match(/[\sАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя]/)){
		$('#mistakeCorrform').remove();
		$('#cor_pass').after('<div id="mistakeCorrform" style="background: #c11;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width: 290px;">Ошибка! Пароль запрещается задавать буквами русского алфамита или пустыми-символами-пробелами!</div>');
		$('#cor_pass').css({'border-color': '#c11'});
	}
});

$(document).on('blur','#cor_mailbox',function(){
if($.trim($('#cor_mailbox').val()).length==0){
		$('#mistakeCorrform').remove();
		$('#cor_mailbox').after('<div id="mistakeCorrform" style="background: #c11;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width: 290px;">Ошибка! Поле не должно быть пустым!</div>');
		$('#cor_mailbox').css({'border-color': '#c11'});
	}
	if($('#cor_mailbox').val().match(/[\sАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя]/)){
		$('#mistakeCorrform').remove();
		$('#cor_mailbox').after('<div id="mistakeCorrform" style="background: #c11;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width: 290px;">Ошибка! MailBox запрещается задавать буквами русского алфамита или пустыми-символами-пробелами!</div>');
		$('#cor_mailbox').css({'border-color': '#c11'});
	}
});

/*var str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
var regexp = /[\d]/gi;
var matches = str.match(regexp);

if(matches){
	console.log('yes');
}else{
	console.log('no');
}*/
//console.log(matches);


$(document).on('click','.pagi-block',function(){
	$('.pagi-block').removeClass('activePagi');
	$(this).addClass('activePagi');
});
$(document).on('click','.pagi-blockAlias',function(){
	$('.pagi-blockAlias').removeClass('activePagi');
	$(this).addClass('activePagi');
});
$(document).on('click','.show-el-page',function(){
	$('.show-el-page').removeClass('activeShowElPage');
	$(this).addClass('activeShowElPage');
});

$(document).on('click','.show-el-pageAlias',function(){
	$('.show-el-pageAlias').removeClass('activeShowElPage');
	$(this).addClass('activeShowElPage');
});


//--How Much elements show on Page?
function ShowFunc(numbShow){
	$('#tbl-box-container').hide();
	$('.pagenation-wrapper').hide();
		ClearStart();

	//-- Set Pagi On the First Number		
	$('.pagi-block').removeClass('activePagi');
	$('.placeforpagination li:first-child a').addClass('activePagi');
		
	//-- Set Cookies
	$.cookie('showpages', numbShow, { expires: 7 });
	$.cookie('pageM', '', { expires: 7 });	

		$.getJSON( "ajax/ajax_list_mainpage.php",{ limit: numbShow}, function( data ) {

		 
		  OutPut (data)
		});	
		
	setTimeout(function(){ 
		$('#tbl-box-container').fadeIn(600);
		$('.pagenation-wrapper').fadeIn(600); 
	}, 	100);
	
	//BuilUP here!
	BuildPaginNavi(numbShow);	
}

//--How Much elements show on Page?
function ShowFuncBlock(numbShow){
	$('#tbl-box-container').hide();
	$('.pagenation-wrapper').hide();
		ClearStart();

	//-- Set Pagi On the First Number		
	$('.pagi-block').removeClass('activePagi');
	$('.placeforpagination li:first-child a').addClass('activePagi');
		
	//-- Set Cookies
	$.cookie('showpages', numbShow, { expires: 7 });
	$.cookie('pageM', '', { expires: 7 });	

		$.getJSON( "ajax/ajax_list_mainpage.php",{blocked:'1', limit: numbShow}, function( data ) {

		 
		  OutPut (data)
		});	
		
	setTimeout(function(){ 
		$('#tbl-box-container').fadeIn(600);
		$('.pagenation-wrapper').fadeIn(600); 
	}, 	100);
	
	//BuilUP here!
	BuildPaginNaviBlocked(numbShow);	
}

//--How Much elements show on Page?
function ShowFuncActive(numbShow){
	$('#tbl-box-container').hide();
	$('.pagenation-wrapper').hide();
		ClearStart();

	//-- Set Pagi On the First Number		
	$('.pagi-block').removeClass('activePagi');
	$('.placeforpagination li:first-child a').addClass('activePagi');
		
	//-- Set Cookies
	$.cookie('showpages', numbShow, { expires: 7 });
	$.cookie('pageM', '', { expires: 7 });	

		$.getJSON( "ajax/ajax_list_mainpage.php",{active:'1', limit: numbShow}, function( data ) {

		 
		  OutPut (data)
		});	
		
	setTimeout(function(){ 
		$('#tbl-box-container').fadeIn(600);
		$('.pagenation-wrapper').fadeIn(600); 
	}, 	100);
	
	//BuilUP here!
	BuildPaginNaviActive(numbShow);	
}

//-- Alias How Much Show 
function ShowFuncAlias(numbShow){
	$('#tbl-box-alias-container').hide();
	$('.pagenation-wrapperAlias').hide();
		ClearStartAlias();

	//-- Set Pagi On the First Number		
	$('.pagi-block').removeClass('activePagi');
	$('.placeforpagination li:first-child a').addClass('activePagi');
		
	//-- Set Cookies
	$.cookie('showpagesal', numbShow, { expires: 7 });
	$.cookie('pageA', '', { expires: 7 });		

		$.getJSON( "ajax/ajax_list_mainpage_alias.php",{ limit: numbShow}, function( data ) {

		 
		  OutPutAlias (data)
		});	
		
	setTimeout(function(){ 
		$('#tbl-box-alias-container').fadeIn(600);
		$('.pagenation-wrapperAlias').fadeIn(600); 
	}, 	100);
	
	//BuilUP here!
	BuildPaginNaviAlias(numbShow);	
}
nobrdBpg = '';
function BuildPaginNavi(numbShow){
	//--Get Numb Rows && BUILD pagi NAVI
	$.getJSON( "ajax/ajax_list_numbrows.php", function( data ) {
		 $.each( data, function( key, val ) {
			summRows = val;
		 });		 
		 GetThelast = Math.ceil(summRows/numbShow);
		 //console.log(GetThelast);
		 $('.placeforpagination').html('');
		 $('.placeforpagination').html('<ul><li id="start-pagi-first"></li></ul><div style="clear:both"></div>');
		 if(getCookie('pageM')){
			curPageAct = getCookie('pageM');
		 }else{
			curPageAct = '1';
		 }	
console.log(getCookie('pageM'));		 
		 for(i=1;i<=GetThelast;i++){
			if(i==curPageAct){		
				$('#start-pagi-first').before('<li><a onclick="PagiFunc(\''+i+'\');" class="pagi-block activePagi" href="javascript:void(0);">'+i+'</a></li>');
			}else{
			nobrdBpg = '';
				if(GetThelast == i){nobrdBpg = 'style="border-right:0;"';}				
				$('#start-pagi-first').before('<li><a '+nobrdBpg+' onclick="PagiFunc(\''+i+'\');" class="pagi-block" href="javascript:void(0);">'+i+'</a></li>');
				
			}			
		 }
	});
}


nobrdBpg = '';
function BuildPaginNaviBlocked(numbShow){
	//--Get Numb Rows && BUILD pagi NAVI
	$.getJSON( "ajax/ajax_list_numbrows_blocked.php", function( data ) {
		 $.each( data, function( key, val ) {
			summRows = val;
		 });		 
		 GetThelast = Math.ceil(summRows/numbShow);
		 //console.log(GetThelast);
		 $('.placeforpagination').html('');
		 $('.placeforpagination').html('<ul><li id="start-pagi-first"></li></ul><div style="clear:both"></div>');
		 if(getCookie('pageM')){
			curPageAct = getCookie('pageM');
		 }else{
			curPageAct = '1';
		 }	
		 
		 for(i=1;i<=GetThelast;i++){
			if(i==curPageAct){		
				$('#start-pagi-first').before('<li><a onclick="PagiFunc_blocked(\''+i+'\');" class="pagi-block activePagi" href="javascript:void(0);">'+i+'</a></li>');
			}else{
			nobrdBpg = '';
				if(GetThelast == i){nobrdBpg = 'style="border-right:0;"';}				
				$('#start-pagi-first').before('<li><a '+nobrdBpg+' onclick="PagiFunc_blocked(\''+i+'\');" class="pagi-block" href="javascript:void(0);">'+i+'</a></li>');
				
			}			
		 }
	});
}


nobrdBpg = '';
function BuildPaginNaviActive(numbShow){
	//--Get Numb Rows && BUILD pagi NAVI
	$.getJSON( "ajax/ajax_list_numbrows_active.php", function( data ) {
		 $.each( data, function( key, val ) {
			summRows = val;
		 });		 
		 GetThelast = Math.ceil(summRows/numbShow);
		 //console.log(GetThelast);
		 $('.placeforpagination').html('');
		 $('.placeforpagination').html('<ul><li id="start-pagi-first"></li></ul><div style="clear:both"></div>');
		 if(getCookie('pageM')){
			curPageAct = getCookie('pageM');
		 }else{
			curPageAct = '1';
		 }	
console.log(getCookie('pageM'));		 
		 for(i=1;i<=GetThelast;i++){
			if(i==curPageAct){		
				$('#start-pagi-first').before('<li><a onclick="PagiFunc_active(\''+i+'\');" class="pagi-block activePagi" href="javascript:void(0);">'+i+'</a></li>');
			}else{
			nobrdBpg = '';
				if(GetThelast == i){nobrdBpg = 'style="border-right:0;"';}				
				$('#start-pagi-first').before('<li><a '+nobrdBpg+' onclick="PagiFunc_active(\''+i+'\');" class="pagi-block" href="javascript:void(0);">'+i+'</a></li>');
				
			}			
		 }
	});
}

//-- Alias
nobrdBpg = '';
function BuildPaginNaviAlias(numbShow){
	//--Get Numb Rows && BUILD pagi NAVI
	$.getJSON( "ajax/ajax_list_numbrows_alias.php", function( data ) {
		 $.each( data, function( key, val ) {
			summRows = val;
		 });		 
		 GetThelast = Math.ceil(summRows/numbShow);
		 //console.log(GetThelast);
		 $('.placeforpaginationAlias').html('');
		 $('.placeforpaginationAlias').html('<ul><li id="start-pagi-firstAlias"></li></ul><div style="clear:both"></div>');
		 if(getCookie('pageA')){
			curPageAct = getCookie('pageA');
		 }else{
			curPageAct = '1';
		 }
		 for(i=1;i<=GetThelast;i++){
			if(i==curPageAct){
				$('#start-pagi-firstAlias').before('<li><a onclick="PagiFuncAlias(\''+i+'\');" class="pagi-blockAlias activePagi" href="javascript:void(0);">'+i+'</a></li>');
			}else{
			nobrdBpg = '';
				if(GetThelast == i){nobrdBpg = 'style="border-right:0;"';}
				$('#start-pagi-firstAlias').before('<li><a '+nobrdBpg+' onclick="PagiFuncAlias(\''+i+'\');" class="pagi-blockAlias" href="javascript:void(0);">'+i+'</a></li>');
			}			
		 }
	});
}

function getCookie(name) {
	var cookie = " " + document.cookie;
	var search = " " + name + "=";
	var setStr = null;
	var offset = 0;
	var end = 0;
	if (cookie.length > 0) {
		offset = cookie.indexOf(search);
		if (offset != -1) {
			offset += search.length;
			end = cookie.indexOf(";", offset)
			if (end == -1) {
				end = cookie.length;
			}
			setStr = unescape(cookie.substring(offset, end));
		}
	}
	return(setStr);
}

function up() {  
t = 0;
  var top = Math.max(document.body.scrollTop,document.documentElement.scrollTop);  
if(top > 0) {  
  window.scrollBy(0,((top+9990)/-10));  
  t = setTimeout('up()',20);  
} else clearTimeout(t);  
return false;  
}  

function str_rand() {
        var result       = '';
        var words        = '0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM';
        var max_position = words.length - 1;
            for( i = 0; i < 8; ++i ) {
                position = Math.floor ( Math.random() * max_position );
                result = result + words.substring(position, position + 1);
            }
		document.getElementById("field_password").focus();	
        return result;
    }
	
$(document).on('change','#cor_active',function(){
	if($(this).is(':checked')){
		$('.diactive-container').remove();
		$('.btns-fin-corr-container').show();
	}else{
		$('#cor_pass').val(str_rand());
		$('.mistakeform').remove();
		$('.btns-fin-corr-containerBtns').remove();
		$('.diactive-container').remove();
		$('.btns-fin-corr-container').before('<div class="diactive-container">Вы уверены в том, что хотите диактировать пользователя?<br><div class="btns-fin-corr-containerBtns"><input type="submit" class="CorrectFinUserYes" name="corr_form" value="Да"> <a onclick="$.fancybox({ closeClick  : true});" class="NotToDellNo" href="javascript:void(0);">Нет</a></div></div>');	
		$('.btns-fin-corr-container').hide();		
	}

});	

$(document).on('click','.showhiddenpass',function(){
	$(this).hide();
	$(this).next().show();
});


function moseGoneOut(param) {
	setTimeout(function(){
		$('#'+param).hide();
		$('#'+param).prev().show();
	
	}, 4500);
}

//-- number list data "Box Mail"
$(document).on('change','.sel-page-wrap-opt',function(){
	valu = $(this).val();
	
	 
if($('.tbbtab2').hasClass('activeShowElPage')){
	ShowFuncBlock(valu);
}else if($('.tbbtabl0').hasClass('activeShowElPage')){
	ShowFuncActive(valu);
}else{
	ShowFunc(valu);
}
	
});

//-- number list data "Aliases"
$(document).on('change','.sel-page-wrap-opt-alias',function(){
	valu = $(this).val();
	
	ShowFuncAlias(valu);
	
});

$(window).scroll(function() { 
  var top = $(document).scrollTop();
   if (top < 41) $("#topnav").css({'display':'block'}).stop();
   else $("#topnav").css({'display':'none'}).stop();
 });
 
$(document).on('submit','#IU-mainfilter',function(){
	IUdata = $(this).serialize();
		alert(IUdata);
	return false;
});


$(document).on('click','#seezhurn',function(){
	
	valChange = $('.sel-page-wrap-opt-IU').val();
	$('.pagenation-wrapper-IU').hide();
	IUusr = $('#cor_login_IU').val();

	link = 'IU-filteruser='+IUusr+'&IU-filtercats=0&IU-filtermoves=0&limit='+valChange;
	$.fancybox({ closeClick  : true});
			ClearStartIUlogs();	


		$.ajax({
		dataType: "HTML",
		type: "POST",
		url : "ajax/cusotomize/ajax_drawpage.php",
			success : function (data) {
				$('.ajaxcont').html(data);
					
				//-- StartOnload
				//-- StartOnload
						$.getJSON( "ajax/cusotomize/ajax/ajax_filter.php",link, function( data2 ) {
							if(data2.length>0){
							//$('.ajaxcont').html(data);
								BuildPagi_IU(link);
								$('.lst-log-btu').hide();
							/*$('.brd-tbl-users').hide();
							$('.log-system').show();*/			
								//setTimeout(function(){ 
									OutLogs (data2);
									
									//alert(count(data2));
									$('.lst-log-btu').fadeIn(700);
									$('.pagenation-wrapper-IU').fadeIn(700);
									
								//}, 200);
								$('.rzlt-search-login').html('');
								$('.rzlt-search-login').html(IUusr);
								$('#IU-filteruser').val(IUusr);
								
								$.each( data2, function( key2, val2 ) {
									$('.rzlt-search-login').html(val2.login_search);
								});
							}else{
								console.log('Пусто');
								
								$('.startOutLogs').before('<li class="row-container-lgt"> <p><b>Ничего не найдено!</b></p></li>');								
								
							}
							
						});
				/*$.getJSON( "ajax/cusotomize/ajax/ajax_login_list_logs.php", function( data2 ) {				
					setTimeout(function(){ 
						OutLogs (data2);
						$('.link-hidden-IU-logs').show();
					}, 200);
				});*/
			}
		});
			

		
});

 
$(document).on('keyup','#IU-filteruser',function(){
	valChange = $('.sel-page-wrap-opt-IU').val();
	$('.pagenation-wrapper-IU').hide();
	IUdata = $('#IU-mainfilter').serialize();
	IUdata += '&limit='+valChange;
		if($('#IU-filteruser').val().length!=0){
			ClearStartIUlogs();				
						$.getJSON( "ajax/cusotomize/ajax/ajax_filter.php",IUdata, function( data2 ) {
							if(data2.length>0){
								BuildPagi_IU(IUdata);
								$('.lst-log-btu').hide();
							/*$('.brd-tbl-users').hide();
							$('.log-system').show();*/			
								//setTimeout(function(){ 
									OutLogs (data2);
									
									//alert(count(data2));
									$('.lst-log-btu').fadeIn(700);
									$('.pagenation-wrapper-IU').fadeIn(700);
									
								//}, 200);
								$('.rzlt-search-login').html('');
								
								$.each( data2, function( key2, val2 ) {
									$('.rzlt-search-login').html(val2.login_search);
								});
							}else{
								console.log('Пусто');
								
								$('.startOutLogs').before('<li class="row-container-lgt"> <p><b>Ничего не найдено!</b></p></li>');								
								
							}
							
						});
		}else{
			if($('#IU-filtermoves').val()!='0' || $('#IU-filtercats').val()!='0'){
				$('.pagenation-wrapper-IU').hide();
						ClearStartIUlogs();
									$.getJSON( "ajax/cusotomize/ajax/ajax_filter.php",IUdata, function( data2 ) {	
										
										BuildPagi_IU(IUdata);
										$('.lst-log-btu').hide();
									/*$('.brd-tbl-users').hide();
									$('.log-system').show();*/			
										//setTimeout(function(){ 
											OutLogs (data2);
											$('.lst-log-btu').fadeIn(700);
											$('.pagenation-wrapper-IU').fadeIn(700);
										//}, 200);
										$('.rzlt-search-login').html('');
										
										$.each( data2, function( key2, val2 ) {
											$('.rzlt-search-login').html(val2.login_search);
										});
										
									});
			}else{
				ClearStartIUlogs();
				$('.pagenation-wrapper-IU').hide();
				$('.rzlt-search-login').html('');
					$.getJSON( "ajax/cusotomize/ajax/ajax_login_list_logs.php",{limit:valChange}, function( data2 ) {
						
						BuildPagi_IU(false);
						$('.lst-log-btu').hide();
							OutLogs (data2);
							$('.lst-log-btu').fadeIn(700);
							$('.pagenation-wrapper-IU').fadeIn(700);	
					});
			}
		}
	return false;
});
$(document).on('change','#IU-filtermoves',function(){
	if($('#IU-filteruser').val().length!=0 || $('#IU-filtermoves').val()!='0' || $('#IU-filtercats').val()!='0'){
	valChange = $('.sel-page-wrap-opt-IU').val();
	$('.pagenation-wrapper-IU').hide();
		IUdata = $('#IU-mainfilter').serialize();
		IUdata += '&limit='+valChange;
				ClearStartIUlogs();
							$.getJSON( "ajax/cusotomize/ajax/ajax_filter.php",IUdata, function( data2 ) {
								
								BuildPagi_IU(IUdata)
								$('.lst-log-btu').hide();
							/*$('.brd-tbl-users').hide();
							$('.log-system').show();*/			
								//setTimeout(function(){ 
									OutLogs (data2);
									$('.lst-log-btu').fadeIn(700);
									$('.pagenation-wrapper-IU').fadeIn(700);
								//}, 200);
								$('.rzlt-search-login').html('');
								
								$.each( data2, function( key2, val2 ) {
									$('.rzlt-search-login').html(val2.login_search);
								});
								
							});
	}else{
		ClearStartIUlogs();
		$('.pagenation-wrapper-IU').hide();
		
			$('.rzlt-search-login').html('');
				$.getJSON( "ajax/cusotomize/ajax/ajax_login_list_logs.php",{limit:valChange}, function( data2 ) {	
					BuildPagi_IU(false);
					$('.lst-log-btu').hide();
						OutLogs (data2);
						$('.lst-log-btu').fadeIn(700);
						$('.pagenation-wrapper-IU').fadeIn(700);
						$('.link-hidden-IU-logs').show();	
				});
	}
});
$(document).on('change','#IU-filtercats',function(){
	if($('#IU-filteruser').val().length!=0 || $('#IU-filtermoves').val()!='0' || $('#IU-filtercats').val()!='0'){
	valChange = $('.sel-page-wrap-opt-IU').val();
		$('.pagenation-wrapper-IU').hide();	
		IUdata = $('#IU-mainfilter').serialize();
		IUdata += '&limit='+valChange;
				ClearStartIUlogs();
							$.getJSON( "ajax/cusotomize/ajax/ajax_filter.php",IUdata, function( data2 ) {
													
							BuildPagi_IU(IUdata);
								$('.lst-log-btu').hide();
							/*$('.brd-tbl-users').hide();
							$('.log-system').show();*/			
								//setTimeout(function(){ 
									OutLogs (data2);
									$('.lst-log-btu').fadeIn(700);
									$('.pagenation-wrapper-IU').fadeIn(700);
								//}, 200);
								$('.rzlt-search-login').html('');
								
								$.each( data2, function( key2, val2 ) {
									$('.rzlt-search-login').html(val2.login_search);
								});
								
							});
	}else{
		ClearStartIUlogs();
		$('.pagenation-wrapper-IU').hide();		
			$('.rzlt-search-login').html('');
				$.getJSON( "ajax/cusotomize/ajax/ajax_login_list_logs.php",{limit:valChange}, function( data2 ) {
					BuildPagi_IU(false);				
					$('.lst-log-btu').hide();
						OutLogs (data2);
						$('.lst-log-btu').fadeIn(700);
						$('.pagenation-wrapper-IU').fadeIn(700);	
				});
	}
});
function BuildPagi_IU(data_request){
	valChange = $('.sel-page-wrap-opt-IU').val();
	limit = valChange;
	$('.pagenation-wrapper-IU').html('');
	$.getJSON( "ajax/cusotomize/ajax/ajax_list_numb.php",data_request, function( data ) {	
		$.each( data, function( key, val ) {
			summRows = val;
		});
		GetThelast = Math.ceil(summRows/limit);

		if(GetThelast > 1){
			$('.pagenation-wrapper-IU').html('<div class="header-pagi">Страницы:</div><div class="placeforpagination-IU"><ul> <li id="start-pagi-first-IU"></li> </ul> <div style="clear:both"></div></div>');
			

			 for(i=1;i<=GetThelast;i++){
				nobrdBpg = '';
				firstnode = '';
					if(i == 1){firstnode = ' activePagi'}
					if(GetThelast == i){nobrdBpg = 'style="border-right:0;"';}				
					$('#start-pagi-first-IU').before('<li><a '+nobrdBpg+' data-pagi="'+i+'" class="pagi-block'+firstnode+'" href="javascript:void(0);">'+i+'</a></li>');			
		 }		
		}
	});
}
$(document).on('change','.sel-page-wrap-opt-IU',function(){
	valChange = $(this).val();
	if($('#IU-filteruser').val().length!=0 || $('#IU-filtercats').val()!='0' || $('#IU-filtermoves').val()!='0'){

		IUdata = $('#IU-mainfilter').serialize();
		IUdata += '&limit='+valChange;

		ClearStartIUlogs();
				$('.pagenation-wrapper-IU').hide();	
							$.getJSON( "ajax/cusotomize/ajax/ajax_filter.php",IUdata, function( data2 ) {
							$('.pagenation-wrapper-IU').hide();
							BuildPagi_IU(IUdata);
								$('.lst-log-btu').hide();
							/*$('.brd-tbl-users').hide();
							$('.log-system').show();*/			
								//setTimeout(function(){ 
									OutLogs (data2);
									$('.lst-log-btu').fadeIn(500);
									$('.pagenation-wrapper-IU').fadeIn(500);
								//}, 200);
								$('.rzlt-search-login').html('');
								
								$.each( data2, function( key2, val2 ) {
									$('.rzlt-search-login').html(val2.login_search);
								});
								
							});
	}else{
		BuildPagi_IU(false)
			ClearStartIUlogs();
				$('.pagenation-wrapper-IU').hide();	
				$('.rzlt-search-login').html('');
					$.getJSON( "ajax/cusotomize/ajax/ajax_login_list_logs.php",{limit:valChange}, function( data2 ) {	
						$('.lst-log-btu').hide();
							OutLogs (data2);
							$('.lst-log-btu').fadeIn(500);
							$('.pagenation-wrapper-IU').fadeIn(500);
					});	
	}
});
$(document).on('click','.placeforpagination-IU a',function(){
	up();
	valChange = $('.sel-page-wrap-opt-IU').val();
	valPagi = $(this).attr('data-pagi');
	
	if($('#IU-filteruser').val().length!=0 || $('#IU-filtercats').val()!='0' || $('#IU-filtermoves').val()!='0'){
		IUdata = $('#IU-mainfilter').serialize();
		IUdata += '&pagi='+valPagi+'&limit='+valChange;

				ClearStartIUlogs();
				$('.pagenation-wrapper-IU').hide();	
							$.getJSON( "ajax/cusotomize/ajax/ajax_filter.php",IUdata, function( data2 ) {
								$('.lst-log-btu').hide();
							/*$('.brd-tbl-users').hide();
							$('.log-system').show();*/			
								//setTimeout(function(){ 
									OutLogs (data2);
									$('.lst-log-btu').fadeIn(500);
									$('.pagenation-wrapper-IU').fadeIn(500);
								//}, 200);
								$('.rzlt-search-login').html('');
								
								$.each( data2, function( key2, val2 ) {
									$('.rzlt-search-login').html(val2.login_search);
								});
								
							});
	}else{
	//alert(valPagi);
		ClearStartIUlogs();
			$('.pagenation-wrapper-IU').hide();	
			$('.rzlt-search-login').html('');
				$.getJSON( "ajax/cusotomize/ajax/ajax_login_list_logs.php",{pagi:valPagi,limit:valChange}, function( data2 ) {	
					$('.lst-log-btu').hide();
						OutLogs (data2);
						$('.lst-log-btu').fadeIn(500);
						$('.pagenation-wrapper-IU').fadeIn(500);
				});	
	}	
});

/*$(document).on('submit','#GroupManager',function(){
	FormData = $('#GroupManager').serialize();
		$.getJSON( "ajax/cusotomize/ajax/ajax_dbGrp.php",{FormData}, function( data2 ) {
				ClearStartIUlogs();
				OutLogs (data2);
				//alert(countU);
				if(countU < 5){$('#logsbtnlister').hide();}else{$('#logsbtnlister').show();}
				if(countU == 0){alert('Этот пользователь действий не совершал');}
		});
	return false;
});*/

function ClearStartGrp(){
	$('.lst-brd-grp').html('<li class="rowmaingrp startOutGrp"></li>');
}	
function OutGroups (data){
	$.each( data, function( key, val ) {
	if(val.oper_create_post == 1){ val.oper_create_post = '•' }else{ val.oper_create_post = '';}
	if(val.oper_view_post == 1){ val.oper_view_post = '•' }else{ val.oper_view_post = '';}
	if(val.oper_correct_post == 1){ val.oper_correct_post = '•' }else{ val.oper_correct_post = '';}
	if(val.oper_create_forw == 1){ val.oper_create_forw = '•' }else{ val.oper_create_forw = '';}
	if(val.oper_view_forw == 1){ val.oper_view_forw = '•' }else{ val.oper_view_forw = '';}
	if(val.oper_correct_forw == 1){ val.oper_correct_forw = '•' }else{ val.oper_correct_forw = '';}
		$('.startOutGrp').before('<li class="row-container-grp grpidin'+val.level_id+'"> <div class="rowmaingrp first-row-grp">'+val.level_id+'</div> <div class="rowmaingrp second-row-grp">'+val.level_name+'</div> <div class="rowmaingrp second_2-row-grp">'+val.komment_group+'</div> <div class="rowmaingrp sixth-row-grp"> <a style="float:right;margin-right: 7px;" data-grpid="'+val.level_id+'" class="cor-grp" href="javascript:void(0);"><i class="fa fa-wrench"></i></a> <div style="clear:both"></div> </div> <div style="clear:both"></div> </li>');
	});	
};
/*function OutGroups (data){
	$.each( data, function( key, val ) {
	if(val.oper_create_post == 1){ val.oper_create_post = '•' }else{ val.oper_create_post = '';}
	if(val.oper_view_post == 1){ val.oper_view_post = '•' }else{ val.oper_view_post = '';}
	if(val.oper_correct_post == 1){ val.oper_correct_post = '•' }else{ val.oper_correct_post = '';}
	if(val.oper_create_forw == 1){ val.oper_create_forw = '•' }else{ val.oper_create_forw = '';}
	if(val.oper_view_forw == 1){ val.oper_view_forw = '•' }else{ val.oper_view_forw = '';}
	if(val.oper_correct_forw == 1){ val.oper_correct_forw = '•' }else{ val.oper_correct_forw = '';}
		$('.startOutGrp').before('<li class="row-container-grp grpidin'+val.level_id+'"> <div class="rowmaingrp first-row-grp">'+val.level_id+'</div> <div class="rowmaingrp second-row-grp">'+val.level_name+'</div> <div class="rowmaingrp second_2-row-grp">'+val.oper_create_post+'</div> <div class="rowmaingrp fourth-row-grp">'+val.oper_view_post+'</div> <div class="rowmaingrp fifth-row-grp">'+val.oper_correct_post+'</div> <div class="rowmaingrp six-row-grp">'+val.oper_create_forw+'</div> <div class="rowmaingrp seven-row-grp">'+val.oper_view_forw+'</div> <div class="rowmaingrp eight-row-grp">'+val.oper_correct_forw+'</div> <div class="rowmaingrp sixth-row-grp"> <a style="float:right;margin-right: 7px;" data-grpid="'+val.level_id+'" class="cor-grp" href="javascript:void(0);"><i class="fa fa-wrench"></i></a> <div style="clear:both"></div> </div> <div style="clear:both"></div> </li>');
	});	
};*/


/*
COMPANY --- ZONE - - -
-------------------------*/
prefixForm = 'comp_';

$(document).on('click','#create_department',function(){
	dataVal = $(this).attr("data-comp-id");
    $.fancybox({
        //maxWidth    : 713,
            minHeight   : 250,
            fitToView   : false,
            autoSize    : true,
            autoScale   : true,
            openEffect  : 'none',
			openSpeed : 1, helpers : { overlay : { locked: false } },			
            closeEffect : 'none',
            scrolling   : false,
            padding     : 0,
        href: 'ajax/company/form_department/form_builder.php?id='+dataVal,
        type: 'ajax'
    });	
});
prefixForm = 'loca_';

$(document).on('click','#create_location',function(){
    $.fancybox({
        //maxWidth    : 713,
            minHeight   : 250,
            fitToView   : false,
            autoSize    : true,
            autoScale   : true,
            openEffect  : 'none',
			openSpeed : 1,	helpers : { overlay : { locked: false } },		
            closeEffect : 'none',
            scrolling   : false,
            padding     : 0,
        href: 'ajax/company/form_location/form_builder.php',
        type: 'ajax'
    });	
});
prefixForm = 'grps_';

$(document).on('click','#create_grps',function(){
	dataComp = $(this).attr("data-comp-id");
	dataDep = $(this).attr("data-dep-id");
    $.fancybox({
        //maxWidth    : 713,
            minHeight   : 250,
            fitToView   : false,
            autoSize    : true,
            autoScale   : true,
            openEffect  : 'none',
			openSpeed : 1, helpers : { overlay : { locked: false } },			
            closeEffect : 'none',
            scrolling   : false,
            padding     : 0,
        href: 'ajax/company/form_grps/form_builder.php?comp='+dataComp+'&dep='+dataDep,
        type: 'ajax'
    });	
});


/*-Staff
--------------------------------------------
*/

$(document).on('click','#eyetracking',function(){
staff_id = $(this).parent().attr('data-staffid');
    $.fancybox({
        maxWidth    : 913,
            minHeight   : 250,
            fitToView   : false,
            autoSize    : true,
            autoScale   : true,
            openEffect  : 'none',
			openSpeed : 1,			
            closeEffect : 'none',
            scrolling   : false,
            padding     : 0,
        href: 'itdept/stable/ajax/userlist/form_user/form_eyetraking.php?id='+staff_id,
        type: 'ajax'
    });	
});

$(document).on('click','#staff_trasher',function(){
staff_id = $(this).parent().attr('data-staffid');
    $.fancybox({
        maxWidth    : 913,
            minHeight   : 250,
            fitToView   : false,
            autoSize    : true,
            autoScale   : true,
            openEffect  : 'none',
			openSpeed : 1,			
            closeEffect : 'none',
            scrolling   : false,
            padding     : 0,
        href: 'itdept/stable/ajax/userlist/form_user/form_trasher.php?id='+staff_id,
        type: 'ajax'
    });	
});

$(document).on('click','#staff_corusr',function(){
staff_id = $(this).parent().attr('data-staffid');
    $.fancybox({
        maxWidth    : 913,
            minHeight   : 250,
            fitToView   : false,
            autoSize    : true,
            autoScale   : true,
            openEffect  : 'none',
			openSpeed : 1,			
            closeEffect : 'none',
            scrolling   : false,
            padding     : 0,
        href: 'itdept/stable/ajax/userlist/form_user/cor/form_corstaff.php?id='+staff_id,
        type: 'ajax'
    });	
});


function OutTable (page){
prefix = 'staff_';
$('#'+prefix+'table').hide();
	$.ajax({
	  dataType: "json",
	  url: 'itdept/stable/ajax/userlist/form_user/ajax_lists.php',
	  data: {pagi : page},
	  type: 'POST',
	  success: function(data){
	  $('#'+prefix+'table').html('<ul><li id="'+prefix+'start"></li></ul>');
		$.each( data, function( keying, val ) {
		 //console.log(val.level_id);
			$('#'+prefix+'start').before('<li class="'+prefix+'row-container '+prefix+'idin'+val.staff_id+'"> <div class="'+prefix+'rowmain '+prefix+'first-row"><div class="'+prefix+'paddingrow">'+val.staff_id+'</div></div> <div class="'+prefix+'rowmain '+prefix+'second-row"><div class="'+prefix+'paddingrow"><img src="http://infoline.bioline.ru/images/comprofiler/'+val.staff_avatar+'" style="width:100px;"><div class="'+prefix+'username"><b>'+val.staff_lastname+' '+val.staff_name+' '+val.staff_secondname+'</b></div><div class="'+prefix+'userpost">'+val.staff_post+'</div><div class="'+prefix+'mobphone">'+val.staff_mobnumber+'</div><div class="'+prefix+'atsphone">'+val.staff_ats+'</div></div></div> <div class="'+prefix+'rowmain '+prefix+'third-row"><div class="'+prefix+'paddingrow">'+val.staff_company_id+'</div></div> <div class="'+prefix+'rowmain '+prefix+'fourth-row"><div class="'+prefix+'paddingrow"><div class="'+prefix+'userdepart">'+val.staff_depart_id+'</div><div class="'+prefix+'usergroup">'+val.staff_group_id+'</div></div></div> <div class="'+prefix+'rowmain '+prefix+'ninth-row"> <a style="float:right;margin-right: 7px;" data-'+prefix+'id="'+val.level_id+'" class="'+prefix+'del-event delbtn" href="javascript:void(0);"><i class="fa fa-trash-o"></i></a> <a style="float:right;margin-right: 7px;" data-'+prefix+'id="'+val.level_id+'" class="'+prefix+'cor-event corbtn" href="javascript:void(0);"><i class="fa fa-wrench"></i></a> <div style="clear:both"></div> </div> <div style="clear:both"></div> </li>');
		});
		$('#'+prefix+'table').fadeIn(600);
	  }
	  
	});
};



function staffBuildPagi(data_request,SearchType,SearchData,valComp_filt,valDep_filt,valLoca_filt){
prefix = "staff_";
//alert('123');
//-- getting VALUE from field
	valChange = $('.'+prefix+'sel-page-wrap-opt').val();
//--END GETTING val
	limit = valChange;

	$('.'+prefix+'pagenation-wrapper').hide();
	$('.'+prefix+'pagenation-wrapper').html('');
	$.getJSON( "itdept/stable/ajax/userlist/form_user/ajax_list_numb.php",{typePage: data_request, staff_option : SearchType, staff_search : SearchData, valComp_filt : valComp_filt, valDep_filt : valDep_filt, valLoca_filt : valLoca_filt}, function( data ) {	
		$.each( data, function( key, val ) {
			summRows = val;
		});
		GetThelast = Math.ceil(summRows/limit);

		if(GetThelast > 1){
			$('.staff_pagenation-wrapper').html('<div class="header-pagi">Страницы:</div><div class="'+prefix+'placeforpagination"><ul> <li id="'+prefix+'start-pagi-first"></li> </ul> <div style="clear:both"></div></div>');
			

			 for(i=1;i<=GetThelast;i++){
				nobrdBpg = '';
				firstnode = '';
					if(i == 1){firstnode = ' activePagi'}
					if(GetThelast == i){nobrdBpg = 'style="border-right:0;"';}				
					$('#'+prefix+'start-pagi-first').before('<li><a '+nobrdBpg+' data-pagi="'+i+'" class="'+prefix+'pagi-block'+firstnode+'" href="javascript:void(0);">'+i+'</a></li>');			
		 }		
		}
		
		$.ajax({
		  dataType: "json",
		  url: 'itdept/stable/ajax/userlist/form_user/conter_summ.php',
		  type: 'POST',
		  success: function(data2){
			console.log(data2);
			$.each( data2, function( keying2, valing2 ) {			
					//alert(valing.all);
					console.log(valing2.all)
					$('#all-numb-summ').attr("data-max-summ",valing2.all);
					$('#waiting-numb-summ').attr("data-max-summ",valing2.waiting);
					$('#deactive-numb-summ').attr("data-max-summ",valing2.deactive);
					$('#active-numb-summ').attr("data-max-summ",valing2.active);
					
		
					activeMaxSumm = $('#active-numb-summ').attr("data-max-summ");
					deactiveMaxSumm = $('#deactive-numb-summ').attr("data-max-summ");
					waitingMaxSumm = $('#waiting-numb-summ').attr("data-max-summ");
					allMaxSumm = $('#all-numb-summ').attr("data-max-summ");
					
					switch(data_request){
						case '3': $('#all-numb-summ').html('('+allMaxSumm+')');$('#deactive-numb-summ').html('('+deactiveMaxSumm+')');$('#active-numb-summ').html('('+activeMaxSumm+')');$('#waiting-numb-summ').html('('+waitingMaxSumm+')');$('#all-numb-summ').html('('+summRows+')');if(summRows==0 || allMaxSumm==0){$('#all-numb-summ').html('');}
							break;
						case '2': $('#all-numb-summ').html('('+allMaxSumm+')');$('#deactive-numb-summ').html('('+deactiveMaxSumm+')');$('#active-numb-summ').html('('+activeMaxSumm+')');$('#waiting-numb-summ').html('('+waitingMaxSumm+')');$('#deactive-numb-summ').html('('+summRows+')');if(summRows==0 || deactiveMaxSumm==0){$('#deactive-numb-summ').html('');}
							break;
						case '1': $('#all-numb-summ').html('('+allMaxSumm+')');$('#deactive-numb-summ').html('('+deactiveMaxSumm+')');$('#active-numb-summ').html('('+activeMaxSumm+')');$('#waiting-numb-summ').html('('+waitingMaxSumm+')');$('#active-numb-summ').html('('+summRows+')');if(summRows==0 || activeMaxSumm==0){$('#active-numb-summ').html('');}
							break;
						case '0': $('#all-numb-summ').html('('+allMaxSumm+')');$('#deactive-numb-summ').html('('+deactiveMaxSumm+')');$('#active-numb-summ').html('('+activeMaxSumm+')');$('#waiting-numb-summ').html('('+waitingMaxSumm+')');$('#waiting-numb-summ').html('('+summRows+')');if(summRows==0 || waitingMaxSumm==0){$('#waiting-numb-summ').html('');}
							break;
					}
					if(allMaxSumm==0){$('#all-numb-summ').html('');}
					if(deactiveMaxSumm==0){$('#deactive-numb-summ').html('');}
					if(activeMaxSumm==0){$('#active-numb-summ').html('');}
					if(waitingMaxSumm==0){$('#waiting-numb-summ').html('');}
				});
			}
		});	
	});
	//$('.'+prefix+'pagenation-wrapper').fadeIn(1200);
}
prefix = 'staff_';
$(document).on('change','.'+prefix+'sel-page-wrap-opt',function(){
	valChange = $(this).val();
	valStatus = $('#stats-staff').val();
valComp_filt = $('#'+prefix+'comp-list').val();
valDep_filt = $('#'+prefix+'dep-list').val();
valLoca_filt = $('#'+prefix+'loca-list').val();	

	OutBlocks(1,valChange,valStatus,'','',valComp_filt,valDep_filt,valLoca_filt);
	staffBuildPagi(valStatus,'','')
});
$(document).on('change','#'+prefix+'comp-list',function(){
valChange = $('.'+prefix+'sel-page-wrap-opt').val();
valStatus = $('#stats-staff').val();
valComp_filt = $('#'+prefix+'comp-list').val();
valLoca_filt = $('#'+prefix+'loca-list').val();

	$.ajax({
		dataType: "HTML",
		url: 'itdept/stable/ajax/userlist/form_user/depbuildfilt.php',
		data: {compId : valComp_filt},
		type: 'POST',
		success: function(data){
			$('#staff_dep-list').html(data);
		}
	});

$('#'+prefix+'searchinp').val('');
valDep_filt = '0';

	OutBlocks(1,valChange,valStatus,'','',valComp_filt,valDep_filt,valLoca_filt);
	staffBuildPagi(valStatus,'','',valComp_filt,valDep_filt,valLoca_filt)
});
$(document).on('change','#'+prefix+'dep-list',function(){
valChange = $('.'+prefix+'sel-page-wrap-opt').val();
valStatus = $('#stats-staff').val();
valComp_filt = $('#'+prefix+'comp-list').val();
valDep_filt = $('#'+prefix+'dep-list').val();
valLoca_filt = $('#'+prefix+'loca-list').val();

$('#'+prefix+'searchinp').val('');

	OutBlocks(1,valChange,valStatus,'','',valComp_filt,valDep_filt,valLoca_filt);
	staffBuildPagi(valStatus,'','',valComp_filt,valDep_filt,valLoca_filt)
});
$(document).on('change','#'+prefix+'loca-list',function(){
valChange = $('.'+prefix+'sel-page-wrap-opt').val();
valStatus = $('#stats-staff').val();
valComp_filt = $('#'+prefix+'comp-list').val();
valDep_filt = $('#'+prefix+'dep-list').val();
valLoca_filt = $('#'+prefix+'loca-list').val();

$('#'+prefix+'searchinp').val('');

	OutBlocks(1,valChange,valStatus,'','',valComp_filt,valDep_filt,valLoca_filt);
	staffBuildPagi(valStatus,'','',valComp_filt,valDep_filt,valLoca_filt)
});
$(document).on('click','.'+prefix+'placeforpagination a',function(){
	$('.'+prefix+'pagenation-wrapper').hide();
	up();
	valChange = $('.'+prefix+'sel-page-wrap-opt').val();
	valPagi = $(this).attr('data-pagi');
	valStatus = $('#stats-staff').val();
	valSearchType = $('#staff_paramsearch').val();
	valSearchData = $('#staff_searchinp').val();	
	valComp_filt = $('#'+prefix+'comp-list').val();
	valDep_filt = $('#'+prefix+'dep-list').val();
	valLoca_filt = $('#'+prefix+'loca-list').val();
	
	OutBlocks(valPagi,valChange,valStatus,valSearchType,valSearchData,valComp_filt,valDep_filt,valLoca_filt);
	//staffBuildPagi(1);
		$('.'+prefix+'pagi-block').removeClass('activePagi');
		$(this).addClass('activePagi');
});
$(document).on('click','.'+prefix+'statuscheck',function(){
	$('.'+prefix+'statuscheck').removeClass(prefix+'activeShowElPage');
	$(this).addClass(prefix+'activeShowElPage');
	valStats = $(this).attr('data-stats');
	valStatus = $('#stats-staff').val(valStats);
	valSearchType = $('#staff_paramsearch').val();	
	valSearchData = $('#staff_searchinp').val();		
	valComp_filt = $('#'+prefix+'comp-list').val();
	valDep_filt = $('#'+prefix+'dep-list').val();
	valLoca_filt = $('#'+prefix+'loca-list').val();	
	
	if(valComp_filt != '0' || valDep_filt != '0' || valLoca_filt != '0'){
		$('#'+prefix+'comp-list option[value="0"]').prop('selected', true);
		$('#'+prefix+'dep-list option[value="0"]').prop('selected', true);
		$('#'+prefix+'loca-list option[value="0"]').prop('selected', true);	
		 valComp_filt = 0;
		 valDep_filt = 0;
		 valLoca_filt = 0;	
	}
	
	//alert(valStatus);
	OutBlocks(1,valChange,valStats,valSearchType,valSearchData,valComp_filt,valDep_filt,valLoca_filt);
	staffBuildPagi(valStats,valSearchType,valSearchData,valComp_filt,valDep_filt,valLoca_filt)	
});
$(document).on('keyup','#staff_searchinp',function(){
//-default Params
valChange = $('.'+prefix+'sel-page-wrap-opt').val();
valStatus = $('#stats-staff').val();
valSearchType = $('#staff_paramsearch').val();
valSearchData = $('#staff_searchinp').val();
	 $('#'+prefix+'comp-list option[value="0"]').prop('selected', true);
	 $('#'+prefix+'dep-list option[value="0"]').prop('selected', true);
	 $('#'+prefix+'loca-list option[value="0"]').prop('selected', true);
	 valComp_filt = 0;
	 valDep_filt = 0;
	 valLoca_filt = 0;


OutBlocks(1,valChange,valStatus,valSearchType,valSearchData,valComp_filt,valDep_filt,valLoca_filt);
staffBuildPagi(valStatus,valSearchType,valSearchData,valComp_filt,valDep_filt,valLoca_filt);
	//console.log(valSearchData);
});
function actstaff (staff_id){
//-default Params
valChange = $('.'+prefix+'sel-page-wrap-opt').val();
valStatus = $('#stats-staff').val();
valSearchType = $('#staff_paramsearch').val();
valSearchData = $('#staff_searchinp').val();
valComp_filt = $('#'+prefix+'comp-list').val();
valDep_filt = $('#'+prefix+'dep-list').val();
valLoca_filt = $('#'+prefix+'loca-list').val();	
	$.ajax({
		dataType: "HTML",
		url: 'itdept/stable/ajax/userlist/form_user/ajax_db_active.php',
		data: {staff_id : staff_id},
		type: 'POST',
		success: function(){
			$.fancybox({ closeClick  : true});
			OutBlocks(1,valChange,valStatus,valSearchType,valSearchData,valComp_filt,valDep_filt,valLoca_filt);
			staffBuildPagi(valStatus,valSearchType,valSearchData,valComp_filt,valDep_filt,valLoca_filt);
		}
	});
}
$(document).on('submit','#deact-user',function(){
valChange = $('.'+prefix+'sel-page-wrap-opt').val();
valStatus = $('#stats-staff').val();
valSearchType = $('#staff_paramsearch').val();
valSearchData = $('#staff_searchinp').val();
valComp_filt = $('#'+prefix+'comp-list').val();
valDep_filt = $('#'+prefix+'dep-list').val();
valLoca_filt = $('#'+prefix+'loca-list').val();	
	dataForm = $(this).serialize();
	$.ajax({
		dataType: "HTML",
		url: 'itdept/stable/ajax/userlist/form_user/ajax_db_deactivate.php',
		data: dataForm,
		type: 'POST',
		success: function(){
			$.fancybox({ closeClick  : true});
			OutBlocks(1,valChange,valStatus,valSearchType,valSearchData,valComp_filt,valDep_filt,valLoca_filt);
			staffBuildPagi(valStatus,valSearchType,valSearchData,valComp_filt,valDep_filt,valLoca_filt);
		}
	});
	return false;
});
function showlistIU(dataParam){
status = $('#btn-'+dataParam).attr('data-status');
	if(status == 'closed'){
		$('#btn-'+dataParam).text('Скрыть...');
		$('#show_'+dataParam).html('<div id="show_'+dataParam+'_inner"></div>');
			$.ajax({
				dataType: "JSON",
				url: 'ajax/company/form_'+dataParam+'/ajax_list.php',
				type: 'POST',
				success: function(data){
					//$('#show_'+dataParam).html(data);
					$.each( data, function( keying, val ) {
						$('#show_'+dataParam+'_table').show();
						switch(dataParam){
						case 'location':
							$('#show_'+dataParam+'_inner').before('<div class="cover-tbl-row"><div class="pers-mark-tbl-'+dataParam+' mark-tbl-'+dataParam+'-1">'+val.location_id+'</div><div class="pers-mark-tbl-'+dataParam+' mark-tbl-'+dataParam+'-2">'+val.location_name+'</div><div data-id_f="'+val.location_id+'" class="pers-mark-tbl-'+dataParam+' mark-tbl-'+dataParam+'-3"><a class="corr-btn-tbl" id="cor-'+dataParam+'-field" href="javascript:void(0)" style="margin-right:7px;"><i class="fa fa-wrench"></i></a><a class="del-btn-tbl redbtn" id="del-'+dataParam+'-field" href="javascript:void(0)"><i class="fa fa-trash-o"></i></a></div><div style="clear:both"></div></div>');
							break;
						case 'department':
							$('#show_'+dataParam+'_inner').before('<div class="cover-tbl-row"><div class="pers-mark-tbl-'+dataParam+' mark-tbl-'+dataParam+'-1">'+val.department_id+'</div><div class="pers-mark-tbl-'+dataParam+' mark-tbl-'+dataParam+'-4"><div class="right-padding-tbl">'+val.company_name+'</div></div><div class="pers-mark-tbl-'+dataParam+' mark-tbl-'+dataParam+'-2"><div class="right-padding-tbl">'+val.department_name+'</div></div><div data-id_f="'+val.department_id+'" class="pers-mark-tbl-'+dataParam+' mark-tbl-'+dataParam+'-3"><a class="corr-btn-tbl" id="cor-'+dataParam+'-field" href="javascript:void(0)" style="margin-right:7px;"><i class="fa fa-wrench"></i></a><a class="del-btn-tbl redbtn" id="del-'+dataParam+'-field" href="javascript:void(0)"><i class="fa fa-trash-o"></i></a></div><div style="clear:both"></div></div>');
							break;
						case 'grps':
							$('#show_'+dataParam+'_inner').before('<div class="cover-tbl-row"><div class="pers-mark-tbl-'+dataParam+' mark-tbl-'+dataParam+'-1">'+val.gr_id+'</div><div class="pers-mark-tbl-'+dataParam+' mark-tbl-'+dataParam+'-4"><div class="right-padding-tbl">'+val.department_name+'</div></div><div class="pers-mark-tbl-'+dataParam+' mark-tbl-'+dataParam+'-2"><div class="right-padding-tbl">'+val.group_name+'</div></div><div data-id_f="'+val.gr_id+'" class="pers-mark-tbl-'+dataParam+' mark-tbl-'+dataParam+'-3"><a class="corr-btn-tbl" id="cor-'+dataParam+'-field" href="javascript:void(0)" style="margin-right:7px;"><i class="fa fa-wrench"></i></a><a class="del-btn-tbl redbtn" id="del-'+dataParam+'-field" href="javascript:void(0)"><i class="fa fa-trash-o"></i></a></div><div style="clear:both"></div></div>');
							break;
						}
					});
					$('#btn-'+dataParam).attr('data-status','opened');
				}
			});	
	}else{
		$('#show_'+dataParam+'_table').hide();
		$('#show_'+dataParam).html('');
		$('#btn-'+dataParam).attr('data-status','closed');
		$('#btn-'+dataParam).text('Показать...');
		up();
	}
}
pref_comp = 'department';
$(document).on('click','#cor-'+pref_comp+'-field',function(){
	dataId = $(this).parent().attr('data-id_f');
    $.fancybox({
        //width: 800,
        maxWidth    : 713,
            minHeight   : 250,
            fitToView   : false,
            autoSize    : true,
            autoScale   : true,
            openEffect  : 'none',
			openSpeed 	: 1, helpers : { overlay : { locked: false } },	
            closeEffect : 'none',
            scrolling   : false,
            padding     : 0,
			//speedIn: 99999,
        href: 'ajax/company/form_'+pref_comp+'/ajax_corr_comp.php?id='+dataId,
        type: 'ajax'
    });	
});

$(document).on('submit','#form-sb-'+pref_comp+'-cor',function(){
	dataSubm = $(this).serialize();
	dataFld = $('#fld-dep-department-cor').val().length;
	dataDep  = $('#fld-comp-department-cor').val();
	
	if(dataFld == 0){
		$('#fld-dep-department-cor').css({'border-color':'#c11'});
	}else{
	//alert(dataSubm);
		$.ajax({
			dataType: "HTML",
			url: 'ajax/company/form_'+pref_comp+'/ajax_subm_corr.php',
			type: 'POST',
			data: dataSubm, 
			success: function(){
					//$.fancybox({ closeClick  : true});
					$('#mistakeIUform').remove();
					$('.bluebtn').before('<div id="mistakeIUform" style="background: #090;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;margin-bottom:15px;">Группа успешно изменена</div>');
					pref = pref_comp;
					compId = dataDep;
					$.ajax({
						dataType: "HTML",
						url: 'ajax/company/form_'+pref+'/ajax_list_tree.php',
						data: {compId : compId},
						type: 'POST',
						success: function(data){
							$('#'+pref+'_nodeId'+compId+' .ajax_nodes').html(data);
						}
					});
			}
		});
	}
	return false;
});
$(document).on('click','#fld-dep-department-cor',function(){
	$('#fld-dep-department-cor').css({'border-color':'#ccc'});
});
$(document).on('keyup','#fld-dep-department-cor',function(){
	$('#fld-dep-department-cor').css({'border-color':'#ccc'});
});
$(document).on('click','#del-'+pref_comp+'-field',function(){
	dataId = $(this).parent().attr('data-id_f');
    $.fancybox({
        //width: 800,
        maxWidth    : 713,
            minHeight   : 250,
            fitToView   : false,
            autoSize    : true,
            autoScale   : true,
            openEffect  : 'none',
			openSpeed 	: 1, helpers : { overlay : { locked: false } },	
            closeEffect : 'none',
            scrolling   : false,
            padding     : 0,
			//speedIn: 99999,
        href: 'ajax/company/form_'+pref_comp+'/ajax_del_comp.php?id='+dataId,
        type: 'ajax'
    });	
});
$(document).on('submit','#form-sb-'+pref_comp+'-del',function(){
	dataSubm = $(this).serialize();
	dataDel = $("#del-comp-id").val();
	//alert(dataSubm);
		$.ajax({
			dataType: "HTML",
			url: 'ajax/company/form_'+pref_comp+'/ajax_subm_del.php',
			type: 'POST',
			data: dataSubm, 
			success: function(){
					$.fancybox({ closeClick  : true});
					pref = pref_comp;
					compId = dataDel;
					$.ajax({
						dataType: "HTML",
						url: 'ajax/company/form_'+pref+'/ajax_list_tree.php',
						data: {compId : compId},
						type: 'POST',
						success: function(data){
							$('#'+pref+'_nodeId'+compId+' .ajax_nodes').html(data);
						}
					});
			}
		});
	return false;
});


pref_comp2 = 'location';
$(document).on('click','#cor-'+pref_comp2+'-field',function(){
	dataId = $(this).parent().attr('data-id_f');
    $.fancybox({
        //width: 800,
        maxWidth    : 713,
            minHeight   : 250,
            fitToView   : false,
            autoSize    : true,
            autoScale   : true,
            openEffect  : 'none',
			openSpeed 	: 1, helpers : { overlay : { locked: false } },			
            closeEffect : 'none',
            scrolling   : false,
            padding     : 0,
			//speedIn: 99999,
        href: 'ajax/company/form_'+pref_comp2+'/ajax_corr_comp.php?id='+dataId,
        type: 'ajax'
    });	
});
$(document).on('submit','#form-sb-'+pref_comp2+'-cor',function(){
	dataSubm = $(this).serialize();
	//alert(dataSubm);
		$.ajax({
			dataType: "HTML",
			url: 'ajax/company/form_'+pref_comp2+'/ajax_subm_corr.php',
			type: 'POST',
			data: dataSubm, 
			success: function(){
					//$.fancybox({ closeClick  : true});
					$('#mistakeIUform').remove();
					$('.bluebtn').before('<div id="mistakeIUform" style="background: #090;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;margin-bottom:15px;">Группа успешно изменена</div>');
					$('.link-hidden-IU').hide();
					$('.link-hidden-IU-logs').hide();
					$('#maiApplication').css({'padding':'0px'});
					$('html').css({'min-height':'initial'});
					$('body').css({'min-height':'initial'});
					

						//$(this).addClass('activeMenu');
						$('.datacont').hide();
						$('.ajaxcont').show();

						$('.root-icon-iu-sidebarmenu,.IU-brance-link').removeClass('IU-active');
						$('.IU-company-btn').addClass('IU-active');

						//$('html').css({'overflow-y':'scroll'});			

							$('.brd-tbl-users').hide();
								$('.log-system').hide();			

								$.ajax({
								  url: "ajax/company/form_location/show_tabs.php",
								  success: function(data){
										$('#innercontainerIU').html(data);	
										$('#innercontainerIU').show();		
										$('.top-tabs-comp').removeClass('active-comp-menu');
										$('#actme_location').addClass('active-comp-menu');						
									}
								});
			}
		});
	return false;
});

$(document).on('click','#del-'+pref_comp2+'-field',function(){
	dataId = $(this).parent().attr('data-id_f');
    $.fancybox({
        //width: 800,
        maxWidth    : 713,
            minHeight   : 250,
            fitToView   : false,
            autoSize    : true,
            autoScale   : true,
            openEffect  : 'none',
			openSpeed 	: 1, helpers : { overlay : { locked: false } },		
            closeEffect : 'none',
            scrolling   : false,
            padding     : 0,
			//speedIn: 99999,
        href: 'ajax/company/form_'+pref_comp2+'/ajax_del_comp.php?id='+dataId,
        type: 'ajax'
    });	
});
$(document).on('submit','#form-sb-'+pref_comp2+'-del',function(){
	dataSubm = $(this).serialize();
	//alert(dataSubm);
		$.ajax({
			dataType: "HTML",
			url: 'ajax/company/form_'+pref_comp2+'/ajax_subm_del.php',
			type: 'POST',
			data: dataSubm, 
			success: function(){
					$.fancybox({ closeClick  : true});
					$('.link-hidden-IU').hide();
					$('.link-hidden-IU-logs').hide();
					$('#maiApplication').css({'padding':'0px'});
					$('html').css({'min-height':'initial'});
					$('body').css({'min-height':'initial'});
					

						//$(this).addClass('activeMenu');
						$('.datacont').hide();
						$('.ajaxcont').show();

						$('.root-icon-iu-sidebarmenu,.IU-brance-link').removeClass('IU-active');
						$('.IU-company-btn').addClass('IU-active');

						//$('html').css({'overflow-y':'scroll'});			

							$('.brd-tbl-users').hide();
								$('.log-system').hide();			

								$.ajax({
								  url: "ajax/company/form_location/show_tabs.php",
								  success: function(data){
										$('#innercontainerIU').html(data);	
										$('#innercontainerIU').show();		
										$('.top-tabs-comp').removeClass('active-comp-menu');
										$('#actme_location').addClass('active-comp-menu');						
									}
								});	
			}
		});
	return false;
});



pref_comp3 = 'grps';
$(document).on('click','#cor-'+pref_comp3+'-field',function(){
	dataId = $(this).parent().parent().attr('data-id_f');
    $.fancybox({
        //width: 800,
        maxWidth    : 713,
            minHeight   : 250,
            fitToView   : false,
            autoSize    : true,
            autoScale   : true,
            openEffect  : 'none',
			openSpeed 	: 1, helpers : { overlay : { locked: false } },		
            closeEffect : 'none',
            scrolling   : false,
            padding     : 0,
			//speedIn: 99999,
        href: 'ajax/company/form_'+pref_comp3+'/ajax_corr_comp.php?id='+dataId,
        type: 'ajax'
    });	
});

$(document).on('click','#del-'+pref_comp3+'-field',function(){
	dataId = $(this).parent().parent().attr('data-id_f');
    $.fancybox({
        //width: 800,
        maxWidth    : 713,
            minHeight   : 250,
            fitToView   : false,
            autoSize    : true,
            autoScale   : true,
            openEffect  : 'none',
			openSpeed 	: 1, helpers : { overlay : { locked: false } },		
            closeEffect : 'none',
            scrolling   : false,
            padding     : 0,
			//speedIn: 99999,
        href: 'ajax/company/form_'+pref_comp3+'/ajax_del_comp.php?id='+dataId,
        type: 'ajax'
    });	
});
$(document).on('submit','#form-sb-'+pref_comp3+'-cor',function(){
	dataSubm = $(this).serialize();
	//alert(dataSubm);
	
	dataVal = $('#cor-dep-list').val();
	dataInp = $('#cor-grps-inp-list').val().length;
	//dataDep = $('#cor-dep-list').val();
	if(dataVal == 0){ 
		$('#cor-dep-list').css({'border-color':'#c11'});
	}		
	if(dataInp == 0){ 
		$('#cor-grps-inp-list').css({'border-color':'#c11'});
	}		
	if(dataVal == 0 || dataInp==0){
		//null
	}else{
		$.ajax({
			dataType: "HTML",
			url: 'ajax/company/form_'+pref_comp3+'/ajax_subm_corr.php',
			type: 'POST',
			data: dataSubm, 
			success: function(){
					//$.fancybox({ closeClick  : true});
					$('#mistakeIUform').remove();
					$('.bluebtn').before('<div id="mistakeIUform" style="background: #090;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;margin-bottom:15px;">Группа успешно изменена</div>');
					pref = pref_comp3;
					compId = dataVal;
					$.ajax({
						dataType: "HTML",
						url: 'ajax/company/form_'+pref+'/ajax_list_tree.php',
						data: {compId : compId},
						type: 'POST',
						success: function(data){
							$('#'+pref+'_nodeId'+compId+' .ajax_nodes').html(data);
						}
					});
			}
		});
	}
	return false;
});
$(document).on('click','#cor-dep-list',function(){
	$(this).css({'border-color':'#ccc'});
});
$(document).on('click','#cor-grps-inp-list',function(){
	$(this).css({'border-color':'#ccc'});
});
$(document).on('keyup','#cor-grps-inp-list',function(){
	$(this).css({'border-color':'#ccc'});
});
$(document).on('submit','#form-sb-'+pref_comp3+'-del',function(){
	dataSubm = $(this).serialize();
	dataDelDep = $("#dep-id-real-dep-grps").val();
		
	//alert(dataSubm);
		$.ajax({
			dataType: "HTML",
			url: 'ajax/company/form_'+pref_comp3+'/ajax_subm_del.php',
			type: 'POST',
			data: dataSubm, 
			success: function(){
					$.fancybox({ closeClick  : true});
					pref = pref_comp3;
					compId = dataDelDep;
					$.ajax({
						dataType: "HTML",
						url: 'ajax/company/form_'+pref+'/ajax_list_tree.php',
						data: {compId : compId},
						type: 'POST',
						success: function(data){
							$('#'+pref+'_nodeId'+compId+' .ajax_nodes').html(data);
						}
					});
			}
		});

	

	return false;
});
$(document).on('change','#comp_corr-list',function(){
	dataVal = $(this).val();
	$.ajax({
		dataType: "HTML",
		url: 'itdept/stable/ajax/userlist/form_user/depbuildfilt.php',
		data: {compId : dataVal},
		type: 'POST',
		success: function(data){
			$('#cor-dep-list').html(data);
			$('#cor-grp-list').html('<option value="0">-- Группа --</option>');
		}
	});
});
$(document).on('change','#cor-dep-list',function(){
	$(this).css({'border-color':'#ccc'});
	dataVal = $(this).val();
	$.ajax({
		dataType: "HTML",
		url: 'itdept/stable/ajax/userlist/form_user/groupfilt.php',
		data: {depId : dataVal},
		type: 'POST',
		success: function(data){
			$('#cor-grp-list').html(data);
		}
	});	
});
$(document).on('change','#profile-take-cor',function(){
	dataVal = $(this).val();
	if(dataVal == 0){
		$('#cor_name,#cor_sername').removeAttr('disabled');
		$('#cor_name,#cor_sername').css({'opacity':'1'});
	}else{		
		$('#cor_name,#cor_sername').attr('disabled',true);
		$('#cor_name,#cor_sername').css({'opacity':'0.5'});
	}
});
$(document).on('change','#profile-create',function(){
	dataVal = $(this).val();
	if(dataVal == 0){
		$('#field_name,#field_Lname').removeAttr('disabled');
		$('#field_name,#field_Lname').css({'opacity':'1'});
	}else{		
		$('#field_name,#field_Lname').attr('disabled',true);
		$('#field_name,#field_Lname').css({'opacity':'0.5','border-color':'#ccc'});
	}
});
function putNodes(compId,pref){
	if(!$('#'+pref+'_nodeId'+compId+'>.ajax_nodes').hasClass('opendNode')){		
		$('#'+pref+'_nodeId'+compId+'>.node-basic-tree>.text-node-tree>.plus-node-tree').html('-');
		$('#'+pref+'_nodeId'+compId+'>.node-basic-tree>.text-node-tree>.plus-node-tree').addClass('linh-node-minus');
		$('#'+pref+'_nodeId'+compId+'>.ajax_nodes').addClass('opendNode');
		//--Ajax
			$.ajax({
				dataType: "HTML",
				url: 'ajax/company/form_'+pref+'/ajax_list_tree.php',
				data: {compId : compId},
				type: 'POST',
				success: function(data){
					$('#'+pref+'_nodeId'+compId+' .ajax_nodes').html(data);
				}
			});
	}else{
		$('#'+pref+'_nodeId'+compId+'>.ajax_nodes').html('');
		$('#'+pref+'_nodeId'+compId+'>.ajax_nodes').removeClass('opendNode');
		$('#'+pref+'_nodeId'+compId+'>.node-basic-tree>.text-node-tree>.plus-node-tree').html('+');
		$('#'+pref+'_nodeId'+compId+'>.node-basic-tree>.text-node-tree>.plus-node-tree').removeClass('linh-node-minus');
	}
	console.log('123')
}
$(document).on('submit','#form-sb-gprs-cor',function(){
	dataVal = $('#cor-dep-list').val();
	if(dataVal == 0){
		$('#cor-dep-list').css({'border-color':'#c11'});
	}else{
		
	}
});
function showTabs(param){

	$('.link-hidden-IU').hide();
	$('.link-hidden-IU-logs').hide();
	$('#maiApplication').css({'padding':'0px'});
	$('html').css({'min-height':'initial'});
	$('body').css({'min-height':'initial'});
	up();

		//$(this).addClass('activeMenu');
		$('.datacont').hide();
		$('.ajaxcont').show();

		$('.root-icon-iu-sidebarmenu,.IU-brance-link').removeClass('IU-active');
		$('.IU-company-btn').addClass('IU-active');

		//$('html').css({'overflow-y':'scroll'});			

			$('.brd-tbl-users').hide();
				$('.log-system').hide();			

				$.ajax({
				  url: "ajax/company/form_"+param+"/show_tabs.php",
				  success: function(data){
						$('#innercontainerIU').html(data);	
						$('#innercontainerIU').show();		
						$('.top-tabs-comp').removeClass('active-comp-menu');
						$('#actme_'+param).addClass('active-comp-menu');						
					}
				});		
	
	}
$(document).on('change','#ipLocation',function(){
	dataLoc = $(this).val();
	drawTable('ip','','',dataLoc);
	$.ajax({
		url: "ajax/documents/ip/ajax/ip_subnetwork.php",
		data: {loc : dataLoc},
		type: 'POST',
		success: function(data){
			$('#ipFreeIp').html(data);
		}
	});
})
$(document).on('submit','#field-add-Ip',function(){
	dataForm = $(this).serialize();
	alert(dataForm);
	return false;
});
$(document).on('change','#staff_chair',function(){
	showMoreMails ();
});
$(document).on('change','#staff_table_for',function(){
	showMoreMails ();
});
$(document).on('change','#staff_concelar',function(){
	showMoreMails ();
	/*$('#show-other-mails-stf').hide();
	if($('#staff_concelar').is(':checked')){
		$('#show-other-mails-stf').show();
		mailStf += '<b>reception1@bioilne.ru</b>'
		$('#place-for-new-adres-stf').html(mailStf);
	}else{
		//$('#show-other-mails-stf').hide();
	}*/
});
function showMoreMails (){
	mail1 = '<b>kodenuk@bioline.ru</b>';
	mail2 = '<b>reception1@bioilne.ru, reception2@bioline.ru</b>';

	$('#show-other-mails-stf').hide();
	if($('#staff_chair').is(':checked') || $('#staff_table_for').is(':checked') || $('#staff_concelar').is(':checked')){
		$('#show-other-mails-stf').show();
	}
		if($('#staff_concelar').is(':checked') && $('#staff_table_for').is(':checked') && $('#staff_chair').is(':checked')){
		$('#place-for-new-adres-stf').html(mail1+', '+mail2);
	}
	 if(!$('#staff_concelar').is(':checked') && $('#staff_table_for').is(':checked') && $('#staff_chair').is(':checked')){
		$('#place-for-new-adres-stf').html(mail1);
	}
	if($('#staff_concelar').is(':checked') && !$('#staff_table_for').is(':checked') && !$('#staff_chair').is(':checked')){
		$('#place-for-new-adres-stf').html(mail2);
	}
	if($('#staff_concelar').is(':checked') && !$('#staff_table_for').is(':checked') && $('#staff_chair').is(':checked')){
		$('#place-for-new-adres-stf').html(mail1+', '+mail2);
	}
	if($('#staff_concelar').is(':checked') && $('#staff_table_for').is(':checked') && !$('#staff_chair').is(':checked')){
		$('#place-for-new-adres-stf').html(mail1+', '+mail2);
	}
	if(!$('#staff_concelar').is(':checked') && $('#staff_table_for').is(':checked') && $('#staff_chair').is(':checked')){
		$('#place-for-new-adres-stf').html(mail1);
	}
	if(!$('#staff_concelar').is(':checked') && !$('#staff_table_for').is(':checked') && $('#staff_chair').is(':checked')){
		$('#place-for-new-adres-stf').html(mail1);
	}
	if(!$('#staff_concelar').is(':checked') && $('#staff_table_for').is(':checked') && !$('#staff_chair').is(':checked')){
		$('#place-for-new-adres-stf').html(mail1);
	}
}