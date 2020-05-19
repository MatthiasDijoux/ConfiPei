<?php

namespace App\Http\Controllers;

use App\FruitModel;
use App\Http\Resources\addProductResource;
use App\Http\Resources\ProductResource;
use App\ProducerModel;
use App\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    //
    function index()
    {
        return view('home.main');
    }
    function getProduct()
    {
        $products =  ProductModel::with([
            'producers',
            'rewards',
            'fruits',
        ])->get();
        return  ProductResource::collection($products);
    }


    function createOrUpdate(Request $request)
    {
        $datasToAdd = Validator::make(
            $request->input(),
            [
                "name" => "required",
                "prix" => "required",
                "id_producer" => "required|numeric",
                "fruits" => "",
                "id" => "",
                "oldFruit" => "",
            ],
            [
                'required' => 'Le champ :attribute est requis'
            ]
        )->validate();
        $product = ProductModel::with(['fruits', 'producers'])->find($datasToAdd['id']);
        if (!$product) {
            $addToDb = new ProductModel;
            Log::debug('CreateProduct');
        } else {
            $addToDb = $product;
            Log::debug('UpdateProduct');
        }



        $addToDb->name = $datasToAdd['name'];
        $addToDb->prix = $datasToAdd['prix'];
        if ($product && isset($product->producers) && $datasToAdd['id_producer'] != $product->producers->id) {
        } else {

            $producer = ProducerModel::find($datasToAdd['id_producer']);
            if (!$producer) {
                return 'err';
            }
            $addToDb->producers()->associate($producer);
        }

        $addToDb->save();

        $confiFruits = [];
        $clientFruits = [];
        $detachArray = [];
        $attachArray = [];

        foreach ($datasToAdd['fruits'] as $_clientFruit) {
            $clientFruits[] = $_clientFruit['id'];
        }
        if ($product && isset($product->fruits)) {
            foreach ($product->fruits as $_fruits) {
                $confiFruits[] = $_fruits->id;
            }
        }
        foreach ($clientFruits as $_clientFruit) {
            if (!in_array($_clientFruit, $confiFruits)) {
                $attachArray[] = $_clientFruit;
            }
        }
        foreach ($confiFruits as $_confiFruit) {
            if (!in_array($_confiFruit, $clientFruits)) {
                $detachArray[] = $_confiFruit;
            }
        }
        if (!empty($detachArray)) {
            $product->fruits()->detach($detachArray);
        }
        if (!empty($attachArray)) {
            $product->fruits()->attach($attachArray);
        }

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
            $addToDb->image = storage_path('\images\\') . $filename;
            $addToDb->save();
        }

        return new ProductResource($product);
    }
}
