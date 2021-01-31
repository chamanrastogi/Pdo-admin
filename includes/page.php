<?php
    require_once(LIB_PATH.DS.'database.php');
    use Intervention\Image\ImageManager;
	class Page extends DatabaseObject {
	protected static $table_name="page";
	protected static $db_fields=array('id','mid','title','heading','keyword','description','image','text');
	protected static $db_value=array(':id'=>'id',':mid'=>'mid',':title'=>'title',':heading'=>'heading',':keyword'=>'keyword',':description'=>'description',':image'=>'image',':text'=>'text');
	
    public $id;
    public $mid;
    public $title;
    public $heading;
    public $keyword;
    public $description;
    public $image;
    public $text;
    protected $folder="page";
    public $errors=array();
  
    public static function call_cl_fun() {
    return (new Page());
    }
    public function image_path($image) {
        return FULL_PATH.$this->folder.DS.$image;
     }
     
     public function path() {
       return FULL_PATH.$this->folder.DS;
     }
     public static function hd_css() {
        $x=stylesheet_formate('assets/plugin/datatables/media/css/dataTables.bootstrap.min.css');
        $x.=stylesheet_formate('assets/plugin/datatables/extensions/Responsive/css/responsive.bootstrap.min.css');
        $x.=stylesheet_formate('assets/plugin/datatables/media/css/buttons.dataTables.min.css');
        $x.=stylesheet_formate('assets/plugin/datepicker/css/bootstrap-datepicker.min.css');
        $x.=stylesheet_formate('assets/plugin/touchspin/jquery.bootstrap-touchspin.min.css');
        $x.=stylesheet_formate('assets/plugin/lightview/css/lightview/lightview.css');        
        echo $x;
      } 
    public static function hd_script() {
        $x=script_formate('assets/plugin/datatables/media/css/dataTables.bootstrap.min.css');
        $x=script_formate('assets/plugin/datatables/media/js/jquery.dataTables.min.js');
        $x.=script_formate('assets/plugin/datatables/media/js/dataTables.bootstrap.min.js');
        $x.=script_formate('assets/plugin/datatables/media/js/dataTables.buttons.min.js');
        $x.=script_formate('assets/plugin/datatables/media/js/buttons.flash.min.js');
        $x.=script_formate('assets/plugin/datatables/media/js/jszip.min.js');
        $x.=script_formate('assets/plugin/datatables/media/js/pdfmake.min.js');
        $x.=script_formate('assets/plugin/datatables/media/js/vfs_fonts.js');
        $x.=script_formate('assets/plugin/datatables/media/js/buttons.html5.min.js');
        $x.=script_formate('assets/plugin/datatables/media/js/buttons.print.min.js');
        $x.=script_formate('assets/scripts/datatables.demo.min.js');
        $x.=script_formate('assets/scripts/image.js');
        $x.=script_formate('assets/plugin/lightview/js/lightview/lightview.js');
        $x.=script_formate('assets/plugin/validator/validator.min.js');        
        $x.=self::extra_script();
          echo $x;
      }
    public static function extra_script()
    {
        $table=self::$table_name;
	   ?>
	    <script type="text/javascript" language="javascript" >
	
			$(document).ready(function() {				
				var dataTable = $('#<?=$table?>').DataTable( {
					"processing": true,
		            "order": [[ 0, "desc" ]],
					"serverSide": true,                           
					 dom : 'lBfrtip',        
	"lengthMenu": [ [10, 25, 50, 100,1000,2000,3000,10000, -1], [10, 25, 50, 100,1000,2000,3000,10000] ],
    "pageLength": 10,
					"ajax":{
						url :"<?=TP_BACK?>resources/ajax_<?=$table?>.php", // json datasource
						type: "post", // method  , by default get
						data: {           
						action: '<?=$table?>',      // etc..
						},						
						error: function(){  // error handling
							$(".employee-grid-error").html("");
							$("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
							$("#employee-grid_processing").css("display","none");
							
						}
					}
				} );
			} );
		</script>

<?php
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
                if ($this->$field != '')
                {
                    $i++;
                    $attributes[$field] = "'" . $this->$field . "'";
                }
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


    public function create()
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
                $msg[] = 'Data Inserted Successfully';
		        $msg[] = 'Success';
                return $msg;
            }
            else
            {
                $msg[] = 'Data not Inserted';
		        $msg[] = 'Danger';
                return $msg;
            }
        }
        catch(Exception $e)
        {
            echo '<strong style="color:red">Error: </strong>' . $message = $e->errorInfo[2];
        }
    }
    public function update()
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
    public function Delete($id)
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
    public static function menu($id){
        ?>
   
   <div class="form-group">
     <label for="inputEmail3" class="col-md-3 control-label">Menus (<span class="errors">*</span>):</label>
     <div class="col-md-9">
       <select id="country" class="form-control" name="mid" required>
         <?php
               
                    
                   if($id=='')
                     {
                                           
               echo'<option selected="selected" value="0"> Please Select</option>';
           $menu1=Menus::find_by_group_all(0);
                       foreach($menu1 as $menus)
                       {			
                               $m=Menus::find_by_x_one($menus->id);
                               $m1=Page::count_by_x("mid",$menus->id);											
                                   
                               if($m1==0)
                               {
                                   $link=$menus->id;
                                   echo'<option value="'.$link.'">'.ucfirst($menus->title).'</option>';
                               }
                               
                               if($m!=0)
                               {
                               
                               $sub=Menus::find_by_group_all($menus->id);
                               foreach($sub as $ro)
                               {	
                               $m2=Menus::find_by_x_one($ro->id);
                               $rp1=Page::count_by_x("mid",$ro->id);
                                                           
                               if($rp1==0)
                               {
                                   $link=$ro->id;
                                   echo'<option value="'.$link.'">&nbsp;&nbsp;&nbsp;&nbsp;|-'.ucfirst($ro->title).'</option>';
                               }
                               
                           
                           if($m2!=0)
                               {
                               
                               $sub1=Menus::find_by_group_all($ro->id);
                           foreach($sub1 as $ro1)
                       {	
                               $m3=Menus::find_by_x_one($ro1->id);
                               $rp2=Page::count_by_x("mid",$ro1->id);
                               if($rp2==0 )
                               {
                                   $link=$ro1->id;
                                   echo'<option value="'.$link.'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|-|-'.ucfirst($ros->title).'</option>';
                               }
                               
                           
                           if($m3!=0)
                           
                               {
                               
                               $sub2=Menus::find_by_group_all($ro1->id);
                           foreach($sub2 as $ro2)
                       {	
                               $m3=Menus::find_by_x_one($ro2->id);
                               $rp3=Page::count_by_x("mid",$ro2->id);
                               if($rp3==0 )
                               {
                               $link=$ro2->id;
                               echo'<option value="'.$link.'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|-|-|-'.ucfirst($rop->title).'</option>';
                               }}}}}}}}
               }else{
                       $rw3 = Menus::find_by_id($id); 
                       ?>
         <option selected="selected" value="<?=$rw3->id?>">
         <?=$rw3->title?>
         </option>
         <?php
                            $row1 = Menus::find_all();
                       foreach($row1 as $row1) { 
                       if($row1->class==1)
                       {           
                   if($rw3->url!=$row1->url)
                   {            
                   if($row1->parent_id!=0)
                   {
                       $m1="--";
                   }
                   else
                   {
                       $m1="";
                   }
                     
                   echo '<option value='.$row1->id.'>'.$m1.''.ucfirst($row1->title).'</option>';
                   
                   }
                        }
                       }
                        }
                            ?>
       </select>
     </div>
   </div>
   <?php
        }
}