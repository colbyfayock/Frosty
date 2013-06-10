<?php

class MidnightBox extends Site {

	private $midnightUrl;
	private $midnightName;

	private $apiRss = "http://www.midnightbox.com/cgi-bin/rss.pl";
	private $apiSite = "http://www.midnightbox.com/";

	private $pattern1 = array(
		'prodName' => '/title><\!\[CDATA\[(.*)\]\]>/',
		'prodImgUrl' => '/<\/h3><img\hsrc="(.*)"><p/',
		'prodDescription' => '/<p><P>(.*)<\/P>/'
	);

	private $pattern2 = array(
		'prodCondition' => '/ProdCon"\hclass="blue_links">(.*)<\/a>\h\&nbsp\;\|\&nbsp\;/',
		'prodPrice' => '/store_price">(.*)<\/span> /',
		'prodShipping' => '/\+\h(.*)\hShipping<\/span>/',
		'prodSoldOutPercent' => '/<div id="meter" style="width:([0-9]*\.?[0-9]*)%;">/'
	);

	function __construct($name, $url) {
		$this->midnightUrl =  $url;
		$this->midnightName = $name;
	}

	function addData() {

		$string = str_replace(' ', '', strtolower($this->midnightName));

		$this->data['siteName'] = $this->midnightName;
		$this->data['siteUrl'] = "affiliates.make-a-store.com/Tracker.aspx?aid=811&amp;href=http%3a%2f%2fwww.midnightbox.com%2f%3fdealboxtabs%3d" . $this->midnightUrl;
		$this->data['siteLogo'] = 'midnightbox.png';
		$this->data['prodDealImg'] = 'midnightbox-' . $string . ".jpg";
		$this->data['siteSpecial'] = false;
		$this->data['prodSoldOut'] = false;

		$rss = parent::getPage($this->apiRss);
		$site = parent::getPage($this->apiSite);


		foreach($this->pattern1 as $tagKey => $tagArray){
			preg_match_all($tagArray, $rss, $matches);
			$this->data[$tagKey] = isset($matches[1][$this->midnightUrl]) ? $matches[1][$this->midnightUrl] : false;
		}

		foreach($this->pattern2 as $tagKey => $tagArray){
			preg_match_all($tagArray, $site, $matches);
			$this->data[$tagKey] = isset($matches[1][$this->midnightUrl]) ? $matches[1][$this->midnightUrl] : false;
		}

		$this->data['prodPrice'] = "$" . $this->data['prodPrice'];
		$this->data['prodSoldOutPercent'] = round($this->data['prodSoldOutPercent']/100, 2);

	}

	function getSite() {

		$this->addData();

		$this->data = parent::cleanStrings($this->data);

		parent::setImage('midnightbox', $this->data['siteName'], $this->data['prodImgUrl']);

		return $this->data;
	}

}