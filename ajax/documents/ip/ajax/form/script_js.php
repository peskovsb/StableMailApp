<script>
	$('#wrapper-<?=$formBuild?>').on('submit','#<?=$formBuild?>-cor',function(){
			dataFlds = $(this).serialize();
			mistake=0;
		$.ajax({
			dataType: "json",
			data: dataFlds,
			type: "POST",
			url : "ajax/documents/ip/ajax/form/form_cor_valid.php",
			success : function (data) {
				$.each( data, function( key, val ) {
					if(val.ip_ip.mistakeIU == 'mistake'){
						$('#ip_ip_id').css({'border-color':'#c11','border-width':'4px'});
						$('#ip_ip_id').after('<div class="msg-error-fld">'+val.ip_ip.msg+'</div>');
						mistake=1;
					}
				});
				if(mistake!=1) {
					$.ajax({
						dataType: "HTML",
						data: dataFlds,
						type: "POST",
						url: "ajax/documents/ip/ajax/form/form_cor_subm.php",
						success: function (data) {
							$('#info-tbl').remove();
							dataLoc = $('#ipLocation').val();
							drawTable('ip', '', '', dataLoc);
							$('.lastrow-tbl').before('<tr id="info-tbl"><td colspan="2"><div style="background: #090;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width:311px;">Изменения внесены успешно</div></td></tr>');
						}
					});
				}
			}
		});
		return false;
	});
	$('#wrapper-<?=$formBuild?>').on('submit','#<?=$formBuild?>-create',function(){
			dataFlds = $(this).serialize();
			mistake=0;
		$.ajax({
			dataType: "json",
			data: dataFlds,
			type: "POST",
			url : "ajax/documents/ip/ajax/form/form_create_valid.php",
			success : function (data) {
				$.each( data, function( key, val ) {
					if(val.ip_ip.mistakeIU == 'mistake'){
						$('#ip_ip_id-create').css({'border-color':'#c11','border-width':'4px'});
						$('#ip_ip_id-create').after('<div class="msg-error-fld">'+val.ip_ip.msg+'</div>');
						mistake=1;
					}
				});
				if(mistake!=1) {
					$.ajax({
						dataType: "HTML",
						data: dataFlds,
						type: "POST",
						url: "ajax/documents/ip/ajax/form/form_create_subm.php",
						success: function (data) {
							$('#info-tbl').remove();
							dataLoc = $('#ipLocation').val();
							drawTable('ip', '', '', dataLoc);
							$('.lastrow-tbl').before('<tr id="info-tbl"><td colspan="2"><div style="background: #090;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width:311px;">Изменения внесены успешно</div></td></tr>');
						}
					});
				}
			}
		});
		return false;
	});
	$('#wrapper-<?=$formBuild?>').on('blur','#ip_ip_id',function(){
		$('.msg-error-fld').remove();
		dataFlds = $('#<?=$formBuild?>-cor').serialize();
		$.ajax({
			dataType: "json",
			data: dataFlds,
			type: "POST",
			url : "ajax/documents/ip/ajax/form/form_cor_valid.php",
			success : function (data) {
				$.each( data, function( key, val ) {
					if(val.ip_ip.mistakeIU == 'mistake'){
						$('#ip_ip_id').css({'border-color':'#c11','border-width':'4px'});
						$('#ip_ip_id').after('<div class="msg-error-fld">'+val.ip_ip.msg+'</div>');
					}
				});
			}
		});
	});
	$('#wrapper-<?=$formBuild?>').on('blur','#ip_ip_id-create',function(){
		$('.msg-error-fld').remove();
		dataFlds = $('#<?=$formBuild?>-create').serialize();
		$.ajax({
			dataType: "json",
			data: dataFlds,
			type: "POST",
			url : "ajax/documents/ip/ajax/form/form_create_valid.php",
			success : function (data) {
				$.each( data, function( key, val ) {
					if(val.ip_ip.mistakeIU == 'mistake'){
						$('#ip_ip_id-create').css({'border-color':'#c11','border-width':'4px'});
						$('#ip_ip_id-create').after('<div class="msg-error-fld">'+val.ip_ip.msg+'</div>');
					}
				});
			}
		});
	});
	$('#wrapper-<?=$formBuild?>').on('keyup','#ip_ip_id',function() {
		$(this).css({'border-color':'#ccc','border-width':'1px'});
		$('.msg-error-fld').remove();
	});
	$('#wrapper-<?=$formBuild?>').on('click','#ip_ip_id',function() {
		$(this).css({'border-color':'#ccc','border-width':'1px'});
		$('.msg-error-fld').remove();
	});
	$('#wrapper-<?=$formBuild?>').on('keyup','#ip_ip_id-create',function() {
		$(this).css({'border-color':'#ccc','border-width':'1px'});
		$('.msg-error-fld').remove();
	});
	$('#wrapper-<?=$formBuild?>').on('click','#ip_ip_id-create',function() {
		$(this).css({'border-color':'#ccc','border-width':'1px'});
		$('.msg-error-fld').remove();
	});

	function getChar(event) {
		if (event.which == null) { // IE
			if (event.keyCode < 32) return null; // спец. символ
			return String.fromCharCode(event.keyCode)
		}

		if (event.which != 0 && event.charCode != 0) { // все кроме IE
			if (event.which < 32) return null; // спец. символ
			return String.fromCharCode(event.which); // остальные
		}

		return null; // спец. символ
	}

	$(document).on('keypress','#ip_ip_id',function(e){

		e = e || event;

		if (e.ctrlKey || e.altKey || e.metaKey) return;

		var chr = getChar(e);

		// с null надо осторожно в неравенствах,
		// т.к. например null >= '0' => true
		// на всякий случай лучше вынести проверку chr == null отдельно
		if (chr == null) return;

		if (chr < '1' || chr > '9') {
			return false;
		}
	});
</script>