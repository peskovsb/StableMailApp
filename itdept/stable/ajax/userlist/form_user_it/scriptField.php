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
			case $prefix.'dop_comp1':
				break;	
			case $prefix.'dop_comp2':
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
				  url: 'itdept/stable/ajax/userlist/form_user_it/ajax_form_validate_cs.php',
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
				  url: 'itdept/stable/ajax/userlist/form_user_it/ajax_form_validate_cs.php',
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
			  url: 'itdept/stable/ajax/userlist/form_user_it/ajax_form_validate_cs.php',
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
	

	

	

	
	$(document).on('change','#<?=$prefix?>department',function(){
	$('#groups-form').remove();
		if($('#<?=$prefix?>department').val() != '0'){
			$('#<?=$prefix?>department').next().fadeIn(200);
				//--department builder
				$.ajax({
				  url: 'itdept/stable/ajax/userlist/form_user_it/grppbuild.php',
				  type: 'POST',
				  data: {depId : $('#<?=$prefix?>department').val()},
				  success: function(data){
						$('#dep-form').after(data);
				  }
				});
				//-- Success Data
			
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
				  url: 'itdept/stable/ajax/userlist/form_user_it/depbuild.php',
				  type: 'POST',
				  data: {compId : $('#<?=$prefix?>company').val()},
				  success: function(data){
						$('#build-depart-fields').after(data);
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
		
		}else{
			$('#<?=$prefix?>groupdep').next().hide();
		}
	});
	
	$(document).on('change','#<?=$prefix?>location',function(){
		if($('#<?=$prefix?>location').val() != '0'){
			$('#<?=$prefix?>location').next().fadeIn(200);
			
		}else{
			$('#<?=$prefix?>location').next().hide();
		}
	});
	
	$(document).on('change','#<?=$prefix?>executive',function(){
		if($('#<?=$prefix?>executive').val() != '0'){
			$('#<?=$prefix?>executive').next().fadeIn(200);

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
			  url: 'itdept/stable/ajax/userlist/form_user_it/ajax_form_validate_cs_send.php',
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
					  url: 'itdept/stable/ajax/userlist/form_user_it/ajax_db_write.php',
					  type: 'POST',
					  data: $('#<?=$formName?>').serialize(),
					  success: function(data){
							$('#spinner-load').remove();
							$('#it_clearform').text('Добавить еще');
							$('.btnarea').before('<tr id="mistakeIUform"><td colspan="2"><div style="background: #090;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width:311px;">Сотрудник успешно добавлен</div></td></tr>');
							//alert(data);
					  }
					});
				}
			  }
			});
		return false;
	});
</script>