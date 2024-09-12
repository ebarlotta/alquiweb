<div>
    <style>
        #card { border: 1px solid rgba(0,0,0,0.1); margin-bottom: 20px; background-color: rgba(255, 255, 255, 0.3); padding: 0; box-shadow: #0000008a 4px 5px 16px 0px; }
        #titulo { text-align: center; background-color: rgb(107 133 114); margin-bottom: 10px; padding: 5px; font-size: 14px; color: #ffffff; height: 35px; }
    </style>


    <div class="col-12 d-flex flex-wrap">
        <div class="col-6 col-sm-6">
            {{-- Fechas --}}
            <div class="card">
                <div style="text-align: center; background-color: rgb(107 133 114); margin-bottom: 10px; padding: 5px; font-size: 14px; color: #ffffff; height: 35px;">
                    Fechas
                </div>
                <div class="card-body d-flex flex-wrap">
                    <div class="input-group mb-3 col-12 col-sm-6">
                        <div class="input-group-prepend">
                            <label type="button" class="btn btn-info">Duración</label>
                        </div>
                        <select class="form-control" wire:model="anios" wire:change="CambiarCuotas()">
                            <option value="1">1 año</option>
                            <option value="2">2 años</option>
                            <option value="3">3 años</option>
                            <option value="4">4 años</option>
                            <option value="5">5 años</option>
                            <option value="0">Otro</option>
                        </select>
                    </div>
                    <div class="input-group mb-3 col-12 col-sm-6">
                        <div class="input-group-prepend">
                            <label type="button" class="btn btn-info">Inicio</label>
                        </div>
                        <input type="date" class="form-control" wire:model="fechainicio" wire:change="CambiarFechaInicio()">
                    </div>
                    <div class="input-group mb-3 col-12 col-sm-6">
                        <div class="input-group-prepend">
                            <label type="button" class="btn btn-info">Cuotas</label>
                        </div>
                        <input type="number" class="form-control" wire:model="cuotas" disabled>
                    </div>
                    <div class="input-group mb-3 col-12 col-sm-6">
                        <div class="input-group-prepend">
                            <label type="button" class="btn btn-info">Fin</label>
                        </div>
                        <input type="date" class="form-control" wire:model="fechafin" disabled>
                    </div>
                    <div class="input-group mb-3 col-12">
                        <div class="input-group-prepend">
                            <label type="button" class="btn btn-info">Observaciones</label>
                        </div>
                        <input type="text" class="form-control" wire:model="observaciones">
                    </div>
                </div>
            </div>

            {{-- Detalles --}}
            <div class="card">
                <div style="text-align: center; background-color: rgb(107 133 114); margin-bottom: 10px; padding: 5px; font-size: 14px; color: #ffffff; height: 35px;">Detalles</div>
                <div class="card-body d-flex flex-wrap">
                    <div class="input-group mb-3 col-12 col-sm-6">
                        <label type="button" class="btn btn-info">Administra alq.</label>
                        <select class="form-control">
                            <option value="1">Administra</option>
                            <option value="2">No administra</option>
                            <option value="0">No especifica / otro</option>
                        </select>
                    </div>
                    <div class="input-group mb-3 col-12 col-sm-6">
                        <label type="button" class="btn btn-info">F. de pago Inq.</label>
                        <select class="form-control">
                            <option value="1">Efectivo en local</option>
                            <option value="2">Transf. a Inmobiliaria</option>
                            <option value="3">Transf. a Propietario</option>
                            <option value="0">No especifica / otro</option>
                        </select>
                    </div>
                    <div class="input-group mb-3 col-12 col-sm-6">
                        <label type="button" class="btn btn-info">Cartera</label>
                        <select class="form-control">
                            <option value="0">No especifica / otro</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- Estados --}}
            <div class="card">
                <div style="text-align: center; background-color: rgb(107 133 114); margin-bottom: 10px; padding: 5px; font-size: 14px; color: #ffffff; height: 35px;">
                    Estado
                </div>
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
                        <div>
                            <label class="switch">
                                <input type="checkbox" id="switchNotifMora">
                                <span class="slider round"></span>
                            </label>
                            <span class="textoSwitch">Incluir moras de este contr. en gráficos y listados</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Intereses Punitorios --}}
            <div class="card">
                <div style="text-align: center; background-color: rgb(107 133 114); margin-bottom: 10px; padding: 5px; font-size: 14px; color: #ffffff; height: 35px;">
                    Intereses punitorios
                </div>
                <div class="card-body d-flex flex-wrap">
                    <select class="form-control">
                        <option value="G" selected="">Usar config. gral. de la inmobiliaria</option>
                        <option value="P">Usar config. particular para este contr.</option>
                        <option value="N">No cobrar punitorios en este contrato</option>
                    </select>    
                </div>
            </div>

            {{-- Conf General --}}
            <div class="card">
                <div style="text-align: center; background-color: rgb(107 133 114); margin-bottom: 10px; padding: 5px; font-size: 14px; color: #ffffff; height: 35px;">
                    Config. gral.
                </div>
                <div class="card-body d-flex flex-wrap">
                    <div class="input-group mb-3 col-12 col-sm-6">
                        <label type="button" class="btn btn-info">Porc. diario</label>
                        <input class="form-control" type="number">
                    </div>
                    <div class="input-group mb-3 col-12 col-sm-6">
                        <label type="button" class="btn btn-info">Inicio cálculo</label>
                        <input class="form-control" type="number">
                    </div>
                    <div class="input-group mb-3 col-12 col-sm-6">
                        <label type="button" class="btn btn-info">Días de gracia</label>
                        <input class="form-control" type="number">
                    </div>
                    <hr>
                    <div class="switch_div">
                        <label class="switch">
                            <input type="checkbox" disabled="">
                        </span class="slider round"></span>
                        </label>
                    </div>
                </div>

                <div class="card-body d-flex flex-wrap">
                    <span class="textoSwitch col-12">Reintegrar punitorios al Propietario</span>
                    <div class="col-12">
                        <label class="switch">
                            <input type="checkbox" disabled="">
                            <span class="slider round"></span>
                        </label>
                        <span class="textoSwitch">Cobrar admin sobre punitorios</span>
                    </div>

                    <div class="input-group" style="width: 100%; display: none;">
                        <span class="input-group-addon">Porcentaje</span>
                        <input type="number" class="form-control">
                    </div>
                </div>
                <div class="card-body flex-wrap">
                    <div class="text-center">
                        <button class="btn btn-primary">Editar estos valores</button>
                    </div>
                </div>
            </div>

            {{-- Conf Particular --}}
            <div class="card">
                <div style="text-align: center; background-color: rgb(107 133 114); margin-bottom: 10px; padding: 5px; font-size: 14px; color: #ffffff; height: 35px;">Config. particular</div>
                <div class="card-body d-flex flex-wrap">
                    <div class="input-group mb-3 col-12 col-sm-6">
                        <label type="button" class="btn btn-info">Porcentaje diario</label>
                        <input type="number" class="form-control">
                    </div>
                    <div class="input-group mb-3 col-12 col-sm-6">
                        <label type="button" class="btn btn-info">Día inicio cálculo</label>
                        <input type="number" class="form-control">
                    </div>
                    <div class="input-group mb-3 col-12 col-sm-6">
                        <label type="button" class="btn btn-info">Días de gracia</label>
                        <input type="number" class="form-control">
                    </div>
                    <div class="input-group mb-3 col-12 col-sm-6">
                        <label type="button" class="btn btn-info">Base de cálculo</label>
                        <select class="form-control">
                            <option value="0" selected="">Únicamente el alquiler</option>
                            <option value="1">Todos los conceptos</option>
                        </select>                                                
                    </div>
                    <hr>
                    <div class="switch_div">
                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider round"></span>
                        </label>
                        <span class="textoSwitch">Reintegrar punitorios al Propietario</span>                                        
                    </div>
                    <div class="switch_div" id="ctr_switchAdmPunit" style="display: none;">
                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider round"></span>
                        </label>
                        <span class="textoSwitch">Cobrar admin sobre punitorios</span>                                        
                    </div>
                    <div class="input-group" style="width: 100%; display: none;" id="contr__ctr_punit_admPunit_ig">
                        <span id="contr__ctr_punit_admPunit_label" class="input-group-addon">Porcentaje</span>
                        <input type="number" class="bd form-control" id="contr__ctr_punit_admPunit" field="ctr_punit_admPunit" grupo="contr" item="" autocomplete="NoGracias">
                    </div>
                </div>
            </div>

        </div>

        <div class="col-6 col-sm-6">
            {{-- Valores --}}
            <div class="card">
                <div style="text-align: center; background-color: rgb(107 133 114); margin-bottom: 10px; padding: 5px; font-size: 14px; color: #ffffff; height: 35px;">Valores</div>
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
                    </div>
                    <div class="input-group mb-3 col-12 col-sm-6">
                        <div class="input-group-prepend">
                            <label type="button" class="btn btn-info">Actualización</label>
                        </div>
                        <select class="form-control" wire:model="actualizacion_id">
                            <option value="">Selecciona una actualizacion</option>
                            @foreach ($actualizaciones as $actualizacion)
                                <option value="{{ $actualizacion->id }}">{{ $actualizacion->cantmeses}} - {{ $actualizacion->actualizaciondescripcion}}</option>
                            @endforeach
                            <option value="0">Otro</option>
                        </select>
                    </div>
                    <div class="input-group mb-3 col-12 col-sm-6">
                        <div class="input-group-prepend">
                            <label type="button" class="btn btn-info">Tipo Ajuste</label>
                        </div>
                        <select class="form-control" wire:model="tipoajuste_id">
                            <option value="">Selecciona un tipo</option>
                            @foreach ($tipoajustes as $tipoajuste)
                                <option value="{{ $tipoajuste->id }}">{{ $tipoajuste->ajustedescripcion}}</option>
                            @endforeach
                            <option value="0">Otro</option>
                        </select>
                    </div>
                </div>
                <div class="card-body d-flex flex-wrap">
                    <div class="col-12">
                        <div class="d-flex justify-content-around">
                            <div>Desde</div>
                            <div>Hasta</div>
                            <div>Valor</div>
                        </div>
                        <div>
                            <div class="d-flex justify-content-around">
                                <div>Cuota 1 <label style="font-size: 0.7rem">01/08/2024</label></div>
                                <div>Cuota 12<label style="font-size: 0.7rem">31/07/2025</label></div>
                                <div>
                                    <input type="text" size="6">
                                    <label style="font-size: 0.7rem">Valor Actual</label>
                                </div>
                            </div>
                            <div class="d-flex justify-content-around">
                                <div>Cuota 13 <label style="font-size: 0.7rem">01/08/2025</label></div>
                                <div>Cuota 24<label style="font-size: 0.7rem">31/07/2026</label></div>
                                <div>
                                    <input type="text" size="6">
                                    <label style="font-size: 0.7rem">Valor Actual</label>
                                </div>
                            </div>
                            <div class="d-flex justify-content-around">
                                <div>Cuota 25<label style="font-size: 0.7rem">01/08/2026</label></div>
                                <div>Cuota 36<label style="font-size: 0.7rem">31/07/2027</label></div>
                                <div>
                                    <input type="text" size="6">
                                    <label style="font-size: 0.7rem">Valor Actual</label>
                                </div>
                            </div>
                        </div>

                        <div class="alert justify-content-around" role="alert" style="background-color: lightyellow;color: black;">
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

            {{-- Herramientas --}}
            <div class="card">
                <div style="text-align: center; background-color: rgb(107 133 114); margin-bottom: 10px; padding: 5px; font-size: 14px; color: #ffffff; height: 35px;">Herramientas</div>
                <div class="card-body flex-wrap text-center">
                    <button class="btn btn-primary">Agregar conceptos</button>
                    <button class="btn btn-primary">Eliminar contrato</button>
                </div>
            </div>

            {{-- Gastos --}}
            <div class="card">
                <div style="text-align: center; background-color: rgb(107 133 114); margin-bottom: 10px; padding: 5px; font-size: 14px; color: #ffffff; height: 35px;">Gastos de Administr.</div>
                <div class="card-body d-flex flex-wrap">
                    <div class="input-group mb-3 col-12">
                        <label  type="button" class="btn btn-info">Tipo</label>
                        <select class="form-control">
                            <option>Porcentual del alquiler</option>
                            <option>Monto en pesos</option>
                        </select>
                    </div>
                </div>
                <div class="d-flex flex-wrap col-12">
                    <div class="input-group mb-3 col-6">
                        <label  type="button" class="btn btn-info col-6">Porcentaje</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="input-group mb-3 col-6">
                        <label  type="button" class="btn btn-info col-6">Monto</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
            </div>

            {{-- Seguro --}}
            <div class="card">
                <div style="text-align: center; background-color: rgb(107 133 114); margin-bottom: 10px; padding: 5px; font-size: 14px; color: #ffffff; height: 35px;">Seguro contra incendios</div>
                <div class="card-body d-flex flex-wrap">
                    <div class="input-group mb-3 col-12 col-sm-6">
                        <label type="button" class="btn btn-info">Estado</label>
                        <select class="form-control">
                            <option>Trámite completo</option>
                            <option>Trámite incompleto</option>
                            <option>No corresponde / Otro</option>
                        </select>
                    </div>
                    <div class="input-group mb-3 col-12 col-sm-6">
                        <label  type="button" class="btn btn-info">Vencimiento:</label>
                        <input type="date" class="form-control">
                    </div>
                    <div class="input-group mb-3 col-12">
                        <label type="button" class="btn btn-info">Obs. seguro</label>
                        <textarea class="form-control" cols="60"></textarea>
                    </div>
                </div>
            </div>

            {{-- Grupo --}}
            <div class="card">
                <div style="text-align: center; background-color: rgb(107 133 114); margin-bottom: 10px; padding: 5px; font-size: 14px; color: #ffffff; height: 35px;">Grupo </div>
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
            </div>
            
        </div>
    </div>




























    {{-- <div class="card card-primary card-tabs">
        <div class="card-header p-0 pt-1">
            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill"
                        href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages"
                        aria-selected="false">Datos del Contrato</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-inmueble-tab" data-toggle="pill"
                        href="#custom-tabs-one-inmueble" role="tab" aria-controls="custom-tabs-one-inmueble"
                        aria-selected="false">Garantes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-concepto-tab" data-toggle="pill"
                        href="#custom-tabs-one-concepto" role="tab" aria-controls="custom-tabs-one-concepto"
                        aria-selected="false">Conceptos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-documentos-tab" data-toggle="pill" href="#custom-tabs-one-documentos" role="tab" aria-controls="custom-tabs-one-documentos" aria-selected="false">Documentos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-otros-tab" data-toggle="pill" href="#custom-tabs-one-otros"
                        role="tab" aria-controls="custom-tabs-one-otros" aria-selected="false">Otros</a>
                </li>
            </ul>
        </div>

        <div class="card-body">
            <div class="tab-content" id="custom-tabs-one-tabContent">
                <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                    <div class="col-12 d-flex flex-wrap">
                        <div class="col-6 col-sm-6">
                            // Fechas
                            <div class="card">
                                <div style="text-align: center; background-color: rgb(107 133 114); margin-bottom: 10px; padding: 5px; font-size: 14px; color: #ffffff; height: 35px;">
                                    Fechas
                                </div>
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

                            {{-- Detalles
                            <div class="card">
                                <div style="text-align: center; background-color: rgb(107 133 114); margin-bottom: 10px; padding: 5px; font-size: 14px; color: #ffffff; height: 35px;">Detalles</div>
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

                            {{-- Detalles
                            <div class="card">
                                <div style="text-align: center; background-color: rgb(107 133 114); margin-bottom: 10px; padding: 5px; font-size: 14px; color: #ffffff; height: 35px;">
                                    Detalles
                                </div>
                                <div class="card-body d-flex flex-wrap">
                                    <div class="input-group mb-3 col-12 col-sm-6">
                                        <span class="input-group-addon">Administra alq.</span>
                                        <select class="form-control">
                                            <option value="1">Administra</option>
                                            <option value="2">No administra</option>
                                            <option value="0">No especifica / otro</option>
                                        </select>
                                    </div>
                                    <div class="input-group mb-3 col-12 col-sm-6">
                                        <span class="input-group-addon">F. de pago Inq.</span>
                                        <select class="form-control">
                                            <option value="1">Efectivo en local</option>
                                            <option value="2">Transf. a Inmobiliaria</option>
                                            <option value="3">Transf. a Propietario</option>
                                            <option value="0">No especifica / otro</option>
                                        </select>
                                    </div>
                                    <div class="input-group mb-3 col-12 col-sm-6">
                                        <span class="input-group-addon">Cartera</span>
                                        <select class="form-control">
                                            <option value="0">No especifica / otro</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            {{-- Estados
                            <div class="card">
                                <div style="text-align: center; background-color: rgb(107 133 114); margin-bottom: 10px; padding: 5px; font-size: 14px; color: #ffffff; height: 35px;">
                                    Estado
                                </div>
                                <div class="card-body d-flex flex-wrap">
                                    <div class="estadoActivo">
                                        <p>&nbsp;ACTIVO</p>
                                    </div>
                                    <div class="estadoInactivo" style="display: none;">
                                        <p>&nbsp;INACTIVO</p>
                                    </div>

                                    <div id="accionesContrato">
                                        <div>
                                            <button class="btn btn-primary">Rescindir contrato</button>
                                            <button class="btn btn-primary">Renovar contrato</button>
                                            <button class="btn btn-primary">Cambio de inquilino</button>
                                            <button class="btn btn-primary">Eliminar contrato</button>
                                        </div>
                                        <hr>
                                        <div>
                                            <label class="switch">
                                                <input type="checkbox" id="switchNotifMora">
                                                <span class="slider round"></span>
                                            </label>
                                            <span class="textoSwitch">Incluir moras de este contr. en gráficos y listados</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Intereses Punitorios
                            <div class="card">
                                <div style="text-align: center; background-color: rgb(107 133 114); margin-bottom: 10px; padding: 5px; font-size: 14px; color: #ffffff; height: 35px;">
                                    Intereses punitorios
                                </div>
                                <div class="card-body d-flex flex-wrap">
                                    <select class="form-control">
                                        <option value="G" selected="">Usar config. gral. de la inmobiliaria</option>
                                        <option value="P">Usar config. particular para este contr.</option>
                                        <option value="N">No cobrar punitorios en este contrato</option>
                                    </select>    
                                </div>
                            </div>

                            {{-- Conf General
                            <div class="card">
                                <div style="text-align: center; background-color: rgb(107 133 114); margin-bottom: 10px; padding: 5px; font-size: 14px; color: #ffffff; height: 35px;">
                                    Config. gral.
                                </div>
                                <div class="card-body d-flex flex-wrap">
                                    <div class="input-group mb-3 col-12 col-sm-6">
                                        <span id="configPunit__cgp_porc_label" class="input-group-addon">Porc. diario</span>
                                        <input class="form-control" type="number">
                                    </div>
                                    <div class="input-group mb-3 col-12 col-sm-6">
                                        <span id="configPunit__cgp_diaCalc_label" class="input-group-addon">Inicio cálculo</span>
                                        <input class="form-control" type="number">
                                    </div>
                                    <div class="input-group mb-3 col-12 col-sm-6">
                                        <span id="configPunit__cgp_diasGracia_label" class="input-group-addon">Días de gracia</span>
                                        <input class="form-control" type="number">
                                    </div>
                                    <hr>
                                    <div class="switch_div" id="cgp_switchReintegrar">
                                        <label class="switch">
                                            <input type="checkbox" class="bd" item="" grupo="configPunit" field="cgp_reintegrar" disabled="">
                                            <span class="slider round"></span>
                                        </label>
                                        <span class="textoSwitch">Reintegrar punitorios al Propietario</span>
                                    </div>
                                    <div class="switch_div" id="cgp_switchAdmPunit" style="display: none;">
                                        <label class="switch">
                                            <input type="checkbox" disabled="">
                                            <span class="slider round"></span>
                                        </label>
                                        <span class="textoSwitch">Cobrar admin sobre punitorios</span>
                                    </div>

                                    <div class="input-group" style="width: 100%; display: none;" id="configPunit__cgp_admPunit_ig">
                                        <span id="configPunit__cgp_admPunit_label" class="input-group-addon">Porcentaje</span>
                                        <input type="number" class="bd form-control" id="configPunit__cgp_admPunit" field="cgp_admPunit" grupo="configPunit" item="" disabled="" autocomplete="NoGracias">
                                    </div>

                                    <div class="ancho centro">
                                        <button class="btn btn-primary btn-sm">Editar estos valores</button>
                                    </div>
                                </div>
                            </div>

                            {{-- Conf Particular
                            <div class="card">
                                <div style="text-align: center; background-color: rgb(107 133 114); margin-bottom: 10px; padding: 5px; font-size: 14px; color: #ffffff; height: 35px;">
                                    Config. particular
                                </div>
                                <div class="card-body d-flex flex-wrap">
                                    <div class="input-group mb-3 col-12 col-sm-6" id="contr__ctr_punit_porc_ig">
                                        <label type="button" class="btn btn-info">Porcentaje diario</span>
                                        <input type="number" class="bd form-control" id="contr__ctr_punit_porc" field="ctr_punit_porc" grupo="contr" item="" autocomplete="NoGracias">
                                    </div>
                                    <div class="input-group mb-3 col-12 col-sm-6" id="contr__ctr_punit_diaCalc_ig">
                                        <span id="contr__ctr_punit_diaCalc_label" class="input-group-addon">Día inicio cálculo</span>
                                        <input type="number" class="bd form-control" id="contr__ctr_punit_diaCalc" field="ctr_punit_diaCalc" grupo="contr" item="" autocomplete="NoGracias">
                                    </div>
                                    <div class="input-group mb-3 col-12 col-sm-6" id="contr__ctr_punit_diasGracia_ig">
                                        <span id="contr__ctr_punit_diasGracia_label" class="input-group-addon">Días de gracia</span>
                                        <input type="number" class="bd form-control" id="contr__ctr_punit_diasGracia" field="ctr_punit_diasGracia" grupo="contr" item="" autocomplete="NoGracias">
                                    </div>
                                    <div class="input-group mb-3 col-12 col-sm-6" id="ig_ctr_punit_todos">
                                        <span class="input-group-addon">Base de cálculo</span>
                                        <select class="form-control">
                                            <option value="0" selected="">Únicamente el alquiler</option>
                                            <option value="1">Todos los conceptos</option>
                                        </select>                                                
                                    </div>
                                    <hr>
                                    <div class="switch_div" id="ctr_switchReintegrar">
                                        <label class="switch">
                                            <input type="checkbox" class="bd" item="" grupo="contr" field="ctr_punit_reintegrar">
                                            <span class="slider round"></span>
                                        </label>
                                        <span class="textoSwitch">Reintegrar punitorios al Propietario</span>                                        
                                    </div>
                                    <div class="switch_div" id="ctr_switchAdmPunit" style="display: none;">
                                        <label class="switch">
                                            <input type="checkbox">
                                            <span class="slider round"></span>
                                        </label>
                                        <span class="textoSwitch">Cobrar admin sobre punitorios</span>                                        
                                    </div>
                                    <div class="input-group" style="width: 100%; display: none;" id="contr__ctr_punit_admPunit_ig">
                                        <span id="contr__ctr_punit_admPunit_label" class="input-group-addon">Porcentaje</span>
                                        <input type="number" class="bd form-control" id="contr__ctr_punit_admPunit" field="ctr_punit_admPunit" grupo="contr" item="" autocomplete="NoGracias">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-6 col-sm-6">
                            {{-- Valores
                            <div class="card">
                                <div style="text-align: center; background-color: rgb(107 133 114); margin-bottom: 10px; padding: 5px; font-size: 14px; color: #ffffff; height: 35px;">
                                    Valores
                                </div>
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
                                                <div>Cuota 1 <label style="font-size: 0.7rem">01/08/2024</label>
                                                </div>
                                                <div>Cuota 12<label style="font-size: 0.7rem">31/07/2025</label>
                                                </div>
                                                <div>
                                                    <input type="text" size="6">
                                                    <label style="font-size: 0.7rem">Valor Actual</label>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-around">
                                                <div>Cuota 13 <label style="font-size: 0.7rem">01/08/2025</label>
                                                </div>
                                                <div>Cuota 24<label style="font-size: 0.7rem">31/07/2026</label>
                                                </div>
                                                <div>
                                                    <input type="text" size="6">
                                                    <label style="font-size: 0.7rem">Valor Actual</label>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-around">
                                                <div>Cuota 25
                                                    <label style="font-size: 0.7rem">01/08/2026</label>
                                                </div>
                                                <div>Cuota 36
                                                    <label style="font-size: 0.7rem">31/07/2027</label>
                                                </div>
                                                <div>
                                                    <input type="text" size="6">
                                                    <label style="font-size: 0.7rem">Valor Actual</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="alert justify-content-around" role="alert"
                                            style="background-color: lightyellow;color: black;">
                                            <i class="fa fa-exclamation-circle justify-content-around"></i>
                                            <p class="black">Este contrato no tiene conceptos</p>
                                            <hr>
                                            <div class="input-group-prepend justify-content-around">
                                                <button type="button" class="btn btn-info">Agregar
                                                    Coneptos</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Herramientas
                            <div class="card">
                                <div style="text-align: center; background-color: rgb(107 133 114); margin-bottom: 10px; padding: 5px; font-size: 14px; color: #ffffff; height: 35px;">
                                    Herramientas
                                </div>
                                <div class="card-body d-flex flex-wrap">
                                    <button class="btn btn-primary">Agregar conceptos</button>
                                    <button class="btn btn-primary">Eliminar contrato</button>
                                </div>
                            </div>

                            {{-- Gastos
                            <div class="card">
                                <div style="text-align: center; background-color: rgb(107 133 114); margin-bottom: 10px; padding: 5px; font-size: 14px; color: #ffffff; height: 35px;">
                                    Gastos de Administr.
                                </div>
                                <div class="card-body d-flex flex-wrap">
                                    <div class="input-group mb-3 col-12 col-sm-6" id="ig_select_tipoAdmin">
                                        <span class="input-group-addon">Tipo</span>
                                        <select class="form-control">
                                            <option>Porcentual del alquiler</option>
                                            <option>Monto en pesos</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            {{-- Seguro
                            <div class="card">
                                <div style="text-align: center; background-color: rgb(107 133 114); margin-bottom: 10px; padding: 5px; font-size: 14px; color: #ffffff; height: 35px;">
                                    Seguro contra incendios
                                </div>
                                <div class="card-body d-flex flex-wrap">
                                    <div class="input-group mb-3 col-12 col-sm-6">
                                        <span class="input-group-addon">Estado</span>
                                        <select class="form-control">
                                            <option>Trámite completo</option>
                                            <option>Trámite incompleto</option>
                                            <option>No corresponde / Otro</option>
                                        </select>
                                    </div>
                                    <div class="input-group mb-3 col-12 col-sm-6" id="contr__ctr_seg_vence_ig">
                                        <span class="input-group-addon">Vencimiento:</span>
                                        <input type="date" class="bd form-control" id="contr__ctr_seg_vence" field="ctr_seg_vence" grupo="contr" item="" autocomplete="NoGracias">
                                    </div>
                                    <div class="input-group mb-3 col-12 col-sm-6" id="contr__ctr_seg_obs_ig">
                                        <span id="contr__ctr_seg_obs_label" class="input-group-addon">Obs. seguro</span>
                                        <textarea type="" class="bd form-control" id="contr__ctr_seg_obs" field="ctr_seg_obs" grupo="contr" item=""></textarea>
                                    </div>
                                </div>
                            </div>

                            {{-- Grupo
                            <div class="card">
                                <div style="text-align: center; background-color: rgb(107 133 114); margin-bottom: 10px; padding: 5px; font-size: 14px; color: #ffffff; height: 35px;">
                                    Grupo
                                </div>
                                <div class="card-body d-flex flex-wrap">
                                    <div class="input-group mb-3 col-12 col-sm-6" id="contr__ctr_grupo_ig">
                                        <span id="contr__ctr_grupo_label" class="input-group-addon">Nombre grupo</span>
                                        <input type="text" class="bd form-control" id="contr__ctr_grupo" field="ctr_grupo" grupo="contr" item="" autocomplete="NoGracias">
                                    </div>
                                    <div class="input-group mb-3 col-12 col-sm-6" id="contr__ctr_grupo_porc_ig">
                                        <span id="contr__ctr_grupo_porc_label" class="input-group-addon">Porcentaje fracción</span>
                                        <input type="number" class="bd form-control" id="contr__ctr_grupo_porc" field="ctr_grupo_porc" grupo="contr" item="" autocomplete="NoGracias">
                                    </div>
                                    <div>
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
                                    <div class="centro ancho p12">
                                        <button class="btn btn-primary p12" onclick="leeGrupos();">Actualizar</button>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>                

                <div class="tab-pane fade" id="custom-tabs-one-inmueble" role="tabpanel"
                    aria-labelledby="custom-tabs-one-inmueble-tab">
                    <div class="col-12 d-flex">
                        <div class="col-3 m-2 p-2 rounded-md"style="background-color: lightgray;border-radius: 5px;">
                            <img src="" alt="" width="100px" height="100px">
                            <button type="button" class="btn btn-block bg-gradient-info btn-sm">Cambiar
                                Foto</button>
                            <button type="button" class="btn btn-block bg-gradient-info btn-sm">Asignar
                                Persona</button>
                            <button type="button"
                                class="btn btn-block bg-gradient-warning btn-sm">Desvincular</button>
                            <label for="">Liquidación Fraccionada</label>
                            <div class="input-group mb-3 col-xl-6">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-info">Porcentaje</button>
                                </div>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-9 d-flex flex-wrap m-2 p-2 rounded-md"
                            style="background-color: lightgray;border-radius: 5px;">
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

                <div class="tab-pane fade" id="custom-tabs-one-concepto" role="tabpanel" aria-labelledby="custom-tabs-one-concepto-tab">
                    <div class="col-12 d-flex">
                        Concepto
                    </div>
                </div>

                <div class="tab-pane fade" id="custom-tabs-one-documentos" role="tabpanel" aria-labelledby="custom-tabs-one-documentos-tab">
                    <div class="col-12 d-flex">
                        <div class="centro">
                            <!--el bot�n que enlaza con el selector real invisible-->
                            <label for="pc_doc_contr" grupo="doc_contr">
                                <p class="subir_btn btn btn-primary"><svg class="svg-inline--fa fa-upload fa-w-16" aria-hidden="true" data-prefix="fa" data-icon="upload" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M296 384h-80c-13.3 0-24-10.7-24-24V192h-87.7c-17.8 0-26.7-21.5-14.1-34.1L242.3 5.7c7.5-7.5 19.8-7.5 27.3 0l152.2 152.2c12.6 12.6 3.7 34.1-14.1 34.1H320v168c0 13.3-10.7 24-24 24zm216-8v112c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V376c0-13.3 10.7-24 24-24h136v8c0 30.9 25.1 56 56 56h80c30.9 0 56-25.1 56-56v-8h136c13.3 0 24 10.7 24 24zm-124 88c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20zm64 0c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20z"></path></svg><!-- <i class="fa fa-upload" aria-hidden="true"></i> -->&nbsp;Agregar documentos</p>
                            </label>
                            
                            <!--el ok que se va a mostrar despues-->
                            <span class="subir_ok glyphicon glyphicon-ok" style="display:none;color:rgb(0,200,200);"></span>
                            
                            <!--progressbar, se va a mostrar s[olo mientras se sube-->
                            <div class="subir_b1 progress" style="display:none;">
                                <div class="subir_b2 progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100" style="width:5%"></div>
                            </div>
                            
                            <!--el input invisible que va a contener el nombre SUBIDO (esto va a la bd)-->
                            <input type="hidden" name="up_doc_contr" value="" grupo="doc_contr" class="bd invis subir_up" item="" field="per_foto">	
                        
                            <!--los selectores reales invisibles, que contienen el archivo local a subir-->
                            <input type="file" name="pc_doc_contr" class="invis subir_pc" id="pc_doc_contr" onchange="sube('doc_contr',this)" multiple="">	
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="custom-tabs-one-otros" role="tabpanel" aria-labelledby="custom-tabs-one-otros-tab">
                    <div class="col-12 d-flex">
                        <div class="col-6 col-md-6 seccionCalendario">
                            <div class="titSeccion w-full">
                                Calendario
                            </div>
                            <table class="table table-stripped w-full" id="calendar">
                                <caption> </caption>
                                <thead>
                                    <tr>
                                        <th>Lun</th>
                                        <th>Mar</th>
                                        <th>Mie</th>
                                        <th>Jue</th>
                                        <th>Vie</th>
                                        <th>Sab</th>
                                        <th>Dom</th>
                                    </tr>
                                </thead>
                                <tbody> </tbody>
                            </table>
                            
                            <script>                            
                                var actual=new Date();
                                function mostrarCalendario(year,month) {
                                    var now=new Date(year,month-1,1);
                                    var last=new Date(year,month,0);
                                    var primerDiaSemana=(now.getDay()==0)?7:now.getDay();
                                    var ultimoDiaMes=last.getDate();
                                    var dia=0;
                                    var resultado="<tr bgcolor='silver'>";
                                    var diaActual=0;
                                    console.log(ultimoDiaMes);
                                    var last_cell=primerDiaSemana+ultimoDiaMes;
                                    // hacemos un bucle hasta 42 
                                    //de  6 columnas y de 7 días
                                    for(var i=1;i<=42;i++)
                                    {
                                        if(i==primerDiaSemana)
                                        {
                                            // determinamos en que día empieza
                                            dia=1;
                                        }
                                        if(i<primerDiaSemana || i>=last_cell)
                                        {
                                            // celda vacía
                                            resultado+="<td>&nbsp;</td>";
                                        }else{
                                            // mostramos el día
                                            if(dia==actual.getDate() && month==actual.getMonth()+1 && year==actual.getFullYear())
                                                resultado+="<td class='hoy'>"+dia+"</td>";
                                            else
                                                resultado+="<td>"+dia+"</td>";
                                            dia++;
                                        }
                                        if(i%7==0)
                                        {
                                            if(dia>ultimoDiaMes)
                                                break;
                                            resultado+="</tr><tr>\n";
                                        }
                                    }
                                    resultado+="</tr>";
                                
                                var meses=Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
                                
                                    // Calculamos el siguiente mes y año
                                    nextMonth=month+1;
                                    nextYear=year;
                                
                                    if(month+1>12)
                                    {
                                        nextMonth=1;
                                        nextYear=year+1;
                                    }
                                
                                    // Calculamos el anterior mes y año
                                    prevMonth=month-1;
                                    prevYear=year;
                                
                                    if(month-1<1)
                                    {
                                        prevMonth=12;
                                        prevYear=year-1;
                                    }
                                
                                document.getElementById("calendar").getElementsByTagName("caption")[0].innerHTML="<div>"+meses[month-1]+" / "+year+"</div><div><a onclick='mostrarCalendario("+prevYear+","+prevMonth+")'><button>&lt;</button></a><a onclick='mostrarCalendario("+nextYear+","+nextMonth+")'><button>&gt;</button></a></div>";
                                document.getElementById("calendar").getElementsByTagName("tbody")[0].innerHTML=resultado;
                                }
                                mostrarCalendario(actual.getFullYear(),actual.getMonth()+1);
                            </script>
                        
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
                                    <svg class="svg-inline--fa fa-bars fa-w-14" aria-hidden="true" data-prefix="fal" data-icon="bars" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M442 114H6a6 6 0 0 1-6-6V84a6 6 0 0 1 6-6h436a6 6 0 0 1 6 6v24a6 6 0 0 1-6 6zm0 160H6a6 6 0 0 1-6-6v-24a6 6 0 0 1 6-6h436a6 6 0 0 1 6 6v24a6 6 0 0 1-6 6zm0 160H6a6 6 0 0 1-6-6v-24a6 6 0 0 1 6-6h436a6 6 0 0 1 6 6v24a6 6 0 0 1-6 6z"></path></svg><!-- <i class="fal fa-bars" aria-hidden="true"></i> -->
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">

                                    <li><input type="checkbox" id="calend_sab"><span>Incluir sábados</span></li>
                                    <li><input type="checkbox" id="calend_dom"><span>Incluir domingos</span></li>
                                    <hr>                      
                                    <li><input type="checkbox" checked="true" id="calend_fer"><span>Días no laborables</span></li>
                                    <li><input type="checkbox" checked="true" id="calend_tar"><span>Tareas</span></li>
                                    <li><input type="checkbox" id="calend_pag" disabled=""><span class="gris">Pagos a inmoweb</span></li>
                                    <li><input type="checkbox" checked="true" id="calend_fin"><span>Fin contratos</span></li>
                                    <li><input type="checkbox" checked="true" id="calend_seg"><span>Venc. seguros</span></li>
                                    <li><input type="checkbox" checked="true" id="calend_rec"><span>Recibos inq.</span></li>
                                    <li><input type="checkbox" checked="true" id="calend_liq"><span>Liquidaciones prop.</span></li>
                                    
                                </ul>
                            </div>
                        </div>

                        <div class="col-6 col-md-6 seccionTareas">
                            <div class="titSeccion">Tareas (de este inmueble)</div>
                            <div id="listaTareasContr">
                                <div class="contTarea madre" idtarea="4289" idmadre="4289">
                                    <div class="divCheck" title="Click para marcar como completa">
                                        <input type="checkbox" class="check" onchange="complTarea(4289, 1 );"></div>
                                        <div class="divDescr">
                                            <p class="descr"></p>
                                            <p class="inm">Local N° 01 - Planta Baja - Alvear 42 Local N° 0</p>
                                        </div>
                                        <div class="divPriv" title="Privada"></div>
                                            <p class="venc" title="Tarea sin fecha">-</p>
                                            <div class="divBtn">
                                                <button class="btn btn-default" type="button" onclick="editarTarea(4289);"></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="tareasFooter">
                                        <input class="inpDescrNuevaTarea form-control">
                                        <button class="btn btn-primary" onclick="nuevaTarea();"><button>
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
