<?php
define ('CURRENT_CHAPTER', 2);
include_once('core/classes.php');

$site_info = new SiteInfo;
$comic = new Comic;
$nav = new Navigation;
$chapter = new Chapter;
$hasPageInfo = false;

$lastPage = $nav->getLastPage();
$current_chapter = $chapter->getChapterByNumber(CURRENT_CHAPTER);
$chapters = $chapter->getChapters();
$current_page = $comic->getPageByNumber($lastPage['number']);

include('parts/head.php');

?>

<body>
<div id="content">
	<?php include('parts/header.php'); ?>

	<main>
			<h2>Contact</h2>
			<p>If you have any questions or comments about Relativity or my work in general, please email bk at relativitycomic.com</p>
			<h3>Follow Relativity on:</h3>
			<ul class="social">
				<li><a href="https://twitter.com/RelativityComic" target="_blank">twitter</a></li>
				<li><a href="http://relativitycomic.tumblr.com/" target="_blank">tumblr</a></li>
				<li><a href="https://www.facebook.com/relativitywebcomic" target="_blank">facebook</a></li>
				<li><a href="http://relativitycomic.com/rss.xml" target="_blank">rss</a></li>
			</ul>
			<h3>Follow Beck Kramer on:</h3>
			<ul class="social">
				<li><a href="https://twitter.com/beckkramer" target="_blank">twitter</a></li>
				<li><a href="http://beckkramer.tumblr.com/" target="_blank">tumblr</a></li>
			</ul>
	</main>

	<?php include('parts/foot.php'); ?>
</div>
</body>