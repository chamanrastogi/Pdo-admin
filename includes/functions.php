<?php
function redirect_to($location = NULL)
{
    if ($location != NULL)
    {
        header("Location: {$location}");
        exit;
    }
}

function url_array($n)
{
	if(count($n)==1)
	 {
		 $class_name=$url;
	 }elseif(count($n)==2)
	 {
		 $class_name=ucfirst($n[0]);
		 $class_action_name=ucfirst($n[1]);
		 }
		elseif(count($n)==3)
	 {
		 $class_name=ucfirst($n[0]);
		 $class_action_name=ucfirst($n[1]);
		 $class_action_id=$n[2];
		}
		}
function  breadcrumbs($n)
{
	//print_r($n);
	//echo count($n);
echo'<div class="box-content card white">
<h4 class="box-title">
  '.$n[1].'
  '.$n[0].'';
  if(count($n)==5)
  {
	  
  echo'<div style="float:right">
   <a href="../'.$n[3].'">'.$n[4].'</a>
  </div>';
  }else
  {
	  echo'<div style="float:right">
   <a href="'.$n[2].'">'.$n[3].'</a>
  </div>';
	  }
echo'</h4>
<div class="card-content">';
}


function output_message($type = "", $message = "")
{
    if (!empty($message))
    {
        return '<div class="alert alert-' . strtolower($type) . '" role="alert">' . ucfirst($message) . '</div>';
    }
    else
    {
        return "";
    }
}
function output_message2($type = "", $message = "", $message2 = "")
{
    if (!empty($message))
    {
        return '<div class="alert alert-' . strtolower($type) . '" role="alert">' . ucfirst($message) . '</div><div class="alert alert-danger" role="alert">' . ucfirst($message2) . '</div>';
    }
    else
    {
        return "";
    }
}
function redirect_by_js($page, $time)
{
?><script>
function Redirect()
{
 window.location='<?=$page
?>'; 
 }
setTimeout('Redirect()', <?=$time ?>);
</script>

<?php
}

function include_layout_web($template = "")
{
    include (SITE_ROOT . DS . 'include' . DS . $template);
}
function include_layout_public($template = "")
{
    include (SITE_ROOT . DS . 'public' . DS . $template);
}
function include_layout_admin($template = "")
{
    include (SITE_ROOT . DS . 'public' . DS . 'layouts' . DS . $template);
}
spl_autoload_register(function ($class_name)
{
    $class_name = strtolower($class_name);
    $path = LIB_PATH . DS . "{$class_name}.php";
    $path2 = LIB_PATH . DS . "model" . DS . "{$class_name}.php";
    if (file_exists($path))
    {
        require_once ($path);
    }
    else if (file_exists($path2))
    {
        require_once ($path2);
    }
    else
    {
		
		//redirect_to(TP_BACK_SIDE);
        //die("The file {$class_name}.php could not be found.");
        die('<div align="center"><h4 class="alert alert-warning">Error! The File Name ' . $class_name . '.php could not be found <a href="' . TP_BACK . 'admin">Go Back</a></h4><span><img src="' . TP_BACK . 'assets/loaders/c_loader_re.gif" title="c_loader_re.gif"></span></div>');
		
    }
});
function url_name()
{
    $class_name = '';
    $class_action_name = '';
    $class_action_id = '';
    $url = $_SERVER['QUERY_STRING'];
    $n = explode("/", $url);
    return $n;
}
function urls($urls)
{
	$x=explode("/",$urls);
	if(sizeof($x)==1)
	{
	$xs[]=strtolower($x[0]); 
	return $xs;    
	}elseif(sizeof($x)==2)
	{
	$xs[]=strtolower($x[0]);
	$xs[]=strtolower($x[1]);
	return $xs;
	}elseif(sizeof($x)==3)
	{
	$xs[]=strtolower($x[0]);
	$xs[]=strtolower($x[1]);
	$xs[]=strtolower($x[2]);
	return $xs;
	}
}
function delete_files($target) {
    if(is_dir($target)){
        $files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned

        foreach( $files as $file ){
			
            delete_files( $file );      
        }

       // rmdir( $target );
    } elseif(is_file($target)) {
		
		$x=strpos("$target",".php");
		if($x==0)
		{
        unlink( $target ); 
	} 
    }
}
function backup_action($action, $message="") {
	$logfile = SITE_ROOT.DS.'logs'.DS.'backup.txt';
	$new = file_exists($logfile) ? false : true;
  if($handle = fopen($logfile, 'a')) { // append
  date_default_timezone_set('Asia/Kolkata');
    $timestamp = strftime("%d-%m-%Y %I:%M:%S %p", time());
	$content = "{$timestamp} | {$action}: {$message}\n";
    fwrite($handle, $content);
    fclose($handle);
    if($new) { chmod($logfile, 0755); }
  } else {
    echo "Could not open log file for writing.";
  }
}
function log_action($action, $message="") {
	$logfile = SITE_ROOT.DS.'logs'.DS.'log.txt';
	$new = file_exists($logfile) ? false : true;
  if($handle = fopen($logfile, 'a')) { // append
  date_default_timezone_set('Asia/Kolkata');
    $timestamp = strftime("%d-%m-%Y %I:%M:%S %p", time());
	$content = "{$timestamp} | {$action}: {$message}\n";
    fwrite($handle, $content);
    fclose($handle);
    if($new) { chmod($logfile, 0755); }
  } else {
    echo "Could not open log file for writing.";
  }
}
function stylesheet_formate($url)
	{
	return'<link rel="stylesheet" href="'.TP_BACK.$url.'">';
	}
 	
	function script_formate($url)
	{
	return'<script src="'.TP_BACK.$url.'"></script>';
	}
function datetime_to_text($datetime = "")
{
    $unixdatetime = strtotime($datetime);
    return strftime("%B %d, %Y at %I:%M %p", $unixdatetime);
}

?>
