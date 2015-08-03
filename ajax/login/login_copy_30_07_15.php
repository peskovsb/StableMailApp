<?
/*
Универсальный модуль авторизации.

год 2015
*/

//-- Требуется подключение к базе данных и запущенная сессия!!!

//Define Constants
define('USERS_TABLE','inner_users');


class login_module{
	public $arrFirstStageValid;
	public $arrSecondStageValid;
	public $arrCheck;
	public $post_login;
	public $post_pass;
	public $post_send;
	public $save_the_pass;
	public $db;
	function __construct($post_login,$post_pass,$post_send,$save_the_pass){
		$this->db = new DatabaseItDept();
		$this->post_login = $post_login;
		$this->post_pass = $post_pass;
		$this->post_send = $post_send;
		$this->save_the_pass = $save_the_pass;
	}
	function login(){
	$username = $this->post_login;
	$password = $this->post_pass;
		if($this->post_send){
			//first stage geting salt
			$sql = 'SELECT `salt` FROM '.USERS_TABLE.' WHERE user_login = :user_login';
			$tb = $this->db->connection->prepare($sql);
			$tb->execute(array(':user_login'=>$username));
			$this->arrFirstStageValid = $tb->fetch(PDO::FETCH_ASSOC);
			
			//second stage try password
			$sql = 'SELECT `user_id`, `user_login`, `user_level`, `active`, `user_datereg` FROM '.USERS_TABLE.' WHERE user_login = :user_login AND user_pass = :user_password';
			$tb = $this->db->connection->prepare($sql);

			$tb->execute(array(':user_login'=>$username, ':user_password'=>md5(md5(stripslashes($password)).$this->arrFirstStageValid['salt'])));
		
			$this->arrSecondStageValid = $tb->fetch(PDO::FETCH_ASSOC);
			
			if($this->arrSecondStageValid){
				if($this->arrSecondStageValid['active']!='0'){
						$_SESSION['user_id'] = $this->arrSecondStageValid['user_id'];
						$_SESSION['user_login'] = $this->arrSecondStageValid['user_login'];
						$_SESSION['user_level'] = $this->arrSecondStageValid['user_level'];
						$_SESSION['active'] = $this->arrSecondStageValid['active'];
						$_SESSION['user_datereg'] = $this->arrSecondStageValid['user_datereg'];
						unset($_SESSION['wrongpass']);

					
					if($this->save_the_pass){
						setcookie("savelogin", $username, time()+(365*24*60*60)); 
						//setcookie("SID", SID, time()+(365*24*60*60));
						setcookie("savepass", md5(md5(stripslashes($password)).$this->arrFirstStageValid['salt']), time()+(365*24*60*60)); 
					}
					
					//--redirecting
					header('Location: '.$_SERVER['PHP_SELF']);
				}else{
					$_SESSION['wrongpass'] = 'Этот пользователь заблокирован';
				}
			}else{
				unset($_SESSION['user_login']);
				unset($_SESSION['user_id']);
				unset($_SESSION['user_level']);
				unset($_SESSION['active']);
				unset($_SESSION['user_datereg']);
				/*header('Refresh: 1;');
				die('Пароль неправильный!');*/
				$_SESSION['wrongpass'] = 'Пароль или логин неправильный!';
			}
		}
	}
	/*function checkUser($uid){
		$sql = 'SELECT `sid` FROM '.USERS_TABLE.' WHERE user_id = :user_id';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':user_id'=>$uid));
		$this->arrCheck = $tb->fetch(PDO::FETCH_ASSOC);
		return $this->arrCheck['sid']==SID ? true : false;
	}*/
	function checkLogin(){
		if($_SESSION['user_id']) {
			define('USER_LOGGED',true);
		}else{
			define('USER_LOGGED',false);
		}
	}
	function logout() {
		unset($_SESSION['user_login']);
		unset($_SESSION['user_id']);
		unset($_SESSION['user_level']);
		unset($_SESSION['active']);
		unset($_SESSION['user_datereg']);
		unset($_SESSION['wrongpass']);
		setcookie("savelogin", "", time() - 3600); 
		setcookie("savepass", "", time() - 3600); 
		//setcookie("SID", "", time() - 3600);
		die(header('Location: '.$_SERVER['PHP_SELF']));
	}
}

