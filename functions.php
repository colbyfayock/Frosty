<?php

add_theme_support('automatic-feed-links');

$GLOBALS["TEMPLATE_URL"] = get_bloginfo('template_url');
$GLOBALS["TEMPLATE_RELATIVE_URL"] = wp_make_link_relative($GLOBALS["TEMPLATE_URL"]);

// Autoversion files
// Ex: style.1362807796.css
function auto_version($file) {
    $home = '/home/colbz/frostydeals.com/' . $GLOBALS["TEMPLATE_RELATIVE_URL"];
    $dev = '..' . $GLOBALS["TEMPLATE_RELATIVE_URL"];

    if(!file_exists($home . $file)) {
        if(!file_exists($dev . $file)) {
            return $GLOBALS["TEMPLATE_RELATIVE_URL"] . $file;
        } else {
            $devMode = true;
        }
    }

    $mtime = filemtime((!empty($devMode) ? $dev : $home) . $file);
    $file = preg_replace('{\\.([^./]+)$}', ".$mtime.\$1", $file);
    return (!empty($devMode) ? $dev : $GLOBALS["TEMPLATE_RELATIVE_URL"]) . $file;
}

function auto_version_cdn($file) {
    $home = '/home/colbz/cdn.frostydeals.com';
    $dev = '..' . $GLOBALS["TEMPLATE_RELATIVE_URL"] . '/_cdn';

    if(!file_exists($home . $file)) {
        if(!file_exists($dev . $file)) {
            return 'http://cdn.frostydeals.com' . $file;
        } else {
            $devMode = true;
        }
    }

    $mtime = filemtime((!empty($devMode) ? $dev : $home) . $file);
    $file = preg_replace('{\\.([^./]+)$}', ".$mtime.\$1", $file);
    return (!empty($devMode) ? $dev : 'http://cdn.frostydeals.com') . $file;
}


// Theme wrapper

function zurg_template_path() {
	return Zurg_Wrapping::$main_template;
}

function zurg_template_base() {
	return Zurg_Wrapping::$base;
}


class Zurg_Wrapping {

	/**
	 * Stores the full path to the main template file
	 */
	static $main_template;

	/**
	 * Stores the base name of the template file; e.g. 'page' for 'page.php' etc.
	 */
	static $base;

	static function wrap( $template ) {
		self::$main_template = $template;

		self::$base = substr( basename( self::$main_template ), 0, -4 );

		if ( 'index' == self::$base )
			self::$base = false;

		$templates = array( 'wrapper.php' );

		if ( self::$base )
			array_unshift( $templates, sprintf( 'wrapper-%s.php', self::$base ) );

		return locate_template( $templates );
	}
}

add_filter( 'template_include', array( 'Zurg_Wrapping', 'wrap' ), 99 );