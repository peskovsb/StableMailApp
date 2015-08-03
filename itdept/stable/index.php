<?session_start();
require 'db.php';
?>

<!DOCTYPE html>
<html style="overflow-y: scroll;">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="css/fontawesome/css/font-awesome.css">
	<link rel="stylesheet" href="css/style.css">
	<script src="js/jquery-1.11.2.min.js"></script><style type="text/css"></style>
	
	<!-- Fancy Box 2.1.5 -->
		<script type="text/javascript" src="js/fancybox/jquery.fancybox.js?v=2.1.5"></script>
		<link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox.css?v=2.1.5" media="screen">
		
	<!-- DatePicker -->
		<link rel="stylesheet" href="css/jquery-ui.css">
		<script type="text/javascript" src="js/jquery-ui.js"></script>

	<!-- Jquery Cookie -->		
		<script type="text/javascript" src="js/jquery.cookie.js"></script>
			
	<!-- KLADR -->
	<script src="js/kladr/jquery.kladr.min.js" type="text/javascript"></script>
	<link href="js/kladr/jquery.kladr.min.css" rel="stylesheet">
			
		<!-- JS MainScript-->
		<script src="js/mainscript.js"></script>		
		<?
		require 'ajax/userlist/form_user/arrFields.php';
		require 'ajax/userlist/form_user/scriptField.php';
		?>
</head>
	<body>
		<div id="staff_main-application">
			<!-- HERE GOES THE MAIN APPLICATION -->
		</div>	
	</body>
</html>