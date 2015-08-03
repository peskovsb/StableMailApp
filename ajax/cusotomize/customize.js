//--Validating FORM


$(document).on('blur','#field_inner_login',function(){
	$.getJSON( "ajax/cusotomize/ajax/ajax_login_validate_cs.php", $('#FormCreateInnerUser').serialize(), function( data ) {

		$.each( data, function( keying, valing ) {
			//console.log(valing);
			
			if(valing.login.mistakeIU == 'mistake'){
				$('#field_inner_login').css({'border-color':'#c11'});
				$('#mistakeIUform').remove();
				$('.lastfld').after('<tr id="mistakeIUform"><td colspan="2"><div style="background: #c11;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width:311px;">'+valing.login.msg+'</div></td></tr>');
			}else{
				if($('#field_inner_login').val().length>0){
					$('#field_inner_login').next().fadeIn(200);
				}else{
					$('#field_inner_login').next().hide();
				}
			}		
		});
	});
});
$(document).on('blur','#field_inner_pass',function(){
	$.getJSON( "ajax/cusotomize/ajax/ajax_login_validate_cs.php", $('#FormCreateInnerUser').serialize(), function( data ) {

		$.each( data, function( keying, valing ) {
			if(valing.pass.mistakeIU == 'mistake'){
				$('#field_inner_pass').css({'border-color':'#c11'});
				$('#mistakeIUform').remove();
				$('.lastfld').after('<tr id="mistakeIUform"><td colspan="2"><div style="background: #c11;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width:311px;">'+valing.pass.msg+'</div></td></tr>');
			}else{
				if($('#field_inner_pass').val().length>0){
					$('#field_inner_pass').next().fadeIn(200);
				}else{
					$('#field_inner_pass').next().hide();
				}
			}	
		});
	});			
});
$(document).on('blur','#field_inner_surname',function(){
	$.getJSON( "ajax/cusotomize/ajax/ajax_login_validate_cs.php", $('#FormCreateInnerUser').serialize(), function( data ) {

		$.each( data, function( keying, valing ) {
			if(valing.last.mistakeIU == 'mistake'){
				$('#field_inner_surname').css({'border-color':'#c11'});
				$('#mistakeIUform').remove();
				$('.lastfld').after('<tr id="mistakeIUform"><td colspan="2"><div style="background: #c11;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width:311px;">'+valing.last.msg+'</div></td></tr>');
			}else{
				if($('#field_inner_surname').val().length>0){
					$('#field_inner_surname').next().fadeIn(200);
				}else{
					$('#field_inner_surname').next().hide();
				}
			}	
		});
	});			
});
$(document).on('blur','#field_inner_name',function(){
	$.getJSON( "ajax/cusotomize/ajax/ajax_login_validate_cs.php", $('#FormCreateInnerUser').serialize(), function( data ) {
		
		$.each( data, function( keying, valing ) {
			if(valing.first.mistakeIU == 'mistake'){
				$('#field_inner_name').css({'border-color':'#c11'});
				$('#mistakeIUform').remove();
				$('.lastfld').after('<tr id="mistakeIUform"><td colspan="2"><div style="background: #c11;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width:311px;">'+valing.first.msg+'</div></td></tr>');
			}else{
				if($('#field_inner_name').val().length>0){
					$('#field_inner_name').next().fadeIn(200);
				}else{
					$('#field_inner_name').next().hide();
				}
			}	
		});
	});			
});


