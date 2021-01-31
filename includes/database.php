<?php
require_once (LIB_PATH.DS."config.php");

class MySQLDatabase
{
    private $connection;

    function __construct()
    {
        $this->open_connection();
    }

    public function open_connection()
    {
        $servername = DB_SERVER;
        $myDB = DB_NAME;
        try
        {
            $this->connection = new PDO("mysql:host=$servername;dbname=$myDB", DB_USER, DB_PASS);
            // set the PDO error mode to exception
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "<strong style="color:red">Connected successfully</strong>";
            
        }
        catch(PDOException $e)
        {
            echo '<strong style="color:red">Database connection failed:</strong>  ' . $e->getMessage();
            die();
        }
    }
    public function close_connection()
    {
        if (isset($this->connection))
        {
            $this->connection = null;
        }
    }
	
    public function query($sql)
    {
        $result = $this->connection->query($sql);
        return $result;
    }
	public function num_rows()
    {
        $result = $this->connection->fetchColumn();
        return $result;
    }
	public function prepare($sql)
    {
        $result = $this->connection->prepare($sql);
        return $result;
    }
	 public function escape_value($value)
    {
        $value=$this->connection->quote($value);
        return $value;
    }
   public function insert_id()
    {
      return $this->connection->lastInsertId(); 
	}
	 public function confirm_query($error)
    {
		$actual_link = '';
		try
        {
			return $error;
		}
		catch(Exception $e)
        {
            //print_r($e->errorInfo);
           // $output = "<div class='da-message error'>Database query failed: " . $message = $e->errorInfo[2] . "<div>";
			//$output .= "Last SQL query: " . $this->connection->InsertId();
            //$actual_link ='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ;          
            die($output);
        }
        
    }
   
}
$database = new MySQLDatabase();
$db = & $database;
?>
