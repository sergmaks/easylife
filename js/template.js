/****   Custom jQuery  *****/
var footerShowed = false;
  
// Select right size of background images in slider
function chooseSize(){
    var folder; // folder for choosing images
    var slidesCount = jQuery('.back').size(); // number of slides slides
      
    if ( jQuery(window).width() < 1200 )
  folder = 'middle';
    else if ( jQuery(window).width() < 1600 )
  folder = 'large';
    else if ( jQuery(window).width() < 2000 )
  folder = 'x-large';
    else folder = 'xx-large';
 //alert(folder);
  }
  
  // Set the slides height to the user screen height without header
  function setCarouselHeight(){
      jQuery('.back').css({
    height: (jQuery(document).height() - 
       jQuery('#top-bar').outerHeight() - 
       jQuery('#nav-bar').outerHeight()) + "px"
         })
  }
  
  // Show info footer by scrolling down to the end of the page
  function showFooter(){
      jQuery('#footer').slideDown();
      jQuery('html, body').animate( { scrollTop: jQuery(window).height() }, 2000 );
      jQuery('#button-up').show();
      footerShowed = true;
  }
  
  function hideFooter(){
      jQuery('#footer').slideUp(1000);
      jQuery('#button-down').show();
      footerShowed = false;
  }
  
  // Enable Bootstrap tooltips and Set initial slides height
  jQuery(document).ready(
      function(){
    //jQuery("#attention").remove(); // Delete JS warning
    jQuery('.main-nav').attr({"data-toggle":"tooltip", "data-placement":"bottom"});
    jQuery('[data-toggle="tooltip"]').tooltip();
    setCarouselHeight();
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
          })
        }
        });
  
  // Hide footer when the window is scrolled to the top
  jQuery(window).scroll(function(){
      if ( (jQuery(window).scrollTop() == 0) 
    && (footerShowed == true) )  
        hideFooter();
   });
  
  // Buttons Down and Up events:
  jQuery('#button-down').click(function (){
      jQuery(this).hide();
      showFooter();
  });
  
   jQuery('#button-up').click(function(){
       jQuery(this).hide();
       hideFooter();
   });
