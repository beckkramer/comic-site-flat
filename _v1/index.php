<?php

include('classes/classes.php');

$site_content = new site_content;
$page_content = $site_content->getMostRecentPost();

$site_info = new site_info;
$page_info = $site_info->getInfo($page_content);

//include('parts/head.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Relativity: A Comic by Beck Kramer</title>
	<meta name="description" content="Ongoing LGBT sci-fi webcomic by Beck Kramer with updates every Wednesday.">
	<?php
	if(isset($page_info['ogImage'])) {
		echo '<meta property="og:image" content="' . $page_info['ogImage'] . '" />';
	}
	?>
	<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<link rel="stylesheet" href="<?php echo $page_info['root']; ?>/style.css" />
	<script type="text/javascript" src="<?php echo $page_info['root']; ?>/js/jquery-1.11.1.min.js"></script>
</head>

<body>
<div id="content">
	<?php 

	include('parts/header.php');

	/*

	if(!$page_content == null){

		$hasPageInfo = true;

		if($page_content['type'] == 'comic_page'){
			$pageNav = $site_content->getPageNav($page_content['page_num'], $page_info['root']);
			echo $pageNav;

			echo '<section>';

			if($page_content['spread_img_src'] != '') {
				echo '<p><button class="show-spread">view <span>larger</span> version</button></p>';
			}

			if($page_content['img_src']){
				echo '<img class="main" src="' . $page_info['root'] .'/images/pages/' . $page_content['img_src'] . '" width="750" height="1144" alt="Relativity Page ' . $page_content['page_num'] . ': ' . $page_content['name'] . '" />'; 
			}

			echo '<p class="post-date">posted on ' . date_format(date_create($page_content['post_date']), 'm/d/Y') . '</p>';
			echo '</section>';

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

	*/
	?>
	
	
	<section id="main-panel">
		<aside class="has-tiles">
			<a class="tile mostRecent" href="http://relativitycomic.com/part-1-reentry/page.php?page=27"><span>Most Recent</span> Update</a>
			<a class="tile part1" href="http://relativitycomic.com/part-1-reentry/page.php?page=1"><span>Part 1</span> Reentry</a>
		</aside>
		<h1>Part 1 is done!</h1>
		<p>Whew! The first part of Relativity, Reentry, is now complete! You can read it from the beginning <a href="http://relativitycomic.com/part-1-reentry/page.php?page=1">here</a>.</p>
		<h2>What's next?</h2>
		<p>Don't worry! I'm working on Part 2 as we speak, and it will start updating in March. Watch this space or follow the comic on Twitter to keep updated!</p>
	</section>

	<?php

	include('parts/foot.php');

	?>
</div>
</body>