<?php
/*
 * Шаблон вида
*/

defined('_JEXEC') or die;
?>
<!-- Создаем форму вывода элементов каусели -->
<!-- Атрибут id="adminForm" нужен для работы кнопок панели управления компонентом
выборка идет по данному идентификатору формы-->
<form action="index.php?option=com_carousel&view=carousel" method="POST" id="adminForm" name="adminForm">

    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th width="1%" ><?php echo JText::_('COM_CAROUSEL_NUM') ?></th>
            <!-- поле Выделить все -->
            <th width="2%" ><?php echo JHtml::_('grid.checkall'); ?></th>
            <th width="1%" ><?php echo JText::_('COM_CAROUSEL_ITEM_INTRO'); ?></th>
            <th width="1%" ><?php echo JText::_('COM_CAROUSEL_ITEM_STATE'); ?></th>
        </tr>
        </thead>
        <tbody>

        </tbody>
        <tfoot>
        <tr>
            <td colspan="4"></td>
        </tr>
        </tfoot>
    </table>
    <input type="hidden" name="task" value=""/>
    <?php echo JHtml::_('form.token'); ?>
</form>