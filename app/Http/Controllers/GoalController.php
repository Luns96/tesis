<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Goal;
use App\Objective;
use App\Activity;

class GoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $task = Activity::where('goal_id',"=",$id)->where('estatud',"=",1)->count();
        $find = Goal::findOrFail($id);
        $find->Objective;
        $find = $find->Objective->id;
        return view('activity.index',compact('id','task','find'));
    }

    public function goalList($id)
    {
        $goal = Goal::findOrFail($id);
        return $goal;
    }

    public function activityIndex($id)
    {

        $activities = Activity::where('goal_id',"=",$id)->get();
        return $activities;
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
        $goal = new Goal;
        $goal->name = $request->name;
        $goal->objective_id = $request->id;
        $goal->estatud = 1;
        $goal->start = $request->datestart;
        $goal->finish = $request->datefinish;
        $goal->priority = $request->priority;
        $goal->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $goal = Goal::findOrFail($id);
        return $goal;
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
