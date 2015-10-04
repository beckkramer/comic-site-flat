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
		<header>
			<h1>Archive</h1>
		</header>

		<?php
		foreach ($chapters as $this_chapter) {

			echo '<h2>Part ' . $this_chapter->number . ': ' . $this_chapter->name . '</h2>';

			$chapter_pages = $chapter->getPagesInChapter($this_chapter->number);

			//var_dump($chapter_pages);

			$i = 0;
			$total_pages = count($chapter_pages);

			echo '<ul class="page-list">';
			foreach ($chapter_pages as $page) {
				echo '<li><a href="' . $site_info->root . '/part-' . $this_chapter->number . '-' . strtolower($this_chapter->name) .'/page.php?page=' . $page['page_num'] . '">';
				echo 'Page ' . $page['page_num'] . '</a></li>';
			}
			echo '</ul>';

		}
		?>
	</main>

	<?php include('parts/foot.php'); ?>
</div>
</body>