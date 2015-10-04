
<?php

include('config.php');

/*
DB Connection
*/

function db_connect()
{

	global $db_name;
	global $db_user;
	global $db_pass;

	$db_host = 'localhost';
	$site_info = new SiteInfo;

	// Check if local version for QA or remote
	if($site_info->host == 'localhost') {
		$db_host = 'relativitycomic.com';
	}

	// Try and connect to the database
	$connection = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

	// If connection was not successful, handle the error
  if($connection === false) {
      return mysqli_connect_error();
  }
	return $connection;
}

/*
SiteInfo

public function __construct() 

The site host and root url

*/
class SiteInfo {

	public $host;
	public $root;
	
	public function __construct() {

		$rawRoot = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
		$parsedUrl = parse_url($rawRoot);

		$shim = '';

		if($parsedUrl['host'] == 'localhost') {
			$shim = '/comic-site-flat';
		}

		$this->host = $parsedUrl['host'];
		$this->root = 'http://' . $this->host . $shim;
	
	}
}

/*
Chapter

public function getChapters()
public function getChapterByNumber($num)
public function getPagesInChapter($chapter_num)

*/
class Chapter {

	public $chapter_num;

	public function getChapters()
	{
		$mysqli = db_connect();
		$chapter_info = array();
		
		$chapter_result = $mysqli->query("SELECT * FROM chapter_info");

		while ($chapter_obj = $chapter_result->fetch_object()) {
			$chapter_info[] = $chapter_obj;
		}
		return $chapter_info;
	}
	public function getChapterByNumber($num)
	{
		$mysqli = db_connect();
		$chapter_info = array();
		
		$chapter_result = $mysqli->query("SELECT * FROM chapter_info WHERE number = $num");

		if ($chapter_obj = $chapter_result->fetch_object()) {
			return $chapter_obj;
		}
		
	}

	public function getPagesInChapter($chapter_num)
	{
		$mysqli = db_connect();
		$post_obj;
		$comic_obj;
		$all_pages = array();
		
		$page_result = $mysqli->query("SELECT * FROM comic_info WHERE chapter = $chapter_num ORDER BY page_num");

		while ($comic_obj = $page_result->fetch_object()) {
			
	    	$comic_postInfo_query = "SELECT * FROM content_info WHERE main_id = $comic_obj->parent_id";
			
			if ($comic_postResult = $mysqli->query($comic_postInfo_query)) {
				$post_obj = $comic_postResult->fetch_object();
		        
			}

			date_default_timezone_set("America/Chicago");
			$rightnow = "'" . date('Y-m-d G:i:s', time()) . "'";

			if($rightnow < $post_obj->post_date ) {
				$all_pages[] = array_merge((array) $post_obj, (array) $comic_obj);
			}
		}
		
		return $all_pages;
	}
}

/*

Post

public $post_id
public $post_date
public $type
public $title
public $description
public function getPostByID($post_id)
public function getMetaInfo()

TODO:
-	Put the meta info into the database	rather than hard values here

*/

class Post {

	public $post_id;
	public $post_date;
	public $type;
	public $title;
	public $description;
	
	public function getPostByID($post_id)
	{
		
		$post_obj;
		$comic_obj;


		$mysqli = db_connect();

		$postInfo_query = "SELECT * FROM content_info WHERE main_id = " . $post_id;
		
		if ($postResult = $mysqli->query($postInfo_query)) {
			$post_obj = $postResult->fetch_object();
	        $postResult->close();
		}
		
		$comicInfo_query = "SELECT * FROM comic_info WHERE parent_id = " . $post_id;
		
		if ($comicResult = $mysqli->query($comicInfo_query)) {
		    $comic_obj = $comicResult->fetch_object();
	        $comicResult->close();
	    }

		return (object) array_merge((array) $post_obj, (array) $comic_obj);

	}

