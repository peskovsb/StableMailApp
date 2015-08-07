<script>
function OutBlocks (page,limit,type,SearchType,SearchData,valComp_filt,valDep_filt,valLoca_filt){
prefix = 'staff_';
$('#'+prefix+'table').hide();
	$.ajax({
	  dataType: "json",
	  url: 'itdept/stable/ajax/userlist/form_user/ajax_lists.php',
	  data: {pagi : page,limit: limit,type: type, staff_option : SearchType, staff_search : SearchData, valComp_filt : valComp_filt, valDep_filt : valDep_filt, valLoca_filt : valLoca_filt},
	  type: 'POST',
	  success: function(data){
		  if(data.length>0){
			$('#'+prefix+'table').html('<ul><li id="'+prefix+'start"></li></ul>');
			$.each( data, function( keying, val ) {
			 //console.log(val.level_id);
			 wrAts = '';
			 waitU = '';
			 wrEmail= '';
			 wrDepart= '';
			 if(val.staff_status=='В ожидании'){waitU = '<div class="status-shild yello-stats">'+val.staff_status+'</div>';}
			 if(val.staff_status=='Уволен'){waitU = '<div class="status-shild red-stats">'+val.staff_status+'</div>';}
			 if(val.staff_status=='Декрет'){waitU = '<div class="status-shild pink-stats">'+val.staff_status+'</div>';}
			 if(val.staff_ats){wrAts = '<tr> <td class="first-user-row">Телефон: </td> <td class="second-user-row"><div class="rpd-loca"><b>'+val.staff_ats+'</b></div></td> </tr>';}
			 if(val.staff_email){wrEmail = '<tr> <td class="first-user-row">Еmail: </td> <td class="second-user-row"><div class="rpd-loca email-inner-container">'+val.staff_email+'</div></td> </tr>';}
			 if(val.staff_depart_id){wrDepart = '<tr> <td class="first-user-row">Отдел: </td> <td class="second-user-row"><div class="rpd-dep">'+val.staff_depart_id+'</div></td> </tr>';}
				$('#'+prefix+'start').before('<li class="card-wrapper-staff"> <div class="card-padding">'+waitU+'<div class="overlay-rpd"><div class="brd-usr" <?if($userLevel['oper_correct_staff']=='0'){?>style="width: 30px;"<?}?> data-staffid="'+val.staff_id+'"><?if($userLevel['oper_correct_staff']=='1'){?><a id="staff_trasher" class="red-color" href="javascript:void(0);"><i class="fa fa-trash-o"></i></a> <a id="staff_corusr" href="javascript:void(0);"><i class="fa fa-pencil"></i></a><?}?> <a id="eyetracking" class="green-color" href="javascript:void(0);"><i class="fa fa-eye"></i></a><div style="clear:both"></div></div></div> <div class="left-part-ave"> <img src="http://infoline.bioline.ru/images/comprofiler/'+val.staff_avatar+'"> </div> <div class="right-part-data"> <b class="rpd-name">'+val.staff_lastname+' '+val.staff_name+' '+val.staff_secondname+'</b> <table class="tbls-users" border="0" style="border-collapse:collapse;margin-top: 5px;margin-bottom:5px;" cellpadding="0"> <tr> <td class="first-user-row">Должность: </td> <td class="second-user-row"><div class="rpd-postuser">'+val.staff_post+'</div></td> </tr><tr> <td class="first-user-row">Компания: </td> <td class="second-user-row"><div class="rpd-comp">'+val.staff_company_id+'</div></td> </tr> '+wrDepart+' <tr> <td class="first-user-row">Локация: </td> <td class="second-user-row"><div class="rpd-loca">'+val.staff_location+'</div></td> </tr> '+wrEmail+''+wrAts+'  </table> </div> </div> <div style="clear:both"></div> </div> </li>');
				wrAts = '';
				waitU = '';
				wrEmail= '';
				wrDepart= '';
			});
			$('#'+prefix+'table').fadeIn(300);
			$('.'+prefix+'pagenation-wrapper').fadeIn(300);
		  }else{
			$('#'+prefix+'table').html('<b>Ничего не найдено</b>');
			$('#'+prefix+'table').fadeIn(300);
		  }

	  }
	  
	});
};
</script>