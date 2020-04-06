<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    //
    public function index()
    {
        $projects = auth()->user()->projects;

        return view('projects.index',compact('projects'));
    }

    public function store()
    {
        $attributes = request(['title','body']);
        create(Project::class, $attributes);
    }

    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }


}
