<?php

class Yugster extends Site {

	private $yugsterUrl;
	private $yugsterName;

	private $api = "yugster.com/todays-deals/";

	private $pattern = array(
		'prodName' => '/<div class="hl_product_details_inner">[\s]*<h1>(.*)<\/h1>/',
		'prodImgUrl' => '/<a href="(.*)" class="lightbox" target="_blank">/',
		'prodDescription' => '/<br \/>[\s]*(.*)<\/p>/',
		'prodCondition' => '/<span class="condition">[\s]Condition:(.*)[\s]<\/span>/',
		'prodPrice' => '/<span class="price">(.*)<\/span>/',
		'prodShipping' => '/Shipping: (.*)/',
		'prodSoldOutPercent' => '/until: (.*)/'
	);

	function __construct($name, $url) {
		$this->yugsterUrl =  $this->api . $url;
		$this->yugsterName = $name;
	}

	function addData() {

		$string = str_replace(' ', '', strtolower($this->yugsterName));

		$this->data['siteName'] = $this->yugsterName;
		$this->data['siteUrl'] = $this->yugsterUrl;
		$this->data['siteLogo'] = 'yugster.png';
		$this->data['siteSpecial'] = false;
		$this->data['prodDealImg'] = 'yugster-' . $string . ".jpg";

		$page = parent::getPage($this->yugsterUrl);

		foreach($this->pattern as $tagKey => $tagArray){
			preg_match_all($tagArray, $page, $matches);
			$this->data[$tagKey]  = isset($matches[1][0]) ? $matches[1][0] : false;
		}

		$this->data['prodImgUrl'] = 'http://yugster.com' . $this->data['prodImgUrl'];

		$this->data['prodSoldOutPercent'] = 1-(($this->data['prodSoldOutPercent'])/86400);

	}

	function getSite() {

		$this->addData();

		$this->data = parent::cleanStrings($this->data);

		parent::setImage('yugster', $this->data['siteName'], $this->data['prodImgUrl']);

		return $this->data;
	}

}