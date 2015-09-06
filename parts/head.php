<?php
$title = 'Relativity : A Sci Fi Comic';

if(isset($meta_info)) {
	$title = $meta_info['title'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $title; ?></title>
	<meta name="description" content="Ongoing LGBT sci-fi webcomic by Beck Kramer with updates every Wednesday.">
	<?php
	//if(isset($page_info['ogImage'])) {
	//	echo '<meta property="og:image" content="' . $page_info['ogImage'] . '" />';
	//}
	?>
	<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<link rel="stylesheet" href="<?php echo $site_info->root; ?>/style.css" />
	<script type="text/javascript" src="<?php echo $site_info->root; ?>/js/jquery-1.11.1.min.js"></script>
</head>