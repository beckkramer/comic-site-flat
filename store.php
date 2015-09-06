<?php

include_once('core/classes.php');
$site_info = new SiteInfo;
$hasPageInfo = false;

include('parts/head.php');

?>

<body>
<div id="content">
	<?php
		include('parts/header.php');
	?>

	<main>
		<h2>Prints on society6</h2>
		<p>
			<a target="_blank" href="http://society6.com/product/you-and-me-k20_print#1=45" alt="you and me print">
				<img src="images/site/youAndMe_printThumb.png" alt="You and Me print" />
				<br /><span>You and Me</span>
			</a>
		</p>
		<p>
			<a target="_blank" href="http://society6.com/product/per-aspera-ad-astra-e9o_print#1=45" alt="Per Aspera Ad Astra" width="650" height="488" />
				<img src="images/site/perAsperaAdAstra_printThumb.png" alt="Per Aspera Ad Astra print" width="450" height="573" />
				<br /><span>Per Aspera Ad Astra</span>
			</a>
		</p>
	</main>

	<?php
		include('parts/foot.php');
	?>
</div>
</body>