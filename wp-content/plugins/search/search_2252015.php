<?php
ob_start();
/*
Plugin Name: Search
Description: Searching and Showing posts and Jobs.
Version: 1.00
Author: Salim malik @ Taya Technologies Pvt Ltd.
*/

// Search posts and jobs based on search term.
function search_page()
{
	global $wpdb;
		$url = explode("/",$_SERVER['REQUEST_URI']);
		$id = explode("?",$url[2]);
		$text = explode("=",$id[1]);
		if($text[0] == 'search'){
    /*if(!empty($_GET))
    {*/
			$title = $_GET['search'];
    		$match = array('services','contact','careers','sitemap');
    		if(!empty($_GET) && !in_array($title, $match)){
    		$posttable = $wpdb->prefix.'posts';
			$postmetatable = $wpdb->prefix.'postmeta';
			
			$query = "SELECT post_name, post_status, post_title, post_content, ".$postmetatable.".meta_value FROM ".$posttable." JOIN ".$postmetatable." ON ".$postmetatable.".post_id=".$posttable.".ID WHERE ".$postmetatable.".meta_key='Short Description' AND (post_title LIKE '%$title%' or post_content LIKE '%$title%')";
			$pages = $wpdb->get_results($query);
			if(count($pages)!=0)
			{
				foreach ($pages as $key => $values) 
				{
					$permalink = "http://ecentrichr.com/".$values->post_name;
					$content = substr($values->meta_value,0,500);
					$posts .= "<div class='search-p-tags'><h3><a href='$permalink' target='_blank'>$values->post_title</a></h3><p>$content [...]</p></div>"; 
				}
					$message = <<<Message
					<div class="content-wrapper" style="min-height:600px;">
					<div class="header-text-22"><h2>Search Results for : $title</h2></div>
					$posts
					</div>
					</div>
Message;
return $message;
			}
				else
				{
					$message = <<<Message
					<div class="content-wrapper" style="min-height:600px;">
					<div class="header-text-22"><h2>Search Results for : $title</h2></div>
					<b><pre>Nothing Found <br/>Sorry, but nothing matched your search criteria. Please try again with some different keywords.</b></pre>
					</div>
					</div>
Message;
return $message;
				}
	}
			else
			{
				$message = <<<Message
				<div class="content-wrapper" style="min-height:600px;">
				<div class="header-text-22"><h2>Search Results for : $title</h2></div>
				<b>No Results found</b>
				</div>
				</div>
Message;
return $message;
			}

		}else{
		wp_redirect(home_url());exit;
	}
}

// add shotcode for display results in search results page.
add_shortcode(search_results, search_page);


function ecentric_search_actions() {
	wp_enqueue_style( 'ecentric_stylesheet', plugins_url( 'css/css.css', __FILE__ ) );
	wp_enqueue_style( 'ecentric_stylesheet', plugins_url( 'css/style.css', __FILE__ ) );
}
 
add_action('admin_menu', 'ecentric_search_actions');
?>