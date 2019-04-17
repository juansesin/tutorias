<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Listado de Tutorías
			
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Solicitudes</li>
		</ol>
	</section>
	
	<!-- Main content -->
	<section class="content">
		<!-- Small boxes (Stat box) -->
		<div class="row">
		
			<?php 
			if(!$info)
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
				foreach ($info as $lista):
				
					$bandera = true; //se coloca bandera para poder inscribirse a la tutoria
					
					//si esta en 2 pero ya paso la fecha de programacion colocarlo en amarillo
					$fechaTutoriaInicio = $lista["fecha_tutoria"] . " " . $lista['formato_minimo'];
					$fechaCompletaFin = $lista["fecha_tutoria"] . " " . $lista['formato_maximo'];
					
					$fechaTutoriaInicio = date_create($fechaTutoriaInicio);
					$fechaTutoriaFin = date_create($fechaCompletaFin);
					$fechaActual = date_create(date('Y-m-d G:i'));
					
					if($fechaActual > $fechaTutoriaInicio && $lista["estado_tutoria"] == 1){
						$bandera = false; //no se puede inscribir porque ya empezo la tutoria
						$mensaje = "No es posible inscribirse. Ya inicio la Tutoría. ";
					}
					
					if($fechaActual > $fechaTutoriaFin && $lista["estado_tutoria"] >= 2){
						$bandera = false; //no se puede inscribir porque ya empezo la tutoria
						$mensaje = "No es posible inscribirse. Ya terminó la Tutoría. ";
					}
					
					$cantidadEstudiantes = $lista["cantidad_estudiantes"];
					$numeroInscritos = $lista["numero_inscritos"];
					
					if($numeroInscritos == $cantidadEstudiantes ){
						$bandera = false; //no se puede inscribir ya se lleno el cupo de la tutoria
						$mensaje = "No es posible inscribirse. Se completo el cupo de la Tutoría. ";
					}
					
					if($lista["estado_tutoria"] == 5 ){
						$bandera = false; //no se puede inscribir ya se lleno el cupo de la tutoria
						$mensaje = "No es posible inscribirse. La Tutotoría se encuentra cerrada. ";
					}
					
					switch($lista["estado_tutoria"]){
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
					
					//si es diferente de 4(CANCELADA) SE MUESTRA
					if($lista["estado_tutoria"] != 4){
						
				?>
					<div class="col-lg-6 col-xs-6">
						<!-- small box -->
						<div class="small-box <?php echo $estilos; ?>">
							<div class="inner">
								<h3>Inscritos <?php echo $lista['numero_inscritos']; ?></h3>

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
							
							<?php if($bandera){ ?>
							<a href="<?php echo base_url('estudiante/inscripcion/' . $lista['id_tutorias_principal']); ?>" class="small-box-footer">Inscribirse <i class="fa fa-plus"></i></a>
							<?php }else{ ?>
							<div class="small-box-footer"><?php echo $mensaje; ?></div>
							<?php } ?>
							
							
						</div>
					</div>
				<?php
					}
				endforeach;
				
			}
			?>
		
		</div>
		<!-- /.row -->


	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->