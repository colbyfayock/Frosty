<?php

function __autoload($class_name) {
	include $class_name . '.php';
}

function curl($url) {
	$c = curl_init();
	curl_setopt($c, CURLOPT_URL, $url);
	curl_setopt($c, CURLOPT_HEADER, 0);
	curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
	$results = curl_exec($c);
	curl_close($c);
	return $results;
}

$faydev = false;
$faycdnlink = empty($faydev) ? '/home/colbz/' : '../../../../../';
$faydevlink = empty($faydev) ? '/home/colbz/' : '../';

$sites = array();

$sites['woot'] = array();

$sites['woot']['woot'] = new Woot('Woot', 'woot.com');
$sites['woot']['accessories'] = new Woot('Accessories.woot', 'accessories.woot.com');
$sites['woot']['tech'] = new Woot('Tech.Woot', 'tech.woot.com');
$sites['woot']['home'] = new Woot('Home.Woot', 'home.woot.com');
$sites['woot']['tools'] = new Woot('Tools.Woot', 'tools.woot.com');
$sites['woot']['sport'] = new Woot('Sport.Woot', 'sport.woot.com');
$sites['woot']['kids'] = new Woot('Kids.Woot', 'kids.woot.com');
$sites['woot']['shirt'] = new Woot('Shirt.Woot', 'shirt.woot.com');
$sites['woot']['wine'] = new Woot('Wine.Woot', 'wine.woot.com');
$sites['woot']['sellout'] = new Woot('Sellout.Woot', 'sellout.woot.com');

$sites['midnight'] = array();

$sites['midnight']['midnight1'] = new MidnightBox('Midnight 1', '0');
$sites['midnight']['midnight2'] = new MidnightBox('Midnight 2', '1');
$sites['midnight']['midnight3'] = new MidnightBox('Midnight 3', '2');
$sites['midnight']['midnight4'] = new MidnightBox('Midnight 4', '3');
$sites['midnight']['midnight5'] = new MidnightBox('Midnight 5', '4');
$sites['midnight']['midnight6'] = new MidnightBox('Midnight 6', '5');

$sites['yugster'] = array();

$sites['yugster']['daily-offer'] = new Yugster('Today\'s Offer', 'daily-offer');
$sites['yugster']['todays-tech'] = new Yugster('Today\'s Tech', 'sneak-preview-offer');
$sites['yugster']['yours-until-gone'] = new Yugster('Yours Until Gone', 'yours-until-gone');
$sites['yugster']['sharp-or-shiny'] = new Yugster('Sharp or Shiny', 'sharp-or-shiny');
$sites['yugster']['special-offer'] = new Yugster('Special Offer', 'special-offer');
$sites['yugster']['free-today'] = new Yugster('Free Today', 'free-today');
$sites['yugster']['plugster-s-pick'] = new Yugster('Weekend YUG', 'plugster-s-pick');

ob_start();
echo "<?xml version=\"1.0\"  encoding=\"UTF-8\" ?>\n";
echo "<sites>\n";
foreach($sites as $k => $v){
	echo "<" . htmlspecialchars($k) . ">\n";
	foreach($sites[$k] as $k1 => $v1){
		echo "\t<" . htmlspecialchars($k1) . ">\n";
			$site = $v1->getSite();
			foreach($site as $k2 => $v2){
				echo "\t\t<" . htmlspecialchars($k2) . ">" . htmlspecialchars($v2) . "</" . htmlspecialchars($k2) . ">\n";
			}
		echo "\t</" . htmlspecialchars($k1) . ">\n";
	}
	echo "</" . htmlspecialchars($k) . ">\n";
}
echo "</sites>";
ob_end_flush();

$scrape = "/home/colbz/frostydeals.com/wp-content/themes/frosty/lib/scrape.temp";
$file  = "/home/colbz/frostydeals.com/wp-content/themes/frosty/lib/scrape.xml";
rename($scrape, $file);