  <div class="wrap">
    <h2><?php esc_html_e( 'Forms' ); ?></h2>
      
    <form method="POST" action="<?=get_admin_url();?>admin.php?page=portl-event-search-options">
      
      <div class="card">
        <table class="form-table">
          <tbody>
            <tr>
              <th>
                <label for="input-text">PORTL Event Search Token</label>
              </th>
              <td>
                <input type="text" name="portl_event_search_token" placeholder="Text" value="<?php
                if( isset($options['portl_event_search_token']) )
                  if( !empty($options['portl_event_search_token']) )
                    echo $options['portl_event_search_token'];
              ?>"/><br />
              </td>
            </tr>
            <tr>
              <th>
                <label for="input-text">PORTL Event Google Token</label>
              </th>
              <td>
                <input type="text" name="portl_event_google_token" placeholder="Text" value="<?php
                if( isset($options['portl_event_google_token']) )
                  if( !empty($options['portl_event_google_token']) )
                    echo $options['portl_event_google_token'];
              ?>"/><br />
              </td>
            </tr>
          </tbody>
        </table>
      </div>
  
      <div class="card">
        <table class="form-table">
          <tbody>
            <tr>
              <th>
                <label for="input-time">Buttons</label>
              </th>
              <td>
                <input type="submit" name="Publish" value="Save Token" class="button" /><br /><br />
              </td>
            </tr>
          </tbody>
        </table>
      </div>
  
    </form>
  
  </div><!-- .wrap -->