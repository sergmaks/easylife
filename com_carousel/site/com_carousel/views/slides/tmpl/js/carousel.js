
// Select right size of background images in slider
function chooseSize() {
    var folder; // folder for choosing images
    var slidesCount = jQuery('.back').size(); // number of slides slides
         
    if ( jQuery(window).width() < 767 )
        folder ='x_small';
    else if ( jQuery(window).width() < 990 )
        folder ='small';
    else if ( jQuery(window).width() < 1200 )
        folder ='middle';
    else if ( jQuery(window).width() < 1600 )
        folder ='large';
    else if ( jQuery(window).width() < '2000' )
        folder ='x_large';
    else folder ='xx_large';
    
    // override css background-image
    jQuery('.back').css(
                    'background-image', function(i, value) {
                        return value.replace(/xx-large/i, folder);
                    });
}

// Set the slider height to the user screen height without header
jQuery(document).ready(
        function(){
                
                var headerHeight = document.body.getElementsByTagName('header')[0].offsetHeight;
                
                jQuery('.back').css({
                    height: ( jQuery(document).height() - headerHeight ) + "px"
                });
                chooseSize();
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
  