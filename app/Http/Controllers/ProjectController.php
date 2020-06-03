<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProjectRequest;
use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    //
    public function index()
    {
        $projects = auth()->user()->accessibleProjects();

        return view('projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
        $this->authorize('update', $project);
        return view('projects.show', compact('project'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function store(Project $project)
    {
        $project = auth()->user()->projects()->create($this->validateRequest());

        //if(request()->wantsJson()){
        //    return ['message' => $project->path()];
        //}

        return redirect($project->path());
    }



    public function update(UpdateProjectRequest $request)
    {
        //$project->update($request->validated());
        //$request->save();

        return redirect($request->save()->path());
    }

    public function destroy(Project $project)
    {
        $this->authorize('manage', $project);
        $project->delete();
        return redirect('/projects');
    }


    /**
     * @return array
     */
    protected function validateRequest(): array
    {
        return request()->validate([
            'title'       => 'sometimes | required',
            'description' => 'sometimes | required',
            'notes'       => 'min:3',
        ]);
    }

}
