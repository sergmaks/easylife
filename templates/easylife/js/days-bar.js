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
    
    console.log(jQuery("#tuesday").offset().top);
    console.log(jQuery(window).scrollTop());
    
    
}

// выделение пункта при скролле страницы 
function ScrollAnchor(day) {
    function showActive() {
        var anchor     = jQuery("a[href=\"#" + day + "\"]");
        var offsetTop  = jQuery("#" + day).offset().top;
        var halfHeight = jQuery("#" + day).height()/2;
        
        if ( jQuery(window).scrollTop() >= offsetTop) {
            jQuery("#" + idMenu + ">li>a").removeClass(cActive);
            anchor.addClass(cActive);
            alert("true");
            //jQuery("#" + idMenu + ">li>a[href*=\"#\"]").tooltip('hide');
            //anchor.tooltip('show'); 
        }
        else {
            alert("false");
        }
        
        jQuery(window).scroll(showActive);
        jQuery(window).resize(showActive);
        
    }
}

jQuery(function () {
   AnchorHash();
   jQuery("#" + idMenu + ">li>a[href*=\"#\"]").on("click", Anchor);
   ScrollAnchor("monday");
   ScrollAnchor("tuesday");
});
