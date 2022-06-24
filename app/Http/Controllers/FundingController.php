<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Project;
use Illuminate\Http\Request;

class FundingController extends Controller
{
    public function index(Request $request,$id){

        $project = Project::findOrFail($id);
        $campaigns_id = Campaign::where('projects_id',$id)->pluck('id')->first();
        return view('back_office.funding.index',compact('id','campaigns_id'));
    }
}
