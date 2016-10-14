<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_carousel
 *
 * Сабконтроллер для работы со списком слайдов компонента Карусель
 *
 * Данный класс наследуется от класса JControllerAdmin (содержит методы публикации и удаления элементов из списка),
 * который в свою очередь наследуется от JControllerLegacy
 *
 * в имени класса:
 * - Carousel - имя компонента
 * - Controller - указание на класс контроллера
 * - Slides - имя котроллера
 */

defined('_JEXEC') or die;

class CarouselControllerSlides extends JControllerAdmin {
    
    public function getModel($name = 'Item', $prefix = 'CarouselModel', $config = array()) {
        
        return parent::getModel($name, $prefix, $config);
    }
}