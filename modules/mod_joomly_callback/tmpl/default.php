<div id="joomly-callback" class="joomly-callback-main">
	<div class="joomly-callback-caption" <?php if (isset($fields->color)){echo 'style="background-color:'.$fields->color.';"';};?>>
		<div class="joomly-callback-cap"><h4 class="text-center"><?php if (!empty($fields->title_name)){echo $fields->title_name;}else {echo JText::_('MOD_JOOMLY_CALLBACK_TITLE_NAME_MODULE');};?></h4></div><div class="joomly-callback-closer"><i id="joomly-callback-close<?php if ($module->id!==null){echo $module->id;};?>" class="fa fa-close fa-1x"></i></div>
	</div>
	<div class="joomly-callback-body">
		<form class="reg_form" action="<?php echo JFactory::getURI();?>" method="post" onsubmit="callback_validate(this);joomly_callback_analytics(<?php echo $module->id;?>);" enctype="multipart/form-data">
			<div>
				<p class="callback-text-center"><?php echo $form_message;?></p>
				<?php if ((isset($fields->name) ? $fields->name : 1)  == 1){?>
					<div class="joomly-callback-div">
						<input type="text" placeholder="<?php echo JText::_('MOD_JOOMLY_CALLBACK_NAME');if ((isset($fields->name_required) ? $fields->name_required : 0)  == 1){echo "*";};?>" name="name" class="joomly-callback-field"<?php if ((isset($fields->name_required) ? $fields->name_required : 0)  == 1){echo "required";};?> value="<?php if (isset($data['name'])){echo $data['name'];};?>">
					</div>
				<?php }?>	
				<div class="joomly-callback-div">
					<input type="tel" placeholder="<?php echo JText::_('MOD_JOOMLY_CALLBACK_PHONE');?>*"  name="phone" class="joomly-callback-field" required value="<?php if (isset($data['phone'])){echo $data['phone'];};?>">
				</div>
				<div class="joomly-callback-div">
					<label style="display:inline-block;"><?php echo JText::_('MOD_JOOMLY_CALLBACK_TIME_TO_CALL');?></label>
					<div style="display:inline-block;">
						<?php if ($form == 0){?>
						<select id="time-today<?php if ($module->id!==null){echo $module->id;};?>" name="time-today">
							  <option value="<?php echo JText::_('MOD_JOOMLY_CALLBACK_NOW');?>" ><?php echo JText::_('MOD_JOOMLY_CALLBACK_NOW');?></option>
							<?php $c_time = 1800*ceil(strtotime($date->format('H:i'))/1800);
							while ( $c_time <= strtotime($fields->finish)){ ?>
								<option value="<?php echo date("H:i", $c_time);?>"><?php echo date("H:i", $c_time);?></option>	
							<?php $c_time += 1800; }?>
						</select>
						<?php } ?>
						<select id="time-any<?php if ($module->id!==null){echo $module->id;};?>" name="time-any" <?php if ($form == 0){echo "style='display:none;'";};?>>
							<?php $c_time = 1800*ceil(strtotime($fields->start)/1800);
							while ( $c_time <= strtotime($fields->finish)){ ?>
								<option value="<?php echo date("H:i", $c_time);?>"><?php echo date("H:i", $c_time);?></option>	
							<?php $c_time += 1800; }?>
						</select>
						<select id="day<?php if ($module->id!==null){echo $module->id;};?>" name="day">
							<?php if (($form == 0) || ($form == 3))
							{?>
								<option value="<?php echo JText::_('MOD_JOOMLY_CALLBACK_TODAY');?>"><?php echo JText::_('MOD_JOOMLY_CALLBACK_TODAY');?></option>
							<?php }?>	
							<?php foreach ($fields->weekday as $day){ 
								if ($day !== $date->format('w')){?>
							<option value="<?php echo $weekdays[$day];?>" <?php if  ((isset($close_day)) && ($day == $close_day)){echo "selected";};?>><?php echo $weekdays[$day];?></option>
								<?php }}?>
						</select>
					</div>	
				</div>	
				<?php if ((isset($fields->captcha) ? $fields->captcha : 1)  == 1){?>
					<div class="joomly-callback-div">
						<div class="g-callback-recaptcha" data-sitekey="<?php if (isset($fields->captcha_sitekey)){echo $fields->captcha_sitekey;}?>"></div>
					</div>
				<?php }?>	
				<input type="hidden" name="page" value="<?php echo urldecode($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);?>" />
				<input type="hidden" name="created_at" value="<?php echo $date->format('Y-m-d H:i:s');?>" />
				<input type="hidden" name="cur_time" id="cur-time<?php if ($module->id!==null){echo $module->id;};?>" value="<?php echo $form;?>" />
				<input type="hidden" name="module_id" value="<?php echo $module->id;?>" />		
				<input type="hidden" name="title_name" value="<?php if (!empty($fields->title_name)){echo $fields->title_name;}else {echo JText::_('MOD_JOOMLY_CALLBACK_TITLE_NAME_MODULE');};?>" />		
			</div>
			<div>
				<button class="button-joomly-callback-lightbox" type="submit"  value="save" <?php if (isset($fields->color) && ($fields->color !== "#21ad33")){echo 'style="background-color:'.$fields->color.';"';};?> id="button-joomly-callback-lightbox<?php if ($module->id!==null){echo $module->id;};?>"><?php if (!empty($fields->button_lightbox_caption)){ echo $fields->button_lightbox_caption;} else {echo JText::_('MOD_JOOMLY_CALLBACK_SEND');}; ?></button>
			</div>
				<input type="hidden" name="option" value="com_joomlycallback" />
				<input type="hidden" name="task" value="add.save" />
				<?php echo JHtml::_('form.token'); ?>
		</form>
	</div>	
