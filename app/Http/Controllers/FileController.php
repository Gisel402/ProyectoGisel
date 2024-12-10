<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Project;
use Illuminate\Http\Request;

class FileController extends Controller
{

    public function upload(Request $request){
    // Validar el archivo
    $request->validate([
        'nombre'=> 'required|max:300|regex:/[a-zA-Z0-9 ]+/',
        'file' => 'required|file|mimes:jpg,png,pdf,docx|max:10240', // Tamaño máximo de 10MB
    ]);

    // Subir el archivo al disco local
    if ($request->hasFile('file') && $request->file('file')->isValid()) {
        $file = $request->file('file');

        // Guardar el archivo en el directorio 'uploads' dentro de 'storage/app'
        $path = $file->store('uploads');

        $files = new File();
        $files->nombre = $request->input('nombre');
        $files->ruta = $path;
        $files->project_id = $request->input('id');

        if ($files->save()){
            return redirect()->route('projects.show', ['id'=>$files->project_id])->with('exito', 'El archivo se subio correctamente.');
        }
        //return response()->json(['message' => 'Archivo subido exitosamente!', 'path' => $path]);
    }

    return redirect()->route('projects.show', ['id'=>$files->project_id])->with('fracaso', 'El archivo no se pudo subir.');
    //return response()->json(['message' => 'Hubo un error al subir el archivo'], 400);
    }

    /**
     * Download.
     */

    public function download($id)
    {
        $file = File::find($id);
        $filename = $file->ruta;
        // Comprobar si el archivo existe en el almacenamiento
        $path = storage_path('app/uploads/' . $filename);

        if (file_exists($path)) {
            return response()->download($path)->redirect()->route('projects.show', ['id'=>$file->project_id])->with('exito', 'El archivo se descargo correctamente.');

            //return redirect()->route('projects.show', ['id'=>$files->project_id])->with('exito', 'El archivo se descargo correctamente.');

        }

        return redirect()->route('projects.show', ['id'=>$file->project_id])->with('fracaso', 'El archivo no se pudo descargar.');
        //return response()->json(['message' => 'Archivo no encontrado'], 404);
    }

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
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $file = File::find($id);
        $project = Project::where('id', $file->project_id)->first();
        $eliminados = File::destroy($id);

        if ($eliminados < 0){
            return redirect()->route('projects.show', ['id'=>$project->id])->with('fracaso', 'El archivo no se pudo borrar.');
        }else {
            return redirect()->route('projects.show', ['id'=>$project->id])->with('exito', 'El archivo se elimino correctamente.');
        }
    }
}
