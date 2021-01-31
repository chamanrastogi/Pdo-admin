<?php
	require_once(LIB_PATH.DS.'database.php');
	use Intervention\Image\ImageManager;
	class Template extends DatabaseObject {
	protected static $table_name="template";
	protected static $db_fields=array('id','sitename','logo','favicon_logo','email','description','keyword','ana','footer');
	protected static $db_value=array(':id'=>'id',':sitename'=>'sitename',':logo'=>'logo',':favicon_logo'=>'favicon_logo',':email'=>'email',':description'=>'description',':keyword'=>'keyword',':ana'=>'ana',':footer'=>'footer');
	
    public $id;   
    public $sitename;    
    public $logo;
    public $favicon_logo;   
    public $email;  
    public $description;
    public $keyword;
    public $ana;
  	public $footer;
    protected $folder="template";
    public $errors=array();
  
    public static function call_cl_fun() {
    return (new Template());
    }
    public function image_path($image) {
        return FULL_PATH.$this->folder.DS.$image;
     }
     
     public function path() {
       return FULL_PATH.$this->folder.DS;
     }
	  public static function image_maker($image,$upload_size,$uid,$imgfield)
    {
	$data=self::call_cl_fun();
	$message='';
	$upload_size=($upload_size*1024)*1024;
	$data=self::call_cl_fun();
	$size=round($image['size']);
	$n=explode(".",$image['name']);
	$filename=$image["tmp_name"];
    $type=$n[1];	
	if($size>$upload_size)
	{
		
	$message='<div align="center">                
                <h4 class="alert alert-danger">Image Size is Larger Than 2MB '.$size.'Kb</h4>                
            </div>';
echo output_message($message);
redirect_by_js('',1000);
	exit();
	
		}
		if($type!='jpg' && $type!='jpeg' && $type!='png')
		{
			toast_msg("Error","","Image type is not jpg or png -".$type."",1000);
			$message='<div align="center">                
                <h4 class="alert alert-danger">Image type is not jpg or png - '.$type.'</h4>                
            </div>';
echo output_message($message);
redirect_by_js('',1000);
	?>
  
    <?php
	redirect_by_js('',100);
	exit();
	}	
	if($uid!='')
	{	
	$user=self::find_by_id($uid);
	if($user->$imgfield!='')
	{	
       
	unlink($_SERVER['DOCUMENT_ROOT']."/".MYF.$data->image_path($user->$imgfield));
	$data->empty_imgae($uid,$imgfield);
	}
	}	 
     $n=explode('.',$image['name']);
	 $imgname=$n[0]."_".rand(5, 8522166).".".$n[1];
	 // $date = date('m/d/Yh:i:sa', time());
        
//  $encname=$date; /$imgname=md5($encname).'.'.$n[0].'.'.$n[1];
	 $manager = new ImageManager(array('driver' => 'gd'));
	 $image = $manager->make($filename)->resize(800, null, function ($constraint) {
		$constraint->aspectRatio();
	})->save(SITE_ROOT.DS.$data->path().$imgname); 
     return $imgname;
	 
    }
	 protected function empty_imgae($id=0,$img) {
      global $database;
      $sql="UPDATE ".self::$table_name." SET `".$img."`='' WHERE  `id`=? ";      
      $sql = $database->prepare($sql);
	  $sql->bindparam(1,$id);
      $x = $sql->execute();      
      return $x;
       
    }	
     public static function hd_css() {
        $x=stylesheet_formate('assets/plugin/datatables/media/css/dataTables.bootstrap.min.css');
        $x.=stylesheet_formate('assets/plugin/datatables/extensions/Responsive/css/responsive.bootstrap.min.css');
        $x.=stylesheet_formate('assets/styles/jquery-ui.css');
        $x.=stylesheet_formate('elfinder/css/elfinder.min.css');
        $x.=stylesheet_formate('elfinder/css/theme.css');
        $x.=stylesheet_formate('assets/plugin/lightview/css/lightview/lightview.css');
        
            
            
        echo $x;
      } public static function hd_script() {
        $x=script_formate('assets/scripts/image.js');
        $x.=script_formate('assets/plugin/validator/validator.min.js');
        $x.=script_formate('elfinder/js/elfinder.min.js');
        $x.=script_formate('assets/plugin/lightview/js/lightview/lightview.js');
          echo $x;
      }	
       public static function other_script() {
           
           ?>
    <script type="text/javascript" charset="utf-8">
                // Documentation for client options:
                // https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
                $(document).ready(function() {
                    $('#elfinder').elfinder(
                        // 1st Arg - options
                        {
                            cssAutoLoad : false,               // Disable CSS auto loading
                            baseUrl : './',                    // Base URL to css/*, js/*
                            url : '<?=TP_BACK?>elfinder/php/connector.minimal.php'  // connector URL (REQUIRED)
                            // , lang: 'ru'                    // language (OPTIONAL)
                        },
                        // 2nd Arg - before boot up function
                        function(fm, extraObj) {
                            // `init` event callback function
                            fm.bind('init', function() {
                                // Optional for Japanese decoder "encoding-japanese.js"
                                if (fm.lang === 'ja') {
                                    fm.loadScript(
                                        [ '//cdn.rawgit.com/polygonplanet/encoding.js/1.0.26/encoding.min.js' ],
                                        function() {
                                            if (window.Encoding && Encoding.convert) {
                                                fm.registRawStringDecoder(function(s) {
                                                    return Encoding.convert(s, {to:'UNICODE',type:'string'});
                                                });
                                            }
                                        },
                                        { loadType: 'tag' }
                                    );
                                }
                            });
                            // Optional for set document.title dynamically.
                            var title = document.title;
                            fm.bind('open', function() {
                                var path = '',
                                    cwd  = fm.cwd();
                                if (cwd) {
                                    path = fm.path(cwd.hash) || null;
                                }
                                document.title = path? path + ':' + title : title;
                            }).bind('destroy', function() {
                                document.title = title;
                            });
                        }
                    );
                });
            </script>
    <?php
       } public function fetch_mode($rts)
    {
        $rts->setFetchMode(PDO::FETCH_CLASS, self::$table_name);
    }
    public function find_all()
    {
        try
        {
            global $database;
            $sql = "SELECT * FROM `" . self::$table_name . "`";
            $sql = $database->prepare($sql);
            $x = $sql->execute();
            self::fetch_mode($sql);
            $result = $sql->fetchall(PDO::FETCH_OBJ);            
            return $result;
        }
        catch(Exception $e)
        {
            //print_r($e->errorInfo);
            echo '<strong style="color:red">Error: </strong>' . $message = $e->errorInfo[2];
        }
    }
    public function find_by_id($id)
    {
        try
        {
            global $database;
			$idnum=$id;
            $sql = "SELECT * FROM " . self::$table_name . " WHERE id=? LIMIT 1";
            $sql = $database->prepare($sql);
			$sql->bindparam(1,$idnum);
            $x = $sql->execute();
            self::fetch_mode($sql);
            $result = $sql->fetch(PDO::FETCH_OBJ);
            return $result;
        }
        catch(Exception $e)
        {
            //print_r($e->errorInfo);
            echo '<strong style="color:red">Error: </strong>' . $message = $e->errorInfo[2];
        }
    }
    public function find_where($code = '')
    {
        try
        {
            global $database;
            $sql = "SELECT * FROM " . self::$table_name . " WHERE  " . $code . " ";
            $sql = $database->prepare($sql);
            $x = $sql->execute();
            self::fetch_mode($sql);
            $result = $sql->fetchall(PDO::FETCH_OBJ);
            $database->confirm_query($result);
            return $result;
        }
        catch(Exception $e)
        {
            //print_r($e->errorInfo);
            echo '<strong style="color:red">Error: </strong>' . $message = $e->errorInfo[2];
        }
    }
    public static function count_all()
    {
        global $database;
        $sql = "SELECT COUNT(*) FROM " . self::$table_name;
        $result = $database->query($sql)->fetchColumn();
        return $result;
    }
    public static function count_by_x($field = '', $value = 0)
    {
        global $database;
        $sql = "SELECT COUNT(*) FROM " . self::$table_name . " WHERE " . $field . "='" . $value . "' ";
        $result = $database->query($sql)->fetchColumn();
        return $result;
    }
protected function attributes()
    {
        $i = 0;
        // return an array of attribute names and their values
        $attributes = array();
        foreach (self::$db_fields as $field)
        {
            if (property_exists($this, $field))
            {
                $attributes['id'] = "NULL";
                
                    $i++;
                    $attributes[$field] = "'" . $this->$field . "'";
                
            }
        }
        return $attributes;
    }
   protected function attributes_new()
    {
        $i = 0;
        // return an array of attribute names and their values
        $attributes = array();
        foreach (self::$db_fields as $field)
        {
            if (property_exists($this, $field))
            {
              $attributes['id'] = ":id";
                if ($this->$field != '')
                {
                    $i++;
                    $attributes[$field] =":".$field;
                }
            }
        }
        return $attributes;
    }


    protected function create()
    {
        try
        {
			$i=0;
            global $database;
            $attributes = $this->attributes_new();
			$attributes2 = $this->attributes();
            $sql = "INSERT INTO " . self::$table_name . " (";
            $sql .= join(", ", array_keys($attributes));
            $sql .= ") VALUES (";
            $sql .= join(", ", array_values($attributes));
            $sql .= ")";		  
            $sql = $database->prepare($sql);
		
			foreach (self::$db_value as $field =>$value)
       		 {
			 // echo "Field:".	$field."=".$this->$value."<br>";
			$sql->bindValue($field,$this->$value);			
			 }		
            $x = $sql->execute();
            if ($x)
            {
                $database->insert_id();
                return $msg['message'] = 'Data Inserted Successfully';
            }
            else
            {
                return $msg['message'] = 'Data not Inserted';
            }
        }
        catch(Exception $e)
        {
            echo '<strong style="color:red">Error: </strong>' . $message = $e->errorInfo[2];
        }
    }
    protected function update()
    {
        try
        {
            global $database;
            $attributes = $this->attributes();
            $attribute_pairs = array();

            foreach ($attributes as $key => $value)
            {
                if ($key != 'id')
                {
                    $attribute_pairs[] = "`{$key}`={$value}";
                }
            }
            $sql = "UPDATE " . self::$table_name . " SET ";
            $sql .= join(", ", $attribute_pairs);
 			$sql .= " WHERE id=" . $database->escape_value($this->id);
		
            $sql = $database->prepare($sql);
            $x = $sql->execute($attributes);
            if ($x)
            {
            //$sql->rowCount();
            $msg[] = 'Data Updated Successfully';
		    $msg[] = 'Success';
            return $msg;
            }
            else
            {                
            $msg[] = 'Data not Updated';
		    $msg[] = 'Danger';
            return $msg;
		    }
        }
        catch(Exception $e)
        {
            echo '<strong style="color:red">Error: </strong>' . $message = $e->errorInfo[2];
        }
    }
    protected function Delete($id)
    {
        global $database;
        // Don't forget your SQL syntax and good habits:
        // - DELETE FROM table WHERE condition LIMIT 1
        // - escape all values to prevent SQL injection
        // - use LIMIT 1
        $sql = "DELETE FROM " . self::$table_name;
        $sql .= " WHERE id=" . $database->escape_value($id);
        $sql .= " LIMIT 1";
        $del = $database->prepare($sql);
        $del->execute();
        $result = $del->rowCount();
        return $result;
    }
	public static function backupsql() {
        $table=self::$table_name;
        include_layout_admin('header.php');
        $n=url_name();
        $n[]="#";
        $n[]="";		
		$data=Template_mo::backnow();
		backup_action('File Name', "{$data}");
        redirect_by_js("backnowhistory",100);
        include_layout_admin('footer.php');
  }
  public static function backnowhistory() {	
    $table=self::$table_name;
    include_layout_admin('header.php');
    $n=url_name();
    $n[]="#";
    $n[]="";
    breadcrumbs($n);
	Template_mo::backnow_his();
	include_layout_admin('footer.php');
  }
   public static function backuphistoryclear() {	
    $table=self::$table_name;
    include_layout_admin('header.php');
    $n=url_name();
    $n[]="#";
    $n[]="";
    breadcrumbs($n);	
    Template_mo::backuphistoryclears();
    include_layout_admin('footer.php');
		
  }
  public static function update_data($id) {
	  $tpimg_logo ='';
	$tpimg_favicon_logo='';
	   $data = self::call_cl_fun();
	   	extract($_POST);
	   $data->sitename=$sitename;

 if($_FILES['logo']['size']!=0)
	  {  
      $data->logo=$data->image_maker($_FILES['logo'],1,$id,"logo");  
	  }elseif(isset($_POST['tpimg_logo']))
	  {
		  $data->logo=$_POST['tpimg_logo'];
	  }
	  
	 if($_FILES['favicon_logo']['size']!=0)
	  {    
      $data->favicon_logo=$data->image_maker($_FILES['favicon_logo'],1,$id,"favicon_logo");  
	  } elseif(isset($_POST['tpimg_favicon_logo']))
	  {
		  $data->favicon_logo=$_POST['tpimg_favicon_logo'];
	  }
	$data->email=$email;

	$data->keyword=$keyword;
	$data->description=$description;
	$data->ana=$ana;
	$data->footer=$footer;	
	$data->id=1;
	$pp=$data->update();
	 if(isset($_POST["check_logo"]))
				 {
					 $datas=self::find_by_id(1);
					 $image_name='';
					unlink($_SERVER['DOCUMENT_ROOT']."/".MYF.$data->image_path($datas->logo));
					 $data->empty_imgae(1,'logo');
					 $msg[] = 'Data Updated Successfully';
		    		$msg[] = 'Success';
					$msg[]='Logo Image Deleted';
					$pp=$msg;
				 }
				  if(isset($_POST["check_favicon_logo"]))
				 {
					 $datas=self::find_by_id(1);
					 $image_name='';
					 unlink($_SERVER['DOCUMENT_ROOT']."/".MYF.$data->image_path($datas->favicon_logo));					
					$data->empty_imgae(1,'favicon_logo');
					$msg[] = 'Data Updated Successfully';
		    		$msg[] = 'Success';
					$msg[]='favicon Image Deleted';
					$pp=$msg;
				 }
	return $pp;
  }
	}