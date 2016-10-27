<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_carousel
 *
 * Сабконтроллер для работы с отдельным элементом компонента Карусель
 *
 * Данный класс наследуется от класса JControllerForm (используется работа с формами),
 * который в свою очередь наследуется от JControllerLegacy
 * But no form was presented to user in this request, 
 * it just stores item (the ID of the article) in user's session variable 
 * and redirects to master controller
 *
 * в имени класса:
 * - Carousel - имя компонента
 * - Controller - указание на класс контроллера
 * - Item - имя котроллера
 */

defined('_JEXEC') or die;

jimport('joomla.filesystem.file');
jimport( 'joomla.image.image' );
			
if ( ! class_exists('JFolder') ) {
    jimport('joomla.filesystem.folder');
}

class CarouselControllerItem extends JControllerForm {

    // вид, куда будет осуществленно перенаправление после сохранения элемента в базу данных
    protected $view_list = 'slides';
    
    public function save($key = null, $urlVar = null) {

        parent::save($key, $urlVar); 
        
        self::saveImages();
    }
    
    protected function saveImages() {
        
        // проверяем, созданы ли подпапки для изображений
        self::checkDirs( IMAGES_DIR , THUMBNAILS_DIR ); 
          
        // получаем форму из $_POST, а из нее имя файла выбранного изображения
        $input     = JFactory::getApplication()->input;
        $post      = $input->get('jform', array(), 'array');
        $imageData = $post['image'];
        
        if ( empty($imageData) ) {
            return false;
        }
        
        // Формируем полный путь к файлу выбранного изображения
        $nativeImage =  JPATH_SITE . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $imageData);
        
        if ( JFile::exists($nativeImage) ) {
                
            $jimage = new JImage();
            $jimage->loadFile( $nativeImage );
                
            $imageProps = JImage::getImageFileProperties( $nativeImage );
            $imageWidth = $jimage->getWidth();
                
            // Создание миниатюры
            if ( $imageWidth > THUMBNAIL_WIDTH ) {
                $thumbnail = $jimage->resize( THUMBNAIL_WIDTH, THUMBNAIL_HEIGHT, true, JImage::SCALE_INSIDE);
            }
            $destFile  = THUMBNAILS_DIR . JFile::getName($nativeImage); // Полное имя сохраняемого файла
                   
            if ( ! JFile::exists($destFile) ) {
                $thumbnail->toFile ( $destFile , $imageProps->type );
            }
                
        }
    }
    
    private function checkDirs(...$dirs) {
        
        foreach ($dirs as $dir) {
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