//--Final Send
$(document).on('submit','#FormCreateInnerUser',function(){

		mistake = 0;

	$.getJSON( "ajax/cusotomize/ajax/ajax_login_validate.php", $('#FormCreateInnerUser').serialize(), function( data ) {

		$.each( data, function( keying, valing ) {
			//console.log(valing);
			
			if(valing.login.mistakeIU == 'mistake'){
				$('#field_inner_login').css({'border-color':'#c11'});
				$('#mistakeIUform').remove();
				$('.lastfld').after('<tr id="mistakeIUform"><td colspan="2"><div style="background: #c11;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width:311px;">'+valing.login.msg+'</div></td></tr>');
				mistake = 1;
				$('#field_inner_login').next().hide();
			}else{
				$('#field_inner_login').next().fadeIn(200);
			}	
			if(valing.pass.mistakeIU == 'mistake'){
				$('#field_inner_pass').css({'border-color':'#c11'});
				$('#mistakeIUform').remove();
				$('.lastfld').after('<tr id="mistakeIUform"><td colspan="2"><div style="background: #c11;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width:311px;">'+valing.pass.msg+'</div></td></tr>');
				mistake = 1;
				$('#field_inner_pass').next().hide();
			}else{
				$('#field_inner_pass').next().fadeIn(200);
			}	
			if(valing.last.mistakeIU == 'mistake'){
				$('#field_inner_surname').css({'border-color':'#c11'});
				$('#mistakeIUform').remove();
				$('.lastfld').after('<tr id="mistakeIUform"><td colspan="2"><div style="background: #c11;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width:311px;">'+valing.last.msg+'</div></td></tr>');
				mistake = 1;
				$('#field_inner_surname').next().hide();
			}else{
				$('#field_inner_surname').next().fadeIn(200);
			}	
			if(valing.first.mistakeIU == 'mistake'){
				$('#field_inner_name').css({'border-color':'#c11'});
				$('#mistakeIUform').remove();
				$('.lastfld').after('<tr id="mistakeIUform"><td colspan="2"><div style="background: #c11;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width:311px;">'+valing.first.msg+'</div></td></tr>');
				mistake = 1;
				$('#field_inner_name').next().hide();
			}else{
				$('#field_inner_name').next().fadeIn(200);
			}	
			if(valing.level.mistakeIU == 'mistake'){
				$('#field_inner_list').css({'border-color':'#c11'});
				$('#mistakeIUform').remove();
				$('.lastfld').after('<tr id="mistakeIUform"><td colspan="2"><div style="background: #c11;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width:311px;">'+valing.level.msg+'</div></td></tr>');
				mistake = 1;
				$('#field_inner_list').next().hide();
			}else{
				$('#field_inner_list').next().fadeIn(200);
			}	
		});
			if(mistake != 1){
				$.ajax({
				dataType: "HTML",
				data: $('#FormCreateInnerUser').serialize(),
				type: "GET",
				url : "ajax/cusotomize/ajax/ajax_login_dbwrite.php",
					success : function (data) {
						console.log(data);
						
							$('.btnarea').after('<tr id="successIUform"><td colspan="2"><div style="border:1px solid #eee;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width:311px;">'+data+'</div></td></tr>');	
							
							//--refreshing table
							$.getJSON( "ajax/cusotomize/ajax/ajax_login_list.php", function( data2 ) {
								ClearStartIU();
								OutUsers (data2)
							});								
					}
				});
			}		
	});
	return false;
});

/*function OutUsers (data){

levelArr = [];
levelArr[1] = 'admin';
levelArr[2] = 'users';

	$.each( data, function( key, val ) {
		$('.startOutUsers').before('<li class="row-container-btu usridin'+val.user_id+'"><div data-userlogs="'+val.user_id+'" class="user-loging-showclick"></div> <div class="rowmainstl first-row-btu">'+val.user_id+'</div> <div class="rowmainstl second-row-btu">'+val.user_login+'</div> <div class="rowmainstl third-row-btu"><a data-userid="'+val.user_id+'" class="passchange" href="javascript:void(0);">Изменить</a></div> <div class="rowmainstl fourth-row-btu">'+levelArr[val.user_level]+'</div> <div class="rowmainstl fifth-row-btu">'+val.user_surname+' '+val.user_name+'</div> <div class="rowmainstl sixth-row-btu"> <a data-userid="'+val.user_id+'" class="cor-iu" href="javascript:void(0);"><i class="fa fa-wrench"></i></a> <a data-userid="'+val.user_id+'" class="del-iu"  href="javascript:void(0);"><i class="fa fa-trash-o"></i></a> <div style="clear:both"></div> </div> <div style="clear:both"></div> </li>');
	});
	
	UserLogs = $('#logsbtnlister').attr('data-userlogs');
	$('.usridin'+UserLogs).addClass('activeloguser');
	
};*/

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


function sblk(iduser){
	$('#'+iduser+'blockidiu').show();
}

//-- Click Out Of Obj user
$(document).mouseup(function (e){
	if (!$('.usernamerez').is(e.target) && $('.usernamerez').has(e.target).length === 0) {
		$('.usernamerez').html('');
	}
});

function ClearStartIU(){
	$('.lst-brd-btu').html('<li class="row-container-btu startOutUsers"></li>');
}

