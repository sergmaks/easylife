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
$this->direction = $doc->direction;

// Output as HTML5
$doc->setHtml5(true);

// Getting params from template
$params = $app->getTemplate(true)->params;

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->get('sitename');

/*
 * Add stylesheets
 */
// Bootstrap 3 stylesheet
$doc->addStyleSheet ( $this->baseurl . '/templates/' . $this->template . '/css/bootstrap.min.css' );
// Use of Google Font
if ($this->params->get('googleFont'))
{
    $doc->addStyleSheet('//fonts.googleapis.com/css?family=' . $this->params->get('googleFontName'));
}
// Template stylesheet
$doc->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/template.css');
// Custom overrides of Bootstrap 3 CSS
$doc->addStyleSheet ( $this->baseurl . '/templates/' . $this->template . '/css/overrides.css' );
// Media queries
$doc->addStyleSheet ( $this->baseurl . '/templates/' . $this->template . '/css/media.css' );

// Use Fontawesome CDN
$doc->addScript ( "https://use.fontawesome.com/7f0000df30.js" );
// Add Bootstrap 3 script
$doc->addScript( $this->baseurl . '/templates/' . $this->template . '/js/bootstrap.min.js');

/*
// Цвет шаблона
if ($this->params->get('templateColor'))
{
    // встроенный инлайн-стиль
    $doc->addStyleDeclaration("
	body.site {
		border-top: 3px solid " . $this->params->get('templateColor') . ";
		background-color: " . $this->params->get('templateBackgroundColor') . ";
	}
	a {
		color: " . $this->params->get('templateColor') . ";
	}
	.nav-list > .active > a,
	.nav-list > .active > a:hover,
	.dropdown-menu li > a:hover,
	.dropdown-menu .active > a,
	.dropdown-menu .active > a:hover,
	.nav-pills > .active > a,
	.nav-pills > .active > a:hover,
	.btn-primary {
		background: " . $this->params->get('templateColor') . ";
	}");
}

// Adjusting content width
if ($this->countModules('position-7') && $this->countModules('position-8'))
{
	$span = "span6";
}
elseif ($this->countModules('position-7') && !$this->countModules('position-8'))
{
	$span = "span9";
}
elseif (!$this->countModules('position-7') && $this->countModules('position-8'))
{
	$span = "span9";
}
else
{
	$span = "span12";
}
*/
// Font color
if ($this->params->get('fontColor'))
{
    // встроенный инлайн-стиль
    $doc->addStyleDeclaration("
	    html,body,
	    .slide-caption,
	    .button-action,
	    #button-down,
	    #button-up {
		    color: " . $this->params->get('fontColor') . ";
	    }");
}

// Logo file
$logo = '<img src="' . JUri::root() . $this->params->get('logoFile') . '" alt="' . $sitename . '" />';
?>

