<?php
/**
* sublayout products
*
* @package	VirtueMart
* @author Max Milbers
* @link http://www.virtuemart.net
* @copyright Copyright (c) 2014 VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL2, see LICENSE.php
* @version $Id: cart.php 7682 2014-02-26 17:07:20Z Milbo $
*/

defined('_JEXEC') or die('Restricted access');

$doc = JFactory::getDocument();
$doc->addScript( JUri::base(true) . '/templates/easylife/js/slider-menu.js' );


$product = $viewData['product'];
$position = $viewData['position'];
$customTitle = isset($viewData['customTitle'])? $viewData['customTitle']: false;

if ( ! empty($product->customfieldsSorted[$position]) ) {
	?>
		<?php
		if($customTitle and isset($product->customfieldsSorted[$position][0])){
			$field = $product->customfieldsSorted[$position][0]; ?>
		<div class="product-fields-title-wrapper"><span class="product-fields-title"><strong><?php echo vmText::_ ($field->custom_title) ?></strong></span>
			<?php if ($field->custom_tip) {
				echo JHtml::tooltip (vmText::_($field->custom_tip), vmText::_ ($field->custom_title), 'tooltip.png');
			} ?>
		</div> <?php
		}
		$custom_title = null;
                
                // Кол-во шагов в рецепте
                $steps_count = count( $product->customfieldsSorted[$position] ) - 5;
                
                // Инициализация значений для описания блюда
                $day_of_week  = $product->customfieldsSorted[$position][0]->custom_title;
                $dish_name    = $product->customfieldsSorted[$position][1]->display;
                $main_image   = $product->customfieldsSorted[$position][4]->display;                
                $ingredients  = str_replace("\n", "<br>", $product->customfieldsSorted[$position][2]->display);
                $recepie      = str_replace("\n", "<br>", $product->customfieldsSorted[$position][3]->display);
                $steps_images = array();
                
                // скрипт добавления элементов в боковую панель с днями недели
                $days_bar = 'jQuery(function () {'
                            . 'jQuery("#days-bar").append('
                            .    "'<li title=\"" . $day_of_week . "\" data-toggle=\"tooltip\" data-placement=\"right\">"
                            .        "<a href=\"#" . $position . "\" title=\"" . $day_of_week . "\" data-toggle=\"popover\" data-placement=\"right\" data-content=\"" . $dish_name . "\" data-trigger=\"manual\">"
                            .        "<span class=\"fa fa-circle\" aria-hidden=\"true\"></span>"
                            .        "</a>"
                            .    "</li>'"
                            . ");"
                            . 'AnchorHash();'
                            . 'jQuery("#" + idMenu + ">li>a[href*=\"#\"]").on("click", Anchor);'
                            . 'ScrollAnchor("' . $position . '");'
                            .'});';
                
                $doc->addScriptDeclaration($days_bar);
                // Наполнение массива с изображениями шагов
                for ( $i = 5; $i < $steps_count + 5; $i++ ) {
                    $steps_images[] = $product->customfieldsSorted[$position][$i]->display;
                }
                ?>
            <div id="<?php echo $position ?>">
                <table class="dish-slider" align="center">
                    <thead>
                        <tr>
                            <h2><?php echo $day_of_week; ?></h2>
                            <h3><?php echo $dish_name; ?></h3>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td class="main-image"><?php echo $main_image ?></td>
                            <td class="image-desc"><?php echo $ingredients ?><</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="slider-nav prev"><span class="fa fa-chevron-circle-left" aria-hidden="true"></span></td>
                            <td colspan="2" class="slides-container">
                                <div class="steps-images">
                                    <div class="step-image"><?php echo $main_image ?></div><?php foreach ( $steps_images as $step_image ): ?><div class="step-image"><?php echo $step_image ?></div><?php endforeach; ?>                           
                                </div>
                            </td>
                            <td class="slider-nav next"><span class="fa fa-chevron-circle-right" aria-hidden="true"></span></td>
                        </tr>
                    </tbody>
                </table>
            </div>   
        <div class="clear"></div>
<?php
} ?>