function ClearStartIUlogs(){
	$('.lst-log-btu').html('<li class="row-container-btu startOutLogs"></li>');
}

$(document).on('click','.field-tpl',function(){
	$(this).css({'border-color':'#ccc'});
});
$(document).on('click','#field_inner_list',function(){
	$(this).css({'border-color':'#ccc'});
});
$(document).on('keydown','#field_inner_pass',function(){
	if($('#field_inner_pass').val().length>=0){
		$('#mistakeIUform').remove();
		$('#field_inner_pass').next().hide();
	}
});
$(document).on('keydown','#field_inner_login',function(){
	if($('#field_inner_login').val().length>=0){
		$('#mistakeIUform').remove();
		$('#field_inner_login').next().hide();
	}
});
$(document).on('keydown','#field_inner_surname',function(){
	if($('#field_inner_surname').val().length>=0){
		$('#mistakeIUform').remove();
		$('#field_inner_surname').next().hide();
	}
});
$(document).on('keydown','#field_inner_name',function(){
	if($('#field_inner_name').val().length>=0){
		$('#mistakeIUform').remove();
		$('#field_inner_name').next().hide();
	}
});
$(document).on('change','.super-fire-list',function(){
		$('#mistakeIUform').remove();
		//$('#field_inner_login').next().hide();
	if($('#field_inner_list').val() != '1'){
		$('.super-fire-list').next().fadeIn(200);
	}else{
		$('.super-fire-list').next().hide();
	}
});

$(document).on('click','.del-iu',function(){
	userId = $(this).attr('data-userid');
	//alert(userId);
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
        href: 'ajax/cusotomize/ajax/ajax_del.php?delParam='+userId,
        type: 'ajax'
    });	
});

function funcDelUserIE(userId){
	//$('.fancybox-item')click();

		$.ajax({
		dataType: "HTML",
		data: {finDel : userId},
		type: "GET",
		url : "ajax/cusotomize/ajax/ajax_fin_del.php",
			success : function (data) {
				$.fancybox({ closeClick  : true});
				
					//--Changing btn-show-all
					$('.link-hidden-IU-close').attr('class','link-hidden-IU');
					$('.link-hidden-IU').text('Показать еще...');
					up();					
					
					//--refreshing table
					$.getJSON( "ajax/cusotomize/ajax/ajax_login_list.php", function( data2 ) {
						ClearStartIU();
						OutUsers (data2)
					});							
			}
		});	

	return false;
}

$(document).on('click','.cor-iu,.passchange',function(){
	ThisUserCorId = $(this).attr('data-userid');
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
        href: 'ajax/cusotomize/ajax/ajax_correct_user.php?corrParam='+ThisUserCorId,
        type: 'ajax'
    });	
});

$(document).on('click','.cor-grp',function(){
	ThisGrprId = $(this).attr('data-grpid');
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
        href: 'ajax/cusotomize/ajax/ajax_corGrp.php?data-grpid='+ThisGrprId,
        type: 'ajax'
    });	
});

$(document).on('click','.btn-chngpass',function(){
	$('#cor_changepass_IU').show();
	$('#pasIUgenerator').show();
	$(this).hide();
});

//--Validating Correction Form
$(document).on('blur','#cor_login_IU',function(){
	$.getJSON( "ajax/cusotomize/ajax/ajax_login_validate_corr.php", $('#IU_CorrForm').serialize(), function( data ) {

		$.each( data, function( keying, valing ) {
			//console.log(valing);
			
			if(valing.login.mistakeIU == 'mistake'){
				$('#cor_login_IU').css({'border-color':'#c11'});
				$('#mistakeIUform').remove();
				$('.lastfld').after('<tr id="mistakeIUform"><td colspan="2"><div style="background: #c11;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width:311px;">'+valing.login.msg+'</div></td></tr>');
			}	
		});
	});
});
$(document).on('blur','#cor_changepass_IU',function(){
	$.getJSON( "ajax/cusotomize/ajax/ajax_login_validate_corr.php", $('#IU_CorrForm').serialize(), function( data ) {

		$.each( data, function( keying, valing ) {
			//console.log(valing);
			
			if(valing.pass.mistakeIU == 'mistake'){
				$('#cor_changepass_IU').css({'border-color':'#c11'});
				$('#mistakeIUform').remove();
				$('.lastfld').after('<tr id="mistakeIUform"><td colspan="2"><div style="background: #c11;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width:311px;">'+valing.pass.msg+'</div></td></tr>');
			}	
		});
	});
});

