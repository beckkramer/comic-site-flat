<?php $lastPage = $nav->getLastPage(); ?>
<nav class="main">
	<ul class="site">
		<li><a href="<?php echo $site_info->root ?>">Home</a></li>
		<li><a href="<?php echo $site_info->root ?>/archive.php">Archive</a></li>
		<li><a href="<?php echo $site_info->root ?>/store.php">Store</a></li>
		<li><a href="<?php echo $site_info->root ?>/contact.php">Contact</a></li>
	</ul>
	<ul class="read">
		<li>Read:</li>
		<li><a href="part-1-reentry/page.php?page=1">The First Page</a></li>
		<li><a href="part-2-orbit/page.php?page=<?php $lastPage['number']; ?>">The Most Recent Page</a></li>
	</ul>
</nav>