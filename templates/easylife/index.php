<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.easylife
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// Проверка выполнен ли вход в систему
defined('_JEXEC') or die;

// Отключаем ненужные скрипты
// $this - ссылка на текущий документ JDocumentHTML
unset(
    $this->_scripts[$this->baseurl . '/media/jui/js/jquery-migrate.min.js'],
    $this->_scripts[$this->baseurl . '/media/system/js/caption.js']
        ); 

$app = JFactory::getApplication();

// Output as HTML5
$this->setHtml5(true);

// Переопределяем генератор
$this->setGenerator('Sergey Maksimov, Dmitry Kogura');

// Получаем параметры настройки шаблона
$params = $app->getTemplate(true)->params;

// Получаем имя сайта
$sitename = $app->get('sitename');

// Добавляем CSS
// 
// Bootstrap 3 CSS CDN
$this->addStyleSheet ("//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
                                        ,$type="text/css"
                                        ,$media=null
                                        ,$attribs=array("integrity"=>"sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
                                            ,"crossorigin"=>"anonymous"));
// Использование Google Font
if ($this->params->get('googleFont'))
{
    $this->addStyleSheet('//fonts.googleapis.com/css?family=' . $this->params->get('googleFontName'));
}
// Пользовательский стиль шаблона
$this->addStyleSheet ( $this->baseurl . '/templates/' . $this->template . '/css/template.css' );
// пользовательские переорпеделения Bootstrap 3 CSS
$this->addStyleSheet ( $this->baseurl . '/templates/' . $this->template . '/css/bootstrap-overrides.css' );
// Медиа запросы
$this->addStyleSheet ( $this->baseurl . '/templates/' . $this->template . '/css/media.css' );

// Добавляем JS
// 
// Иcпользуем Fontawesome CDN
$this->addScript ( "//use.fontawesome.com/7f0000df30.js" );
// Используем Bootstrap 3 js CDN
$this->addScript("//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js");

// Устанавливаем цвет шрифта из параметра
if ($this->params->get('fontColor')) {
    // встроенный инлайн-стиль
    $this->addStyleDeclaration("
html,body {
    color: " . $this->params->get('fontColor') . ";
 }");
}

// Логотип
$logo = '<img src="' . $this->baseurl . '/' . $this->params->get('logoFile') . '" alt="' . $sitename . '" />';

// Далее HTML-разметка...
?>

<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <jdoc:include type="head"/>
	<!--[if lt IE 9]><script src="<?php echo JUri::root(true); ?>/media/jui/js/html5.js"></script><![endif]-->
</head>
<body>
    <div class="container-fluid">
        <?php  
            // Header
            require JPATH_BASE . '/templates/' . $this->template . '/header.php';
            // Main content
            require JPATH_BASE . '/templates/' . $this->template . '/main.php';
            // Footer
            require JPATH_BASE . '/templates/' . $this->template . '/footer.php';
        ?>
    </div>
    <!-- Custom js-script -->
    <script <?php echo 'src="' . $this->baseurl . '/templates/' . $this->template . '/js/template.js' . '"' ?>></script>
</body>
</html>