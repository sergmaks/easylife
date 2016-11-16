<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_carousel
 *
 * Набор констант компонента Карусель
 */

defined('_JEXEC') or die;

// Определение общей дирректории хранения изображений компонента
// administrator/components/com_carousel/images/
define('IMAGES_DIR', JPath::clean( JPATH_COMPONENT_ADMINISTRATOR 
                                   . DIRECTORY_SEPARATOR 
                                   . 'images'                                 
                                   . DIRECTORY_SEPARATOR ));

// Дирректория миниатюр
        // name           // path              
define( 'THUMBNAILS_DIR', IMAGES_DIR . 'thumbnails' . DIRECTORY_SEPARATOR );
define( 'XX_LARGE_DIR',   IMAGES_DIR . 'xx_large'   . DIRECTORY_SEPARATOR );
define( 'X_LARGE_DIR',    IMAGES_DIR . 'x_large'    . DIRECTORY_SEPARATOR );
define( 'LARGE_DIR',      IMAGES_DIR . 'large'      . DIRECTORY_SEPARATOR );
define( 'MIDDLE_DIR',     IMAGES_DIR . 'middle'     . DIRECTORY_SEPARATOR );
define( 'SMALL_DIR',      IMAGES_DIR . 'small'      . DIRECTORY_SEPARATOR );
define( 'X_SMALL_DIR',    IMAGES_DIR . 'x_small'    . DIRECTORY_SEPARATOR );

define('THUMBNAIL_WIDTH',  150); // ширина миниатюры
define('THUMBNAIL_HEIGHT', 100); // высота миниатюры

define('X_LARGE_WIDTH',    2000);
define('X_LARGE_HEIGHT',   1305);

define('LARGE_WIDTH',      1600);
define('LARGE_HEIGHT',     1045);

define('MIDDLE_WIDTH',     1200);
define('MIDDLE_HEIGHT',    790);

define('SMALL_WIDTH',      990);
define('SMALL_HEIGHT',     645);

define('X_SMALL_WIDTH',    767);
define('X_SMALL_HEIGHT',   500);