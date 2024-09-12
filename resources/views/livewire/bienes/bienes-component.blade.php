<div>
    <div class="card card-primary card-tabs">
        <div class="card-header p-0 pt-1">
            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="false">Carátula del Bien</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" arial-controls="custom-tabs-one-profile" aria-selected="false">Fotos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Historial del Bien</a>
                </li>
            </ul>
        </div>

        <div class="card-body">
            <div class="tab-content" id="custom-tabs-one-tabContent">
                <div class="tab-pane fade" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                    <!-- Primer Tab -->
                    <div class="col-12 d-flex">
                        <div class="col-12">
                            <div class="col-12 d-flex">
                                <div class="col-5 m-2 p-2 rounded-md"
                                    style="background-color: lightgray;border-radius: 5px;">
                                    <p>
                                        <iframe style="border: 0;"
                                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2982.247079534762!2d-4.7054737490897605!3d41.62879048885612!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd4712e13eeba1f7%3A0xad9ad7b9a39491c2!2sMappingGIS!5e0!3m2!1ses!2ses!4v1665138007578!5m2!1ses!2ses"
                                            width="450" height="400"
                                            allowfullscreen="allowfullscreen">
                                        </iframe>
                                    </p>
                                </div>
                                <div class="d-flex flex-wrap col-7 m-2 p-2 rounded-md justify-content-center" style="background-color: lightgray;border-radius: 5px;">
                                    <div class="input-group col-xl-6">
                                        <button type="button" class="col-3 btn btn-info form-control">Tipo</button>
                                        <input type="text" class="col-9 form-control">
                                    </div>
                                    <div class="input-group col-xl-6">  
                                      <button type="button" class="col-3 btn btn-info form-control">Código</button>
                                      <input type="text" class="col-9 form-control">
                                    </div>
                                    <div class="input-group col-12">
                                      <button type="button" class="col-3 btn btn-info form-control">Calle</button>
                                      <input type="text" class="col-9 form-control">
                                    </div>
                                    <div class="input-group col-xl-6">  
                                      <button type="button" class="col-3 btn btn-info form-control">Altura</button>
                                      <input type="text" class="col-9 form-control">
                                    </div>
                                    <div class="input-group col-xl-6">
                                      <button type="button" class="col-3 btn btn-info form-control">Depto</button>
                                      <input type="text" class="col-9 form-control">
                                    </div>
                                    <div class="input-group px-2">
                                      <button type="button" class="col-3 btn btn-info form-control">Provincia</button>
                                      <input type="text" class="col-9 form-control">
                                    </div>
                                    <div class="input-group px-2">
                                                                                                <button type="button" class="col-3 btn btn-info form-control">Localidad</button>
                                      <input type="text" class="col-9 form-control">
                                    </div>
                                                                                            <input type="button" class="form-control btn-success mx-3 col-4" value="Guardar">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-group mb-3 px-3 m-2 p-2 rounded-md"
                                    style="background-color: lightgray;border-radius: 5px;">
                                    <div class="input-group-prepend">
                                        <button type="button"
                                            class="btn btn-info">Observaciones</button>
                                    </div>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-2 m-2 p-2 rounded-md"
                            style="background-color: lightcoral;border-radius: 5px;">
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
                        </div> --}}
                    </div>
                </div>
                <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
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
                <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                    <div class="col-12 d-flex flex-wrap">
                        <div class="col col-md-8 seccionTareas">
                            <div class="titSeccion">Tareas (de este inmueble)</div>
                            <div id="listaTareasInm">
                                <div class="contTarea madre" idtarea="4289" idmadre="4289">
                                    <div class="divCheck" title="Click para marcar como completa">
                                        <input type="checkbox" class="check" onchange="complTarea(4289, 1 );">
                                    </div>
                                    <div class="divDescr">
                                        <p class="descr"></p>
                                        <p class="inm">Local N° 01 - Planta Baja - Alvear 42 Local N° 0</p>
                                    </div>
                                    <div class="divPriv" title="Privada"></div>
                                        <p class="venc" title="Tarea sin fecha">-</p>
                                    </div>
                                </div>
                                <div id="tareasFooter">
                                    <input class="inpDescrNuevaTarea form-control">
                                </div>							
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
