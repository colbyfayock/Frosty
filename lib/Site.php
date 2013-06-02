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

}