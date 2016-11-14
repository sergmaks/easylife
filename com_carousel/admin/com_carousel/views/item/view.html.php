<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_carousel
 *
 * Класс вида Item
 * в имени класса:
 * - Carousel - имя компонента
 * - View - класс вида
 * - Item- имя вида
 */

defined('_JEXEC') or die;

class CarouselViewItem extends JViewLegacy {
    /**
     * @var JForm $form - форма для редактирования слайда, получаемая из модели 'item' 
     * @var JObject $item - объект слайда 
     */
    protected $form; 
    protected $item;

    // переопределяем метод display
    public function display($tpl = null) {
        // обращение к методу модели 'getForm()'
        // Метод "get()" класса JViewLegacy используется для непосредственного взаимодействия с моделью
        $this->form = $this->get('Form');

        // обращение к методу модели 'getItem()'
        $this->item = $this->get('Item');

        // добавляем панель управления
        $this->addToolbar();

        // родительский метод display подгрузит файл "tmpl/item.php" и отобразит шаблон вида
        parent::display($tpl);

        // дополнительные параметры для текущего документа
        $this->setDocument();
    }
    
    protected function addToolbar(){
        // устанавливаем заголовок панели управления
        JToolbarHelper::title( JText::_('COM_CAROUSEL_ITEM'), '' );

        // добавляем кнопку "Сохранить"
        // где item - имя сабконтроллера
        // save - имя задачи (метод save определен в родительском контроллере)
        JToolbarHelper::save('item.save');

        // кнопка отмены
        JToolbarHelper::cancel('item.cancel');
    }

    protected function setDocument(){
        $document = JFactory::getDocument();

        // Изменяем заголовок документа
        $document->setTitle( JText::_('COM_CAROUSEL') );
    }
}

