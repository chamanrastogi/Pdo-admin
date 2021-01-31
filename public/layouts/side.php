<?php
$pro1= Template::find_by_id(1);
$user= Users::count_all();
$menu= Menus::count_all();
$page= Page::count_all();
$module= Module::count_all();
$social= Social::count_all();
$testimonial= Testimonial::count_all();
?>

<div class="navigation">
  <h5 class="title">Navigation</h5>
  <!-- /.title -->
  <ul class="menu js__accordion">
    <li class="current"> <a class="waves-effect" href="<?=TP_BACK?>admin"><i class="menu-icon ti-dashboard"></i><span>Dashboard</span></a> </li>
    <li> <a class="waves-effect" href="<?=TP_BACK_SIDE?>users/loghistory"><i class="menu-icon ti-bookmark-alt"></i><span>Login Log</span></a> </li>
    <li> <a class="waves-effect parent-item js__control" href="#"><i class="menu-icon ti-layers"></i><span>Menu</span> <span class="notice notice-blue">
      <?=$menu?>
      </span></a>
      <ul class="sub-menu js__content">
        <li><a href="<?=TP_BACK_SIDE?>menus/add">Add Menu</a></li>
        <li><a href="<?=TP_BACK_SIDE?>menu.php?act=menu">Show Menu</a></li>
        <li><a href="<?=TP_BACK_SIDE?>menucat/add">Add Menu Type</a></li>
        <li><a href="<?=TP_BACK_SIDE?>menucat/show">Show Menu Type</a></li>
      </ul>
    </li>
    <li> <a class="waves-effect parent-item js__control" href="#"><i class="menu-icon ti-clipboard"></i><span>Cms</span> <span class="notice notice-blue"><?=$page?> </span></a>
      <ul class="sub-menu js__content">
        <li><a href="<?=TP_BACK_SIDE?>page/add">Add Page</a></li>
        <li><a href="<?=TP_BACK_SIDE?>page/show">Show Page</a></li>
      </ul>
    </li>
    <li> <a class="waves-effect parent-item js__control" href="#"><i class="menu-icon ti-filter"></i><span>Module</span> <span class="notice notice-blue">
      <?=$module?>
      </span></a>
      <ul class="sub-menu js__content">
        <li><a href="<?=TP_BACK_SIDE?>module/add">Add Module</a></li>
        <li><a href="<?=TP_BACK_SIDE?>module/show">Show Module</a></li>
      </ul>
    </li>
    
    <li> <a class="waves-effect parent-item js__control" href="#"><i class="menu-icon ti-facebook"></i><span>Social</span> <span class="notice notice-blue">
      <?=$social?>
      </span></a>
      <ul class="sub-menu js__content">
        <li><a href="<?=TP_BACK_SIDE?>social/add">Add Social</a></li>
        <li><a href="<?=TP_BACK_SIDE?>social/show">Show Social</a></li>
      </ul>
    </li>
	<li> <a class="waves-effect parent-item js__control" href="#"><i class="menu-icon ti-comments"></i><span>Testimonial</span> <span class="notice notice-blue">
      <?=$testimonial?>
      </span></a>
      <ul class="sub-menu js__content">
        <li><a href="<?=TP_BACK_SIDE?>testimonial/add">Add Testimonial</a></li>
        <li><a href="<?=TP_BACK_SIDE?>testimonial/show">Show Testimonial</a></li>
      </ul>
    </li>
	<li>
					<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon ti-user"></i><span>Users</span>
                            <span class="notice notice-blue"><?=$user?></span></a>
					<ul class="sub-menu js__content">
						<li><a href="<?=TP_BACK_SIDE?>users/add">Add User</a></li>
						<li><a href="<?=TP_BACK_SIDE?>users/show">Show User</a></li>	
					</ul>				
				</li>
    <li> <a class="waves-effect" href="<?=TP_BACK_SIDE?>template/backnowhistory"><i class="menu-icon ti-files"></i><span>Back Database</span></a> </li>
    <li> <a class="waves-effect" href="<?=TP_BACK_SIDE?>filemanager"><i class="menu-icon ti-files"></i><span>File Manager</span></a> </li>
  </ul>
</div>
