<?php
/**
 *  VenueDog Class for getting and saving settings
 */
class VenueDog{
  

  /* Set defaults, run update, setup current values */
  public function __construct(){
    $this->url = "http://venuedog.com/woof/";
    $this->categories_url = "http://venuedog.com/woof/categories/show/all";
    $this->get_days = array(7,6,5,4,3,2,1);

    if(!empty($_POST) && !empty($_POST['venuedog'])){
      $this->update();
    }
    
    $this->city = get_option("venuedog_city", 1);
    $this->days = get_option("venuedog_days", 7);
    $this->category_string = get_option("venuedog_categories", "1,2,3");
    $this->category_set = explode(',', $this->category_string);
  }
 



 /**
  *  Get category names and ids in real time
  */
  public function get_categories(){
    $json = file_get_contents($this->categories_url);
    $this->categories = json_decode($json);
    return $this->categories;
  }




 /**
  *  Get list of cities that have VenueDog
  */
  public function get_cities(){
    $this->cities = array('Rome, GA'=>1);
    return $this->cities;
  }



 /**
  *  Save settings
  */
  private function update(){
    if(function_exists('is_admin') && is_admin()){
      $venuedog = $_POST['venuedog'];
      $selected_categories = !empty($venuedog['categories']) ? $venuedog['categories'] : '';
      $categories_string = is_array($selected_categories) ? implode(',', $selected_categories) : '';

      update_option('venuedog_city', $venuedog['cities']);
      update_option('venuedog_categories', $categories_string);
      update_option('venuedog_days', $venuedog['days']);
    }
  }

  
}
?>
