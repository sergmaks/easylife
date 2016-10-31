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
     * Создание поля
     * @return string
     */
    protected function getInput() {
        
        JHtml::_('bootstrap.tooltip');
        JHtml::_('behavior.modal' , 'a.modal');
        
        $script   = array();
        $script[] = 'function jSelectIcon( iconName ) {';
        $script[] = 'document.getElementById(\'icon_name\').value = iconName;';
        $script[] = 'SqueezeBox.close();';
        $script[] = '}';
        
        JFactory::getDocument()->addScriptDeclaration(implode("\n", $script));
       
        $html = '<div class="input-append">
                    <input type="text" id="icon_name"  disabled="disabled"/>
                    <a class="modal" href="index.php?option=com_carousel&view=item&layout=modal&tmpl=component&function=jSelectIcon&' . JSession::getFormToken().'=1" 
                        rel="{size:{x:600,y:500}, handler:\'iframe\'}">
                        <input type="button" value=". . ." class="btn modal" title="Выбрать иконку" />
                    </a>
                </div>'; 
       
        return $html;
    }
}