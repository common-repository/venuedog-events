<?php
defined('VDOG_URL') or die('Restricted access');
if (!current_user_can('publish_posts')) die( __('You do not have sufficient permissions to access this page.') );

$venuedog = new VenueDog();
?>

<div class="venuedog_admin wrap">
  <div id="icon-plugins" class="icon32"></div>

  <h2>VenueDog - Global Options</h2>
  <br clear="all" /><hr />


  <!-- Admin Form -->
  <form action="" method="POST">
    <table class="form-table">


      <!-- City -->
      <tr valign="top">
        <th scope="row"><label for="venuedog_city">City:</label></th>
        <td>
          <select name="venuedog[cites]">
            <?php foreach($venuedog->get_cities() as $city=>$id): ?>
              <option value="<?php echo $id;?>"><?php echo $city;?></option>
            <?php endforeach;?>
          </select>
          <span class="description">Choose the city to pull events from.</span>
        </td>
      </tr>



      <!-- Event Categories -->
      <tr valign="top">
        <th scope="row"><label for="venuedog[categories][]">Categories:</label></th>
        <td>
          <select name="venuedog[categories][]" multiple="yes" style="width:400px;height:100px;">
            <?php foreach($venuedog->get_categories() as $cat): ?>
              <option value="<?php echo $cat->id;?>" <?php if(in_array($cat->id, $venuedog->category_set)) echo "selected";?>>
                <?php echo $cat->name;?>
              </option>
            <?php endforeach;?>
          </select>
          <br /><span class="description">Choose the categories to pull events from. Use Ctrl key for multi-select.</span>
        </td>
      </tr>



      <!-- Number of Days -->
      <tr valign="top">
        <th scope="row"><label for="venuedog[days]">Number of days:</label></th>
        <td>
          <select name="venuedog[days]">
            <?php foreach($venuedog->get_days as $day): ?>
              <option value="<?php echo $day;?>" <?php if($venuedog->days == $day) echo "selected";?>>
                <?php echo $day;?>
              </option>
            <?php endforeach;?>
          </select>
          <span class="description">Number of days in the future to show events for at a time.</span>
        </td>
      </tr>


    </table>

    <p class="submit"><input type="submit" name="venuedog[submit]" id="submit" class="button-primary" value="Save Changes"></p>
  </form>



</div><!-- End Page Wrap -->
