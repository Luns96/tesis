<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Objective;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function projectIndex()
    {
        $projects = Project::where('user_id',"=",auth()->user()->id)->get();
        // foreach ($projects as $change ) {
        //     $change = $change->goal;
        // }
        return $projects;
    }

    public function objectiveIndex($id)
    {
        $objective = Objective::where('project_id',"=",$id)->get();
        $objective = $objective->toJson();
        return $objective;
    }
    
    public function index()
    {
        return view('project.index'); 
    }

    public function indexObjective($id)
    {
        $project = Project::findOrFail($id);
        return view('objective.index',compact('project','id'));
    }

    public function projectList($id)
    {
        $project = Project::findOrFail($id);
        return $project;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $project = new Project;
        $project->name = $request->name;
        $project->mission = $request->mission;
        $project->vision = $request->vision;
        $project->user_id = $request->id;
        $project->estatud = 1;
        $project->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->name = $request->name;
        $project->mission = $request->mission;
        $project->vision = $request->vision;
        $project->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id)->delete();
    }
}
