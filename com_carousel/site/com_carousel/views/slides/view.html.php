<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_carousel
 *
 * Класс клиентского вида слайдера
 *
 */

defined('_JEXEC') or die;


class CarouselViewSlides extends JViewLegacy {

    protected $items; // список слайдов
    protected $state; // состояние модели

    // переопределяем метод display
    public function display($tpl = null) {

        $this->items = $this->get('Items'); // напрямую вызываем метод модели getItems()
        //$this->pagination = $this->get('Pagination'); // getPagination()
        $this->state = $this->get('State'); // Получаем объект состояния модели

        // родительский метод display подгрузит файл "tmpl/default.php" и отобразит шаблон вида
        parent::display($tpl); 
    }    
}

