<?php
	require_once(LIB_PATH.DS.'database.php');
  class Menucat_mo extends Menucat 
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
         $data->status="Active";
         $x= $data->create();
         
          if(is_array($x))
          {
            echo  output_message($x[1],$x[0]);
            redirect_by_js(TP_BACK_SIDE.$n[0].DS.$n[1],1000);
        }
        }
        $name='';       
        
        echo $fo=Forms::input("Name","name",$name,1);
			  
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
         $id=0;
         $data->name=$name; 
		 $rw=$data->find_by_id($n[2]);	 
         $data->status=$rw->status;
         $data->id = $n[2];
         $x= $data->update();
         
          if(is_array($x))
          {
            echo  output_message($x[1],$x[0]);
            redirect_by_js(TP_BACK_SIDE.$n[0].DS.$n[1].DS.$n[2],1000);
        }
        }
        $data= self::call_cl_fun();
        $rw = $data->find_by_id($n[2]);
        $name=$rw->name;
      
        
        echo $fo=Forms::input("Name","name",$name,1);		
			  
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
                  <th >-</th>				
                  <th >Status</th>
                  <th >Options </th>
                </tr>
              </thead>
              
            </table></div>
          </form>';
        include_layout_admin('footer.php');		
    }
}