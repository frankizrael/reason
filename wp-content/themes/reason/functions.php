<?php
/* Theme Support */
add_theme_support('html-5');
add_theme_support('post-thumbnails');
add_theme_support('custom-logo');
add_theme_support('title-tag');
add_filter('show_admin_bar', '__return_false');

/* Register custom post types and custom taxonomies */
/*require_once 'inc/register-taxonomy-game.php';*/

/* Bootstrap Nav Walker */
/*require_once 'inc/bootstrap-nav-walker.php';*/

/* Register Widgets */
/*require_once 'inc/register-button-widget.php';*/

/* Register menus */
function register_my_menus() {
	register_nav_menus(
		array(
			'header-menu' => __('Header Menu'),
            'footer-menu' => __('Footer Menu')
		)
	);
}
add_action('init', 'register_my_menus');

/* Hide posts from menu */
function hide_post_menu() {
	remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'hide_post_menu');

/* Load assets */
function load_assets($entries) {
	$assets = file_get_contents(get_stylesheet_directory() . '/assets.json');
	$assets = json_decode($assets);
	foreach ( $assets as $chunk => $files ) {
		foreach ($entries as $entry) {
			if ( $chunk == $entry ) {
				foreach ($files as $type => $asset) {
					switch ($type) {
						case 'js':
							wp_enqueue_script($chunk, get_stylesheet_directory_uri() . '/dist/' . $asset, array(), false, true);
							break;
						case 'css':
							wp_enqueue_style($chunk, get_stylesheet_directory_uri() . '/dist/' . $asset);
					}
				}
			}
		}
	}
}


/* Register sidebar */
/*register_sidebar(array(
	'name' => 'Footer',
	'id' => 'footer-sidebar',
	'before_widget' => '<div id="%1$s" class="col-12 col-md mb-3 mb-md-0 widget %2$s">',
	'after_widget'  => '</div>',
));*/

/* Remove prefix */
function remove_archive_prefix($title) {
    return preg_replace('/^\w+: /', '', $title);
}
add_filter('get_the_archive_title', 'remove_archive_prefix');

/* Excerpt size */
function tn_custom_excerpt_length($length) {
	return 20;
}
add_filter('excerpt_length', 'tn_custom_excerpt_length', 999);

/* Reduce terms to names */
function reduce_to_names($term) {
    return $term->name;
}

/* Is Ajax request */
function is_ajax() {
    return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

/* Change posts per page */
function change_posts_per_page( $query ) {
	if (is_post_type_archive('comments-matches')) {
		$query->set('posts_per_page', '5');
	}
}
add_action('pre_get_posts', 'change_posts_per_page');

if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();
}

/*pagination*/
function decorlux_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo '<div class="navigation">';
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages,
        'prev_text' => __('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g id="boton" transform="translate(-54)"><g id="area" transform="translate(54)" fill="#00329f" stroke="#707070" stroke-width="1" opacity="0"><rect width="24" height="24" stroke="none"></rect><rect x="0.5" y="0.5" width="23" height="23" fill="none"></rect></g><path id="icon_scroll_down" data-name="icon/scroll_down" d="M6.309,2.552a1.527,1.527,0,0,1,2.546,0l4.551,7.169a1.416,1.416,0,0,1-1.273,2.147h-9.1A1.416,1.416,0,0,1,1.758,9.721Z" transform="translate(72.868 4.459) rotate(90)" fill="#00329f" stroke="rgba(0,0,0,0)" stroke-width="1"></path></g></svg>','decorlux'),
        'show_all' => false,
        'end_size' => 1,
        'mid_size' => 1
    ));
    echo '</div>';
}

function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}

// function to count views.
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}


//
/* consulta url */
function get_callUrlConsulta() {
  $ruc = filter_input(INPUT_POST, 'ruc');
  $url ='https://www.desoftperu.org/query1520/delaware/license1359/delaware/02274537/application56142/consulta0452/v1/latam1074/system/developmentv2/application/ruc='.$ruc;
  //$url ='http://190.12.81.36/lotto-uat125-01/client_lotocard_show_map.html?latitude='.$lat.'&length='.$lng;
    // Get cURL resource
  $curl = curl_init();
  // Set some options - we are passing in a useragent too here
  curl_setopt_array($curl, [
      CURLOPT_RETURNTRANSFER => 1,
      CURLOPT_URL => $url,
      CURLOPT_USERAGENT => ''
  ]);
  // Send the request & save response to $resp
  $resp = curl_exec($curl);
  // Close request to clear up some resources
  curl_close($curl);
  //wp_send_json( $resp );
  echo $resp;
  wp_die();
}
add_action('wp_ajax_nopriv_callurlConsulta', 'get_callurlConsulta');
add_action('wp_ajax_callurlConsulta', 'get_callurlConsulta');


