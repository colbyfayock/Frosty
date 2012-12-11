<?php
	get_header();
?>

<div id="body" class="blog">

	<?php
		get_sidebar('maincat');
	?>
	
	<div id="content">
		<?php
		
		if (have_posts()) :
			while(have_posts()) : the_post();
		?>
				<div class="post"  id="post-<?php the_ID(); ?>">
				
					<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
					<p class="meta">
						<span>Posted on</span> <?php the_time('F jS, Y'); ?> <span>by</span> <?php the_author(); ?>
					</p>
					
					<?php the_content('More'); ?>
					
					<p>
						<?php the_tags('Tags: ', ', ', '<br>'); ?>
						Posted In <?php the_category(', '); ?> | 
						<?php edit_post_link('Edit', '', ' | '); ?>
						<?php comments_popup_link('No Comments', '1 Comment', '%comments'); ?>
					</p>
				
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

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">

$(function(){
	$('.list-collapse h3 a').click(function(e){
		e.preventDefault();
		$(this).parent().parent().find('ul').slideToggle();
		$(this).parent().toggleClass("list");
	});
});

</script>

<?php
	get_footer();
?>