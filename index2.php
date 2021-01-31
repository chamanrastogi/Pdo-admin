<?php
include('includes/initialize.php');
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
	//exit();
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
	echo "<strong>Controller Name:</strong> ".$model,"<br>";
	echo "<strong>Action :</strong> ".$action,"<br>";
	echo "<strong>Id :</strong> ".$id;
	//echo $action;
	
	
} else {
    echo "No route found for URL '$url'";
}
