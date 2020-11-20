<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Repositories\TaskRepository;
use App\Task;
class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $tasks;

    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');
        $this->tasks = $tasks;
    }

    public function index(Request $request)
    {
        if (auth()->user()->role == 'admin')
        {
            $tasks = Task::orderBy('created_at', 'asc')->get();
            $users = User::all();
            return view('tasks', [
                'tasks' => $tasks,
                'users' => $users,
            ]);
        }
        else
        {
            $freeTasks = Task::where('user_id',"")->orderBy('created_at', 'asc')->get();
            $tasksForUser =  Task::where('user_id', auth()->user()->id)->get();

            return view('tasks', [
                'tasksForUser' => $tasksForUser,
                'freeTasks' => $freeTasks
            ]);
        }
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
        if (auth()->user()->role == 'admin')
        {
            if ($request->name != "") {
                $task = new Task;
                $task->name = $request->name;
                $task->user_id = "";
                $task->save();
            }
        }
        return redirect('/tasks');
    }

    public function choose($id)
    {
        $task = Task::find($id);
        $task->user_id = auth()->user()->id;
        $task->save();

        return redirect('/tasks');
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
        if (auth()->user()->role == 'admin' && $request->input('name') != "")
        {
            $task = Task::find($id);
            $task->name = $request->input('name');
            $task->save(['timestamps' => false]);
        }
        return redirect('/tasks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->role == 'admin')
        {
            Task::findOrFail($id)->delete();
        }
        return redirect('tasks');
    }
}
