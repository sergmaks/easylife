<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_carousel
 *
 * Шаблон клиентского вида слайдера 
*/

defined('_JEXEC') or die;

// СSS клиентской части
JFactory::getDocument()->addStyleSheet(JURI::root() .'components/com_carousel/views/slides/tmpl/css/default.css');

// JS
JFactory::getDocument()->addScript(JURI::root() .'media/jui/js/jquery.min.js');
JFactory::getDocument()->addScript(JURI::root() .'media/jui/js/jquery-noconflict.js');
JFactory::getDocument()->addScript(JURI::root() .'components/com_carousel/views/slides/tmpl/js/carousel.js');

/*
$scriptSize = 
        ' // Select right size of background images in slider
        function chooseSize(){
            var folder; // folder for choosing images
            var slidesCount = jQuery(\'.back\').size(); // number of slides slides
         
            if ( jQuery(window).width() < ' . X_SMALL_WIDTH . ' )
                folder =' . X_SMALL_DIR . ';
            else if ( jQuery(window).width() < ' . SMALL_WIDTH . ' )
                folder =' . SMALL_DIR . ';
            else if ( jQuery(window).width() < ' . MIDDLE_WIDTH . ' )
                folder =' . MIDDLE_DIR . ';
            else if ( jQuery(window).width() < ' . LARGE_WIDTH . ' )
                folder =' . LARGE_DIR . ';
            else if ( jQuery(window).width() < ' . X_LARGE_WIDTH . ' )
                folder =' . X_LARGE_DIR . ';
            else folder =' . XX_LARGE_DIR . ';
            
            alert (folder);
        } 
        document.onload = chooseSize();
        ' ;
JFactory::getDocument()->addScriptDeclaration($scriptSize);
*/

$screenWidth = intval('<script>var ScreenWidth = screen.width; document.write(ScreenWidth);</script>'); //ширина экрана
$folder = XX_LARGE_DIR;

if ( $screenWidth < X_SMALL_WIDTH )
{
    $folder = X_SMALL_DIR;
}
else if ( $screenWidth < SMALL_WIDTH )
{
    $folder = SMALL_DIR;
}
else if ( $screenWidth < MIDDLE_WIDTH )
    $folder = MIDDLE_DIR;
else if ( $screenWidth < LARGE_WIDTH )
    $folder = LARGE_DIR;
else if ( $screenWidth < X_LARGE_WIDTH )
    $folder = X_LARGE_DIR;
else $folder = XX_LARGE_DIR;

echo $screenWidth;
?>
<!-- Выводим html-код компонента -->
<!-- Carousel -->
<div id="carousel" class="carousel slide" data-interval="6000" data-ride="carousel" data-pause="none">
        <!-- Indicators  -->
        <ol class="carousel-indicators">
            <?php
                // Выводим кнопки переключения слайдов
                for ($i = 0 ; $i < count($this->items); $i++) { // по кол-ву слайдов
                    $class = ( $i==0 ) ? 'class="active"' : '';
                    
                    echo '<li data-target="#carousel" data-slide-to="' . $i . '" ' . $class . '></li>';
                }
            ?>
        </ol>

<!-- Slides -->
    <div class="carousel-inner">
<!-- Если полученный из модели список слайдов не пуст -->
    <?php if ( ! empty ($this->items) && is_array($this->items) ) : ?>
    
<!-- Для каждого слайда из списка -->
        <?php foreach ($this->items as $item_num => $item) : ?>
        
            <?php $class = ($item_num == 0) ? 'active item' : 'item'; ?>
            <div class="<?php echo $class; ?>">
                <div class="back" style="background-image: url('<?php echo JURI::root() . $item->image  ?>')">
                    <div class="overlay">
                        <div class="slide-caption">                        
                            <?php if ( ! empty($item->icon) ) : ?>
                                <span class="fa-stack icon" >
                                    <i class="fa fa-circle-o fa-stack-2x"></i>
                                    <i class="fa <?php echo $item->icon; ?> fa-stack-1x"></i>
                                </span>
                            <?php endif; ?>
                            <?php echo $item->caption; ?>                        
                        </div>
                    </div>
                </div>
            </div>   
        <?php endforeach; ?>
        <?php endif; ?>
    </div>
<!-- Carousel Navigation -->
    <a href="#carousel" class="carousel-control left" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
    </a>
    <a href="#carousel" class="carousel-control right" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
    </a>
</div>                