@extends('layout.plantilla')
@section('titulo', 'Ver Usuarios')
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
    @if(isset($profesores))
        <span><H3>| Profesores</H3></span><br>
    @endif

    @if(isset($estudiantes))
        <span><H3>| Estudiantes</H3></span><br>
    @endif


        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Email</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($profesores))
                @foreach($profesores as $profesor)
                    <tr>
                        <td>{{  $profesor->nombre  }}</td>
                        <td>{{  $profesor->email  }}</td>
                    </tr>
                @endforeach
            @endif

            @if(isset($estudiantes))
                @foreach($estudiantes as $estudiante)
                    <tr>
                        <td>{{  $estudiante->nombre  }}</td>
                        <td>{{  $estudiante->email  }}</td>
                    </tr>
                @endforeach
            @endif

            </tbody>
        </table>

@endsection
