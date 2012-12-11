<?php
	wp_footer();
	
	if(is_front_page()){
		?>
			<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
			<script src="<?=auto_version('/home/colbz/cdn.frostydeals.com/js/scripts-main.js')?>" type="text/javascript"></script>
		<?php
	}
?>


</body>

</html>