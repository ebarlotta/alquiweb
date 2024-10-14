<div>
    @if(Session::has('mensaje'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div class="header"><i class="notched circle loading icon"></i> <b> Éxito </b></div> 
            {{Session::get('mensaje')}}
        </div>  
    @endif
    <div class="card card-info offset-md-1 col-10 text-center">

        <div class="d-flex justify-content-around">
            <div class="d-flex mt-3 align-items-center" style="justify-content: center;">
                <h1>Listado de Contratos</h1>
                <input type="button" class="btn btn-success col-1 ml-2" style="height:30px; width: 100px; padding-top: 2px;" value="+" wire:click="NuevoContrato()">
            </div>
            <div class="d-flex align-items-center">
                <div><input class="mr-1" type="radio" name="todos" value="0" wire:click="CambiarVista(0)" checked>Todos</div>
                <div class="ml-4"><input class="mr-1" type="radio" name="todos" value="1" wire:click="CambiarVista(1)">Sólo activos</div>
            </div>
            <div class="d-flex align-items-center">
                <input class="form-control" type="text" wire:modal="search" wire:keyup="CambiarVista()">
            </div>
            <div class="d-flex align-items-center">
                {{-- {{ $contratos->links() }} --}}
                {{-- {!! $contratos->appends(Request::all())->links() !!} --}}
                {{-- {!! $contratos->render() !!} --}}
            </div>
        </div>
<div>

        <div class="card-body">
            <table class="table table-striped">
                <tr>
                {{-- <td>Id</td> --}}
                <td>FechaInicio</td>
                <td>Fecha Fin</td>
                <td>Inquilino</td>
                <td>Propietario</td>
                {{-- <td>Garante/s</td> --}}
                <td>Domicilio</td>
                <td>Opciones</td>
            </tr>
            @foreach ($contratos as $contrato)
                {{-- @if(!$contrato->activo) --}}
                    <tr @if(!$contrato->activo) style="color: burlywood;" @endif>
                        {{-- <td>{{ $contrato->id }}</td> --}}
                        <td>{{  substr($contrato->fechainicio,8,2).'-'.substr($contrato->fechainicio,5,2).'-'.substr($contrato->fechainicio,0,4) }}</td>
                        <td>{{  substr($contrato->fechafin,8,2).'-'.substr($contrato->fechafin,5,2).'-'.substr($contrato->fechafin,0,4) }}</td>
                        <td>{{ $contrato->inquilino() }}</td>
                        <td>{{ $contrato->propietario() }}</td>
                        <td>domicilio</td>
                        {{-- <td>{!! $contrato->garantes($contrato->id) !!}</td> --}}
                        <td>
                            <label style="border-radius: 10px;background-color: lightcoral ;padding: 2px 10px 2px 10px;" wire:click="modalEliminarContrato({{ $contrato->id }})" @if(!$contrato->activo) @disabled(true) @endif>Eliminar</label>
                            <label style="border-radius: 10px;background-color: lightgreen ;padding: 2px 10px 2px 10px;" wire:click="CargarIdContrato({{ $contrato->id }})" @if(!$contrato->activo) @disabled(true) @endif>Modificar</label>
                        </td>
                    </tr>
                {{-- @else
                    <tr>
                        <td>{{ $contrato->id }}</td>
                        <td>{{  substr($contrato->fechainicio,8,2).'-'.substr($contrato->fechainicio,5,2).'-'.substr($contrato->fechainicio,0,4) }}</td>
                        <td>{{  substr($contrato->fechafin,8,2).'-'.substr($contrato->fechafin,5,2).'-'.substr($contrato->fechafin,0,4) }}</td>
                        <td>{{ $contrato->inquilino() }}</td>
                        <td>{{ $contrato->propietario() }}</td>
                        <td>{!! $contrato->garantes($contrato->id) !!}</td>
                        <td>
                            <label style="border-radius: 10px;background-color: lightcoral ;padding: 2px 10px 2px 10px;" wire:click="modalEliminarContrato({{ $contrato->id }})">Eliminar</label>
                            <label style="border-radius: 10px;background-color: lightgreen ;padding: 2px 10px 2px 10px;" wire:click="CargarIdContrato({{ $contrato->id }})">Modificar</label>
                        </td>
                    </tr>
                @endif --}}
            @endforeach
            </table>
        </div>
    </div>
    
       <!-- Modal Pregunta si está seguro ELIMINAR CONTRATO -->
    <!-- ============================================== -->

    @if($mostrarModalEliminarContrato)
        <div class="flex items-end justify-center mt-24 pt-4 px-4 pb-20 text-center sm:block sm:p-0" style="background-color: beige; ">
            <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
                <div class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                <div class="modal-dialog" role="document">
                    <div class="modal-content" style="width: inherit">
                        <div class="modal-header">
                            <h5 class="modal-title">Eliminar Contrato</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="px-3 py-3">
                            Está seguro de eliminar el contrato seleccionado?
                            <div class="pt-3">
                                <button type="button" class="btn btn-danger" wire:click="EliminarContrato()" data-dismiss="modal" aria-label="Close">
                                    <i class="fa-solid fa-pen-to-square"></i>Eliminar
                                </button>
                                <button type="button" class="btn btn-info" wire:click="cerrarModalEliminarContrato()" data-dismiss="modal" aria-label="Close">
                                    <i class="fa-solid fa-pen-to-square"></i>Cerrar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