// --- COOOKIE

class login_module_cookie{
	public $arrFirstStageValid;
	public $arrSecondStageValid;
	public $arrCheck;
	public $post_login;
	public $post_pass;
	public $post_send;
	public $save_the_pass;
	public $db;
	function __construct($post_login,$post_pass,$post_send,$save_the_pass){
		$this->db = new DatabaseItDept();
		$this->post_login = $post_login;
		$this->post_pass = $post_pass;
		$this->post_send = $post_send;
		$this->save_the_pass = $save_the_pass;
	}
	function login(){
	$username = $this->post_login;
	$password = $this->post_pass;
		if($this->post_send){
			//first stage geting salt
			$sql = 'SELECT `salt` FROM '.USERS_TABLE.' WHERE user_login = :user_login';
			$tb = $this->db->connection->prepare($sql);
			$tb->execute(array(':user_login'=>$username));
			$this->arrFirstStageValid = $tb->fetch(PDO::FETCH_ASSOC);
			
			//second stage try password
			$sql = 'SELECT `user_id`, `user_login`, `user_level`, `active`, `user_datereg` FROM '.USERS_TABLE.' WHERE user_login = :user_login AND user_pass = :user_password';
			$tb = $this->db->connection->prepare($sql);

			$tb->execute(array(':user_login'=>$username, ':user_password'=>$password));
			
			$this->arrSecondStageValid = $tb->fetch(PDO::FETCH_ASSOC);

			if($this->arrSecondStageValid){
				if($this->arrSecondStageValid['active']!='0'){
						$_SESSION['user_id'] = $this->arrSecondStageValid['user_id'];
						$_SESSION['user_login'] = $this->arrSecondStageValid['user_login'];
						$_SESSION['user_level'] = $this->arrSecondStageValid['user_level'];
						$_SESSION['active'] = $this->arrSecondStageValid['active'];
						$_SESSION['user_datereg'] = $this->arrSecondStageValid['user_datereg'];
						unset($_SESSION['wrongpass']);

				}else{
					$_SESSION['wrongpass'] = 'Этот пользователь заблокирован';
				}
			}else{
				unset($_SESSION['user_login']);
				unset($_SESSION['user_id']);
				unset($_SESSION['user_level']);
				unset($_SESSION['active']);
				unset($_SESSION['user_datereg']);
				/*header('Refresh: 1;');
				die('Пароль неправильный!');*/
				setcookie("savelogin", "", time() - 3600); 
				setcookie("savepass", "", time() - 3600); 
				//setcookie("SID", "", time() - 3600);
			}
		}
	}
	/*function checkUser($uid){
		$sql = 'SELECT `sid` FROM '.USERS_TABLE.' WHERE user_id = :user_id';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute(array(':user_id'=>$uid));
		$this->arrCheck = $tb->fetch(PDO::FETCH_ASSOC);
		return $this->arrCheck['sid']==$_COOKIE['SID'] ? true : false;
	}*/
	function checkLogin(){
		if($_SESSION['user_id']) {
			define('USER_LOGGED',true);
		}else{
			define('USER_LOGGED',false);
		}
	}
	function logout() {
		unset($_SESSION['user_login']);
		unset($_SESSION['user_id']);
		unset($_SESSION['user_level']);
		unset($_SESSION['active']);
		unset($_SESSION['user_datereg']);
		unset($_SESSION['wrongpass']);
		setcookie("savelogin", "", time() - 3600); 
		setcookie("savepass", "", time() - 3600); 
		//setcookie("SID", "", time() - 3600);
		die(header('Location: '.$_SERVER['PHP_SELF']));
	}
}

if($_COOKIE['savepass'] AND $_COOKIE['savelogin']){
	$getData = new login_module_cookie($_COOKIE['savelogin'],$_COOKIE['savepass'],1,$_POST['save_the_pass']);
}else{
	$getData = new login_module($_POST['user_login'],$_POST['user_password'],$_POST['user_send'],$_POST['save_the_pass']);
}


//--sending data
$getData ->login();

//--cheking if has ID
$getData -> checkLogin();

//--logingOut
if(isset($_GET['logout'])) {
    $getData -> logout();
}

