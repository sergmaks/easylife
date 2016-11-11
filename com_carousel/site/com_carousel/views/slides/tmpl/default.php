<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_carousel
 *
 * Шаблон клиентского вида слайдера 
*/

defined('_JEXEC') or die;

jimport('joomla.filesystem.file'); // Use JFile

// Получаем глобальные парметры 
$globalParams = JFactory::getApplication()->getParams('com_carousel');

$buttonColor     =  $globalParams->get('buttonColor');
$autoScroll      =  $globalParams->get('autoScroll');
$sliderTimer     =  $globalParams->get('sliderTimer');
$useFilter       =  $globalParams->get('useFilter');
$sliderPause     =  $globalParams->get('sliderPause');
$fontColor       =  $globalParams->get('fontColor');
$googleFontName  =  $globalParams->get('googleFontName', 'Open+Sans');
$filterColor     =  $globalParams->get('filterColor');
$filterOpacity   =  $globalParams->get('filterOpacity');

// Определяем атрибуты слайдера в зависимости от значений параметров
$dataRide  = ($autoScroll == 1)  ? 'data-ride="carousel"' : '';
$dataPause = ($sliderPause == 1) ? 'hover' : 'none';
$filter    = ($useFilter == 1)   ? 'class="filter"' : '';

// СSS клиентской части
JFactory::getDocument()->addStyleSheet(JURI::root() .'components/com_carousel/views/slides/tmpl/css/default.css');
// Google Font
JFactory::getDocument()->addStyleSheet('//fonts.googleapis.com/css?family=' . $googleFontName);

// Заносим парметры в CSS
$inlineStyle = 
'.filter {
    background-color: ' . $filterColor . ';
    opacity: ' . ($filterOpacity / 100) . ';
    filter: alpha(opacity=' . $filterOpacity . ');
}
.slide-caption {
    color:' . $fontColor . ';
}
.carousel-indicators .active {
    background-color: ' . $buttonColor . ';
}
';

JFactory::getDocument()->addStyleDeclaration( $inlineStyle );

// JS
JFactory::getDocument()->addScript(JURI::root() .'media/jui/js/jquery.min.js');
JFactory::getDocument()->addScript(JURI::root() .'media/jui/js/jquery-noconflict.js');
JFactory::getDocument()->addScript(JURI::root() .'components/com_carousel/views/slides/tmpl/js/carousel.js');

?>
<!-- Выводим html-код компонента -->
<!-- Carousel -->
<div id="carousel" class="carousel slide" data-interval="<?php echo $sliderTimer * 1000; ?>" <?php echo $dataRide ?> data-pause="<?php echo $dataPause ?>">
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
        
            <?php $classItem = ($item_num == 0) ? 'active item' : 'item'; // если слайд первый, то он активный ?>
            <div class="<?php echo $classItem; ?>">
                <div class="back" style="background-image: url('<?php echo JURI::root() 
                                                                            .'administrator/components/com_carousel/images/xx_large/'
                                                                            . JFile::getName($item->image);  ?>')">
                    
                    <div <?php echo $filter ?>></div>
                        
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