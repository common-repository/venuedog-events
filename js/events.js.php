<?php defined('VDOG_URL') or die();?>
<?php $venuedog = new VenueDog(); #var_dump($venuedog);?>


jQuery(document).ready(function($) {


  /* Call VenueDog on Selector */
  $('.venuedog_events').venuedog({
    'categories' : "<?php echo $venuedog->category_string;?>",
    'paginate' : <?php echo $venuedog->days;?>
  });

});
