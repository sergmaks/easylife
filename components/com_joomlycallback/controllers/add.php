<?php
defined('_JEXEC') or die;

require_once JPATH_COMPONENT.'/controller.php';

class JoomlycallbackControllerAdd extends JoomlycallbackController
{
	
	public function save()
	{	
		$url = JFactory::getURI();
		$app    = JFactory::getApplication();
		$input  = $app->input;
		$method = $input->getMethod();
		
		$data = array();
		$data = $app->input->post->getArray($_POST);
		
		$mod = 	($data['module_id']!==null) ? $data['module_id'] : 0;
		$model= $this->getModel('add');
		$params = $model->getParams($data['module_id']);
		
		//Check captcha errors
		if ($params->captcha == 1)
		{
			$url_c = 'https://www.google.com/recaptcha/api/siteverify';
			$data_c = array('secret' => $params->captcha_secretkey, 'remoteip' => $data['ip'], 'response' => $data['g-recaptcha-response']);

			$options = array(
				'http' => array(
					'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
					'method'  => 'POST',
					'content' => http_build_query($data_c),
				),
			);
			$context  = stream_context_create($options);
			$result_c = json_decode(file_get_contents($url_c, false, $context));
			if (!empty($params->captcha_secretkey))
			{
				if (isset($result_c->success) && ($result_c->success == 1))
				{
					$res = 11;
				} else
				{
					$app->setUserState('joomly_callback.add.form.data', $data);
					setcookie('callback_captcha', null, -1,'/',null);
					$app->setUserState( "joomly_callback.module.id", $mod );
					$app->setUserState( "joomly_callback.message.flag", 2 );
					$app->redirect(JRoute::_($url, false));
				}
			}
		}
		
		if ($data['cur_time'] == 0){
			$data['time'] = $data['time-today'];	
		}	else{
			$data['time'] = $data['time-any'];	
		}	
		
		$data["call_time"] = $data["time"].' '.$data["day"];

		JTable::addIncludePath(JPATH_COMPONENT.'/tables/');
		$row = JTable::getInstance('joomlycallback', 'Table');		
		
		if (!$row->bind($data)){
			echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
			exit();
		}
				
		if (!$row->store()){
			echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
			exit();
		}

		$model->sendMessage($data,$params);
			
		$app->setUserState( "joomly_callback.module.id", $mod );
		$app->setUserState( "joomly_callback.message.flag", 1 );

		$app->redirect(JRoute::_($url, false));
	}
}
