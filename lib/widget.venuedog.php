<?php

/**
 *  VenueDog Widget Class
 */
class VenueDog_Widget extends WP_Widget{
  

  function VenueDog_Widget(){
    /* Create widget */
    $widget_ops = array( 'classname' => 'VenueDog_Widget', 'description' => __('A widget displays events from VenueDog.'));
    $this->WP_Widget('VenueDog', 'VenueDog', $widget_ops, $widget_ops);

  }




  /** @see WP_Widget::widget - displays widget */ 
  function widget($args, $instance) {    
    extract( $args );
    $title = apply_filters('widget_title', empty($instance['title']) ? '&nbsp;' : $instance['title']);
    
    echo $before_widget;

    if ( $title ) { echo $before_title . $title . $after_title; } 

    echo '<div class="venuedog_events"></div>
          <p class="powered_by_venuedog">
          <a href="http://venuedog.com" target="_blank"><img src="'.VDOG_URL.'images/poweredby.png" alt="VenueDog Events" /></a></p>';
    echo $after_widget;
  }  
    






  /** @see WP_Widget::form - Creates the edit form for the widget */ 
  function form($instance) { 
    $instance = wp_parse_args( (array) $instance, array('title'=>'') );
    $title     = htmlspecialchars($instance['title']);
    
    echo '<p style="text-align:left;"><label for="' . $this->get_field_name('title') . '">' . __('Title:') . ' <br /><input style="width: 100%;" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></label></p>';
  }






  /** @see WP_Widget::update - Saves the widgets settings */ 
  function update($new_instance, $old_instance) {   
    $instance = $old_instance;

    /* Strip tags (if needed) and update the widget settings. */ 
    $instance['title'] = strip_tags( $new_instance['title'] );
    
    return $instance;  
  } 



  
}
?>
