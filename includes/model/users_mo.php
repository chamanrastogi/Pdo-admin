<?php
require_once (LIB_PATH . DS . 'database.php');
use Illuminate\Hashing\BcryptHasher;
class Users_mo extends Users
{

    public function login()
    {
        global $session;
        include_layout_admin('admin_header.php');
        include ("login.php");
        include_layout_admin('admin_footer.php');
    }
    public function logout()
    {
        global $session;
        include ("logout.php");
    }
    public function add()
    {
        include_layout_admin('header.php');
		$n=url_name();
		$n[]="show";
		$n[]="Show Users";
		breadcrumbs($n);
        include_layout_admin('breadcrumbs.php');
		$n=url_name();
        echo $fo = Forms::form_start();
		 if (isset($_REQUEST['submit']))
        {
          $data = self::call_cl_fun();
		  $image_name = '';
          $temp = '';
          $checkbox = '';
		  extract($_POST);
		  // print_r($_POST);
		  //exit();
		  $xp = new BcryptHasher();			 
		  $data->adm_username = $adm_username;
		  $data->adm_password = $xp->make($adm_password, ['rounds' => 4]);
		  
		  if($_FILES['adm_image']['size']!=0)
			{	
				 $data->adm_image=$data->image_maker($_FILES['adm_image'],2,$id,"adm_image");      
		    }
		  $data->adm_fullname = $adm_fullname;
		  $data->adm_email = $adm_email;
		  $data->adm_phone = $adm_phone;
		  $data->about = $about;
		  $data->role = 1;
		  $data->created = date('Y-m-d H:i:s');
		  $data->updated = date('Y-m-d H:i:s');
		  $data->status = "Active";
		  $x= $data->create();
		 
		  if(is_array($x))
		  {
			echo  output_message($x[1],$x[0]);
			redirect_by_js(TP_BACK_SIDE.$n[0].DS.$n[1],1000);
		}
		}
        $adm_username = '';
        $adm_password = '';
        $adm_image = '';
        $adm_fullname = '';
        $adm_email = '';
        $adm_phone = '';
        $role = '';
        $about = '';
        $impath='';
		echo $fo=Forms::image("Upload image","adm_image");       
        echo $fo = Forms::input("Username", "adm_username", $adm_username, 1);
        echo $fo = Forms::password("Password", "adm_password", $adm_password, 0);
        echo $fo = Forms::input("Full Name", "adm_fullname", $adm_fullname, 1);
        echo $fo = Forms::email("Email", "adm_email", $adm_email, 1);
		echo $fo = Forms::input("Phone", "adm_phone", $adm_phone, 1);
        echo $fo = Forms::textarea("About", "about", $about, "", 0);
        echo $fo = Forms::submit();
        echo $fo = Forms::form_end();
        include_layout_admin('footer.php');
	}
	
