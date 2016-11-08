
// Set the carousel height when the document is loaded
jQuery(document).ready(
        function(){
                var prevHeight = 0;
                var elements = document.getElementsByTagName('body')[0].getElementsByTagName('div');
                for (var i=0; i < elements.length; i++) {
                    if (elements[i].id == 'carousel') break;
                    prevHeight += elements[i].height;
                }
                alert (prevHeight);
                jQuery('.back').css({
                height: (jQuery(document).height() - 
                jQuery('#top-bar').outerHeight() - 
                jQuery('#nav-bar').outerHeight()) + "px"
            });
      });

// Set the carousel height when the window is resized

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
  