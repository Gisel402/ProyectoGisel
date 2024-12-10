<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Project;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id)
    {
        // Validar los datos
        //$request->validate([
        //'contenido' => 'required|max:500|regex:/[a-zA-Z0-9 ]+/',
        //]);
        // Crear una nueva publicacion 17
        $project = Project::findOrFail($id);
        $comment = new Comment();
        // Asignamos valores de la publicacion
        $comment->contenido = $request->input('comentario');
        $comment->user_id = 1;
        $comment->project_id = $project->id;


        // Guardar   Save()
        if ($comment->save()){
            //Mensaje,  se creo correctamente
            return redirect()->route('projects.show',['id'=>$comment->project_id])->with('exito', 'El comentario se envio correctamente.');
        }else{
            //Mensaje, no se pudo crear
            return redirect()->route('projects.show',['id'=>$comment->project_id])->with('fracaso', 'El comentario no se puedo enviar.');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $idp, string $idc)
    {
        $comment = Comment::findOrFail($idc);
        // Asignamos valores de la publicacion
        $comment->contenido = $request->input('contenido');
        $comment->user_id = 1;
        $comment->project_id = $idp;


        // Guardar   Save()
        if ($comment->save()){
            //Mensaje,  se creo correctamente
            return redirect()->route('projects.show',['id'=>$comment->project_id])->with('exito', 'El comentario se edito correctamente.');
        }else{
            //Mensaje, no se pudo crear
            return redirect()->route('projects.show',['id'=>$comment->project_id])->with('fracaso', 'El comentario no se puedo editar.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment = Comment::find($id);
        $project = Project::where('id', $comment->project_id)->first();
        $eliminados = Comment::destroy($id);

        if ($eliminados < 0){
            return redirect()->route('projects.show', ['id'=>$project->id])->with('fracaso', 'El comentario no se pudo borrar.');
        }else {
            return redirect()->route('projects.show', ['id'=>$project->id])->with('exito', 'El comentario se elimino correctamente.');
        }
    }
}
