<div>
    @if(Session::has('mensaje'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div class="header"><i class="notched circle loading icon"></i> <b> Éxito </b></div> 
            {{Session::get('mensaje')}}
        </div>  
    @endif
    <div class="card card-info offset-md-1 col-10 text-center">
        {{-- <div class="card-header"> --}}
            {{-- <h3 class="card-title">Listado de Contratos</h3> --}}
            <div class="d-flex mt-3" style="justify-content: center;">
                <h1>Listado de Contratos</h1>
                {{-- <a href="contratos"> --}}
                    <input type="button" class="btn btn-success col-1 ml-2" style="height:30px; width: 100px;" value="+" wire:click="NuevoContrato()">
                {{-- </a> --}}
            </div>
        {{-- </div> --}}

        <div class="card-body">
            <table class="table table-striped">
                <tr>
                <td>Id</td>
                <td>FechaInicio</td>
                <td>Fecha Fin</td>
                <td>Inquilino</td>
                <td>Propietario</td>
                <td>Garante/s</td>
                <td>Opciones</td>
            </tr>
            @foreach ($contratos as $contrato)
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
