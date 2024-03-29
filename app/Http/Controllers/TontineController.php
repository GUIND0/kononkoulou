<?php

namespace App\Http\Controllers;

use App\Models\ParticipationTontine;
use App\Models\Retrait;
use App\Models\Tontine;
use App\Models\User;
use App\Models\VersementTontine;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use HepplerDotNet\FlashToastr\Flash;

class TontineController extends Controller
{

    public function show(Request $request,$id){
        $tontine = Tontine::findOrFail($id);
        $participation = ParticipationTontine::where('tontine_id',$tontine->id)->where('users_id',auth()->user()->id)->where('statut','valider')->first();

        $participants = Retrait::select(
            DB::raw('retraits.*'),
            DB::raw("users.firstname as firstname"),
            DB::raw("users.lastname as lastname"),
        )
        ->join('users','users.id','retraits.users_id')
        ->join('tontines','tontines.id','retraits.tontines_id')
        ->where('tontines.id',$tontine->id)
        ->get();

        $versements = VersementTontine::where('tontines_id',$tontine->id)->where('users_id',auth()->user()->id)->get();



        return view('back_office.tontine.show',compact('tontine','participants','participation','versements'));
    }

    public function create(Request $request){
        return view('back_office.tontine.create');
    }

    public function startTontine(Request $request,$id){
        $order = 1;
        $tontine = Tontine::findOrFail($id);

        if($tontine->debut <= Carbon::now()){

            $retraits = Retrait::where('tontines_id',$tontine->id)->get();

            if($retraits == '[]' || $retraits == null){

                $participations = ParticipationTontine::where('tontine_id',$tontine->id)->where('statut','valider')->get();
                // dd( $participations);
                if($participations != '[]' && $participations != null){
                    foreach ($participations as $key => $participation) {
                        for ($i=0; $i < intval($participation->main); $i++) {
                            $retrait = new Retrait();
                            $retrait->montant = ($tontine->cotisation * $tontine->nombre_main);
                            $retrait->users_id = $participation->users_id;
                            $retrait->tontines_id = $id;
                            $retrait->tour = $order++;
                            $retrait->save();
                        }

                    }
                    Flash::success('Bravo','Opération effectuée avec success !');
                    return redirect()->back();
                }
            }else{
                Flash::warning('Oups','Cette tontine est deja en cours !');
                return redirect()->back();
            }

        }
    }


    public function store(Request $request){

        $id = request('id');
        if ($id != '') {
            $validated = $request->validate([
                'nom' => 'required',
                'cotisation' => 'required',
                'nombre_main' => 'required',
                'debut' => 'required',
                'fin' => 'required',
            ]);
            $tontine = Tontine::findOrFail($id);

        } else {

            $validated = $request->validate([
                'nom' => 'required',
                'cotisation' => 'required',
                'nombre_main' => 'required',
                'debut' => 'required',
                'fin' => 'required',
            ]);

            $tontine = new Tontine();

        }

        $tontine->nom = request('nom');
        $tontine->cotisation = unformat(request('cotisation'));
        $tontine->nombre_main = request('nombre_main');
        $tontine->debut = request('debut');
        $tontine->fin = request('fin');
        $tontine->save();

         Flash::success('Bravo','Opération effectuée avec success !');

        return redirect()->back();
    }


    public function paiement(Request $request,$id){
        $tontine = Tontine::findOrFail($id);
        return view('back_office.tontine.paiement',compact('id','tontine'));
    }

    public function demande(Request $request,$id){
        $tontine = Tontine::findOrFail($id);
        $participation = new ParticipationTontine();
        $participation->users_id = request('users_id');
        $participation->tontine_id = $tontine->id;
        $participation->main = request('main');
        $participation->save();
         Flash::success('Bravo','Opération effectuée avec success !');
        return redirect()->back();
    }

