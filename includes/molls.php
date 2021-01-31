<?php
require_once (LIB_PATH . DS . 'database.php');
class Molls extends DatabaseObject
{
    protected static $table_name = "molls";
    protected static $db_fields=array('id','name','slug','image','front','text');
	
    public $id;
    public $name;
    public $slug;
    public $image;
    public $front;
    public $text;
    protected $folder = "molls";
    public $errors = array();

    public static function call_cl_fun()
    {
        return (new Molls());
    }

    public static function hd_css()
    {
    }
    public static function hd_script()
    {
    }
    public static function extra_script()
    {
    }
    public function fetch_mode($rts)
    {
        $rts->setFetchMode(PDO::FETCH_CLASS, self::$table_name);
    }
    public function find_all()
    {
          global $database;
            $sql = "SELECT * FROM `" . self::$table_name . "`";
            $sql = $database->query($sql);
            self::fetch_mode($sql);
            $result = $sql->fetchall(PDO::FETCH_OBJ);
            $database->confirm_query($result);
            return $result;
       
    }
    public function find_by_id($id)
    {
        global $database;
        $sql = "SELECT * FROM " . self::$table_name . " WHERE id=" . $database->escape_value($id) . " LIMIT 1";
        $sql = $database->query($sql);
        self::fetch_mode($sql);
        $result = $sql->fetch(PDO::FETCH_OBJ);
        return $result;
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

    private function has_attribute($attribute)
    {

        // We don't care about the value, we just want to know if the key exists
        // Will return true or false
        return array_key_exists($attribute, $this->attributes());
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

    public function create()
    {
        global $database;
        $attributes = $this->attributes();
        $sql = "INSERT INTO " . self::$table_name . " (";
        $sql .= join(", ", array_keys($attributes));
        $sql .= ") VALUES (";
        $sql .= join(", ", array_values($attributes));
        $sql .= ")";
        $sql = $database->prepare($sql);
        $sql->execute($attributes);
        $result = $sql->rowCount();
        return $result;

    }
    public function update()
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
        $sql->execute($attributes);
        $result = $sql->rowCount();
        return $result;

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

