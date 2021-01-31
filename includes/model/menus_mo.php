<?php
	require_once(LIB_PATH.DS.'database.php');
	class Menus_mo extends Menus {

		public function add()
		{
			include_layout_admin('header.php');
			$n=url_name();
			$n[]="show";
			$n[]="Show menu";
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
			 
			    $data->title=$title;
				$data->parent_id=0;
				$rt=self::count_by_x("url",$url);
				if($rt==0)
				{
				$data->url=$url;
				}else
				{
				$message='<div align="center">                
								<h4 class="alert alert-danger">Page  Url! Already Exist</h4>
								<span><img src="'.TP_BACK.'assets/loaders/c_loader_re.gif" title="c_loader_re.gif"></span>
							</div>';	 

				echo output_message($message);
				redirect_by_js("add",1000);
				exit();
					}
				$data->class=$class;
				$pos=$data->position($group_id);
				$data->position=$pos;
				$data->group_id=$group_id;
				$data->status=$status;
			    $x= $data->create();
			 
			  if(is_array($x))
			  {
				echo  output_message($x[1],$x[0]);
				redirect_by_js(TP_BACK_SIDE.$n[0].DS.$n[1],1000);
			}
			}
			$title='';
			$url='';
			$class='';
			$group_id='';
			$status='';
			
			echo $fo=Forms::input("Name","title",$title,1);
			echo $fo=Forms::input("Url","url",$url,1);
			echo $fo=Forms::Select("Type",'class','menutype',$class,1);				
			echo $fo=Forms::Select_menu("Menu Group",'group_id','menu_group',$group_id,1);
			echo $fo=Forms::Select_status_av("Status","status",$status);
				  
			echo $fo = Forms::submit();
			echo $fo = Forms::form_end();
			include_layout_admin('footer.php');
		}
		public function edit()
		{
			include_layout_admin('header.php');
			$n=url_name();
			$n[]="show";
			$n[]="Show menu";
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
			 
			    $data->title=$title;
				$data->parent_id=0;
				 $rt=self::count_by_x2("url",$url,"id",$n[2]);
			
				if($rt<=1)
				{
				$data->url=$url;
				}else
				{
				echo $message='<div align="center">                
								<h4 class="alert alert-danger">Page  Url! Already Exist</h4>
								<span><img src="'.TP_BACK.'assets/loaders/c_loader_re.gif" title="c_loader_re.gif"></span>
							</div>';	 

				echo output_message($message);
				redirect_by_js(TP_BACK_SIDE.$n[0].DS.$n[1].DS.$n[2],1000);
				exit();
					}
				$data->class=$class;
				$pos=$data->position($group_id);
				$data->position=$pos;
				$data->group_id=$group_id;
				$data->status=$status;
				$data->id = $n[2];
				$x= $data->update();
			
			  if(is_array($x))
			  {
								
				echo output_message($x[1],$x[0]);			
			    redirect_by_js(TP_BACK_SIDE.$n[0].DS.$n[1].DS.$n[2],1000);
			}
			}
			$rw = self::find_by_id($n[2]);
			$title=$rw->title;
			$url=$rw->url;
			$class=$rw->class;
			$group_id=$rw->group_id;
			$status=$rw->status;
			
			echo $fo=Forms::input("Name","title",$title,1);
			echo $fo=Forms::input("Url","url",$url,1);
			echo $fo=Forms::Select("Type",'class','menutype',$class,1);				
			echo $fo=Forms::Select_menu("Menu Group",'group_id','menu_group',$group_id,1);
			echo $fo=Forms::Select_status_av("Status","status",$status);
				  
			echo $fo = Forms::submit();
			echo $fo = Forms::form_end();
			include_layout_admin('footer.php');
		
		}
		public function show()
		{
			redirect_to(TP_BACK_SIDE."menu.php?act=menu");
		}
	}