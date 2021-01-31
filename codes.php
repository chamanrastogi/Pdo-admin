<?php
include ("includes/initialize.php");
global $database;

echo '<br>---------------------Check Slider Model---------------------------------<br>';
$s = new Slider_mo();
$s->gamer();

$s = new Slider();

echo '<br>---------------------Select All Record---------------------------------<br>';
$rts = $s->find_all();

//print_r($rts);
foreach ($rts as $row)
{
    echo $row->name, "<br>";
}
echo '<br>-------------------- Find Where ----------------------------------<br>';
$rts = $s->find_Where(" id >3 ");

//print_r($rts);
foreach ($rts as $row)
{
    echo $row->name, "<br>";
}

echo '<br>---------------------Find Record (2)---------------------------------<br>';

$rts = $s->find_by_id(2);
print_r($rts->name);
//echo '<pre>',print_r($database->fetch_array($rts)),'</pre>';
echo '<br>-------------------- Update Record ----------------------------------<br>';
$s->id = 2;
$s->name = "mohan";
$x = $s->update();
echo $x;
echo '<br>-------------------- Count Record ----------------------------------<br>';
//$rts=$s->find_all();
//echo $rtd=count($rts);
echo $x = $s->count_all();
echo '<br>-------------------- Insert Record----------------------------------<br>';
//
//$s->name="Slider".$x;
//$s->text="Some Text here";
//$s->link="adadasd";
//$s->image=$x.".jpg";
//$s->sort=$x+1;
//$s->status="Active";
//echo $x=$s->create();
echo '<br>-------------------- Count by x Record (sort=6) ----------------------------------<br>';
echo $x = $s->count_by_x('sort', 6);

echo '<br>-------------------- delete by id Record ----------------------------------<br>';
//echo $x=$s->delete(6);

$menu1=Menus::find_by_group_all(0);
					foreach($menu1 as $menus)
					{
					echo 	$menus->id."<br>";
						
						}

$database->close_connection();
?>
