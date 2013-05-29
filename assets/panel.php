<?php
function callDeals($theSite, $theSiteKey){

	foreach($theSite as $k => $v){

	$panelState = "panel " . $theSiteKey . " " . $k;

	if($v['siteSpecial'] == "true"){
		$panelState = $panelState . " special";
	}

	if($v['prodSoldOutPercent'] == 0){
		if($v['siteSpecial'] == "false"){
			$panelState = $panelState . " sold-out";
		}
		$timeLeft = "width:100%;background-color:red;";
		$dealPrice = "Sold Out";
		$dealShipping = "was " . $v['prodPrice'];
	} else{
		$timeLeft = "width:" . $v['prodSoldOutPercent'] . "%;";
		if($v['prodSoldOutPercent'] >= 40){
			$timeLeft = $timeLeft . "background-color:#289247;border-right:solid 1px #21773a;";
		} elseif($v['prodSoldOutPercent'] < 40 and $v['prodSoldOutPercent'] >= 16){
			$timeLeft = $timeLeft . "background-color:#fde20f;border-right:solid 1px #e8ce02;";
		} elseif($v['prodSoldOutPercent'] < 16 and $v['prodSoldOutPercent'] > 0){
			$timeLeft = $timeLeft . "background-color:#d6272e;border-right:solid 1px #b92228;";
		}
		$dealPrice = $v['prodPrice'];
		$dealShipping = $v['prodShipping'] . " shipping";
	}

	?>

	<div class="panel">
		<ul>
			<li class="product-name">
				<a href="http://<?= $v['siteUrl']; ?>" title="<?= $v['prodName']; ?>">
					<?= $v['prodNameTrim']; ?>
				</a>
			</li>
			<li class="share-button">
				<a href="#" title="asdf">
					<span>Img</span>
				</a>
			</li>
			<li class="time-left">
				<div>
					<span style="<?= $timeLeft; ?>"></span>
					<span class="alt">Time Left</span>
				</div>
			</li>
			<li class="product-image">
				<a href="http://<?= $v['siteUrl']; ?>" title="Click here to purchase <?= $v['prodName']; ?> from <?= $v['siteName']; ?>" target="_blank">
					<img src="<?= $v['prodDealImg']; ?>" alt="Picture of <?= $v['prodName']; ?>">
				</a>
			</li>
			<li class="site-image">
				<a href="http://<?= $v['siteUrl']; ?>" title="Go to <?= $v['siteName']; ?>">
					<img src="<?= $v['siteLogo']; ?>" alt="<?= $v['siteName']; ?> Logo">
				</a>
			</li>
			<li class="product-price">
				<ul>
					<li>
						<span class="price">
							<?= $dealPrice; ?>
						</span>
					</li>
					<li>
						<span class="shipping">
							<?= $dealShipping; ?>
						</span>
					</li>
				</ul>
			</li>
		</ul>
	</div>
	<?php
	}
}
?>