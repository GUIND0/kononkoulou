<?php

namespace App\Http\Controllers;

use App\Models\Funding;
use App\Models\Retrait;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use HepplerDotNet\FlashToastr\Flash;
use Illuminate\Support\Facades\Session;

class RetraitController extends Controller
{
    //listTontine
    public function listTontine(Request $request){

        $retraits = Retrait::select(
            DB::raw('retraits.*'),
            DB::raw("CONCAT(users.firstname,' ',users.lastname) as username"),
            DB::raw('tontines.nom as tontine_nom'),
        )
        ->join('users','users.id','retraits.users_id')
        ->join('tontines','tontines.id','retraits.tontines_id')
        ->orderBy('statut')
        ->get();

        return view('back_office.retrait.list',compact('retraits'));
    }

    //retraitStatut
    public function retraitStatut(Request $request,$id){
        $retrait = Retrait::findOrFail($id);
        $retrait->statut = 1;
        $retrait->save();
        Flash::success('Bravo','Opération effectué avec success !');
        return redirect()->back();
    }



    public function listCampagne(Request $request){

        $campagnes = Campaign::select(
            DB::raw("campaigns.*"),
            DB::raw("SUM(fundings.montant) as montant"),
            DB::raw('projects.nom as projects_nom'),
            DB::raw("CONCAT(users.firstname,' ',users.lastname) as username"),
        )
        ->join('fundings','fundings.campaigns_id','campaigns.id')
        ->join('projects','projects.id','campaigns.projects_id')
        ->join('users','users.id','projects.users_id')
        ->get();
        return view('back_office.retrait.listcampagne',compact('campagnes'));
    }


    public function campagneStatut(Request $request,$id){
        $campagne = Campaign::findOrFail($id);
        $campagne->encaissement = 1;
        $campagne->save();
        Flash::success('Bravo','Operation effectuée avec succèss !');
        return redirect()->back();
    }
}
