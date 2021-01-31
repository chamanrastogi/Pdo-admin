<?php
require_once (LIB_PATH.DS.'database.php');

class Slider extends DatabaseObject
{
    protected static $table_name = "slider";
    protected static $db_fields = array(
        'id',
        'name',
        'text',
        'link',
        'image',
        'sort',
        'status'
    );
    protected static $db_value = array(
	    ':id'=>'id',        
        ':name'=>'name',   
        ':text'=>'text',   
        ':link'=>'link',   
        ':image'=>'image',   
        ':sort'=>'sort',   
        ':status'=>'status'
    );
    protected static $folder = "slider";
    public $id;
    public $name;
    public $text;
    public $link;
    public $image;
    public $sort;
    public $status;

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
                return $msg['message'] = 'Data Updated Successfully';
            }
            else
            {
                return $msg['message'] = 'Data not Updated';
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
}

