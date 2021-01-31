<?php
include('includes/initialize.php');
$s = new Users();

$found= $s->count_by_x("adm_username","admin");
if($found==1)
{
$found= $s->find_by_x("adm_username","admin");
//echo $found->adm_email;
	}
//$s->adm_username="Chaman Rastogi";
//$s->adm_password="123456";
//$s->adm_image="ad.jpg";
//$s->adm_email="chaman@gmail.com";
//$s->adm_phone="2342342333";
//$s->role=1;
//$s->about="sadasd";
//$s->created=date('Y-m-d H:i:s');
//$s->updated=date('Y-m-d H:i:s'); 
//$s->status="Active";
//echo $x=$s->create();

$data = new Menus();
$data->id=NULL;
$data->title="about";
$data->parent_id=0;

$data->url="about";

$data->class=1;
//$pos=$data->position($group_id);
$data->position=1;
$data->group_id=1;
$data->status="Active";
$data->create();
?>