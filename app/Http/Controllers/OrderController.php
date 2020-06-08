<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\OrderModel;
use App\ProductModel;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    //
    function sendOrder(Request $request)
    {
        $orders = Validator::make(
            $request->input(),
            [
                'order' => 'required',
            ]
        )->validate();
        //recup user, lier à la commande, verifier les confitures, rollback si confiture existe pas, verification à plusieurs niveaux, manyToMany, rajouter quantité
        //Créer transaction 
        //Récuperer user
        //Créer une nouvelle commande pour cet Utilisateur
        //Y attacher les différentes confitures AVEC quantité
        //pour chaque attach verifier l'existence des confitures, si existe pas : break transaction
        $user = $request->user();
        DB::beginTransaction();
        try {
            if ($user) {
                $createOrder = new OrderModel;
                $loggedUser = User::where('id', '=', $user->id)->first();
                if (!$loggedUser) {
                    throw new Exception('Pas connecté');
                }
                $createOrder->user()->associate($loggedUser);
                $createOrder->save();
                foreach ($orders['order'] as $_order) {
                    $quantity = $_order['quantity'];
                    $idProduct = $_order['id'];
                    $product = ProductModel::find($idProduct);
                    if (!$product) {
                        throw new Exception('Produits incorrects');
                    }
                    $createOrder->products()->attach($product, ['quantity' => $quantity]);
                }
            }
        } catch (Exception $e) {
            Db::rollBack();
            return $e->getMessage();
        }
        DB::commit();
        return new OrderResource($createOrder);
    }
}
