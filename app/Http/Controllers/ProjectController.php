<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\File;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function filtro()
    {
        $userId = auth()->id();
        $user = User::findOrFail($userId);
        if ($user->rol == 'profesor'){
            $projects = Project::orderby('created_at', 'desc')->where('profesor_id', $userId)->get();
        }else{
            $projects = Project::orderby('created_at', 'desc')->where('estudiante_id', $userId)->get();
        }
        return view('projects.projectsIndex')->with('projects', $projects);
    }

    public function search( Request $request)
    {
        $nombre = $request->get('nombre');
        $projects = Project::orderby('created_at', 'desc')->where('nombre', 'LIKE', "%$nombre%")->get();
        return view('projects.projectsIndex')->with('projects', $projects);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::orderby('created_at', 'DESC')->get();
        $users = User::all();
        return view('projects.projectsIndex', ['projects'=>$projects, 'users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $profesores = User::where('rol', 'LIKE', '%profesor%')->get();
        return view('projects.projectCreate')->with('profesores', $profesores);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos
        $request->validate([
            'nombre' => 'required|max:300|regex:/[a-zA-Z0-9 ]+/',
            'descripcion' => 'required|max:300|regex:/[a-zA-Z0-9 ]+/',
            'profesor_id' => 'required|exists:users,id'
        ]);
        // Crear una nueva project
        $project = new Project();
        // Asignamos valores de la project
        $project->nombre = $request->input('nombre');
        $project->descripcion = $request->input('descripcion');
        $project->profesor_id = $request->input('profesor_id');
        $project->estudiante_id = 1;
        $project->estado = $request->input('estado');



        // Guardar   Save()
        if ($project->save()){
            return redirect()->route('projects.index')->with('exito', 'El projecto se creo correctamente.');
        }else{
            return redirect()->route('projects.index')->with('fracaso', 'El projecto no se puedo crear.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Project::findorFail($id);
        $comments = Comment::where('project_id', $id)->get();
        $files = File::where('project_id', $id)->get();
        $comentario = Comment::where('contenido', 'LIKE', '%/%')->get()->first();
        $profesor = User::where('id', $project->profesor_id)->get()->first();
        $estudiante = User::where('id', $project->estudiante_id)->get()->first();
        return view('projects.projectsShow', ['project'=>$project, 'comments'=>$comments, 'profesor'=>$profesor, 'estudiante'=>$estudiante, 'files'=>$files]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = Project::findOrFail($id);
        $profesores = User::where('rol', '%like%', 'profesor');
        return view('projects.projectCreate', ['project'=>$project, 'profesores'=>$profesores]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validar los datos
        $request->validate([
            'nombre' => 'required|max:300|regex:/[a-zA-Z0-9 ]+/',
            'descripcion' => 'required|max:300|regex:/[a-zA-Z0-9 ]+/',
            'profesor_id' => 'required|exists:users,id'
        ]);
        // Crear una nueva project
        $project = Project::find($id);
        $project->nombre = $request->input('nombre');
        $project->contenido = $request->input('contenido');
        $project->profesor_id = $request->input('profesor');
        $project->user_id = 1;

        // Guardar   Save()
        if ($project->save()){
            return redirect()->route('projects.projectsIndex')->with('exito', 'La projecto se edito correctamente.');
        }else{
            return redirect()->route('projects.projectsIndex')->with('fracaso', 'La projecto no se puedo editar.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::find($id);
        $eliminados = Project::destroy($id);

        if ($eliminados < 0){
            return redirect()->route('projects.index')->with('fracaso', 'El proyecto no se pudo borrar.');
        }else {
            return redirect()->route('projects.index')->with('exito', 'El proyecto se elimino correctamente.');
        }
    }
}
