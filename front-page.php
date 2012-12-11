<?php
	get_header();
?>

<div id="body" class="home">

	<?php
		get_sidebar('maincat');
	?>
	
	<div id="content">
		<?php
		
		include 'assets/scrape.php';
		include 'assets/panel.php';
		
		$sites = scrapeDeals();
		
		if(empty($whatSite)){
			foreach($sites as $k => $v){
				callDeals($sites[$k], $k);
			}
		}
		else{
			callDeals($sites[$whatSite], $whatSite);
		}
		
		?>
		
		<div class="clear"></div>
		
	</div>
	
	<?php
		get_sidebar('feed');
	?>
	
	<div class="clear"></div>
</div>

<?php
	get_footer();
?>