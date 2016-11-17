<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod__joomly_callback
 *
 * @copyright   Copyright (C) 2015 Artem Yegorov. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

require_once __DIR__ . '/helper.php';

$app  = JFactory::getApplication();
$document = JFactory::getDocument();
$document->addStyleSheet("modules/mod_joomly_callback/css/default.css");
$fields = ModJoomlyCallbackHelper::getFields();// параметры модуля из БД
$callback_params = new StdClass();
$weekdays = ModJoomlyCallbackHelper::getWeekdays();

// Значения заголовка, сообщения, цвета по умолчанию
$alert_headline_text = (!empty($fields->title_name)) ?  $fields->title_name : JText::_('MOD_JOOMLY_CALLBACK_TITLE_NAME_MODULE');
$alert_message_text = (!empty($fields->alertmessage)) ? $fields->alertmessage : JText::_('MOD_JOOMLY_CALLBACK_ALERT');
$alert_message_color = (isset($fields->color) ? $fields->color : "#21ad33");

// Если id используемого модуля совпадает с id модуля joomly_callback
if ($module->id == $app->getUserState('joomly_callback.module.id')) // 'joomly_callback.module.id' - значение рееста Joomla 
{
	$data = $app->getUserState('joomly_callback.add.form.data', array()); // данные клиентской формы
	$app->setUserState('joomly_callback.add.form.data', array());
	$sending_flag =  $app->getUserState('joomly_callback.message.flag');
	$app->setUserState('joomly_callback.module.id', "");
	$app->setUserState('joomly_callback.message.flag', "");
	if ($sending_flag > 1)
	{
		$alert_headline_text = JText::_('MOD_JOOMLY_CALLBACK_ERROR');
		$alert_message_text =  JText::_('MOD_JOOMLY_CALLBACK_CAPTCHA_ERROR');
		$alert_message_color  = "red";
	} 
} else 
{
	$sending_flag = 0;
}

//------ Блок обработки даты ------//
$date = new DateTime();
$date->setTimezone(new DateTimeZone('UTC'));  
$timezone =  (isset($fields->timezone)) ? $fields->timezone : 3;
$interval = new DateInterval("PT" . abs($timezone) . "H");
if ($timezone < 0)
{
	$interval->invert = 1;
}
$date->add($interval);
if (  (!isset($fields->weekday)) || ((in_array($date->format('w'), $fields->weekday))&&(strtotime($date->format('H:i')) > strtotime($fields->start))&&(strtotime($date->format('H:i')) < strtotime(($fields->finish))))){ 
	$form = 0;	
	$form_message =  (!empty($fields->text_worktime)) ? $fields->text_worktime : JText::_('MOD_JOOMLY_CALLBACK_TEXT_WORKTIME');
} else {
	$form = 1;
	$form_message =  (!empty($fields->text_worktime_no)) ? $fields->text_worktime_no : JText::_('MOD_JOOMLY_CALLBACK_TEXT_WORKTIME_NO');
	if ((in_array($date->format('w'), $fields->weekday)) && (strtotime($date->format('H:i')) < strtotime($fields->start))){
		$form = 3;
		$close_day = $date->format('w');
	} else{	
		$i = $date->format('w') + 1;
		while (($i<7)&&(!in_array($i, $fields->weekday))){
			$i+=1;
		}	
		if ($i == 7){
			$i=0;
			while (($i<$date->format('w'))&&(!in_array($i, $fields->weekday))){
				$i+=1;
			}
		}	
		$close_day = $i;
	}
}

//------ Блок обработки каптчи ------//
if (($fields->captcha !==null ? $fields->captcha : 1)  == 1){
	$document->addScript("https://www.google.com/recaptcha/api.js?onload=myCallBack&render=explicit", "text/javascript", true, true);
}

//------ Аналитика ------//
if ((!empty($fields->yandex_metrika_id)) || (!empty($fields->google_analytics_category)))
{
	$callback_params->yandex_metrika_id = $fields->yandex_metrika_id; 
	$callback_params->yandex_metrika_goal = $fields->yandex_metrika_goal;
	$callback_params->google_analytics_category = $fields->google_analytics_category; 
	$callback_params->google_analytics_action = $fields->google_analytics_action;
	$callback_params->google_analytics_label = $fields->google_analytics_label;
	$callback_params->google_analytics_value =  $fields->google_analytics_value;
}

// Включаем шаблон отображения модуля "/modules/mod_joomly_callback/tmpl/default.php"
require JModuleHelper::getLayoutPath('mod_joomly_callback', $params->get('layout', 'default'));