$(document).on('blur','#cor_name_IU',function(){
	$.getJSON( "ajax/cusotomize/ajax/ajax_login_validate_corr.php", $('#IU_CorrForm').serialize(), function( data ) {
		
		$.each( data, function( keying, valing ) {
			if(valing.first.mistakeIU == 'mistake'){
				$('#cor_name_IU').css({'border-color':'#c11'});
				$('#mistakeIUform').remove();
				$('.lastfld').after('<tr id="mistakeIUform"><td colspan="2"><div style="background: #c11;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width:311px;">'+valing.first.msg+'</div></td></tr>');
			}	
		});
	});			
});

$(document).on('blur','#cor_sername_IU',function(){
	$.getJSON( "ajax/cusotomize/ajax/ajax_login_validate_corr.php", $('#IU_CorrForm').serialize(), function( data ) {
		
		$.each( data, function( keying, valing ) {
			if(valing.last.mistakeIU == 'mistake'){
				$('#cor_sername_IU').css({'border-color':'#c11'});
				$('#mistakeIUform').remove();
				$('.lastfld').after('<tr id="mistakeIUform"><td colspan="2"><div style="background: #c11;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width:311px;">'+valing.last.msg+'</div></td></tr>');
			}	
		});
	});			
});
$(document).on('keydown','#cor_login_IU',function(){
	if($('#cor_login_IU').val().length>=0){
		$('#mistakeIUform').remove();
	}
});
$(document).on('keydown','#cor_changepass_IU',function(){
	if($('#cor_changepass_IU').val().length>=0){
		$('#mistakeIUform').remove();
	}
});
$(document).on('keydown','#cor_sername_IU',function(){
	if($('#cor_changepass_IU').val().length>=0){
		$('#mistakeIUform').remove();
	}
});
$(document).on('keydown','#cor_name_IU',function(){
	if($('#cor_changepass_IU').val().length>=0){
		$('#mistakeIUform').remove();
	}
});

$(document).on('submit','#IU_CorrForm',function(){

		mistake = 0;

	$.getJSON( "ajax/cusotomize/ajax/ajax_login_validate_corr_subm.php", $('#IU_CorrForm').serialize(), function( data ) {

		$.each( data, function( keying, valing ) {
			if(valing.login.mistakeIU == 'mistake'){
				$('#cor_login_IU').css({'border-color':'#c11'});
				$('#mistakeIUform').remove();
				$('.lastfld').after('<tr id="mistakeIUform"><td colspan="2"><div style="background: #c11;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width:311px;">'+valing.login.msg+'</div></td></tr>');
				mistake = 1;
			}
			if(valing.pass.mistakeIU == 'mistake'){
				$('#cor_changepass_IU').css({'border-color':'#c11'});
				$('#mistakeIUform').remove();
				$('.lastfld').after('<tr id="mistakeIUform"><td colspan="2"><div style="background: #c11;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width:311px;">'+valing.pass.msg+'</div></td></tr>');
				mistake = 1;
			}
			if(valing.first.mistakeIU == 'mistake'){
				$('#cor_name_IU').css({'border-color':'#c11'});
				$('#mistakeIUform').remove();
				$('.lastfld').after('<tr id="mistakeIUform"><td colspan="2"><div style="background: #c11;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width:311px;">'+valing.first.msg+'</div></td></tr>');
				mistake = 1;
			}
			if(valing.last.mistakeIU == 'mistake'){
				$('#cor_sername_IU').css({'border-color':'#c11'});
				$('#mistakeIUform').remove();
				$('.lastfld').after('<tr id="mistakeIUform"><td colspan="2"><div style="background: #c11;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width:311px;">'+valing.last.msg+'</div></td></tr>');
				mistake = 1;
			}
			if(mistake != 1){
				$.ajax({
				dataType: "HTML",
				data: $('#IU_CorrForm').serialize(),
				type: "GET",
				url : "ajax/cusotomize/ajax/ajax_login_dbcorr.php",
					success : function (data) {
						console.log(data);
							$('#mistakeIUform').remove();
							$('.lastfld').after('<tr id="mistakeIUform"><td colspan="2"><div style="background: #090;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width:311px;">Изменения внесены успешно</div></td></tr>');
							
							//--refreshing table
							
							if($('#usersinnner-btn').hasClass('link-hidden-IU')){
								$.getJSON( "ajax/cusotomize/ajax/ajax_login_list.php", function( data2 ) {
									ClearStartIU();
									OutUsers (data2)
								});	
							}	
							if($('#usersinnner-btn').hasClass('link-hidden-IU-close')){
								$.getJSON( "ajax/cusotomize/ajax/ajax_login_list.php",{showalllist:'yes'}, function( data2 ) {
									ClearStartIU();
									OutUsers (data2)
								});	
							}							
					}
				});
			}			
		});
	});
return false;	
});


