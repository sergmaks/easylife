﻿<?php
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.model');

class JoomlycallbackModelAdd extends JModelLegacy
{	
	
	function sendMessage($data,$params){
		
		$mailer = JFactory::getMailer();
		
		$config = JFactory::getConfig();
		$sender = array( 
		    $config->get( 'mailfrom' ),
		    $config->get( 'fromname' ) 
		);
		 
		$mailer->setSender($sender);

		$mail = $this->getRecipient($params->admin_mail);
		$mailer->addRecipient($mail);
		
		$subject = $this->getSubject($data['title_name']);
		$mailer->setSubject($subject);
		
		$body = $this->getBody($data);
		$mailer->setBody($body);	
		
		$mailer->IsHTML(true);
		$mailer->Send();
		
		if ((isset($params->flag)) && ($params->flag==1)){
			$ch = curl_init("http://sms.ru/sms/send");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
			curl_setopt($ch, CURLOPT_TIMEOUT, 30);
			curl_setopt($ch, CURLOPT_POSTFIELDS, array(
				"api_id"		=>	$params->api_id,
				"to"			=>	$params->self_number,
				"text"		=>	($data["name"]." ".$data["phone"]." ".$data["day"]." ".$data["time"]),
				"partner_id" => "108497"
			));
			$body = curl_exec($ch);
			curl_close($ch);
		}

	}
	
	function getRecipient($admin_mail){
		$mail = explode(",",$admin_mail);
		if (empty($mail[0])){
			$config = JFactory::getConfig();
			$mail = $config->get('mailfrom');
		}
		return $mail;
	}
	
	function getParams($id){
		$db    = JFactory::getDbo();
		if (isset($id) && ($id > 0))
			{
				$query = $db->getQuery(true);
				$query->select('params')
				->from('#__modules')
				->where("id={$id}");
			} else {
				$query = $db->getQuery(true);
				$query->select('params')
				->from('#__modules')
				->where('module="mod_joomly_callback"');
			}
		$db->setQuery($query);
		$array =  $db->loadAssoc();
		$params =  json_decode($array['params']); 	
		return $params;
	}
	
	function getSubject($title){

			if (!empty($title)){
				$subject = $title;
			} else 
			{
				$subject = JText::_('COM_JOOMLYCALLBACK_NEW_FEEDBACK');
			}
		return $subject;
	}
	
	function getBody($data){
		if (!empty($data["created_at"])){ 
			$body = '<br><i>'.JText::_('COM_JOOMLYCALLBACK_CREATED_AT').'</i>: <b>'.$data["created_at"]."</b>";
		}	
		if (!empty($data["name"])){ 
			$body = $body.'<br><i>'.JText::_('COM_JOOMLYCALLBACK_NAME').'</i>: <b>'.$data["name"]."</b>";
		}
		if (!empty($data["phone"])){ 
			$body = $body.'<br><i>'.JText::_('COM_JOOMLYCALLBACK_PHONE').'</i>: <b>'.$data["phone"]."</b>";
		}
		if (!empty($data["page"])){ 
			$body = $body.'<br><i>'.JText::_('COM_JOOMLYCALLBACK_PAGE').'</i>: <b>'.$data["page"]."</b>";
		}
		$body = $body.'<br><br>'.JText::_('COM_JOOMLYCALLBACK_TIME_TO_CALL').':';
		if (!empty($data["day"])){ 
			$body = $body.'<br><i>'.JText::_('COM_JOOMLYCALLBACK_DAY').'</i>: <b>'.$data["day"]."</b>";
		}
		if (!empty($data["time"])){ 
			$body = $body.'<br><i>'.JText::_('COM_JOOMLYCALLBACK_TIME').'</i>: <b>'.$data["time"]."</b>";
		}
		
		return $body;
	}
}
