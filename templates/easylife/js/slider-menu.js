 /**
  * Cлайдер с блюдом на день
  */
 
 jQuery(function() {
    var nextLink   = jQuery('.next'); // прокрутка вправо
    var prevLink   = jQuery('.prev'); // прокрутка вправо
    var stepImage  = jQuery('.step-image'); // слайд - шаг
    
    var disabled_flag = false; // запрет клика во время прокрутки
    
    // прокрутка слайдов при клике
    function scroll() {
       
        var thisType    = jQuery(this).attr('class').replace('slider-nav ',''); // тип кнопки: назад или вперед
        // cсылки на кнопки прокрутки
        var nextButt    = jQuery(this).parent().children('.next');
        var prevButt    = jQuery(this).parent().children('.prev');
        
        var stepWidth   = stepImage.outerWidth();
        var stepsImages = jQuery(this).parent().children('.slides-container').children('.steps-images');
        var sсrollVal;
        
        if ( disabled_flag ) { return false; }
        
        disabled_flag = true;
        
        if (thisType === "next") {
            scrollVal = stepsImages.scrollLeft() + stepWidth;           
        } else {
            scrollVal = stepsImages.scrollLeft() - stepWidth; 
        }
        
        stepsImages.animate( {scrollLeft: scrollVal}, 500, function() {
                        
            if ( stepsImages.scrollLeft() === 0 ) {
               prevButt.css("visibility" , "hidden");
            }
            
            else {
                prevButt.css("visibility" , "visible");
                nextButt.css("visibility" , "visible");
            }
            
            if ( stepsImages.scrollLeft() >= stepsImages.innerWidth()/2 - 3) {
                nextButt.css("visibility" , "hidden");
            }
            
            disabled_flag = false;           
        });
        
    }
    
    // Next
    nextLink.on("click", scroll);
    
    // Previous
    prevLink.on("click", scroll);
    
    // Клик на слайд и смена главного изображения
    stepImage.click(function() {
        var thisImage = jQuery(this).children('img:first').attr('src'); // cсылка на картинку выбранного слайда
        var thisImageDesc = jQuery(this).children('img:first').attr('alt');
        var mainImage = jQuery(this).parent().parent().parent().parent().children('tr:first').children('.main-image:first').children('img:first'); // cсылка на главное изображения
        var mainImageDesc = jQuery(this).parent().parent().parent().parent().children('tr:first').children('.image-desc');
        
        jQuery(this).parent().children('.step-image').children('.selected').remove();
        jQuery(this).append('<div class="selected"></div>');
        
        mainImage.fadeTo(500, 0.05, function() {
            mainImage.attr('src',thisImage);
            mainImageDesc.html(thisImageDesc);
        });
        
        mainImage.fadeTo('500', 1);
    });
    
 });
