<?php

$site_content = new site_content;
$page_content = $site_content->getMostRecentPost();

if (!empty($page_content)) {
	if($page_content['type'] == 'comic_page'){
		if($page_content['img_src']){
			echo '<img src="images/pages/' . $page_content['img_src'] . '" />'; 
		}
	} else {
		?>

	<div id="main-panel">
		<h2><?php echo $page_content['name']; ?></h2>
		<article>
			<?php echo $page_content['description']; ?>
		</article>
	</div>

		<?php
	}
}



?>