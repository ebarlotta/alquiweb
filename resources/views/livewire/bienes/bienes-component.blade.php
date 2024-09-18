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






                        <div class="card bg-gradient-success">
                            <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">
                                <h3 class="card-title">
                                    <i class="far fa-calendar-alt"></i>Calendar
                                </h3>
                            <div class="card-tools">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                                        <i class="fas fa-bars"></i>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <a href="#" class="dropdown-item">Add new event</a>
                                        <a href="#" class="dropdown-item">Clear events</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item">View calendar</a>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            
                        </div>
                            
                        <div class="card-body pt-0 col-6">
                        
                            <div id="calendar" style="width: 100%">
                                <div class="bootstrap-datetimepicker-widget usetwentyfour">
                                    <ul class="list-unstyled">
                                        <li class="show">
                                            <div class="datepicker">
                                                <div class="datepicker-days" style="">
                                                    <table class="table table-sm">
                                                        <thead>
                                                            <tr>
                                                                <th class="prev" data-action="previous">
                                                                    <span class="fa fa-chevron-left" title="Previous Month"></span>
                                                                </th>
                                                                <th class="picker-switch" data-action="pickerSwitch" colspan="5" title="Select Month">September 2024</th>
                                                                <th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Month"></span></th>
                                                            </tr>
                                                            <tr>
                                                                <th class="dow">Su</th>
                                                                <th class="dow">Mo</th>
                                                                <th class="dow">Tu</th><th class="dow">We</th><th class="dow">Th</th><th class="dow">Fr</th><th class="dow">Sa</th></tr></thead><tbody><tr><td data-action="selectDay" data-day="09/01/2024" class="day weekend">1</td><td data-action="selectDay" data-day="09/02/2024" class="day">2</td><td data-action="selectDay" data-day="09/03/2024" class="day">3</td><td data-action="selectDay" data-day="09/04/2024" class="day">4</td><td data-action="selectDay" data-day="09/05/2024" class="day">5</td><td data-action="selectDay" data-day="09/06/2024" class="day">6</td><td data-action="selectDay" data-day="09/07/2024" class="day weekend">7</td></tr><tr><td data-action="selectDay" data-day="09/08/2024" class="day weekend">8</td><td data-action="selectDay" data-day="09/09/2024" class="day">9</td><td data-action="selectDay" data-day="09/10/2024" class="day">10</td><td data-action="selectDay" data-day="09/11/2024" class="day">11</td><td data-action="selectDay" data-day="09/12/2024" class="day">12</td><td data-action="selectDay" data-day="09/13/2024" class="day">13</td><td data-action="selectDay" data-day="09/14/2024" class="day weekend">14</td></tr><tr><td data-action="selectDay" data-day="09/15/2024" class="day weekend">15</td><td data-action="selectDay" data-day="09/16/2024" class="day">16</td><td data-action="selectDay" data-day="09/17/2024" class="day active today">17</td><td data-action="selectDay" data-day="09/18/2024" class="day">18</td><td data-action="selectDay" data-day="09/19/2024" class="day">19</td><td data-action="selectDay" data-day="09/20/2024" class="day">20</td><td data-action="selectDay" data-day="09/21/2024" class="day weekend">21</td></tr><tr><td data-action="selectDay" data-day="09/22/2024" class="day weekend">22</td><td data-action="selectDay" data-day="09/23/2024" class="day">23</td><td data-action="selectDay" data-day="09/24/2024" class="day">24</td><td data-action="selectDay" data-day="09/25/2024" class="day">25</td><td data-action="selectDay" data-day="09/26/2024" class="day">26</td><td data-action="selectDay" data-day="09/27/2024" class="day">27</td><td data-action="selectDay" data-day="09/28/2024" class="day weekend">28</td></tr><tr><td data-action="selectDay" data-day="09/29/2024" class="day weekend">29</td><td data-action="selectDay" data-day="09/30/2024" class="day">30</td><td data-action="selectDay" data-day="10/01/2024" class="day new">1</td><td data-action="selectDay" data-day="10/02/2024" class="day new">2</td><td data-action="selectDay" data-day="10/03/2024" class="day new">3</td><td data-action="selectDay" data-day="10/04/2024" class="day new">4</td><td data-action="selectDay" data-day="10/05/2024" class="day new weekend">5</td></tr><tr><td data-action="selectDay" data-day="10/06/2024" class="day new weekend">6</td><td data-action="selectDay" data-day="10/07/2024" class="day new">7</td><td data-action="selectDay" data-day="10/08/2024" class="day new">8</td><td data-action="selectDay" data-day="10/09/2024" class="day new">9</td><td data-action="selectDay" data-day="10/10/2024" class="day new">10</td><td data-action="selectDay" data-day="10/11/2024" class="day new">11</td><td data-action="selectDay" data-day="10/12/2024" class="day new weekend">12</td></tr></tbody></table></div><div class="datepicker-months" style="display: none;"><table class="table-condensed"><thead><tr><th class="prev" data-action="previous"><span class="fa fa-chevron-left" title="Previous Year"></span></th><th class="picker-switch" data-action="pickerSwitch" colspan="5" title="Select Year">2024</th><th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Year"></span></th></tr></thead><tbody><tr><td colspan="7"><span data-action="selectMonth" class="month">Jan</span><span data-action="selectMonth" class="month">Feb</span><span data-action="selectMonth" class="month">Mar</span><span data-action="selectMonth" class="month">Apr</span><span data-action="selectMonth" class="month">May</span><span data-action="selectMonth" class="month">Jun</span><span data-action="selectMonth" class="month">Jul</span><span data-action="selectMonth" class="month">Aug</span><span data-action="selectMonth" class="month active">Sep</span><span data-action="selectMonth" class="month">Oct</span><span data-action="selectMonth" class="month">Nov</span><span data-action="selectMonth" class="month">Dec</span></td></tr></tbody></table></div><div class="datepicker-years" style="display: none;"><table class="table-condensed"><thead><tr><th class="prev" data-action="previous"><span class="fa fa-chevron-left" title="Previous Decade"></span></th><th class="picker-switch" data-action="pickerSwitch" colspan="5" title="Select Decade">2020-2029</th><th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Decade"></span></th></tr></thead><tbody><tr><td colspan="7"><span data-action="selectYear" class="year old">2019</span><span data-action="selectYear" class="year">2020</span><span data-action="selectYear" class="year">2021</span><span data-action="selectYear" class="year">2022</span><span data-action="selectYear" class="year">2023</span><span data-action="selectYear" class="year active">2024</span><span data-action="selectYear" class="year">2025</span><span data-action="selectYear" class="year">2026</span><span data-action="selectYear" class="year">2027</span><span data-action="selectYear" class="year">2028</span><span data-action="selectYear" class="year">2029</span><span data-action="selectYear" class="year old">2030</span></td></tr></tbody></table></div><div class="datepicker-decades" style="display: none;"><table class="table-condensed"><thead><tr><th class="prev" data-action="previous"><span class="fa fa-chevron-left" title="Previous Century"></span></th><th class="picker-switch" data-action="pickerSwitch" colspan="5">2000-2090</th><th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Century"></span></th></tr></thead><tbody><tr><td colspan="7"><span data-action="selectDecade" class="decade old" data-selection="2006">1990</span><span data-action="selectDecade" class="decade" data-selection="2006">2000</span><span data-action="selectDecade" class="decade" data-selection="2016">2010</span><span data-action="selectDecade" class="decade active" data-selection="2026">2020</span><span data-action="selectDecade" class="decade" data-selection="2036">2030</span><span data-action="selectDecade" class="decade" data-selection="2046">2040</span><span data-action="selectDecade" class="decade" data-selection="2056">2050</span><span data-action="selectDecade" class="decade" data-selection="2066">2060</span><span data-action="selectDecade" class="decade" data-selection="2076">2070</span><span data-action="selectDecade" class="decade" data-selection="2086">2080</span><span data-action="selectDecade" class="decade" data-selection="2096">2090</span><span data-action="selectDecade" class="decade old" data-selection="2106">2100</span></td></tr></tbody></table></div></div></li><li class="picker-switch accordion-toggle"></li></ul>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>                            
                            </div>
                        </div>





                        
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
