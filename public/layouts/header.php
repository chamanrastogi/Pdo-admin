<?php
$temp= new Template();
$Template = $temp->find_by_id(1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Admin Panel</title> 
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">   
    <!-- Main Styles -->
	  <link rel="icon" href="<?=BASE_PATH?><?=$temp->path()?><?=$Template->fab_icon?>" sizes="16x16" type="image/x-icon">
	<link rel="stylesheet" href="<?=TP_BACK?>assets/styles/style.min.css">
	<link rel="stylesheet" href="<?=TP_BACK?>assets/styles/extra.css">
	
	<!-- Themify Icon -->
	<link rel="stylesheet" href="<?=TP_BACK?>assets/fonts/themify-icons/themify-icons.css">

	<!-- mCustomScrollbar -->
	<link rel="stylesheet" href="<?=TP_BACK?>assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.min.css">

	<!-- Waves Effect -->
	<link rel="stylesheet" href="<?=TP_BACK?>assets/plugin/waves/waves.min.css">
	<link rel="stylesheet" href="<?=TP_BACK?>assets/plugin/toastr/toastr.css">
	<!-- Code Styleheets -->
	
    <!--End Code Styleheets -->
   
   <link rel="stylesheet" href="<?=TP_BACK?>assets/plugin/jquery-ui/jquery-ui.min.css">
   <link rel="stylesheet" href="<?=TP_BACK?>assets/plugin/jquery-ui/jquery-ui.structure.min.css">
   <link rel="stylesheet" href="<?=TP_BACK?>assets/plugin/jquery-ui/jquery-ui.theme.min.css">
   <?php 
	
	if(isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING']!='')
	{
		
	    $x = urls($_SERVER['QUERY_STRING']);
		//echo sizeof($x);
		if(sizeof($x)==1 && $x[0]!=NULL)
		{
			if($x[0]!=='filemanager')
			{
		echo'<!-- '.ucfirst($x[0]).' Styles -->';
		ucfirst($x[0])::hd_css();
		echo'<!--End Of '.ucfirst($x[0]).' Styles -->';
			}else{
			echo'<!-- Template Styles -->';
		Template::hd_css();
		echo'<!--End Of Template Styles -->';	
			}
		}elseif(sizeof($x)==2)
		{
	    echo'<!-- '.ucfirst($x[0]).' Styles -->';
		ucfirst($x[0])::hd_css();	
		echo'<!--End Of '.ucfirst($x[0]).' Styles -->';
		}
		elseif(sizeof($x)==3)
		{
		 echo'<!-- '.ucfirst($x[0]).' Styles -->';
		ucfirst($x[0])::hd_css();
		echo'<!--End Of '.ucfirst($x[0]).' Styles -->';
		}else		
		{
		Template::hd_css();
		}
	}
			
			
	?>
<script src="<?=TP_BACK?>editor/ckeditor.js"></script>
</head>

<body>
<div class="main-menu">
	<header class="header">
<?php 
 $us = new Users();
  $uss=$us->find_by_id($_SESSION['user_id']);
 
//echo "image".$user->adm_image;
//exit();
   
?>
    <img src="<?=BASE_PATH?><?=$us->image_path($uss->adm_image)?>" class="avtar" >
		<a href="<?=TP_BACK?>admin" class="logo">Admin Panel</a>
		<button type="button" class="button-close fa fa-times js__menu_close"></button>
	</header>
	<!-- /.header -->
	<div class="content">

		<?=include_layout_admin('side.php');?>
		<!-- /.navigation -->
	</div>
	<!-- /.content -->
</div>
<!-- /.main-menu -->

<div class="fixed-navbar">
	<div class="pull-left">
		<button type="button" class="menu-mobile-button glyphicon glyphicon-menu-hamburger js__menu_mobile"></button>
		<h1 class="page-title">Home</h1>
		<!-- /.page-title -->
	</div>
	<!-- /.pull-left -->
	<div class="pull-right">
		<!-- /.ico-item -->
        <a href="<?=BASE_PATH?>" target="_blank" class="ico-item ti-desktop" ></a>
		<a href="<?=TP_BACK?>admin/template/settings"  class="ico-item ti-settings" ></a>
        <a href="<?=TP_BACK?>admin/users/edit/1" class="ico-item ti-user" ></a>
        <a href="<?=TP_BACK?>admin/logout" class="ico-item  ti-share-alt" ></a>
		<div class="ico-item">
			 <span> <?=ucfirst($us->adm_fullname)?></span>
			
			<!-- /.sub-ico-item -->
		</div>
	</div>
	<!-- /.pull-right -->
</div>
<!-- /.fixed-navbar -->
<div id="wrapper">
	<div class="main-content">
		<div class="row small-spacing">
       <div class="col-12">