<!---------- HTML starts ------------>
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
    <!-- Top bar -->
		<div class="row" id="top-bar">
           <div id="logo">
               <?php echo $logo ?>
            </div>
		   <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-lg-offset-4 col-md-offset-4 col-sm-offset-4 col-xs-offset-4" style="padding: 0">
                        <?php if ($this->params->get("phoneNumber")) : ?>        
                            <span class="fa fa-phone fa-lg" style="margin-right: 10px"></span>
                        <?php echo $this->params->get('phoneNumber');
                        endif; 
                        ?>
		    </div>
		   <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
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
		    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-lg-offset-6 col-md-offset-6 col-sm-offset-6 col-xs-offset-6">
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
		    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
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
             <jdoc:include type="modules" name="carousel" style="none"/>
             <!-- Carousel -->
             <div id="carousel" class="carousel slide" data-interval="6000" data-ride="carousel" data-pause="none">
                 <!-- Indicators  -->
                 <ol class="carousel-indicators">
                     <li data-target="#carousel" data-slide-to="0" class="active"></li>  
                     <li data-target="#carousel" data-slide-to="1"></li>
                     <li data-target="#carousel" data-slide-to="2"></li>
                 </ol>
                 <!-- Slides -->
                 <div class="carousel-inner">
      <!-- 1st Slide -->   
	            <div class="active item">
                        <div class="back" <?php echo 'style="background-image: url(\'' . $this->baseurl . '/templates/' . $this->template . '/images/x-large/1.jpg\')"'?>>
                           
                            <div class="overlay">
                                <div class="slide-caption">
                                  <span class="fa-stack icon">
		                                <i class="fa fa-circle-o fa-stack-2x"></i>
		                                <i class="fa fa-question fa-stack-1x"></i>
		                            </span>
                                    <span class="fa fa-circle-o"></span> Что приготовить?<br>
                                    <span class="fa fa-circle-o"></span> Где это все купить?<br>
                                    <span class="fa fa-check"></span> Доверьте это нам!
                                </div>
                            </div>
                        </div>
                    </div>
	   <!-- 2nd Slide --> 
                     <div class="item">
                         <div class="back" <?php echo 'style="background-image: url(\'' . $this->baseurl . '/templates/' . $this->template . '/images/x-large/2.jpg\')"'?>>
                             <div class="overlay">
                                 <div class="slide-caption">
                                    <span class="fa-stack icon">
		                                <i class="fa fa-circle-o fa-stack-2x"></i>
		                                <i class="fa fa-phone fa-stack-1x"></i>
		                            </span>
                                     <span style="font-size: 77%">Сделайте заказ и каждый день Вы будете наслаждаться уникальным блюдом, получая удовольствие от процесса приготовления!</span>
                                </div>
                             </div>
                         </div>
                     </div>
	   <!-- 3rd Slide --> 
                     <div class="item">
                         <div class="back" <?php echo 'style="background-image: url(\'' . $this->baseurl . '/templates/' . $this->template . '/images/x-large/3.jpg\')"'?>>
                             <div class="overlay">
                                 <div class="slide-caption">
		                            <span class="fa-stack icon">
		                                <i class="fa fa-circle-o fa-stack-2x"></i>
		                                <i class="fa fa-thumbs-o-up fa-stack-1x"></i>
		                               </span>
                                    Готовить с нами быстро, просто и вкусно!<br>
                                    Easy Life - оставь время для себя!
                                </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <!-- Carousel Navigation -->
                 <a href="#carousel" class="carousel-control left" data-slide="prev">
                     <span class="glyphicon glyphicon-chevron-left"></span>
                 </a>
                 <a href="#carousel" class="carousel-control right" data-slide="next">
                     <span class="glyphicon glyphicon-chevron-right"></span>
                 </a>
                 
                 <!-- Buttons Call to Action -->
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
         </div>
        <jdoc:include type="modules" name="article" style="none"/>
    </main>
    <footer>
            <div class="row" id="footer">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1">
                   <jdoc:include type="modules" name="footer1" style="none"/>
                   <h3>Контакты</h3>
                   <p>Сервис доставки продуктовых корзин EASY LIFE</p>
                   <p>8 (XXX) XXX XX XX <br> easylife@gmail.com</p>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1">
                    <jdoc:include type="modules" name="footer2" style="none"/>
                    <h3>Следите за нами</h3>
                    <p><a href="https://vk.com" target="_blank">Вконтакте</a><br>
                       <a href="https://instagram.com" target="_blank">Instagram</a><br>
                       <a href="https://facebook.com" target="_blank">Facebook</a><br>
                       <a href="https://ok.ru" target="_blank">Одноклассники</a>
                    </p>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1">
                    <jdoc:include type="modules" name="footer3" style="none"/>
                    <h3>Информация</h3>
                    <p>© 2016 Все права защищены.<br>
                        Сервис доставки продуктовых корзин EASY LIFE</p>
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
