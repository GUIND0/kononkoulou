<?php

namespace App\Http\Controllers;

use App\Models\Funding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContributionController extends Controller
{
    public function index(Request $request){

        $contributions = Funding::select(
            DB::raw('fundings.*'),
            DB::raw('campaigns.id as campaigns_id,
                    campaigns.startdate as campaigns_startdate,
                    campaigns.enddate as campaigns_enddate,
                    campaigns.status as campaigns_status,
                    campaigns.recompense as campaigns_recompense,
                    campaigns.photo_recompense as campaigns_photo_recompense'),
            DB::raw("users.id as users_id,
                    CONCAT(users.firstname,' ',users.lastname) as username,
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
            //DB::raw('type_campaigns.id as type_campaigns_ids,type_campaigns.name as type_campaigns_name'),
            DB::raw('projects.id as projects_ids,
                    projects.nom as projects_nom,
                    projects.resume as projects_resume,
                    projects.description as projects_description,
                    projects.logo as projects_logo,
                    projects.affiche as projects_affiche,
                    projects.statut as projects_statut,
                    projects.budget_demande as projects_budget_demande,
                    projects.created_at as projects_created_at'),
        )
        ->join('campaigns','campaigns.id','fundings.campaigns_id')
        ->join('projects','projects.id','campaigns.projects_id')
        ->join('users','users.id','fundings.users_id')
        ->latest('created_at')->limit(100)->get();

        return view('back_office.contribution.index',compact('contributions'));
    }

    public function mine(Request $request){

        $contributions = Funding::select(
            DB::raw('fundings.*'),
            DB::raw('campaigns.id as campaigns_id,
                    campaigns.startdate as campaigns_startdate,
                    campaigns.enddate as campaigns_enddate,
                    campaigns.status as campaigns_status,
                    campaigns.recompense as campaigns_recompense,
                    campaigns.photo_recompense as campaigns_photo_recompense'),
            DB::raw("users.id as users_id,
                    CONCAT(users.firstname,' ',users.lastname) as username,
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
            //DB::raw('type_campaigns.id as type_campaigns_ids,type_campaigns.name as type_campaigns_name'),
            DB::raw('projects.id as projects_ids,
                    projects.nom as projects_nom,
                    projects.resume as projects_resume,
                    projects.description as projects_description,
                    projects.logo as projects_logo,
                    projects.affiche as projects_affiche,
                    projects.statut as projects_statut,
                    projects.budget_demande as projects_budget_demande,
                    projects.created_at as projects_created_at'),
        )
        ->join('campaigns','campaigns.id','fundings.campaigns_id')
        ->join('projects','projects.id','campaigns.projects_id')
        ->join('users','users.id','fundings.users_id')
        ->where('fundings.users_id',auth()->user()->id)
        ->latest('created_at')->limit(100)->get();

        return view('back_office.contribution.mine',compact('contributions'));
    }
}
