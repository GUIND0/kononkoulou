<?php

use App\Http\Controllers\BackOfficeController;
use App\Http\Controllers\CampagneController;
use App\Http\Controllers\CatalogueController;
use App\Http\Controllers\ContributionController;
use App\Http\Controllers\FundingController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\ProjetController;
use App\Http\Controllers\RetraitController;
use App\Http\Controllers\SectorController;
use App\Http\Controllers\TontineController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Route;


Route::get('/mot-de-passe-oublie/success', [UserController::class, 'success'])->name('mot_de_passe.success');
Route::get('/mot-de-passe-oublie', [UserController::class, 'motDePasseForm'])->name('mot_de_passe.form');
Route::post('/mot-de-passe-oublie', [UserController::class, 'motDePasseSend'])->name('mot_de_passe.send');
Route::get('/mot-de-passe-oublie/{token}', [UserController::class, 'motDePasseLien'])->name('mot_de_passe.lien');
Route::post('/mot-de-passe-oublie/{token}', [UserController::class, 'motDePasseChange'])->name('mot_de_passe.change');

Route::group(['middleware' => 'auth'], function(){

    Route::get('admin/back_office/',[BackOfficeController::class,'admin'])->name('back_office.admin');
    Route::get('/sector',[SectorController::class,'index'])->name('sector.list');
    Route::get('/sector/add/{id?}',[SectorController::class,'add'])->name('sector.add');
    Route::post('/sector/add',[SectorController::class,'store'])->name('sector.store');
    Route::delete('sector/delete/{id}', [SectorController::class, 'delete'])->name('sector.delete');

    Route::post('/mot_de_passe',[UserController::class,'password'])->name('user.password');
    Route::get('/projet',[ProjetController::class,'list'])->name('projet.list');
    Route::get('/projet/add/{id?}',[ProjetController::class,'add'])->name('projet.add');
    Route::post('/projet/add',[ProjetController::class,'store'])->name('projet.store');
    Route::delete('projet/delete/{id}', [ProjetController::class, 'delete'])->name('projet.delete');
    Route::delete('campaign/delete/{id}', [CampagneController::class, 'delete'])->name('campagne.delete');

    Route::get('/tontine/paiement/page/{id}',[TontineController::class,'paiement'])->name('tontine.paiement');
    Route::get('/tontine/my-tontines',[TontineController::class,'mylist'])->name('tontine.mylist');
    Route::get('/tontine/list',[TontineController::class,'list'])->name('tontine.list');
    Route::get('/tontine/list-demande',[TontineController::class,'listDemande'])->name('tontine.listdemande');
    Route::get('/tontine/create',[TontineController::class,'create'])->name('tontine.create');
    Route::get('/tontine/show/{id}',[TontineController::class,'show'])->name('tontine.show');
    Route::get('/tontine/start/{id}',[TontineController::class,'startTontine'])->name('tontine.startTontine');
    Route::post('/tontine/store',[TontineController::class,'store'])->name('tontine.store');
    Route::post('/tontine/demande/{id}',[TontineController::class,'demande'])->name('tontine.demande');
    Route::get('/tontine/accepeter-demande/{id}',[TontineController::class,'accepteDemande'])->name('tontine.acceptedemande');
    Route::get('/tontine/rejeter-demande/{id}',[TontineController::class,'rejeterDemande'])->name('tontine.rejeterdemande');
    Route::delete('/tontine/demande/delete/{id}', [TontineController::class, 'delete'])->name('tontine.delete');

    Route::get('/compagne/own',[CampagneController::class,'list'])->name('campagne.list');
    Route::get('/compagne/add',[CampagneController::class,'add'])->name('campagne.add');
    Route::post('/compagne/soumission',[CampagneController::class,'store'])->name('campagne.store');
    Route::get('/compagne/pending',[CampagneController::class,'checklist'])->name('campagne.checklist');
    Route::get('/compagne/list',[CampagneController::class,'admin'])->name('campagne.admin');
    Route::get('/compagne/accepter/{id}',[CampagneController::class,'accepter'])->name('campagne.accepter');
    Route::get('/compagne/rejeter/{id}',[CampagneController::class,'rejeter'])->name('campagne.rejeter');

    Route::get('/funding/choice/{id}',[FundingController::class,'index'])->name('funding.index');

    Route::get('/retrait/list',[RetraitController::class,'listTontine'])->name('retrait.tontine');
    Route::get('/retrait/statut/{id}',[RetraitController::class,'retraitStatut'])->name('retrait.tontinestatut');

    Route::get('/retrait/listCampagne',[RetraitController::class,'listCampagne'])->name('retrait.listCampagne');



    Route::get('reglage/',[UserController::class,'settings'])->name('settings.index');
    Route::post('/user/update',[UserController::class,'update'])->name('user.update');
    Route::get('/user/desactivate/{id}',[UserController::class,'desactivate'])->name('user.desactivate');
    Route::get('/user/activate/{id}',[UserController::class,'activate'])->name('user.activate');

    Route::get('/user/list',[UserController::class,'list'])->name('user.list');
    Route::get('/user/show/{id}',[UserController::class,'show'])->name('user.show');
});
Route::get('/projet/overview/{id}',[ProjetController::class,'overview'])->name('projet.overview');
Route::get('/catalogue/index',[CatalogueController::class,'index'])->name('catalogue.index');
Route::get('/contribution/index',[ContributionController::class,'index'])->name('contribution.index');
Route::get('/contribution/mine',[ContributionController::class,'mine'])->name('contribution.mine');
Route::get('/aide/index',[BackOfficeController::class,'aide'])->name('aide.index');
Route::get('/login',[UserController::class,'login'])->name('login');
Route::get('/logout',[UserController::class,'logout'])->name('logout');
Route::post('/login',[UserController::class,'loginStore'])->name('login.store');
Route::get('/register',[UserController::class,'register'])->name('register');
Route::post('/store',[UserController::class,'store'])->name('register.store');
Route::get('/next_step/{id}',[UserController::class,'stepOne'])->name('register.stepOne');
Route::post('/final_step/{id}',[UserController::class,'finalStep'])->name('register.finalStep');
Route::get('back_office/',[BackOfficeController::class,'index'])->name('back_office.index');
Route::get('/',[BackOfficeController::class,'accueil'])->name('back_office.accueil');
Route::post('/store/funding',[PaypalController::class,'storeFunding'])->name('paypal.funding');
Route::post('/tontine-funding',[PaypalController::class,'tontineFunding'])->name('paypal.tontine');
