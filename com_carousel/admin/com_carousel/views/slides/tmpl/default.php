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
            <th width="1%" ><?php echo JText::_('COM_CAROUSEL_ITEM_CAPTION'); ?></th>
            <th width="1%" ><?php echo JText::_('COM_CAROUSEL_ITEM_IMAGE'); ?></th>
            <th width="1%" ><?php echo JText::_('COM_CAROUSEL_ITEM_ICON'); ?></th>
        </tr>
        </thead>
        <tbody>
            <?php if ( ! empty ($this->items) ) :?>
                <?php foreach ($this->items as $item_num => $item) : ?>
                    <?php $link = 'index.php?option=com_carousel&task=item.edit&id=' . $item->id; ?>

                    <tr>
                        <td>
                            <?php echo $this->pagination->getRowOffset($item_num) ?>
                        </td>
                        <td>
                            <?php echo JHtml::_('grid.id', $item_num, $item->id); ?>
                        </td>
                        <td>
                            <a href="<?php echo $link; ?>">
                                <?php echo $item->intro; ?>
                            </a>
                        </td>
                        <td>
                            <a href="<?php echo $link; ?>">
                                <?php echo $item->caption; ?>
                            </a>
                        </td>
                        <td>
                            <a href="<?php echo $link; ?>">
                                <?php echo $item->image; ?>
                            </a>
                        </td>
                        <td>
                            <a href="<?php echo $link; ?>">
                                <?php echo $item->icon; ?>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
        <tfoot>
        <tr>
            <td colspan="6"></td>
        </tr>
        </tfoot>
    </table>
    <input type="hidden" name="task" value=""/>
    <?php echo JHtml::_('form.token'); ?>
</form>