<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_carousel
 *
 * Класс таблицы Item, котрую использует модель Item
 * в имени класса:
 * - Carousel - имя компонента
 * - Table - указание на класс модели
 * - Item- имя таблицы
 */

defined('_JEXEC') or die;

class CarouselTableItem extends JTable {

    
    public function __construct(&$db) {
        /**
         * '#__carousel' - имя таблицы
         * 'id' - первичный ключ
         * $db - объект БД 
         */
        parent::__construct('#__carousel', 'id', $db);
    }
}