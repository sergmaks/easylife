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
    public function getForm( $data = array(), $loadData = true ) {
        // получаем объект формы JForm из файла "item.xml"
        /*
         * метод loadForm() определен в родительском классе JModelAdmin
         * 'com_carousel.item' - имя формы
         * 'item' - имя манифеста xml
         * array(...) - массив опций
        */
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

    /*
     * указание модели, с какой таблицей она работает
     * @param $type - имя таблицы без префикса
     * @param $prefix - префикс талицы
     * @param $config - массив параметров (по умолчанию пуст)
     * @return - объект-одиночка CarouselTableItem
    */
    public function getTable($type = 'Item', $prefix = 'CarouselTable', $config = array()) {

        return JTable::getInstance($type, $prefix, $config);
    }

    /*
     * получение данных из БД
     * @param $pk - первичный ключ. по умолчанию NULL
     * @return - объект записи JObject
    */
    public function getItem($pk = NULL) {
        if ( $item = parent::getItem() ) {
            return $item;
        }

        return false;
    }

    //
    protected function loadFormData () {
         // Проверка сессии на наличие ранее введеных в форму данных.
        $data = JFactory::getApplication()->getUserState($this->option . '.edit.item.data', array());
        
        if (empty($data)) 
        { 
            $data = $this->getItem();
        }
        
        return $data;
    }



}