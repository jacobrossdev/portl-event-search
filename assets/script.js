jQuery(document).ready(function($){

  $('#event-date').datetimepicker({
    showTimepicker: false
  });
  
  $('#portl-event-search-results').on('click', '.tooltip-panel', function(e){
    e.preventDefault();
    return;
  });

  $('#portl-event-search-results').on('click', '.svg-icon', function(e){
    $(this).find('.tooltip-panel').toggle();
    e.preventDefault();
    return;
  });

  $(document).on('click', '.category-filter', function(){
    

    if( $(this).hasClass('active') ){
      $(this).removeClass('active');
      $('.event-card').show();
      return;
    }

    $(this).siblings().each(function(i, t){
      $(t).removeClass('active');
      $('.event-card').show();
    })

    if(!$(this).hasClass('active')){
      $(this).addClass('active');
      var category = $(this).data('category');
      $('.event-card').hide();
      $('.event-card[data-category*="'+category+'"]').show();
    }
  });

  $(document).find('#begin-search').on('click', function(){
    $.ajax({
      url : portl.ajax_url,
      type : "POST",
      dataType: 'html',
      beforeSend: function(){
        $('.lds-dual-ring').removeClass('hidden');
        $('.portl-event-search-no-results').hide();
      },
      data: {
        action : 'portl_retrieve_events',
        starting: $('input#event-date').val(),
        address: $('input#event-address').val(),
        distance: $('select#event-radius').val(),
        page : 1
      },
      success: function(html){
        if( html == 'false' ){
          $('.portl-event-search-no-results').show();
        } else {
          $('#portl-event-search-results').html(html);
        }
      },
      complete: function(){
        $('.lds-dual-ring').addClass('hidden');
      }
    });
  });
/*
  $(window).scroll(function() {
     if($(window).scrollTop() + $(window).height() == $(document).height()) {

        $.ajax({
          url : portl.ajax_url,
          type : "POST",
          dataType: 'html',
          beforeSend: function(){
            $('.lds-dual-ring').removeClass('hidden');
            $('.portl-event-search-no-results').hide();
          },
          data: {
            action : 'portl_retrieve_events',
            starting: $('input#event-date').val(),
            address: $('input#event-address').val(),
            distance: $('select#event-radius').val(),
            page : 1
          },
          success: function(html){
            if( html == 'false' ){
              $('.portl-event-search-no-results').show();
            } else {
              $('#portl-event-search-results #events-row').append(html);
              1;
            }
          },
          complete: function(){
            $('.lds-dual-ring').addClass('hidden');
          }
        });
     }
  });
*/
  function initialize() {

    console.log('initializing');

    var options = {
      types: ['(cities)'],
      componentRestrictions: {country: "us"}
    };

    var input = document.getElementById('event-address');
    var autocomplete = new google.maps.places.Autocomplete(input, options);
  }

});