<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript" src="<?php echo base_url("assets/js/validate/estudiante/ajaxTema.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/validate/tutorias/editar_tutoria_v2.js"); ?>"></script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Tutorías</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="#">Tutorías</a></li>
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

          <p>No es posible crear una nueva Tutoría porque existe mas de un periodo activo. Comuniquese con el administrador del sistema.</p>
        </div>
<?php
}else{
 ?>
			<div class="callout callout-info">
				<h4>Información periodo</h4>

				<p>
					<strong>Nombre periodo: <strong><?php echo $PERIODOS[0]['nombre_periodo']; ?><br>
					<strong>Inicio periodo: <strong><?php echo $PERIODOS[0]['inicio_periodo']; ?><br>
					<strong>Fin periodo: <strong><?php echo $PERIODOS[0]['fin_periodo']; ?><br>
					<strong>Días permitido: <strong>
					<?php 
						if($PERIODOS[0]['lunes'] == 1){ echo " - Lunes"; } 
						if($PERIODOS[0]['martes'] == 1){ echo " - Martes";}
						if($PERIODOS[0]['miercoles'] == 1){ echo " - Miercoles";}
						if($PERIODOS[0]['jueves'] == 1){ echo " - Jueves";} 
						if($PERIODOS[0]['viernes'] == 1){ echo " - Viernes";} 
						if($PERIODOS[0]['sabado'] == 1){ echo " - Sabado";}
					?><br>	
					<strong>Horario permitido: <strong><?php echo $PERIODOS[0]['minimo'] . ' - ' . $PERIODOS[0]['maximo']; ?><br>
				</p>
			</div>

			<!-- form start -->
			<form id="form" role="form">
				<input type="hidden" id="hddIdTutoriaPrincipal" name="hddIdTutoriaPrincipal" value="<?php echo $info[0]["id_tutorias_principal"]; ?>"/>

			<div class="row">
				<!-- left column -->
				<div class="col-md-6">
					<!-- general form elements -->
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Edición Tutoría</h3>
						</div>
						<!-- /.box-header -->
						

						<div class="box-body">

							<p>
								<strong><i class="fa fa-map-marker margin-r-5"></i> Sede: </strong>
								<?php echo $info[0]['NOMBRE_SEDE']; ?><br>
								<strong><i class="fa fa-map-marker margin-r-5"></i> Escuela: </strong>
								<?php echo $info[0]['NOMBRE_ESCUELA']; ?><br>
								
								
								<?php if($info[0]['asignaturas']){ ?>
								<strong><i class="fa fa-tag margin-r-5"></i> Asignatura: </strong>
								<?php echo $info[0]['asignaturas']; ?><br>

								<?php
								}else{
									//buscar asignaturas
									$arrParam = array("idTutoria" => $info[0]['fk_id_tutorias_base']);
									$infoAsignaturas = $this->general_model->get_asignaturas_tutoria($arrParam);
									
									echo "<strong>Asignaturas: </strong>";
									foreach ($infoAsignaturas as $datos):
										echo "<br>" . $datos['asignaturas'];
									endforeach;
									echo "<br>";
								}
								?>									
									
								<?php if($info[0]['temas']){ ?>
									<strong><i class="fa fa-pencil margin-r-5"></i> Tema: </strong>
									<?php echo $info[0]['temas']; ?>
								<?php } ?>
							</p>
				
							<div class="form-group">
								<label for="exampleInputPassword1">Docente</label>
								<select name="Docente" id="Docente" class="form-control" >
									<option value=''>Select...</option>
									<?php for ($i = 0; $i < count($listaDocentes); $i++) { ?>
										<option value="<?php echo $listaDocentes[$i]["ID_DOCENTE"]; ?>" <?php if($info[0]["fk_id_docente"] == $listaDocentes[$i]["ID_DOCENTE"]) { echo "selected"; }  ?>><?php echo $listaDocentes[$i]["NOMBRE"]; ?></option>	
									<?php } ?>
								</select>
							</div>
				
							<div class="form-group">
								<label for="exampleInputPassword1">Lugar</label>
								<select name="Lugar" id="Lugar" class="form-control" >
									<option value=''>Select...</option>
									<?php for ($i = 0; $i < count($listaLugares); $i++) { ?>
										<option value="<?php echo $listaLugares[$i]["id_param_lugares"]; ?>" <?php if($info[0]["fk_id_lugar"] == $listaLugares[$i]["id_param_lugares"]) { echo "selected"; }  ?>><?php echo $listaLugares[$i]["direccion"]; ?></option>	
									<?php } ?>
								</select>
							</div>
												
						</div>
						<!-- /.box-body -->

					</div>
					<!-- /.box -->

				</div>
				<!--/.col (left) -->
		
				<div class="col-md-6">
				
					<div class="box box-danger">
						<div class="box-header with-border">
						<h3 class="box-title">Horario</h3>
						</div>
						<div class="box-body">
							<div class="row">
								<div class="col-xs-4">
<script>
	$( function() {
		$( "#fecha" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd'
		});
	});
</script>

<input type="text" class="form-control" id="fecha" name="fecha" value="<?php echo $info[0]["fecha_tutoria"]; ?>" placeholder="Fecha" />

								</div>
								<div class="col-xs-3">
									<select name="horarioInicio" id="horarioInicio" class="form-control" >
										<option value="">Select...</option>
										<?php for ($i = 0; $i < count($horas); $i++) { ?>
											<option value="<?php echo $horas[$i]["id_hora"]; ?>" 
											<?php 
											if ($info && $horas[$i]["id_hora"] == $info[0]["hora_inicio"]) 
											{ 
												echo 'selected="selected"'; 
											}  
											?> ><?php echo $horas[$i]["hora"]; ?>
											</option>
										<?php } ?>
									</select>
								</div>
								<div class="col-xs-3">
									<select name="horarioFin" id="horarioFin" class="form-control" >
										<option value="">Select...</option>
										<?php for ($i = 0; $i < count($horas); $i++) { ?>
											<option value="<?php echo $horas[$i]["id_hora"]; ?>" 
											<?php 
											if ($info && $horas[$i]["id_hora"] == $info[0]["hora_fin"]) 
											{ 
												echo 'selected="selected"'; 
											}  
											?> ><?php echo $horas[$i]["hora"]; ?>
											</option>
										<?php } ?>
									</select>
								</div>
							</div>
							
							<hr>
							<p>
								<strong><i class="fa fa-users"></i> Número de inscritos: </strong>
								<?php echo $info[0]['numero_inscritos']; ?>
							</p>
							
						</div>
						<!-- /.box-body -->
					</div>
				</div>
		
				<div class="col-md-6">		
					<div class="box box-danger">
						<div class="box-body">
							<div class="box-footer">
								<button type="button" id="btnSubmit" name="btnSubmit" class='btn btn-primary'>
										Actualizar Tutoría <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true">
								</button>	
							</div>			
						</div>
					</div>
					<!-- /.box-body -->
				</div>
			</div>
		
		</form>			
	  
<?php
}
 ?>
	  
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->