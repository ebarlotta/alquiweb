<div>
    <table class="table table-stripped">
        <tr>
            <td>Descripcioón</td>
            <td>Opciones</td>
        </tr>
        @if($tipospropietarios)
            @foreach ($tipospropietarios as $tipo)
                <tr>
                    <td>{{ $tipo->tipopropietariodescripcion }}</td>
                    <td>
                        <input type="button" class="btn btn-warning" value="Modificar">
                        <input type="button" class="btn btn-danger" value="Eliminar">
                    </td>
                </tr>
            @endforeach
        @endif
    </table>
</div>
