<header>
<!-- Top Header bar -->
    <div class="row" id="top-bar">
        <!--Mobile head caption-->
        <div class="col-xs-8 col-xs-offset-2 visible-xs" style="font-size: 170%">
            <?php echo '<p align="center">' . $sitename . '</p>' ?>        
        </div>           
        <div id="logo">
            <?php echo $logo ?>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-2 col-lg-offset-4 col-md-offset-4 col-sm-offset-4 hidden-xs" style="padding: 0">
            <?php if ($this->params->get("phoneNumber")) : ?>        
                <span class="fa fa-phone fa-lg" style="margin-right: 10px"></span>
                    <?php echo $this->params->get('phoneNumber');
            endif; ?>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-1">
            <jdoc:include type="modules" name="callme" style="none"/>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 hidden-xs">
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
        <div class="col-xs-1 visible-xs" style="padding:0">
            <a href="#" class="btn" id="menu-trigger" style="font-size: 130%">
                <span class="fa fa-bars"></span>    
            </a>        
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
