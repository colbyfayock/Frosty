<?php
$sites = array();

$siteTags = array(
	'siteName' => '',
	'siteUrl' => '',
	'siteSpecial' => '',
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



/* Woot! */

function wootScrape(){
	global $siteTags;

	$woot = array(
		'woot' => array(),
		'wootTech' => array(),
		'wootHome' => array(),
		'wootSport' => array(),
		'wootKids' => array(),
		'wootShirt' => array(),
		'wootWine' => array(),
		'wootSellout' => array()
	);

	$patternWoot = array(
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

	$wootApi = "http://api.woot.com/1/sales/current.rss/";

	foreach($woot as $k1 => &$v1){
		$v1 = $siteTags;
		
		if(substr($k1, 4)){
			$v1['siteName'] = strtolower(substr($k1, 4)) . ".woot!";
			$v1['siteUrl'] = strtolower(substr($k1, 4)) . ".woot.com";
		} else {
			$v1['siteName'] = "woot!";
			$v1['siteUrl'] = "www.woot.com";
		}
		
		$v1['prodDealImg'] = $v1['siteName'] . ".jpg";
		
		$wootRSS = file_get_contents($wootApi . $v1['siteUrl']);
		
		foreach($patternWoot as $kk1 => &$vv1){
			preg_match_all($vv1, $wootRSS, $matches1);
			$v1[$kk1]  = $matches1[1][0];
		}
		
		$v1['prodSoldOutPercent'] = $v1['prodSoldOutPercent']/100;
		
		$v1['prodShipping'] = explode(" ", $v1['prodShipping']);
		$v1['prodShipping'] = $v1['prodShipping'][0];
	}
	
	return $woot;
}
$sites['woot'] = wootScrape();



/* MidnightBox */

function midnightBoxScrape(){
	global $siteTags;

	$midnightBox = array(
		'midnightBox1' => array(),
		'midnightBox2' => array(),
		'midnightBox3' => array()
	);

	$patternMidnight1 = array(
		'prodName' => '/title><\!\[CDATA\[(.*)\]\]>/',
		'prodImgUrl' => '/<\/h3><img\hsrc="(.*)"><p/',
		'prodDescription' => '/<p><P>(.*)<\/P>/'
	);
	$patternMidnight2 = array(
		'prodCondition' => '/ProdCon"\hclass="blue_links">(.*)<\/a>\h\&nbsp\;\|\&nbsp\;/',
		'prodPrice' => '/store_price">(.*)<\/span> /',
		'prodShipping' => '/\+\h(.*)\hShipping<\/span>/',
		'prodSoldOutPercent' => '/<div id="meter" style="width:([0-9]*\.?[0-9]*)%;">/'
	);

	$midnightRSS = file_get_contents('http://www.midnightbox.com/cgi-bin/rss.pl');
	$midnightSite = file_get_contents('http://www.midnightbox.com/');

	foreach($midnightBox as $k2 => &$v2){
		$v2 = $siteTags;
		$v2['siteName'] = "MidnightBox " . substr($k2, 11);
		$v2['siteUrl'] = "affiliates.make-a-store.com/Tracker.aspx?aid=811&amp;href=http%3a%2f%2fwww.midnightbox.com%2f%3fdealboxtabs%3d" . (substr($k2, 11)-1);
		$v2['siteSpecial'] = false;
		$v2['prodSoldOut'] = false;
		$v2['prodDealImg'] = strtolower($k2) . ".jpg";
	}

	foreach($patternMidnight1 as $kk2 => &$vv2){
		preg_match_all($vv2, $midnightRSS, $matches1);
		$matches1 = $matches1[1];
		for($i = 0; $i < count($midnightBox); $i++){
			$midnight = "midnightBox" . ($i+1);
			$midnightBox[$midnight][$kk2] = $matches1[$i];
		}
	}
	foreach($patternMidnight2 as $kkk2 => &$vvv2){
		preg_match_all($vvv2, $midnightSite, $matches2);
		$matches2 = $matches2[1];
		for($j = 0; $j < count($midnightBox); $j++){
			$midnight = "midnightBox" . ($j+1);
			$midnightBox[$midnight][$kkk2] = $matches2[$j];
			$midnightBox[$midnight]['prodSoldOutPercent'] = round(($midnightBox[$midnight]['prodSoldOutPercent']/100), 2);
		}
	}
	foreach($midnightBox as $kkk2 => &$vvv2){
		$vvv2['prodPrice'] = "$" . $vvv2['prodPrice'];
	}
	
	return $midnightBox;
}
if(midnightBoxScrape()){
	$sites['midnightBox'] = midnightBoxScrape();
}



/* Yugster */
function yugsterScrape(){
	global $siteTags;
	
	$yugster = array(
		'yugsterDailyOffer' => array(),
		'yugsterYoursUntilGone' => array(),
		'yugsterDailyWatchDeal' => array(),
		'yugsterSpecialOffer' => array()
	);

	$patternYugster = array(
		'prodName' => '/<div class="hl_product_details_inner">[\s]*<h1>(.*)<\/h1>/',
		'prodImgUrl' => '/<a href="(.*)" class="lightbox" target="_blank">/',
		'prodDescription' => '/<br \/>[\s]*(.*)<\/p>/',
		'prodCondition' => '/<span class="condition">[\s]Condition:(.*)[\s]<\/span>/',
		'prodPrice' => '/<span class="price">(.*)<\/span>/',
		'prodShipping' => '/Shipping: (.*)/',
		'prodSoldOutPercent' => '/until: (.*)/'
	);


	foreach($yugster as $k3 => &$v3){
		$v3 = $siteTags;
		$v3['siteName'] = ucfirst(preg_replace('/(?<!\ )[A-Z]/', ' $0', $k3));
		$v3['siteUrl'] = "yugster.com/todays-deals/" . substr(strtolower(preg_replace('/(?<!\ )[A-Z]/', '-$0', $k3)), 8);
		$v3['siteSpecial'] = false;
		$v3['prodImgUrl'] = "http://yugster.com";
		$v3['prodDealImg'] = strtolower($k3) . ".jpg";
		
		$yugsterSite = file_get_contents("http://" . $v3['siteUrl']);
		
		foreach($patternYugster as $kk3 => &$vv3){
			preg_match_all($vv3, $yugsterSite, $matches);
			$v3[$kk3] = $v3[$kk3].$matches[1][0];
		}
		if($v3['prodShipping'] == "FREE!") {
			$v3['prodShipping'] = "Free";
		}
		
		$v3['prodSoldOutPercent'] = 1-(($v3['prodSoldOutPercent'])/86400);
	}
	
	return $yugster;
}
$sites['yugster'] = yugsterScrape();



/* 1 Sale A Day */

function oneSaleADayScrape(){
	global $siteTags;

	$oneSaleADay = array(
		'oneSaleADay' => array(),
		'oneSaleADayWireless' => array(),
		'oneSaleADayWatch' => array(),
		'oneSaleADayFamily' => array(),
		'oneSaleADayJewelry' => array()
	);

	$patternSaleADay = array(
		'prodName' => '/<h2>(.*)<\/h2>/',
		'prodImgUrl' => '/main_image" src="(.*)" title/',
		'prodDescription' => '/Product Info<\/h3>[\s]<p>(.*)<\/p>[\s]<p><strong>/',
		'prodCondition' => '/Condition:(.*)<\/strong>(.*)<br \/>(.*)<strong>P/',
		'prodPrice' => '/Price:[\s]*(.*)/'
	);


	$saleADayRSS = file_get_contents("http://1saleaday.com/rss_feedburner.asp");		

	foreach($oneSaleADay as $k4 => &$v4){
		$v4 = $siteTags;
		
		if(substr($k4, 11)){
			$v4['siteName'] = "1 Sale A Day - " . substr($k4, 11);
			$v4['siteUrl'] = "http://www.1saleaday.com/" . strtolower(substr($k4, 11)) . "/";	
			$v4['prodDealImg'] = "1saleaday-" . strtolower(substr($k4, 11)) . ".jpg";		
		} else{
			$v4['siteName'] = "1 Sale A Day";
			$v4['siteUrl'] = "http://www.1saleaday.com/";
			$v4['prodDealImg'] = "1saleaday.jpg";
		}
		$v4['siteSpecial'] = false;
		$v4['prodShipping'] = "$4.99";
		$v4['prodSoldOut'] = false;
		$v4['prodSoldOutPercent'] = 0;
		
		$saleADaySite = file_get_contents($v4['siteUrl']);
		foreach($patternSaleADay as $kk4 => $vv4){
			preg_match_all($vv4, $saleADaySite, $matches);
			$v4[$kk4] = $matches[1][0];
		}
		preg_match_all($patternSaleADay['prodCondition'], $saleADaySite, $matches1);
		$v4['prodCondition'] = ucwords(strtolower(trim($matches1[2][0])));
		$v4['prodSoldOutPercent'] = round((date('g.i')/24), 2);
	}

	$oneSaleADay['oneSaleADay']['siteUrl'] = "www.ocsadtrack.com/click.track?CID=168142&amp;AFID=206138&amp;ADID=579788";
	$oneSaleADay['oneSaleADayWireless']['siteUrl'] = "www.ocsadtrack.com/click.track?CID=173477&amp;AFID=206138&amp;ADID=579857";
	$oneSaleADay['oneSaleADayWatch']['siteUrl'] = "www.ocsadtrack.com/click.track?CID=173478&amp;AFID=206138&amp;ADID=579846";
	$oneSaleADay['oneSaleADayFamily']['siteUrl'] = "www.ocsadtrack.com/click.track?CID=173476&amp;AFID=206138&amp;ADID=579823";
	$oneSaleADay['oneSaleADayJewelry']['siteUrl'] = "www.ocsadtrack.com/click.track?CID=173481&amp;AFID=206138&amp;ADID=579835";	
	
	return $oneSaleADay;
}
$sites['oneSaleADay'] = oneSaleADayScrape();



/* JustDeals */

function justDealsScrape(){
	global $siteTags;
	
	$justDeals = array();

	$justDealsRSS = file_get_contents('https://mypoints.justdeals.com/ads/affiliates/productfeed.xml');
	
	preg_match_all('/<active>(.*)<\/active>/', $justDealsRSS, $matches);
		
	for($i = 0; $i < intval($matches[1][0]); $i++){
		$deal = 'justDeals' . ($i+1);
		$justDeals[$deal] = array();
	}
	
	$patternJustDeals = array(
		'prodName' => '/<Product_Name><\!\[CDATA\[(.*)\]\]><\/Product_Name>/',
		'prodImgUrl' => '/<Large_Image_URL>(.*)<\/Large_Image_URL>/',
		'prodDescription' => '/<Medium_Description><\!\[CDATA\[(.*)\]\]><\/Medium_Description>/',
		// 'prodCondition' => '//',
		'prodPrice' => '/<Sale_Price>(.*)<\/Sale_Price>/'
		// 'prodSoldOutPercent' => '//'
	);
	
	foreach($justDeals as $k1 => &$v1){
		$v1 = $siteTags;
		
		$v1['siteName'] = "JustDeals " . substr($k1, 9);
		$v1['siteUrl'] = "justdeals.com";
		$v1['prodShipping'] = "$5.00";
		$v1['siteSpecial'] = false;
		/* if( == 0){
			$v['prodSoldOut'] = true;
		} else{
			$v['prodSoldOut'] = false;
		}
		*/
		$v1['prodDealImg'] = strtolower($k1) . ".jpg";
	}
	
	foreach($patternJustDeals as $k2 => &$v2){
		preg_match_all($v2, $justDealsRSS, $matches1);
		$matches1 = $matches1[1];
		for($j = 0; $j < count($justDeals); $j++){
			$name = "justDeals" . ($j+1);
			$justDeals[$name][$k2] = $matches1[$j];
		}
	}
	
	foreach($justDeals as $k3 => &$v3){
		$v3['prodPrice'] = "$" . round($v3['prodPrice'], 2);
	}
	
	return $justDeals;
	
}
$sites['justDeals'] = justDealsScrape();



/* Daily Steals */

function dailyStealsScrape(){
	global $siteTags;
	
	$dailySteals = array(
		'dailyStealsMain' => array(),
		'dailyStealsMobile' => array(),
		'dailyStealsHome' => array(),
		'dailyStealsToys' => array(),
		'dailyStealsLastCall' => array()
	);
	
	$patternDailySteals = array(
		'prodName' => '/details">[\s]+<h2>(.*)<\/h2>/',
		'prodImgUrl' => '/productimage" href="(.*)">/',
		'prodPrice' => '/PRICE:<\/span>[\s]+<strong>(.*)<\/strong>/'
		//'prodDescription' => '//',
		//'prodSoldOutPercent' => '//'
	);
	
	foreach($dailySteals as $k => &$v){
		$v = $siteTags;
		
		if(substr($k, 11) == "Main"){
			$dailyStealsRSS = "http://dailysteals.com";
		} else{
			$dailyStealsRSS = "http://" . strtolower(substr($k, 11)) . ".dailysteals.com";
		}
		$dailyStealsRSS = file_get_contents($dailyStealsRSS);
				
		if(substr($k, 11) == "LastCall"){
			$v['siteName'] = "Daily Steals Last Call";
		} else{
			$v['siteName'] = "Daily Steals " . substr($k, 11);
		}
		$v['siteUrl'] = "dailysteals.com";
		$v['siteSpecial'] = false;
		$v['prodDealImg'] = strtolower($k) . ".jpg";
		$v['prodShipping'] = "$4.99";
		$v['prodSoldOut'] = false;
		$v['prodSoldOutPercent'] = 0;
		
		foreach($patternDailySteals as $k1 => &$v1){
			preg_match_all($v1, $dailyStealsRSS, $matches1);
			$v[$k1] = $matches1[1][0];
		}
	}
	
	return $dailySteals;	
}
$sites['dailySteals'] = dailyStealsScrape();


/* Global */

foreach($sites as $k => &$v){
	foreach($v as $k1 => &$v1){
		foreach($v1 as $k2 => &$v2){
			$v2 = str_replace("â€™", "'", $v2);
			$v2 = str_replace("®", "&reg;", $v2);
			$v2 = str_replace("©", "&copy;", $v2);
		}
		$v1['prodName'] = trim($v1['prodName']);
		$v1['prodName'] = str_replace(" & ", " &amp; ", $v1['prodName']);
		$v1['prodName'] = str_replace("\"", "&quot;", $v1['prodName']);
		if(strlen($v1['prodName']) > 28){
			$v1['prodNameTrim'] = substr($v1['prodName'],0,25) . "...";
		} else{
			$v1['prodNameTrim'] = $v1['prodName'];
		}
		
		$v1['prodSoldOutPercent'] = 100-($v1['prodSoldOutPercent']*100);
		
		$v1['prodZonLink'] = $v1['prodName'];
		$v1['prodZonLink'] = str_replace(" ", "+", $v1['prodZonLink']);
		$v1['prodZonLink'] = str_replace("&", "%26", $v1['prodZonLink']);
		$v1['prodZonLink'] = str_replace("amp;", "", $v1['prodZonLink']);
		$v1['prodZonLink'] = "http://www.amazon.com/s/ref=nb_sb_noss?url=search-alias%3Daps%26field-keywords=" . $v1['prodZonLink'] . "%26x=0%26y=0";
		
		if( empty($v1['prodName']) || empty($v1['prodImgUrl']) ){
			unset($v[$k1]);
		}
		
		$v1['prodDealImg'] = "http://cdn.frostydeals.com/deal-images/" . $v1['prodDealImg'];
		
		$siteNameTrim = strtolower(preg_replace( '/\s+/', '', $v1['siteName'] ));
		file_put_contents('/home/colbz/cdn.frostydeals.com/deal-images/'.$siteNameTrim.'.jpg', file_get_contents($v1['prodImgUrl']));
	}
}

echo "<?xml version=\"1.0\"  encoding=\"UTF-8\" ?>\n";
echo "<sites>";
foreach($sites as $key => $variable){
	echo "<" . htmlspecialchars($key) . ">\n";
	foreach($sites[$key] as $key1 => $variable1){
		echo "\t<" . htmlspecialchars($key1) . ">\n";
			foreach($sites[$key][$key1] as $key2 => $variable2){
				echo "\t\t<" . htmlspecialchars($key2) . ">" . htmlspecialchars($variable2) . "</" . htmlspecialchars($key2) . ">\n";
			}
		echo "\t</" . htmlspecialchars($key1) . ">\n";
	}
	echo "</" . htmlspecialchars($key) . ">\n";
}
echo "</sites>";

flush();
$scrape = "/home/colbz/frostydeals.com/woop/wp-content/themes/frosty/assets/scrape.temp";
$file  = "/home/colbz/frostydeals.com/woop/wp-content/themes/frosty/assets/scrape.xml";
rename($scrape, $file);
?>