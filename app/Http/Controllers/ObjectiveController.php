<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Objective;
use App\Goal;

class ObjectiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function indexGoal($id)
    {
        $task = Goal::where('objective_id',"=",$id)->where('estatud',"=",2)->count();
        $find = Objective::findOrFail($id);
        $find->Project;
        $find = $find->Project->id;
        return view('goals.index',compact('id','task','find'));
    }

    public function objectiveList($id)
    {
        $objective = Objective::findOrFail($id);
        $goal = Goal::where('objective_id',"=",$id)->where('estatud',"=",2)->count();
        if ($objective->quantity == $goal){
            $objective->estatud = 2;
        }else{
            $objective->estatud = 1;
        }
        $objective->save();
        return $objective;
    }


    public function goalIndex($id)
    {

        $objective = Objective::findOrFail($id);
        $goal = Goal::where('objective_id',"=",$id)->count();
        $objective->quantity = $goal;
        $objective->save();

        $time = date('Y-m-d');
        $goal = Goal::where('objective_id',"=",$id)->get();
        foreach ($goal as $change ) {
            if ($change->estatud != 2){
                if($change->start > $time){
                    $change->estatud = 4;
                    $change->save();
                }
                elseif($change->finish < $time){
                    $change->estatud = 3;
                    $change->save();
                }else{
                    $change->estatud = 1;
                    $change->save();
                }
            }
        }
        $goal = $goal->toJson();  
        return $goal;
    }
    
    public function index()
    {
        
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
        $objective = new Objective;
        $objective->name = $request->name;
        $objective->project_id = $request->id;
        $objective->estatud = 1;
        $objective->quantity = 0;
        $objective->save();
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
        $objective = Objective::findOrFail($id);
        $objective->name = $request->name;
        $objective->save();
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