    public function edit()
    {
		include_layout_admin('header.php');
        $n=url_name();
		$n[]="show";
		$n[]="Show Users";
		breadcrumbs($n);		
        echo $fo = Forms::form_start();
        if (isset($_REQUEST['submit']))
        {
         $data = self::call_cl_fun();
		  $image_name = '';
          $temp = '';
          $checkbox = '';
		  extract($_POST);
		  $up=self::find_by_id($n[2]);
		  $data->adm_username = $adm_username;
		  	  
		  if(!empty($_POST['adm_password']))
		  {
			 
		$xp = new BcryptHasher();	
		$data->adm_password =$xp->make($adm_password, ['rounds' => 4]);
		
		  }else
		  {			
		  $data->adm_password =  $up->adm_password;
		  }
		  if($_FILES['adm_image']['size']!=0)
			 {	
			 $data->adm_image=$data->image_maker($_FILES['adm_image'],2,$n[2],"adm_image");      
			 }elseif(isset($_POST['tpimg_adm_image']) )
			 {
			 $data->image=$_POST['tpimg_adm_image'];
			 }else
			 {
				 $data->adm_image='';
			 }
		  
		  $data->adm_fullname = $adm_fullname;
		  $data->adm_email = $adm_email;
		  $data->adm_phone = $adm_phone;
		  $data->about = $about;
		  $data->role = "admin";
		  $data->created =$up->created;
		  $data->updated = date('Y-m-d H:i:s');
		  $data->status = "Active";
		  $data->id = $n[2];
		  $x= $data->update();
		  if(isset($_POST["check_adm_image"]))
			{
				$datas=self::find_by_id($n[2]);
				$adm_image='';
				unlink($_SERVER['DOCUMENT_ROOT']."/".MYF.$data->image_path($datas->adm_image));
				$data->empty_imgae($n[2],'adm_image');
			}
		  if(is_array($x))
		  {
			echo  output_message($x[1],$x[0]);
			redirect_by_js(TP_BACK_SIDE.$n[0].DS.$n[1].DS.$n[2],1000);
		}
		}
		$data= self::call_cl_fun();
		$rw = self::find_by_id($n[2]);
		$impath=$data->image_path($rw->adm_image);	
		$adm_image=$rw->adm_image;
		$adm_username = $rw->adm_username;
		$adm_password = '';
        $adm_fullname = $rw->adm_fullname;
        $adm_email = $rw->adm_email;
		$adm_phone = $rw->adm_phone;
        $about = $rw->about;       
        $role = $rw->role;     
        
        $adm_image = $rw->adm_image;
        $password = '';
		//echo $fo=Forms::image_edit("Avatar image","adm_image",$impath,$adm_image,"checkbox");
		echo $fo=Forms::image_edit("Upload image","adm_image",$impath,$adm_image);	

        echo $fo = Forms::input("Username", "adm_username", $adm_username, 1);
        echo $fo = Forms::password("Password", "adm_password",$adm_password, 0);
        echo $fo = Forms::input("Full Name", "adm_fullname", $adm_fullname, 1);
        echo $fo = Forms::email("Email", "adm_email", $adm_email, 1);
		echo $fo = Forms::input("Phone", "adm_phone", $adm_phone, 1);
        echo $fo = Forms::textarea("About", "about", $about, "", 0);
        echo $fo = Forms::submit();
        echo $fo = Forms::form_end();
       
		 include_layout_admin('footer.php');
    }
	public function show()
    {
        $table=self::$table_name;
		include_layout_admin('header.php');
        $n=url_name();
		$n[]="add";
		$n[]="Add ".ucfirst($table);
		breadcrumbs($n);
		echo'<form name="form" action="deleteall.php" method="post">
            <div class="table-responsive" data-pattern="priority-columns">
            <table id="'.$table.'" class="table table-hover non-hover" style="width:100%">
             
              <thead>
               <tr>
                  <th><input type="checkbox" name="checkall"/>
                    Id</th>
                  <th >Full Name</th>
				  <th >Email</th>
				  <th >Phone</th>
                  <th >Status</th>
                  <th >Options </th>
                </tr>
              </thead>
              
            </table></div>
          </form>';
		include_layout_admin('footer.php');		
	}
	
	public function loghistory() {
		$table=self::$table_name;
		include_layout_admin('header.php');
        $n=url_name();
		$n[]="add";
		$n[]="Add ".ucfirst($table);
		breadcrumbs($n);
		$dps='';
$link='';
$maction='clear';
$logfile = SITE_ROOT.DS.'logs'.DS.'log.txt'; 
  ?> 
  <!-- /.col-xl-6 col-12 -->
  <div class="card-content">
  <ul class="list-inline text-right">
      <li class="margin-bottom-10 "><a href="<?=TP_BACK_SIDE?>users/loghistoryclear" class="btn btn-primary btn-rounded waves-effect waves-light">Clear History</a></li>
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
			echo'<a href="#" class="list-group-item">									
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
	
	include_layout_admin('footer.php');	  
	 }
	 public static function loghistoryclear() {
		$table=self::$table_name;
		include_layout_admin('header.php');
        $n=url_name();
		$n[]="add";
		$n[]="Add ".ucfirst($table);
		breadcrumbs($n);
		$logfile = SITE_ROOT.DS.'logs'.DS.'log.txt';
		file_put_contents($logfile, '');
		  // Add the first log entry
		log_action('Logs Cleared', "by User ID : {$_SESSION['user_id']}");
		// redirect to this same page so that the URL won't 
		// have "clear=true" anymore
		 $message='Success! Clear the history';	
	
	echo output_message("success",$message);
	redirect_by_js("loghistory",1000);
	
	include_layout_admin('footer.php');   
	 }
}

