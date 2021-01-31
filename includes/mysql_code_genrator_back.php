<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once(LIB_PATH.DS.'database.php');

class Mysql_code_genrator extends DatabaseObject {


        public static function create($table,$value) {
        //Genrate Table 

		$count=sizeof($value);
		
		$i=0;
		$x="CREATE TABLE `".$table."` (
		`id` int AUTO_INCREMENT primary key,";
		while($i!=$count)
		{
		   $x.= "`". $value[$i]."` ".$value[$i+1];
		   if($i!=$count-2)
		   {
		   $x.=",";
		}
		   $i=$i+2;
		
		}
        $x.=") ENGINE=InnoDB DEFAULT CHARSET=latin1";
        global $database;
        return $database->query($x);    
  }
   public static function showlist($table,$formx) { 
   global $database;
$q = $database->prepare("DESCRIBE molls");
$q->execute();
$table_fields = $q->fetchAll(PDO::FETCH_COLUMN);
$total=$q->columnCount();
for ($counter = 0; $counter < $total; $counter ++) { 
$fieldnames[]= $table_fields[$counter]; 
}
 
    $i=0;
    $x1=0;
    $xp='';
    $fo='';
    $type='$type';
    $data='$data';
    $id='$id';
    $pp='$pp';
    $sl='$sl';
    $fo='$fo';
    $rw='$rw';
    $_GET='$_GET';
    $_POST='$_POST';
    $message='$message';
    $me="'.TP_BACK.'";
    $x=implode("','",$fieldnames);
    $x="'".$x."'";
	$db_fields='';
	$x1='';	
	$x1.="<?php
	require_once(LIB_PATH.DS.'database.php');"; 
   
    $x1.="
	class ".ucfirst($table)." extends DatabaseObject {
	";	
	$x1.="protected static $".'table_name="'.$table.'";
	';
	$x1.="protected static $".'db_fields=array('.$x.');
	';

    foreach ($fieldnames as $f) { 
    $x1.="
    public $".$f.";"; 
    }
	if($f=='image')
	{
		self::create_dir($table);
	}
    $x1.='
    protected $folder="'.$table.'";';
    $x1.='
    public $errors=array();
  
    public static function call_cl_fun() {
    return (new '.ucfirst($table).'());
    }
    ';
    $path="includes/temp/header.txt";
    $myfile = fopen("$path", "r") or die("Unable to open file!");
	while(!feof($myfile)) {
	$xp.=fgets($myfile);
	}
	fclose($myfile);
	$x1.=$xp;

    $path="includes/temp/common.txt";
    $myfile = fopen("$path", "r") or die("Unable to open file!");
    while(!feof($myfile)) {
    $x1.=fgets($myfile);
	}
	$x1.="}";
     return $x1; 
}


	public static function cc($table,$formx)
	{
	  $xp='';
	
  //Genrate Class
    $text=Mysql_code_genrator::showlist($table,$formx);  
	$path="includes/".$table.".php";
	if (file_exists($path)) 
	{
	echo "<br><strong>The file Path :</strong> <span style='color:red'>".$path."</span> <strong>already exists</strong><br>";
	}
	else
	{
	$myfile = fopen("$path", "w") or die("Unable to open file!");
	fwrite($myfile, $text);
	echo "<br><strong>".ucfirst($table).".php</strong> is created";
	fclose($myfile);
	}
  }


  public static function showfields($table) { 
  global $database;
  $x1='';
  $result = $database->query("SHOW COLUMNS FROM ". $table); 
  $x='';
  $fieldnames=array(); 
  if ($database->num_rows($result) > 0) { 
  while ($row = $database->fetch_assoc($result)) { 
  $fieldnames[] = $row['Field']; 
  } 
  } 
  $i=0;
  $z=sizeof($fieldnames);
  return $x1; 
}
 public static function blueprint($table,$path,$value)
  {
	  if (file_exists($path)) 
	{
$myfile = fopen($path."".$table.".txt", "w") or die("Unable to open file!");

$txt = $value;
fwrite($myfile, $txt);
fclose($myfile);
	}else
	{
		echo "<br><strong>The Blueprint File of ".$table." :</strong> <span style='color:red'>".$path."</span> <strong>already exists</strong><br>";
		}
  }
  public static function createmodel($table,$path)
  {
	 if (file_exists($path)) 
	{  
  $x1="<?php
	require_once(LIB_PATH.DS.'database.php');";    
    $x1.="
	class ".ucfirst($table)."_mo extends ".ucfirst($table)." {
	}";	
	$myfile = fopen($path."".$table."_mo.php", "w") or die("Unable to open file!");
    $txt =$x1;
    fwrite($myfile, $txt);
    fclose($myfile);
	}else
	{
		echo "<br><strong>The Model File of ".$table." :</strong> <span style='color:red'>".$path."</span> <strong>already exists</strong><br>";
		echo "<br>";}
	}
	public static function clearall($table)
  { 
      global $database;
	  $n=0;
	  $class_name="includes".DS.$table.".php";
	  $class_model="includes".DS."model".DS.$table."_mo.php";
	  $blueprint="includes".DS."blueprint".DS.$table.".txt";
	  $ajax_file="public".DS."resources".DS."ajax_".$table.".php";
	  if (file_exists($class_name)) 
	{ 
	echo "Class File Found"."<br>";
	 unlink($class_name) ? true : false;
	$n++;
	}
	if (file_exists($ajax_file)) 
	{ 
	echo "Class Ajax File Found"."<br>";
	 unlink($ajax_file) ? true : false;
	$n++;
	}
	if (file_exists($blueprint)) 
	{ 
	echo "Class Blueprint File Found"."<br>";
	 unlink($blueprint) ? true : false;
	$n++;
	}
	if (file_exists($class_model)) 
	{ 
	echo "Class Model File Found"."<br>";
	 unlink($class_model) ? true : false;
	$n++;
	}
	$val = $database->query('select 1 from `'.$table.'` LIMIT 1');   
	if($val !== FALSE)
{
   echo'DO SOMETHING! IT EXISTS!<br>';
  $val = $database->query('Drop TABLE `'.$table.'`');
  if($val)
  {
	  echo  "All good";
	  }
}
else
{
    echo "Table Not Found";
}
  }
  public static function vc($l)
  {
$x="varchar(".$l.")NOT NULL";
    return $x;
  }
  public static function int()
  {
    $x="int(11)NOT NULL";
    return $x;
  }
  public static function ints($l)
  {
    $x="int(".$l.")NOT NULL";
    return $x;
  }
  public static function text()
  {
    $x="text NOT NULL";
    return $x;
  }
  public static function mtext()
  {
    $x="mediumtext NOT NULL";
    return $x;
  }
  public static function date()
  {
    $x="date DEFAULT '0000-00-00'";
    return $x;
  }
  public static function datetime()
  {
    $x="DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP";
    return $x;
  }
  public static function create_dir($dirname=''){
	  
	  mkdir(SITE_ROOT.DS."public".DS."editor".DS."files".DS."Uploads".DS.$dirname);
	  }
  public static function enum($values)
  {
    $out=self::converts($values);
    $x="enum(".$out.") NOT NULL";
    return $x;
  }
  public function converts($values)
  {
    //print_r($values);
    $i=0;
    $count=sizeof($values);
    $x='';
    while($i!=$count)
    {
          $x.= "'". $values[$i]."'";
          if($i!=$count-1)
          {
          $x.=",";
          
          }
          
          $i++;
         
    }
        return $x;
  }
  public static function input($n)
  {
    $x='$fo=Forms::input2("'.ucfirst($n).'","'.$n.'",$'.$n.');';
    return $x;
  }
  public static function textarea($n)
  {
    $x='$fo=Forms::textarea("'.ucfirst($n).'","'.$n.'",$'.$n.',"");';
    return $x;
  }
}