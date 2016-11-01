<?php
/**
 * Класс поля формы для вызова модального окна выбора иконки слайда
 */

defined('_JEXEC') or die;

class JFormFieldIcon extends JFormField {
    
    /**
     * @var string Тип поля (Должен называться как файл с полем)
     */
    protected $type ='Icon';
    
    /**
     * Вывод поля в HTML
     * 
     * @return string
     */
    public function getInput() {
        
        JHtml::_('bootstrap.tooltip');
        JHtml::_('behavior.modal' , 'a.modal'); // подключаем библиотеку для вызова модального окна
        
        // скрипт получения имени икноки и записи его в текстовое поле
        $scriptModal = 'function jSelectIcon( iconName ) {
                            document.getElementById(\'' . $this->id . '\').value = iconName;
                            SqueezeBox.close();
                        }';
            
        JFactory::getDocument()->addScriptDeclaration($scriptModal);
        

        $html = '<div class="input-append">
                    <input type="text" class="input-small" name="' . $this->name . '" id="' . $this->id . '" value="' . $this->value . '" readonly="readonly"/>
                    
                    <a class="modal btn hasTooltip" 
                        href="index.php?option=com_carousel&view=item&layout=modal&tmpl=component&function=jSelectIcon&'
                        . JSession::getFormToken().'=1" 
                        rel="{size:{x:300,y:300}, handler:\'iframe\'}" title="'. JText::_('JSELECT') .'">'
                                
                            . JText::_('JSELECT') .
                    '</a>
                    
                    <a class="btn hasTooltip" href="#" 
                       title="'. JText::_('JCLEAR') 
                        .'" onclick="document.getElementById(\''. $this->id . '\').value=\'\'">
                        
                            <i class="icon-remove"></i>
                    </a>    
                </div>'; 
       
        return $html;
    }
}