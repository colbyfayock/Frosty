<?php

class Woot extends Site {

	private $wootUrl;
	private $wootName;

	private $api = "http://api.woot.com/1/sales/current.rss/";

	private $pattern = array(
		'siteSpecial' => '/<woot:wootoff>(.*)<\/woot:wootoff>/',
		'prodName' => '/<\/link><title>(.*)<\/title><description>/',
		'prodImgUrl' => '/<woot:standardimage>(.*)<\/woot:standardimage>/',
		'prodDescription' => '/<\/title>[\s]<description>(.*)<\/description>/',
		'prodCondition' => '/<woot:condition>(.*)<\/woot:condition>/',
		'prodPrice' => '/<woot:price>(.*)<\/woot:price>/',
		'prodShipping' => '/<woot:shipping>(.*)<\/woot:shipping>/',
		'prodSoldOut' => '/<woot:soldout>(.*)<\/woot:soldout>/',
		'prodSoldOutPercent' => '/<woot:soldoutpercentage>(.*)<\/woot:soldoutpercentage>/',
	);

	function __construct($name, $url) {
		$this->wootUrl =  $this->api . $url;
		$this->wootName = $name;
	}

	function addData() {

		$string = str_replace(' ', '', strtolower($this->wootName));

		$this->data['siteName'] = $this->wootName;
		$this->data['siteUrl'] = $this->wootUrl;
		$this->data['siteLogo'] = 'woot.png';
		$this->data['prodDealImg'] = $string . ".jpg";

		$page = parent::getPage($this->wootUrl);

		foreach($this->pattern as $tagKey => $tagArray){
			preg_match_all($tagArray, $page, $matches);
			$this->data[$tagKey]  = isset($matches[1][0]) ? $matches[1][0] : false;
		}

		$this->data['prodSoldOutPercent'] = $this->data['prodSoldOutPercent']/100;

	}

	function getSite() {

		$this->addData();

		$this->data = parent::cleanStrings($this->data);

		$siteNameTrim = strtolower(preg_replace( '/\s+/', '', $this->data['siteName'] ));
		if(md5_file('/home/colbz/cdn.frostydeals.com/deal-images/' . $siteNameTrim . '.jpg') !== md5_file($this->data['prodImgUrl'])) {
			file_put_contents('/home/colbz/cdn.frostydeals.com/deal-images/' . $siteNameTrim . '.jpg', file_get_contents($this->data['prodImgUrl']));
		}


		return $this->data;
	}

}