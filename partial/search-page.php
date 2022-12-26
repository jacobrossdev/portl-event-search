<div id="portl-event-search-bar" class="alignfull">
  <div class="event-search-box portl-event-search-bar-box">
    <span class="dashicons dashicons-location"></span>
    <input id="event-address" class="event-address" type="text" name="event-address" placeholder="City, State, Zip" value="">
  </div>
  <div class="event-date-box portl-event-search-bar-box">
    <span class="dashicons dashicons-calendar-alt"></span>
    <input id="event-date" class="event-date" type="text" name="event-date" placeholder="Event Date" value="<?php echo date('F j, Y')?>">
  </div>
  <div class="event-date-box portl-event-radius-bar-box">
    <span class="dashicons dashicons-sticky"></span>
    <select name="event-radius" id="event-radius">
      <option value="5">5 Miles</option>
      <option value="10">10 Miles</option>
      <option value="25">25 Miles</option>
    </select>    
  </div>
  <input id="begin-search" class="begin-search" type="button" value="Search">
  <div class="lds-dual-ring hidden"></div>
</div>

<div id="portl-event-search-results" class="alignfull" data-page="1">

  <div style="display: none;" class="portl-event-search-no-results">There are no results matching your search criteria.</div>
</div>
