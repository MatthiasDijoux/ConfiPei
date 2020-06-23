<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mail</title>
</head>
<body>
    <h2>Récapitulatif de la commande</h2>
    <ul><li>
        <p>Bonjour<b>{{$contact['nom']}}</b>votre commande a bien été passé, votre paiement est en attente.</p>
    <p>Veuillez trouver ci-dessous le récapitulatif de votre commande</p> </li>
            <li>
                <b>Récapitulatif de la commande: </b>
                <table>
                    @foreach($contact['order']['products'] as $products)
                    <tbody>
                        <tr>
                            <td>{{$products->name}}</td>
                            <td>{{$products->prix}}</td>
                            <td>{{$products->image}}</td>
                            <td>{{$products->quantite}}</td>

                        </tr>
                    </tbody>
                    @endforeach
                </table>
                <h1>Prix total : <b>{{$contact['prix_total']}}</b></h1>
                <b>Adresse de livraison:</b>
                <table>
                    <tbody>
                        <tr>
                            <td>
                            Pays:{{$contact['adresse_livraison']['pays']}}
                        </td>
                        <td>
                            Adresse:{{$contact['adresse_livraison']['adresse']}}
                        </td>
                        <td>
                            Ville:{{$contact['adresse_livraison']['ville']}}
                        </td>
                        <td>
                            Code Postal:{{$contact['adresse_livraison']['codePostal']}}
                        </td>
                        </tr>
                    </tbody>
                </table>
                <b>Adresse de facturation:</b>
                <table>
                    <tbody>
                        <tr>
                            <td>
                            Pays:{{$contact['adresse_facturation']['pays']}}
                        </td>
                        <td>
                            Adresse:{{$contact['adresse_facturation']['adresse']}}
                        </td>
                        <td>

                            Ville:{{$contact['adresse_facturation']['ville']}}
                        </td>
                        <td>
                            Code Postal:{{$contact['adresse_facturation']['codePostal']}}
                        </td>
                        </tr>
                    </tbody>
                </table>
</body>
</html>