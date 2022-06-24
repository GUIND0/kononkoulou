<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SectorController extends Controller
{
    public function index(Request $request){

        $sectors = Sector::all();

        return view('back_office.sector.list',compact('sectors'));
    }


    public function store(Request $request){
        $id = request('id');
        if ($id != '') {
            $validated = $request->validate([
                'name' => 'required',
            ]);
            $sector = Sector::findOrFail($id);

        } else {

            $validated = $request->validate([
                'name' => ['required', 'unique:sectors,name'],

            ]);

            $sector  = new Sector();
        }

        $sector->name = $request->name;
        $sector->save();
        Session::flash('success', 'Ajouté avec succès !');

        return redirect()->route("sector.list");
    }


    public function add($id=null){
        $sector = null;
        if ($id != null) {
            $sector = Sector::findOrFail($id);
        }


        return view('back_office.sector.add',compact('sector'));
    }




    public function delete($id)
    {

        $sector = Sector::findOrFail($id);
        if ($sector->delete()) {
            Session::flash('success', 'Votre object a été supprimer avec succèss !');
            return "done";
        } else {
            Session::flash('error', 'Ce object ne peut être supprimer!');
            return "fail";
        }
        Session::flash('error', 'Ce object ne peut être supprimer!');
        return "fail";
    }
}
