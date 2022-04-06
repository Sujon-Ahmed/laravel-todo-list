<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

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
        $total_task = Task::all()->count();
        $complete_task = Task::where('status', 1)->count();
        $tasks = Task::all();
        return view('home', [
            'tasks' => $tasks,
            'total_task' => $total_task,
            'complete_task' => $complete_task,
        ]);
    }
}
