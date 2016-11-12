<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_carousel
 *
 * Сабконтроллер для работы с общим списком слайдов компонента Слайдер Easy Life
 *
 * Данный класс наследуется от класса JControllerAdmin (содержит методы публикации удаления элементов из списка),
 * который в свою очередь наследуется от JControllerLegacy
 *
 * в имени класса:
 * - Carousel - имя компонента
 * - Controller - указание на класс контроллера
 * - Slides - имя котроллера
 */

defined('_JEXEC') or die;

class CarouselControllerSlides extends JControllerAdmin {
    
    /**
     * 
     * @param string $name - имя модели
     * @param string $prefix - префикс имени модели  
     * @param array $config - массив конфигураций
     * @return object - объект модели CarouselModelItem (модель работы с элементом списка)
     */
    public function getModel($name = 'Item', $prefix = 'CarouselModel', $config = array('ignore_request' => true)) {
        
        return parent::getModel($name, $prefix, $config);
    }
}
