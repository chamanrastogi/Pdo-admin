	<?php 

	?>
	
 		<!-- /.col-lg-3 col-xs-12 -->
			<div class="col-lg-12 col-xs-12">
				<div class="box-content">
					<h4 class="box-title">Welcome Screen</h4>
					<!-- /.box-title -->
					 <?php $temp = new Template();
					 $template=$temp->find_by_id(1);					


					 ?> 
					<!-- /.dropdown js__dropdown -->
				     
                    <br><br>
                    <h1 class="text-center" ><?=ucfirst($template->sitename)?></h1>
                     <center class="animated wow bounceIn"><img src="<?=TP_BACK?>assets/images/logo.png" ></center><br>
                 
					<!-- /#svg-animation-chartist-chart.chartist-chart -->
				</div>
				<!-- /.box-content -->
		
		<!-- /.row small-spacing -->
	
		<!-- /.row small-spacing -->