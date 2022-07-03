<?php

namespace App\Http\Controllers;

use App\Models\Pays;
use App\Models\Profil;
use App\Models\User;
use App\Models\UserPassword;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use HepplerDotNet\FlashToastr\Flash;

class UserController extends Controller
{

    public function list(Request $request){
        $users = User::OrderBy('validate')->get();
        $users->map(function($user){
            $user->profil_libelle = $user->profil->name;
        });
        return view('back_office.users.index',compact('users'));
    }

    public function motDePasseForm()
    {
        //verification
        if (auth()->check()) {
            return redirect('/');
        }
        return view('back_office.login.oublie');
    }


    public function motDePasseSend(Request $request)
    {
        //verification
        if (auth()->check()) {
            return redirect('/');
        }

        $user = User::where('email', request('email'))->where('validate', '1')->first();

        if ($user != null) {
            $userPassword = UserPassword::create([
                'users_id' => $user->id,
                'statut' => 'cree',
                'expired_at' => Carbon::now()->addHour()->format('Y-m-d H:i:s'),
                'token' => Str::random(50)
            ]);

            $this->_sendNewMail(
                'RECUPERATION MOT DE PASSE',
                "<p>Bonjour <strong>" . $user->prenom . " " . $user->nom . "</strong>, <br>" .
                    "une demande de réinitialisation du mot de passe a été reçue de votre compte.<br>" .
                    "Veuillez utiliser ce lien pour réinitialiser votre mot de passe<br><br>" .
                    route('mot_de_passe.lien', $userPassword->token) . "<br><br>" .
                    "<strong>Note :</strong> Ce lien est valable pendant une heure à partir du moment où il vous a été envoyé et ne peut être utilisé qu'une seule fois pour changer votre mot de passe.<br>" .
                    "</p>",
                [$user->email]
            );
        }else {

            return redirect()->back()->withInput()->withErrors([
                'login' => 'Compte non associé avec un utlisateur',
            ]);

        }

        Flash::success('Bravo','Opération effectuée avec success !');
        return redirect()->back();

    }

    public function motDePasseLien(Request $request)
    {
        //verification
        if (auth()->check()) {
            return redirect('/');
        }
        $userPassword = UserPassword::where('token', request('token'))
            ->where('statut', 'cree')
            ->whereDate('expired_at', '<=', Carbon::now()->format('Y-m-d H:i:s'))
            ->first();

        if (!$userPassword) {
            abort(404, 'Page not found.');
        }
        return view('back_office.users.password', compact('userPassword'));
    }

    public function motDePasseChange(Request $request)
    {
        //verification
        if (auth()->check()) {
            return redirect('/');
        }
        request()->validate([
            'password' => ['required', 'confirmed', 'min:4'],
            'password_confirmation' => ['required'],
        ]);

        $user = User::findOrFail(request('user_id'));
        $user->password = bcrypt(request('password'));
        if ($user->save()) {
            $userPassword = UserPassword::findOrFail(request('id'));
            $userPassword->statut = "traite";
            $userPassword->save();
            return redirect()->route('login');
        }
        return redirect()->back()->withInput()->withErrors([
            'login' => 'Erreur ! Réessayez.',
        ]);
    }


    public function register(){
        $profils = Profil::all();
        $pays = Pays::all();
        return view('back_office.register.index',compact('profils','pays'));
    }

    public function login(){
        return view('back_office.login.index');
    }

