<?php
require_once(LIB_PATH.DS.'database.php');
use Coderatio\SimpleBackup\SimpleBackup;
class Template_mo extends Template {
	
	public function settings()
	{
		include_layout_admin('header.php');
        $n=url_name();
		$n[]="#";
		$n[]="";
		breadcrumbs($n);
        echo $fo = Forms::form_start();
        if (isset($_REQUEST['submit']))
        {
			
          $x= self::update_data(1);
		 
		  if(is_array($x))
		  {
			  
			  if(sizeof($x)==3)
			  {
			echo  output_message2($x[1],$x[0],$x[2]);
			  }else
			  {
				   output_message($x[1],$x[0]);
				  }
			redirect_by_js(TP_BACK_SIDE.$n[0].DS."settings",1000);
		}
		}
        $data= self::call_cl_fun();
	    $rw = $data->find_by_id(1);		
		$sitename = $rw->sitename;       
        $logo = $rw->logo;
		$favicon_logo = $rw->favicon_logo;            
        $email = $rw->email;		 
        $description = $rw->description;   
        $keyword = $rw->keyword;
        $ana = $rw->ana;
		$footer = $rw->footer;
		$imglogo=$data->image_path($rw->logo);	
		$imgfav=$data->image_path($rw->favicon_logo);	
				
 		echo $fo = Forms::image_edit("Favicon Logo", "favicon_logo", $imgfav, $favicon_logo);
        echo $fo = Forms::image_edit("Website Logo", "logo", $imglogo, $logo);	
        echo $fo = Forms::input("Site Name", "sitename", $sitename, 1);        
        echo $fo = Forms::email("Email", "email", $email, 1);	       
		echo $fo = Forms::textarea("Description", "description", $description,'',0);
		echo $fo = Forms::textarea("Keyword", "keyword", $keyword,'',0);
		echo $fo = Forms::textarea("Google Analytics", "ana", $ana,'',0);
		echo $fo = Forms::textarea("Footer", "footer", $footer,'',0);
        echo $fo = Forms::submit();
        echo $fo = Forms::form_end();       
		include_layout_admin('footer.php');
	}
	public static function backnow() {
	  $time=date('d-m-Y(h.i.s A)');	  
	  $simpleBackup = SimpleBackup::setDatabase([DB_NAME,DB_USER,DB_PASS,DB_SERVER])
	->storeAfterExportTo(SITE_ROOT.DS."includes".DS.'backup', 'mybackup_'.$time);
	return $simpleBackup->getExportedName();
	   }
	   public static function backnow_table_in($arr) {
	  SimpleBackup::start()
	  ->setDbName(DB_NAME)
	  ->setDbUser(DB_USER)
	  ->setDbPassword(DB_PASS)
	  ->includeOnly($arr)
	  ->then()->storeAfterExportTo('backups')
	  ->then()->getResponse();
	   }
	  public static function backnowtableout($arr) {
	  SimpleBackup::start()
	  ->setDbName(DB_NAME)
	  ->setDbUser(DB_USER)
	  ->setDbPassword(DB_PASS)
	  ->excludeOnly($arr)
	  ->then()->storeAfterExportTo('backups')
	  ->then()->getResponse();
	   }
	   public static function backuphistoryclears()	 
	   {
		$logfile = SITE_ROOT.DS.'logs'.DS.'backup.txt';	   
		delete_files(SITE_ROOT.DS.'includes'.DS.'backup');
	
		file_put_contents($logfile, '');
		// Add the first log entry
		log_action('Logs Cleared', "by User ID : {$_SESSION['user_id']}");
	  // redirect to this same page so that the URL won't 
	  // have "clear=true" anymore
	  $message='Success! Clear the history';
  echo output_message("success",$message);
  redirect_by_js("backnowhistory",1000);
   }
   public static function backnow_his() {
	$dps='';
	$link='';
	$maction='clear';	  
	$logfile = SITE_ROOT.DS.'logs'.DS.'backup.txt';

?>

<!-- /.col-xl-6 col-12 -->

<div class="card-content">
<ul class="list-inline text-right">
  <li class="margin-bottom-10 "><a href="<?=TP_BACK_SIDE?>template/backuphistoryclear" class="btn btn-primary btn-rounded waves-effect waves-light">Clear All Backup History</a></li>
  <li class="margin-bottom-10 "><a href="<?=TP_BACK_SIDE?>template/backupsql" class="btn btn-success btn-rounded waves-effect waves-light">Create Backup</a></li>
</ul>
<div class="col-md-12">
  <div class="list-group">
	<?php

if( file_exists($logfile) && is_readable($logfile) && 
		  $handle = fopen($logfile, 'r')) {  // read
  echo "<ul class=\"log-entries\">";
	  while(!feof($handle)) {
		  $entry = fgets($handle);
		  if(trim($entry) != "") {
			  $ns=explode(":",$entry);
			//  print_r($ns);
		  echo'<a href="'.BASE_PATH.'includes'.DS.'backup'.DS.trim($ns[3]).'" class="list-group-item">									
		  <p class="list-group-item-text">'.$entry.'</p>
		  </a>';			
		  }
	  }
	  echo "</ul>";
  fclose($handle);
} else {
  echo "Could not read from {$logfile}.";
}

?>
  </div>
</div>
</div>
<?php
	   }
	
}