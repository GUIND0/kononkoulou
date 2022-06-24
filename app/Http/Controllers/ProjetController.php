<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Funding;
use App\Models\Project;
use App\Models\ProjectSector;
use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProjetController extends Controller
{
    public function list(Request $request){
        $projects = Project::where('users_id',auth()->user()->id)
        ->orderBy('created_at','DESC')
        ->get();

        return view('back_office.projet.list',compact('projects'));
    }

    public function add($id = null){
        $projet = null;
        if ($id != null) {
            $projet = Project::findOrFail($id);
        }

        $sectors = Sector::all();

        return view('back_office.projet.add',compact('projet','sectors'));
    }

    public function overview(Request $request,$id){

        $pj = Project::findOrFail($id);
        $pj->vues = $pj->vues + 1;
        $pj->save();

        $nbre = Funding::select(
            DB::raw('fundings.*'),

        )
        ->join('campaigns','campaigns.id','fundings.campaigns_id')
        ->join('projects','projects.id','campaigns.projects_id')
        ->where('projects.id',$id)
        ->get();
        $nbre = $nbre->count();


        $total = Funding::select(
            DB::raw('SUM(fundings.montant) as total'),
        )
        ->join('campaigns','campaigns.id','fundings.campaigns_id')
        ->join('projects','projects.id','campaigns.projects_id')
        ->where('projects.id',$id)
        ->first();

        $total = $total->total;

        $percentage = Funding::select(
            DB::raw("ROUND(SUM(fundings.montant)/projects.budget_demande * 100) as percentage")
        )
        ->join('campaigns','campaigns.id','fundings.campaigns_id')
        ->join('projects','projects.id','campaigns.projects_id')
        ->where('projects.id',$id)
        ->first();

        $percentage = $percentage->percentage;

        $project = Project::select(
            DB::raw('projects.*'),
            DB::raw("
                CONCAT(users.firstname,' ',users.lastname) as username,
                photo_identite as photo_identite"),
        )
        ->join('users','users.id','projects.users_id')
        ->where('projects.id',$id)
        ->first();



        return view('back_office.projet.overview',compact('project','nbre','total','percentage'));
    }


    public function store(Request $request){

        $id = request('id');
        if ($id != '') {
            $validated = $request->validate([
                'name' => 'required',
                'resume' => 'required',
                'budget' => ['required'],
            ]);
            $projet = Project::findOrFail($id);

        } else {

            $validated = $request->validate([
                'name' => ['required', 'unique:projects,nom'],
                'resume' => 'required',
                'description' => 'required',
                'budget' => ['required'],
                'logo' => 'required',
            ]);
            $projet  = new Project();
        }

        $projet->users_id = auth()->user()->id;
        $projet->nom = $request->name;
        $projet->resume = $request->resume;
        $projet->statut = $request->statut ?? 'en redaction';
        $projet->budget_demande = $this->unformat($request->budget);

        if(isset($request->description)){
            $path = 'uploads/' . $request->file('description')->store('files', 'public');
            $projet->description = $path;
        }

        if(isset($request->logo)){
            $path = 'uploads/' . $request->file('logo')->store('files', 'public');
            $projet->logo = $path;
        }

        if($projet->save()){
            if(isset($request->categories)){
                foreach ($request->categories as $key => $value) {
                    $project_sector = new ProjectSector();
                    $project_sector->sectors_id = $value;
                    $project_sector->projects_id = $projet->id;
                    $project_sector->save();
                }
            }
        }

        Session::flash('success', 'Votre projet a été enregistrer avec succèss !');

        return redirect()->route('projet.list');
    }


    public function delete($id)
    {

        $projet = Project::findOrFail($id);
        $project_sectors = ProjectSector::where('projects_id',$projet->id)->get();
        $campaigns = Campaign::where('projects_id',$projet->id)->get();

        if($project_sectors){
            foreach ($project_sectors as $key => $value) {
                $value->forceDelete();
            }
        }

        if($campaigns){
            Session::flash('error', 'Ce projet ne peut être supprimer!');
            return "fail";
        }

        if ($projet->delete()) {
            Session::flash('success', 'Votre projet a été supprimer avec succèss !');
            return "done";
        } else {
            Session::flash('error', 'Ce projet ne peut être supprimer!');
            return "fail";
        }
        Session::flash('error', 'Ce projet ne peut être supprimer!');
        return "fail";
    }

    private function unformat($number, $force_number = true, $dec_point = '.', $thousands_sep = ' ') {
        if ($force_number) {
            $number = preg_replace('/^[^\d]+/', '', $number);
        } else if (preg_match('/^[^\d]+/', $number)) {
            return false;
        }
        $type = (strpos($number, $dec_point) === false) ? 'int' : 'float';
        $number = str_replace(array($dec_point, $thousands_sep), array(' ', ''), $number);
        settype($number, $type);
        return $number;
    }
}
