<?php

$pageNav = $nav->getPageNav($current_page, $site_info->root);

if($hasPageInfo == true){

	echo '<h2>Part ' . $current_chapter->number . ': ' . $current_chapter->name . '</h2>';
	echo '<p>';
	foreach ($chapters as $key => $this_chapter) {

		if($this_chapter->number != CURRENT_CHAPTER) {
			echo '<a href="' . $site_info->root .'/part-' . $this_chapter->number . '-' . strtolower($this_chapter->name) . '/page.php?page=1">';
			echo 'Read Part ' . $this_chapter->number . ': ' . $this_chapter->name;
			echo '</a>';
		}
	}
	echo '</p>';

	if($current_page->type == 'comic_page'){
		//echo '<h2>Part '. $currentChapter->number . ': ' . $currentChapter->name .'</h2>';
		//echo '<p class="post-date"><a href="' . $site_info->root . '/part-1-reentry/page.php?page=1">Read from the Beginning</a></p>';

		include('nav-page.php');

		if($current_page->spread_img_src != '') {
			//echo '<p><button class="show-spread">view <span>larger</span> version</button></p>';
		}

		if($current_page->img_src != ''){
			
			echo '<img class="main" src="' . $site_info->root .'/images/pages/' . $current_page->img_src . '" width="750" height="1144" alt="Relativity Page ' . $current_page->page_num . ': ' . $current_page->name . '" />';	
			
		}
		include('nav-page.php');
		echo '<p class="post-date">posted on ' . date_format(date_create($current_page->post_date), 'm/d/Y') . '</p>';
	} else {
		
		?>

	<section id="main-panel">			
		<article>
			<h1><?php echo $current_page->name; ?></h1>
			<?php echo $current_page->description; ?>
		</article>
	</section>

		<?php
	}

} else {
	?>
	<section id="main-panel">			
		<article>
			<h1>Page not found.</h1>
			<p>Sorry, but that page isn't found. Please <a href="<?php echo $site_info->root; ?>/archive.php">visit the archive</a>.</p>
		</article>
	</section>
	<?php
}

?>