    public function accepteDemande(Request $request,$id){

        $participation = ParticipationTontine::findOrFail($id);

        $user = User::findOrFail($participation->users_id);
        $tontine = Tontine::findOrFail($participation->tontine_id);
        //la sum des mains des tontines participation ne depasse pas le nombre total de main de la tontine
        $nombre = ParticipationTontine::select(
            DB::raw('SUM(participation_tontine.main) as nbr')
        )
        ->where('tontine_id',$tontine->id)
        ->where('statut','accepter')
        ->first();
        $nombre = $nombre->nbr;
        if(intval($nombre) + intval($participation->main) >= intval($tontine->nombre_main)){
            Session::flash('error', 'Cette action ne peut aboutir !');
            return redirect()->back();
        }

        $participation->statut = 'valider';
        if($participation->save()){

            $this->_sendNewMail(
                'Félicitations !',
                "<p>Bonjour <strong>" . $user->firstname . " " . $user->lastname . "</strong>, <br>" .
                "Nous avons le plaisir de vous annoncer que votre demande de participation à la tontine". $tontine->nom ."a été approuvée.</p>",
                [$user->email]
            );

        }
        Flash::success('Bravo','Opération effectuée avec success !');
        return redirect()->back();
    }

    public function rejeterDemande(Request $request,$id){
        $participation = ParticipationTontine::findOrFail($id);
        $user = User::findOrFail($participation->users_id);
        $tontine = Tontine::findOrFail($participation->tontine_id);
        $participation->statut = 'rejeter';
        if($participation->save()){

            $this->_sendNewMail(
                'Information Kononkoulou !',
                "<p>Bonjour <strong>" . $user->firstname . " " . $user->lastname . "</strong>, <br>" .
                "Nous avons le regret de vous annoncer que votre demande de participation à la tontine". $tontine->nom ."a été rejétée.</p>",
                [$user->email]
            );

        }
        Flash::success('Bravo','Opération effectuée avec success !');
        return redirect()->back();
    }


    public function list(Request $request){
        $tontines = Tontine::join('participation_tontine','participation_tontine.tontine_id','tontines.id')
        ->select(
            DB::raw("DISTINCT(tontines.id)"),
            DB::raw("tontines.*"),
        )
        ->get();

        $tontines->map(function($tontine){
            $tontine->nbr = ParticipationTontine::where('tontine_id',$tontine->id)->where('statut','valider')->get()->sum('main');
        });

        return view('back_office.tontine.list',compact('tontines'));
    }

    public function listDemande(Request $request){
        $tontines = ParticipationTontine::select(
            DB::raw("participation_tontine.*"),
            DB::raw("tontines.nom as tontines_nom"),
            DB::raw("tontines.cotisation as tontines_cotisation"),
            DB::raw("tontines.nombre_main as tontines_nombre_main"),
            DB::raw("tontines.debut as tontines_debut"),
            DB::raw("tontines.fin as tontines_fin"),
            DB::raw("CONCAT(users.firstname,' ',users.lastname) as users_username"),
        )
        ->join('users','users.id','participation_tontine.users_id')
        ->join('tontines','tontines.id','participation_tontine.tontine_id')
        ->where('participation_tontine.statut',null)
        ->get();
        return view('back_office.tontine.listdemande',compact('tontines'));
    }

    public function mylist(Request $request){
        $tontines = Tontine::select(
            DB::raw('DISTINCT(tontines.id)'),
            DB::raw('tontines.*')
        )->join('participation_tontine','participation_tontine.tontine_id','tontines.id')
        ->where('participation_tontine.users_id',auth()->user()->id)
        ->where('participation_tontine.statut','valider')
        ->get();

        return view('back_office.tontine.mylist',compact('tontines'));
    }

    public function delete($id)
    {

        $tontine = Tontine::findOrFail($id);

        if ($tontine->delete()) {
            Flash::success('Bravo','Opération effectuée avec success !');
            return "done";
        } else {
            Flash::error('Erreur ! ','Cet element ne peut être supprimer !');
            return "fail";
        }
        Flash::error('Erreur ! ','Cet element ne peut être supprimer !');
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
