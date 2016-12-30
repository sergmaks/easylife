  var slideWrap = jQuery('.slides-container');
  /* кнопки вперед/назад и старт/пауза */
  var nextLink = jQuery('.next');
  var prevLink = jQuery('.prev');

  /* ширина слайда с отступами */
  var slideWidth = jQuery('.step-images').outerWidth();
  /* смещение слайдера */
  var scrollSlider = slideWrap.position().left - slideWidth;

    /* Клик по ссылке на следующий слайд */
  nextLink.click(function(){
  
    slideWrap.animate({left: scrollSlider}, 500, function(){
     slideWrap
      .find('.step-image:first')
      .appendTo(slideWrap)
      .parent()
      .css({'left': 0});
    });
  });

