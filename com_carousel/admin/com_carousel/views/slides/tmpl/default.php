<?php
/*
 * Шаблон вида
*/

defined('_JEXEC') or die;

JHtml::_('formbehavior.chosen', 'select');

// Данные по сортировке.
$listDirn    = $this->escape($this->state->get('list.direction')); // направление сортировки
$listOrder    = $this->escape($this->state->get('list.ordering')); // поле сортировки
$saveOrder    = $listOrder == 'ordering';

// Если установлено поле сортировки, то добавляем возможность Drag & Drop
if ($saveOrder)
{
    $saveOrderingUrl = 'index.php?option=com_carousel&task=slides.saveOrderAjax&tmpl=component';
    // Drag & Drop
    JHtml::_('sortablelist.sortable', 'itemList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);
}
?>
<!-- Создаем форму вывода элементов каусели -->
<!-- Атрибут id="adminForm" нужен для работы кнопок панели управления компонентом
выборка идет по данному идентификатору формы-->
<form action="index.php?option=com_carousel&view=slides" method="POST" id="adminForm" name="adminForm">

    <table class="table table-striped table-hover" id="itemList">
        <thead>
        <tr>
            <!--<th width="1%" ><?php echo JText::_('COM_CAROUSEL_NUM') ?></th> -->
            <!-- Заголовок поля сортировки -->
             <th width="1%" class="nowrap center hidden-phone">
                <?php echo JHtml::_('searchtools.sort', '', 'ordering', $listDirn, $listOrder, null, 'asc', 'JGRID_HEADING_ORDERING', 'icon-menu-2'); ?>
             </th>
            <!-- Заголовок поля Выделить все -->
            <th width="1%" ><?php echo JHtml::_('grid.checkall'); ?></th>
            <th width="1%" ><?php echo JText::_('COM_CAROUSEL_ITEM_STATE'); ?></th>
            <th width="25%" ><?php echo JText::_('COM_CAROUSEL_CAPTION_LABEL'); ?></th>
            <th width="25%" ><?php echo JText::_('COM_CAROUSEL_IMAGE_LABEL'); ?></th>
            <th width="10%" ><?php echo JText::_('COM_CAROUSEL_ICON_LABEL'); ?></th>
            <th width="10%" ><?php echo JText::_('COM_CAROUSEL_DATE_LABEL'); ?></th>
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
                        <!-- Выводим порядковый номер элемента 
                        <td>
                            <?php echo $this->pagination->getRowOffset($item_num) ?>
                        </td>-->
                        <!-- Поле сортировки -->
                        <td class="order nowrap center hidden-phone">
                            <?php
                                $iconClass = '';
                                if (! $saveOrder ) {
                                 $iconClass = ' inactive tip-top hasTooltip" title="' . JHtml::tooltipText('JORDERINGDISABLED');
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
                            <!-- Выводим текст слайда ссылкой на соотв. слайд и обрезанием текста-->
                            <a href="<?php echo $link; ?>">
                                <?php echo JHtml::_('string.truncate', strip_tags($item->caption), 50); ?>
                            </a>
                        </td>
                        <!-- Картика слайда -->
                        <td> 
                            <a href="<?php echo $link; ?>">
                                <?php
                                  if ( ! empty($item->image) )
                                  {  
                                    echo JHtml::_('image', 'administrator' . DIRECTORY_SEPARATOR
                                                 . 'components' . DIRECTORY_SEPARATOR
                                                 . 'com_carousel' . DIRECTORY_SEPARATOR
                                                 . 'images' . DIRECTORY_SEPARATOR 
                                                 . 'thumbnails' . DIRECTORY_SEPARATOR 
                                                 . JFile::getName($item->image) ,'thumbnail');
                                  }
                                  ?>
                            </a>
                        </td>
                        <!-- Иконка -->
                        <td> 
                            <?php if ( ! empty($item->icon) ) : ?>
                                <span class="fa-stack icon" style="font-size: 200%">
                                    <i class="fa fa-circle-o fa-stack-2x"></i>
                                    <i class="fa <?php echo $item->icon; ?> fa-stack-1x"></i>
                                </span>
                            <?php endif; ?>
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
                <td colspan="8">
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