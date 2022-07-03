<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\TypeCampaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use HepplerDotNet\FlashToastr\Flash;

class CatalogueController extends Controller
{
    public function index(Request $request){


        $query = Campaign::select(
            DB::raw('campaigns.*'),
            DB::raw('type_campaigns.id as type_campaigns_ids,
                    type_campaigns.name as type_campaigns_name'),
            DB::raw('projects.id as projects_ids,
                    projects.nom as projects_nom,
                    projects.resume as projects_resume,
                    projects.description as projects_description,
                    projects.logo as projects_logo,
                    projects.affiche as projects_affiche,
                    projects.statut as projects_statut,
                    projects.budget_demande as projects_budget_demande,
                    projects.created_at as projects_created_at'),
            DB::raw("users.id as users_id,
                    users.firstname as users_firstname,
                    users.lastname as users_lastname,
                    users.email as users_email,
                    users.telephone as users_telephone,
                    users.address as users_address,
                    users.created_at as users_created_at,
                    users.photo as users_photo,
                    users.validate as users_validate,
                    users.bio as users_bio,
                    users.date_naissance as users_date_naissance,
                    users.twitter as users_twitter,
                    users.facebook as users_facebook,
                    users.linkedin as users_linkedin,
                    users.instagram as users_instagram,
                    users.photo_identite as users_photo_identite"),
            DB::raw('profils.id as profils_id,
            profils.name as profils_name'),
            DB::raw("DATEDIFF(campaigns.enddate,Now()) as days_left"),
            DB::raw("ROUND(SUM(fundings.montant)/projects.budget_demande * 100) as percentage")
        )
        ->join('type_campaigns','type_campaigns.id','campaigns.type_campaigns_id')
        ->join('projects','projects.id','campaigns.projects_id')
        ->join('users','users.id','projects.users_id')
        ->join('profils','profils.id','users.profils_id')
        ->leftJoin('fundings','fundings.campaigns_id','campaigns.id')
        ->whereIn('campaigns.status',array('echec','valider','success'))
        ->groupBy('campaigns.id');

        if(request('nom') != ''){

            $query = $query->where('nom','LIKE','%'.$request->nom.'%');
        }

        if(request('porteur') != ''){

            $query = $query->where('users.firstname','LIKE','%'.$request->porteur.'%');
        }

        if(request('type') != 'none' && request('type') != null){

            $query = $query->where('type_campaigns_id',$request->type);
        }

        if(request('status') != 'none' && request('status') != null){

            $query = $query->where('status',$request->status);
        }

        // if(request('debut') != '' && request('fin') != ''){

        //     $query = $query->whereBetween('campaigns.created_at',[request('debut'),request('fin')]);
        // }


        $campagnes = $query->paginate(3);
        $types = TypeCampaign::all();

        return view('back_office.catalogue.index',compact('campagnes','types'));
    }
}
