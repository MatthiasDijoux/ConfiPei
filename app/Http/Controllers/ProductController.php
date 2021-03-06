<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\ProducerModel;
use App\ProductModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
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
                "id_producer" => "numeric",
                "fruits" => "",
                "id" => "",
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
        if (isset($datasToAdd['id_producer'])) {
            if ($product && isset($product->producers) && $datasToAdd['id_producer'] != $product->producers->id) {
            } else {

                $producer = ProducerModel::find($datasToAdd['id_producer']);
                if (!$producer) {
                    return 'err';
                }
                $addToDb->producers()->associate($producer);
            }
        } else {

            if (!isset($datasToAdd['id'])) {
                $user = $request->user();
                $producer = ProducerModel::where('id_user', '=', $user->id)->first();
                if (!$producer) {
                    return 'err';
                }
                $addToDb->producers()->associate($producer);
            }
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
            $addToDb->fruits()->detach($detachArray);
        }

        if (!empty($attachArray)) {
            $addToDb->fruits()->attach($attachArray);
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

        if (Storage::disk('images')->put($filename, $decode)) {
            $addToDb->image = $filename;
            $addToDb->save();
        }

        return new ProductResource($product);
    }

    public function getOfProducer(Request $request)
    {
        $user = $request->user();
        $products = ProductModel::with(['fruits'])->whereHas('producers', function (Builder $query) use ($user) {
            $query->where('id_user', '=', $user->id);
        })->get();
        return ProductResource::collection($products);
    }
}
