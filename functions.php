<?php

	if (function_exists('add_theme_support')) {
		add_theme_support('post-thumbnails');
		add_image_size('sidebar-thumb', 50, 50);
		add_image_size('post-thumb', 150, 150);
	}
	
?>