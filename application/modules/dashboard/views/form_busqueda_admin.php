<!--<script type="text/javascript" src="<?php echo base_url("assets/js/validate/tutorias/ajaxEscuela.js"); ?>"></script>-->
<script type="text/javascript" src="<?php echo base_url("assets/js/validate/dashboard/buscar_admin.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/validate/cancelar_tutoria.js"); ?>"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link href="vendor/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="vendor/select2/dist/js/select2.min.js"></script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Tutorías</h1>
		<ol class="breadcrumb">
		<h4>Periodo: <?php echo $PERIODOS[0]['nombre_periodo']; ?></h4>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
	
<?php
//contar numero de periodos
if(count($PERIODOS) != 1){
?>
        <div class="callout callout-danger">
          <h4>Atención!</h4>

          <p>No es posible continuar porque existe mas de un periodo activo. Comuníquese con el administrador del sistema.</p>
        </div>
<?php
}else{
?>




		<div class="row">
		<!-- left column -->

			<div class="col-md-12">
	
				<!-- form start -->
				<form id="form" role="form" method="post" autocomplete="off">

					<!-- general form elements -->
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Buscar</h3>
						</div>
						<!-- /.box-header -->			
						
						<div class="box-body">
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label for="exampleInputEmail1">Sede</label><br>
										<select name="SedeId" id="SedeId" class="form-control" style="width:80%;display:inline-block;">
											<option value=''>Seleccionar...</option>
											<?php for ($i = 0; $i < count($SEDE); $i++) { ?>
											<option value="<?php echo $SEDE[$i]["ID_SEDE"]; ?>" <?php if($information[0]["fk_sede"] == $SEDE[$i]["ID_SEDE"]) { echo "selected"; }  ?>><?php echo $SEDE[$i]["NOMBRE_SEDE"]; ?></option>	
											<?php } ?>
				              			</select>
              							<button style="display:inline-block;padding:5px;" type="submit" id="btnSubmit" name="btnSubmit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></button>
									</div>
								</div>
									
								<div class="col-md-3">
									<div class="form-group">
										<label for="exampleInputPassword1">Escuela</label><br>
						                <select name="EscuelaId" id="EscuelaId" class="form-control" style="width:80%;display:inline-block;">
						      	            <option value=''>Seleccionar...</option>
						        	        <?php foreach($ESCUELA as $escuela) { ?>
						            	    <option value="<?php echo $escuela["ID_ESCUELA"]; ?>"><?php echo $escuela["NOMBRE_ESCUELA"]; ?></option>	
						                	<?php } ?>								
						                </select>
						                <button style="display:inline-block;padding:5px;" type="submit" id="btnSubmit" name="btnSubmit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></button>
									</div>
								</div>

								<div class="col-md-3">
									<div class="form-group">
										<label for="exampleInputPassword1">Docente</label><br>
										<select name="DocenteId" id="DocenteId" class="form-control" style="width:80%;display:inline-block;">
            								<option value=''>Seleccionar...</option>
											<?php foreach($DOCENTE as $docente) { ?>
											<option value="<?php echo $docente["ID_DOCENTE"]; ?>"><?php echo $docente["NOMBRE"]; ?></option>	
											<?php } ?>            
            							</select>
            							<button style="display:inline-block;padding:5px;" type="submit" id="btnSubmit" name="btnSubmit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></button>
									</div>
								</div>
								
								<div class="col-md-3">
									<div class="form-group">
										<label for="exampleInputPassword1">Asignatura</label><br>
										<select name="AsignaturaId" id="AsignaturaId" class="form-control" style="width:80%;display:inline-block;">
										<option value=''>Seleccionar...</option>
										<?php foreach($ASIGNATURA as $asignatura) { ?>
										<option value="<?php echo $asignatura["id_param_asignaturas"]; ?>"><?php echo $asignatura["asignaturas"]; ?></option>	
										<?php } ?>
              							</select>
              							<button style="display:inline-block;padding:5px;" type="submit" id="btnSubmit" name="btnSubmit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></button>
									</div>
								</div>
							</div>

							<div class="row">						
								<div class="col-md-3">
									<div class="form-group">
										<label for="exampleInputEmail1">Estado</label><br>
										<select name="Estado" id="Estado" class="form-control" style="width:80%;display:inline-block;">
											<option value="">Seleccionar...</option>
											<option value="1" >Nueva</option>
											<option value="3" >Pendiente</option>
											<option value="2" >Programada</option>
											<option value="5" >Cerrada</option>
											<option value="4" >Cancelada</option>
										</select>
										<button style="display:inline-block;padding:5px;" type="submit" id="btnSubmit" name="btnSubmit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></button>
									</div>
								</div>

								<div class="col-md-3">
									<div class="form-group">
										<label for="exampleInputEmail1">Fecha inicio</label>

										<script>
											$( function() {
												$.datepicker.regional['es'] = {
 													closeText: 'Cerrar',
													prevText: '< Ant',
													nextText: 'Sig >',
													currentText: 'Hoy',
													monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
													monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
													dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
													dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
													dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
													weekHeader: 'Sm',
													dateFormat: 'dd/mm/yy',
													firstDay: 1,
													isRTL: false,
													showMonthAfterYear: false,
													yearSuffix: ''
												};
												$.datepicker.setDefaults($.datepicker.regional['es']);
												$( "#fechaInicio" ).datepicker({
													changeMonth: true,
													changeYear: true,
													dateFormat: 'yy-mm-dd'
												});
											});
										</script>

										<input style="width:80%;display:inline-block;" type="text" class="form-control" id="fechaInicio" name="fechaInicio" value="<?php if($_POST) { echo $this->input->post('fechaInicio'); }  ?>" placeholder="Fecha inicio" />
										
									</div>
								</div>
									
								<div class="col-md-3">
									<div class="form-group">
										<label for="exampleInputPassword1"></label><br>
										<script>
											$( function() {
												$.datepicker.setDefaults($.datepicker.regional['es']);
												$( "#fechaFin" ).datepicker({
													changeMonth: true,
													changeYear: true,
													dateFormat: 'yy-mm-dd'
												});
											});
										</script>

										<input style="width:80%;display:inline-block;" type="text" class="form-control" id="fechaFin" name="fechaFin" value="<?php if($_POST) { echo $this->input->post('fechaFin'); }  ?>" placeholder="Fecha fin" />

										<button style="display:inline-block;padding:5px;" type="submit" id="btnSubmit" name="btnSubmit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></button>
									</div>
								</div>

							</div>
						
						</div>


							<!--<div class="box-footer">

							<button type="submit" id="btnSubmit" name="btnSubmit" class='btn btn-primary'>
									Buscar Tutoría <span class="glyphicon glyphicon-search" aria-hidden="true">
							</button>	


							</div>-->	
											
						</div>
						<!-- /.box-body -->

					</div>
					<!-- /.box -->
					
				</form>
				

		<!-- INICIO LISTADO -->
		
		<!-- Small boxes (Stat box) -->		
			<?php 
			if(!$infoTutorias)
			{
			?>
				<div class="col-lg-12 col-xs-12">
					<div class="callout callout-danger">
						<h4>Información</h4>
						<p>No hay Tutorías con los filtros seleccionados.</p>
					</div>
				</div>
			
			<?php
			}else{
								
				foreach ($infoTutorias as $lista):
				
					$estadoTutoria = $lista["estado_tutoria"];
					$numero_inscritos = $lista["numero_inscritos"];
					$bandera = true;
				
					switch($estadoTutoria){
						case 1: //nueva tutoria
								$estilos = "bg-gray";
								break;
						case 2: //tutoria programada
								$estilos = "bg-aqua";
								
								//si esta en 2 pero ya paso la fecha de programacion colocarlo en amarillo
								$fechaCompleta = $lista["fecha_tutoria"] . " " . $lista['formato_maximo'];

								$fechaTutoria = date_create($fechaCompleta);
								$fechaActual = date_create(date('Y-m-d G:i'));
																
								if($fechaActual > $fechaTutoria){
									$estilos = "bg-yellow";
									$bandera = false;
								}
								break;
						case 3: //tutoria pendiente, paso la fecha y no se ha cerrado
								$estilos = "bg-yellow";
								$bandera = false;
								break;
						case 4: //tutoria cancelada
								$estilos = "bg-red";
								$bandera = false;
								break;
						case 5: //tutoria cerrada
								$estilos = "bg-green";
								$bandera = false;
								break;
						default: //tutoria nueva
								$estilos = "bg-gray";
								break;
					}
						
				?>
					<div class="col-md-6 col-md-6">
						<!-- small box -->
						<div class="small-box <?php echo $estilos; ?>">
							<div class="inner">
								<h3>Inscritos <?php echo $numero_inscritos; ?></h3>

								<p>
		
									<?php if($lista['asignaturas']){ ?>
									<strong>Asignatura: </strong><?php echo $lista['asignaturas']; ?>

									<?php
									}else{
										//buscar asignaturas
										$arrParam = array("idTutoria" => $lista['fk_id_tutorias_base']);
										$infoAsignaturas = $this->general_model->get_asignaturas_tutoria($arrParam);
										
										echo "<strong>Asignaturas: </strong>";
										foreach ($infoAsignaturas as $datos):
											echo "<br>" . $datos['asignaturas'];
										endforeach;
										
									}
									?>									
									
									<?php if($lista['temas']){ ?>
										<br><strong>Tema: </strong><?php echo $lista['temas']; ?>
									<?php } ?>
									<br><strong>Horario: </strong><?php echo $lista['fecha_tutoria'] . ' / ' . $lista['minimo'] . '-' . $lista['maximo']; ?>
									<br><strong>Lugar: </strong><?php echo $lista['direccion']; ?>
									<br><strong>Docente: </strong><?php echo $lista['NOMBRE']; ?>
								</p>
							</div>
							<div class="icon">
								<i class="fa fa-user"></i>
							</div>
							<?php
							//si la tutoria es nueva o esta pendiente se puede editar
							if($estadoTutoria != 4){
							?>
							

					<div class="btn-group">
								
							<?php if($bandera){ ?>
									<a href="<?php echo base_url('tutorias/modificar/' . $lista['id_tutorias_principal']); ?>" class="btn btn-success btn-xs">Modificar <i class="fa fa-edit"></i></a>
							<?php } ?>
									
							<?php if($numero_inscritos > 0){ ?>
									<a href="<?php echo base_url('tutorias/inscritos/' . $lista['id_tutorias_principal']); ?>" class="btn btn-info btn-xs">Ver inscritos <i class="fa fa-eye"></i></a>
							<?php }

								if($estadoTutoria != 5){
							 ?>

									<button type="button" id="<?php echo $lista['id_tutorias_principal']; ?>" class="btn btn-danger btn-xs"> Cancelar <i class="fa fa-trash"></i></button>
									
							<?php } ?>
									
								</div>
							
							<?php }elseif($estadoTutoria == 4){ ?>
							
							
						<div class="small-box-footer">Cancelada </div>
							<?php } ?>
							
						</div>
					</div>
				<?php
				endforeach;
				
			}
			?>
		
		</div>
		<!-- /.row -->

		
		<!-- FIN LISTADO -->
				
				
			</div>
			<!--/.col (left) -->

		</div>
		<!-- /.row -->

		
		

		
		
		
		

<?php
}
?>
	  
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
