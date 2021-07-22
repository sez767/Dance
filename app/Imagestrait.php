<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Imagick;
use Symfony\Component\Console\Input\Input;
use Request;

trait Imagestrait
{
    public function generateImages($image_path, string $name, $Path, $picture): void
    {
        // Create the 120px width image
       // dd(File::isDirectory( $Path . '/' . '120'));
        if (!File::isDirectory( $Path . '/' . '120')) {
            File::makeDirectory($Path . '/' . '120', 0777, true, true);
            //dd($Path);


            // phpinfo();

            // $image = new Image;
            // $image1=file_get_contents($image_path);
            //phpinfo();
            //$im = new Imagick("test.png");
            $image = new Imagick($image_path);
            $image1 = new Imagick($image_path);
            $width = $image->getImageWidth();
            $image1->cropThumbnailImage(120, 120);
            $width1 = $image1->getImageWidth();
            //dd($width1);
            //$image1->scale(50);
            //$image1->save('image2.png');
            // dd($image_path);
            //$image=imagecreatetruecolor(120,120);
            file_put_contents($Path . '120' . '/' . $name, $image1);
            //dd($picture);
            /*$image= Image::make($picture)
                ->resize(120, 50)
                ->save(  $name );*/
            //$image=$request->
            //dd('1');}
            // Create the 325px width image
        }
        else{
            Storage::deleteDirectory( $Path . '/' . '120');
            //Storage::cleanDirectory( $Path . '/' . '120');
            $files =   Storage::allFiles(public_path() . $Path . '/' . '120');
            Storage::delete($files);
            //dd('');
            File::makeDirectory($Path . '/' . '120', 0777, true, true);
            $image = new Imagick($image_path);
            $image1 = new Imagick($image_path);
            $width = $image->getImageWidth();
            $image1->cropThumbnailImage(120, 120);
            $width1 = $image1->getImageWidth();
            file_put_contents($Path . '120' . '/' . $name, $image1);
        }
        if (!file_exists(public_path() . $Path . '/' . '50')) {
            File::makeDirectory($Path . '/' . '50', 0777, true, true);
            //dd($Path);


            // phpinfo();

            // $image = new Image;
            // $image1=file_get_contents($image_path);
            //phpinfo();
            //$im = new Imagick("test.png");
            $image = new Imagick($image_path);
            $image1 = new Imagick($image_path);
            $width = $image->getImageWidth();
            $image1->cropThumbnailImage(50, 50);
            $width1 = $image1->getImageWidth();
            //dd($width1);
            //$image1->scale(50);
            //$image1->save('image2.png');
            // dd($image_path);
            //$image=imagecreatetruecolor(120,120);
            file_put_contents($Path . '50' . '/' . $name, $image1);
            //dd($picture);
            /*$image= Image::make($picture)
                ->resize(120, 50)
                ->save(  $name );*/
            //$image=$request->
            //dd('1');}
            // Create the 325px width image
        }
        /*if (!file_exists(public_path() . $path . '/' . '325')) {
            File::makeDirectory(public_path() . $path . '/' . '325', 0777, true);
        }

        Image::make(public_path() . $path . '/' . $name . '.' . '.png')
            ->resize(325, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save(public_path() . $path . '/325/' . $name . '.webp', 100, 'webp');

        // Create the 1024px width image
        if (!file_exists(public_path() . $path . '/' . '1024')) {
            File::makeDirectory(public_path() . $path . '/' . '1024', 0777, true);
        }

        Image::make(public_path() . $path . '/' . $name . '.' . '.png')
            ->resize(1024, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save(public_path() . $path . '/1024/' . $name . '.webp', 90, 'webp');
    }*/
    }
}
