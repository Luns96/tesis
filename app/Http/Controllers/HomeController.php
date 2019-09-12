<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
// use App\Charts\Bar;
// use Charts;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $chart = new Bar('line');
        // $chart->labels(['One', 'Two', 'Three']);
        // $chart->values([1, 2, 3]);
        // $chart = Charts::database($users, 'bar', 'highcharts')
			      //->title("Monthly new Register Users")
			      //->elementLabel("Total Users")
			      //->dimensions(1000, 500)
			      //->responsive(false)
			      //->groupByMonth(date('Y'), true);
     

        $projects = Project::where('user_id',"=",auth()->user()->id)->get();
        foreach ($projects as $change ) {
                $change->Objective;
                foreach ($change->Objective as $change1 ) {
                    $change1->Goal;
            }
        }
        return view('home',compact('projects','chart'));
    }
}
