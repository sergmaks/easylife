/****   Custom jQuery  *****/
var footerShowed = false;

var showMobileDropdown = function() {
    jQuery(this).children('ul').slideToggle('normal');     
}

// Checking sreen width and adding some parameters
function checkMobile() {          
    if ( jQuery(document).width() > 767 ) {  // if desktop or tablet            
        jQuery('#nav-bar').outerHeight(50);
        jQuery('#nav-bar').show();
        jQuery('#nav-bar li > ul').show();
        jQuery('[data-toggle="tooltip"]').tooltip('enable');
        jQuery('#nav-bar li').unbind('click', showMobileDropdown);
    } else {  // if mobile
        jQuery('#nav-bar').css({height:"auto"});    
        jQuery('#nav-bar').hide();  // hide menu block
        jQuery('#nav-bar li > ul').hide();  // hide dropdown menu
        jQuery('[data-toggle="tooltip"]').tooltip('disable');  // disable bootstrap tooltips
        jQuery('#nav-bar li').unbind('click', showMobileDropdown);
        jQuery('#nav-bar li').bind('click', showMobileDropdown);
    }
}
    
// Show info footer by scrolling down to the end of the page
function showFooter() {
    jQuery('#footer').slideDown();
    jQuery('html, body').animate( {scrollTop: jQuery(window).height()}, 2000 );
    jQuery('#button-up').show();
    footerShowed = true;
}
  
function hideFooter() {
    jQuery('#footer').slideUp(1000);
    jQuery('#button-down').show();
    footerShowed = false;
}
  
jQuery(document).ready(
    function() {
        jQuery('.main-nav').attr({"data-toggle":"tooltip", "data-placement":"bottom"});  // Enable Bootstrap tooltips            
        jQuery('#menu-trigger').click(function(){
            jQuery('#nav-bar li > ul').hide();  // hide dropdown menu
            jQuery('#nav-bar').slideToggle('normal');
            
        });
        
    checkMobile();        
});
   
// Checking mobile display when window is resized
jQuery(window).resize(function() {
    checkMobile();
}); 
   
// Hide footer when the window is scrolled to the top
jQuery(window).scroll(function() {
    if ( (jQuery(window).scrollTop() == 0) 
      && (footerShowed == true) ) {  
            hideFooter();
    }
});
  
// Buttons Down and Up events:
jQuery('#button-down').click(function () {
    jQuery(this).hide();
    showFooter();
});
  
jQuery('#button-up').click(function() {
    jQuery(this).hide(); 
    hideFooter();
});

