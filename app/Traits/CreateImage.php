<?php 

namespace App\Traits;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Image;

trait CreateImage
{
    public function storeImage($request)
    {   
        $inv_path = $this->images()->get(['path'])->first();
        if(!$inv_path==null){
            $image1 = $this->images()->get();
            $image2=$image1[0];
            $image_path2 = $image1[0]->path;
        }
        $picture = $request->photo;
        $blacklistArray = ['storage', '  '];
        $contains = Str::contains($picture, $blacklistArray);
        if (!$contains && $picture) {
            $image_parts = explode(";base64,", $picture);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $imagename = rand(1, 999) . time() . '.png';
            $Path = "storage/uploads/".$this->getTable()."/" . $this->id . "/";
            File::makeDirectory($Path, 0777, true, true);
            file_put_contents($Path . $imagename, $image_base64);
            $image_path = $Path . $imagename;
            $image_small = new Image();
            $image_small->generateImages($image_path, $imagename, $Path, $picture);
            $this->images()->create(['path' => $image_path]);
          
            if(!$inv_path==null){
                unlink($image_path2);
                $image2->delete();
            } 

        }
        
    }

    public function deleteImage()
    {   
        if($images=$this->images()->where('imageable_id', '=', $this->id)){
            $images->delete();
            $directory = "storage/uploads/".$this->getTable()."/" . $this->id . "/";
            File::deleteDirectory($directory);
            }
    }
}