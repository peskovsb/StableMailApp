<script type="text/javascript">

	$(document).on('submit','#<?=$formName?>',function(){
	$('#mistakeIUform').remove();
	fullQuery = $('#<?=$formName?>').serialize() + '&submform=formsended';
	dataVal = $("#gr_department").val();
	
	if($("#gr_grps").val().length==0 || $("#gr_department").val()==0){
		if($("#gr_grps").val().length==0){
			$("#gr_grps").css({'border-color':'#c11'});			
		}
		if($("#gr_department").val()==0){
			$("#gr_department").css({'border-color':'#c11'});
		}
	}else{
				$('.btnarea').before('<img id="spinner-load" src="loading_dark_large.gif" style="width:40px;">');
					$.ajax({
					  url: 'ajax/company/form_grps/ajax_db_write.php',
					  type: 'POST',
					  data: $('#<?=$formName?>').serialize(),
					  success: function(data){
							$('#spinner-load').remove();
							$('#staff_clearform').text('Добавить еще');
							$('.btnarea').before('<tr id="mistakeIUform"><td colspan="2"><div style="background: #090;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width:311px;">'+$('#gr_grps').val()+' успешно добавлена</div></td></tr>');
							//alert(data);
							pref = 'grps';
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
	
	
	$(document).on('change','#<?=$prefix?>соmpany',function(){
	//alert($('#gr_соmpany').val());
	$('#dep-form').remove();
		if($('#<?=$prefix?>company').val() != '0'){
			$('#<?=$prefix?>company').next().fadeIn(200);
				//--department builder
				$.ajax({
				  url: 'ajax/company/form_grps/depbuild.php',
				  type: 'POST',
				  data: {compId : $('#gr_соmpany').val()},
				  success: function(data){
						$('#build-depart-fields').after(data);
				  }
				});
			
		}else{
			$('#<?=$prefix?>company').next().hide();
		}
	});	
	$(document).on('change','#gr_department',function(){
		$("gr_department").css({'border-color':'#ccc'});
	});
	$(document).on('click','#gr_department',function(){
		$("gr_department").css({'border-color':'#ccc'});
	});
	$(document).on('click','#gr_grps',function(){
		$("gr_grps").css({'border-color':'#ccc'});
	});
	$(document).on('keyup','#gr_grps',function(){
		$("gr_grps").css({'border-color':'#ccc'});
	});	
</script>