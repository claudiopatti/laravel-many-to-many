<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Models
use App\Models\{
    Project,
    Type
};

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::get();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::get();
        return view('admin.projects.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|min:3|max:128',
            'description' => 'required|min:3|max:4096',
            'delivery_time' => 'nullable|min:0|max:2000',
            'price' => 'nullable|decimal:2|min:0|max:99999',
            'complete' => 'nullable|in:1,0,true,false',
            'type_id' => 'nullable|exists:types,id',
        ]);

        $data['slug'] = str()->slug($data['name']);
        $data['complete'] = isset($data['complete']);

        $project = Project::create($data);

        return redirect()->route('admin.projects.show', ['project' => $project->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show',  compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::get();

        return view('admin.projects.edit',  compact('project', 'types'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'name' => 'required|min:3|max:128',
            'description' => 'required|min:3|max:4096',
            'delivery_time' => 'nullable|min:0|max:2000',
            'price' => 'nullable|decimal:2|min:0|max:99999',
            'complete' => 'nullable|in:1,0,true,false',
            'type_id' => 'nullable|exists:types,id',

        ]);

        $data['slug'] = str()->slug($data['name']);
        $data['complete'] = isset($data['complete']);

        $project->update($data);

        return redirect()->route('admin.projects.show', ['project' => $project->id]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index');
    }
}
