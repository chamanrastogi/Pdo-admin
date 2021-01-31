<?php
$n=url_name();
global $other;
 if(count($n)==1)
	 {
		 $class_name=$url;
	 }elseif(count($n)==2)
	 {
		 $class_name=ucfirst($n[0]);
		 $class_action_name=ucfirst($n[1]);
		 }
		elseif(count($n)==3)
	 {
		 $class_name=ucfirst($n[0]);
		 $class_action_name=ucfirst($n[1]);
		 $class_action_id=$n[2];
		}
?>


