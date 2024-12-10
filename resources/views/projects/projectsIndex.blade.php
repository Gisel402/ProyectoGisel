@extends('layout.plantilla')
@section('titulo', 'Proyectos')
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

        <span><H3>| Proyectos</H3></span><br>

        <div class="row">
            @foreach($projects as $project)
                <div class="col-6">
                    <div class="card text-center" style="margin: 10px; width: 96%;">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-10" style="text-align: left;">
                                    Estado: {{$project->estado}}
                                </div>
                                <div class="col-2">
                                    <a href="{{ route('projects.show', ['id'=> $project->id]) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $project->nombre }}</h5>
                            <p class="card-text">| Descripcion: {{ $project->descripcion }} |</p>
                            <p>
                            <div class="progress" role="progress-container" aria-label="Default striped example" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar progress-bar" @if($project->estado == 'Activo') style="width: 50%;" @else style="width: 100%;"  @endif></div>
                            </div>
                            </p>
                        </div>
                        <div class="card-footer text-body-secondary">
                            Ultima actualizacion: {{$project->updated_at->diffForHumans()}}
                        </div>
                    </div>
                </div>

            @endforeach
        </div>

@endsection
