<?php

namespace App\Http\Controllers;
use App\Models\Campaign;
use App\Models\Funding;
use App\Models\Project;
use App\Models\TypeCampaign;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BackOfficeController extends Controller
{

    public function aide(Request $request){
        return view('back_office.aide.index');
    }


    public function admin(Request $request){

        $nbre_projets = Project::all()->count();
        $nbr_campagne = Campaign::all()->count();
        $nbr_campagne_en_cours = Campaign::where('status','en_cours')->get()->count();
        $nbr_campagne_echoues = Campaign::where('status','echec')->get()->count();
        $nbr_campagne_valider = Campaign::where('status','success')->get()->count();
        $nbr_contributions = Funding::all()->count();
        $montant_total = Funding::all()->sum('montant');
        $montant_previsionnel = Campaign::select(
            DB::raw('SUM(projects.budget_demande) as montant')
        )->join('projects','projects.id','campaigns.projects_id')->first()->montant;
        $nbre_utilisateur = User::all()->count();
        $total_vues = Project::all()->sum('vues');


        $campaign = Campaign::select(
            DB::raw('COUNT(campaigns.id) as nombre'),
            DB::raw('sectors.name as name')
        )
        ->join('projects','projects.id','campaigns.projects_id')
        ->join('sectors_has_projects','sectors_has_projects.sectors_id','projects.id')
        ->join('sectors','sectors.id','sectors_has_projects.projects_id')
        ->groupBy('name')
        ->get();

        $rsCampaign = [];
        foreach ($campaign as $key => $value) {
            $rsCampaign[$key]['nombre'] = $value->nombre;
            $rsCampaign[$key]['name'] = $value->name;
        }


        $campagnes = Campaign::select(
            DB::raw('COUNT(campaigns.id) as nombre'),
            DB::raw('type_campaigns.name as name')
        )
        ->join('type_campaigns','type_campaigns.id','campaigns.type_campaigns_id')
        ->groupBy('name')
        ->get();

        $rsTypeCampaign = [];
        foreach ($campagnes as $key => $value) {
            $rsTypeCampaign[$key]['nombre'] = $value->nombre;
            $rsTypeCampaign[$key]['name'] = $value->name;
        }


        $user = User::select(
            DB::raw('COUNT(users.id) as nombre'),
            DB::raw('pays.libelle as libelle')
        )
        ->join('pays','pays.id','users.pays_id')
        ->groupBy('libelle')
        ->get();

        $rsUser = [];
        foreach ($user as $key => $value) {
            $rsUser[$key]['nombre'] = $value->nombre;
            $rsUser[$key]['libelle'] = $value->libelle;
        }

        //Total des contributions par mois
        $mois_fr = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];

        $_contributions = Funding::select(DB::raw('YEAR(fundings.created_at) as year'), DB::raw('MONTH(fundings.created_at) as month'), DB::raw('SUM(fundings.montant) as nombre'))
            ->whereYear('fundings.created_at', date('Y'))
            ->groupBy('year', 'month')
            ->orderBy('month', 'asc');


        $_contributions =  $_contributions->get();

        $contributions_par_mois = [];
        for ($mois = 1; $mois <= 12; $mois++) {
            $_total = 0;
            foreach ($_contributions as $_contribution) {
                if ($_contribution->month == $mois) {
                    $_total = $_contribution->nombre;
                }
            }
            $contributions_par_mois[] = [
                'nombre' => $_total,
                'mois' => $mois_fr[$mois - 1],
                "color" => "#7367F0"
            ];
        }


        return view("back_office.admin.index",compact(
            'nbr_campagne_en_cours',
            'nbr_campagne_echoues',
            'nbr_campagne',
            'nbr_campagne_valider',
            'montant_total',
            'nbre_utilisateur',
            'nbr_contributions',
            'montant_previsionnel',
            'nbre_projets',
            'total_vues',
            'rsCampaign',
            'rsTypeCampaign',
            'rsUser',
            'contributions_par_mois'
        ));

    }


    public function index(Request $request){

        $project = Campaign::select(
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
            DB::raw('users.id as users_id,
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
                    users.photo_identite as users_photo_identite'),
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
        ->groupBy('campaigns.id')
        ->inRandomOrder()->first();

        $nbr_campagne_en_cours = Campaign::where('status','en_cours')->get()->count();
        $nbr_campagne_echoues = Campaign::where('status','echec')->get()->count();
        $nbr_projet_finance = Campaign::where('status','success')->get()->count();
        $nbr_contributions = Funding::all()->count();

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
        ->latest('created_at')->limit(5)->get();



        return view("back_office.home.index",compact(
            'project',
            'nbr_campagne_en_cours',
            'nbr_campagne_echoues',
            'nbr_projet_finance',
            'nbr_contributions',
            'contributions'

        ));
    }


    public function accueil(Request $request){
        return view("back_office.home.accueil");
    }
}
