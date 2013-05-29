<div class="sidebar">
	<div class="section">
		<h3 class="list"><a href="<?php bloginfo('url'); ?>/blog" title="View the Frosty Deals blog!">Frosty Deals Blog</a></h3>
		<ul class="blog">
			<?php

				query_posts('showposts=3');

				if (have_posts()) : while (have_posts()) : the_post();

					echo '<li><a href="';
						the_permalink();
					echo '">';
						the_post_thumbnail('sidebar-thumb');
					echo '<span>';
						the_title();
					echo '</span></a></li>';

				endwhile; else :

				endif;

				wp_reset_query();
			?>
			<li class="clear"></li>
		</ul>
		<a class="btn blue" href="<?php bloginfo('url'); ?>/blog" title="View more blog posts!">More Posts</a>
	</div>
	<div class="section">
		<h3>Daily Deal Newsletter</h3>
		<p>
			Get the best deals of the day
			directly to your inbox with the
			Frosty Deals daily newsletter!
		</p>
		<form>
			<input class="btn grey-input" type="text" name="email" placeholder="Email Address">
			<input class="btn blue" type="submit" name="submit" value="Submit">
		</form>
	</div>
	<div class="section">
		<ul>
			<li><a href="#"><span>Facebook</span></a></li>
			<li><a href="#"><span>Twitter</span></a></li>
			<li><a href="#"><span>Google+</span></a></li>
			<li><a href="#"><span>RSS Feed</span></a></li>
		</ul>
	</div>
</div>