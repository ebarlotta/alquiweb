<div>
    <div class="card card-info offset-md-1 col-10 text-center">
        {{-- <div class="card-header"> --}}
            {{-- <h3 class="card-title">Listado de Contratos</h3> --}}
            <div class="d-flex mt-3" style="justify-content: center;">
                <h1>Listado de Contratos</h1>
                <a href="contratos">
                    <input type="button" class="btn btn-success col-1 ml-2" style="height:30px; width: 100px;" value="+">
                </a>
            </div>
        {{-- </div> --}}

        <div class="card-body">
            <table class="table table-striped">
                <tr>
                <td>FechaInicio</td>
                <td>Fecha Fin</td>
                <td>Inquilino</td>
                <td>Propietario</td>
                <td>Garante/s</td>
                <td>Opciones</td>
            </tr>
            @foreach ($contratos as $contrato)
                <tr>
                    <td>{{  substr($contrato->fechainicio,8,2).'-'.substr($contrato->fechainicio,5,2).'-'.substr($contrato->fechainicio,0,4) }}</td>
                    <td>{{  substr($contrato->fechafin,8,2).'-'.substr($contrato->fechafin,5,2).'-'.substr($contrato->fechafin,0,4) }}</td>
                    <td>{{ $contrato->inquilino() }}</td>
                    <td>{{ $contrato->propietario() }}</td>
                    <td></td>
                    <td>Opciones</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
    If your happiness depends on money, you will never be happy with yourself.
</div>
