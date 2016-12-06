<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_carousel
 *
 * Шаблон клиентского вида слайдера 
*/

defined('_JEXEC') or die;

jimport('joomla.filesystem.file'); // Use JFile

// Получаем глобальные парметры компонента
$globalParams = JFactory::getApplication()->getParams('com_carousel');

// Определяем атрибуты слайдера в зависимости от значений параметров
$dataRide  = ( $globalParams->get('autoScroll','1') )  ? 'data-ride="carousel"' : '';
$dataPause = ( $globalParams->get('sliderPause','0') ) ? 'hover' : 'none';
$filter    = ( $globalParams->get('useFilter','1') )   ? 'class="filter"' : '';

// СSS клиентской части
JFactory::getDocument()->addStyleSheet("//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
                                        ,$type="text/css"
                                        ,$media=null
                                        ,$attribs=array("integrity"=>"sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
                                            ,"crossorigin"=>"anonymous") ); // bootstrap css CDN
JFactory::getDocument()->addStyleSheet($this->baseurl .'/components/com_carousel/views/slides/tmpl/css/default.css'); // component css
JFactory::getDocument()->addStyleSheet($this->baseurl .'/components/com_carousel/views/slides/tmpl/css/media.css'); // media-querues

// Заносим параметры в CSS
$inlineStyle = 
'.filter {
    background-color: ' . $globalParams->get('filterColor','#00c800') . ';
    opacity: ' . ( $globalParams->get('filterOpacity','25') / 100 ) . ';
    filter: alpha(opacity=' . $globalParams->get('filterOpacity','25') . ');
}
.slide-caption {
    color:' . $globalParams->get('fontColor','#3e2423') . ';
    
}
.carousel-indicators .active {
    background-color: ' . $globalParams->get('buttonColor','#61b73c') . ';
}';

JFactory::getDocument()->addStyleDeclaration( $inlineStyle );

// JS
JFactory::getDocument()->addScript($this->baseurl .'/media/jui/js/jquery.min.js');
JFactory::getDocument()->addScript($this->baseurl .'/media/jui/js/jquery-noconflict.js');
JFactory::getDocument()->addScript("//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"); // bootstrap 3 js CDN
JFactory::getDocument()->addScript($this->baseurl .'/components/com_carousel/views/slides/tmpl/js/carousel.js');

// Далее выводим html-код компонента
?>
<!-- Carousel -->
<div id="carousel" class="carousel slide" data-interval="<?php echo $globalParams->get('sliderTimer','6') * 1000; ?>" <?php echo $dataRide ?> data-pause="<?php echo $dataPause ?>">
        <!-- Indicators  -->
        <ol class="carousel-indicators">
            <?php
                // Выводим кнопки переключения слайдов
                for ($i = 0 ; $i < count($this->items); $i++) { // по кол-ву слайдов
                    $classActive = ( $i==0 ) ? 'class="active"' : ''; // первая кнопка - активная
                    
                    echo '<li data-target="#carousel" data-slide-to="' . $i . '" ' . $classActive . '></li>';
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
                <div class="back" style="background-image: url('<?php echo  $this->baseurl 
                                                                            . '/administrator/components/com_carousel/images/xx_large/'
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