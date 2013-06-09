<?include 'lib/Fetch.php';?>
<?$sites = scrapeDeals();?>

<div class="body">

	<div id="deals" class="row deals-main">
		<div class="twelvecol sort">
			<a class="filter" data-filter="all" href="#">All</a>
			<a class="filter" data-filter="woot" href="#">woot!</a>
			<a class="filter" data-filter="midnight" href="#">Midnight Box</a>
		</div>
		<div class="twelvecol panels">
			<?$siteCount = 0?>
			<?foreach($sites as $sitek => $site):?>
				<?$siteCount += count($site);?>
				<?foreach($site as $subk => $sub):?>
				<article class="mix <?=$sitek?>">
					<a class="frame open-popup-link" href="#<?=$subk?>">
						<img src="<?=auto_version_cdn('/deal-images/' . $sub['prodDealImg'])?>" alt="Your Alt Tag">
					</a>
					<div id="<?=$subk?>" class="row mfp-hide deal-info">
						<div class="sixcol deal-info-image">
							<img src="<?=auto_version_cdn('/deal-images/' . $sub['prodDealImg'])?>" alt="Your Alt Tag">
						</div>
						<div class="sixcol last">
							<h3><?=$sub['prodName']?></h3>
							<img src="<?=get_template_directory_uri();?>/images/<?=$sub['siteLogo']?>" />
							<?if(!empty($sub['prodDescription'])):?>
								<p><?=$sub['prodDescription']?></p>
			                <?endif;?>
		                	<p><span><?=$sub['prodPrice']?></span></p>
		                	<p><span><?=$sub['prodShipping']?></span></p>
		                	<a class="button-primary" href="http://<?=$sub['siteUrl']?>">Buy Now</a>
		                </div>
					</div>
				</article>
				<?endforeach;?>
			<?endforeach;?>
			<?function addArticle($number) { for($i=0;$i<$number;$i++){echo'<article class="break"></article>&nbsp;';}}?>
			<?
			if($siteCount%6 === 1) {
				return;
			} elseif($siteCount%6) {
				addArticle(6-($siteCount%6)+1);
			} elseif($siteCount%6 === 0) {
				addArticle(1);
			}
			?>
		</div>

	</div>

</div>