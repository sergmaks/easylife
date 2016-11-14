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
    /**
     * Конструктор.
     *
     * @param   array  $config  Массив с конфигурационными параметрами.
     */
    public function __construct($config = array())
    {
        // Добавляем валидные поля для фильтров и сортировки.
        if (empty($config['filter_fields']))
        {
            $config['filter_fields'] = array(
                'id', 'id',
                'ordering', 'ordering',
            );
        }
 
        parent::__construct($config);
    }
 

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
        
        // Добавляем сортировку.
        // Мы обращаемся к состоянию модели, 
        // получаем параметры сортировки и применяем их в запросе.
        //$orderCol  = $this->state->get('list.ordering', 'id'); // поле, по которому будет выполнена сортировка. В нашем случае это поле id;
        //$orderDirn = $this->state->get('list.direction', 'ordering'); // направление сортировки. У нас это направление asc.
        //$query->order( $db->escape($orderCol . ' ' . $orderDirn) );

        return $query;
    }
    
    /**
     * Этот метод используется для автозаполнения состояния модели. 
     * В нем мы просто вызываем родительский метод с параметрами сортировки по умолчанию. 
     * Таким образом состояние модели будет заполнено двумя значениями:
            list.ordering - поле, по которому будет выполнена сортировка. В нашем случае это поле id;
            list.direction - направление сортировки. У нас это направление asc.
     *
     * @param   string  $ordering   Поле сортировки.
     * @param   string  $direction  Направление сортировки (asc|desc).
     *
     * @return  void
     */

    protected function populateState($ordering = 'ordering', $direction = 'asc')
    { 
        parent::populateState($ordering, $direction);
    }
}