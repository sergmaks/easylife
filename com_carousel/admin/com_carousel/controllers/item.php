<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_carousel
 *
 * Сабконтроллер для работы с отдельным элементом компонента Карусель
 *
 * Данный класс наследуется от класса JControllerForm (используется работа с формами),
 * который в свою очередь наследуется от JControllerLegacy
 *
 * в имени класса:
 * - Carousel - имя компонента
 * - Controller - указание на класс контроллера
 * - Item - имя котроллера
 */

defined('_JEXEC') or die;

class CarouselControllerItem extends JControllerForm {

    protected $view_list = 'carousel';
}