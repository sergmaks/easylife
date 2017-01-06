 /**
  * Cлайдер с блюдом на день
  */
 
 jQuery(document).ready(function() {
    var nextLink   = jQuery('.next'); // прокрутка вправо
    var prevLink   = jQuery('.prev'); // прокрутка вправо
    var stepImage  = jQuery('.step-image'); // слайд - шаг
    
    
    nextLink.click(function() {
        var stepWidth  = jQuery('.step-image').outerWidth();
        var stepImages = jQuery(this).parent().children('.step-images');
        var step       = stepImages.scrollLeft() + stepWidth;
        
        stepImages.animate( {scrollLeft: step}, 500 );
    });
    
    prevLink.click(function() {
        var stepWidth  = jQuery('.step-image').outerWidth();
        var stepImages = jQuery(this).parent().children('.step-images');
        var step       = stepImages.scrollLeft() - stepWidth;
        
        stepImages.animate( {scrollLeft: step}, 500 );
    });
    
    /* Клик на слайд */
    stepImage.click(function() {
        var thisImage = jQuery(this).children('img:first').attr('src'); // cсылка на картинку выбранного слайда
        var mainImage = jQuery(this).parent().parent().parent().children('.main-image:first').children('a:first'); // cсылка на главное изображения
        
        mainImage.fadeTo(500, 0.05, function() {
            mainImage.attr('href',thisImage);
            mainImage.children('img:first').attr('src',thisImage);  
        });
        
        mainImage.fadeTo('500', 1);
        
    });
    
 });
