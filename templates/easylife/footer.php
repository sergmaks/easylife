<?php
    
defined('_JEXEC') or die;
    
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
    $classFooter_1 = "col-lg-5 col-md-5 col-sm-5 col-xs-5 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1";
    $classFooter_2 = "col-lg-5 col-md-5 col-sm-5 col-xs-5 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1";
}
// Только footer1 и  footer3
elseif ( $this->countModules('footer1')
        && ! $this->countModules('footer2')
        && $this->countModules('footer3') )
{
    $classFooter_1 = "col-lg-5 col-md-5 col-sm-5 col-xs-5 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1";
    $classFooter_3 = "col-lg-5 col-md-5 col-sm-5 col-xs-5 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1";
}
// Только footer2 и  footer3
elseif ( ! $this->countModules('footer1')
        && $this->countModules('footer2')
        && $this->countModules('footer3') )
{
    $classFooter_2 = "col-lg-3 col-md-3 col-sm-4 col-xs-4 col-lg-offset-5 col-md-offset-5 col-sm-offset-3 col-xs-offset-3";
    $classFooter_3 = "col-lg-3 col-md-3 col-sm-4 col-xs-4 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1";
}
// Только footer3
elseif ( ! $this->countModules('footer1')
        && ! $this->countModules('footer2')
        && $this->countModules('footer3') )
{
    $classFooter_3 = "col-lg-3 col-md-3 col-sm-3 col-xs-3 col-lg-offset-9 col-md-offset-9 col-sm-offset-9 col-xs-offset-9";
} else {
    $classFooter_1
    = $classFooter_2
    = $classFooter_3
    = "col-lg-3 col-md-3 col-sm-4 col-xs-4 col-lg-offset-1 col-md-offset-1";
}
?>

<footer>
    <div class="row" id="footer">
        
        <?php if ( !(empty($classFooter_1)) ) : ?>
            <div class="<?php echo $classFooter_1 ?>">
                <jdoc:include type="modules" name="footer1" style="none"/>
                   <!--
                   <h3>Контакты</h3>
                   <p>Сервис доставки продуктовых корзин EASY LIFE</p>
                   <p>8 (XXX) XXX XX XX <br> easylife@gmail.com</p>
                   -->
            </div>
        <?php endif; ?>
        
        <?php if ( !(empty($classFooter_2)) ) : ?>
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
        <?php endif; ?>
        
        <?php if ( !(empty($classFooter_3)) ) : ?>
            <div class="<?php echo $classFooter_3 ?>">
                <jdoc:include type="modules" name="footer3" style="none"/>
                    <!--
                    <h3>Информация</h3>
                    <p>© 2016 Все права защищены.<br>
                        Сервис доставки продуктовых корзин EASY LIFE</p>
                    -->
            </div>
        <?php endif; ?>
        
            <!-- Button Hide Footer -->
        <div id="button-up" data-toggle="tooltip" data-placement="top" title="Свернуть">
            <span class="fa fa-chevron-up fa-lg"></span>
        </div>
    </div>
</footer>
