<?php
	require_once(LIB_PATH.DS.'database.php');
  class Testimonial_mo extends Testimonial 
  {
      public function add()
	{
        $table=self::$table_name;
        include_layout_admin('header.php');
			$n=url_name();
			$n[]="show";
			$n[]="Show ".ucfirst($table);
			breadcrumbs($n);
			include_layout_admin('breadcrumbs.php');
			$n=url_name();
			echo $fo = Forms::form_start();
			 if (isset($_REQUEST['submit']))
			{
			  $data = self::call_cl_fun();
		
			  extract($_POST);
			  //print_r($_POST);
			 //exit();
			 $id=0;
			 $data->name=$name;
			 $data->location=$location;			
			 
				 if($_FILES['image']['size']!=0)
				 {	
				 $data->image=$data->image_maker($_FILES['image'],2,$id,"image");      
				 }
				 $data->text=$text;
                 $data->status="Active";
			    $x= $data->create();
			 
			  if(is_array($x))
			  {
				echo  output_message($x[1],$x[0]);
				redirect_by_js(TP_BACK_SIDE.$n[0].DS.$n[1],1000);
			}
			}
			$name='';
			$location='';
			$link='';		
			$text='';
			
			
			echo $fo=Forms::input("Name","name",$name,1);
			echo $fo=Forms::input("Location","location",$location,0);		
			echo $fo=Forms::image("Upload image","image");
			echo $fo=Forms::text_editor("Text","text",$text,'editors','editors');	  
			echo $fo = Forms::submit();
			echo $fo = Forms::form_end();
			include_layout_admin('footer.php');
	
    }
    public function edit()
	{
        $table=self::$table_name;
        include_layout_admin('header.php');
        $n=url_name();
        $n[]="show";
        $n[]="Show ".ucfirst($table);
        breadcrumbs($n);
        include_layout_admin('breadcrumbs.php');
        $n=url_name();
        echo $fo = Forms::form_start();
         if (isset($_REQUEST['submit']))
        {
          $data = self::call_cl_fun();
    
          extract($_POST);
          //print_r($_POST);
         //exit();
         
         $data->name=$name;
		 $data->location=$location;	        
         
         
         if($_FILES['image']['size']!=0)
         {	
         $data->image=$data->image_maker($_FILES['image'],2,$n[2],"image");      
         }elseif(isset($_POST['tpimg_image']) )
         {
         $data->image=$_POST['tpimg_image'];
         }else
         {
             $data->image='';
         }
         
             $data->text=$text;
             $data->status="Active";				 
             $data->id = $n[2];
             $x= $data->update();
             if(isset($_POST["check_image"]))
             {
                 $datas=self::find_by_id($n[2]);
                 $image_name='';
                 unlink($_SERVER['DOCUMENT_ROOT']."/".MYF.$data->image_path($datas->image));
                 $data->empty_imgae($n[2]);
             }
             if(is_array($x))
             {
             echo  output_message($x[1],$x[0]);
             redirect_by_js(TP_BACK_SIDE.$n[0].DS.$n[1].DS.$n[2],1000);
             }
             }
             $data= self::call_cl_fun();
             $rw = $data->find_by_id($n[2]);
             $name=$rw->name;
             $impath=$data->image_path($rw->image);		
             $image=$rw->image;
             $location=$rw->location;             
             $text=$rw->text;           
             $status=$rw->status;
        
        echo $fo=Forms::input("Name","name",$name,1);
        echo $fo=Forms::input("Location","location",$location,1);      
        echo $fo=Forms::textarea("Text","text",$text,'',0);
        echo $fo=Forms::image_edit("Upload image","image",$impath,$image);	
        echo $fo=Forms::text_editor("Description","text",$text,'editors','editors');	  
        echo $fo = Forms::submit();
        echo $fo = Forms::form_end();
        include_layout_admin('footer.php');
    }
    public function show()
	{
        $table=self::$table_name;
		include_layout_admin('header.php');
        $n=url_name();
		$n[]="add";
		$n[]="Add ".ucfirst($table);
		breadcrumbs($n);
		echo'<form name="form" action="deleteall.php" method="post">
            <div class="table-responsive" data-pattern="priority-columns">
            <table id="'.$table.'" class="table table-hover non-hover" style="width:100%">
             
              <thead>
               <tr>
                  <th><input type="checkbox" name="checkall"/>
                    Id</th>
                  <th >Name</th>
                  <th >Image</th>
                  <th >Status</th>
                  <th >Options </th>
                </tr>
              </thead>
              
            </table></div>
          </form>';
		include_layout_admin('footer.php');		
	}
}