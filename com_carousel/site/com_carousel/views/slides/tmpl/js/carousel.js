jQuery(document).ready(
        function(){
            jQuery('.back').css({
                height: (jQuery(document).height() - 
                jQuery('#top-bar').outerHeight() - 
                jQuery('#nav-bar').outerHeight()) + "px"
            });
      });

// Window events: 
// Set slides height when the window is resized

  jQuery(window).resize(
          function(){
              if ( jQuery(window).height() > 600 ) {
                  jQuery('.back').css({
                     height: ( jQuery(window).height() - 
                     jQuery('#top-bar').outerHeight() - 
                     jQuery('#nav-bar').outerHeight()) + "px"
                  });
             }
        }); 
  