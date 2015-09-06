<?php

include_once('core/classes.php');

$site_info = new SiteInfo;
$chapter = new Chapter;
$hasPageInfo = false;

$chapters = $chapter->getChapters();

include('parts/head.php');

?>

<body>
<div id="content">
	<?php include('parts/header.php'); ?>
	
	<main id="main-panel">
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