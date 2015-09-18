<?php

define ('CURRENT_CHAPTER', 1);

include_once('../core/classes.php');
$site_info = new SiteInfo;
$comic = new Comic;
$nav = new Navigation;
$chapter = new Chapter;
$chapters = $chapter->getChapters();
$current_chapter = $chapter->getChapterByNumber(CURRENT_CHAPTER);
$hasPageInfo = false;

if($_GET && isset($_GET["page"])){
	
	$pageNum = $_GET["page"];
	//$meta_info = $comic->getMetaInfo($pageNum);
	$current_page = $comic->getPageByNumber($pageNum);
	
	date_default_timezone_set("America/Chicago");
	$rightnow = date('Y-m-d G:i:s', time());	

	if($rightnow > $current_page->post_date){
		$hasPageInfo = true;
	}

} else {
	$current_page = $comic->getPageByNumber(1);
}

include('../parts/head.php');

?>

<body>
<div id="content">
	<?php
		include('../parts/header.php');
		include('../parts/page-content.php');
		include('../parts/foot.php');
	?>
</div>
</body>