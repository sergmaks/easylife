<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_carousel
 *
 * Сабконтроллер для работы с отдельным элементом компонента Карусель
 *
 * Данный класс наследуется от класса JControllerForm (используется работа с формами),
 * который в свою очередь наследуется от JControllerLegacy
 * But no form was presented to user in this request, 
 * it just stores item (the ID of the article) in user's session variable 
 * and redirects to master controller
 *
 * в имени класса:
 * - Carousel - имя компонента
 * - Controller - указание на класс контроллера
 * - Item - имя котроллера
 */

defined('_JEXEC') or die;

class CarouselControllerItem extends JControllerForm {

    // вид, куда будет осуществленно перенаправление после сохранения элемента в базу данных
    protected $view_list = 'slides';
}