$(document).on('click','.user-loging-showclick',function(){
	$('.user-loging-showclick').parent().removeClass('activeloguser');
	$(this).parent().addClass('activeloguser');
		$('.link-hidden-IU-logs-close').attr('class','link-hidden-IU-logs');
		//$('.link-hidden-IU-logs').hide();
		ThisUserIdIU = $(this).attr('data-userlogs');
		$('.link-hidden-IU-logs').attr('data-userlogs',ThisUserIdIU);
		$.getJSON( "ajax/cusotomize/ajax/ajax_login_list_logs.php",{userid:ThisUserIdIU}, function( data2 ) {
				ClearStartIUlogs();
				OutLogs (data2);
				//alert(countU);
				if(countU < 5){$('#logsbtnlister').hide();}else{$('#logsbtnlister').show();}
				if(countU == 0){alert('Этот пользователь действий не совершал');}
		});
		$('.link-hidden-IU-logs').text('Показать еще...');
		//$('.link-hidden-IU-logs').show();
});


$(document).on('click','.IU-showlistmenu',function(){
	$('.sidebarinner').hide();
	$('.IU-sidebar').stop(true).queue('fx', 
	  function(){
		$(this).animate({'width':'250px','margin-left':'-250px'},350,'easeOutQuart', function() { $('.sidebarinner2').fadeIn(200); } ).dequeue('fx');						
	});	
	$('.IU-layout').stop(true).queue('fx', 
	  function(){
		$(this).animate({'padding-left':'250px'},350,'easeOutQuart').dequeue('fx');						
	});	
});
$(document).on('click','.IU-closeicons',function(){
	$('.sidebarinner2').hide();
	$('.IU-sidebar').stop(true).queue('fx', 
	  function(){
		$(this).animate({'width':'50px','margin-left':'-50px'},350,'easeOutQuart', function() { $('.sidebarinner').fadeIn(200); } ).dequeue('fx');						
	});	
	$('.IU-layout').stop(true).queue('fx', 
	  function(){
		$(this).animate({'padding-left':'50px'},350,'easeOutQuart').dequeue('fx');						
	});	
});


$(document).on('blur','#nameGroup',function(){
	$.getJSON( "ajax/cusotomize/ajax/ajax_dbGrp_cs.php", $('#GroupManager').serialize(), function( data ) {

		$.each( data, function( keying, valing ) {
			//console.log(valing);
			
			if(valing.level.mistakeIU == 'mistake'){
				$('#nameGroup').css({'border-color':'#c11'});
				$('#mistakeIUform').remove();
				$('.wrapper-groups-tbl').after('<div id="mistakeIUform" style="background: #c11;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;margin-bottom:15px;">'+valing.level.msg+'</div>');
			}		
		});
	});
});

$(document).on('blur','#nameGroup',function(){
	$.getJSON( "ajax/cusotomize/ajax/ajax_dbGrp_cs_cor.php", $('#CorGroupManager').serialize(), function( data ) {

		$.each( data, function( keying, valing ) {
			//console.log(valing);
			
			if(valing.level.mistakeIU == 'mistake'){
				$('#nameGroup').css({'border-color':'#c11'});
				$('#mistakeIUform').remove();
				$('.wrapper-groups-tbl').after('<div id="mistakeIUform" style="background: #c11;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;margin-bottom:15px;">'+valing.level.msg+'</div>');
			}		
		});
	});
});

$(document).on('keydown','#nameGroup',function(){
	if($('#nameGroup').val().length>=0){
		$('#mistakeIUform').remove();
		$(this).css({'border-color': '#ccc'});
	}
});

