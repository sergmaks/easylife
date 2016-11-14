/**
 * JS for Slider EASY LIFE component
 */

// Select right size of background images in slider
function chooseSize() {
    var newFolder; // folder for choosing images
         
    if ( jQuery(window).width() < 767 )
        newFolder ='x_small';
    else if ( jQuery(window).width() < 990 )
        newFolder ='small';
    else if ( jQuery(window).width() < 1200 )
        newFolder ='middle';
    else if ( jQuery(window).width() < 1600 )
        newFolder ='large';
    else if ( jQuery(window).width() < 2000 )
        newFolder ='x_large';
    else newFolder ='xx_large';
    
    // override css background-image
    jQuery('.back').css(
                    'background-image', function(i, value) {
                        oldDir = value.substring( 0, value.lastIndexOf('/'));
                        oldFolder = oldDir.substring( oldDir.lastIndexOf('/') + 1, oldDir.length); //xx_large

                        return value.replace(oldFolder, newFolder); // replace folder in file path
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
  
