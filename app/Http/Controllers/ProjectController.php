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

        return view('projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
        $this->authorize('update', $project);
        return view('projects.show', compact('project'));
    }

    public function store(Project $project)
    {
        //if ( auth()->user()->isNot($project->owner)){
        //    abort (403);
        //}

        $attributes = request()->validate([
            'title'       => 'required',
            'description' => 'required',
            'notes'       => 'min:3',
        ]);

        $project = auth()->user()->projects()->create($attributes);

        return redirect($project->path());
    }

    public function edit(Project $project)
    {
        //$this->authorize('update', $project);

        return view('projects.edit', compact('project'));
    }


    public function update(Project $project)
    {
        $this->authorize('update', $project);

        $attributes = request()->validate([
            'title'       => 'sometimes | required',
            'description' => 'sometimes | required',
            'notes'       => 'min:3',
        ]);

        $project->update($attributes);


        return redirect($project->path());
    }


    public function create()
    {
        return view('projects.create');
    }

}
