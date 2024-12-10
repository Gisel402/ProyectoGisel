<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('titulo')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body {
            background-color: #f0f0f0;
        }
    </style>

    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 2000px;
        }

        .left-section {
            position: fixed;
            top: 55px;
            left: 0;
            width: 250px;
            height: 100%;
            background-color: #ffffff;
            padding: 20px;
            box-sizing: border-box;
            border-color: #100f0f;
        }

        .left-section h2 {
            color: #333;
        }

        .left-section p {
            color: #666;
        }

        .progress-container {
            width: 100%;
            height: 30px;
            background-color: #f3f3f3;
            border-radius: 10px;
            position: relative;
        }

        /* Barra de progreso */
        .progress-bar {
            height: 100%;
            width: 70%; /* Cambiar este valor para simular el progreso */
            background-color: #4caf50;
            border-radius: 10px;
        }

        .custom-card-header {
            background-color: #86b788;  /* Aquí defines el color de fondo */
            color: white;               /* Color del texto */
        }



    </style>


</head>
<body>

<section>
    <div class="card" style="margin-left: 17rem; top: 80px; width: 80%;">
        <div class="card-body">

            @yield("contenido")

        </div>
    </div>
</section>

<div class="left-section">
    <br>
    <a href="{{ route('projects.create') }}" class="btn btn-primary " style="margin: 10px;"><h5>+ Crear Proyecto</h5></a>
    <hr>
    <a href="{{ route('projects.index') }}" class="btn btn-light " style="margin: 5px;"><h6>༄ Proyectos</h6></a>
    <a href="{{ route('users.profesores') }}" class="btn btn-light " style="margin: 5px;"><h6>༄ Profesores</h6></a>
    <a href="{{ route('users.estudiantes') }}" class="btn btn-light " style="margin: 5px;"><h6>༄ Estudiantes</h6></a>

    <div style="margin-top: 300px">
        <hr>
        <form action="{{route('projects.search')}}"  class="d-flex" role="search">
            <div class="row">
                <div class="col-9">
                    <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search" id="nombre" name="nombre">
                </div>
                <div class="col"-1>
                    <button class="btn btn-outline-success btn-sm" type="submit"><i class="fas fa-search"></i></button>
                    <span class="glyphicon glyphicon-search"></span>
                </div>
            </div>

        </form>
        <hr>

    </div>



</div>

<nav class="navbar navbar-expand-lg bg-body-tertiary" style="position: fixed; width: 100%; top: 0; background-color: #012265 !important;">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><h3 style="color: #ffffff;">| | | Sistema de Gestion de Proyectos</h3></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li>
                    <div class="btn-group" style="left: 700%;">
                        <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i>  UserName
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-dropdown-link :href="route('logout')"
                                                         onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form></a></li>
                            <li><a class="dropdown-item" href="{{ route('projects.filtro') }}">Mis proyectos</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
