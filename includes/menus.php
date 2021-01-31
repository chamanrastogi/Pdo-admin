<?php
	require_once(LIB_PATH.DS.'database.php');
	class Menus extends DatabaseObject {
	protected static $table_name="menus";
	protected static $db_fields=array('id','parent_id','title','url','class','position','group_id','status');
	protected static $db_value=array(':id'=>'id',':parent_id'=>'parent_id',':title'=>'title',':url'=>'url',':class'=>'class',':position'=>'position',':group_id'=>'group_id',':status'=>'status');
	
    public $id;
    public $parent_id;
    public $title;
    public $url;
    public $class;
    public $position;
    public $group_id;
    public $status;
    protected $folder="menus";
    public $errors=array();
  
    public static function call_cl_fun() {
    return (new Menus());
    }
        public static function hd_css()
    {
    }
    public static function hd_script()
    {
    }
    public static function extra_script()
    {
    } public function fetch_mode($rts)
    {
        $rts->setFetchMode(PDO::FETCH_CLASS, self::$table_name);
    }
    public function find_by_group_all($parent_id=0)
    {
        try
        {
            global $database;
            $sql = "SELECT * FROM ".self::$table_name." WHERE status='Active' AND class=1 AND parent_id='".$parent_id."' ORDER BY  `position` ASC";
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
    public function find_by_x_one($field='',$value='')
    {
        try
        {
            global $database;
			$idnum=$id;
            $sql = "SELECT * FROM " . self::$table_name . " WHERE ".$field."=? LIMIT 1";
            $sql = $database->prepare($sql);
			$sql->bindparam(1,$value);
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
    public static function count_by_x($field , $value = '')
    {
        global $database;
        $sql = "SELECT COUNT(*) FROM " . self::$table_name . " WHERE " . $field . "='".$value."' ";       
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
    public static function position($value)
    {
        global $database;
        $sql = "SELECT COUNT(*) FROM " . self::$table_name . " WHERE `group_id`='".$value."' AND  `position`!=0 ";
        $result = $database->query($sql)->fetchColumn();
        return $result+1;
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
                
                    $i++;
                    $attributes[$field] =":".$field;
                
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
		//	$attributes2 = $this->attributes();
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
                $msg[] = 'Data not Updated';
				$msg[] = 'Error';
				 return $msg;
            }
        }
        catch(Exception $e)
        {
           // print_r($e->errorInfo[2]);
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