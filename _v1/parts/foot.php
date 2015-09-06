
<div id="foot">
	<?php include('nav-main.php'); ?>
	All content &copy; 2013-<?php echo date('Y'); ?> Beck Kramer
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
$(document).keydown(function(e){

// 37 - left, 38 - up, 39 - right, 40 - down

	// left & down arrow keys
	if (e.keyCode === 37) {
		$( ".prev-page" ).last().trigger( "click" );
		return false;
    }
    //right arrow key
    if (e.keyCode === 39) {
    	$( ".next-page" ).last().trigger( "click" );
       	return false;
    }
});

<?php
if($hasPageInfo == true){
	if($page_content['type'] == 'comic_page' && $page_content['spread_img_src'] != '') {
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

<?php }} ?>


</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-51263460-1', 'relativitycomic.com');
  ga('send', 'pageview');

</script>