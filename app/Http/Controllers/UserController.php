<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
//use App\Repositories\TaskRepository;

class UserController extends Controller
{
    /**
     * 
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a list of all of the users.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
		$users = [];
	
		$user = Auth::user();
		
		if(strcmp($user->roles,"super-admin")==0){
			$users = User::all();
		}else{
			$users[0] = $user;
		}
		
		return view('users.index',compact('users'));
    }
	
	/**
	*	Display a particular user.
	*	
	*	
	*/
	public function show($id)
	{
		$user = User::findOrFail($id);
		return view('users.show',compact('user'));
		
	}

	/**
	*	Update a particular user.
	*/
	public function update($id,Request $request)
	{
		$user = User::findOrFail($id);
		$user->name = $request->input('name');
		$user->email = $request->input('email');
		$user->password = bcrypt($request->input('password'));
		$user->roles = $request->input('roles');
		$user->save();
		return redirect('users');
	}
	
    /**
     * Create a new task.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $request->user()->tasks()->create([
            'name' => $request->name,
        ]);

        return redirect('/tasks');
    }

    /**
     * Destroy the given user.
     *
     * @param  Request  $request
     * @param  User  $user
     * @return Response
     */
    public function destroy(Request $request, User $user)
    {
		$current_user = Auth::user();
		if(strcmp($current_user->roles,"super-admin")==0){
			$user->delete();
		}else{
			
		}
		return redirect('/users');
    }
}
