<?php

define ('CURRENT_CHAPTER', 2);

include_once('core/classes.php');

$site_info = new SiteInfo;
$comic = new Comic;
$nav = new Navigation;
$chapter = new Chapter;
$hasPageInfo = true;

$lastPage = $nav->getLastPage();
$current_chapter = $chapter->getChapterByNumber(CURRENT_CHAPTER);
$chapters = $chapter->getChapters();
$current_page = $comic->getPageByNumber($lastPage['number']);

include('parts/head.php');
?>

<body>
<div id="content">
	<?php include('parts/header.php');
	//include('parts/page-content.php');
	?>

	<style>
	.nav-tile {
		display: block;
		margin: 15px 0;
	}
	</style>

	<a class="nav-tile" href="part-1-reentry/page.php?page=1"><img src="images/site/hp-nav-part1.png" alt="Read Part 1: Reentry" /></a>

	<a class="nav-tile" href="part-2-orbit/page.php?page=0"><img src="images/site/hp-nav-part2.png" alt="Read Part 2: Orbit" /></a>

	<? include('parts/foot.php');	?>
	<!--
	<section id="main-panel">
		<img style="margin: 0 auto" src="http://relativitycomic.com/images/site/updates/part2Teaser.png" width="600" title="Part 2: Orbit starts March 25 2015" alt="Part 2: Orbit starts March 25 2015" />
		<aside class="has-tiles">			
			<a class="tile part1" href="http://relativitycomic.com/part-1-reentry/page.php?page=1"><span>Read Part 1:</span> Reentry</a>
		</aside>
	</section>
	-->
</div>
</body>