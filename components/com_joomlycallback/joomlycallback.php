<?php

defined('_JEXEC') or die;

$controller = JControllerLegacy::getInstance('Joomlycallback');
$controller->execute(JFactory::getApplication()->input->get('task', 'display'));
$controller->redirect();

?>