$(document).on('submit','#GroupManager',function(){
	FormData = $('#GroupManager').serialize();
	$('#mistakeIUform').remove();
	mistake = 0;
	
	//alert(FormData);
		$.getJSON( "ajax/cusotomize/ajax/ajax_dbGrp.php",FormData,function( data ){
		
			$.each( data, function( keying, valing ) {
				if(valing.level.mistakeIU == 'mistake'){
					$('#nameGroup').css({'border-color':'#c11'});
					$('#mistakeIUform').remove();
					$('.wrapper-groups-tbl').after('<div id="mistakeIUform" style="background: #c11;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;margin-bottom:15px;">'+valing.level.msg+'</div>');
					mistake = 1;
				}
				if(valing.view.mistakeIU == 'mistake'){
					$('#mistakeIUform').remove();
					$('.wrapper-groups-tbl').after('<div id="mistakeIUform" style="background: #c11;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;margin-bottom:15px;">'+valing.view.msg+'</div>');
					mistake = 1;
				}
			});
			if(mistake != 1){
				$.ajax({
				dataType: "HTML",
				data: $('#GroupManager').serialize(),
				type: "GET",
				url : "ajax/cusotomize/ajax/ajax_group_write.php",
					success : function (data) {
						//-- Refreshing Data
						$.getJSON( "ajax/cusotomize/ajax/ajax_login_list_grp.php", function( data ) {
						ClearStartGrp();
								OutGroups(data);
								$('.link-hidden-IU').show();
						});
						$('#mistakeIUform').remove();
						$('.wrapper-groups-tbl').after('<div id="mistakeIUform" style="background: #090;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;margin-bottom:15px;">Группа успешно создана</div>');
							/*$('#mistakeIUform').remove();
							$('.lastfld').after('<tr id="mistakeIUform"><td colspan="2"><div style="background: #090;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width:311px;">Изменения внесены успешно</div></td></tr>');
							
							
							
							if($('#usersinnner-btn').hasClass('link-hidden-IU')){
								$.getJSON( "ajax/cusotomize/ajax/ajax_login_list.php", function( data2 ) {
									ClearStartIU();
									OutUsers (data2)
								});	
							}	
							if($('#usersinnner-btn').hasClass('link-hidden-IU-close')){
								$.getJSON( "ajax/cusotomize/ajax/ajax_login_list.php",{showalllist:'yes'}, function( data2 ) {
									ClearStartIU();
									OutUsers (data2)
								});	
							}	*/						
					}
				});
			}			
		});
		//-- Refreshing Data
		/*$.getJSON( "ajax/cusotomize/ajax/ajax_login_list_grp.php", function( data ) {
		ClearStartGrp();
				OutGroups(data);
				$('.link-hidden-IU').show();
		});*/	
	return false;
});
$(document).on('submit','#CorGroupManager',function(){
	FormData = $('#CorGroupManager').serialize();
	$('#mistakeIUform').remove();
	mistake = 0;

		$.getJSON( "ajax/cusotomize/ajax/ajax_dbGrp_cor.php",FormData,function( data ){
		
			$.each( data, function( keying, valing ) {
				if(valing.level.mistakeIU == 'mistake'){
					$('#nameGroup').css({'border-color':'#c11'});
					$('#mistakeIUform').remove();
					$('.wrapper-groups-tbl').after('<div id="mistakeIUform" style="background: #c11;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;margin-bottom:15px;">'+valing.level.msg+'</div>');
					mistake = 1;
				}
				if(valing.view.mistakeIU == 'mistake'){
					$('#mistakeIUform').remove();
					$('.wrapper-groups-tbl').after('<div id="mistakeIUform" style="background: #c11;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;margin-bottom:15px;">'+valing.view.msg+'</div>');
					mistake = 1;
				}
			});
			if(mistake != 1){
				$.ajax({
				dataType: "HTML",
				data: $('#CorGroupManager').serialize(),
				type: "GET",
				url : "ajax/cusotomize/ajax/ajax_group_correct.php",
					success : function (data) {
						//-- Refreshing Data
						$.getJSON( "ajax/cusotomize/ajax/ajax_login_list_grp.php", function( data ) {
						ClearStartGrp();
								OutGroups(data);
								$('.link-hidden-IU').show();
						});
						$('#mistakeIUform').remove();
						$('.wrapper-groups-tbl').after('<div id="mistakeIUform" style="background: #090;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;margin-bottom:15px;">Группа успешно изменена</div>');				
					}
				});
			}			
		});
	
	return false;
});