<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/validate/cancelar_tutoria.js"); ?>"></script>

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

          <p>No es posible continuar porque existe mas de un periodo activo. Comuniquese con el administrador del sistema.</p>
        </div>
<?php
}else{
?>




		<div class="row">
		<!-- left column -->

			<div class="col-md-12">
	
				<!-- form start -->
				<form id="form" role="form" method="post">

					<!-- general form elements -->
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Buscar</h3>
						</div>
						<!-- /.box-header -->			
						
						<div class="box-body">

							<div class="row">
								<div class="col-xs-2">
									<div class="form-group">
										<label for="exampleInputEmail1">Fecha inicio</label>

<script>
	$( function() {
		$( "#fechaInicio" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd'
		});
	});
</script>

<input type="text" class="form-control" id="fechaInicio" name="fechaInicio" value="<?php if($_POST) { echo $this->input->post('fechaInicio'); }  ?>" placeholder="Fecha inicio" />
										
									</div>
								</div>
									
								<div class="col-xs-2">
									<div class="form-group">
										<label for="exampleInputPassword1">Fecha fin</label>
<script>
	$( function() {
		$( "#fechaFin" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd'
		});
	});
</script>

<input type="text" class="form-control" id="fechaFin" name="fechaFin" value="<?php if($_POST) { echo $this->input->post('fechaFin'); }  ?>" placeholder="Fecha fin" />
									</div>
								</div>
								
								<div class="col-xs-3">
									<div class="form-group">
										<label for="exampleInputEmail1">Estado</label>
										<select name="Estado" id="Estado" class="form-control" >
											<option value="">Select...</option>
											<option value=1 >Nueva</option>
											<option value=2 >Pendiente/Programada</option>
											<option value=5 >Cerrada</option>
										</select>
									</div>
								</div>

							</div>

							<div class="box-footer">

							<button type="submit" id="btnSubmit" name="btnSubmit" class='btn btn-primary'>
									Buscar Tutoría <span class="glyphicon glyphicon-search" aria-hidden="true">
							</button>	


							</div>			
											
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
				
					$bandera = false; //se coloca bandera para ver inscritos
					
					//si esta en 2 pero ya paso la fecha de programacion colocarlo en amarillo
					$fechaTutoriaInicio = $lista["fecha_tutoria"] . " " . $lista['formato_minimo'];
					$fechaCompletaFin = $lista["fecha_tutoria"] . " " . $lista['formato_maximo'];
					
					$fechaTutoriaInicio = date_create($fechaTutoriaInicio);
					$fechaTutoriaFin = date_create($fechaCompletaFin);
					$fechaActual = date_create(date('Y-m-d G:i'));
					
					if($fechaActual >= $fechaTutoriaInicio && $fechaActual <= $fechaTutoriaFin){
						$bandera = true; 
					}
				
					$estadoTutoria = $lista["estado_tutoria"];
					$numero_inscritos = $lista["numero_inscritos"];
									
					switch($estadoTutoria){
						case 1: //nueva tutoria
								$estilos = "bg-gray";
								break;
						case 2: //tutoria programada
								$estilos = "bg-aqua";
								
								if($fechaActual > $fechaTutoriaFin){
									$estilos = "bg-yellow";
								}
								break;
						case 3: //tutoria pendiente, paso la fecha y no se ha cerrado
								$estilos = "bg-yellow";
								break;
						case 4: //tutoria cancelada
								$estilos = "bg-red";
								break;
						case 5: //tutoria cerrada
								$estilos = "bg-green";
								break;
						default: //tutoria nueva
								$estilos = "bg-gray";
								break;
					}
						
				?>
					<div class="col-lg-6 col-xs-6">
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
							if($estadoTutoria < 4){
							?>
							

	<div class="btn-group">
		
<?php if($bandera && $numero_inscritos > 0){ ?>
		<a href="<?php echo base_url('docente/inscritos/' . $lista['id_tutorias_principal']); ?>" class="btn btn-info btn-xs">Ver inscritos <i class="fa fa-eye"></i></a>
<?php }
 if($estadoTutoria != 5){
	?>
   
		   <button type="button" id="<?php echo $lista['id_tutorias_principal']; ?>" class="btn btn-danger btn-xs"> Cancelar <i class="fa fa-trash"></i></button>
		   
   <?php } ?>

		
	</div>
							

							<?php }elseif($estadoTutoria == 4){ ?>
							
<div class="small-box-footer">Cancelada </div>
							<?php }elseif($estadoTutoria == 5){ ?>
							
<div class="small-box-footer">Cerrada </div>
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