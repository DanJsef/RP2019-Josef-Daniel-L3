<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Photo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Image;

class PhotosController extends Controller
{
    public function storePhoto(Request $request) {
        $this->validate($request, [
            'seo_name' => 'required|unique:photos',
            'image' => 'required|image'
        ]);

        $fileNameExt = $request->file('image')->getClientOriginalExtension();
        $fileNameStore = $request->input('seo_name').'.'.$fileNameExt;

        //Resize
        $imgHighRes = Image::make($request->file('image'));
        $imgMidRes = Image::make($request->file('image'));
        $imgLowRes = Image::make($request->file('image'));
        $imgPrev = Image::make($request->file('image'));

        $width = Image::make($request->file('image'))->width();
        $height = Image::make($request->file('image'))->height();

        function resizer($highRes, $highResW, $highResH, $midRes, $midResW, $midResH, $lowRes, $lowResW, $lowResH, $prev, $prevW, $prevH) {
            $highRes->resize($highResW, $highResH, function ($constraint) {
                $constraint->aspectRatio();
            });
            $midRes->resize($midResW, $midResH, function ($constraint) {
                $constraint->aspectRatio();
            });
            $lowRes->resize($lowResW, $lowResH, function ($constraint) {
                $constraint->aspectRatio();
            });
            $prev->resize($prevW, $prevH, function ($constraint) {
                $constraint->aspectRatio();
            })->crop(400, 400);
        }

        if ($width > $height) {
            resizer($imgHighRes, 1920, null, $imgMidRes, 720, null, $imgLowRes, 420, null, $imgPrev, null, 400);
        }
        if ($height > $width) {
            resizer($imgHighRes, null, 1920, $imgMidRes, null, 720, $imgLowRes, null, 420, $imgPrev, 400, null);
        }
        if ($height == $width) {
            resizer($imgHighRes, 1280, 1280, $imgMidRes, 720, 720, $imgLowRes, 420, 420, $imgPrev, 400, 400);
        }


        Storage::disk('local')->put('public/images/'.$fileNameStore, $imgHighRes->encode());
        Storage::disk('local')->put('public/images/m_'.$fileNameStore, $imgMidRes->encode());
        Storage::disk('local')->put('public/images/l_'.$fileNameStore, $imgLowRes->encode());
        Storage::disk('local')->put('public/images/p_'.$fileNameStore, $imgPrev->encode());

        $photo = new Photo([
            'seo_name' => $request->input('seo_name'),
            'file_name' => $fileNameStore,
        ]);
        $photo->save();
    }

    public function getPhotos() {
        return response(Photo::all()->jsonSerialize(), Response::HTTP_OK);
    }

    public function deletePhoto(Request $request) {

        $photo = DB::table('photos')->where('id', $request->input('id'))->first();
        $fileName = $photo->file_name;

        Storage::disk('local')->delete('public/images/' . $fileName);
        Storage::disk('local')->delete('public/images/m_' . $fileName);
        Storage::disk('local')->delete('public/images/l_' . $fileName);
        Storage::disk('local')->delete('public/images/p_' . $fileName);

        DB::table('photos')->where('id', $request->input('id'))->delete();

        return response()->json([
            'message' => 'Photo deleted'
        ],201);
    }
}
