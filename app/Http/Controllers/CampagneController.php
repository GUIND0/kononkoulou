<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Project;
use App\Models\TypeCampaign;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;

class CampagneController extends Controller
{
    public function list(Request $request){
        $campagnes = DB::table('campaigns')
        ->select('campaigns.*')
        ->join('projects', 'projects.id', '=', 'campaigns.projects_id')
        ->where('projects.users_id', auth()->user()->id)
        ->get();
        $campagnes->map(function($campagne){
            $campagne->project = Project::where('id',$campagne->projects_id)->first();
            $campagne->type = TypeCampaign::where('id',$campagne->type_campaigns_id)->first();
            return $campagne;
        });

        return view('back_office.campagne.list',compact('campagnes'));
    }

    public function admin(Request $request){
        $campagnes = $campagnes = Campaign::select(
            DB::raw("*")
        )
        ->join('projects', 'projects.id', '=', 'campaigns.projects_id')
        ->get();
        $campagnes->map(function($campagne){
            $campagne->project = Project::where('id',$campagne->projects_id)->first();
            $campagne->project_id = Project::where('id',$campagne->projects_id)->pluck('id')->first();
            $campagne->type = TypeCampaign::where('id',$campagne->type_campaigns_id)->pluck('name')->first();
            return $campagne;
        });

        return view('back_office.campagne.admin',compact('campagnes'));
    }


    public function checklist(Request $request){
        $campagnes = Campaign::select(
            DB::raw("*")
        )
        ->join('projects', 'projects.id', '=', 'campaigns.projects_id')
        ->where('status','en_cours')
        ->get();
        $campagnes->map(function($campagne){
            $campagne->project = Project::where('id',$campagne->projects_id)->first();
            $campagne->type = TypeCampaign::where('id',$campagne->type_campaigns_id)->first();
            return $campagne;
        });

        return view('back_office.campagne.check',compact('campagnes'));


    }

    public function add(){
        $projects = Project::where('users_id',auth()->user()->id)->get();
        $types = TypeCampaign::all();

        return view('back_office.campagne.add',compact('projects','types'));
    }

    public function store(Request $request){

        $campagne = new Campaign();
        if(request('type') != null && request('type') == 1){

            $validated = $request->validate([
                'projet' => 'required',
                'type' => 'required',
                'recompense' => ['required'],
            ]);

            $old = Campaign::where('projects_id',$request->projet)->get();
            $old = Campaign::where('projects_id',$request->projet)->whereIn('status',array('en_cours','valider','success'))->get();
            if($old != '[]'){
                Session::flash('error', 'Ce projet ne peut plus être soumis à une campagne de financement participatif !');
                return redirect()->route('campagne.list');
            }
            $campagne->projects_id = $request->projet;
            $campagne->type_campaigns_id = $request->type;
            $campagne->recompense = $request->recompense;
            $campagne->startdate =  date('Y-m-d');
            $campagne->enddate =  date('Y-m-d',strtotime("+30 days"));
            $campagne->status =  'en_cours';
            if(isset($request->photo_recompense)){
                $path = 'uploads/' . $request->file('photo_recompense')->store('files', 'public');
                $campagne->photo_recompense = $path;

            }

        }

        if(request('type') != null && request('type') == 2){
            $validated = $request->validate([
                'projet' => 'required',
                'type' => 'required',
            ]);
            $old = Campaign::where('projects_id',$request->projet)->whereIn('status',array('en_cours','valider','success'))->get();
            if($old != '[]'){
                Session::flash('error', 'Ce projet ne peut plus être soumis à une campagne de financement participatif !');
                return redirect()->route('campagne.list');
            }
            $campagne->projects_id = $request->projet;
            $campagne->type_campaigns_id = $request->type;
            $campagne->startdate =  date('Y-m-d');
            $campagne->enddate =  date('Y-m-d',strtotime("+30 days"));
            $campagne->status =  'en_cours';
        }

        if(request('type') != null && ((request('type') == 3) ||(request('type') == 4))){

            $validated = $request->validate([
                'projet' => 'required',
                'type' => 'required',
                'recompense' => ['required'],
            ]);

            $old = Campaign::where('projects_id',$request->projet)->get();
            $old = Campaign::where('projects_id',$request->projet)->whereIn('status',array('en_cours','valider','success'))->get();
            if($old != '[]'){
                Session::flash('error', 'Ce projet ne peut plus être soumis à une campagne de financement participatif !');
                return redirect()->route('campagne.list');
            }
            $campagne->projects_id = $request->projet;
            $campagne->type_campaigns_id = $request->type;
            $campagne->recompense = $request->recompense;
            $campagne->startdate =  date('Y-m-d');
            $campagne->enddate =  date('Y-m-d',strtotime("+30 days"));
            $campagne->status =  'en_cours';

        }



        $campagne->save();
        Session::flash('success', 'Votre demande a été enregistrer avec succèss !');
        return redirect()->route('campagne.list');

    }


