<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\User;
use App\Project;
use Spatie\Permission\Models\Role;
use Auth;

class UserController extends Controller
{
    
    // public function __construct(){
    //     $this->middleware('auth');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function userIndex()
    {
        $user = User::where('estatud',"=",'1')->get();
        foreach ($user as $change ) {
            $change = $change->roles;
        }
        // foreach ($user as $change => $users ) {
        //     if($users->roles[0]->id == 2){
        //         unset($user[$change]);
        //     }
        // }
        foreach ($user as $change ) {
            $change = $change->Company;
        }
        return $user->toArray();
    }

    public function user($id)
    {
        $user = User::findOrFail($id);
        $user->Company->Type;
        // $goal = $goal->toJson();
        return $user;
    }

    public function reset()
    {
        return view('auth.reset'); 
    }

    public function resetPassword(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->password = $request->password;
        $user->save();
    }

    public function projects($id)
    {
        $project = Project::where('user_id',"=",$id)->get();
        foreach ($project as $change ) {
                $change->goal;
                foreach ($change->goal as $change1 ) {
                    $change1->objects;
                }
            }
        // $user = User::findOrFail($id);
        // $user->project;
        // foreach ($user->project as $change ) {
        //     $change->goal;
        //     foreach ($change->goal as $change1 ) {
        //         $change1->objects;
        //     }
        // }
        return $project;
    }

    public function roles()
    {
        $role = Role::where('id', '<>', '2')->get();
        return $role;
    }

    // public function GerenteIndex()
    // {
    //     $user = User::where('company_id', '=' , auth()->user()->id)->get();
    //     return $user;

    // }

    public function accountInfo()
    {
        $user = Auth::user();
        return $user;

    }
    public function accountInfoRol()
    {
        $user = Auth::user()->roles;
        return $user;

    }

    public function index()
    {
        return view('user.index'); 
    }

    public function indexGerente()
    {
        return view('user.indexGerente'); 
    }

    public function UserIndexGerente()
    {
        $user = User::where('company_id',"=",auth()->user()->company_id)->get();
        foreach ($user as $change ) {
            $change = $change->roles;
        }
        foreach ($user as $change ) {
            $change = $change->Company;
        }
        return $user; 
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
        $user = new User;
        $user->nombre = $request->name;
        $user->apellido = $request->surname;
        $user->email = $request->email;
        $user->ci = $request->ci;
        $user->password = $request->password;
        $user->telefono = $request->cellnumber;
        $user->estatud = 1;
        $user->company_id = $request->company;
        if ($user->save()){
            $user->assignRole($request->rol);
        }
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
        $user = User::findOrFail($id);
        $user->nombre = $request->name;
        $user->apellido = $request->surname;
        $user->email = $request->email;
        $user->ci = $request->ci;
        $user->password = $request->password;
        $user->telefono = $request->cellnumber;
        if ($request->password != null){
            $user->password = $request->password;
        }
        $user->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->estatud = 0;
        $user->save();
    }
}
