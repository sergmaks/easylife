/****   Custom jQuery  *****/
var footerShowed = false;  
    
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
        jQuery('.main-nav').attr({"data-toggle":"tooltip", "data-placement":"bottom"});
        jQuery('[data-toggle="tooltip"]').tooltip();
        
        jQuery('#menu-trigger').click(function(){
            jQuery('#nav-bar').slideToggle(500);
        });
      });
   
   // Mobile navigation bar display
   jQuery(window).resize(
        function(){
            if ( jQuery(window).width() > 768 ) {
                jQuery('#nav-bar').css({display: 'block'});
            }
            else 
                jQuery('#nav-bar').css({display: 'none'});
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

