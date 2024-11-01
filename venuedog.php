<?php
/*
Plugin Name: VenueDog - Events
Plugin URI: http://venuedog.com/
Description: A sidebar widget that displayed events from VenueDog.com Events by Category.
Version: 1.1.2
Author: SAI Digital 
Author URI: http://saidigital.co
*/


define('VDOG_URL',WP_PLUGIN_URL.'/venuedog-events/');
include('lib/class.venuedog.php');
include('lib/widget.venuedog.php');





/* Setup Admin */
function venuedog_admin(){require_once("admin/global_options.php");}
function venuedog_menus() {
  if (current_user_can('manage_options')) {
    add_menu_page("VenueDog - Options", "VenueDog", "publish_posts", "venuedog-setup","venuedog_admin");
  }
}add_action('admin_menu', 'venuedog_menus');









/* Register JavaScript and CSS */
function venuedog_register_aux() {
  if(!is_admin()){
    /* JS */
    wp_enqueue_script('date', VDOG_URL.'VenueDogAPI/date.js');
    wp_enqueue_script('venuedog-js', VDOG_URL.'VenueDogAPI/venuedog.js',array('jquery', 'date'));
    #wp_enqueue_script('venuedog-events', VDOG_URL.'js/events.js', array('venuedog-js'));
    wp_enqueue_script('venuedog-events', site_url("?venuedog-asset=js"), array('venuedog-js'), "1.0.0", true);

    /* CSS */
    wp_enqueue_style('wpsqr-style',VDOG_URL.'css/style.css');

  }
}add_action('init', 'venuedog_register_aux');



/* register Widget */
add_action('widgets_init', create_function('', 'return register_widget("VenueDog_Widget");'));






/* Create route to dynamically generate JS */
function venuedog_parse_export($wp) {
    // only process requests POST'ed to "/?venuedog-asset=js"
    if (array_key_exists('venuedog-asset', $wp->query_vars) && $wp->query_vars['venuedog-asset'] == 'js') {
      include('js/events.js.php');
      die();exit();
    }
}add_action('parse_request', 'venuedog_parse_export');
function venuedog_parse_query_vars($vars) {
    $vars[] = 'venuedog-asset';
    return $vars;
}add_filter('query_vars', 'venuedog_parse_query_vars');



?>