</div>
<?php if ((isset($fields->button_form) ? $fields->button_form : 1)  > 0){?>
        <div class="visible-xs">
            <button class="button-joomly-callback-form joomly-callback btn" type="submit"   value="save">
               <span class="fa fa-phone" style="font-size: 160%"></span>
            </button>
        </div>
	<div class="hidden-xs">
            <span class="fa fa-phone fa-lg"></span>
            <span class="fa fa-reply" style="margin: 0 5px 0 -5px"></span>
            <button class="button-joomly-callback-form joomly-callback" type="submit"   value="save"><?php if (!empty($fields->button_form_caption)){ echo $fields->button_form_caption;} else {echo  JText::_('MOD_JOOMLY_CALLBACK_CALL_TO_US');};?></button>
	</div>
<?php }?>
<div class="special-alert" id="special-alert<?php if ($module->id!==null){echo $module->id;};?>">
	<div class="joomly-callback-caption" style="background-color:<?php echo $alert_message_color;?>">
		<div class="joomly-callback-cap"><h4 class="callback-text-center"><?php if (isset($alert_headline_text)){echo $alert_headline_text;};?></h4></div><div class="joomly-callback-closer"><i id="callback-alert-close<?php if ($module->id!==null){echo $module->id;};?>" class="fa fa-close fa-1x"></i></div>
	</div>
	<div class="joomly-alert-body">
		<p class="callback-text-center"><?php if (isset($alert_message_text)){echo $alert_message_text;};?></p>
	</div>
</div>
<script type="text/javascript">
var callback_module_id = <?php if ($module->id!==null){echo $module->id;} else { echo "0";};?>,
type_field = "<?php echo JText::_('MOD_JOOMLY_CALLBACK_TYPE_FIELD');?>";
var callback_sending_flag = callback_sending_flag || [];
callback_sending_flag[callback_module_id] = callback_sending_flag[callback_module_id] || <?php if (isset($sending_flag)){echo $sending_flag;} else {echo "0";};?>;
var callback_params = callback_params || [];
callback_params[callback_module_id] = <?php echo json_encode($callback_params);?>;
var callback_popup = document.getElementById("joomly-callback");
document.body.appendChild(callback_popup);
</script>
<script type="text/javascript" src="modules/mod_joomly_callback/js/callback.js"></script>