    public function loginStore(Request $request){

        $validated = $request->validate([
            'email' => 'required',
            'password' => 'required',
            'g-recaptcha-response' => function($attribute, $value, $fail){
                $secretKey = config('app.reCAPTCHA_SECRET');
                $response = $value;
                $userIP = $_SERVER['REMOTE_ADDR'];
                $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response&remoteip=$userIP";
                $response = \file_get_contents($url);
                $response = json_decode($response);
                if(!$response->success){
                    $fail('Veuillez valider cette etape !');
                }
            },
        ]);

        $resultat = auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,
            'validate' => 1
        ]);

        if($resultat){
            $user = User::where('email',$request->email)->first();
            if($user->profils_id == 1){
                return redirect()->route('back_office.admin');
            }
            return redirect()->route('back_office.index');
        }
        return redirect()->back()->withInput()->withErrors([
            'login' => 'Indentifiant introuvable ! Réessayez.',
        ]);

    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function store(Request $request){

        $validated = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'telephone' => 'required',
            'condition' => 'required',
            'pays' => 'required',
            'g-recaptcha-response' => function($attribute, $value, $fail){
                $secretKey = config('app.reCAPTCHA_SECRET');
                $response = $value;
                $userIP = $_SERVER['REMOTE_ADDR'];
                $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response&remoteip=$userIP";
                $response = \file_get_contents($url);
                $response = json_decode($response);
                if(!$response->success){
                    $fail('Veuillez valider cette etape !');
                }
            },
        ]);

        $user = new User();
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->telephone = $request->telephone;
        $user->profils_id = Profil::where('name','users')->pluck('id')->first();
        $user->pays_id = $request->pays;
        $user->save();

        return redirect()->route('register.stepOne',$user->id);
    }

    public function stepOne(Request $request,$id){
        return view('back_office.register.stepOne',compact('id'));
    }



    public function finalStep(Request $request,$id){

        $user = User::findOrFail($id);

        $validated = $request->validate([
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
        ]);

        $user->password = bcrypt($request->password);
        $user->save();
        $resultat = auth()->attempt([
            'email' => $user->email,
            'password' => $request->password
        ]);

        return redirect()->route('back_office.index');
    }

    public function settings(Request $request){
        $pays = Pays::all();
        return view('back_office.settings.index',compact('pays'));
    }


    public function password(Request $request)
    {

        $validator = $request->validate([
            'password' => 'required',
            'newpassword' => ['required', 'confirmed', 'min:4'],
            'newpassword_confirmation' => ['required'],
        ]);


        if(Hash::check(request('password'), auth()->user()->password)){
            $update = auth()->user()->update([
                'password' => bcrypt(request('newpassword'))
            ]);
            if ($update) {
                Session::flash('success', 'Opération effectuée avec succèss');
                return redirect()->back();
            }
        }else{
            Session::flash('error', 'Echec ! Veuillez réessayer plutard');
            return redirect()->back();
        }

        return redirect()->back();
    }

    public function update(Request $request){

        $user = User::findOrFail(auth()->user()->id);

        if(isset($request->firstname)){
            $user->firstname = $request->firstname;
        }

        if(isset($request->lastname)){
            $user->lastname = $request->lastname;
        }

        if(isset($request->telephone)){
            $user->telephone = $request->telephone;
        }

        if(isset($request->bio)){
            $user->bio = $request->bio;
        }

        if(isset($request->date_naissance)){
            $user->date_naissance = $request->date_naissance;
        }

        if(isset($request->carte)){
            $path = 'uploads/' . $request->file('carte')->store('files', 'public');
            $user->photo_identite = $path;
        }

        if(isset($request->photo)){
            $path = 'uploads/' . $request->file('photo')->store('files', 'public');
            $user->photo = $path;
        }

        if(isset($request->twitter)){
            $user->twitter = $request->twitter;
        }

        if(isset($request->facebook)){
            $user->facebook = $request->facebook;
        }

        if(isset($request->linkedin)){
            $user->linkedin = $request->linkedin;
        }

        if(isset($request->instagram)){
            $user->instagram = $request->instagram;

        }

        $user->save();
        Flash::success('Bravo','Opération effectuée avec success !');

        return redirect()->back();

    }

    public function desactivate(Request $request,$id){

        $user = User::findOrFail($id);
        $user->validate = false;
        if($user->save()){

            $this->_sendNewMail(
                'Compte utilisateur',
                "<p>Bonjour <strong>" . $user->firstname . " " . $user->lastname . "</strong>, <br>" .
                "Nous avons le regret de vous annoncer que votre votre compte utilisateur a été désactiver.",
                [$user->email]
            );

            Flash::success('Bravo','Opération effectuée avec success !');
            return redirect()->back();
        }else{
            Flash::error('erreur', 'Echec de opération !');
            return redirect()->back();
        }
    }

    public function activate(Request $request,$id){

        $user = User::findOrFail($id);
        $user->validate = true;
        if($user->save()){

            $this->_sendNewMail(
                'Compte utilisateur',
                "<p>Bonjour <strong>" . $user->firstname . " " . $user->lastname . "</strong>, <br>" .
                "Nous avons le plaisir de vous annoncer que votre votre compte utilisateur a été valider.</p>
                <p>Veuillez vous connecter pour profiter d'une experience unique.",
                [$user->email]
            );
            Flash::success('Bravo','Opération effectuée avec success !');
            return redirect()->back();
        }else{
            Session::flash('error', 'Echec de opération !');
            return redirect()->back();
        }
    }

    public function show(Request $request,$id){
        $user = User::findOrFail($id);
        return view('back_office.users.show',compact('user'));
    }

}
