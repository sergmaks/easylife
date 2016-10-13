<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_carousel
 *
 * Класс модели "slides"
 * в имени класса:
 * - Carousel - имя компонента
 * - Model - указание на класс модели
 * - Slides - имя модели
 */

defined('_JEXEC') or die;

/*
 * наследование от JModelList (используется для работы со списком)
 * в родительском классе уже реализованы методы "getItems()" и "getPagination()"
 */
class CarouselModelSlides extends JModelList {

    /*
     * для работы метода "getItems()" необходимо переопределить метод "getListQuery()",
     * который возвращает SQL-запрос для необходимой таблицы.
     * затем метод "getItems()" выполнит этот запрос
     */
    protected function getListQuery() {

        $db    = JFactory::getDBO(); // получаем объект базы данных
        $query = $db->getQuery(true); // создаем новый пустой запрос

        // SELECT 'id','intro','caption','image','icon'
        $query->select('id, intro, caption, image, icon');

        // FROM #__carousel
        $query->from('#__carousel');

        return $query;
    }
}