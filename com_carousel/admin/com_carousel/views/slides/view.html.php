<<<<<<< HEAD
<?php
/*
 * Класс общего вида списка слайдов 
*/

defined('_JEXEC') or die;

/*
 * Главный класс вида
 * в имени класса:
 * - Carousel - имя компонента
 * - View - класс вида
 * - Slides - имя вида
 */
class CarouselViewSlides extends JViewLegacy {

    protected $items; // список слайдов
    protected $pagination; // объект постраничной навигации
    protected $state; // состояние модели

    // переопределяем метод display
    public function display($tpl = null) {

        $this->items = $this->get('Items'); // напрямую вызываем метод модели getItems()
        $this->pagination = $this->get('Pagination'); // getPagination()
        $this->state = $this->get('State'); // Получаем объект состояния модели

        // добавляем панель управления
        $this->addToolbar();

        // родительский метод display подгрузит файл "tmpl/default.php" и отобразит шаблон вида
        parent::display($tpl);

        // дополнительные параметры для текущего документа
        $this->setDocument();
    }

    protected function addToolbar(){
        // устанавливаем заголовок панели управления
        JToolbarHelper::title( JText::_('COM_CAROUSEL'), 'Component Carousel' );

        // добавляем кнопку "Создать новый элемент"
        // где item - имя сабконтроллера
        // add - имя задачи
        JToolbarHelper::addNew('item.add');

        // кнопка редактирования
        JToolbarHelper::editList('item.edit');

        // кнопка удаления из списка элементов-слайдов
        // (используется сабконтроллер slides)
        JToolbarHelper::deleteList('', 'slides.delete');
        
        // кнопка глобальных настроек компонента
        JToolBarHelper::preferences('com_carousel');
    }

    protected function setDocument(){
        $document = JFactory::getDocument();

        // Изменяем заголовок документа
        $document->setTitle( JText::_('COM_CAROUSEL') );
    }
}

=======
<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_carousel
 * 
 * Класс общего вида списка слайдов 
*/

defined('_JEXEC') or die;

/*
 * Класс вида списка слайдов
 * в имени класса:
 * - Carousel - имя компонента
 * - View - класс вида
 * - Slides - имя вида
 */
class CarouselViewSlides extends JViewLegacy {

    protected $items; // список слайдов
    protected $pagination; // объект постраничной навигации
    protected $state; // состояние модели

    // переопределяем метод display
    public function display($tpl = null) {

        $this->items = $this->get('Items'); // напрямую вызываем метод модели getItems()
        $this->pagination = $this->get('Pagination'); // getPagination()
        $this->state = $this->get('State'); // Получаем объект состояния модели (mixed)

        // добавляем панель управления
        $this->addToolbar();

        // родительский метод display подгрузит файл "tmpl/default.php" и отобразит шаблон вида по умолчанию
        parent::display($tpl);

        // дополнительные параметры для текущего документа
        $this->setDocument();
    }

    /**
     *  Добавление панели управления с кнопками "Сохранить", "Отмена" и т.д.
     */
    protected function addToolbar(){
        // устанавливаем заголовок панели управления
        JToolbarHelper::title( JText::_('COM_CAROUSEL') );

        // добавляем кнопку "Создать новый элемент"
        // где item - имя сабконтроллера
        // add - имя задачи
        JToolbarHelper::addNew('item.add');

        // кнопка редактирования
        JToolbarHelper::editList('item.edit');

        // кнопка удаления из списка элементов-слайдов
        // (используется сабконтроллер slides)
        JToolbarHelper::deleteList('', 'slides.delete');
        
        // кнопка глобальных настроек компонента
        JToolBarHelper::preferences('com_carousel');
    }

    protected function setDocument(){
        $document = JFactory::getDocument();

        // Изменяем заголовок документа
        $document->setTitle( JText::_('COM_CAROUSEL') );
    }
}

>>>>>>> sergmaks/master
