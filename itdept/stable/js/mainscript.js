$(document).ready(function(){
	//$('#staff_main-application').html('<img src="loading_dark_large.gif">');
	$.ajax({
	  url: "ajax/userlist/show.php",
	  success: function(data){
		$('#staff_main-application').html(data);
	  }
	});
});

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
        href: 'ajax/userlist/form_user/form_builder.php',
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
        href: 'ajax/userlist/form_user_it/form_builder.php',
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
        href: 'ajax/userlist/form_user/form_builder.php',
        type: 'ajax'
    });		
	},300);

});

function str_rand() {
	var result       = '';
	var words        = '0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM';
	var max_position = words.length - 1;
		for( i = 0; i < 8; ++i ) {
			position = Math.floor ( Math.random() * max_position );
			result = result + words.substring(position, position + 1);
		}
	return result;
}



