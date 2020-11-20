<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TaskRepository;

class DevController extends Controller
{
    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ( auth()->user()->role == "admin")
        {
            return view('dev');
        }
    }
}
