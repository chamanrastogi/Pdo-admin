<?php
//error_reporting(0);
include('includes/initialize.php');
$data = new Mysql_code_genrator();

//---------------blueprint Area------------------//

$table="menucat";   //-------------table name---------//

$str="$"."str";
$str1="$"."str1";
$str2="$"."str2";
$int="$"."int";
$ints="$"."ints";
$date="$"."date";
$text="$"."text";
$mtext="$"."mtext";
$datetime="$"."datetime";
$date="$"."date";
$enum="$"."enum";

$blueprint_code="
Table :--$table

Mysql Code :--['name',$str]

"."Form Code :--".'$fdata->co("input","name",1)';
$data->blueprint($table,"includes/blueprint/",$blueprint_code);

//---------------------End The Blueprint Area------------------//

$str=$data->vc(100);
$str1=$data->vc(255);
$str2=$data->vc(500);
$int=$data->int();
$ints=$data->int(20);
$date=$data->date();
$text=$data->text();
$mtext=$data->mtext();
$datetime=$data->datetime();
$date=$data->date();

$val=['Active','Deactive'];
$enum=$data->enum($val);
$status=['status',$enum];
$timestamp=['created',$datetime,'updated',$datetime];
//echo $em;

//-------------------------------------------------------------------------------------------------------------

$main=['name',$str];
//$vrs=array_merge($main,$timestamp,$status);
$vrs=array_merge($main,$status);
//print_r($vrs); //-Show the merged array
$ch1=sizeof($vrs);
echo "<strong>Created Table Name:</strong>".ucfirst($table)."<br><strong>No of Fields In Tables Total :</strong>".( $ch1/2). "<br>-----------------------<br>";
//print_r($vrs); //-Show the merged array
//------------------------------------------------Form Maker------------------------------------------------------
$fdata = new formstruck();
$fromx= $fdata->co("input","name",1);
 //$fromx=$fdata->select("Class","cl_id","sclass","cl_id",1).$fdata->co("input","name",1).$fdata->image("Image Upload","image").$fdata->text("small","small",1);

//--------------------------------------------------End Form Maker---------------------------------------------------------
$data->create($table,$vrs);
$ro=$data->showlist($table,$fromx);
$data->createmodel($table,"includes/model/");
//echo $ro;
$data->cc($table,$fromx);


 //-------------Remove table and class name---------//

//$table="client";  
//echo $x=$data->clearall($table);

?>
