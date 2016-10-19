<?php
/*
 * Шаблон вида
*/

defined('_JEXEC') or die;

JHtml::_('formbehavior.chosen', 'select');
?>
<!-- Создаем форму вывода элементов каусели -->
<!-- Атрибут id="adminForm" нужен для работы кнопок панели управления компонентом
выборка идет по данному идентификатору формы-->
<form action="index.php?option=com_carousel&view=slides" method="POST" id="adminForm" name="adminForm">

    <table class="table table-striped table-hover" id="itemList">
        <thead>
        <tr>
            <th width="1%" class="nowrap center hidden-phone">
                <?php echo JHtml::_('searchtools.sort', '', 'a.ordering', $listDirn, $listOrder, null, 'asc', 'JGRID_HEADING_ORDERING', 'icon-menu-2'); ?>
            </th>
            <th width="1%" ><?php echo JText::_('COM_CAROUSEL_NUM') ?></th>
            <!-- поле Выделить все -->
            <th width="2%" ><?php echo JHtml::_('grid.checkall'); ?></th>
            <th width="1%" ><?php echo JText::_('COM_CAROUSEL_ITEM_STATE'); ?></th>
            <th width="1%" ><?php echo JText::_('COM_CAROUSEL_ITEM_CAPTION'); ?></th>
            <th width="1%" ><?php echo JText::_('COM_CAROUSEL_ITEM_IMAGE'); ?></th>
            <th width="1%" ><?php echo JText::_('COM_CAROUSEL_ITEM_ICON'); ?></th>
            <th width="1%" ><?php echo JText::_('COM_CAROUSEL_ITEM_DATE'); ?></th>
        </tr>
        </thead>
        <tbody>
            <!-- Если полученный из модели список не пуст -->
            <?php if ( ! empty ($this->items) ) :?>
                <!-- Для каждого элемента списка -->
                <?php foreach ($this->items as $item_num => $item) : ?>
                    <!-- Формируем ссылку на текущий элемент списка -->
                    <?php $link = 'index.php?option=com_carousel&task=item.edit&id=' . $item->id; ?>

                    <tr>
                        <td class="order nowrap center hidden-phone">
                            <?php
                               $iconClass = '';
                               if ( ! $saveOrder) {
                                    $iconClass = ' inactive tip-top hasTooltip" title="' 
                                                 . JHtml::tooltipText('JORDERINGDISABLED');
                                }
                            ?>
                            <span class="sortable-handler <?php echo $iconClass ?>">
                                <span class="icon-menu"></span>
                            </span>
                            <?php if ($saveOrder) : ?>
                                <input type="text" style="display:none" name="order[]" size="5" value="<?php echo $item->ordering; ?>" class="width-20 text-area-order " />
                            <?php endif; ?>
                        </td>
                        
                        <td>
                            <!-- Выводим порядковый номер элемента -->
                            <?php echo $this->pagination->getRowOffset($item_num) ?>
                        </td>
                        <td>
                            <!-- Выводим чекбокс для элемента -->
                            <?php echo JHtml::_('grid.id', $item_num, $item->id); ?>
                        </td>
                        <td>
                            <!-- Выводим элемент состояния публикации -->
                                <?php
                                    /*
                                     *  Вывод кнопки состояния публикации
                                     *  $item_num - ключ массива записей
                                     *  'slides.' - сабконтроллер, который будет выполнять задачу публикации/ снятия с публикации
                                     *  true - кнопка доступна для использования
                                     */
                                    echo JHtml::_('jgrid.published', $item->published, $item_num, 'slides.', true); 
                                ?>
                        </td>
                        <td>
                            <!-- Выводим заголовок слайда ссылкой на текущий элемент-->
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
                        <td>
                            <?php echo $item->date; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6">
                    <!-- Выводим постраничную навигацию -->
                    <?php echo $this->pagination->getListFooter(); ?>
                </td>
            </tr>
        </tfoot>
    </table>
    <!-- Через скрытое поле task мы передаем задачу, которая подставляется исходя из того, 
         какую кнопку в панели инструментов мы нажали.-->
    <input type="hidden" name="task" value=""/>
    <!-- Скрытый параметр для передачи выбранного в чекбокса элемента -->
    <input type="hidden" name="boxchecked" value="0"/>
    <input type="hidden" name="filter_order" value="<?php echo $this->escape($this->state->get('list.ordering')); ?>" />
    <input type="hidden" name="filter_order_Dir" value="<?php echo $this->escape($this->state->get('list.direction')); ?>" />   
    <?php echo JHtml::_('form.token'); ?>
</form>