<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }
    
    public function create()
    {
    
    }
    
    public function store()
    {
        $this->validate(request(), [
            'body' => 'required'
        ]);
        
        $task = Task::create([
            'body' => request('body')
        ]);
        
        return view('icanmart');
    }
    
    
}