	public function getMetaInfo()
	{
		$meta_info = array();
		if (isset($page) && isset($page['type'])) {
			if($this->type == 'comic_page') {
				$pageNumInfo = 'Page ' . $this->page_num;
				if($this->spread_img_src != '') {
					$pageNumInfo .= ' &amp; ' . ($this->page_num)+1;
				}
				$meta_info['title'] = 'Relativity - ' .$pageNumInfo;
				$meta_info['ogImage'] = $root . '/images/pages/' . $page['img_src'];	
			}			
		} else {
			$meta_info['title'] = 'Relativity: A Comic by Beck Kramer';
		}
		return $meta_info;
	}
}

/*

Comic

public function getPageByNumber($page_num)

*/
class Comic extends Post {
	
	public $chapter;
	public $page_num;
	public $img_src;	
	public $spread_src;

	public function getPageByNumber($page_num)
	{

		$page_num = (int) $page_num;
		$mysqli = db_connect();
		$chapter_num = CURRENT_CHAPTER;
		$post_obj;
		$comic_obj;
		
		$pageNum_query = "SELECT * FROM comic_info WHERE chapter = $chapter_num AND page_num = $page_num";
		
		if ($comicResult = $mysqli->query($pageNum_query)) {
		    $comic_obj = $comicResult->fetch_object();
	        $comicResult->close();
	    }
    	
    	$comic_postInfo_query = "SELECT * FROM content_info WHERE main_id = $comic_obj->parent_id";
		
		if ($comic_postResult = $mysqli->query($comic_postInfo_query)) {
			$post_obj = $comic_postResult->fetch_object();
	        $comic_postResult->close();
		}

		return (object) array_merge((array) $post_obj, (array) $comic_obj);

	}

}

/*

Navigation

public function getLastPage($chapter = 2)
public function getPageNav($current_page, $root)

TODO: Change to more-clear PageNavigation, or add more universal functions

*/
class Navigation {

	// Returns the last page of the comic
	public function getLastPage($chapter = 2)
	{
		$mysqli = db_connect();

		date_default_timezone_set("America/Chicago");
		$rightnow = "'" . date('Y-m-d G:i:s', time()) . "'";

		$lastPageNum = 0;
		$lastPage = array();


		$last_page_query = "SELECT main_id FROM content_info WHERE post_date BETWEEN '2014-06-24 00:00:00' AND $rightnow ORDER BY post_date DESC LIMIT 1";

		if ($result = $mysqli->query($last_page_query)) {

			while($info_obj = $result->fetch_object()) {
				$last_page_id = intval($info_obj->main_id);							
	        }
	        $result->close();
	    }
	    
	    if($last_page_id != 0) {
		    $page_num_query = "SELECT page_num,chapter FROM comic_info WHERE parent_id = $last_page_id";
			if ($result = $mysqli->query($page_num_query)) {
				while($comic_obj = $result->fetch_object()) {
					$lastPage['number'] = $comic_obj->page_num;
					$lastPage['chapter'] = $comic_obj->chapter;
				}
				$result->close();					
			}
		}

	    return $lastPage;

	}

	// Returns the navigation for a given page (go forward/back a given page, etc)
	public function getPageNav($current_page, $root)
	{

		$mysqli = db_connect();
		$pageNav = new stdClass();
		$chapter = new Chapter;
		$folder = '';
		$chapter_name = '';
		$is_spread = false;
		$sibling_pages = $chapter->getPagesInChapter(CURRENT_CHAPTER);
		$lengthOfChapter = count($sibling_pages);
		$lastSib = $sibling_pages[$lengthOfChapter-1]['page_num'];
		$page_index = 0;

		foreach ($sibling_pages as $key => $value) {		
			if($value['page_num'] == $current_page->page_num) {
				$page_index = $key;
			}
		}

		// Check if this page is part of a two-page spread or not.
		$pageNav->is_spread = $is_spread;

		if($page_index-1 >= 0){
			$pageNav->prev_page_num = $sibling_pages[$page_index-1]['page_num'];
		}

		if($lastSib != $current_page->page_num) {
			$pageNav->next_page_num = $sibling_pages[$page_index+1]['page_num'];
		}			

		$pageNav->first_page_num = $sibling_pages[0]['page_num'];
		$pageNav->last_page_num = $lastSib;

		return $pageNav;
	}
	
}
?>