$grDb = new DatabaseItDept();
$sql = 'SELECT * FROM levels';
$tb = $grDb->connection->prepare($sql);
$tb->execute(array(':user_login'=>$username));
$grArr = $tb->fetchAll(PDO::FETCH_ASSOC);
foreach($grArr as $key => $grItems){
	$logGroups[$grItems['level_id']] = $grItems['level_name'];
}

//--cheking SID in browser
/*if(USER_LOGGED) {
	$arrCheck = $getData ->checkUser($_SESSION['user_id']);
	if(!$arrCheck) $getData -> logout();
}*/

?>
<?
//echo '<pre>';print_r($_SESSION);echo '</pre>';

//--Ordery LogIn
if(!USER_LOGGED) {
?>
<html>
<head>
	<style>
		*{  font-family: 'Trebuchet MS', Helvetica, sans-serif;}
		.wrapper-login{
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			-ms-box-sizing: border-box;
			box-sizing: border-box;
			display: table;
			height: 70%;
			padding: 1em 0;
			width: 100%;
		}
		.inner-wapperl{
			display: table-cell;
			text-align: left;
			vertical-align: middle;
		}
		.inner-wapperl{
			background-clip: padding-box;
		}
		.form-tpl-auth{
			border-radius: 4px;
			box-shadow: 0 1px 5px rgba(0,0,0,.1);
			background: #fdfdfd;
			border: 1px solid #a4baca;
			width: 420px;
		}
		.form-tpl-auth{
		  margin: 0 auto;
		}
		.header-auth-log{
		  border-radius: 4px 4px 0 0;
		  box-shadow: 0 -1px 0 #06365f inset,0 1px 0 rgba(255,255,255,.2)inset;
		  background-color: #517fa4;
		  background-image: url("//instagramstatic-a.akamaihd.net/bluebar/5021840/images/shared/noise-1.png"),-webkit-gradient(linear,left top,left bottom,from(#517fa4),to(#306088));
		  background-image: url("//instagramstatic-a.akamaihd.net/bluebar/5021840/images/shared/noise-1.png"),-webkit-linear-gradient(top,#517fa4,#306088);
		  background-image: url("//instagramstatic-a.akamaihd.net/bluebar/5021840/images/shared/noise-1.png"),-moz-linear-gradient(top,#517fa4,#306088);
		  background-image: url("//instagramstatic-a.akamaihd.net/bluebar/5021840/images/shared/noise-1.png"),-o-linear-gradient(top,#517fa4,#306088);
		  background-image: url("//instagramstatic-a.akamaihd.net/bluebar/5021840/images/shared/noise-1.png"),-ms-linear-gradient(top,#517fa4,#306088);
		  background-image: url("//instagramstatic-a.akamaihd.net/bluebar/5021840/images/shared/noise-1.png"),linear-gradient(top,#517fa4,#306088);
		  background-position: 50% 50%;
		  border-width: 1px 1px 0;
		  border-color: #1c5380;
		  border-style: solid;
		  color: #FFF;
		  font-size: 18px;
		  height: 44px;
		  margin: -1px -1px 1px;
		  position: relative;
		  text-align: center;
		  line-height: 44px;
		}
		.field-tpl {
		  background-color: #ffffff;
		  border: 1px solid #cccccc;
		  -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
		  -moz-box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
		  box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
		  -webkit-transition: border linear 0.2s,box-shadow linear 0.2s;
		  -moz-transition: border linear 0.2s,box-shadow linear 0.2s;
		  -o-transition: border linear 0.2s,box-shadow linear 0.2s;
		  transition: border linear 0.2s,box-shadow linear 0.2s;
		  padding: 6px 9px;
		  -webkit-border-radius: 4px;
		  -moz-border-radius: 4px;
		  border-radius: 4px;
		  box-sizing: border-box;
		  font-size: 16px;
		}		
		.firstrow td{padding: 10px 0;}
		.labelpd{padding-left: 5px;}
		.authbtn{
			  text-decoration: none;
			  display: inline-block;
			  padding: 4px 12px;
			  margin-bottom: 0;
			  font-size: 14px;
			  line-height: 20px;
			  color: #333333;
			  text-align: center;
			  text-shadow: 0 1px 1px rgba(255,255,255,0.75);
			  vertical-align: middle;
			  cursor: pointer;
			  background-color: #f5f5f5;
			  background-image: -moz-linear-gradient(top,#ffffff,#e6e6e6);
			  background-image: -webkit-gradient(linear,0 0,0 100%,from(#ffffff),to(#e6e6e6));
			  background-image: -webkit-linear-gradient(top,#ffffff,#e6e6e6);
			  background-image: -o-linear-gradient(top,#ffffff,#e6e6e6);
			  background-image: linear-gradient(to bottom,#ffffff,#e6e6e6);
			  background-repeat: repeat-x;
			  border: 1px solid #cccccc;
			  border-color: #e6e6e6 #e6e6e6 #bfbfbf;
			  border-color: rgba(0,0,0,0.1) rgba(0,0,0,0.1) rgba(0,0,0,0.25);
			  border-bottom-color: #b3b3b3;
			  -webkit-border-radius: 4px;
			  -moz-border-radius: 4px;
			  border-radius: 4px;
			  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffffff',endColorstr='#ffe6e6e6',GradientType=0);
			  filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
			  -webkit-box-shadow: inset 0 1px 0 rgba(255,255,255,0.2),0 1px 2px rgba(0,0,0,0.05);
			  -moz-box-shadow: inset 0 1px 0 rgba(255,255,255,0.2),0 1px 2px rgba(0,0,0,0.05);
			  box-shadow: inset 0 1px 0 rgba(255,255,255,0.2),0 1px 2px rgba(0,0,0,0.05);
			  color: #ffffff;
			  text-shadow: 0 -1px 0 rgba(0,0,0,0.25);
			  background-color: #5bb75b;
			  background-image: -moz-linear-gradient(top,#62c462,#51a351);
			  background-image: -webkit-gradient(linear,0 0,0 100%,from(#62c462),to(#51a351));
			  background-image: -webkit-linear-gradient(top,#62c462,#51a351);
			  background-image: -o-linear-gradient(top,#62c462,#51a351);
			  background-image: linear-gradient(to bottom,#62c462,#51a351);
			  background-repeat: repeat-x;
			  border-color: #51a351 #51a351 #387038;
			  border-color: rgba(0,0,0,0.1) rgba(0,0,0,0.1) rgba(0,0,0,0.25);
			  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff62c462',endColorstr='#ff51a351',GradientType=0);
			  filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
			  margin: 10px 0 15px 0;		
		}
		.authbtn:hover{background:#51a351}
		.mistbs{
		  background-color: rgba(221,221,221,.15);
		  border-bottom: 1px solid #c3cfd9;
		  box-shadow: 0 1px 5px rgba(153,153,153,.2);
		  color: #3f729b;
		  line-height: 64px;
		  margin: 0;
		  text-align: center;
		  vertical-align: middle;
		  margin-bottom: 10px;		
		}		
	</style>
</head>

<body style="background:url(body_noise.png);">
<div class="wrapper-login">
	<div class="inner-wapperl">
		<form class="form-tpl-auth" action="<?=$DOCUMENT_ROOT['PHP_SELF']?>" method="POST">
			<h1 class="header-auth-log">Авторизация</h1>
		<?if($_SESSION['wrongpass']){echo '<div class="mistbs"><b style="color:#c11">'.$_SESSION['wrongpass'].'</b></div>';}?>
			<table style="width: 100%;">
				<tr class="firstrow">
					<td><label class="labelpd"><b>Ваш логин:</b></label></td>
					<td><input style="width: 285px;  margin-left: 12px;" class="field-tpl" type="text" name="user_login" value="<?=$_POST['user_login']?>"></td>
				</tr>
				<tr>
					<td><label class="labelpd"><b>Ваш пароль:</b></label></td>
					<td><input style="width: 285px;  margin-left: 12px;" class="field-tpl" type="password" name="user_password"></td>
				</tr>
				<tr>
					<td></td>
					<td style="text-align: right; padding-right: 10px;
">						
						<input name="save_the_pass" style="vertical-align: middle;cursor:pointer;" id="remb-pass" type="checkbox"><label style="font-size:14px;color: #3a87ad;cursor:pointer;" for="remb-pass">Сохранить пароль</label>
						<input style="margin-left: 12px;" class="authbtn" type="submit" name="user_send" value="Авторизоваться">
					</td>
				</tr>
			</table>	
		</form>
	</div>
</div>
</body>
</html>
<?
exit;
}
?>