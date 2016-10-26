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
    
        // Определение общей дирректории хранения изображений компонента
        // administrator/components/com_carousel/images/
        $imagesDir = JPath::clean( JPATH_COMPONENT_ADMINISTRATOR 
                                   . DIRECTORY_SEPARATOR 
                                   . 'images'                                 
                                   . DIRECTORY_SEPARATOR );  
        // Дирректория миниатюр
        $thumbnailsDir = $imagesDir . 'thumbnails' . DIRECTORY_SEPARATOR;
        
        // Создание общей дирректории  хранения изображений компонента
        if ( ! JFolder::exists($imagesDir) ) {
            JFolder::create($imagesDir);
            // копируем index.html в созданную дирректорию
            JFile::copy( JPATH_SITE . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'index.html'
                                                                                                        , $imagesDir . 'index.html');
        }
        
        // Создание дирректории миниатюр
        if ( ! JFolder::exists( $thumbnailsDir) ) {
            JFolder::create($thumbnailsDir);
            JFile::copy( $imagesDir . 'index.html', $thumbnailsDir. 'index.html');
        }
        
        // получаем форму из $_POST, а из нее имя файла выбранного изображения
        $input     = JFactory::getApplication()->input;
        $post      = $input->get('jform', array(), 'array');
        $imageData = $post['image'];
        
        if ( ! empty($imageData) ) {
            // Формируем полный путь к файлу выбранного изображения
            $nativeImage =  JPATH_SITE . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $imageData);
        
            if ( JFile::exists($nativeImage) ) {
                
                $jimage = new JImage();
                $jimage->loadFile( $nativeImage );
                
                $imageProps = JImage::getImageFileProperties( $nativeImage );
                $imageWidth = $jimage->getWidth();
                
                // Создание миниатюры
                if ( $imageWidth > 150 ) {
                    $thumbnail = $jimage->resize( 150, 100, true, JImage::SCALE_INSIDE);
                    $destFile  = $thumbnailsDir . JFile::getName($nativeImage); // Полное имя сохраняемого файла
                    
                    if ( ! JFile::exists($destFile) ) {
                        $thumbnail->toFile ( $destFile , $imageProps->type );
                    }
                }
            }
        }
 
    }
}