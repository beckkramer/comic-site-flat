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
	<?php
	include('parts/header.php');
	//include('parts/page-content.php');
	?>

	<section id="main-panel">
		<img src="images/site/teaser.png" />
		<p>When Irina Novak set off on NASA’s first light speed travel mission, She knew the flight would change her life.</p>
		<p>She just had no idea how much.</p>
		<h3>Read:</h3>
		<p>&gt; <a href="part-1-reentry/page.php?page=1">The First Page</a> &lt;</p>
		<p>&gt; <a href="<?php echo $current_chapter->folder . '/page.php?page=' . $lastPage['number']; ?>">The Most Recent Page</a> &lt;</p>
	</section>

	<? include('parts/foot.php');	?>

</div>
</body>