    public function accepter($id){
        $projet = Project::findOrFail($id);
        $owner = User::where('id',$projet->users_id)->first();
        $campagne = Campaign::where('projects_id',$projet->id)->first();
        $campagne->status = 'valider';
        $campagne->save();
        $response = Http::post('https://graph.facebook.com/v13.0/103174605632349/feed?message=cool&link=http://kononkoulou.com/&access_token=EAAEv8nCokEgBADsE4tqeTZA5oNjZAWI4P29RDcFH2gvCwh3Ij1Cs2XsVmChzXv3dQ58UZCBujEyK4M5gHxmMZBceLVd984zvDVMPkB6Uosludt8gB7JnBJTJnB3dwwzRmMc8aIB9sfuVKB6vGSAHpmZAiJDKxgOUv5ZCBDou9WuIBTiZAc4OiZAeFPQ7KLvtXZAzZAApMLZBLiiOdRBKGGgZAwbV',[
            'message' => 'Venez soutenir le projet ' .$projet->nom . ' qui entame sa campagne de financement'
        ]);

        $response1 = Http::withHeaders([
            'Authorization'  =>  'OAuth oauth_consumer_key="c3idEPThKowMGG5kPPPqbzmZt",oauth_token="1508102518601093122-j9rC5AZXxrdWzvfVHLhx1G013nStpU",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1648582676",oauth_nonce="hvFMq3Ctuwz",oauth_version="1.0",oauth_signature="VHFSPghwlUfQQ%2F5y4u9Brgq%2BqEA%3D"',
            'Content-Type'  =>  'application/json',
        ])->post('https://api.twitter.com/2/tweets',[
            'text' => 'Venez soutenir le projet ' . $projet->nom . ' qui entame sa campagne de financement'
        ]);

        if($owner != null && $owner->email != null && $owner->firstname && $owner->lastname){

            try{


                $this->_sendNewMail(
                    'Félicitations !',
                    "<p>Bonjour <strong>" . $owner->firstname . " " . $owner->lastname . "</strong>, <br>" .
                    "Nous avons le plaisir de vous annoncer que votre demande de financement a été approuvée.</p>
                    <p>Cette campagne financement sera valide pour une période de 3 mois</p>",
                    [$owner->email]
                );


            }catch(\Exception $e){
                Session::flash('warning', 'Opération effectué avec erreur !');
                return redirect()->back();
            }

        }
        Session::flash('success', 'Opération effectué avec success !');
        return redirect()->back();
    }

    public function rejeter($id){
        $projet = Project::findOrFail($id);
        $owner = User::where('id',$projet->users_id)->first();

        $campagne = Campaign::where('projects_id',$projet->id)->first();
        $campagne->status = 'rejeter';
        $campagne->save();
        if($owner != null && $owner->email != null && $owner->firstname && $owner->lastname){

            try{

                $this->_sendNewMail(
                    'Campagne de financement !',
                    "<p>Bonjour <strong>" . $owner->firstname . " " . $owner->lastname . "</strong>, <br>" .
                    "Nous avons le regret de vous annoncer que votre demande de financement a été rejetée.</p>
                    <p>Votre projet n'est pas conforme à notre politique.",
                    [$owner->email]
                );

            }catch(\Exception $e){
                Session::flash('warning', 'Opération effectué avec erreur !');
                return redirect()->back();
            }

        }
        Session::flash('success', 'Opération effectué avec success !');
        return redirect()->back();
    }


    public function delete($id)
    {


        $campaign = Campaign::findOrFail($id);

        if($campaign->status == "valider" || $campaign->status == "success" || $campaign->status == "echec"){
            Session::flash('error', 'Cette campagne ne peut être supprimer!');
            return "fail";
        }

        if ($campaign->delete()) {
            Session::flash('success', 'Votre campagne a été supprimée avec succèss !');
            return "done";
        } else {
            Session::flash('error', 'Cette campagne ne peut être supprimer!');
            return "fail";
        }
        Session::flash('error', 'Cette campagne ne peut être supprimer!');
        return "fail";
    }

}
