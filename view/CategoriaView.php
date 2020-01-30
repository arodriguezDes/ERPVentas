<?php
require "header.php";
?>
<!--INICIO DE CONTENIDO-->

<!-- Contenedor de contenido. Contiene contenido de la página -->
<div class="content-wrapper">
    <!-- Contenido Header  -->
    <div class="content-header">
        <!-- Contenedor fluid -->
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Categorias</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Categorias</li>
                    </ol>
                </div><!-- Fin Columna -->
            </div><!-- Fin Fila -->
        </div>
        <!-- Fin Contenedor fluid -->
    </div>
    <!-- Fin Contenido Header -->

    <!-- Contenido principal -->
    <section class="content">
        <!-- Contenedor fluid -->
        <div class="container-fluid">            
            <!--Inicio Fila -->
            <div class="row">          
                <!-- Section dentro de fila -->
                <section class="col-md-12 connectedSortable">
                    <!-- Contenido-->
                    <div class="card card-primary">
                        <!-- Header -->
                        <div class="card-header ">
                            <h3 class="card-title" style="margin-top: 10px">
                                <i style="margin-right: 12px" class="fas fa-cogs"></i>
                                Configuracion de Categorias
                            </h3> 
                            <button style="float: right;" type="button" class="btn btn-outline-light" id="btnAgregar" onclick="showForm(true)"><i style="margin-right: 7px" class="fa fa-plus-circle"></i> Agregar</button>  
                            <button style="float: right;" type="button" class="btn btn-outline-light" id="btnAgregar2" onclick="showForm(false)"><i  class="fa fa-plus-circle"></i></button>              
                        </div>
                        <!-- Fin Header -->

                        <!-- Body Table -->
                        <div class="card-body" id="listadoregistros" >
                            <div class="tab-content p-0 ">
                                <table id="tblListado" class="table table-bordered table-striped table-hover" style="width: 100%">
                                    <thead>
                                        <tr>                      
                                            <th>Opciones</th>
                                            <th>Nombre</th>
                                            <th>Descripcion</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Opciones</th>
                                            <th>Nombre</th>
                                            <th>Descripcion</th>
                                            <th>Estado</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <!-- Fin Body Table -->

                        <!-- Body Form -->
                        <div class="card-body" id="formularioregistros" >
                            <div class="tab-content p-0 ">
                                <form name="formulario" id="formulario" method="POST">
                                    <div class="row">
                                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <label>Nombre:</label>
                                            <div class="input-group">                              
                                                <div class="input-group-prepend">                              
                                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                </div>
                                                <input type="hidden" id="idcategoria" name="idcategoria">
                                                <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre">
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <label>Descripcion:</label>
                                            <div class="input-group">                              
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                </div>
                                                <input type="text" id="descripcion" name="descripcion" class="form-control" placeholder="Descripcion">
                                            </div>
                                        </div>                           
                                    </div>

                                    <div class="row" style="margin-top: 20px">        
                                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <button class="btn btn-primary" type="button" onclick="validator()" data-toggle="modal" data-target="#modal-primary" id="btnGuardar"><i style="margin-right: 7px" class="fa fa-save"></i> Guardar</button>

                                            <button class="btn btn-danger" onclick="cancelForm()" type="button"><i style="margin-right: 7px" class="fa fa-arrow-circle-left"></i> Cancelar</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                        <!-- Fin Body Form -->

                        <!-- Body Adicional -->


                        <!-- Fin Body Adicional -->
                    </div>
                    <!-- Fin Contenido -->            
                </section>
                <!--Fin Section dentro de fila -->

                <!--SECTION MODALS-->

                    <!-- Primer modal -->                
                    <div class="modal fade" id="modal-primary"> 
                        <!-- Dialog Modal -->                   
                        <div class="modal-dialog"> 
                            <!-- Contenido Modal-->                               
                            <div class="modal-content bg-primary">                                
                                <div class="modal-header">
                                    <h4 id="title" class="modal-title"> </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">                                        
                                    <p id="question"> </p>
                                </div>                                    
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn btn-outline-light swalDefaultSuccess" onclick="saveorupdate()"  data-dismiss="modal">Confirmar</button>
                                </div>                                    
                            </div>
                            <!-- Fin Contenido Modal-->
                        </div>                        
                        <!-- Fin Dialog Modal -->
                    </div>                
                    <!-- Fin Primer modal -->

                    <!-- Segundo modal -->
                    <div class="modal fade" id="modal-danger">
                        <!-- Dialog Modal -->
                        <div class="modal-dialog">
                            <!-- Contenido Modal-->
                            <div class="modal-content bg-danger">
                                <div class="modal-header">
                                    <h4 class="modal-title">Desactivar Categoria</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <p id="mensajeDes"></p>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn btn-outline-light toastrDefaultError" onclick="defuse()" data-dismiss="modal">Confirmar</button>
                                </div>
                            </div>
                            <!-- Fin Contenido Modal-->
                        </div>
                        <!-- Fin Dialog Modal -->
                    </div>
                    <!-- Fin Segundo modal -->

                    <!-- Tercer modal -->
                    <div class="modal fade" id="modal-success">
                        <!-- Dialog Modal -->
                        <div class="modal-dialog">
                            <!-- Contenido Modal-->
                            <div class="modal-content bg-success">
                                <div class="modal-header">
                                    <h4 class="modal-title">Activar Categoria</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <p id="mensajeAct"></p>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn btn-outline-light toastrDefaultSuccess" onclick="activate()" data-dismiss="modal">Confirmar</button>
                                </div>
                            </div>
                            <!-- Fin Contenido Modal-->
                        </div>
                        <!-- Fin Dialog Modal -->
                    </div>
                    <!-- Fin Tercer modal -->

                <!--FIN SECTION MODALS-->                          
            </div>
            <!-- Fin Fila -->
        </div>
        <!-- Fin Contenedor fluid -->
    </section>
    <!-- Fin Contenido principal -->
</div>
<!-- Fin Contenedor de contenido. Contiene contenido de la página -->

<!--FIN DE CONTENIDO TOTAL-->
<?php
require "footer.php";
?>

<script type="text/javascript" src="scripts/categoriaScript.js"></script>


