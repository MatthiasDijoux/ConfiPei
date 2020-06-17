<?php

namespace App\Http\Controllers;

use App\AdresseModel;
use App\Http\Resources\OrderResource;
use App\OrderModel;
use App\ProductModel;
use App\StatusModel;
use App\User;
use Cartalyst\Stripe\Api\Products;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    //
    function create(Request $request)
    {
        $orders = Validator::make(
            $request->input(),
            [
                'order' => 'required',
                'adresseLivraison' => 'required',
                'adresseFacturation' => 'required',
            ]
        )->validate();
        $user = $request->user();
        DB::beginTransaction();
        try {
            if ($user) {
                $createOrder = new OrderModel;
                $user = $this->addUserToOrder($user, $createOrder);
                $this->addAdresseLivraison($orders['adresseLivraison'], $createOrder, $user);
                $this->addAdresseFacturation($orders['adresseFacturation'], $createOrder, $user);
                $status = StatusModel::with(['orders'])->find(1);

                $createOrder->orderStatus()->associate($status);
                $createOrder->save();
                $this->addProductsToOrder($orders['order'], $createOrder);
            }
        } catch (Exception $e) {
            Db::rollBack();
            return $e->getMessage();
        }
        DB::commit();
        return new OrderResource($createOrder);
    }

    function addAdresseLivraison($adresse, &$order, $user)
    {
        $adresse = $this->createAdresse($adresse, $user);
        $order->adresseLivraison()->associate($adresse);
    }
    function addAdresseFacturation($adresse, &$order, $user)
    {
        $adresse = $this->createAdresse($adresse, $user);
        $order->adresseFacturation()->associate($adresse);
    }

    function createAdresse($_adresse, $user)
    {
        $adresse =  new AdresseModel;
        $adresse->pays = $_adresse['pays'];
        $adresse->ville = $_adresse['ville'];
        $adresse->code_postal = $_adresse['codePostal'];
        $adresse->adresse = $_adresse['pays'];
        $adresse->user()->associate($user);
        $adresse->save();
        return $adresse;
    }
    function addUserToOrder($user, &$order)
    {
        $user = User::where('id', '=', $user->id)->first();
        if (!$user) {
            throw new Exception('Pas connecté');
        }
        $order->user()->associate($user);
        return $user;
    }
    function addProductsToOrder($basket, &$order)
    {
        foreach ($basket as $_order) {
            $quantity = $_order['quantity'];
            $idProduct = $_order['id'];
            $product = ProductModel::find($idProduct);
            if (!$product) {
                throw new Exception('Produits incorrects');
            }
            $order->products()->attach($product, ['quantity' => $quantity]);
        }
    }
    function paiement(Request $request, $id)
    {
        $paiement = Validator::make(
            $request->input(),
            [
                'id' => 'required',
            ]
        )->validate();
        $order = OrderModel::find($id);
        $status = StatusModel::with(['orders'])->find(2);

        $order->orderStatus()->associate($status);
        $order->save();
        try {
            $charge = Stripe::charges()->create([
                'amount' => 20,
                'currency' => 'EUR',
                'source' => $paiement['id'],
                'description' => 'Description',
                'receipt_email' => 'math.dijoux974@hotmail.com',
                'metadata' => [
                    'data1' => 'metadata 1',
                    'data2' => 'metadata 2',
                    'data3' => 'metadata 3'
                ],
            ]);
            return $charge;
        } catch (Exception $e) {
            return $e;
        }
    }
}
