<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_carousel
 *
 * Сабконтроллер для работы с отдельным элементом (слайдом) компонента Слайдер Easy Life
 *
 * Данный класс наследуется от класса JControllerForm (используется работа с формами),
 * который в свою очередь наследуется от JControllerLegacy
 *
 * в имени класса:
 * - Carousel - имя компонента
 * - Controller - указание на класс контроллера
 * - Item - имя котроллера
 */

defined('_JEXEC') or die;

jimport('joomla.filesystem.file'); // Use JFile
jimport( 'joomla.image.image' ); // Use JImage
jimport('joomla.filesystem.folder'); // Use JFolder

class CarouselControllerItem extends JControllerForm {

    // вид, куда будет осуществленно перенаправление после сохранения элемента в базу данных
    protected $view_list = 'slides';
    

    // переопределяем родительский метод сохранения элемента 
    public function save($key = null, $urlVar = null) {

        parent::save($key, $urlVar); 
        
        self::saveImages();
    }
    
    // создание дирректорий и сохранение копий исходнного изображения слайда
    protected function saveImages() {
        
        // проверяем, созданы ли подпапки для изображений
        self::checkDirs( IMAGES_DIR 
                        , THUMBNAILS_DIR 
                        , XX_LARGE_DIR 
                        , X_LARGE_DIR
                        , LARGE_DIR
                        , MIDDLE_DIR
                        , SMALL_DIR
                        , X_SMALL_DIR ); 
          
        // получаем форму из $_POST, а из нее имя файла выбранного изображения
        $input     = JFactory::getApplication()->input; // объект JInput
        $post      = $input->get('jform', array(), 'array'); // 'jform' - имя запрашиваемого параметра, array() - его тип, 'array' - фильтр для проверки типа 
        $imageData = $post['image'];
        
        if ( empty($imageData) ) {
            return false;
        }
        
        // Формируем полный путь к файлу выбранного изображения
        $nativeImage =  JPATH_SITE . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $imageData);
        
        if ( ! JFile::exists($nativeImage) ) {
            return false;
        }
        
        // массив с параметрами копий
        $imageCopies = array (
                                    array (
                                        "width"  => THUMBNAIL_WIDTH,
                                        "height" => THUMBNAIL_HEIGHT,
                                        "dir"    => THUMBNAILS_DIR
                                    ),
                                    array (
                                        "width"  => X_SMALL_WIDTH,
                                        "height" => X_SMALL_HEIGHT,
                                        "dir"    => X_SMALL_DIR
                                    ),
                                    array (
                                        "width"  => SMALL_WIDTH,
                                        "height" => SMALL_HEIGHT,
                                        "dir"    => SMALL_DIR
                                    ),
                                    array (
                                        "width"  => MIDDLE_WIDTH,
                                        "height" => MIDDLE_HEIGHT,
                                        "dir"    => MIDDLE_DIR
                                    ),
                                    array (
                                        "width"  => LARGE_WIDTH,
                                        "height" => LARGE_HEIGHT,
                                        "dir"    => LARGE_DIR
                                    ),
                                    array (
                                        "width"  => X_LARGE_WIDTH,
                                        "height" => X_LARGE_HEIGHT,
                                        "dir"    => X_LARGE_DIR
                                    )
        );
        
        // создаем объект JImage и загружаем в него треубемое изображение
        $jimage = new JImage();
        $jimage->loadFile( $nativeImage );
        
        // Св-ва изображения
        $imageProps = JImage::getImageFileProperties( $nativeImage );
        $imageWidth = $jimage->getWidth();
        
        // нарезаем и сохраняем копии исходного изображения
        foreach ( $imageCopies as $imageCopy ) {
            
            if ( $imageWidth > $imageCopy["width"] ) {
                
                $jimageCopy = $jimage->resize( $imageCopy["width"], $imageCopy["height"], true, JImage::SCALE_INSIDE);
            }
            
            $destFile  = $imageCopy["dir"] . JFile::getName($nativeImage); // Полное имя сохраняемого файла
                   
            if ( ! JFile::exists($destFile) ) {
               
                $jimageCopy->toFile ( $destFile , $imageProps->type );
            }
        }
        
        // если исходное изображение в довольно большом разрешении,
        //  то копируем его c оригинальными параметрами в папку xx_large
        if ( $imageWidth > 2500 ) {
            
            if ( ! JFile::exists(  XX_LARGE_DIR . JFile::getName($nativeImage) ) ) {
                
                JFile::copy ( $nativeImage , 
                              XX_LARGE_DIR . JFile::getName($nativeImage) );
            }
        }
    }
    
    /*
     * функция проверки сущестования и создания дирректорий
     * 
     * @param   array   $dirs список дирректорий для проверки 
     */
    private function checkDirs(...$dirs) {
        
        foreach ( $dirs as $dir ) {
            // Создание дирректории, если она не существует
            if ( ! JFolder::exists( $dir ) ) {
                
                JFolder::create( $dir );
                
                // копируем index.html в созданную дирректорию
                JFile::copy( JPATH_COMPONENT_ADMINISTRATOR . DIRECTORY_SEPARATOR . 'index.html'
                                                                                              , $dir . 'index.html');
            } 
        }
    }
}