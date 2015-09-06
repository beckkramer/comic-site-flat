<?php


if(!empty($page_content)){

	if($hasPageInfo == true){		

		if($page_content['type'] == 'comic_page'){

			$pageNav = $site_content->getPageNav($pageNum, $page_info['root']);
			$lastPage = $site_content->getLastPage();

			$url = $page_info['root'] . '/part-1-reentry/page.php?page=';

			echo $pageNav;

			if($page_content['spread_img_src'] != '') {
				echo '<p><button class="show-spread">view <span>larger</span> version</button></p>';
			}

			if($page_content['img_src']){
				echo '<section>';
				if ($page_content['page_num'] == $lastPage) {
					echo '<img class="main" src="' . $page_info['root'] .'/images/pages/' . $page_content['img_src'] . '" width="750" height="1144" alt="Relativity Page ' . $page_content['page_num'] . ': ' . $page_content['name'] . '" />';	
				} else {

					$nextPageUrl = $url . ($page_content['page_num'] + 1);
					if($page_content['page_num'] == 6) {
						$nextPageUrl = $url . ($page_content['page_num'] + 2);
					}

					echo '<a href="' . $nextPageUrl . '">';
					echo '<img class="main" src="' . $page_info['root'] .'/images/pages/' . $page_content['img_src'] . '" width="750" height="1144" alt="Relativity Page ' . $page_content['page_num'] . ': ' . $page_content['name'] . '" />';
					echo '</a>';
				}
				echo '<p class="post-date">posted on ' . date_format(date_create($page_content['post_date']), 'm/d/Y') . '</p>';
				echo '</section>';
			}
		} else {
			
			?>

		<section id="main-panel">			
			<article>
				<h1><?php echo $page_content['name']; ?></h1>
				<?php echo $page_content['description']; ?>
			</article>
		</section>

			<?php
		}

	} else {
		?>
		<section id="main-panel">
			<header>
				<h1>Archive</h1>
			</header>
			<section>
				<h2>Part 1: Reentry</h2>
				<ul class="page-list">
				<?php
				foreach ($page_content as $page) {
					if(isset($page['page_num']) && $page['page_num'] != "P") {
						$page_link = '<li><a href="' . $page_info['root'] . '/part-1-reentry/page.php?page=' . $page['page_num'] .'">';
						$page_link .= 'Page ' . $page['page_num'] . ' : ' . $page['name'] . '';						
						$page_link .= '</a></li>';
						echo $page_link;
					}
				}
				?>
				</ul>
			</section>
		</section>
		<?php
	}

	
}



?>