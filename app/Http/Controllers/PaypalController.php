<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Funding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Facades\PayPal;
use Srmklive\PayPal\Services\PayPal as PayPalClient;


class PaypalController extends Controller
{


    public function storeFunding(Request $request)
    {

        $funding = new Funding();
        $funding->campaigns_id = $request->campaigns_id;
        $funding->users_id = $request->users_id;
        $funding->montant = strval(intval($request->montant)  * 550);
        $funding->anonyme = $request->anonyme == 'on' ? '1' : '0';
        $funding->moyen_de_paiement = "Paypal/VISA";
        if($funding->save()){
            return "done";
        }

        return "fail";

    }

}
