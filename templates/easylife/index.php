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
?>

<!-- HTML разметка -->
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <jdoc:include type="head"/>
	<!--[if lt IE 9]><script src="<?php echo JUri::root(true); ?>/media/jui/js/html5.js"></script><![endif]-->
</head>
<body>
    <div class="container-fluid">
    <header>
    <!-- Top Header bar -->
	<div class="row" id="top-bar">
            <!--Mobile elements-->
            <div class="col-xs-9 col-xs-offset-2 visible-xs" style="font-size: 170%">
                <?php echo '<p align="center">' . $sitename . '</p>' ?>        
            </div>
            <div class="col-xs-1 visible-xs" style="padding:0">
                <a href="#" class="btn" id="menu-trigger" style="font-size: 130%">
                    <span class="fa fa-bars"></span>    
                </a>        
            </div>
           <!--Desctop elements -->
           <div id="logo">
               <?php echo $logo ?>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-2 col-lg-offset-4 col-md-offset-4 col-sm-offset-4 hidden-xs" style="padding: 0">
                <?php if ($this->params->get("phoneNumber")) : ?>        
                    <span class="fa fa-phone fa-lg" style="margin-right: 10px"></span>
                        <?php echo $this->params->get('phoneNumber');
                endif; ?>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-4 hidden-xs">
                <jdoc:include type="modules" name="callme" style="none"/>
               <!--
               <span class="fa fa-phone fa-lg"></span>
               <span class="fa fa-reply" style="margin: 0 5px 0 -5px"></span>
               <a href="#" id="call"> перезвоните мне</a>
               -->
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-lg-offset-1  col-md-offset-1 col-sm-offset-1 col-xs-offset-1">
                <jdoc:include type="modules" name="profile" style="none"/>
               <!--
               <a href="#"  style="margin-right: 50px" data-toggle="tooltip" data-placement="left" title="Авторизоваться в системе">
		            <span class="fa fa-user fa-lg"></span> Войти
		        </a>
                <a href="#" data-toggle="tooltip" data-placement="bottom" title="Перейти к заказу">
		            <span class="fa fa-shopping-cart fa-lg"></span>
                </a>
                -->
            </div>
	</div>
       <!-- Main navigation -->
        <nav>
            <div class="row" id="nav-bar">
		<div class="col-lg-4 col-md-4 col-sm-5 col-xs-12 col-lg-offset-6 col-md-offset-6 col-sm-offset-4" id="menu-container">
                    <jdoc:include type="modules" name="navigation" style="none"/>
                <!--
                <ul>
		            <li><a href="#" class="main" data-toggle="tooltip" data-placement="bottom" title="Меню на наделю">МЕНЮ</a></li>
		            <li><a href="#" class="main">О СЕРВИСЕ</a>
		                  <ul>
                              <li><a href="#">Как это работает?</a></li>
                              <li><a href="#">Доставка и оплата</a></li>
                              <li><a href="#">Вопросы и ответы</a></li>
                          </ul>
		            </li>
		            <li><a href="#" class="main" data-toggle="tooltip" data-placement="bottom" title="Перейти к заказу">КОРЗИНА</a></li>
		        </ul>
		        -->
		</div>
		<div class="col-lg-2 col-md-2 col-sm-3 col-xs-12" id="socials-container">
                    <jdoc:include type="modules" name="socials" style="none"/>
                <!--
		        <ul>
		          <li><a href="https://vk.com" class="socials" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Мы в VK">
		                    <span class="fa-stack">
		                        <i class="fa fa-circle fa-stack-2x"></i>
		                        <i class="fa fa-vk fa-stack-1x fa-inverse"></i>
		                    </span>
		                </a></li>
		          <li><a href="https://instagram.com" class="socials" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Мы в Instagram">
		                    <span class="fa-stack">
		                        <i class="fa fa-circle fa-stack-2x"></i>
		                        <i class="fa fa-instagram fa-stack-1x fa-inverse"></i>
		                    </span>
		                </a></li>
		          <li><a href="https://facebook.com" class="socials" target="_blank" data-toggle="tooltip" data-placement="bottom" data-placement="bottom" title="Мы в Facebook">
		                    <span class="fa-stack">
		                        <i class="fa fa-circle fa-stack-2x"></i>
		                        <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
		                    </span>
		                </a></li>
		          <li><a href="https://ok.ru" class="socials" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Мы в Однокассниках">
		                    <span class="fa-stack">
		                        <i class="fa fa-circle fa-stack-2x"></i>
		                        <i class="fa fa-odnoklassniki fa-stack-1x fa-inverse"></i>
		                    </span>
		                </a></li>  
		        </ul>
		        -->
		</div>
            </div>
	</nav>
    </header>

<!-- Main Content -->
    <main>
        <div class="row">
            <jdoc:include type="component" />
                 
            <!-- Buttons Call to Action
            <div id="buttons-group">
                <a class="button-action">
                    <span class="fa fa-bars" style="margin-right: 10px"></span>просмотреть меню
                </a> 
                <a class="button-action">
                    <span class="fa fa-shopping-cart" style="margin-right: 10px"></span>перейти к заказу
                </a>
            </div>
                 
            <!-- Button Show Footer -->
            <div id="button-down" data-toggle="tooltip" data-placement="top" title="Инфо">
                <span class="fa fa-chevron-down fa-lg"></span>
            </div>
         </div>
    </main>
    <footer>
        <div class="row" id="footer">
            <div class="<?php echo $classFooter_1 ?>">
                <jdoc:include type="modules" name="footer1" style="none"/>
                   <!--
                   <h3>Контакты</h3>
                   <p>Сервис доставки продуктовых корзин EASY LIFE</p>
                   <p>8 (XXX) XXX XX XX <br> easylife@gmail.com</p>
                   -->
            </div>
            <div class="<?php echo $classFooter_2 ?>">
                <jdoc:include type="modules" name="footer2" style="none"/>
                    <!--
                    <h3>Следите за нами</h3>
                    <p><a href="https://vk.com" target="_blank">Вконтакте</a><br>
                       <a href="https://instagram.com" target="_blank">Instagram</a><br>
                       <a href="https://facebook.com" target="_blank">Facebook</a><br>
                       <a href="https://ok.ru" target="_blank">Одноклассники</a>
                    </p>
                    -->
            </div>
            <div class="<?php echo $classFooter_3 ?>">
               <jdoc:include type="modules" name="footer3" style="none"/>
                    <!--
                    <h3>Информация</h3>
                    <p>© 2016 Все права защищены.<br>
                        Сервис доставки продуктовых корзин EASY LIFE</p>
                    -->
            </div>
            <!-- Button Hide Footer -->
            <div id="button-up" data-toggle="tooltip" data-placement="top" title="Свернуть">
                <span class="fa fa-chevron-up fa-lg"></span>
            </div>
        </div>
    </footer>
    </div>
    <jdoc:include type="modules" name="debug" style="none" />
    <!-- Custom js-script -->
    <script <?php echo 'src="' . $this->baseurl . '/templates/' . $this->template . '/js/template.js' . '"' ?>></script>
</body>
</html>
