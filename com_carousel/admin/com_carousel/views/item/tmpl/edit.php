<?php
/*
 * Шаблон вида редактирования элемента Карусели
*/

defined('_JEXEC') or die;

JHtml::_('formbehavior.chosen', 'select');
JHtml::_('behavior.formvalidation');
?>
<!-- Создаем форму редактирования элемента Карусели -->
<!-- Атрибут id="adminForm" нужен для работы кнопок панели управления компонентом
выборка идет по данному идентификатору формы-->
<form action="index.php?option=com_carousel&layout=edit&id="<?php echo $this->item->id ?> method="POST" id="adminForm" name="adminForm" class="form-validate">
    <div class="form-horizontal">
        <?php foreach( $this->form->getFieldsets() as $name => $fieldset ): ?>
            <fieldset class="adminform">
                <legend><?php echo JText::_($fieldset->label); ?></legend>
                <div class="row-fluid">
                    <div class="span6">
                        <?php foreach( $this->form->getFieldset($name) as $field ): ?>
                            <div class="control-group">
                                <div class="control-label">
                                    <?php echo $field->label; ?>
                                </div>
                                <div class="controls">
                                    <?php echo $field->input; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </fieldset>
        <?php endforeach; ?>
    </div>

    <input type="hidden" name="task" value=""/>
    <?php echo JHtml::_('form.token'); ?>
</form>