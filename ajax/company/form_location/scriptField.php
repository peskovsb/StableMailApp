<script type="text/javascript">

	$(document).on('submit','#<?=$formName?>',function(){
	$('#mistakeIUform').remove();
	fullQuery = $('#<?=$formName?>').serialize() + '&submform=formsended';

				$('.btnarea').before('<img id="spinner-load" src="loading_dark_large.gif" style="width:40px;">');
					$.ajax({
					  url: 'ajax/company/form_location/ajax_db_write.php',
					  type: 'POST',
					  data: $('#<?=$formName?>').serialize(),
					  success: function(data){
							$('#spinner-load').remove();
							$('#staff_clearform').text('Добавить еще');
							$('.btnarea').before('<tr id="mistakeIUform"><td colspan="2"><div style="background: #090;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width:311px;">Локация '+$('#loca_location').val()+' успешно добавлен</div></td></tr>');
							//alert(data);
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
</script>