<?php
    require_once(LIB_PATH.DS.'database.php');
    use Intervention\Image\ImageManager;
	class Testimonial extends DatabaseObject {
	protected static $table_name="testimonial";
	protected static $db_fields=array('id','name','post','image','text','status');
	protected static $db_value=array(':id'=>'id',':name'=>'name',':location'=>'location',':image'=>'image',':text'=>'text',':status'=>'status');
	
    public $id;
    public $name;
    public $location;
    public $image;
    public $text;
    public $status;
    protected $folder="testimonial";
    public $errors=array();
  
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
     public function fetch_mode($rts)
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
 public static function count_by_where($code)
    {
        global $database;
        $sql = "SELECT COUNT(*) FROM " . self::$table_name . " WHERE " . $code . " ";       
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
 public static function count_by_x2($field , $value = '',$field2 , $value2 = '')
    {
        global $database;
        $sql = "SELECT COUNT(*) FROM " . self::$table_name . " WHERE " . $field . "='".$value."'  AND " . $field2 . "='".$value2."' ";       
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
                return $msg['message'] = 'Data not Inserted';
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
		$msg[] = 'Error';
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
    }}