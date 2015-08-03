<script type="text/javascript">

	$(document).on('submit','#<?=$formName?>',function(){
	$('#mistakeIUform').remove();
	dataVal = $("#comp_compn").val();
	fullQuery = $('#<?=$formName?>').serialize() + '&submform=formsended';
	if($("#comp_depart").val().length==0){
		$("#comp_depart").css({'border-color':'#c11'});
	}else{
				$('.btnarea').before('<img id="spinner-load" src="loading_dark_large.gif" style="width:40px;">');
					$.ajax({
					  url: 'ajax/company/form_department/ajax_db_write.php',
					  type: 'POST',
					  data: $('#<?=$formName?>').serialize(),
					  success: function(data){
							$('#spinner-load').remove();
							$('#staff_clearform').text('Добавить еще');
							$('.btnarea').before('<tr id="mistakeIUform"><td colspan="2"><div style="background: #090;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width:311px;">Отдел '+$('#comp_depart').val()+' успешно добавлен</div></td></tr>');
							//alert(data);
							pref = 'department';
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
	$(document).on('click','#comp_depart',function(){
		$("comp_depart").css({'border-color':'#ccc'});
	});
	$(document).on('keyup','#comp_depart',function(){
		$("comp_depart").css({'border-color':'#ccc'});
	});
</script>