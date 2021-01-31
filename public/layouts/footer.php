<!-- /.row -->
<?php $temp=Template::find_by_id(1); ?>	
</div><!-- /.card-content -->
	</div><!-- /.box-content -->
    </div><!-- /.col-12 -->
	
</div><!-- /.row small-spacing -->
</div><!-- /.main-content -->
    </div><!--/#wrapper -->
<footer class="footer" >
<p class="text-right"><strong>Copyright © <?=date('Y')?> <span ><?=$temp->sitename?></span></strong></p>
</footer>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="<?=TP_BACK?>assets/script/html5shiv.min.js"></script>
		<script src="<?=TP_BACK?>assets/script/respond.min.js"></script>
	<![endif]-->
	<!-- 
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="<?=TP_BACK?>assets/scripts/jquery.min.js"></script>	
	<script src="<?=TP_BACK?>assets/plugin/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?=TP_BACK?>assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="<?=TP_BACK?>assets/plugin/nprogress/nprogress.js"></script>
	<script src="<?=TP_BACK?>assets/plugin/toastr/toastr.min.js"></script>
	<script src="<?=TP_BACK?>assets/scripts/toastr.demo.min.js"></script> 
    <script src="<?=TP_BACK?>assets/plugin/waves/waves.min.js"></script>
   <script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <!-- Page Script Code -->
	
     <?php 
	
	 $x = urls($_SERVER['QUERY_STRING']);
	//echo sizeof($x);
		if(sizeof($x)==1 && $x[0]!=NULL)
		{
		if($x[0]!=='filemanager')
			{
		echo'<!-- '.ucfirst($x[0]).' Script -->';
		ucfirst($x[0])::hd_script();
		echo'<!--End Of '.ucfirst($x[0]).' Script -->';
			}else{
			echo'<!-- Template Script -->';
		Template::hd_script();
		Template::other_script();
		echo'<!--End Of Template Script -->';	
			}
		}elseif(sizeof($x)==2)
		{
	    echo'<!-- '.ucfirst($x[0]).' Script -->';
		ucfirst($x[0])::hd_script();
		echo'<!--End of '.ucfirst($x[0]).' Script -->';		
		}
		elseif(sizeof($x)==3)
		{
		echo'<!-- '.ucfirst($x[0]).' Script -->';	
		ucfirst($x[0])::hd_script();
		echo'<!--End of '.ucfirst($x[0]).' Script -->';	
		}else		
		{
		Template::hd_script();
		}
       
			
	?>
     <!-- End Page Script Code -->
	<script src="<?=TP_BACK?>assets/plugin/chart/sparkline/jquery.sparkline.min.js"></script>
	<script src="<?=TP_BACK?>assets/scripts/chart.sparkline.init.min.js"></script> 
    <script type="text/javascript" src="<?=TP_BACK?>assets/scripts/loader.js"></script>
     <script src="<?=TP_BACK?>assets/scripts/form.demo.min.js"></script> 
    <script src="<?=TP_BACK?>assets/scripts/main.min.js"></script>


</body>
</html>
<?php if(isset($database)) { $database->close_connection(); } ?>