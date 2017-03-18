/* 
 * Скрипт для боковой панели с днями недели
 */
var idMenu   = "days-bar"; // id боковой панели
var cActive  = "active"; // активная кнопка

// если сущесвуют хэши в URL, удаляем их
function AnchorHash() {
    var hash = window.location.hash;
    
    if (hash) {
        jQuery("#" + idMenu + ">li>a").removeClass(cActive);
        jQuery("#" + idMenu + ">li>a[href=\"" + hash + "\"]").addClass(cActive);        
    }
    else {
        return false;
    }
}

// скролл на нужный раздел при клике
function Anchor() {
    var anchor = jQuery(this);
    
    jQuery("#" + idMenu + ">li>a[href*=\"#\"]").popover('hide');
    jQuery("html, body").animate({
        scrollTop: jQuery(anchor.attr("href")).offset().top
    }, 1000, function(){
       //anchor.popover('show'); 
    });
    

}

// выделение пункта при скролле страницы 
function ScrollAnchor(day) {
    var anchor = jQuery("#" + idMenu + ">li>a[href=\"#" + day + "\"]");
    
    function showActive() {
        var offsetTop  = jQuery("#" + day).offset().top;
        var halfHeight = jQuery("#" + day).height()/2;
      
        if ( jQuery(window).scrollTop() >= offsetTop - halfHeight && jQuery(window).scrollTop() < offsetTop + halfHeight + 55 ) {
            jQuery("#" + idMenu + ">li>a").removeClass(cActive);
            anchor.addClass(cActive);
            anchor.popover('show');            
        } else {
            anchor.popover('hide');
            //jQuery("#" + idMenu + ">li>a").removeClass(cActive);
        }
        
    }
    jQuery(window).scroll(showActive);
    jQuery(window).resize(showActive);
         
}

jQuery(function () {
   jQuery('[data-toggle="popover"]').popover();  
   AnchorHash();
});
