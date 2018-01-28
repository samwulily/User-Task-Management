<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Task;
use App\User;
use App\Repositories\TaskRepository;

class TaskController extends Controller
{
    /**
     * The task repository instance.
     *
     * @var TaskRepository
     */
    protected $tasks;

    /**
     * Create a new controller instance.
     *
     * @param  TaskRepository  $tasks
     * @return void
     */
    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');

        $this->tasks = $tasks;
    }

    /**
     * Display a list of all of the user's task.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
    //    return view('tasks.index', [
    //        'tasks' => $this->tasks->forUser($request->user()),
    //    ]);
		
		$tasks = [];
		$user = Auth::user();
		if(strcmp($user->roles,"super-admin")==0){
			$tasks = Task::all();
		}else{
			$tasks = $this->tasks->forUser($request->user());
		}
		return view('tasks.index',compact('tasks'));

    }
	
	/**
	*	Display a particular task.
	*	
	*	
	*/
	public function show($id)
	{
		$task = Task::findOrFail($id);
		$users = User::all();
		return view('tasks.show',compact('task','users'));
	}

	/**
	*	Update a particular task.
	*/
	public function update($id,Request $request)
	{
		$this->validate($request,[
			'name' => 'required|max:255',
		]);
		
		$task = Task::findOrFail($id);
		$task->name = $request->input('name');
		$task->user_id = $request->input('user');
		$task->save();
		
//		$task->update($request->all());
		return redirect('tasks');
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
     * Destroy the given task.
     *
     * @param  Request  $request
     * @param  Task  $task
     * @return Response
     */
    public function destroy(Request $request, Task $task)
    {
		$user = Auth::user();
		if(strcmp($user->roles,"super-admin")!=0){
			$this->authorize('destroy',$task);
		}
		$task->delete();

        return redirect('/tasks');
    }
}
