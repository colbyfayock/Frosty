<!doctype html>

<html <?php language_attributes(); ?>>

<head>

	<?php
	
	function auto_version($file){
		if(preg_match_all('/\.(css|js)$/', $file, $matches)){
			if($matches[1][0] == "css"){
				$string = "http://";
			} elseif($matches[1][0] == "js"){
				$string = "//";
			}
		}
	
		if(!file_exists($file)){
			return preg_replace('/\/home\/colbz\//', $string, $file);
		}
	 
	  $mtime = filemtime($file);
	  $file = preg_replace('{\\.([^./]+)$}', ".$mtime.\$1", $file);
	  return preg_replace('/\/home\/colbz\//', $string, $file);
	}
	
	?>
	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width" />
	<meta name="description" content="Frosty deals is a deal of the day roundup site bringing together the best daily deal sources on the web!" />
	
	<link rel="shortcut icon" href="http://cdn.frostydeals.com/favicon.ico" />
	<link rel="apple-touch-icon" href="http://cdn.frostydeals.com/apple-touch-icon.png" />
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="all" />
	<link rel="stylesheet" href="<?=auto_version('/home/colbz/cdn.frostydeals.com/css/style-main.css')?>" type="text/css" media="all" />
	<!--[if lte IE 8]>
		<link rel="stylesheet" type="text/css" media="all" href="<?=auto_version('/home/colbz/cdn.frostydeals.com/css/style-ie.css')?>"/>
    <![endif]-->
	
	<title>
		<?php
			// http://digwp.com/2009/06/custom-wordpress-title-tags/
			// http://perishablepress.com/perfect-wordpress-title-tags-redux/
			if (function_exists('is_tag') && is_tag()) {
				single_tag_title('Tag Archive for &quot;'); echo '&quot; - ';
			} elseif (is_archive()) {
				wp_title(''); echo ' Archive - ';
			} elseif (!(is_404()) && (is_single()) || (is_page()) && !(is_front_page())) {
				wp_title(''); echo ' - ';
			} elseif (is_404()) {
				echo 'Not Found - ';
			} elseif(is_home() && !is_paged() ){
				wp_title(''); echo ' - ';
			}
			
			if (is_front_page()) {
				bloginfo('name'); echo ' - '; bloginfo('description');
			} else{
				bloginfo('name');
			}
			
			if ($paged > 1) {
				echo ' - page ' . $paged;
			}
		?>
	</title>

	<?php wp_head(); ?>
</head>

<body>

<div id="header">
	<div id="logo">
		<a href="<?php bloginfo('url'); ?>">Frosty Deals</a>
	</div>
	<div id="nav-mobile">
		<a href="#">+</a>
	</div>
	<div id="nav">
		<ul>
			<?php wp_list_pages('depth=1&title_li='); ?>
			<li class="clear"></li>
		</ul>
	</div>
	<div class="clear"></div>
</div>