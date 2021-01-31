<?php
include('../../includes/initialize.php');

$router = new Router();
$model='';
$action='';
$id='';
// Add the routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('{controller}');
$router->add('{controller}/{action}');
$router->add('{controller}/{action}/{id:\d+}');


// Display the routing table
//echo '<pre>';
//var_dump($router->getRoutes());
//echo '</pre>';


 $url = $_SERVER['QUERY_STRING'];

if ($router->match($url)) {

    $x=$router->getParams();
	//print_r($x);
	
	if(sizeof($x)==1)
	{
		$action='';
        $id='';  
	$model=strtolower($x['controller']);
	}elseif(sizeof($x)==2)
	{
	$model=strtolower($x['controller']);
	$action=strtolower($x['action']);
	}elseif(sizeof($x)==3)
	{
	$model=strtolower($x['controller']);
	$action=strtolower($x['action']);
	$id=strtolower($x['id']);
	}
	 $url="".$model.".php";
	 if($model=='home')
	 {
		 	if (!$session->is_logged_in()) { 
redirect_to(TP_BACK."admin/login");
 }
if($session->is_logged_in())
{
	if($_SESSION['role']!='admin')
	{		
		redirect_to(TP_BACK_SIDE);
	}
}
include_layout_admin('header.php'); 		 
	include($url);
include_layout_admin('footer.php'); 
	}elseif($model=='login')
	 {	
	include($url);
	}elseif($model=='logout')
	 {	
	include($url);
	}
	elseif($model=='forget-password')
	 {	
	include($url);
	}
	elseif($model=='filemanager')
	 {	
		 
		include_layout_admin('header.php'); 		 
		include($url);
	include_layout_admin('footer.php'); 
	}else
	{
			if (!$session->is_logged_in()) { 
redirect_to(TP_BACK."admin/login");
 }
if($session->is_logged_in())
{
	if($_SESSION['role']!='admin')
	{		
		//redirect_to(TP_BACK_SIDE);
	}
}
	global $session;
	$n=$model."_mo";
	
	if(method_exists($n,$action))
	{
		$n::$action();
	}else
	{
		//redirect_to(TP_BACK_SIDE);
		}	
	//$n=$model."_mo";
	//$n::$action();
	
	}
} else {
    echo "No route found for URL '$url'";
	//redirect_to(TP_BACK_SIDE);
}
