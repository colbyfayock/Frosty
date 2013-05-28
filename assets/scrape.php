<?php
function scrapeDeals(){

	function xml2array($xml)
	{
		$arr = array();

		foreach ($xml->children() as $r)
		{
			$t = array();
			if(count($r->children()) == 0)
			{
				$arr[$r->getName()] = strval($r);
			}
			else
			{
				$arr[$r->getName()][] = xml2array($r);
			}
		}
		return $arr;
	}

	$file = simplexml_load_file('wp-content/themes/frosty/assets/scrape.xml');
	$sites = xml2array($file);

	foreach($sites as $k => $v){
		$sites[$k] = $sites[$k][0];
		foreach($sites[$k] as $k1 => $v1){
			$sites[$k][$k1] = $sites[$k][$k1][0];
		}
	}
	return $sites;
}
?>