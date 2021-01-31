<?php
	require_once(LIB_PATH.DS.'database.php');
  class Menu_type_mo extends Menu_type 
  {
    public function add()
    {
    
    }
    public function edit()
    {
    
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