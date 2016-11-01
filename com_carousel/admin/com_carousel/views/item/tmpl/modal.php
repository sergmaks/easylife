<?php
/**
 * Макет содержимого модального окна выбора иконки для слайда
*/

defined('_JEXEC') or die;

// Подключаем Fontawesome
JFactory::getDocument()->addScript("https://use.fontawesome.com/7f0000df30.js");

// Получаем имя функции родительского окна, которую вызываем при клике на иконку
$function = JRequest::getCmd('function',  'jSelectIcon');

// Стиль для иконки
$iconStyle = 'a.icon,
              a.icon:active,
              a.icon:visited {
                cursor: pointer;
                color: #000;
                font-size: 300%;
                text-decoration: none;
                transition: color 0.5s;
              }
              a.icon:hover {
                color: #378137;
              }';
JFactory::getDocument()->addStyleDeclaration($iconStyle);

// Массив иконок
$icons = array (
            'fa-question',
            'fa-phone',
            'fa-thumbs-o-up'
        );
?>

<form action="index.php?option=com_carousel&view=item&layout=modal&tmpl=component&function= 
    <?php echo $function . '&' . JSession::getFormToken() . '=1' ; ?>" 
    method="POST" id="adminForm" name="adminForm" >
    
        <?php foreach ($icons as $icon) : ?>
        
            <a class="icon" onclick="if (window.parent)
                window.parent.<?php echo $this->escape($function) . '(\'' . $icon .'\')' ; ?>;">
            
                <span class="fa-stack icon">
		    <i class="fa fa-circle-o fa-stack-2x"></i>
		    <i class="fa <?php echo $icon; ?> fa-stack-1x"></i>
                 </span>
            </a>
        <?php endforeach; ?>
</form>