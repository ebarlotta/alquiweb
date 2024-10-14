<div>
    <style>
        #card { border: 1px solid rgba(0,0,0,0.1); margin-bottom: 20px; background-color: rgba(255, 255, 255, 0.3); padding: 0; box-shadow: #0000008a 4px 5px 16px 0px; }
        #titulo { text-align: center; background-color: rgb(107 133 114); margin-bottom: 10px; padding: 5px; font-size: 14px; color: #ffffff; height: 35px; }
        .encabezado_card { text-align: center; background-color: rgb(107 133 114); margin-bottom: 10px; padding: 5px; font-size: 14px; color: #ffffff; height: 35px; }
    </style>
    
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Mensaje --}}
    {{-- ======= --}}
    

    <div class="col-12 d-flex flex-wrap">

        @if(Session::has('mensaje'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="header"><i class="notched circle loading icon"></i> <b> Éxito </b></div> 
                {{ Session::get('mensaje')}}
            </div>  
        @endif
    
        <div class="col-6 col-sm-6">

            {{-- Tipo --}}
            <div class="card">
                <div class="encabezado_card">Tipo de Contrato</div>
                <div class="card-body d-flex flex-wrap">
                    <div class="input-group mb-3 col-12">
                        <div class="input-group-prepend">
                            <label type="button" class="btn btn-info">Tipo</label>
                        </div>
                        <select class="form-control" wire:model="bien_type" @if(session('contrato_id')) disabled @endif>
                            <option value="0" selected>-- Seleccione uno --</option>
                            <option value="1">Alquiler local/casa</option>
                            <option value="2">Vehículo</option>
                            <option value="3">Mueble</option>
                        </select>
                    </div>
                    @error('bien_type') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
            </div>

            {{-- Fechas --}}
            <div class="card">
                <div class="encabezado_card">Períodos</div>
                <div class="card-body d-flex flex-wrap">
                    <div class="input-group mb-3 col-12 col-sm-6">
                        <div class="input-group-prepend">
                            <label type="button" class="btn btn-info">Duración</label>
                        </div>
                        <select class="form-control" wire:model="duracion" wire:change="CambiarCuotas()" @if(session('contrato_id')) disabled @endif>
                            <option value="1">1 año</option>
                            <option value="2">2 años</option>
                            <option value="3">3 años</option>
                            <option value="4">4 años</option>
                            <option value="5">5 años</option>
                            <option value="0">Otro</option>
                        </select>
                        @error('duracion') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                    <div class="input-group mb-3 col-12 col-sm-6">
                        <div class="input-group-prepend">
                            <label type="button" class="btn btn-info">Inicio</label>
                        </div>
                        <input type="date" class="form-control" wire:model="fechainicio" wire:change="CambiarFechaInicio()" @if(session('contrato_id')) disabled @endif>
                        @error('fechainicio') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                    <div class="input-group mb-3 col-12 col-sm-6">
                        <div class="input-group-prepend">
                            <label type="button" class="btn btn-info">Cuotas</label>
                        </div>
                        <input type="number" class="form-control" wire:model="cuotas" disabled>
                        @error('cuotas') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                    <div class="input-group mb-3 col-12 col-sm-6">
                        <div class="input-group-prepend">
                            <label type="button" class="btn btn-info">Fin</label>
                        </div>
                        <input type="date" class="form-control" wire:model="fechafin" disabled>
                        @error('fechafin') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                    <div class="input-group mb-3 col-12">
                        <div class="input-group-prepend">
                            <label type="button" class="btn btn-info">Observaciones</label>
                        </div>
                        <input type="text" class="form-control" wire:model="periodos_observaciones">
                        @error('periodos_observaciones') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            {{-- Detalles --}}
            <div class="card">
                <div class="encabezado_card">Detalles</div>
                <div class="card-body d-flex flex-wrap">
                    <div class="input-group mb-3 col-12 col-sm-6">
                        <label type="button" class="btn btn-info">Administra alq.</label>
                        <select class="form-control" wire:model="administra_alquiler_id">
                            <option value="1">Administra</option>
                            <option value="2">No administra</option>
                            <option value="0">No especifica / otro</option>
                        </select>
                        @error('administra_alquiler_id') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                    <div class="input-group mb-3 col-12 col-sm-6">
                        <label type="button" class="btn btn-info">F. de pago Inq.</label>
                        <select class="form-control" wire:model="lugar_pago_inquilino">
                            <option value="1">Efectivo en local</option>
                            <option value="2">Transf. a Inmobiliaria</option>
                            <option value="3">Transf. a Propietario</option>
                            <option value="0">No especifica / otro</option>
                        </select>
                        @error('lugar_pago_inquilino') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                    <div class="input-group mb-3 col-12 col-sm-6">
                        <label type="button" class="btn btn-info">Cartera</label>
                        <select class="form-control" wire:model="detalles_cartera">
                            <option value="0">No especifica / otro</option>
                        </select>
                        @error('detalles_cartera') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            {{-- Estados --}}
            <div class="card">
                <div class="encabezado_card" style="margin-bottom: -6px;">Estado</div>
                <div class="card-body flex-wrap text-center">
                    <div style="align-content: center;justify-content: center; margin-bottom: 10px;" class="flex">
                        @if($activo)
                            <div class="col-2 mb-2 rounded-md text-center" style="background-color: greenyellow">                        
                                <b>&nbsp;ACTIVO</b>
                            </div>
                        @else
                            <div class="col-2 mb-2 rounded-md text-center" style="background-color: lightcoral">                        
                                <b>&nbsp;NO ACTIVO</b>
                            </div>
                        @endif
                    </div>
                    <div>
                        <div class="text-center" style="margin-bottom: 15px;">
                            @if($contrato_id)<button class="btn btn-primary" wire:click="AbrirModalRescindirContrato()">Rescindir contrato</button>@endif
                            @if($contrato_id)<button class="btn btn-primary" wire:click="AbrirModalRenovarContrato()">Renovar Contrato</button>@endif
                            @if($contrato_id)<button class="btn btn-primary" wire:click="AbrirModalCambioInquilino()">Cambio de inquilino</button>@endif
                        </div>
                        <hr>
                        <div class="d-flex text-left mt-2">
                            <input type="checkbox" class="mr-3 col-1" wire:modal="incluir_mora_graficos">Incluir moras de este contrato en gráficos y listados
                        </div>
                    </div>
                    @error('estado') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
            </div>

            {{-- Intereses Punitorios --}}
            {{-- 1.Conf.General Inmobi | 2.Conf Particular | 3.No cobra --}}
            <div class="card text-center">
                <div class="encabezado_card">Intereses punitorios</div>
                <div class="card-body d-flex flex-wrap">
                    <select class="form-control" wire:model="intereses_punitorios_id" wire:change="CambiarIntereses()">   
                        <option value="1" selected="">Usar config. gral. de la inmobiliaria</option>
                        <option value="2">Usar config. particular para este contr.</option>
                        <option value="3">No cobrar punitorios en este contrato</option>
                    </select> 
                    @error('intereses_punitorios_id') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
            {{-- </div> --}}

            {{-- Conf General | Conf. Particular --}}
            <div class="card px-4">
                    @if($intereses_punitorios_id==1)
                        <div class="encabezado_card">Configuración General</div>
                    @else
                        @if($intereses_punitorios_id==2)
                            <div class="encabezado_card">Configuración Particular</div>
                        @else
                            <div class="encabezado_card">No Cobra</div>
                        @endif
                    @endif
                    @if($intereses_punitorios_id<>3)
                        <div class="card-body d-flex flex-wrap">
                            <div class="input-group mb-3 col-12 col-sm-6">
                                <label type="button" class="btn btn-info">Porcentaje diario</label>
                                <input class="form-control" type="number" wire:model="c_general_por_diario">
                                @error('c_general_por_diario') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div class="input-group mb-3 col-12 col-sm-6">
                                <label type="button" class="btn btn-info">Día Inicio cálculo</label>
                                <input class="form-control" type="number" wire:model="c_general_dia_inicio">
                                @error('c_general_dia_inicio') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div class="input-group mb-3 col-12 col-sm-6">
                                <label type="button" class="btn btn-info">Días de gracia</label>
                                <input class="form-control" type="number" wire:model="c_general_dias_gracia">
                                @error('c_general_dias_gracia') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div class="input-group mb-3 col-12 col-sm-6">
                                <label type="button" class="btn btn-info">Porcentaje</label>
                                <input class="form-control" type="number" wire:model="c_general_porcentaje">
                                @error('c_general_porcentaje') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>                        
                            <div class="input-group mb-3 col-12 col-sm-6">
                                <input type="checkbox" class="mr-1 col-1" wire:model="reintegrar_punitorios">Reintegrar punitorios al Propietario
                                @error('reintegrar_punitorios') <span class="text-red-500">{{ $message }}</span>@enderror

                            </div>
                            <div class="input-group mb-3 col-12 col-sm-6">
                                <input type="checkbox" class="mr-1 col-1" wire:model="cobrar_administrativos_punitorios">Cobrar admininstrativos sobre punitorios
                                @error('cobrar_administrativos_punitorios') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="card-body flex-wrap">
                            <div class="text-center">
                                <button class="btn btn-primary">Editar estos valores</button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="encabezado_card">Participantes</div>
                <div class="card-body d-flex flex-wrap">
                    <div class="col-12">
                        <table class="table table-striped col-12">
                            <tr class="w-1/4">
                                <td>Propietario</td>
                                <td>
                                    <input type="text" class="form-control" wire:model="propietario_text">
                                    @error('propietario_id') <span class="text-red-500">{{ $message }}</span>@enderror
                                </td>
                                <td><input type="button" value="Buscar" class="form-control btn-primary" wire:click="CargarListado('Propietarios')" data-toggle="modal" data-target="#ModalBuscarPIG"></td>
                            </tr>
                            <tr>
                                <td>Inquilino</td>
                                <td>
                                    <input type="text" class="form-control" wire:model="inquilino_text">
                                    @error('inquilino_id') <span class="text-red-500">{{ $message }}</span>@enderror
                                </td>
                                <td><input type="button" value="Buscar" class="form-control btn-primary" wire:click="CargarListado('Inquilinos')" data-toggle="modal" data-target="#ModalBuscarPIG"></td>
                            </tr>
                            <tr class="w-1/4">
                                <td>Garantes</td>
                                <td>
                                    @if($garantes)
                                    {{-- {!!$garantes!!} --}}
                                        @foreach($garantes as $garante)                                        
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    @if($contrato_id)
                                                    @else
                                                        <span class="input-group-text">
                                                            <input type="checkbox" value="{{ $garante[1] }}" wire:click="EliminarGarante({{ $garante[1] }})">
                                                        </span>
                                                    @endif
                                                </div>
                                                <input type="text" class="form-control" value="{{ $garante[0] }}">
                                            </div>
                                        @endforeach
                                    @endif
                                    @error('garantes') <span class="text-red-500">{{ $message }}</span>@enderror
                                </td>
                                <td><input type="button" value="Buscar" class="form-control btn-primary" wire:click="CargarListado('Garantes')" data-toggle="modal" data-target="#ModalBuscarPIG"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            

        {{-- Valores --}}
        <div class="col-6 col-sm-6">
            <div class="card">
                <div class="encabezado_card">Valores</div>
                <div class="card-body d-flex flex-wrap">
                    <div class="input-group mb-3 col-12 col-sm-6">
                        <div class="input-group-prepend">
                            <label type="button" class="btn btn-info">Moneda</label>
                        </div>
                        <select class="form-control" wire:model="moneda_id" @if(session('contrato_id')) disabled @endif>
                            <option value="">Selecciona una moneda</option>
                            @foreach ($monedas as $moneda)
                                <option value="{{ $moneda->id }}">{{ $moneda->signo}} - {{ $moneda->monedadescripcion}}</option>
                            @endforeach
                            <option value="0">Otro</option>
                        </select>
                    </div>
                    @error('moneda_id') <span class="text-red-500">{{ $message }}</span>@enderror

                    <div class="input-group mb-3 col-12 col-sm-6">
                        <div class="input-group-prepend">
                            <label type="button" class="btn btn-info">Actualización</label>
                        </div>
                        <select class="form-control" wire:model="actualizacion_id" wire:change="CambiarActualizacion()" @if(session('contrato_id')) disabled @endif>
                            <option value="">Selecciona una actualizacion</option>
                            @foreach ($actualizaciones as $actualizacion)
                                <option value="{{ $actualizacion->id }}">{{ $actualizacion->cantmeses}} - {{ $actualizacion->actualizaciondescripcion}}</option>
                            @endforeach
                            <option value="0">Otro</option>
                        </select>  
                    </div>
                    @error('actualizacion_id') <span class="text-red-500">{{ $message }}</span>@enderror

                    <div class="input-group mb-3 col-12 col-sm-6">
                        <div class="input-group-prepend">
                            <label type="button" class="btn btn-info">Tipo Ajuste</label>
                        </div>
                        <select class="form-control" wire:model="ajuste_id" @if(session('contrato_id')) disabled @endif>
                            <option value="">Selecciona un tipo</option>
                            @foreach ($tipoajustes as $tipoajuste)
                                <option value="{{ $tipoajuste->id }}">{{ $tipoajuste->ajustedescripcion}}</option>
                            @endforeach
                            <option value="0">Otro</option>
                        </select>
                    </div>
                    @error('ajuste_id') <span class="text-red-500">{{ $message }}</span>@enderror

                    <table class="col-12 table table-striped">
                        <tr>
                            <td style="text-align: center;"><b>Desde</b></td>
                            <td style="text-align: center;"><b>Hasta</b></td>
                            <td style="text-align: center;"><b>Rango de Valores</b></td>
                        </tr>
                            {!! $html !!}                        
                    </table>
                    <div class="input-group mb-3 col-12 col-sm-6 mt-3">
                        <div class="input-group-prepend">
                            <input type="checkbox" class="btn btn-info mr-2" value="Liquidación Fraccionada" wire:model="liquidacion_fraccionada">
                            Liquidación Fraccionada
                        </div>
                    </div>
                    @if(Session::has('mensaje'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <div class="header"><i class="notched circle loading icon"></i> <b> Éxito </b></div> 
                            {{ Session::get('mensaje')}}
                        </div>  
                    @endif
                    <input type="button" class="btn btn-info" value="Fijar Valores" wire:click="CambiarValores()">
                </div>
            </div>

            {{-- Herramientas --}}
            <div class="card">
                <div class="encabezado_card">Herramientas</div>
                <div class="card-body flex-wrap text-center">
                    <button class="btn btn-primary" wire:click="AbrirModalGestionarConceptos()">Agregar conceptos</button>
                    <button class="btn btn-primary">Eliminar contrato</button>
                </div>
            </div>

            {{-- Gastos --}}
            <div class="card">
                <div class="encabezado_card">Gastos de Administrativos</div>
                <div class="card-body d-flex flex-wrap">
                    <div class="input-group col-12">
                        <label  type="button" class="btn btn-info">Tipo</label>
                        <select class="form-control" wire:model="gastosadmin" wire:change="CambiarAdministrativos()">
                            <option value="1">Porcentual del alquiler</option>
                            <option value="2">Monto en pesos</option>
                        </select>
                    </div>
                    @error('gastos_administrativos_id') <span class="text-red-500">{{ $message }}</span>@enderror

                    @if($gastosadmin=="2") 
                        <div class="input-group mt-3 col-6">
                            <label  type="button" class="btn btn-info col-6">Porcentaje</label>
                            <input type="text" class="form-control" disabled wire:model="porcentaje_administrativos">                        
                        </div>
                    @else
                        <div class="input-group mt-3 col-6">
                            <label  type="button" class="btn btn-info col-6">Porcentaje</label>
                            <input type="text" class="form-control" wire:model="porcentaje_administrativos">                        
                        </div>
                    @endif
                    @error('porcentaje_administrativos') <span class="text-red-500">{{ $message }}</span>@enderror

                    @if($gastosadmin=="1") 
                        <div class="input-group mt-3 col-6">
                            <label  type="button" class="btn btn-info col-6">Monto</label>
                            <input type="text" class="form-control" disabled wire:model="valor_administrativos">    
                        </div>
                    @else
                        <div class="input-group mt-3 col-6">
                            <label  type="button" class="btn btn-info col-6">Monto</label>
                            <input type="text" class="form-control" wire:model="valor_administrativos">    
                        </div>
                    @endif
                    @error('valor_administrativos') <span class="text-red-500">{{ $message }}</span>@enderror

                </div>
            </div>

            {{-- Seguro --}}
            <div class="card">
                <div class="encabezado_card">Seguro contra incendios</div>
                <div class="card-body d-flex flex-wrap">
                    <div class="input-group mb-3 col-12 col-sm-6">
                        <label type="button" class="btn btn-info">Estado</label>
                        <select class="form-control" wire:model="seguro_id" wire:change="CambiarSeguro()">
                            <option value="1">Trámite completo</option>
                            <option value="2">Trámite incompleto</option>
                            <option value="3">No corresponde / Otro</option>
                        </select>
                    </div>
                    @error('seguro_id') <span class="text-red-500">{{ $message }}</span>@enderror

                    @if($seguro_id<>3)
                        <div class="input-group mb-3 col-12 col-sm-6">
                            <label  type="button" class="btn btn-info">Vencimiento:</label>
                            <input type="date" class="form-control" wire:model="vencimiento">
                        </div>
                        @error('vencimiento') <span class="text-red-500">{{ $message }}</span>@enderror

                        <div class="input-group mb-3 col-12">
                            <label type="button" class="btn btn-info">Observaciones del seguro</label>
                            <textarea class="form-control" cols="60">{{ $seguro_observaciones}}</textarea>
                        </div>
                        @error('seguro_observaciones') <span class="text-red-500">{{ $message }}</span>@enderror
                    @endif
                </div>
            </div>

            {{-- Grupo --}}
            {{-- <div class="card">
                <div class="encabezado_card">Grupo </div>
                <h1 class="red">PARA TERMINAR</h1>
                <div class="card-body d-flex flex-wrap">
                    <div class="input-group mb-3 col-12 col-sm-6">
                        <span type="button" class="btn btn-info">Nombre grupo</span>
                        <input type="text" class="form-control">
                    </div>
                    <div class="input-group mb-3 col-12 col-sm-6">
                        <span type="button" class="btn btn-info">Porcentaje fracción</span>
                        <input type="number" class="form-control">
                    </div>
                </div>
                <div class="card-body d-flex flex-wrap">
                    <div class="col-12 text-center">
                        Otros contratos del mismo grupo
                        <table class="table table-hover" id="lista_tabla">
                            <thead>
                                <tr>
                                    <th>Inmueble</th>
                                    <th>Inq.</th>
                                    <th>%</th>
                                    <th><!--link--></th>
                                </tr>
                            </thead>
                            <tbody id="resultadoMismoGrupo">
                                <tr>
                                    <td></td>
                                    <td> TOTAL</td>
                                    <td><b>0 %</b></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-body flex-wrap">
                        <div class="text-center">
                            <button class="btn btn-primary">Actualizar</button>
                        </div>
                    </div>
                </div>
            </div> --}}
            
        </div>

        {{-- <input class="btn btn-info" type="button" value="Ver Garantes" wire:click="VerGarantes()"> --}}

        <div class="col-12 d-flex">
            <a class="col-6" href="principal">
                <input class="btn btn-info col-12" type="button" value="Volver" wire:click="store()">
            </a>
            <input class="btn btn-success col-6" type="button" value="Guardar" wire:click="store()">
        </div>



    <!-- Modal Buscar Propietario / Inquilino/ Garante -->
    <!-- ============================================= -->

    <div wire:ignore.self class="modal fade" id="ModalBuscarPIG" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="width: inherit">
                <div class="modal-header">
                    <h5 class="modal-title">Listado de {{ $buscar }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="px-3 py-3">
                    <input class="form-control w-full col-12 pr-5" type="text" placeholder="Buscar" wire:model="search" wire:keyup="Cargarlistados()">

                    @if($listado_fisicas)
                        <label for="">Persona Física</label><br>
                        @foreach ($listado_fisicas as $fisica)
                        {{-- @foreach($listado_fisicas as $fisica) --}}
                            <label class="px-3" style="background-color: lightgreen;padding: 3px;width: 76%;margin-right: 3px; border-radius: 4px;">{{ $fisica->apellidos}}, {{ $fisica->nombres }}</label>
                            <input class="px-3" type="button" value="Elegir" style="background-color: lightcoral; padding: 3px;width: 19%;margin-right: 3px; border-radius: 4px;" wire:click="Elegir('fisica',{{ $fisica->persona_id }})" data-dismiss="modal" aria-label="Close">
                        @endforeach
                    @else
                        No hay datos
                    @endif
                    @if($listado_juridicas)
                        <label for="">Persona Jurídicas</label><br>
                        @foreach ($listado_juridicas as $juridica)
                        {{-- @foreach($listado_fisicas as $fisica) --}}
                            <label class="px-3" style="background-color: lightgreen;padding: 3px;width: 76%;margin-right: 3px; border-radius: 4px;">{{ $juridica->razonsocial }}</label>
                            <input class="px-3" type="button" value="Elegir" style="background-color: lightcoral; padding: 3px;width: 19%;margin-right: 3px; border-radius: 4px;" wire:click="Elegir('juridica',{{ $juridica->persona_id }})" data-dismiss="modal" aria-label="Close">
                        @endforeach
                    @else
                        No hay datos
                    @endif
                    {{-- <div class="input-group-prepend col-12">
                        <button type="button" class="btn btn-info col-6">Nombre de la moneda</button>
                        <input type="text" class="form-control col-6" wire:model="monedadescripcion">
                    </div> --}}
                    
                    
                    
                    <div class="pt-3">
                        <button type="button" class="btn btn-info" data-dismiss="modal" aria-label="Close">
                            <i class="fa-solid fa-pen-to-square"></i>Cerrar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Se guardo correctamente el contrato -->
    <!-- ========================================== -->

    @if($mostratModalOk)
        <div class="flex items-end justify-center mt-24 pt-4 px-4 pb-20 text-center sm:block sm:p-0" style="background-color: beige; ">
            <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
                <div class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                <div class="modal-dialog" role="document">
                    <div class="modal-content" style="width: inherit">
                        <div class="modal-header">
                            <h5 class="modal-title">Alta Exitosa</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="px-3 py-3">
                            El contrato ha sido guardado correctamente!
                            <div class="pt-3">
                                <button type="button" class="btn btn-info" wire:click="CerrarModalOk()" data-dismiss="modal" aria-label="Close">
                                    <i class="fa-solid fa-pen-to-square"></i>Cerrar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Modal Cambio de Inquilino -->
    <!-- ========================= -->

    @if($modalCambioInquilino)    
        <div class="flex items-end justify-center mt-24 pt-4 px-4 pb-20 text-center sm:block sm:p-0" style="background-color: beige; ">
            <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
                <div class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                <div class="modal-dialog mt-20" role="document">
                    <div class="modal-content" style="width: inherit">
                        <div class="modal-header">
                            <h5 class="modal-title">Cambio de Inquilino</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="px-3 py-3">
                            <div class="switch_div">
                                <label class="switch">
                                    <input type="checkbox" checked="" id="switchEliminarImpagos">
                                    <span class="slider round"></span>
                                </label>
                                <span class="textoSwitch">Eliminar conceptos impagos de este contrato (...)</span>
                            </div>

                            <div class="dropdown mb-2">
                                Eliminar impagos de
                                <select name="" id="">
                                    <option value=""></option>
                                    <option value=""></option>
                                    <option value=""></option>
                                    <option value=""></option>
                                </select>
                                y posteriores
                            </div>
                            <table class="table table-striped col-12">
                                <tr>
                                    <td>Inquilino</td>
                                    <td>
                                        <select class="form-control" wire:model="inquilino_id">
                                            <option selected>Seleccione un inquilino</option>
                                            @if($listado_fisicas)
                                                @foreach ($listado_fisicas as $inquilino)
                                                    <option value="{{ $inquilino->id }}">{{ $inquilino->apellidos }}, {{ $inquilino->nombres }}</option>
                                                @endforeach
                                            @endif
                                            @if($listado_juridicas)
                                                @foreach ($listado_juridicas as $inquilino1)
                                                    <option value="{{ $inquilino1->id }}">{{ $inquilino1->razonsocial }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        {{-- <input type="text" class="form-control" wire:model="inquilino_text"> --}}
                                        @error('inquilino_id') <span class="text-red-500">{{ $message }}</span>@enderror
                                    </td>
                                    <td><input type="button" value="Buscar" class="form-control btn-primary" wire:click="CargarListado('Inquilinos')" data-toggle="modal" data-target="#ModalBuscarPIG"></td>
                                </tr>
                            </table>
                            <p class="text-left ml-3">
                                Se realizarán los siguientes cambios:<br><br>
                                · Se marcará este contrato como inactivo<br>
                                · Se eliminarán los conceptos impagos (si elegiste esa opción)<br>
                                · Se creará un nuevo contrato con el mismo propietario e inmueble<br>
                                · Se creará un nuevo inquilino y se asignará al nuevo contrato 
                            </p>
                            <div class="pt-3">
                                <button type="button" class="btn btn-danger" wire:click="CambiarInquilino()" data-dismiss="modal" aria-label="Close">
                                    <i class="fa-solid fa-pen-to-square"></i>Hacer Cambio
                                </button>
                                <button type="button" class="btn btn-info" wire:click="CerrarModalCambioInquilino()" data-dismiss="modal" aria-label="Close">
                                    <i class="fa-solid fa-pen-to-square"></i>Cerrar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

        <!-- Modal Cambio de Inquilino -->
    <!-- ========================= -->

    @if($modalRescindirContrato)    
        <div class="flex items-end justify-center mt-24 pt-4 px-4 pb-20 text-center sm:block sm:p-0" style="background-color: beige; ">
            <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
                <div class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                <div class="modal-dialog mt-20" role="document">
                    <div class="modal-content" style="width: inherit">
                        <div class="modal-header">
                            <h5 class="modal-title">Rescindir Contrato</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="px-3 py-3">
                            <div class="switch_div">
                                <label class="switch">
                                    <input type="checkbox" checked="" id="switchEliminarImpagos">
                                    <span class="slider round"></span>
                                </label>
                                <span class="textoSwitch">Eliminar conceptos impagos de este contrato (...)</span>
                            </div>

                            <div class="dropdown mb-2">
                                Eliminar impagos de
                                <select name="" id="">
                                    <option value=""></option>
                                    <option value=""></option>
                                    <option value=""></option>
                                    <option value=""></option>
                                </select>
                                y posteriores
                            </div>
                            <p class="text-left ml-3">
                                Se realizarán los siguientes cambios:<br>
                                · Se marcará este contrato como inactivo<br>
                                · Se eliminarán los conceptos impagos (si elegiste esa opción)
                            </p>
                            <div class="pt-3">
                                <button type="button" class="btn btn-danger" wire:click="RescindirContrato()" data-dismiss="modal" aria-label="Close">
                                    <i class="fa-solid fa-pen-to-square"></i>Rescindir Contrato
                                </button>
                                <button type="button" class="btn btn-info" wire:click="CerrarModalRescindirContrato()" data-dismiss="modal" aria-label="Close">
                                    <i class="fa-solid fa-pen-to-square"></i>Cerrar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Modal Renovar Contrato -->
    <!-- ====================== -->

    @if($modalRenovarContrato)    
        <div class="flex items-end justify-center mt-24 pt-4 px-4 pb-20 text-center sm:block sm:p-0" style="background-color: beige; ">
            <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
                <div class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                <div class="modal-dialog mt-20" role="document">
                    <div class="modal-content" style="width: inherit">
                        <div class="modal-header">
                            <h5 class="modal-title">Renovar Contrato</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="px-3 py-3">
                            <div class="switch_div">
                                <label class="switch">
                                    <input type="checkbox" checked="" id="switchEliminarImpagos">
                                    <span class="slider round"></span>
                                </label>
                                <span class="textoSwitch">Eliminar conceptos impagos de este contrato (...)</span>
                            </div>

                            <div class="dropdown mb-2">
                                Eliminar impagos de
                                <select name="" id="">
                                    <option value=""></option>
                                    <option value=""></option>
                                    <option value=""></option>
                                    <option value=""></option>
                                </select>
                                y posteriores
                            </div>
                            <div>
                                Nueva Fecha de Inicio de contrato
                                <input type="date" wire:model="NuevaFechaInicioContrato">
                            </div>
                            @error('NuevaFechaInicioContrato') <span class="text-red-500">{{ $message }}</span>@enderror

                            <p class="text-left ml-3">
                                Se realizarán los siguientes cambios:<br>
                                · Se marcará este contrato como inactivo<br>
                                · Se eliminarán los conceptos impagos (si elegiste esa opción)<br>
                                · Se creará un nuevo contrato con el mismo propietario, inquilino, inmueble, con nuevas fechas e independiente del actual<br>
                            </p>
                            <div class="pt-3">
                                <button type="button" class="btn btn-danger" wire:click="RenovarContrato()" data-dismiss="modal" aria-label="Close">
                                    <i class="fa-solid fa-pen-to-square"></i>Renovar Contrato
                                </button>
                                <button type="button" class="btn btn-info" wire:click="CerrarModalRenovarContrato()" data-dismiss="modal" aria-label="Close">
                                    <i class="fa-solid fa-pen-to-square"></i>Cerrar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif


    <!-- Modal Gestionar Conceptos -->
    <!-- ========================= -->

    @if($modalGestionarConceptos)
    <div class="flex items-end justify-center mt-24 pt-4 px-4 pb-20 text-center sm:block sm:p-0" style="background-color: beige; ">
        <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <div class="modal-dialog mt-20 d-flex text-center" role="document" style="max-width: 100%;margin-left: 16%;">
                <div class="modal-content" style="width: 80rem;">
                    <div class="modal-header">
                        <h5 class="modal-title encabezado_card" style="width: 98%">Gestionar Conceptos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="CerrarModalGestionarConceptos()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {{-- <div class="modal-body" id="modal_body"> --}}
                    <div>
                        <div class="d-flex"> <!--contiene ambos paneles-->
                            <div id="agrConc_panelIzq" style="width: 50%">
                                <div class="card m-3 shadow-lg">
                                    <ul class="nav nav-tabs responsive">
                                        <li class="active encabezado_card bg-blue col-6"><a data-toggle="tab" aria-current="page" href="#c1" aria-expanded="true">Conceptos básicos</a></li>
                                        <li class="encabezado_card bg-cyan col-6"><a data-toggle="tab" href="#c3" aria-expanded="false">Otros conceptos</a></li>
                                    </ul>

                                    <div class="tab-content">
                                        <div id="c1" class="text-left tab-pane fade active in p-2 show active">
                                            <p></p>
                                            <p>Los conceptos básicos son:</p>
                                            <p> · Alquiler para el inquilino</p>
                                            <p> · Alquiler y administración para el Propietario</p>
                                            <br>
                                            <hr>
                                            <br>
                                            <div class="input-group mb-3 col-12">
                                                <div class="input-group-prepend">
                                                    <label type="button" class="btn btn-info">IVA Alquiler:</label>
                                                </div>
                                                <select class="form-control">
                                                    <option value="0" selected="">No</option>
                                                    <option value="d">Agregar discriminado</option>
                                                    <option value="s">Sumar al alquiler</option>
                                                </select>
                                            </div>
                                            <div class="input-group mb-3 col-12">
                                                <div class="input-group-prepend">
                                                    <label type="button" class="btn btn-info">IVA Admin.:</label>
                                                </div>
                                                <select class="form-control">
                                                    <option value="0" selected="">No</option>
                                                    <option value="d">Agregar discriminado</option>
                                                    <option value="s">Sumar a la admin.</option>
                                                </select>
                                            </div>
                                            <div class="input-group mb-3 col-12">
                                                <div class="input-group-prepend mr-3">
                                                    <input type="checkbox" class="btn btn-info mr-2"> Omitir meses anteriores
                                                </div>
                                                <div class="dpgTooltip">
                                                    <div class="dpgTooltip_div">
                                                        <p class="dpgTooltip_p">Si marcás esta opción, no se agregará ni modificará nada anterior al mes actual</p>
                                                    </div>						
                                                </div>
                                            </div>	
                                        </div>

                                        <div id="c3" class="tab-pane fade">
                                            <div class="input-group mb-3 col-12">
                                                <div class="input-group-prepend">
                                                    <label type="button" class="btn btn-info">Detalle</label>
                                                </div>
                                                <input type="text" class="form-control">
                                            </div>
                                            @error('moneda_id') <span class="text-red-500">{{ $message }}</span>@enderror
                                
                                            <div class="input-group mb-3 col-12">
                                                <div class="input-group-prepend">
                                                    <label type="button" class="btn btn-info">Monto</label>
                                                </div>
                                                <input type="number" class="bd form-control">
                                            </div>
                                            @error('moneda_id') <span class="text-red-500">{{ $message }}</span>@enderror
                                            
                                            <div class="input-group mb-3 col-12">
                                                <div class="input-group-prepend">
                                                    <label type="button" class="btn btn-info">Contrato</label>
                                                </div>
                                                <select class="form-control">
                                                    <option value="0" selected="">Sólo a este contrato</option>
                                                    <option value="1">Concepto grupal</option>
                                                </select>                                                
                                            </div>
                                                
                                                {{-- <div class="dpgTooltip tooltipMuchoTexto">
                                                    <div class="dpgTooltip_div">
                                                        <p class="dpgTooltip_p "></p>
                                                        <u><b>Sólo a este contrato:</b></u><br>
                                                        El concepto se agrega sólo a este contrato.<br><br>
                                                        <u><b>Concepto grupal:</b></u><br>
                                                        Se agregará un concepto en cada uno de los contratos que pertenecen al grupo. En un segundo paso se podrán elegir más opciones. Nota: Si no se ha definido un grupo para este contrato (ver novedades #108 a #110) o no hay otros contratos en el grupo, esta opción estará deshabilitada.
                                                    </div>
                                                </div>				 --}}

                                            <div class="input-group mb-3 col-12">
                                                <div class="input-group-prepend">
                                                    <label type="button" class="btn btn-info">Tratamiento</label>
                                                </div>	
                                                <select class="form-control">
                                                    <option value="R" selected="">Repetir este monto</option>
                                                    <option value="I">Dividir en partes iguales</option>
                                                    <option value="P">Prorratear según porcentajes</option>
                                                </select>
                                            </div>	

                                            <div class="input-group mb-3 col-12">
                                                <div class="input-group-prepend">
                                                    <label type="button" class="btn btn-info">Cálculo</label>
                                                </div>
                                                <select class="form-control">
                                                    <option value="1" selected="">Mostrar en los conceptos</option>
                                                    <option value="0">No incluir en los conceptos</option>
                                                </select>
                                            </div>						
                                    
                                            <div class="input-group mb-3 col-12">
                                                <div class="input-group-prepend">
                                                    <label type="button" class="btn btn-info">Agregar a</label>
                                                </div>
                                                <select class="form-control">
                                                    <option value="I">Recibo inquilino</option>
                                                    <option value="P">Liquidación propietario</option>
                                                    <option value="C">Ambos (cancelación)</option>
                                                    <option value="D">Ambos (duplicado)</option>
                                                    <option value="M">Ambos (50% cada uno)</option>
                                                </select>
                                            </div>
                                                                    
                                            {{-- <div class="dpgTooltip tooltipMuchoTexto">
                                                <div class="dpgTooltip_div">
                                                    <p class="dpgTooltip_p "></p>
                                                    <u><b>Recibo / Liquidación</b></u><br>
                                                    El concepto sólo se agregará en uno de los comprobantes<br><br>
                                                    <u><b>Ambos (cancelación)</b></u><br>
                                                    El concepto se agregará en ambos comprobantes de modo que se cancelen entre sí. Si el monto es positivo, se le cobrará al inquilino y se le reintegrará al propietario. Si el monto es negativo se le restará al inquilino y se le cobrará al propietario (por ejemplo, expensas extraordinarias).<br><br>
                                                    <u><b>Ambos (duplicado)</b></u><br>
                                                    El concepto se agregará en ambos comprobantes pero con distinto signo, de modo que se cobrará a ambos si el monto es positivo y se pagará a ambos si es negativo.<br><br>
                                                    <u><b>Ambos (50% cada uno)</b></u><br>
                                                    El concepto se agregará en ambos comprobantes por la mitad de su valor y con distinto signo. (Igual que el anterior pero por la mitad del importe)
                                                </div>
                                            </div>					 --}}

                                            <div class="input-group mb-3 col-12">
                                                <div class="input-group-prepend">
                                                    <label type="button" class="btn btn-info">Meses</label>
                                                </div>
                                                <select class="form-control">
                                                    <option value="1">Sólo el mes elegido (...)</option>
                                                    <option value="T">Todos los meses</option>
                                                    <option value="I">Intervalo de cuotas (...)</option>
                                                        <optgroup label="por año">
                                                            <option value="a1">Primer año</option>
                                                            <option value="a2">Segundo año</option>
                                                            <option value="a3">Tercer año</option>
                                                        </optgroup>
                                                        <optgroup label="por semestre">
                                                            <option value="s1">Semestre 1</option>
                                                            <option value="s2">Semestre 2</option>
                                                            <option value="s3">Semestre 3</option>
                                                            <option value="s4">Semestre 4</option>
                                                            <option value="s5">Semestre 5</option>
                                                            <option value="s6">Semestre 6</option>
                                                        </optgroup>						
                                                </select>
                                            </div>
                                            <div class="input-group mb-3 col-12">
                                                <div class="input-group-prepend">
                                                    <input type="checkbox" class="btn btn-info mr-3">Omitir meses anteriores</label>
                                                </div>
                                            </div>
                                            <div class="input-group mb-3 col-12">
                                                <div class="input-group-prepend">
                                                    <input type="checkbox" class="btn btn-info mr-3">Dividir en cuotas</label>
                                                </div>
                                                <div class="input-group mb-3 col-12">
                                                    <div class="input-group-prepend">
                                                        <label type="button" class="btn btn-info">Dividir en</label>
                                                    </div>
                                                    <label type="button" class="btn btn-info">cuotas de $--</label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>                            

                            <div id="agrConc_panelDer" style="width: 50%">
                                <div class="card m-3 shadow-lg">
                                    <div class="encabezado_card">Vista previa</div>
                                        <div class="miniform_body">
                                            <div class="lista_ext">
                                                <div class="lista_int"> 
                                                    <table class="table table-hover" id="">
                                                        <thead>
                                                            <tr>
                                                                <th>Op.</th>
                                                                <th>Detalle</th>
                                                                <th>Monto</th>
                                                                <th>Inq/Prop</th>
                                                                <th>-/+	
                                                                    {{-- <div class="dpgTooltip">
                                                                        <div class="dpgTooltip_div">
                                                                            El signo representa si el concepto finalmente supone un ingreso o un egreso para la inmobiliaria
                                                                        </div>
                                                                    </div>	 --}}
                                                                </th>
                                                                <th>Mes</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($detalles as $detalle)
                                                            <tr>
                                                                <td>{{ date("d-m-Y",strtotime($detalle->fecha_vencimiento)) }} </td>
                                                                <td>{{ $detalle->detalle }} </td>
                                                                <td>{{ $detalle->monto }} </td>
                                                                <td>{{ $detalle->quien }} </td>
                                                                <td>{{ $detalle->mes }} </td>
                                                                <td>{{ $detalle->anio }} </td>
                                                            </tr>
                                                            @endforeach
                                                            <tr>
                                                                <td colspan="4">
                                                                    <span class="p12 gris">Presioná el botón 'vista previa' para ver el efecto en los contratos</span>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>	
                                                </div>
                                            </div>							
                                            <div class="d-flex text-center mb-3" style="justify-content: center;">
                                                <input type="button" class="btn btn-info m-1" value="&nbsp;&nbsp;&nbsp;Nuevos&nbsp;&nbsp;&nbsp;">
                                                <input type="button" class="btn btn-info m-1" value="Modificar">
                                                <input type="button" class="btn btn-info m-1" value="Ignorados">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                                
                    
                        <div class="centro ancho mb-3">
                            <button type="button" class="btn btn-primary" wire:click="GuardaConceptos()">
                                Guarda Conceptos
                            </button>
                            <button type="button" class="btn btn-primary">
                                &nbsp;&nbsp;&nbsp;Vista previa&nbsp;&nbsp;&nbsp;
                            </button>
                            &nbsp;
                            <button type="button" class="btn btn-info">
                                &nbsp;Agregar / modificar
                            </button>
                        </div>

                    </div>                    
                </div>
            </div>
        </div>
    </div>


    @endif





</div>






