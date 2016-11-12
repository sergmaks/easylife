<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_carousel
 * 
 * Класс кастомного типа поля формы для вызова модального окна выбора иконки слайда
 * 
 * В имени класса :
 * - JFormField - указание на класс поля формы
 * - Icon - имя кастомного типа поля формы 
 */

defined('_JEXEC') or die;

class JFormFieldIcon extends JFormField {
    
    /**
     * @var string Тип поля (Должен называться как файл с полем)
     */
    protected $type ='Icon';
    
    /**
     * Отображение поля в HTML
     * 
     * @return string
     */
    public function getInput() {
        
        JHtml::_('bootstrap.tooltip');
        JHtml::_('behavior.modal' , 'a.modal'); // подключаем библиотеку для вызова модального окна
        
        // скрипт получения имени икноки из модального окна и записи его в текстовое поле
        $scriptModal = 'function jSelectIcon( iconName ) {
                            document.getElementById(\'' . $this->id . '\').value = iconName;
                            document.getElementById(\'mini-icon\').innerHTML=\'\';
                            document.getElementById(\'mini-icon\').innerHTML=\' <i class="fa \'+ iconName + \' fa-1x"></i>\';
                            SqueezeBox.close();
                        }';
        
        JFactory::getDocument()->addScriptDeclaration($scriptModal);
        
        // Скрипт очистки поля иконки 
        $scriptClear = 'function jClearIcon() {
                            document.getElementById(\'' . $this->id . '\').value = \'\';
                            document.getElementById(\'mini-icon\').innerHTML=\'\';
                        }';
        
        JFactory::getDocument()->addScriptDeclaration($scriptClear);
        
        
        // Формируем HTML-код отображения поля
        $html = '<div class="input-prepend input-append">
                    <div class="add-on" id="mini-icon"><i class="fa '. $this->value . ' fa-1x"></i></div>
                        
                    <input type="text" class="input-small" name="' . $this->name . '" id="' . $this->id . '" value="' . $this->value . '" readonly="readonly"/>
                    
                    <a class="modal btn hasTooltip" 
                        href="index.php?option=com_carousel&view=item&layout=modal&tmpl=component&function=jSelectIcon&'
                        . JSession::getFormToken().'=1" 
                        rel="{size:{x:500,y:500}, handler:\'iframe\'}" title="'. JText::_('JSELECT') .'">'
                                
                            . JText::_('JSELECT') .
                    '</a>
                    
                    <a class="btn hasTooltip" href="#" 
                       title="'. JText::_('JCLEAR') 
                        .'" onclick="jClearIcon()">
                        
                            <i class="icon-remove"></i>
                    </a>    
                </div>'; 
       
        return $html;
    }
}