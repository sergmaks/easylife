<?php
/**
 * Макет содержимого модального окна при выборе иконки для слайда
*/

defined('_JEXEC') or die;

$function = JRequest::getCmd('function',  'jSelectIcon');
?>
<form action="index.php?option=com_carousel&view=item&layout=modal&tmpl=component&function= 
      <?php echo $function . '&' . JSession::getFormToken() . '=1' ; ?>" 
      method="POST" id="adminForm" name="adminForm">
    <a style="cursor: pointer" onclick="if (window.parent)
       window.parent.<?php echo $this->escape($function)?>('EXAMPLE');">
      Example  
    </a>
</form>