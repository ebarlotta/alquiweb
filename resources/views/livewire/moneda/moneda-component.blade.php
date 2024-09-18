<div>
    @if(Session::has('mensaje'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div class="header"><i class="notched circle loading icon"></i> <b> Éxito </b></div> 
            {{Session::get('mensaje')}}
        </div>  
    @endif
    <div class="d-flex" style="justify-">
        <h1>Listado de Monedas</h1><input type="button" class="btn btn-success col-1 ml-2" style="height:30px;" value="+" data-toggle="modal" data-target="#ModalNuevaMoneda">
    </div>
    <table border=1 class="table table-stripped">
        <tr>
            <td style="background-color: rgb(107 133 114);">Descripción</td>
            <td style="background-color: rgb(107 133 114);">Signo</td>
            <td style="background-color: rgb(107 133 114);">Opciones</td>
        </tr>
        @if($monedas)
            @foreach ($monedas as $moneda)
                <tr>
                    <td>{{ $moneda->monedadescripcion }}</td>
                    <td>{{ $moneda->signo }}</td>
                    <td>
                        <input type="button" class="btn btn-warning" wire:click="edit({{ $moneda->id }})" value="Modificar" data-toggle="modal" data-target="#ModalNuevaMoneda">
                        <input type="button" class="btn btn-danger" value="Eliminar">
                    </td>
                </tr>
            @endforeach
        @endif
    </table>

    <!-- Modal Nueva Moneda -->
    <!-- ================== -->

    <div wire:ignore.self class="modal fade" id="ModalNuevaMoneda" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="width: inherit">
                <div class="modal-header">
                    <h5 class="modal-title">Coloque el Nombre de la Moneda</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="px-3 py-3">
                    
                    <div class="input-group-prepend col-12">
                        <button type="button" class="btn btn-info col-6" disabled>Nombre de la moneda</button>
                        <input type="text" class="form-control col-6" wire:model="monedadescripcion">
                    </div>
                    
                    <div class="input-group-prepend col-12 mt-2">
                        <button type="button" class="btn btn-info col-6" disabled>Signo de la moneda</button>
                        <input type="text" class="form-control col-6" wire:model="signo">
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
