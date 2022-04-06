<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'task_title' => 'required',
            'task_description' => 'required',
        ]);
        Task::insert([
            'task_title' => $request->task_title,
            'task_description' => $request->task_description,
            'created_at' => Carbon::now(),
        ]);
        return back();
    }

    public function status($id)
    {
        $task_info = Task::find($id);
        if ($task_info->status == 1) {
            Task::find($id)->update([
                'status' => 0,
            ]);
        } else {
            Task::find($id)->update([
                'status' => 1,
            ]);
        }
        return back();
    }

    public function delete($id)
    {
        Task::find($id)->delete();
        return back();
    }
}
