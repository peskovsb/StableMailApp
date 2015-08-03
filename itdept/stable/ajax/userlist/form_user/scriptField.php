<script type="text/javascript">
<?foreach($arrayForm as $keyScript => $arItems){
		switch($arItems['name']){
			case $prefix.'location':
				break;
			case $prefix.'executive':
				break;
			case $prefix.'motiv':
				break;
			case $prefix.'one_c':
				break;
			case $prefix.'notebook':
				break;
			case $prefix.'mobphone':
				break;
			case $prefix.'company':
				break;	
			case $prefix.'location':
				break;
			case $prefix.'itletter':
				break;	
			case $prefix.'department':
				break;	
			case $prefix.'upass':?>
			$(document).on('blur','#<?=$arItems['name']?>',function(){
				$.ajax({
				  dataType: "json",
				  url: 'itdept/stable/ajax/userlist/form_user/ajax_form_validate_cs.php',
				  data: $('#<?=$formName?>').serialize(),
				  type: 'POST',
				  success: function(data){
					console.log(data);
					$.each( data, function( keying, valing ) {
						if(valing.<?=$keyScript?>.mistakeIU == 'mistake'){
							$('#<?=$arItems['name']?>').css({'border-color':'#c11'});
							$('#mistakeIUform').remove();
							$('.btnarea').before('<tr id="mistakeIUform"><td colspan="2"><div style="background: #c11;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width:311px;">'+valing.<?=$keyScript?>.msg+'</div></td></tr>');
						}else{
							if($('#<?=$arItems['name']?>').val().length>0){
								$('#pass-exelent').fadeIn(200);
								//-- Success Data
								$.ajax({
								  url: 'itdept/stable/ajax/userlist/form_user/text.php',
								  type: 'POST',
								  data: $('#<?=$formName?>').serialize(),
								  success: function(data){
									$('#letter-in-IT').html(data);
								  }
								});						
							}else{
								$('#pass-exelent').hide();
							}
						}
					});
					//--Here we Write into DB
				  }
				});								
			});	
			$(document).on('keydown','#<?=$arItems['name']?>',function(){
				$(this).css({'border-color':'#ccc'});
				if($('#<?=$arItems['name']?>').val().length>=0){
					$('#mistakeIUform').remove();
					$('#pass-exelent').hide();
				}
			});				
				<?break;				
			case $prefix.'umail':?>
			$(document).on('blur','#<?=$arItems['name']?>',function(){
				$.ajax({
				  dataType: "json",
				  url: 'itdept/stable/ajax/userlist/form_user/ajax_form_validate_cs.php',
				  data: $('#<?=$formName?>').serialize(),
				  type: 'POST',
				  success: function(data){
					console.log(data);
					$.each( data, function( keying, valing ) {
						if(valing.<?=$keyScript?>.mistakeIU == 'mistake'){
							$('#<?=$arItems['name']?>').css({'border-color':'#c11'});
							$('#mistakeIUform').remove();
							$('.btnarea').before('<tr id="mistakeIUform"><td colspan="2"><div style="background: #c11;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width:311px;">'+valing.<?=$keyScript?>.msg+'</div></td></tr>');
						}else{
							if($('#<?=$arItems['name']?>').val().length>0){
								$('#log-mail-flag').fadeIn(200);
								//-- Success Data
								$.ajax({
								  url: 'itdept/stable/ajax/userlist/form_user/text.php',
								  type: 'POST',
								  data: $('#<?=$formName?>').serialize(),
								  success: function(data){
									$('#letter-in-IT').html(data);
								  }
								});						
							}else{
								$('#log-mail-flag').hide();
							}
						}
					});
					//--Here we Write into DB
				  }
				});				
			});	
			$(document).on('keydown','#<?=$arItems['name']?>',function(){
				$(this).css({'border-color':'#ccc'});
				if($('#<?=$arItems['name']?>').val().length>=0){
					$('#mistakeIUform').remove();
					$('#log-mail-flag').hide();
				}
			});			
				<?break;
			default:
?>
	$(document).on('blur','#<?=$arItems['name']?>',function(){
			$.ajax({
			  dataType: "json",
			  url: 'itdept/stable/ajax/userlist/form_user/ajax_form_validate_cs.php',
			  data: $('#<?=$formName?>').serialize(),
			  type: 'POST',
			  success: function(data){
				console.log(data);
				$.each( data, function( keying, valing ) {
					if(valing.<?=$keyScript?>.mistakeIU == 'mistake'){
						$('#<?=$arItems['name']?>').css({'border-color':'#c11'});
						$('#mistakeIUform').remove();
						$('.btnarea').before('<tr id="mistakeIUform"><td colspan="2"><div style="background: #c11;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width:311px;">'+valing.<?=$keyScript?>.msg+'</div></td></tr>');
					}else{
						if($('#<?=$arItems['name']?>').val().length>0){
							$('#<?=$arItems['name']?>').parent().find('.exelfiledIU').fadeIn(200);
							//-- Success Data
							$.ajax({
							  url: 'itdept/stable/ajax/userlist/form_user/text.php',
							  type: 'POST',
							  data: $('#<?=$formName?>').serialize(),
							  success: function(data){
								$('#letter-in-IT').html(data);
							  }
							});						
						}else{
							$('#<?=$arItems['name']?>').parent().find('.exelfiledIU').hide();
						}
					}
				});
				//--Here we Write into DB
			  }
			});
	});
	
	$(document).on('keydown','#<?=$arItems['name']?>',function(){
		$(this).css({'border-color':'#ccc'});
		if($('#<?=$arItems['name']?>').val().length>=0){
			$('#mistakeIUform').remove();
			$('#<?=$arItems['name']?>').parent().find('.exelfiledIU').hide();
		}
	});
<?
	}
}?>
	$(document).on('click','.field-tpl',function(){
		$(this).css({'border-color':'#ccc'});
	});

	$(document).on('change','.accs-block input',function(){
		if($(this).is(':checked')){
			$(this).parent().css({'background-color':'#CAFDCA;'});
		}else{
			$(this).parent().css({'background-color':'transparent'});
		}
	});	
	
	$(document).on('blur','#staff_umail',function(){
		$('#staff_upass').val(str_rand());
		$('.test-letter-mail').remove();
			if($('#sendtestletter').is(':checked')){
					$.ajax({
					  url: 'itdept/stable/ajax/userlist/form_user/testlettermail.php',
					  type: 'POST',
					  data: $('#<?=$formName?>').serialize(),
					  success: function(data){
							$('#test-mail-build').after(data);
					  }
					});
			}else{
				$('.test-letter-mail').remove();
			}		
	});
	
	$(document).on('click','#stf-mail-btn',function(){
		$(this).after('<div class="create-mail"> <div class="cm-mailbox"> <input placeholder="<?=$arrayForm['umail']['title']?>" class="field-tpl halffield" type="text" name="<?=$arrayForm['umail']['name']?>" id="<?=$arrayForm['umail']['name']?>" value=""> @ 		 </div> <div class="cm-mailbox"> <select class="field-tpl half-select" name="<?=$f_Items['xxx']?>" disabled="" id="<?=$f_Items['xxx']?>"> <option selected="selected" value="1">bioline.ru</option> <option value="2">biomebel.ru</option> <option value="3">mail.ru</option> <option value="4">yandex.ru</option> </select> <i id="log-mail-flag" style="  margin-left: 10px;color: rgb(0, 153, 0);" class="fa fa-check-circle exelfiledIU"></i> </div> <div style="clear:both"></div> <div class="cm-mailbox"> <input style="width: 155px;" class="field-tpl" type="hidden" name="<?=$arrayForm['upass']['name']?>" id="<?=$arrayForm['upass']['name']?>" value="" placeholder="<?=$arrayForm['upass']['title']?>"> </div>   <div style="clear:both"></div> <div class="test-letter-cmb"> <a style="  float: right;  margin-right: 60px;  width: 119px;  text-align: center;padding: 5px 0;background: #d9534f;" class="btn-createpost" id="cancel-create-mail" href="javascript:void(0);">Не создавать ящик</a> </div> </div>');
		$(this).hide();
	});
	
	$(document).on('click','#cancel-create-mail',function(){
		$('#stf-mail-btn').show();
		$('.create-mail').remove();
		$('.test-letter-mail').remove();
	});
	
	$(document).on('change','#<?=$prefix?>motiv,#<?=$prefix?>st_phone,#<?=$prefix?>st_comp,#<?=$prefix?>one_c,#<?=$prefix?>notebook,#<?=$prefix?>mobphone,#chk-still-work,#sendtestletter',function(){
	if(!$('#<?=$prefix?>mobphone').is(':checked')){
		$('#staff_limit').remove();
	}
		$.ajax({
		  url: 'itdept/stable/ajax/userlist/form_user/text.php',
		  type: 'POST',
		  data: $('#<?=$formName?>').serialize(),
		  success: function(data){
			$('#letter-in-IT').html(data);
		  }
		});	
	});
	$(document).on('change','#<?=$prefix?>st_comp',function(){
		if($(this).is(':checked')){
			$('#<?=$prefix?>notebook').parent().append('<div class="fadeShadowNote"></div>');
		}else{
			$('.fadeShadowNote').remove();
		}
	});
	$(document).on('change','#<?=$prefix?>notebook',function(){
		if($(this).is(':checked')){
			$('#<?=$prefix?>st_comp').parent().append('<div class="fadeShadowComp"></div>');
		}else{
			$('.fadeShadowComp').remove();
		}
	});
	
	$(document).on('change','#<?=$prefix?>mobphone',function(){
		if($(this).is(':checked')){
			$(this).after('<div id="limit-phone"> <label>Лимит</label> <input style="margin-top: 0;" class="field-tpl" type="text" name="<?=$prefix?>limit" id="<?=$prefix?>limit" value=""> р. </div>');
			$('#staff_notebook').parent().css({'height':'64px'});
			$('#staff_notebook').prev().css({'padding-bottom' : '36px'});
				//-- Success Data
				$.ajax({
				  url: 'itdept/stable/ajax/userlist/form_user/text.php',
				  type: 'POST',
				  data: $('#<?=$formName?>').serialize(),
				  success: function(data){
					$('#letter-in-IT').html(data);
				  }
				});			
		}else{
			$(this).parent().css({'background-color':'transparent'});
			$('#staff_notebook').parent().css({'height':'auto'});
			$('#staff_notebook').prev().css({'padding-bottom' : '10px'});
			$('#limit-phone').remove();
		}
	});
	
	$(document).on('change','#sendtestletter',function(){
	$('.test-letter-mail').remove();
		if($(this).is(':checked')){
				$.ajax({
				  url: 'itdept/stable/ajax/userlist/form_user/testlettermail.php',
				  type: 'POST',
				  data: $('#<?=$formName?>').serialize(),
				  success: function(data){
						$('#test-mail-build').after(data);
				  }
				});
		}else{
			$('.test-letter-mail').remove();
		}
	});
	
	$(document).on('change','#<?=$prefix?>department',function(){
	$('#groups-form').remove();
		if($('#<?=$prefix?>department').val() != '0'){
			$('#<?=$prefix?>department').next().fadeIn(200);
				//--department builder
				$.ajax({
				  url: 'itdept/stable/ajax/userlist/form_user/grppbuild.php',
				  type: 'POST',
				  data: {depId : $('#<?=$prefix?>department').val()},
				  success: function(data){
						$('#dep-form').after(data);
				  }
				});
				//-- Success Data
				$.ajax({
				  url: 'itdept/stable/ajax/userlist/form_user/text.php',
				  type: 'POST',
				  data: $('#<?=$formName?>').serialize(),
				  success: function(data){
					$('#letter-in-IT').html(data);
				  }
				});				
		}else{
			$('#<?=$prefix?>department').next().hide();
		}
	});
	
	
	$(document).on('change','#<?=$prefix?>company',function(){
	$('#dep-form').remove();
		if($('#<?=$prefix?>company').val() != '0'){
			$('#<?=$prefix?>company').next().fadeIn(200);
				//--department builder
				$.ajax({
				  url: 'itdept/stable/ajax/userlist/form_user/depbuild.php',
				  type: 'POST',
				  data: {compId : $('#<?=$prefix?>company').val()},
				  success: function(data){
						$('#build-depart-fields').after(data);
				  }
				});
				//-- Success Data
				$.ajax({
				  url: 'itdept/stable/ajax/userlist/form_user/text.php',
				  type: 'POST',
				  data: $('#<?=$formName?>').serialize(),
				  success: function(data){
					$('#letter-in-IT').html(data);
				  }
				});				
		}else{
			$('#<?=$prefix?>company').next().hide();
		}
	});
	
	
	$(document).on('change','#<?=$prefix?>dop_comp1',function(){

		if($('#<?=$prefix?>dop_comp1').val() != '0'){
			$('#<?=$prefix?>dop_comp1').next().fadeIn(200);			
		}else{
			$('#<?=$prefix?>dop_comp1').next().hide();
		}
	});
	$(document).on('change','#<?=$prefix?>dop_comp2',function(){

		if($('#<?=$prefix?>dop_comp2').val() != '0'){
			$('#<?=$prefix?>dop_comp2').next().fadeIn(200);			
		}else{
			$('#<?=$prefix?>dop_comp2').next().hide();
		}
	});	
	
	
	$(document).on('change','#<?=$prefix?>groupdep',function(){
		if($('#<?=$prefix?>groupdep').val() != '0'){
			$('#<?=$prefix?>groupdep').next().fadeIn(200);
				//-- Success Data
				$.ajax({
				  url: 'itdept/stable/ajax/userlist/form_user/text.php',
				  type: 'POST',
				  data: $('#<?=$formName?>').serialize(),
				  success: function(data){
					$('#letter-in-IT').html(data);
				  }
				});			
		}else{
			$('#<?=$prefix?>groupdep').next().hide();
		}
	});
	
	$(document).on('change','#<?=$prefix?>location',function(){
		if($('#<?=$prefix?>location').val() != '0'){
			$('#<?=$prefix?>location').next().fadeIn(200);
				//-- Success Data
				$.ajax({
				  url: 'itdept/stable/ajax/userlist/form_user/text.php',
				  type: 'POST',
				  data: $('#<?=$formName?>').serialize(),
				  success: function(data){
					$('#letter-in-IT').html(data);
				  }
				});			
		}else{
			$('#<?=$prefix?>location').next().hide();
		}
	});
	
	$(document).on('change','#<?=$prefix?>executive',function(){
		if($('#<?=$prefix?>executive').val() != '0'){
			$('#<?=$prefix?>executive').next().fadeIn(200);
				//-- Success Data
				$.ajax({
				  url: 'itdept/stable/ajax/userlist/form_user/text.php',
				  type: 'POST',
				  data: $('#<?=$formName?>').serialize(),
				  success: function(data){
					$('#letter-in-IT').html(data);
				  }
				});	
		}else{
			$('#<?=$prefix?>executive').next().hide();
		}
	});
	
	$(document).on('submit','#<?=$formName?>',function(){
	$('#mistakeIUform').remove();
	fullQuery = $('#<?=$formName?>').serialize() + '&submform=formsended';
		$('.field-tpl').css({'border-color':'#ccc'});
		mistake = 0;
			$.ajax({
			  dataType: "json",
			  url: 'itdept/stable/ajax/userlist/form_user/ajax_form_validate_cs_send.php',
			  data: fullQuery,
			  type: 'POST',
			  success: function(data){
				//console.log(data);
				$.each( data, function( keying, valing ) {
					<?foreach($arrayForm as $keyScript => $arItems){?>
					if(valing.<?=$keyScript?>.mistakeIU == 'mistake'){
						<?if($keyScript == 'itletter'){?>
							$('#letter-in-IT').css({'border-color':'#c11'});
						<?}else{?>
							$('#<?=$arItems['name']?>').css({'border-color':'#c11'});
						<?}?>						
						$('#mistakeIUform').remove();
						$('.btnarea').before('<tr id="mistakeIUform"><td colspan="2"><div style="background: #c11;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width:311px;">'+valing.<?=$keyScript?>.msg+'</div></td></tr>');
						mistake = 1;
					}
					<?}?>
				});
				//--Here we Write into DB
				 //alert($('#letter-in-IT').val());
				if( mistake != '1'){
				$('.btnarea').before('<img id="spinner-load" src="loading_dark_large.gif" style="width:40px;">');
					$.ajax({
					  url: 'itdept/stable/ajax/userlist/form_user/ajax_db_write.php',
					  type: 'POST',
					  data: $('#<?=$formName?>').serialize(),
					  success: function(data){	  
							$('#spinner-load').remove();
							$('#staff_clearform').text('Добавить еще');
							$('.btnarea').before('<tr id="mistakeIUform"><td colspan="2"><div style="background: #090;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width:311px;">Сотрудник успешно добавлен</div></td></tr>');
							//alert(data);							

							/*GetSummAll = $('#all-numb-summ').attr('data-max-summ');
							GetSummWaiting = $('#waiting-numb-summ').attr('data-max-summ');
							GetSummAll = ++GetSummAll;
							GetSummWaiting = ++GetSummWaiting;
							$('#all-numb-summ').attr('data-max-summ',GetSummAll);
							$('#waiting-numb-summ').attr('data-max-summ',GetSummWaiting);*/

			
							
							valChange = $('.'+prefix+'sel-page-wrap-opt').val();
							valPagi = $(this).attr('data-pagi');
							valStatus = $('#stats-staff').val();
							valSearchType = $('#staff_paramsearch').val();
							valSearchData = $('#staff_searchinp').val();	
							valComp_filt = $('#'+prefix+'comp-list').val();
							valDep_filt = $('#'+prefix+'dep-list').val();
							valLoca_filt = $('#'+prefix+'loca-list').val();							
							
							OutBlocks(1,valChange,valStatus,valSearchType,valSearchData,valComp_filt,valDep_filt,valLoca_filt);
							staffBuildPagi(valStatus,valSearchType,valSearchData,valComp_filt,valDep_filt,valLoca_filt);
					  }
					});
				}
			  }
			});
		return false;
	});
</script>