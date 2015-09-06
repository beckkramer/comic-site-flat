<?php

class site_info {
	public function getInfo($page_content) {

		$site_info = array();

		//$siteroot = 'http://localhost/relativity';
		$siteroot = 'http://relativitycomic.com';

		$site_info['root'] = $siteroot;

		if (isset($page_content) && isset($page_content['type'])) {
			if($page_content['type'] == 'comic_page') {

				$pageNumInfo = 'Page ' . $page_content['page_num'];
				if($pageNumInfo == 6) {
					$pageNumInfo = 'Pages 6 &amp; 7';
				}
				if($pageNumInfo == 29) {
					$pageNumInfo = 'Pages 29 &amp; 30';
				}

				$site_info['title'] = 'Relativity - ' .$pageNumInfo;
				$site_info['ogImage'] = $siteroot . '/images/pages/' . $page_content['img_src'];	
			}			
		} else {
			$site_info['title'] = 'Relativity: A Comic by Beck Kramer';
		}
		return $site_info;
	}
}

class site_content
{	
	private function connect()
	{
		
		$db_name = 'relativityDB';
		$db_user = 'relAdmin';
		$db_pass = 'wt45POwvwP2C';		

		//$mysqli = new mysqli("relativitycomic.com", $db_user, $db_pass, $db_name);
		$mysqli = new mysqli("localhost", $db_user, $db_pass, $db_name);

		if ($mysqli->connect_errno) {			
		    echo "In connect() - Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
		return $mysqli;
	}

	public function getLastPage() {
		$mysqli = $this->connect();

		date_default_timezone_set("America/Chicago");
		$rightnow = "'" . date('Y-m-d G:i:s', time()) . "'";

		$lastPageNum = 0;

		$last_page_query = "SELECT main_id FROM content_info WHERE post_date BETWEEN '2014-06-24 00:00:00' AND $rightnow ORDER BY post_date DESC LIMIT 1";

		if ($result = $mysqli->query($last_page_query)) {

			while($info_obj = $result->fetch_object()) {
				$last_page_id = intval($info_obj->main_id);							
	        }
	        $result->close();
	    }
	    if($last_page_id != 0) {
		    $page_num_query = "SELECT page_num FROM comic_info WHERE parent_id = $last_page_id";
			if ($result = $mysqli->query($page_num_query)) {
				while($comic_obj = $result->fetch_object()) {
					$lastPageNum = $comic_obj->page_num;
				}
				$result->close();					
			}
		}

	    return $lastPageNum;
	}

	public function getMostRecentPost() {

		$mysqli = $this->connect();

		$postContent = array();
		$post_type = 'none';
		
		date_default_timezone_set("America/Chicago");
		$rightnow = "'" . date('Y-m-d G:i:s', time()) . "'";

		$recent_post_query = "SELECT * FROM content_info WHERE post_date BETWEEN '2014-06-01 00:00:00' AND $rightnow ORDER BY post_date DESC LIMIT 1";
		
		if ($result = $mysqli->query($recent_post_query)) {
			while($info_obj = $result->fetch_object()) {

				$post_type = $info_obj->type;
				$post_id = $info_obj->main_id;
				$main_post_content = (array) $info_obj;

	        } 
	        $result->close();
	    }

	    // If content is a comic page, append comic-related info
        if($post_type == "comic_page") {
        	$recent_post_query = "SELECT * FROM comic_info WHERE parent_id = $post_id";
			if ($result = $mysqli->query($recent_post_query)) {
				while($comic_obj = $result->fetch_object()) {
					$postContent = array_merge ( $main_post_content, (array) $comic_obj );
				}
				$result->close();
			}

        } else {
        	$postContent = $main_post_content;  	
        }

	    return $postContent;

	}

	public function getPostContent($post_id) {

		$mysqli = $this->connect();

		$postContent = array('');
		
		$this_post_query = "SELECT * FROM content_info WHERE main_id = " . $post_id;
		
		if ($result = $mysqli->query($this_post_query)) {
		    //printf("Select returned %d rows.\n", $result->num_rows);		    	    

		    while($info_obj = $result->fetch_object()) {

		    	// If content is a comic page, append comic-related info
	            if($info_obj->type == "comic_page") {
	            	$recent_post_query = "SELECT * FROM comic_info WHERE parent_id = $info_obj->main_id";
					if ($result = $mysqli->query($recent_post_query)) {
						while($comic_obj = $result->fetch_object()) {
							$postContent = array_merge ( (array) $info_obj, (array) $comic_obj );
						}
					}
	            } else {
	            	$postContent = (array) $info_obj;
	            }
	        } 

	        //var_dump($postContent);

	        $result->close();

	        return $postContent;
		    
		}

	}

	public function getPageByNumber($page_num) {

		$mysqli = $this->connect();

		$postContent = array();

		$page_num = (int) $page_num;
		
		$this_post_query = "SELECT * FROM comic_info WHERE chapter = 1 AND page_num = $page_num";
		
		if ($result = $mysqli->query($this_post_query)) {
		    //printf("Select returned %d rows.\n", $result->num_rows);		    	    

		    while($comic_obj = $result->fetch_object()) {
		    	// If content is a comic page, append comic-related info	            
            	$recent_post_query = "SELECT * FROM content_info WHERE main_id = $comic_obj->parent_id";
				if ($result = $mysqli->query($recent_post_query)) {
					while($info_obj = $result->fetch_object()) {
						$postContent = array_merge ( (array) $info_obj, (array) $comic_obj );
					}
				}
	            
	        } 

	        //var_dump($postContent);

	        $result->close();
		    
		}

		return $postContent;

	}

	public function getPostList() {

		$mysqli = $this->connect();

		$postList = array();
		
		$recent_post_query = "SELECT * FROM content_info";
		
		if ($result = $mysqli->query($recent_post_query)) {
		    //printf("Select returned %d rows.\n", $result->num_rows);		    	    

		    while($info_obj = $result->fetch_object()) {
				$postList[] = (array)$info_obj;
	        } 

	        $result->close();

	        return $postList;
		    
		}

	}

	public function getPageList() {

		$mysqli = $this->connect();

		$pageList = array();
		$post_type = 'none';
		$all_pages = array();
		
		date_default_timezone_set("America/Chicago");
		$rightnow = "'" . date('Y-m-d G:i:s', time()) . "'";

		$recent_post_query = "SELECT * FROM content_info WHERE post_date BETWEEN '2014-06-01 00:00:00' AND $rightnow ORDER BY post_date ASC";
		
		if ($result = $mysqli->query($recent_post_query)) {
			while($info_obj = $result->fetch_object()) {

				$all_pages[] = (array) $info_obj;

	        } 
	        $result->close();
	    }

	    foreach ($all_pages as $page) {

			$post_type = $page['type'];
			$post_id = intval($page['main_id']);

			if($post_type == "comic_page") {
	        	$recent_post_query = "SELECT * FROM comic_info WHERE parent_id = $post_id";
				if ($result = $mysqli->query($recent_post_query)) {
					while($comic_obj = $result->fetch_object()) {
						$allInfo = array_merge ( $page, (array) $comic_obj );
						$pageList[] = $allInfo;
					}
					$result->close();
				}

	        } else {
	        	$pageList[] = $page;
	        }

	    }

	    return $pageList;

	}


	public function getPageNav($page_num, $root) {

		$firstPage = 1;
		$lastPageNum = $this->getLastPage();

		$pageLinkRoot = $root . '/part-1-reentry/page.php?page=';

		$pageNav = '<ul id="page-nav">';
		$pageNav .= '<li class="prev-links">';

		$pagesAhead = 1;
		$pagesBehind = 1;

		//accounting for spread- need a better way to handle this
		if($page_num == 6) { $pagesAhead = 2; }
		if($page_num == 8) { $pagesBehind = 2; }

		// get first & previous pages
		if(($page_num-1) != 0) {
			$pageNav .= '<ul>';
			$pageNav .= '<li><a alt="first page" rel="start" href="' . $pageLinkRoot . '1">first</a></li>';
			$pageNav .= '<li><a class="prev-page" alt="previous page" rel="prev" href="' . $pageLinkRoot . ($page_num - $pagesBehind) .'">previous</a></li>';
			$pageNav .= '</ul>';
		}

		$pageNav .= '</li>';
		$pageNav .= '<li class="cur-page"><span>Part 1 : Reentry</span><span class="divide"> : </span><span>Page ' . $page_num . '</span></li>';
		$pageNav .= '<li class="next-links">';

		// get next & last pages
		if($page_num != $lastPageNum) {
			$pageNav .= '<ul>';
			$pageNav .= '<li><a class="next-page"  alt="next page" rel="next" href="' . $pageLinkRoot . ($page_num + $pagesAhead) .'">next</a></li>';
			$pageNav .= '<li><a alt="last page" href="' . $pageLinkRoot . $lastPageNum .'">last</a></li>';
			$pageNav .= '</ul>';
		}	

		$pageNav .= '</li>';
		$pageNav .= '</ul>';

		return $pageNav;

	}

}




?>