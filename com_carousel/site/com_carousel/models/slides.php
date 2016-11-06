<?php
/**
 * @package     Joomla.Site
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
 * в родительском классе уже реализованы методы "getItems()"
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

        // SELECT all
        $query->select('*');

        // FROM #__carousel
        $query->from('#__carousel');
        
        // Опубликованные
        $query->where('`published` = 1');
        
        // ORDER BY `ordering`
        $query->order('`ordering`');

        return $query;
    }
    
}