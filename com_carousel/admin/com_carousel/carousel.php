<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_carousel
 *
 * Точка входа в компонент Карусель
 */

defined('_JEXEC') or die;

//------ Блок констант компонента ------

// Определение общей дирректории хранения изображений компонента
// administrator/components/com_carousel/images/
define('IMAGES_DIR', JPath::clean( JPATH_COMPONENT_ADMINISTRATOR 
                                   . DIRECTORY_SEPARATOR 
                                   . 'images'                                 
                                   . DIRECTORY_SEPARATOR ));
define('THUMBNAILS_DIR', IMAGES_DIR . 'thumbnails' . DIRECTORY_SEPARATOR);// дирректория миниатюр

define('THUMBNAIL_WIDTH', '150'); // ширина миниатюры
define('THUMBNAIL_HEIGHT', '100'); // высота миниатюры

//--------------------------------------

// Проверить права доступа
if ( ! JFactory::getUser()->authorise('core.manage', 'com_carousel') ) {
    return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

// Подключаем библиотеку контроллера joomla
jimport('joomla.application.component.controller');

/* Получаем экземпляр контроллера с префиксом Carousel
 * Класс контроллера CarouselController описан
 * в файле главного контроллера "controller.php"
*/
$controller = JControllerLegacy::getInstance('Carousel'); // объект класса CaroselController

// Получаем объект запроса JInput, который содержит параметры запроса
$input = JFactory::getApplication()->input;
/*
 * Получаем параметр "task" из запроса (задача для выполнения)
 * если он не найден, выполняем задачу "display" (по умолчанию)
 */
$controller->execute( $input->get('task', 'display') );

// Перенаправляем, если перенаправление установлено в контроллере.
$controller->redirect();