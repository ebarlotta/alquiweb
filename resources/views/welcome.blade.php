<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<body>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>AlquiWeb</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>


<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">


<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

        {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
            integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
            integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
        </script> --}}

        <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">



        <!-- Styles -->
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                color: #333;
            }

            .container {
                width: 80%;
                margin: auto;
                overflow: hidden;
            }

            header {
                background: url('path/to/hero-image.jpg') no-repeat center center/cover;
                color: #fff;
                padding: 80px 0;
                text-align: center;
            }

            header h1 {
                font-size: 3rem;
                margin-bottom: 10px;
            }

            header p {
                font-size: 1.2rem;
                margin-bottom: 20px;
            }

            .btn-primary {
                background-color: #f4a261;
                color: #fff;
                padding: 10px 20px;
                text-decoration: none;
                font-size: 1.1rem;
                border-radius: 5px;
            }

            section {
                padding: 40px 0;
            }

            #services {
                background-color: #f4f4f4;
                text-align: center;
            }

            .service-card {
                display: inline-block;
                width: 22%;
                margin: 20px;
                padding: 20px;
                background-color: #fff;
                border-radius: 5px;
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            }

            #listings .property-card {
                display: inline-block;
                width: 45%;
                margin: 20px;
                background-color: #fff;
                border-radius: 5px;
                overflow: hidden;
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            }

            .property-card img {
                width: 100%;
            }

            .btn-secondary {
                display: inline-block;
                padding: 10px 20px;
                margin-top: 10px;
                background-color: #2a9d8f;
                color: #fff;
                text-decoration: none;
                border-radius: 5px;
            }

            footer {
                background-color: #333;
                color: #fff;
                text-align: center;
                padding: 20px 0;
            }

            footer p {
                margin: 10px 0;
            }

            footer a {
                color: #f4a261;
                text-decoration: none;
            }
        </style>
    </head>

    <body>
        {{-- <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
            <div
                class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
                <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                    <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                        @if (Route::has('login'))
                            <nav class="-mx-3 flex flex-1 justify-end">
                                @auth
                                    <a href="{{ url('/dashboard') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                        Dashboard
                                    </a>
                                @else
                                    <a href="{{ route('login') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                        Log in
                                    </a>

                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}"
                                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                            Register
                                        </a>
                                    @endif
                                @endauth
                            </nav>
                        @endif

                        <div class="container">
                            <h1>Encuentra tu nuevo hogar</h1>
                            <p>Alquiler de viviendas, departamentos, terrenos y más</p>
                            <a href="#listings" class="btn-primary">Explorar Propiedades</a>
                        </div>

                    </header>
                </div>
            </div>
        </div> --}}
        {{-- <script src="../../plugins/jquery/jquery.min.js"></script>
        <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../../dist/js/adminlte.min.js?v=3.2.0"></script>
        <script src="../../dist/js/demo.js"></script> --}}

        {{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> --}}

        <div>
            <div class="izquierda">
                <div class="head_izquierda">
                    <div class="col-12">
                        <div class="card card-primary card-tabs">
                            <div class="card-header p-0 pt-1">
                                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="false">Carátula del Inmueble</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Fotos</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Historial del Inmueble</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-one-tabContent">
                                    <div class="tab-pane fade" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                        <!-- Primer Tab -->
                                        <div class="col-12 d-flex">
                                            <div class="col-10">
                                                <div class="col-12 d-flex">
                                                    <div class="col-6 m-2 p-2 rounded-md" style="background-color: lightgray;border-radius: 5px;">
                                                        <p>
                                                            <iframe style="border: 0;"
                                                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2982.247079534762!2d-4.7054737490897605!3d41.62879048885612!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd4712e13eeba1f7%3A0xad9ad7b9a39491c2!2sMappingGIS!5e0!3m2!1ses!2ses!4v1665138007578!5m2!1ses!2ses"
                                                                width="100" height="100"
                                                                allowfullscreen="allowfullscreen">
                                                            </iframe>
                                                        </p>
                                                    </div>
                                                    <div class="col-6 m-2 p-2 rounded-md"   style="background-color: lightgray;border-radius: 5px;">
                                                        <div class="input-group mb-3 col-xl-6">
                                                            <div class="input-group-prepend">
                                                                <button type="button" class="btn btn-info">Tipo</button>
                                                            </div>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="input-group mb-3 col-xl-6">
                                                            <div class="input-group-prepend">
                                                                <button type="button" class="btn btn-info">Código</button>
                                                            </div>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="input-group mb-3 px-2">
                                                            <div class="input-group-prepend">
                                                                <button type="button" class="btn btn-info">Calle</button>
                                                            </div>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="input-group mb-3 col-xl-6">
                                                            <div class="input-group-prepend">
                                                                <button type="button" class="btn btn-info">Altura</button>
                                                            </div>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="input-group mb-3 col-xl-6">
                                                            <div class="input-group-prepend">
                                                                <button type="button" class="btn btn-info">Depto</button>
                                                            </div>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="input-group mb-3 px-2">
                                                            <div class="input-group-prepend">
                                                                <button type="button" class="btn btn-info">Provincia</button>
                                                            </div>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="input-group mb-3 px-2">
                                                            <div class="input-group-prepend">
                                                                <button type="button" class="btn btn-info">Localidad</button>
                                                            </div>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="input-group mb-3 px-3 m-2 p-2 rounded-md"   style="background-color: lightgray;border-radius: 5px;">
                                                        <div class="input-group-prepend">
                                                            <button type="button" class="btn btn-info">Observaciones</button>
                                                        </div>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-2 m-2 p-2 rounded-md" style="background-color: lightcoral;border-radius: 5px;">
                                                <a class="btn btn-app bg-success col-10">
                                                    <span class="badge bg-purple">891</span>
                                                    <i class="ion ion-person-add"></i>
                                                    <i class="fas fa-users"></i> Inmueble
                                                </a>
                                                <a class="btn btn-app bg-success col-10">
                                                    <span class="badge bg-purple">891</span>
                                                    <i class="fas fa-users"></i> Propietario
                                                </a>
                                                <a class="btn btn-app bg-success col-10">
                                                    <span class="badge bg-purple">891</span>
                                                    <i class="fas fa-users"></i> Inquilino
                                                </a>
                                                <a class="btn btn-app bg-success col-10">
                                                    <span class="badge bg-purple">891</span>
                                                    <i class="fas fa-users"></i> Contrato
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                                        <div class="col-12 d-flex">
                                            <div class="col-3 m-2 p-2 rounded-md"style="background-color: lightgray;border-radius: 5px;">
                                                <img src="" alt="" width="100px" height="100px">
                                                <button type="button" class="btn btn-block bg-gradient-info btn-sm">Cambiar Foto</button>
                                                <button type="button" class="btn btn-block bg-gradient-info btn-sm">Asignar Persona</button>
                                                <button type="button" class="btn btn-block bg-gradient-warning btn-sm">Desvincular</button>
                                                <label for="">Liquidación Fraccionada</label>
                                                <div class="input-group mb-3 col-xl-6">
                                                    <div class="input-group-prepend">
                                                        <button type="button" class="btn btn-info">Porcentaje</button>
                                                    </div>
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-9 d-flex flex-wrap m-2 p-2 rounded-md"   style="background-color: lightgray;border-radius: 5px;">
                                                <div class="input-group mb-3 col-6">
                                                    <div class="input-group-prepend">
                                                        <button type="button" class="btn btn-info">Apellidos</button>
                                                    </div>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="input-group mb-3 col-6">
                                                    <div class="input-group-prepend">
                                                        <button type="button" class="btn btn-info">Nombre(s)</button>
                                                    </div>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="input-group mb-3 col-6">
                                                    <div class="input-group-prepend">
                                                        <button type="button" class="btn btn-info">Cuit</button>
                                                    </div>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="input-group mb-3 col-6">
                                                    <div class="input-group-prepend">
                                                        <button type="button" class="btn btn-info">DNI</button>
                                                    </div>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="input-group mb-3 col-6">
                                                    <div class="input-group-prepend">
                                                        <button type="button" class="btn btn-info">Teléfonos</button>
                                                    </div>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="input-group mb-3 col-6">
                                                    <div class="input-group-prepend">
                                                        <button type="button" class="btn btn-info">Whatsapp</button>
                                                    </div>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="input-group mb-3 col-6">
                                                    <div class="input-group-prepend">
                                                        <button type="button" class="btn btn-info">Emails</button>
                                                    </div>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="input-group mb-3 col-6">
                                                    <div class="input-group-prepend">
                                                        <button type="button" class="btn btn-info">Iva</button>
                                                    </div>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="input-group mb-3 col-6">
                                                    <div class="input-group-prepend">
                                                        <button type="button" class="btn btn-info">Fecha Nacimiento</button>
                                                    </div>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="input-group mb-3 col-xl-6">
                                                    <div class="input-group-prepend">
                                                        <button type="button" class="btn btn-info">Domicilio</button>
                                                    </div>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="input-group mb-3 col-6">
                                                    <div class="input-group-prepend">
                                                        <button type="button" class="btn btn-info">Provincia</button>
                                                    </div>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="input-group mb-3 col-6">
                                                    <div class="input-group-prepend">
                                                        <button type="button" class="btn btn-info">Localidad</button>
                                                    </div>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="input-group mb-3 col-xl-6">
                                                    <div class="input-group-prepend">
                                                        <button type="button" class="btn btn-info">Observaciones</button>
                                                    </div>
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                                        <div class="col-12 d-flex flex-wrap">
                                            <div class="col-12 col-sm-6">
                                                <div class="card text-white bg-primary mb-3" style="background-color: lightblue;border-radius: 5px;">
                                                    <div class="card-header">Fechas</div>
                                                    <div class="card-body d-flex flex-wrap">
                                                        <div class="input-group mb-3 col-12 col-sm-6">
                                                            <div class="input-group-prepend">
                                                                <button type="button" class="btn btn-info">Duración</button>
                                                            </div>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="input-group mb-3 col-12 col-sm-6">
                                                            <div class="input-group-prepend">
                                                                <button type="button" class="btn btn-info">Cuotas</button>
                                                            </div>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="input-group mb-3 col-12 col-sm-6">
                                                            <div class="input-group-prepend">
                                                                <button type="button" class="btn btn-info">Inicio</button>
                                                            </div>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="input-group mb-3 col-12 col-sm-6">
                                                            <div class="input-group-prepend">
                                                                <button type="button" class="btn btn-info">Fin</button>
                                                            </div>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="input-group mb-3 col-12 col-sm-6">
                                                            <div class="input-group-prepend">
                                                                <button type="button" class="btn btn-info">Observaciones</button>
                                                            </div>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card text-white mb-3" style="background-color: lightgreen;">
                                                    <div class="card-header">Detalles</div>
                                                    <div class="card-body">
                                                        <div class="input-group mb-3 col-xl-6">
                                                            <div class="input-group-prepend">
                                                                <button type="button" class="btn btn-info">Administra Alquiler</button>
                                                            </div>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="input-group mb-3 col-xl-6">
                                                            <div class="input-group-prepend">
                                                                <button type="button" class="btn btn-info">F.de Pago Inq.</button>
                                                            </div>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="card text-white mb-3"  style="background-color: lightgray;border-radius: 5px;">
                                                    <div class="card-header">Valores</div>
                                                    <div class="card-body">
                                                        <div class="input-group mb-3 col-xl-6">
                                                            <div class="input-group-prepend">
                                                                <button type="button" class="btn btn-info">Moneda</button>
                                                            </div>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="input-group mb-3 col-xl-6">
                                                            <div class="input-group-prepend">
                                                                <button type="button" class="btn btn-info">Actualización</button>
                                                            </div>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="input-group mb-3 col-xl-6">
                                                            <div class="input-group-prepend">
                                                                <button type="button" class="btn btn-info">Tipo Ajuste</button>
                                                            </div>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <hr>

                                                        <div>
                                                            <div class="d-flex justify-content-around">
                                                                <div>Desde</div>
                                                                <div>Hasta</div>
                                                                <div>Valor</div>
                                                            </div>
                                                            <div>
                                                                <div class="d-flex justify-content-around">
                                                                    <div>Cuota 1 <label style="font-size: 0.7rem">01/08/2024</label></div>
                                                                    <div>Cuota 12<label style="font-size: 0.7rem">31/07/2025</label></div>
                                                                    <div><input type="text" size="6"><label  style="font-size: 0.7rem">Valor Actual</label></div>
                                                                </div>
                                                                <div class="d-flex justify-content-around">
                                                                    <div>Cuota 13 <label style="font-size: 0.7rem">01/08/2025</label></div>
                                                                    <div>Cuota 24<label style="font-size: 0.7rem">31/07/2026</label></div>
                                                                    <div><input type="text" size="6"><label  style="font-size: 0.7rem">Valor Actual</label></div>
                                                                </div>
                                                                <div class="d-flex justify-content-around">
                                                                    <div>Cuota 25 <label style="font-size: 0.7rem">01/08/2026</label></div>
                                                                    <div>Cuota 36<label style="font-size: 0.7rem">31/07/2027</label></div>
                                                                    <div><input type="text" size="6"><label  style="font-size: 0.7rem">Valor Actual</label></div>
                                                                </div>
                                                            </div>

                                                            <div class="alert justify-content-around" role="alert"  style="background-color: lightyellow;color: black;">
                                                                <i class="fa fa-exclamation-circle justify-content-around"></i>
                                                                <p class="black">Este contrato no tiene conceptos</p>
                                                                <hr>
                                                                <div class="input-group-prepend justify-content-around">
                                                                    <button type="button" class="btn btn-info">Agregar Coneptos</button>
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
                        </div>
                    </div>
                <div class="contenido_izquierda"></div>
            </div>
        </div>
    </body>



    <footer>
        <div class="container">
            <p>© 2024 Alquiler de Unidades Habitacionales. Todos los derechos reservados.</p>
            <p><a href="#">Política de Privacidad</a> | <a href="#">Términos y Condiciones</a></p>
        </div>
    </footer>
</body>
</html>

</div>

</main>

<footer class="py-16 text-center text-sm text-black dark:text-white/70">
    Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
</footer>
</div>
</div>
</div>
</body>

</html>
