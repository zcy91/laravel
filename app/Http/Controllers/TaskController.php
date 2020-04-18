<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function home()
    {

        return 'Hello, World!';
    }
    public function store(Request $request)
    {
        $task = new Task();
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->save();
        return redirect('task');   // 重定向到 GET task 路由
    }
}
