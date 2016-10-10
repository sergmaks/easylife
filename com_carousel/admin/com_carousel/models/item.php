<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_carousel
 *
 * Класс модели Item
 * в имени класса:
 * - Carousel - имя компонента
 * - Model - указание на класс модели
 * - Item- имя модели
 */

defined('_JEXEC') or die;

class CarouselModelItem extends JModelAdmin {
     // Определяем методы, к которым обращаемся из вида Item

    /*
     * @param $data - данные формы
     * @param $loadData - указание на то, что в форму нужно будет загружать некоторые данные
     * @return объект JForm
     */
    public function getForm( $data = array(),$loadData = true) {
        // получаем объект JForm из родительского метода
        $form = $this->loadForm( 'com_carousel.item',
                                 'item',
                                 array (
                                     'control' => 'jform',
                                     'load_data' => $loadData
                                 )
                                );
        if ( empty($form) ) {
            return false;
        }

        return $form;
    }

    public function getItem($pk = NULL) {
        return true;
    }

}