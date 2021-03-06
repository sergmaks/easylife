<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_carousel
 *
 * Точка входа в клиентскую часть компонента
 */

defined('_JEXEC') or die;

// Подключаем Fontawesome
JFactory::getDocument()->addScript("//use.fontawesome.com/7f0000df30.js");

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