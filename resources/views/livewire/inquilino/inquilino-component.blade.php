<div>


    @if (session()->has('message'))
        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
            role="alert">
            <div class="flex">
                <div>
                    <p class="text-xm bg-lightgreen">{{ session('message') }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="d-flex">
        <h2 class="col-2"> Inquilinos </h2>
        <input class="ml-3 btn btn-info col-1" type="button" value="Nuevo" wire:click="Nuevo()" data-toggle="modal" data-target="#ModalNuevaInquilino">
        <input class="ml-3 w-full col-9 pr-5" type="text" placeholder="Buscar" wire:model="search" wire:keyup="Buscar()">
    </div>

    <table class="table table-stripped">
        <tr>
            <td>Apellido y Nombre - PERSONA FÍSICA</td>
            <td>Teléfono</td>
            <td>EMail</td>
            <td>Domicilio</td>
            <td>Opciones</td>
            {{-- <{{ $inquilinos_fisica->links() }}> --}}
        </tr>    
        @foreach($inquilinos_fisica as $inquilino)
            <tr>
                <td>{{ $inquilino->apellidos }}, {{ $inquilino->nombres }}</td>
                <td>{{ $inquilino->telefono }}</td>
                <td>{{ $inquilino->email_id }}</td>
                <td>{{ $inquilino->calle }} - {{ $inquilino->provinciadescripcion }} - {{ $inquilino->localidaddescripcion }}</td>
                <td><input class="btn btn-warning" value="Modificar" wire:click="edit({{ $inquilino->persona_id }},'fisica')"  data-toggle="modal" data-target="#ModalNuevaInquilino"></td>
            </tr>
        @endforeach
    </table>
    
    <table class="table table-stripped">
        <tr>
            <td>Razón Social - PERSONA JURÍDICA</td>
            <td>Teléfono</td>
            <td>EMail</td>
            <td>Domicilio</td>
            <td>Opciones</td>
            {{-- <{{ $inquilinos_juridica->links() }} --}}
        </tr>  
        @foreach($inquilinos_juridica as $inquilino)
            <tr>
                <td>{{ $inquilino->razonsocial }}</td>
                <td>{{ $inquilino->telefono }}</td>
                <td>{{ $inquilino->email_id }}</td>
                <td>{{ $inquilino->calle }} - {{ $inquilino->provinciadescripcion }} - {{ $inquilino->localidaddescripcion }}</td>
                <td><input class="btn btn-warning" value="Modificar" wire:click="edit({{ $inquilino->persona_id }},'juridica')" data-toggle="modal" data-target="#ModalNuevaInquilino"></td>
            </tr>
        @endforeach

    </table>

Persona: {{ $persona_type }}

    {{-- <div class="card card-primary card-tabs">
        <div class="card-header p-0 pt-1">
            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Inquilino</a>
                </li>
            </ul>
        </div>
        
        <div class="card-body">
            <div class="tab-content" id="custom-tabs-one-tabContent">
                <div wire:ignore.self class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
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
                            <div class="input-group mx-auto">
                                <input type="button" class="form-control btn-success mx-3 col-12" value="Guardar" wire:click="store()">
                            </div>
                        </div>
                        <div class="col-9 d-flex flex-wrap m-2 p-2 rounded-md" style="background-color: lightgray;border-radius: 5px;">
                            <div class="input-group mb-3 col-6">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-info">Tipo Pers.</button>
                                </div>
                                <select class="form-control col-12" wire:model="persona_type" wire:change="CambiarPersona('{{ $persona_type }}')">
                                    <option value="fisica">Persona física</option>
                                    <option value="juridica">Persona jurídica</option>
                                </select>
                            </div>
                            @if($persona_type=='fisica')
                                <div class="input-group mb-3 col-6">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-info">Cuil</button>
                                    </div>
                                    <input type="text" class="form-control" wire:model="cuil">
                                </div>
                            @else
                                <div class="input-group mb-3 col-6">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-info">Cuit</button>
                                    </div>
                                    <input type="text" class="form-control" wire:model="cuit">
                                </div>
                            @endif
                            @if($persona_type=='fisica')
                                <div class="input-group mb-3 col-6">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-info">Apellidos</button>
                                    </div>
                                    <input type="text" class="form-control" wire:model="apellidos">
                                </div>
                                <div class="input-group mb-3 col-6">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-info">Nombre(s)</button>
                                    </div>
                                    <input type="text" class="form-control" wire:model="nombres">
                                </div>
                                <div class="input-group mb-3 col-6">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-info">DNI</button>
                                    </div>
                                    <input type="text" class="form-control" wire:model="dni">
                                </div>
                            @else
                                <div class="input-group mb-3 col-12">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-info">Razón Social</button>
                                    </div>
                                    <input type="text" class="form-control" wire:model="razonsocial">
                                </div>
                            @endif
                            
                            <div class="input-group mb-3 col-6">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-info" @disabled(true)>Teléfono</button>
                                </div>
                                <input type="text" class="form-control" wire:model="telefono">
                            </div>
                            <div class="input-group mb-3 col-6">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-info">Whatsapp</button>
                                </div>
                                <input type="text" class="form-control" wire:model="whatsapp">
                            </div>
                            <div class="input-group mb-3 col-6">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-info">Emails</button>
                                </div>
                                <input type="text" class="form-control" wire:model="email_id">
                            </div>
                            <div class="input-group mb-3 col-6">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-info">Iva</button>
                                </div>
                                <select class="form-control col-12" wire:model="iva_id">
                                    <option value="0">-</option>
                                    @foreach($ivas as $iva)
                                        <option value="{{ $iva->id }}">{{ $iva->ivadescripcion}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if($persona_type=='fisica')
                                <div class="input-group mb-3 col-6">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-info">Fecha Nacimiento</button>
                                    </div>
                                    <input type="date" class="form-control" wire:model="fechanacimiento">
                                </div>
                            @else
                                <div class="input-group mb-3 col-6">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-info">Fecha Inicio Act.</button>
                                    </div>
                                    <input type="date" class="form-control" wire:model="fechainicioact">
                                </div>
                            @endif
                            <div class="input-group mb-3 col-xl-6">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-info">Domicilio</button>
                                </div>
                                <input type="text" class="form-control" wire:model="calle">
                            </div>
                            <div class="input-group mb-3 col-6">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-info">Provincia</button>
                                </div>
                                <select class="form-control col-12" wire:model="provincia_id">
                                    <option value="0">-</option>
                                    @foreach($provincias as $provincia)
                                        <option value="{{ $provincia->id }}">{{ $provincia->provinciadescripcion}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group mb-3 col-6">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-info">Localidad</button>
                                </div>
                                <select class="form-control col-12" wire:model="localidad_id">
                                    <option value="0">-</option>
                                    @foreach($localidades as $localidad)
                                        <option value="{{ $localidad->id }}">{{ $localidad->localidaddescripcion}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div @if($persona_type=='fisica') class="input-group mb-3 col-6" @else class="input-group mb-3 col-12" @endif>
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-info">Observaciones</button>
                                </div>
                                <input type="text" class="form-control" wire:model="observaciones">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}


        <!-- Modal Nueva Moneda -->
    <!-- ================== -->

    <div wire:ignore.self class="modal fade" id="ModalNuevaInquilino" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width: 70%; ">
            <div class="modal-content" style="width: inherit">
                <div class="modal-header">
                    <h5 class="modal-title">Datos del Inquilino</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="px-3 py-3">





                    <div  wire:ignore.self class="col-12 d-flex">
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
                            <div class="input-group mx-auto">
                                <input type="button" class="form-control btn-success mx-3 col-12" value="Guardar" wire:click="store()">
                            </div>
                        </div>
                        <div class="col-9 d-flex flex-wrap m-2 p-2 rounded-md" style="background-color: lightgray;border-radius: 5px;">
                            <div class="input-group mb-3 col-6">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-info">Tipo Pers.</button>
                                </div>
                                <div><input type="radio" name="persona" value="física" wire:click="CambiarPersona('fisica')"><label>Física</label></div>
                                <div><input type="radio" name="persona" value="jurídica" wire:click="CambiarPersona('juridica')"><label>Jurídica</label></div>

                                {{-- <select class="form-control col-12" wire:model="persona_type" wire:click="CambiarPersona({{ $persona_type }})" >
                                    <option value="fisica">Persona física</option>
                                    <option value="juridica">Persona jurídica</option>
                                </select> --}}
                            </div>
                            @if($persona_type=='fisica')
                                <div class="input-group mb-3 col-6">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-info">Cuil</button>
                                    </div>
                                    <input type="text" class="form-control" wire:model="cuil">
                                </div>
                            @else
                                <div class="input-group mb-3 col-6">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-info">Cuit</button>
                                    </div>
                                    <input type="text" class="form-control" wire:model="cuit">
                                </div>
                            @endif
                            @if($persona_type=='fisica')
                                <div class="input-group mb-3 col-6">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-info">Apellidos</button>
                                    </div>
                                    <input type="text" class="form-control" wire:model="apellidos">
                                </div>
                                <div class="input-group mb-3 col-6">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-info">Nombre(s)</button>
                                    </div>
                                    <input type="text" class="form-control" wire:model="nombres">
                                </div>
                                <div class="input-group mb-3 col-6">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-info">DNI</button>
                                    </div>
                                    <input type="text" class="form-control" wire:model="dni">
                                </div>
                            @else
                                <div class="input-group mb-3 col-12">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-info">Razón Social</button>
                                    </div>
                                    <input type="text" class="form-control" wire:model="razonsocial">
                                </div>
                            @endif
                            
                            <div class="input-group mb-3 col-6">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-info" @disabled(true)>Teléfono</button>
                                </div>
                                <input type="text" class="form-control" wire:model="telefono">
                            </div>
                            <div class="input-group mb-3 col-6">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-info">Whatsapp</button>
                                </div>
                                <input type="text" class="form-control" wire:model="whatsapp">
                            </div>
                            <div class="input-group mb-3 col-6">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-info">Emails</button>
                                </div>
                                <input type="text" class="form-control" wire:model="email_id">
                            </div>
                            <div class="input-group mb-3 col-6">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-info">Iva</button>
                                </div>
                                <select class="form-control col-12" wire:model="iva_id">
                                    <option value="0">-</option>
                                    @foreach($ivas as $iva)
                                        <option value="{{ $iva->id }}">{{ $iva->ivadescripcion}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if($persona_type=='fisica')
                                <div class="input-group mb-3 col-6">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-info">Fecha Nacimiento</button>
                                    </div>
                                    <input type="date" class="form-control" wire:model="fechanacimiento">
                                </div>
                            @else
                                <div class="input-group mb-3 col-6">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-info">Fecha Inicio Act.</button>
                                    </div>
                                    <input type="date" class="form-control" wire:model="fechainicioact">
                                </div>
                            @endif
                            <div class="input-group mb-3 col-xl-6">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-info">Domicilio</button>
                                </div>
                                <input type="text" class="form-control" wire:model="calle">
                            </div>
                            <div class="input-group mb-3 col-6">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-info">Provincia</button>
                                </div>
                                <select class="form-control col-12" wire:model="provincia_id">
                                    <option value="0">-</option>
                                    @foreach($provincias as $provincia)
                                        <option value="{{ $provincia->id }}">{{ $provincia->provinciadescripcion}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group mb-3 col-6">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-info">Localidad</button>
                                </div>
                                <select class="form-control col-12" wire:model="localidad_id">
                                    <option value="0">-</option>
                                    @foreach($localidades as $localidad)
                                        <option value="{{ $localidad->id }}">{{ $localidad->localidaddescripcion}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group mb-3 col-6">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-info">Observaciones</button>
                                </div>
                                <input type="text" class="form-control" wire:model="observaciones">
                            </div>
                            <div class="input-group mb-3 col-6">
                                <div class="input-group mx-auto">
                                    <input type="button" class="form-control btn-success mx-3 col-12" value="Guardar" wire:click="store()">
                                </div>
                            </div>

                        </div>
                    </div>
                

                    <div class="pt-3">
                        <button type="button" class="btn btn-success" data-dismiss="modal" wire:click="store()">
                            <i class="fa-solid fa-pen-to-square"></i>Agregar
                        </button>
                        <button type="button" class="btn btn-info" data-dismiss="modal" aria-label="Close">
                            <i class="fa-solid fa-pen-to-square"></i>Cerrar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
