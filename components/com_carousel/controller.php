<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_carousel
 *
 * Главный класс контроллера клиентской части компонента
 */

defined('_JEXEC') or die;

class CarouselController extends JControllerLegacy {

    // переопределяем вид по умолчанию
    protected $default_view = 'slides';
}
