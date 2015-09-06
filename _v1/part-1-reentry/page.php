<?php

//$title = 'Relativity - A Comic by Beck Kramer';
include('../classes/classes.php');

$site_content = new site_content;

$hasPageInfo = false;

if($_GET && isset($_GET["page"])){
	
	$pageNum = $_GET["page"];
	$page_content = $site_content->getPageByNumber($pageNum);

	if(empty($page_content)) {
		$page_content = $site_content->getPageList();
	} else {

		date_default_timezone_set("America/Chicago");
		$rightnow = date('Y-m-d G:i:s', time());

		if($rightnow > $page_content['post_date']){
			$hasPageInfo = true;
		} else {
			$page_content = $site_content->getPageList();
		}
	}

} else {
	$page_content = $site_content->getPageList();
}

$site_info = new site_info;
$page_info = $site_info->getInfo($page_content);

include('../parts/head.php');

?>

<body>
<div id="content">
	<?php include('../parts/header.php'); ?>
	<?php include('../parts/page-content.php'); ?>
	<?php include('../parts/foot.php'); ?>
</div>
</body>