/* 
 * 
 */
var idMenu   = "days-bar";
var cActive  = "active";

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
    
    jQuery("#" + idMenu + ">li>a").removeClass(cActive);
    anchor.addClass(cActive);
    jQuery("#" + idMenu + ">li>a[href*=\"#\"]").tooltip('hide');
    jQuery("html, body").animate({
        scrollTop: jQuery(anchor.attr("href")).offset().top
    }, 1000, function(){
       
       anchor.tooltip('show'); 
    });
    

}

// выделение пункта при скролле страницы 
function ScrollAnchor(day) {
    var anchor = jQuery("a[href=\"#" + day + "\"]");
    
    function showActive() {
        var offsetTop  = jQuery("#" + day).offset().top;
        var halfHeight = jQuery("#" + day).height()/2;
        
        if ( jQuery(window).scrollTop() >= offsetTop - 400) {
            jQuery("#" + idMenu + ">li>a").removeClass(cActive);
            anchor.addClass(cActive);
        }
        
    }
    jQuery(window).scroll(showActive);
    jQuery(window).resize(showActive);
//    jQuery("#" + idMenu + ">li>a[href*=\"#\"]").tooltip('hide');
//    anchor.tooltip('show'); 
}

jQuery(function () {
   AnchorHash();
   jQuery("#" + idMenu + ">li>a[href*=\"#\"]").on("click", Anchor);
   ScrollAnchor("monday");
   ScrollAnchor("tuesday");
});
