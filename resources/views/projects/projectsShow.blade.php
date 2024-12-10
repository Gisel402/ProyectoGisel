@extends('layout.plantilla')
@section('titulo', 'Ver Proyecto')
@section('contenido')

    @if(session('exito'))
        <div class="alert alert-success" role="alert">
            {{ session('exito') }}
        </div>
    @endif
    @if(session('fracaso'))
        <div class="alert alert-danger" role="alert">
            {{ session('fracaso') }}
        </div>
    @endif

    <span><H3>|  Proyecto: {{ $project->nombre }}</H3></span><br>

    <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-10" style="text-align: left;">
                                Estado: {{$project->estado}}
                            </div>
                            <div class="col-1" style="margin-left: 70px;">
                                <a href="{{ route('projects.edit', ['id'=> $project->id]) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#MODALELIMINARC{{$project->id}}" >
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                            <div class="col-1">


                                <!-- Modal ELIMINAR-->
                                <div class="modal fade" id="MODALELIMINARC{{$project->id}}" tabindex="-1" aria-labelledby="MODALELIMINARCLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="MODALELIMINARCLabel">Eliminar Proyecto</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Estas seguro que quieres eliminar el proyecto?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <form method="post" action="{{ route('projects.destroy' , ['id'=>$project->id]) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <input type="submit" value="Eliminar" class="btn btn-danger">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Descripcion:</h5>
                        <p class="card-text">{{$project->descripcion}}</p>
                        <p class="card-text">Estudiante: {{$estudiante->nombre}}  |  Profesor: {{$profesor->nombre}}</p>
                        <div class="row">
                            <div class="col-1">
                                <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample1">
                                    Comentarios
                                </button>
                            </div>

                            <div class="col-1">
                                <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample2" style="margin-left: 15px;">
                                    Evaluacion
                                </button>
                            </div>

                            <div class="col-2">
                                <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#descargar" aria-expanded="false" aria-controls="descargar" style="margin-left: 20px;">
                                    Ver Archivos
                                </button>
                            </div>

                            <div  class="col-2">
                                <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions" style="margin-left: -55px;">Cargar Archivo</button>
                            </div>


                            <div class="offcanvas offcanvas-centered" style="top: 50%; left: 50%; transform: translate(-50%, -50%); width: 80%; position: fixed;" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
                                <div class="offcanvas-header">
                                    <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Cargar Archivos</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body">
                                    <form action="{{ route('upload.file') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="card">
                                            <div class="card-header">
                                            </div>
                                            <div class="card-body">
                                                <h6 class="card-title">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="nombre" placeholder="nombre" name="nombre" value="" >
                                                        <label for="nombre">Nombre del archivo</label>
                                                    </div></h6>
                                                <p class="card-text"><label for="file">Selecciona un archivo:</label>
                                                    <input style="margin-left: 15px;" type="file" name="file" id="file" required></p>
                                                <p><button class="btn btn-success" type="submit">Subir Archivo</button></p>

                                                <div class="form-floating mb-3">
                                                    <input type="number" class="form-control" id="id" placeholder="id" name="id" value="{{ $project->id }}" >
                                                    <label for="nombre">Proyecto</label>
                                                </div></h6>
                                            </div>
                                            <div class="card-footer"></div>

                                        </div>


                                    </form>

                                </div>
                            </div>

                            <div class="collapse" id="collapseExample2">
                                <hr>
                                <div class="card card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item" >
                                            <div class="row">
                                                <div class="col-11">
                                                    <h6><strong>Evaluacion: </strong></h6>
                                                    <strong>No Calificado</strong>
                                                    <p></p>
                                                    Profesor: {{ $profesor->nombre }}
                                                </div>
                                                <div class="col-1">
                                                    <button class="btn btn-primary btn-sm"  type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample3" aria-expanded="false" aria-controls="collapseExample2" style="margin-left: 15px;">
                                                        <i class="fas fa-edit"></i>

                                                    </button>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <p></p>
                            </div>

                            <div class="collapse" id="collapseExample1">
                                <hr>
                                <div class="card card-body">
                                    <ul class="list-group list-group-flush">
                                        @foreach($comments as $comment)
                                            <li class="list-group-item" >
                                                <h6><strong>{{ $comment->user_id }}</strong></h6>
                                                {{ $comment->contenido }}
                                                <div>
                                                    <!-- Button trigger MODAL ELIMINAR -->
                                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#MODALELIMINARC{{$comment->id}}" style="margin-left: 63rem;">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>

                                                    <!-- Modal ELIMINAR-->
                                                    <div class="modal fade" id="MODALELIMINARC{{$comment->id}}" tabindex="-1" aria-labelledby="MODALELIMINARCLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="MODALELIMINARCLabel">Eliminar Comentario</h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Estas seguro que quieres eliminar el comentario?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <form method="post" action="{{ route('comments.destroy' , ['id'=>$comment->id]) }}">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <input type="submit" value="Eliminar" class="btn btn-danger">
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <p></p>

                                <form method="post" action="{{ route('comments.store', ['id'=>$project->id]) }}" style="margin-left: 1px;">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-md-11">
                                            <div class="col-md-19">
                                                <div class="form-floating">
                                                    <div class="form-floating">
                                                        <textarea class="form-control" placeholder="comentario" id="comentario" name="comentario" style="height: 100px" value=" "></textarea>
                                                        <label for="comentario">Escribe un comentario...</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-1" >
                                            <div class="row">
                                                <input class="btn btn-primary btn-g" type="submit" value="Env" style="margin-left: 0.05rem; margin-top: 0.5rem;">
                                            </div>
                                            <div class="row">
                                                <input class="btn btn-danger btn-g" type="reset" value="Cancel" style="margin-left: 0.05rem; margin-top: 0.5rem;">
                                            </div>

                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="collapse" id="descargar">
                                <hr>
                                <div class="card card-body">
                                    <ul class="list-group list-group-flush">
                                        @foreach($files as $file)

                                            <li class="list-group-item" >
                                             <div class="row">
                                                 <div class="col-9" style="text-align: left;">
                                                     <h6><i class="fas fa-file"></i> | {{ $file->nombre }}</h6>
                                                 </div>
                                                 <div class="col-2" style="margin-left: 70px;">
                                                    <a href="{{ route('download.file', ['id'=> $file->id]) }}" class="btn btn-primary btn-sm"><i class="fas fa-download"></i></a>
                                                    <!-- Button trigger MODAL ELIMINAR -->
                                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#MODALELIMINARC{{$file->id}}" style="margin-left: 15px;">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </div>
                                            </div>








                                                    <!-- Modal ELIMINAR-->
                                                <div class="modal fade" id="MODALELIMINARC{{$file->id}}" tabindex="-1" aria-labelledby="MODALELIMINARCLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="MODALELIMINARCLabel">Eliminar Comentario</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>

                                                            <div class="modal-body">
                                                                Estas seguro que quieres eliminar el archivo {{ $file->nombre }}?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <form method="post" action="{{ route('files.destroy' , ['id'=>$file->id]) }}">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <input type="submit" value="Eliminar" class="btn btn-danger">
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <p></p>
                            </div>



                        </div>



                    </div>

                    </div>
                </div>
            </div>
    </div>


                <div class="card text-center" style="margin: 10px; width: 96%;">
                    <p></p>
                        <div class="progress" role="progressbar" aria-label="Default striped example" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar progress-bar-striped" style="width: 90%"></div>
                        </div>
                        </p>
                    </div>
                    <div class="card-footer text-body-secondary">
                        Ultima actualizacion: {{$project->updated_at->diffForHumans()}}
                    </div>
                </div>
            </div>
    </div>

@endsection
