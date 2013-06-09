<?php

class Site {

	private $url;
	private $data = array(
		'siteName' => '',
		'siteUrl' => '',
		'siteSpecial' => '',
		'siteLogo' => 'wp-content/themes/frosty/images/',
		'prodName' => '',
		'prodNameTrim' => '',
		'prodImgUrl' => '',
		'prodDescription' => '',
		'prodCondition' => '',
		'prodPrice' => '',
		'prodShipping' => '',
		'prodSoldOut' => '',
		'prodSoldOutPercent' => '',
		'prodDealImg' => '',
		'prodZonLink' => ''
	);

	function getPage($url) {
		return curl($url);
	}

	function cleanStrings($string) {
		foreach($string as $s) {
			$s = str_replace("â€™", "'", $s);
			$s = str_replace("®", "&reg;", $s);
			$s = str_replace("©", "&copy;", $s);
			$s = trim($s);
		}

		$string['prodName'] = trim($string['prodName']);
		$string['prodName'] = str_replace(" & ", " &amp; ", $string['prodName']);
		$string['prodName'] = str_replace("\"", "&quot;", $string['prodName']);

		if(strlen($string['prodName']) > 28){
			$string['prodNameTrim'] = substr($string['prodName'],0,25) . "...";
		} else{
			$string['prodNameTrim'] = $string['prodName'];
		}
		if(!empty($sub['prodDescription'])) {
			$sub['prodDescription'] = strip_tags($sub['prodDescription']);
			if(strlen($sub['prodDescription'] > 250)) substr($sub['prodDescription'], 0, 247) . '...';
		}

		$string['prodSoldOutPercent'] = 100-($string['prodSoldOutPercent']*100);

		$string['prodZonLink'] = $string['prodName'];
		$string['prodZonLink'] = str_replace(" ", "+", $string['prodZonLink']);
		$string['prodZonLink'] = str_replace("&", "%26", $string['prodZonLink']);
		$string['prodZonLink'] = str_replace("amp;", "", $string['prodZonLink']);
		$string['prodZonLink'] = "http://www.amazon.com/s/ref=nb_sb_noss?url=search-alias%3Daps%26field-keywords=" . $string['prodZonLink'] . "%26x=0%26y=0";

		if( empty($string['prodName']) || empty($string['prodImgUrl']) ){
			unset($v[$k1]);
		}

		return $string;
	}

}