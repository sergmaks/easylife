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

//Отключаем ненужные скрипты
unset(
    $this->_scripts[$this->baseurl . '/media/jui/js/jquery-migrate.min.js'],
    $this->_scripts[$this->baseurl . '/media/system/js/caption.js']
        ); 

$app             = JFactory::getApplication();
$doc             = JFactory::getDocument();
$user            = JFactory::getUser();
$this->language  = $doc->language;

// Output as HTML5
$doc->setHtml5(true);

// Переопределяем генератор
$doc->setGenerator('Easy Life - оставь время для себя!');

// Получаем параметры настройки шаблона
$params = $app->getTemplate(true)->params;

// Получаем имя сайта
$sitename = $app->get('sitename');

/*
 * Добавляем CSS
 */
// Bootstrap 3 CSS CDN
$doc->addStyleSheet ("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
                                        ,$type="text/css"
                                        ,$media=null
                                        ,$attribs=array("integrity"=>"sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
                                            ,"crossorigin"=>"anonymous"));
// Использование Google Font
if ($this->params->get('googleFont'))
{
    $doc->addStyleSheet('//fonts.googleapis.com/css?family=' . $this->params->get('googleFontName'));
}
// Пользовательский стиль шаблона
$doc->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/template.css');
// пользовательские переорпеделения Bootstrap 3 CSS
$doc->addStyleSheet ( $this->baseurl . '/templates/' . $this->template . '/css/overrides.css' );
// Медиа запросы
$doc->addStyleSheet ( $this->baseurl . '/templates/' . $this->template . '/css/media.css' );

// Иcпользуем Fontawesome CDN
$doc->addScript ( "https://use.fontawesome.com/7f0000df30.js" );

// Используем Bootstrap 3 js CDN
$doc->addScript("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js");

// Устанавливаем цвет шрифта из параметра
if ($this->params->get('fontColor')) {
    // встроенный инлайн-стиль
    $doc->addStyleDeclaration("
	    html,body,
	    .button-action,
	    #button-down,
	    #button-up:hover {
                font-family: '" . str_replace('+', ' ', $this->params->get('googleFontName')) . "', sans-serif;
		color: " . $this->params->get('fontColor') . ";
	    }");
}

// Логотип
$logo = '<img src="' . JUri::root() . $this->params->get('logoFile') . '" alt="' . $sitename . '" />';

// Ширина разделов футера в классах Bootstrap 3
// Только footer1
if ( $this->countModules('footer1')
    && ! $this->countModules('footer2')
    && ! $this->countModules('footer3') )
{
    $classFooter_1 = "col-lg-11 col-md-11 col-sm-11 col-xs-11 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1";
}
// Только footer1 и  footer2
elseif ( $this->countModules('footer1')
        && $this->countModules('footer2')
        && ! $this->countModules('footer3') )
{
    $classFooter_1 = "col-lg-3 col-md-3 col-sm-3 col-xs-3 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1";
    $classFooter_2 = "col-lg-7 col-md-7 col-sm-7 col-xs-7 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1";
}
// Только footer1 и  footer3
elseif ( $this->countModules('footer1')
        && ! $this->countModules('footer2')
        && $this->countModules('footer3') )
{
    $classFooter_1 = "col-lg-7 col-md-7 col-sm-7 col-xs-7 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1";
    $classFooter_3 = "col-lg-3 col-md-3 col-sm-3 col-xs-3 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1";
}
// Только footer2 и  footer3
elseif ( ! $this->countModules('footer1')
        && $this->countModules('footer2')
        && $this->countModules('footer3') )
{
    $classFooter_2 = "col-lg-3 col-md-3 col-sm-3 col-xs-3 col-lg-offset-5 col-md-offset-5 col-sm-offset-5 col-xs-offset-5";
    $classFooter_3 = "col-lg-3 col-md-3 col-sm-3 col-xs-3 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1";
}
// Только footer3
elseif ( ! $this->countModules('footer1')
        && ! $this->countModules('footer2')
        && $this->countModules('footer3') )
{
    $classFooter_3 = "col-lg-3 col-md-3 col-sm-3 col-xs-3 col-lg-offset-9 col-md-offset-9 col-sm-offset-9 col-xs-offset-9";
}
else
{
    $classFooter_1
    = $classFooter_2
    = $classFooter_3
    = "col-lg-3 col-md-3 col-sm-3 col-xs-3 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1";
}

// HTML is following
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
            require_once JPATH_BASE . '/templates/' . $this->template . '/header.php';
            // Main content
            require_once JPATH_BASE . '/templates/' . $this->template . '/main.php';
        ?>
    </div>
    <jdoc:include type="modules" name="debug" style="none" />
    <!-- Custom js-script -->
    <script <?php echo 'src="' . $this->baseurl . '/templates/' . $this->template . '/js/template.js' . '"' ?>></script>
</body>
</html>