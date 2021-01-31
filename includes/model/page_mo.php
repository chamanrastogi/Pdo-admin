<?php
	require_once(LIB_PATH.DS.'database.php');
	class Page_mo extends Page {
		
		public function add()
    {
		include_layout_admin('header.php');
		$n=url_name();
		$n[]="show";
		$n[]="Show Page";
		breadcrumbs($n);
        include_layout_admin('breadcrumbs.php');
		$n=url_name();
        echo $fo = Forms::form_start();
		 if (isset($_REQUEST['submit']))
        {
          $data = self::call_cl_fun();
		  $image_name = '';
          $temp = '';
          $checkbox = '';
		  extract($_POST);
		  // print_r($_POST);
		  //exit();
		 
		  $data->mid = $mid;
		  $data->title = $title;
		  $data->heading = $heading;
		  if($_FILES['image']['size']!=0)
		  {	
		  $data->image=$data->image_maker($_FILES['image'],2,$id,"image");      
		  }
		  $data->keyword = $keyword;
		  $data->description = $description;		  
		  $data->text = $text;		  
		  $data->status = "Active";
		  $x= $data->create();
		 
		  if(is_array($x))
		  {
			echo  output_message($x[1],$x[0]);
			redirect_by_js(TP_BACK_SIDE.$n[0].DS.$n[1],1000);
		}
		}
    $mid='';	
    $title='';	
	$heading='';
	$keyword='';	
    $description='';	
    $image='';
	$impath='';
    $text='';
		self::menu($mid);
        echo $fo=Forms::input("Name","title",$title,1);
		echo $fo=Forms::input("Heading","heading",$heading,0);		   
        echo $fo=Forms::textarea("Keyword","keyword",$keyword,'',0);
        echo $fo=Forms::textarea("Description","description",$description,'',0);          
		echo $fo=Forms::image("Upload image","image");
		echo $fo=Forms::text_editor("Text","text",$text,'editors','editors');          	
        echo $fo = Forms::submit();
        echo $fo = Forms::form_end();
        include_layout_admin('footer.php');
	}
	
	 public function edit()
    {
		include_layout_admin('header.php');
		$n=url_name();
		$n[]="show";
		$n[]="Show Page";
		breadcrumbs($n);
        include_layout_admin('breadcrumbs.php');
		$n=url_name();
        echo $fo = Forms::form_start();
		 if (isset($_REQUEST['submit']))
        {
          $data = self::call_cl_fun();
		  $image_name = '';
          $temp = '';
          $checkbox = '';
		  extract($_POST);
		  // print_r($_POST);
		  //exit();
		 
		  $data->mid = $mid;
		  $data->title = $title;
		  $data->heading = $heading;
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
		  $data->keyword = $keyword;
		  $data->description = $description;		  
		  $data->text = $text;		  
		  $data->status = "Active";
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
		  $mid=$rw->mid;       
		  $title=$rw->title;
		  $heading=$rw->heading;		  
		  $keyword=$rw->keyword;
		  $description=$rw->description;
		  $impath=$data->image_path($rw->image);		
		  $image=$rw->image;
		  $text=$rw->text;

		self::menu($mid);
        echo $fo=Forms::input("Name","title",$title,1);
		echo $fo=Forms::input("Heading","heading",$heading,0);		   
        echo $fo=Forms::textarea("Keyword","keyword",$keyword,'',0);
        echo $fo=Forms::textarea("Description","description",$description,'',0);          
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
			   <th><input type="checkbox" name="checkall"/>Id</th>
			    <th>Name</th>
			    <th>Menu Name</th>
			    <th>Image</th>
			    <th>Options </th>
               </tr>
              </thead>              
            </table>
		    </div>
          </form>';
		include_layout_admin('footer.php');		
	}
	}