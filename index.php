<?include 'lib/Fetch.php';?>
<?$sites = scrapeDeals();?>

<div class="body">

	<div id="deals" class="row deals-main">
		<div class="twelvecol sort">
			<li class="button filter" data-filter="all" href="#">All</li>
			<li class="button filter" data-filter="woot" href="#">woot!</li>
			<li class="button filter" data-filter="midnight" href="#">Midnight Box</li>
			<li class="button filter" data-filter="yugster" href="#">Yugster</li>
		</div>
		<div class="twelvecol panels">
			<?$siteCount = 0?>
			<?foreach($sites as $sitek => $site):?>
				<?$siteCount += count($site);?>
				<?foreach($site as $subk => $sub):?>
				<article class="mix <?=$sitek?><?=!empty($sub['prodSoldOut'])? ' sold-out' : ''?>">
					<a class="frame open-popup-link" href="#<?=$subk?>">
						<img src="<?=auto_version_cdn('/deal-images/' . $sub['prodDealImg'])?>" alt="Your Alt Tag">
					</a>
					<div id="<?=$subk?>" class="row mfp-hide deal-info">
						<div class="sixcol deal-info-image">
							<img src="<?=auto_version_cdn('/deal-images/' . $sub['prodDealImg'])?>" alt="Your Alt Tag">
						</div>
						<div class="sixcol last">
							<img class="site-logo" src="<?=get_template_directory_uri();?>/images/<?=$sub['siteLogo']?>" alt="<?=$sub['siteName']?>" />
							<h3><?=$sub['prodName']?></h3>
							<?if(!empty($sub['prodDescription'])):?>
								<p><?=$sub['prodDescription']?></p>
			                <?endif;?>
			                <div class="row">
			                	<?if(empty($sub['prodSoldOut'])):?>
				                	<div class="twocol">
				                		<h4>Price:</h4>
				                	</div>
				                	<div class="tencol last">
				                		<?=$sub['prodPrice']?>
				                	</div>
				                </div>
				                <div class="row">
				                	<div class="twocol">
				                		<h4>Shipping:</h4>
				                	</div>
				                	<div class="tencol last">
				                		<?=$sub['prodShipping']?>
				                	</div>
				                <?else:?>
				                	<div class="twelvecol">
				                		<h4>Sold Out</h4>
				                	</div>
				                <?endif;?>
			                </div>
		                	<a class="button-primary" href="http://<?=$sub['siteUrl']?>">Buy Now</a>
		                </div>
					</div>
				</article>
				<?endforeach;?>
			<?endforeach;?>
			<?function addArticle($number) { for($i=0;$i<$number;$i++){echo'<article class="break"></article>&nbsp;';}}?>
			<?addArticle(5);?>
		</div>

	</div>

</div>