<?php

include('classes/classes.php');

$site_content = new site_content;
$page_content = $site_content->getMostRecentPost();

$site_info = new site_info;
$page_info = $site_info->getInfo($page_content);

include('parts/head.php');

?>

<body>
<div id="content">
	<?php include('parts/header.php'); ?>

	<div id="main-panel">
		<header>
			<h2>About Relativity</h2>
		</header>
		<article>
			<section>	
				<h3>The Mission</h3>
				<p>In 2027, NASA launches the first mission of the Daedalus Program in an effort to finally achieve manned light-speed travel. The first flight will take place over the course of 3 years on Earth, though only 5 months will pass for the pilot.</p>
			</section>
			<section>	
				<h3>The Characters</h3>
				<dl>
					<dt>Irina Novak</dt>
					<dd>A former Air Force pilot, Irina has flown on several NASA missions before being chosen to fly Daedalus 1.</dd>
					<dt>Anne </dt>
					<dd>Married to Irina, Anne is a professor of Pure Mathematics.</dd>
					<dt></dt>
					<dd>A cat.</dd>
				</dl>
			</section>			
		</article>
	</div>

	<?php include('parts/foot.php'); ?>
</div>
</body>