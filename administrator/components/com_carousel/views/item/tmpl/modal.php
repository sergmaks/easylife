<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_carousel
 * 
 * Макет содержимого модального окна выбора иконки для слайда
*/

defined('_JEXEC') or die;

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

// Массив иконок FontAwesome, которые будут отображаться в модальном окне
$iconSet = array (
            'fa-question',
            'fa-exclamation',
            'fa-phone',
            'fa-thumbs-o-up',
            'fa-hand-o-right',
            'fa-cutlery',
            'fa-coffee',
            'fa-bell',
            'fa-male',
            'fa-female',
            'fa-user',
            'fa-rub',
            'fa-eur',
            'fa-dollar',
            'fa-check',
            'fa-gift',
            'fa-heart',
            'fa-tree',
            'fa-lock',
            'fa-lightbulb-o',
            'fa-mobile-phone',
            'fa-search',
            'fa-wifi',
            'fa-android',
            'fa-apple',
            'fa-facebook',
            'fa-instagram',
            'fa-odnoklassniki',
            'fa-twitter',
            'fa-vk'
        );
?>

<form action="index.php?option=com_carousel&view=item&layout=modal&tmpl=component&function= 
    <?php echo $function . '&' . JSession::getFormToken() . '=1' ; ?>" 
    method="POST" id="adminForm" name="adminForm" >
    
        <?php foreach ($iconSet as $icon) : ?>
        
            <a class="icon" onclick="if (window.parent)
                window.parent.<?php echo $this->escape($function) . '(\'' . $icon .'\')' ; ?>;">
            
                <span class="fa-stack icon">
		    <i class="fa fa-circle-o fa-stack-2x"></i>
		    <i class="fa <?php echo $icon; ?> fa-stack-1x"></i>
                 </span>
            </a>
        <?php endforeach; ?>
</form>