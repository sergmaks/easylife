/****   Custom jQuery  *****/
var footerShowed = false;

var showMobileDropdown = function(){
    jQuery(this).children('ul').slideToggle('normal',function(){
        setMobileMenuHeight();
    });            
};
    
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
  
  function setMobileMenuHeight(){
      jQuery('#nav-bar').outerHeight(
                    jQuery('#menu-container').outerHeight()
                 +  jQuery('#socials-container').outerHeight()
                 +  15 );
  }
  
  function checkMobile(){      
        
       if ( jQuery(document).width() > 767 ) { // if desktop or tablet
            
            jQuery('#nav-bar').outerHeight(50);
            jQuery('#nav-bar').show();
            jQuery('#nav-bar li > ul').show();
            jQuery('[data-toggle="tooltip"]').tooltip('enable');
            jQuery('#nav-bar li').unbind('click', showMobileDropdown);
        }
        
       else { // if mobile
            
            jQuery('#nav-bar').hide();// hide menu block
            jQuery('#nav-bar li > ul').hide();// hide dropdown menu
            jQuery('[data-toggle="tooltip"]').tooltip('disable'); // disable bootstrap tooltips
            jQuery('#nav-bar li').unbind('click', showMobileDropdown);
            jQuery('#nav-bar li').bind('click', showMobileDropdown);
        }
  }
  
  // Enable Bootstrap tooltips and Set initial slides height
  jQuery(document).ready(
      function(){
        jQuery('.main-nav').attr({"data-toggle":"tooltip", "data-placement":"bottom"});
        
        setMobileMenuHeight();
        
        jQuery('#menu-trigger').click(function(){
            jQuery('#nav-bar').slideToggle('normal');
        });
        
        checkMobile();
        
      });
   
   // Checking mobile display when window is resized
   jQuery(window).resize(function(){
       checkMobile();
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

