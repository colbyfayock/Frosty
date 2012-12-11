<?php
	get_header();
?>

<div id="body">
	<div id="content">
		
		<?php
		
		if (have_posts()) :
			while(have_posts()) : the_post();
		?>
				<div class="post"  id="post-<?php the_ID(); ?>">
															
					<?php the_content(); ?>
				
				</div>
			
			<?php endwhile;
			
			next_posts_link('&laquo; Older Entries');
			
			previous_posts_link('Newer Entries &raquo;');
			
		else :
			
			echo '<h2>Nothing Found</h2>';
		
		endif;
		
		?>
	</div>
	
	<?php
		get_sidebar('feed');
	?>
	
	<div class="clear"></div>
</div>

<?php
	get_footer();
?>