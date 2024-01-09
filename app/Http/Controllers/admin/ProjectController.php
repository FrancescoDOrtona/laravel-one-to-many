<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return view("admin.project.index", compact("projects"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.project.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $new_project = Project::create($data);

        return redirect()->route('admin.projects.show', $new_project->id);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $project = Project::findorfail($id);
        return view('admin.project.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('admin.project.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'img' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:5|max:400',
        ]);

        $project = Project::findOrFail($id);
        $project->update($validatedData);

        return redirect()->route('admin.projects.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
