<?
require '../db.php';?>

<style>

.ajaxcont{margin-top:0;}
html,body{  height: 100%;padding-bottom:0;}
.IU-layout{min-height: 100%;}
#maiApplication, .ajaxcont{height: 100%;}
.IU-layout{  min-height: 100%;}

.IU-container{padding-top:29px;  width: 1303px; padding-left:140px;}
.IU-sidebar{width:50px;
}
#topnav{
-webkit-box-shadow: none!important;
	-moz-box-shadow: none!important;
	box-shadow: none!important;
}
.sidebarinner{  margin-top: -50px;
  padding-top: 66px;
  height: 100%;
  position: fixed;
  border-right: 1px solid #ccc;}
.sidebarinner2{position:fixed;z-index:99999;  width: 250px;}
.root-icon-iu-sidebarmenu{display:block;width:100%;height:50px;color:#111;line-height:50px;text-align:center;
-webkit-transition: all 0.2s ease-in-out;
-moz-transition: all 0.2s ease-in-out;
-o-transition: all 0.2s ease-in-out;
transition: all 0.2s ease-in-out;
position:relative;
  z-index: 2;
  border-right: 1px solid #ccc;
}
/*.root-icon-iu-sidebarmenu:hover .IU-branch-node{display:block;}*/
.IU-branch-node{display:none;position:absolute;top:0px;left:100%;z-index: 9;
background: rgb(240,240,240);
  background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
  background: -moz-linear-gradient(top, rgba(240,240,240,1) 0%, rgba(222,222,222,1) 100%);
  background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(240,240,240,1)), color-stop(100%,rgba(222,222,222,1)));
  background: -webkit-linear-gradient(top, rgba(240,240,240,1) 0%,rgba(222,222,222,1) 100%);
  background: -o-linear-gradient(top, rgba(240,240,240,1) 0%,rgba(222,222,222,1) 100%);
  background: -ms-linear-gradient(top, rgba(240,240,240,1) 0%,rgba(222,222,222,1) 100%);
  background: linear-gradient(to bottom, rgba(240,240,240,1) 0%,rgba(222,222,222,1) 100%);
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f0f0f0', endColorstr='#dedede',GradientType=0 );
  box-shadow: 0 0 5px rgba(58, 58, 58, 0.7);
  -webkit-box-shadow: 0 0 5px rgba(68, 68, 68, 0.7);
  -moz-box-shadow: 0 0 5px rgba(0, 153, 153, 0.7);
}
.IU-brance-link{color:#111;display:inline-block;  border-bottom: 1px solid #DDD;  padding: 0 50px;}

/*.IU-sidebar:hover{  width: 250px;}*/
.root-icon-iu-sidebarmenu i{font-size:16px;margin-left: -5px;}


.root-links-container{float:left;width:50px;}

.ajaxcont {
  width: 100%;
  margin: auto;
}
.IU-open-menu{display:block;border-bottom:1px solid #4A4A4A;  height: 50px;  color: #999999;  line-height: 50px;  text-align: center;}
.IU-open-menu i{font-size:16px;}
.IU-active{color:#fff;background:#3a87ad;}
</style>

<div class="IU-layout">	
	<div class="IU-sidebar">
		<div class="sidebarinner">
			<div class="root-links-container">
				<a class="root-icon-iu-sidebarmenu IU-user-btn" href="javascript:void(0);">
					<i class="fa fa-user"></i>
						<span class="IU-branch-node">
							<span class="IU-brance-link IU-user-btn" href="javascript:void(0);">Пользователи</span>
							<span class="IU-brance-link" href="javascript:void(0);">Группы</span>
						</span>
						<span class="tooltip-css">Пользователи</span>
				</a>
				<a class="root-icon-iu-sidebarmenu IU-loging-btn IU-active" href="javascript:void(0);"><i class="fa fa-file-text"></i><span class="tooltip-css">Журнал</span></a>
				<a class="root-icon-iu-sidebarmenu IU-company-btn" href="javascript:void(0);"><i class="fa fa-home"></i><span class="tooltip-css">Компания</span></a>
				<a style="display:none;border-bottom: none;  opacity: 0.4;  margin-top: 30px;" class="root-icon-iu-sidebarmenu IU-showlistmenu" href="javascript:void(0)"><i style="font-size:35px;" class="fa fa-chevron-circle-right"></i></a>
			</div>
				<div style="clear:both"></div>
			
				
		</div>
		<div class="sidebarinner2" style="display:none;  border-top: 1px solid #4A4A4A;">
<?
$stleBranche = ' style="display: block;  padding: 9px 0;  text-align: center;  cursor: pointer;"';
?>
				<span<?=$stleBranche?> class="IU-brance-link IU-user-btn" href="javascript:void(0);">Пользователи</span>
				<span<?=$stleBranche?> class="IU-brance-link" href="javascript:void(0);">Группы</span>
				<span<?=$stleBranche?> class="IU-brance-link IU-loging-btn IU-active" href="javascript:void(0);">Журнал</span>
				<span<?=$stleBranche?> class="IU-brance-link IU-company-btn IU-active" href="javascript:void(0);">Компания</span>
				<span<?=$stleBranche?> class="IU-brance-link IU-closeicons" href="javascript:void(0);"><i class="fa fa-chevron-circle-left"></i> Свернуть меню</span>
				
				<div style="clear:both"></div>
			
				
		</div>
	</div>
	<div class="IU-container">
		<div class="brd-tbl-users" style="display:none;">
		<!--<div class="header-users">Пользователи системы</div>-->
		<div class="left-user-headers">	
			<a class="BtnCreateInnerUser btn green" style=" margin-bottom: 22px; float:right;">Создать +</a> <h2 class="inUheader">Список пользователей</h2>
		</div>
		<div class="right-user-headers">	
			<a class="BtnCreateInnerGrp btn green" style=" margin-bottom: 22px; float:right;">Создать +</a> <h2 class="inUheader">Список групп</h2>
		</div>
			<div style="clear:both"></div>
		<div style="clear:both"></div>
			<div class="inner-brd-padding">
				<div class="wrapper-brd-tblu">
					<ul class="lst-brd-btu2">
						<li class="row-container-btu-heade">
							<div class="rowmainstl-heade first-row-btu">id</div>
							<div class="rowmainstl-heade second-row-btu">login</div>
							<div class="rowmainstl-heade fourth-row-btu">level</div>
							<div class="rowmainstl-heade fifth-row-btu">ФИО</div>
							<div class="rowmainstl-heade sixth-row-btu"><span style="padding-right:15px">Действие</span></div>
								<div style="clear:both"></div>
						</li>
					</ul>
					<ul class="lst-brd-btu">
						<li style="list-style:none;" class="rowmainstl startOutUsers"></li>
					</ul>
				</div>
				<a style="display:none;" class="link-hidden-IU" id="usersinnner-btn" href="javascript:void(0);">Показать еще...</a>
			</div>
			<div class="inner-groups-brd">
				<div class="wrapper-brd-tblu">
					<ul class="lst-brd-btu2">
						<li class="row-container-grp-heade">
							<div class="rowmaingrp rowmaingrp-heade first-row-grp">id</div>
							<div class="rowmaingrp rowmaingrp-heade second-row-grp">name</div>
							<div class="rowmaingrp rowmaingrp-heade second_2-row-grp">Комментарий</div>
							<div class="rowmaingrp rowmaingrp-heade third-row-grp">Действие</div>
								<div style="clear:both"></div>
						</li>
					</ul>
					<ul class="lst-brd-grp">
						<li style="list-style:none;" class="rowmaingrp startOutGrp"></li>
					</ul>
				</div>
				<div style="clear:both"></div>
				<a class="link-hidden-IU-grp" id="usersinnner-btn-grp" href="javascript:void(0);">Показать еще...</a>
				
			</div>
		</div>
		<div class="log-system">
		<div class="show-el-page-wrapper-IU">
			<select class="sel-page-wrap-opt-IU">
				<option selected="selected" value="30">30</option>
				<option value="50">50</option>
				<option value="150">150</option>
				<option value="300">300</option>
			</select>
		</div>		
		<div class="search-filter">
			<form id="IU-mainfilter">
				<div class="rzlt-search-login"></div>
				<input id="IU-filteruser" class="field-tpl" placeholder="Login" type="text" name="IU-filteruser" style="border-radius: 5px 0px 0px 5px;float:left;z-index:2;position:relative;  background: transparent;"> 
				<select id="IU-filtercats" name="IU-filtercats" class="super-fire-list" style="float: left;  border-radius: 0;  border-left: 0; border-right: 0;float:left;  padding: 5px 9px;">
					<option value="0">--Раздел--</option>
					<option value="1">Ящики</option>
					<option value="2">Переадресация</option>
					<option value="3">Сотрудники</option>
				</select>
				<select id="IU-filtermoves" name="IU-filtermoves" class="super-fire-list" style="border-radius:0;float:left;border-right:0;  padding: 5px 9px;">
					<option value="0">--Действие--</option>
					<option value="1">создание</option>
					<option value="2">множественное удаление</option>
					<option value="3">удаление</option>
					<option value="4">блокирование</option>
					<option value="5">редактирование</option>
				</select>				
				<input class="field-tpl" type="submit" value="OK" name="IU-subm" style="border-radius:0 5px 5px 0;float:left;  border-color: #275393;  background: #275393;  color: #fff;">
					<div style="clear:both"></div>
			</form>
		</div>
		<a id="refrlogs" href="javascript:void(0);"><i class="fa fa-refresh"></i></a>
		<div style="clear:both"></div>
			
		<div style="clear:both;height:20px;"></div>
			<div class="inner-lgst-padding">
				<div class="wrapper-brd-lgs">
					<ul class="lst-log-btu2">
						<li class="row-container-lgt-heade">
							<div class="rowlogs-headr frstrow-lg"><div class="paddin-in-tbl">id</div></div>
							<div class="rowlogs-headr frstrow_two-lg"><div class="paddin-in-tbl">ip-адрес</div></div>
							<div class="rowlogs-headr scndrow-lg"><div class="paddin-in-tbl">время</div></div>
							<div class="rowlogs-headr thrdrow-lg"><div class="paddin-in-tbl">login</div></div>
							<div class="rowlogs-headr sixthrow-lg"><div class="paddin-in-tbl">раздел</div></div>
							<div class="rowlogs-headr fifthrow-lg"><div class="paddin-in-tbl">действие</div></div>
							<div class="rowlogs-headr forthrow-lg"><div class="paddin-in-tbl">результат</div></div>
								<div style="clear:both"></div>	
						</li>
					</ul>
					<ul class="lst-log-btu">
						<li style="list-style:none;" class="rowmainstl startOutLogs"></li>
					</ul>					
				</div>
					<div class="pagenation-wrapper-IU" style="display: none;">
						<!-- BuildPagi Here -->
					</div>				
				<!--<a style="display:none;" class="link-hidden-IU-logs" id="logsbtnlister" href="javascript:void(0);">Показать еще...</a>-->
			</div>
		</div>
		<div id="innercontainerIU"></div>
			<div style="clear:both"></div>
	</div>