<?php

if( !empty($events) ):
foreach( $events as $event ) :?>

<div class="event-card" data-category="<?php echo implode(', ', $event->event->categories); ?>">
  <a target="_blank" href="<?php echo $event->event->ticketPurchaseUrl; ?>">

    <div class="card-image" style="background-image: url(<?php echo $event->event->artist->imageUrl; ?>)">
                    
    </div>

    <div class="card-footer">
      <div class="footer-inner">
        <div class="event-title"><?php echo $event->event->title; ?> </div>
        <div class="event-date">

          <div class="date"><?php $time = strtotime($event->event->localStartDate); echo date('F d, Y', $time)?></div>
          
          <div class="miles">
            <?php
            $miles = intval(ceil($event->distance));
            echo $miles < 1 ? '< 1 mile' : $miles . ' miles';
            ?>            
          </div>

        </div>
        <div class="svg-icon"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="ellipsis-v" class="svg-inline--fa fa-ellipsis-v fa-w-6 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512"><path fill="currentColor" d="M96 184c39.8 0 72 32.2 72 72s-32.2 72-72 72-72-32.2-72-72 32.2-72 72-72zM24 80c0 39.8 32.2 72 72 72s72-32.2 72-72S135.8 8 96 8 24 40.2 24 80zm0 352c0 39.8 32.2 72 72 72s72-32.2 72-72-32.2-72-72-72-72 32.2-72 72z"></path></svg>

        <div class="tooltip-panel" style="display: none;">
          <ul>
            <li><a>Save to My Events</a></li>
            <li><a target="_blank" rel="noopener noreferrer">Google Calendar</a></li>
            <li><a href="#add-to-calendar">iCalendar</a></li>
          </ul>
        </div>

      </div>

      </div>  
    </div>
        
  </a>
</div>

<?php 
endforeach; 

endif;