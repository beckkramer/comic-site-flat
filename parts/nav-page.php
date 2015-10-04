<?php

$chapter_path =  $site_info->root . '/part-' . $current_chapter->number . '-' . strtolower($current_chapter->name) . '/page.php?page=';

?>

<ul class="page-nav"><li class="prev-links">
		<?php if($current_page->page_num == 0 && CURRENT_CHAPTER != 1): ?>
		<?php
			$last_chapter = $chapter->getChapterByNumber(CURRENT_CHAPTER-1);
			$last_chapter_link = $site_info->root . '/part-' . $last_chapter->number . '-' . strtolower($last_chapter->name) . '/page.php?page=1';
		?>
		<ul>
		<li><a class="next-page"  alt="next chapter" rel="next" href="<?php echo $last_chapter_link; ?>">&lt;&lt; previous chapter</a></li>
		</ul>
		<?php endif; ?>
		<?php if($current_page->page_num != $pageNav->first_page_num): ?>
		<ul>
		<li><a alt="first page" rel="start" href="<?php echo $chapter_path . $pageNav->first_page_num; ?>">&lt;&lt; first</a></li>
		<li><a class="prev-page" alt="previous page" rel="prev" href="<?php echo $chapter_path . $pageNav->prev_page_num; ?>">&lt; previous</a></li>
		</ul>
		<?php endif; ?>
	</li><li class="cur-page">
		Part <?php echo CURRENT_CHAPTER; ?>, <span>Page <?php echo $current_page->page_num; ?> of <?php echo $pageNav->last_page_num; ?></span>
	</li><li class="next-links">
		<?php if($current_page->page_num != $pageNav->last_page_num): ?>
		<ul>
		<li><a class="next-page"  alt="next page" rel="next" href="<?php echo $chapter_path . $pageNav->next_page_num; ?>">next &gt;</a></li>
		<li><a alt="last page" href="<?php echo $chapter_path . $pageNav->last_page_num; ?>">final &gt;&gt;</a></li>
		</ul>
		<?php endif; ?>
		<?php if($current_page->page_num == $pageNav->last_page_num && CURRENT_CHAPTER != count($chapters)): ?>
		<?php
			$next_chapter = $chapter->getChapterByNumber(CURRENT_CHAPTER+1);
			$next_chapter_link = $site_info->root . '/part-' . $next_chapter->number . '-' . strtolower($next_chapter->name) . '/page.php?page=0';
		?>
		<ul>
		<li><a class="next-page"  alt="next chapter" rel="next" href="<?php echo $next_chapter_link; ?>">next chapter &gt;&gt;</a></li>
		</ul>
		<?php endif; ?>



	</li></ul>