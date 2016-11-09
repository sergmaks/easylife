
// Set the slider height to the user screen height without header
jQuery(document).ready(
        function(){
                
                var headerHeight = document.body.getElementsByTagName('header')[0].offsetHeight;
                
                jQuery('.back').css({
                    height: ( jQuery(document).height() - headerHeight ) + "px"
                });
        });

// Set the carousel height when the window is resized

  jQuery(window).resize(
          function(){
              
              var headerHeight = document.body.getElementsByTagName('header')[0].offsetHeight;
              
              if ( jQuery(window).height() > 600 ) {
                  jQuery('.back').css({
                     height: ( jQuery(window).height() - headerHeight ) + "px" 
                  });
             }
            }); 
  