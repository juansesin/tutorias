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
						<p>No hay tutorías con los filtros seleccionados.</p>
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
					// JSJL Ajuste para que no se puedan inscribir con menos de 24 horas de antelación
					$fechaUnDiasDespues = new DateTime($fechaTutoriaInicio->format('Y-m-d'));
					$fechaUnDiasDespues->modify('-1 day');
					$arrParam = array("idUser" => $this->session->userdata('id'), "idDocente" => $lista["fk_id_docente"]);
					$tutoriaConDocente = $this->general_model->get_tutoria_con_docente($arrParam);
					// JSJL Ajuste para que no se puedan inscribir con menos de 24 horas de antelación
					// JSJL Ajuste para que no se puedan inscribir en el mismo horario
					$arrParam = array("idUser" => $this->session->userdata('id'), "fechaTutoria" => $lista["fecha_tutoria"], "horaInicio" => $lista["hora_inicio"] );
					$tutoriaEnHorario = $this->general_model->get_tutoria_en_horario($arrParam);
					// JSJL Ajuste para que no se puedan inscribir en el mismo horario
					if($tutoriaConDocente == 1){
						$bandera = false; //no se puede inscribir porque ya empezo la tutoria
						$mensaje = "No es posible inscribirse. Ya tiene una solicitud de tutoría con este docente.";
					}
					elseif($fechaActual > $fechaTutoriaInicio && $lista["estado_tutoria"] == 1){
						$bandera = false; //no se puede inscribir porque ya empezo la tutoria
						$mensaje = "No es posible inscribirse. Ya inició la Tutoría. ";
					}
					// JSJL Ajuste para que no se puedan inscribir con menos de 24 horas de antelación
					elseif($fechaActual > $fechaUnDiasDespues && $lista["estado_tutoria"] == 1){
						$bandera = false; //no se puede inscribir porque ya empezo la tutoria
						$mensaje = "No es posible inscribirse. Faltan menos de 24 horas. ";
					}
					// JSJL Ajuste para que no se puedan inscribir con menos de 24 horas de antelación
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
						$bandera = false; //no se puede inscribir la tutoria esta cerrada
						$mensaje = "No es posible inscribirse. La Tutoría se encuentra cerrada. ";
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
				// JSJL agrego condicion para que no muestre las tutorias de un profesor si el estudiante ya tiene una tutpria con él o ya tiene tutoría en ese horario
				// JSJL if($lista["estado_tutoria"] != 4){
					//if($lista["estado_tutoria"] != 4 and $tutoriaConDocente != 1 and $tutoriaEnHorario != 1){
				// JSJL agrego condicion para que no muestre las tutorias de un profesor si el estudiante ya tiene una tutpria con él o ya tiene tutoría en ese horario
						
				?>
					<div class="col-md-6 col-md-6">
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
					//}
				endforeach;
				
			}
			?>
		
		</div>
		<!-- /.row -->


	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
