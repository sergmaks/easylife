/* 
 * Скрипт для боковой панели с днями недели
 */
var idMenu   = "days-bar"; // id боковой панели
var cActive  = "active"; // активная кнопка

// если сущесвуют хэши в URL, удаляем их
function AnchorHash() {
    var hash = window.location.hash;
    
    if (hash) {
        jQuery("#" + idMenu + ">a").removeClass(cActive);
        jQuery("#" + idMenu + ">a[name=\"" + hash + "\"]").addClass(cActive);        
    }
    else {
        return false;
    }
}

// скролл на нужный раздел при клике
function Anchor() {
    var anchor = jQuery(this);
    //jQuery("#" + idMenu + ">a").removeClass(cActive);
    jQuery("html, body").animate({
        scrollTop: jQuery(anchor.attr("name")).offset().top
    }, 1000, function(){
        jQuery("#" + idMenu + ">a").removeClass(cActive);
        anchor.addClass(cActive);
    });
    

}

// выделение пункта при скролле страницы 
function ScrollAnchor(day) {
    var anchor = jQuery("#" + idMenu + ">a[name=\"#" + day + "\"]");
    
    function showActive() {
        var offsetTop  = jQuery("#" + day).offset().top;
        var halfHeight = jQuery("#" + day).height()/2;
      
        if ( jQuery(window).scrollTop() >= offsetTop - halfHeight && jQuery(window).scrollTop() < offsetTop + halfHeight - 55) {
            jQuery("#" + idMenu + ">a").removeClass(cActive);
            anchor.addClass(cActive);            
        } else {
//            jQuery("#" + idMenu + ">a").removeClass(cActive);
        }
        
    }
    jQuery(window).scroll(showActive);
    jQuery(window).resize(showActive);
         
}