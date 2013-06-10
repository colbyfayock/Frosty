<!DOCTYPE html>
<!--[if lte IE 8]><html class="ieold" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 9 ]><html class="ie" <?php language_attributes(); ?>><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>><!--<![endif]-->

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>Frosty Deals</title>

	<meta name="description" content="description">
	<meta name="viewport" content="width=device-width">
	<meta name="author" content="">

	<meta property="og:title" content="<?php echo get_bloginfo('name'); ?>" />
	<meta property="og:description" content="<?php echo get_bloginfo('name'); ?>" />
	<meta property="og:url" content="url" />
	<meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>" />
	<meta property="fb:page_id" content="10893981495" />

	<link rel="apple-touch-icon-precomposed" href="touchicon.png" />
	<link rel="icon" href="favicon.png">
	<!--[if IE]><link rel="shortcut icon" href="favicon.ico"><![endif]-->
	<meta name="msapplication-TileColor" content="#007079">
	<meta name="msapplication-TileImage" content="win8icon.png">

	<link rel="alternate" type="application/rss+xml" title="<?php echo get_bloginfo('name'); ?> Feed" href="<?php echo home_url(); ?>/feed/">

	<link rel="stylesheet" href="<?=auto_version('/style.css')?>">

    <!-- https://github.com/aFarkas/html5shiv -->
    <!--[if lt IE 9]><script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6.2/html5shiv.js"></script><![endif]-->

    <? wp_head(); ?>

</head>

	<?php if(is_home()) $bodyClass = 'home'; ?>
	<?php if(is_page()) $bodyClass = 'page'; ?>
	<?php if(is_single()) $bodyClass = 'single'; ?>

	<?php get_header( zurg_template_base() ); ?>

	<div class="container content <?=$bodyClass?>">
		<?php include zurg_template_path(); ?>
	</div>

	<?php get_footer( zurg_template_base() ); ?>

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?=get_template_directory_uri();?>/assets/js/lib/jquery-1.9.1.min.js"><\/script>')</script>

    <script data-main="<?=$GLOBALS["TEMPLATE_RELATIVE_URL"]?>/assets/js/main.min" src="<?=$GLOBALS["TEMPLATE_RELATIVE_URL"]?>/assets/js/require.js"></script>

	<script type="text/javascript">
	// Google Analytics
    var _gaq=[['_setAccount', 'UA-28068328-1'],['_trackPageview']];
    (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
    g.src='//www.google-analytics.com/ga.js';
    s.parentNode.insertBefore(g,s)}(document,'script'));

    (function(doc, script) {
        var js,
        fjs = doc.getElementsByTagName(script)[0],
        add = function(url, id) {
            if (doc.getElementById(id)) {return;}
            js = doc.createElement(script);
            js.src = url;
            id && (js.id = id);
            fjs.parentNode.insertBefore(js, fjs);
        };
        // Google+ button
        // add('//apis.google.com/js/plusone.js');
        // Facebook SDK
        add('//connect.facebook.net/en_US/all.js#xfbml=1', 'facebook-jssdk');
        // Twitter SDK
        add('//platform.twitter.com/widgets.js', 'twitter-wjs');
    }(document, 'script'));
    </script>

    <? wp_footer(); ?>
</body>

</html>