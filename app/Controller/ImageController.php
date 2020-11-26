<?php


namespace App\Controller;

use Core\AbstractController;
use Intervention\Image\ImageManager as Image;

class ImageController extends AbstractController
{
protected static $_imagePath;

    public function index()
    {

        return $this -> imageAction();
    }

    public function imageAction()
    {
        self::$_imagePath = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'images/';
        $source = self::$_imagePath . 'pic.jpeg';
        $result = self::$_imagePath . 'pic_new.jpeg';

        $image = (new Image) -> make($source)
            ->resize(null,500, function ($image){
                $image->aspectRatio();
            })
            ->rotate(45)
            -> save($result,80) ;

        self::watermark($image);

        echo $image->response('png');
    }

    public function watermark(\Intervention\Image\Image $image)
    {
        $image->text(
            "Просто картинка\nДля примера",
            $image->width() / 2,
            $image->height() / 2,
            function ($font) {
                $font->file(self::$_imagePath . 'arial.ttf')->size(32);
                $font->color(array(0, 0, 0));
                $font->align('right');
            });
    }

}