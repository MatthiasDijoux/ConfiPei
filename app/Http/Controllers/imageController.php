<?php

namespace App\Http\Controllers;

use App\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class imageController extends Controller
{
    function imageUpload(Request $request, $id)
    {
        $img = $request->get('image');
        $exploded = explode(",", $img);

        if (str::contains($exploded[0], 'gif')) {
            $ext = 'gif';
        } else if (str::contains($exploded[0], 'png')) {
            $ext = 'png';
        } else {
            $ext = 'jpg';
        }
        $decode = base64_decode($exploded[1]);
        $filename = str::random() . "." . $ext;
        $path =  storage_path('\images\\') . $filename;

        if (file_put_contents($path, $decode)) {
            $dataPhoto = ProductModel::find($id);
            $dataPhoto->image = storage_path('\images\\') . $filename;
            $dataPhoto->save();
            return $dataPhoto;
        }
    }
}
