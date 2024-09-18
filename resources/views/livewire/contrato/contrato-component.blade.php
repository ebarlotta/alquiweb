<div>
    <style>
        #card { border: 1px solid rgba(0,0,0,0.1); margin-bottom: 20px; background-color: rgba(255, 255, 255, 0.3); padding: 0; box-shadow: #0000008a 4px 5px 16px 0px; }
        #titulo { text-align: center; background-color: rgb(107 133 114); margin-bottom: 10px; padding: 5px; font-size: 14px; color: #ffffff; height: 35px; }
        .encabezado_card { text-align: center; background-color: rgb(107 133 114); margin-bottom: 10px; padding: 5px; font-size: 14px; color: #ffffff; height: 35px; }
    </style>
    @if(Session::has('mensaje'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div class="header"><i class="notched circle loading icon"></i> <b> Éxito </b></div> 
            {{Session::get('mensaje')}}
        </div>  
    @endif
    <div class="col-12 d-flex flex-wrap">
        <div class="col-6 col-sm-6">

            {{-- Tipo --}}
            <div class="card">
                <div class="encabezado_card">Tipo de Contrato</div>
                <div class="card-body d-flex flex-wrap">
                    <div class="input-group mb-3 col-12">
                        <div class="input-group-prepend">
                            <label type="button" class="btn btn-info">Tipo</label>
                        </div>
                        <select class="form-control" wire:model="bien_type">
                            <option value="0" selected>-- Seleccione uno --</option>
                            <option value="1">Alquiler local/casa</option>
                            <option value="2">Vehículo</option>
                            <option value="3">Mueble</option>
                        </select>
                        @error('bien_type') <span>{{ $message }}</span>@enderror
                    </div>
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
                        <select class="form-control" wire:model="duracion" wire:change="CambiarCuotas()">
                            <option value="1">1 año</option>
                            <option value="2">2 años</option>
                            <option value="3">3 años</option>
                            <option value="4">4 años</option>
                            <option value="5">5 años</option>
                            <option value="0">Otro</option>
                        </select>
                        @error('duracion') <span>{{ $message }}</span>@enderror
                    </div>
                    <div class="input-group mb-3 col-12 col-sm-6">
                        <div class="input-group-prepend">
                            <label type="button" class="btn btn-info">Inicio</label>
                        </div>
                        <input type="date" class="form-control" wire:model="fechainicio" wire:change="CambiarFechaInicio()">
                        @error('fechainicio') <span>{{ $message }}</span>@enderror
                    </div>
                    <div class="input-group mb-3 col-12 col-sm-6">
                        <div class="input-group-prepend">
                            <label type="button" class="btn btn-info">Cuotas</label>
                        </div>
                        <input type="number" class="form-control" wire:model="cuotas" disabled>
                        @error('cuotas') <span>{{ $message }}</span>@enderror
                    </div>
                    <div class="input-group mb-3 col-12 col-sm-6">
                        <div class="input-group-prepend">
                            <label type="button" class="btn btn-info">Fin</label>
                        </div>
                        <input type="date" class="form-control" wire:model="fechafin" disabled>
                        @error('fechafin') <span>{{ $message }}</span>@enderror
                    </div>
                    <div class="input-group mb-3 col-12">
                        <div class="input-group-prepend">
                            <label type="button" class="btn btn-info">Observaciones</label>
                        </div>
                        <input type="text" class="form-control" wire:model="periodos_observaciones">
                        @error('periodos_observaciones') <span>{{ $message }}</span>@enderror
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
                        @error('administra_alquiler_id') <span>{{ $message }}</span>@enderror
                    </div>
                    <div class="input-group mb-3 col-12 col-sm-6">
                        <label type="button" class="btn btn-info">F. de pago Inq.</label>
                        <select class="form-control" wire:model="lugar_pago_inquilino">
                            <option value="1">Efectivo en local</option>
                            <option value="2">Transf. a Inmobiliaria</option>
                            <option value="3">Transf. a Propietario</option>
                            <option value="0">No especifica / otro</option>
                        </select>
                        @error('lugar_pago_inquilino') <span>{{ $message }}</span>@enderror
                    </div>
                    <div class="input-group mb-3 col-12 col-sm-6">
                        <label type="button" class="btn btn-info">Cartera</label>
                        <select class="form-control" wire:model="detalles_cartera">
                            <option value="0">No especifica / otro</option>
                        </select>
                        @error('detalles_cartera') <span>{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            {{-- Estados --}}
            <div class="card">
                <div class="encabezado_card">Estado</div>
                <div class="card-body flex-wrap text-center">
                    <div class="col-2 mb-2 rounded-md text-center" style="background-color: lightseagreen">
                        <b>&nbsp;ACTIVO</b>
                    </div>
                    <div>
                        <div class="text-center">
                            <button class="btn btn-primary">Rescindir contrato</button>
                            <button class="btn btn-primary">Renovar contrato</button>
                            <button class="btn btn-primary">Cambio de inquilino</button>
                            <button class="btn btn-primary">Eliminar contrato</button>
                        </div>
                        <hr>
                        <div class="d-flex text-left">
                            <input type="checkbox" class="mr-3 col-1" wire:modal="incluir_mora_graficos">Incluir moras de este contrato en gráficos y listados
                        </div>
                    </div>
                    @error('estado') <span>{{ $message }}</span>@enderror
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
                    @error('intereses_punitorios_id') <span>{{ $message }}</span>@enderror
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
                                @error('intereses_punitorios_id') <span>{{ $message }}</span>@enderror
                            </div>
                            <div class="input-group mb-3 col-12 col-sm-6">
                                <label type="button" class="btn btn-info">Día Inicio cálculo</label>
                                <input class="form-control" type="number" wire:model="c_general_dia_inicio">
                                @error('intereses_punitorios_id') <span>{{ $message }}</span>@enderror
                            </div>
                            <div class="input-group mb-3 col-12 col-sm-6">
                                <label type="button" class="btn btn-info">Días de gracia</label>
                                <input class="form-control" type="number" wire:model="c_general_dias_gracia">
                                @error('c_general_dias_gracia') <span>{{ $message }}</span>@enderror
                            </div>
                            <div class="input-group mb-3 col-12 col-sm-6">
                                <label type="button" class="btn btn-info">Porcentaje</label>
                                <input class="form-control" type="number" wire:model="c_general_porcentaje">
                                @error('c_general_porcentaje') <span>{{ $message }}</span>@enderror
                            </div>                        
                            <div class="input-group mb-3 col-12 col-sm-6">
                                <input type="checkbox" class="mr-1 col-1" wire:model="reintegrar_punitorios">Reintegrar punitorios al Propietario
                                @error('reintegrar_punitorios') <span>{{ $message }}</span>@enderror

                            </div>
                            <div class="input-group mb-3 col-12 col-sm-6">
                                <input type="checkbox" class="mr-1 col-1" wire:model="cobrar_administrativos_punitorios">Cobrar admininstrativos sobre punitorios
                                @error('cobrar_administrativos_punitorios') <span>{{ $message }}</span>@enderror
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
                                <td><input type="text" class="form-control" wire:model="propietario_text"></td>
                                <td><input type="button" value="Buscar" class="form-control btn-primary" wire:click="CargarListado('Propietarios')" data-toggle="modal" data-target="#ModalBuscarPIG"></td>
                            </tr>
                            <tr>
                                <td>Inquilino</td>
                                <td><input type="text" class="form-control" wire:model="inquilino_text"></td>
                                <td><input type="button" value="Buscar" class="form-control btn-primary" wire:click="CargarListado('Inquilinos')" data-toggle="modal" data-target="#ModalBuscarPIG"></td>
                            </tr>
                            <tr class="w-1/4">
                                <td>Garantes</td>
                                <td>
                                    @if($garantes)
                                        @foreach($garantes as $garante)                                        
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <input type="checkbox" value="{{ $garante[1] }}" wire:click="EliminarGarante({{ $garante[1] }})">
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control" value="{{ $garante[0] }}">
                                            </div>
                                        @endforeach
                                    @endif
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
                        <select class="form-control" wire:model="moneda_id">
                            <option value="">Selecciona una moneda</option>
                            @foreach ($monedas as $moneda)
                                <option value="{{ $moneda->id }}">{{ $moneda->signo}} - {{ $moneda->monedadescripcion}}</option>
                                
                            @endforeach
                            <option value="0">Otro</option>
                        </select>
                        @error('moneda_id') <span>{{ $message }}</span>@enderror

                    </div>
                    <div class="input-group mb-3 col-12 col-sm-6">
                        <div class="input-group-prepend">
                            <label type="button" class="btn btn-info">Actualización</label>
                        </div>
                        <select class="form-control" wire:model="actualizacion_id" wire:change="CambiarActualizacion()">
                            <option value="">Selecciona una actualizacion</option>
                            @foreach ($actualizaciones as $actualizacion)
                                <option value="{{ $actualizacion->id }}">{{ $actualizacion->cantmeses}} - {{ $actualizacion->actualizaciondescripcion}}</option>
                            @endforeach
                            <option value="0">Otro</option>
                        </select>
                        @error('actualizacion_id') <span>{{ $message }}</span>@enderror

                    </div>
                    <div class="input-group mb-3 col-12 col-sm-6">
                        <div class="input-group-prepend">
                            <label type="button" class="btn btn-info">Tipo Ajuste</label>
                        </div>
                        <select class="form-control" wire:model="ajuste_id">
                            <option value="">Selecciona un tipo</option>
                            @foreach ($tipoajustes as $tipoajuste)
                                <option value="{{ $tipoajuste->id }}">{{ $tipoajuste->ajustedescripcion}}</option>
                            @endforeach
                            <option value="0">Otro</option>
                        </select>
                        @error('ajuste_id') <span>{{ $message }}</span>@enderror
                    </div>
                    <table class="col-12 table table-striped">
                        <tr>
                            <td style="text-align: center;"><b>Desde</b></td>
                            <td style="text-align: center;"><b>Hasta</b></td>
                            <td style="text-align: center;"><b>Valor</b></td>
                        </tr>
                            {!! $html !!}                        
                    </table>
                </div>
            </div>

            {{-- Herramientas --}}
            <div class="card">
                <div class="encabezado_card">Herramientas</div>
                <div class="card-body flex-wrap text-center">
                    <button class="btn btn-primary">Agregar conceptos</button>
                    <button class="btn btn-primary">Eliminar contrato</button>
                </div>
            </div>

            {{-- Gastos --}}
            <div class="card">
                <div class="encabezado_card">Gastos de Administrativos</div>
                <div class="card-body d-flex flex-wrap">
                    <div class="input-group col-12">
                        <label  type="button" class="btn btn-info">Tipo</label>
                        <select class="form-control" wire:model="gastos_administrativos_id" wire:change="CambiarAdministrativos()">
                            <option value="1">Porcentual del alquiler</option>
                            <option value="2">Monto en pesos</option>
                        </select>
                        @error('gastos_administrativos_id') <span>{{ $message }}</span>@enderror

                    </div>
                {{-- </div>
                <div class="card-body d-flex flex-wrap"> --}}
                    <div class="input-group mt-3 col-6" @disabled(true)>
                        <label  type="button" class="btn btn-info col-6">Porcentaje</label>
                        <input type="text" class="form-control" @if($gastos_administrativos_id==2) disabled @endif wire:model="porcentaje_administrativos">
                        @error('porcentaje_administrativos') <span>{{ $message }}</span>@enderror

                    </div>
                    <div class="input-group mt-3 col-6">
                        <label  type="button" class="btn btn-info col-6">Monto</label>
                        <input type="text" class="form-control" @if($gastos_administrativos_id==1) disabled @endif wire:model="valor_administrativos">
                        @error('valor_administrativos') <span>{{ $message }}</span>@enderror

                    </div>
                </div>
            </div>

            {{-- Seguro --}}
            <div class="card">
                <div class="encabezado_card">Seguro contra incendios</div>
                <div class="card-body d-flex flex-wrap">
                    <div class="input-group mb-3 col-12 col-sm-6">
                        <label type="button" class="btn btn-info">Estado</label>
                        <select class="form-control" wire:model="seguro_id">
                            <option value="1">Trámite completo</option>
                            <option value="2">Trámite incompleto</option>
                            <option value="3">No corresponde / Otro</option>
                        </select>
                        @error('seguro_id') <span>{{ $message }}</span>@enderror

                    </div>
                    <div class="input-group mb-3 col-12 col-sm-6">
                        <label  type="button" class="btn btn-info">Vencimiento:</label>
                        <input type="date" class="form-control" wire:model="vencimiento">
                        @error('vencimiento') <span>{{ $message }}</span>@enderror

                    </div>
                    <div class="input-group mb-3 col-12">
                        <label type="button" class="btn btn-info">Observaciones del seguro</label>
                        <textarea class="form-control" cols="60">{{ $seguro_observaciones}}</textarea>
                        @error('seguro_observaciones') <span>{{ $message }}</span>@enderror

                    </div>
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

        <div class="col-12">
            <input class="btn btn-success col-12" type="button" value="Guardar" wire:click="store()">
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


    </div>






