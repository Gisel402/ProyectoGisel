@extends('layout.plantilla')
@section('titulo', 'Crear Proyecto')
@section('contenido')

    @if(isset($publicacion))
        <span><H3>|  Editar proyecto</H3></span><br>
    @else
        <span><H3>|  Crear nuevo proyecto</H3></span><br>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" style="margin-left: 1rem; margin-right: 1rem;"
          @if(isset($project))
              action="{{ route('projects.update', ['id'=>$project->id]) }}"
          @else
              action="{{ route('projects.store') }}"
        @endif
    >
        @csrf
        @if(isset($project))
            @method('put')
        @endif
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-19" style="text-align: left;">
                                <div class="row g-3">
                                    <div class="col-md-19" >
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="nombre" placeholder="nombre" name="nombre" value="{{ isset($project) ? $project->nombre : old('nombre') }}" >
                                            <label for="nombre">Nombre del proyecto</label>
                                        </div>

                                        <div class="form-floating mb-3" >
                                            <input type="text" class="form-control" id="descripcion" placeholder="descripcion" name="descripcion" value="{{ isset($project) ? $project->descripcion : old('descripcion') }}" >
                                            <label for="descripcion">Ingresa la descripcion...</label>
                                        </div>

                                        <div class="col-md-19" style="margin-top: 15px;">
                                            <div class="form-floating">
                                                <select class="form-select" id="profesor_id" aria-label="Floating label select example" name="profesor_id">
                                                    <option selected>Seleccione un Profesor</option>
                                                    @forelse($profesores as $profesor)
                                                        <option value="{{ $profesor->id }}"
                                                        @if(isset($project))
                                                            {{ $profesor->id == $project->profesor_id ? "selected" : "" }}>
                                                            @else
                                                                {{ $profesor->id == old('profesor_id') ? "selected" : "" }}>
                                                            @endif
                                                            {{ $profesor->nombre }}</option>
                                                    @empty
                                                        <option value="0">No hay profesores</option>
                                                    @endforelse
                                                </select>
                                                <label for="Profesor">Profesor</label>
                                            </div>
                                        </div>

                                        <div class="col-md-19" style="margin-top: 15px;">
                                            <div class="form-floating">
                                                <select class="form-select" id="estado" aria-label="Floating label select example" name="estado">
                                                    <option selected>Seleccione el estado de su entrega</option>
                                                    <option>Activo</option>
                                                    <option>Completado</option>
                                                    @if(isset($project))
                                                        <option selected>{{ $project->estado }}</option>
                                                    @endif
                                                </select>
                                                <label for="Estado">Estado</label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <p></p>
        <input class="btn btn-primary" type="submit" value="Guardar" style="margin-left: 1rem;">
        <input class="btn btn-danger" type="reset" value="Limpiar" style="margin-left: 1rem;">

    </form>

@endsection
