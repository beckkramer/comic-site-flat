
<div id="foot">
	<?php
	include('nav-main.php');
	date_default_timezone_set("America/Chicago");
	?>
	<p>
		All content &copy; 2013-<?php echo date('Y'); ?> Beck Kramer<br />
		Do not reproduce without permission.
	</p>
	<ul class="social">
		<li><a href="https://twitter.com/RelativityComic" target="_blank">twitter</a></li>
		<li><a href="http://relativitycomic.tumblr.com/" target="_blank">tumblr</a></li>
		<li><a href="https://www.facebook.com/relativitywebcomic" target="_blank">facebook</a></li>
		<li><a href="http://relativitycomic.com/rss.xml" target="_blank">rss</a></li>
	</ul>
</div>

<script>

var windowWidth = $(window).width(),
	$mainImg = $('img.main'),
	originalSrc = $mainImg.attr('src'),
	newSrc = '';

$(document).ready(function(){
	$('.modalToggle').on('click', function(){
		$('.aboutBeck').toggle();
	});
	$('.aboutBeck .close').on('click', function(){
		$('.aboutBeck').hide();
	});
});

<?php
	if($page_content['type'] == 'comic_page' && $page_content['spread_img_src'] != ''):
?>
	var spreadSrc = "<?php echo $page_info['root'] ?>/images/pages/<?php echo $page_content['spread_img_src']; ?>",
	$spreadButton = $('.show-spread');

$mainImg.hide();

if (windowWidth > 980) {
	$mainImg.attr("src", spreadSrc);
	$mainImg.attr("width", '1525');
	$spreadButton.find("span").text("smaller");
} 

$mainImg.show();

$spreadButton.show();
$spreadButton.on('click', function(){
	
	if($mainImg.attr("src") == spreadSrc) {
		$(this).find("span").text("larger");
		$mainImg.hide().attr({
			"src" : originalSrc,
			"width" : 750
		}).show();
	} else {
		$(this).find("span").text("smaller");
		$mainImg.hide().attr({
			"src" : spreadSrc,
			"width" : 1525
		}).show();
	}
		

});

<?php endif; ?>

  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-51263460-1', 'relativitycomic.com');
  ga('send', 'pageview');

</script>