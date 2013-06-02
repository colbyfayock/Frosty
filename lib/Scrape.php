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

$woot = array();

$woot['woot'] = new Woot('Woot', 'woot.com');
$woot['tech'] = new Woot('Tech.Woot', 'tech.woot.com');
$woot['home'] = new Woot('Home.Woot', 'home.woot.com');
$woot['sport'] = new Woot('Sport.Woot', 'sport.woot.com');
$woot['kids'] = new Woot('Kids.Woot', 'kids.woot.com');
$woot['shirt'] = new Woot('Shirt.Woot', 'shirt.woot.com');
$woot['wine'] = new Woot('Wine.Woot', 'wine.woot.com');
$woot['sellout'] = new Woot('Sellout.Woot', 'sellout.woot.com');

$midnight = array();

$midnight['midnight1'] = new MidnightBox('Midnight 1', '0');
$midnight['midnight2'] = new MidnightBox('Midnight 2', '1');
$midnight['midnight3'] = new MidnightBox('Midnight 3', '2');
$midnight['midnight4'] = new MidnightBox('Midnight 4', '3');
$midnight['midnight5'] = new MidnightBox('Midnight 5', '4');
$midnight['midnight6'] = new MidnightBox('Midnight 6', '5');

foreach($woot as $woot) {
	print_r($woot->getWoot());
	echo '<br><br>';
}

foreach($midnight as $midnight) {
	print_r($midnight->getMidnight());
	echo '<br><br>';
}