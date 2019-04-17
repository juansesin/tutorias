<script type="text/javascript" src="<?php echo base_url("assets/js/validate/estudiante/ajaxTema.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/validate/estudiante/inscripcion.js"); ?>"></script>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Estudiante</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Solicitudes</a></li>
        <li><a href="#">Inscripción</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

<?php
$retornoExito = $this->session->flashdata('retornoExito');
if ($retornoExito) {
?>
		<div class="callout callout-info">
			<h4>Información</h4>

			<p><?php echo $retornoExito ?></p>
		</div>
<?php
}

$retornoError = $this->session->flashdata('retornoError');
if ($retornoError) {
?>
		<div class="callout callout-danger">
			<h4>Información</h4>

			<p><?php echo $retornoError ?></p>
		</div>
		
<?php
}
?> 
				
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Tutoría</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Fecha - Horario</strong>

              <p class="text-muted">
                <?php echo $info[0]['fecha_tutoria'] . '<br>' . $info[0]['minimo'] . '-' . $info[0]['maximo']; ?>
              </p>

              <hr>
			  
              <strong><i class="fa fa-map-marker margin-r-5"></i> Sede - Escuela - Lugar</strong>

              <p class="text-muted">
					<?php echo $info[0]['NOMBRE_SEDE']; ?><br>
					<?php echo $info[0]['NOMBRE_ESCUELA']; ?><br>
					<?php echo $info[0]['direccion']; ?>
			  </p>
			  

              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> Docente</strong>

              <p>
                <?php echo $info[0]['NOMBRE']; ?>
              </p>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
		</div>

<div class="col-md-6">
		
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Seleccionar la Asignatura y el Tema</h3>
            </div>
            <!-- /.box-header -->
						

              <div class="box-body">
			  
<?php
//si se asigno tema entonces no muestro el formulairio. muestro el tema guardado
if($info[0]['estado_tutoria'] != 1){
?>
              <strong><i class="fa fa-book margin-r-5"></i> Asignatura</strong>

              <p class="text-muted">
                <?php echo $info[0]['asignaturas']; ?>
              </p>
			  
              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> Tema</strong>

              <p>
                <?php echo $info[0]['temas']; ?>
              </p>

<?php	
	//si se encuentra inscrito mostra mensaje de lo contrario mostrar boton para confirmar inscripcion
	if($infoInscrito){
?>
		<div class="callout callout-info">
			<h4>Información</h4>

			<p>Usted se encuentra registrado en la Tutoría</p>
		</div>
<?php
	}else{
?>
			  
            <!-- form start -->
			<form id="formRegistro" role="form">
			<input type="hidden" id="hddIdTutoria" name="hddIdTutoria" value="<?php echo $info[0]['id_tutorias_principal']; ?>"/>
			<input type="hidden" id="hddCantidadEstudiantes" name="hddCantidadEstudiantes" value="<?php echo $info[0]['cantidad_estudiantes']; ?>"/>
			<input type="hidden" id="hddNumeroInscritos" name="hddNumeroInscritos" value="<?php echo $info[0]['numero_inscritos']; ?>"/>

		<div class="callout callout-info">
			<h4>Información</h4>

			<p>Para registrarse debe confirmar su registro</p>
		</div>
			
              <div class="box-footer">
				
				<button type="button" id="btnSubmitRegistro" name="btnSubmitRegistro" class='btn btn-primary'>
						Confirma Registro <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true">
				</button>	
				
              </div>			
			  
				</form>
				
              </div>
              <!-- /.box-body -->

<?php
	}

}else{
?>
			  
			  
            <!-- form start -->
			<form id="form" role="form">
			<input type="hidden" id="hddIdTutoria" name="hddIdTutoria" value="<?php echo $info[0]['id_tutorias_principal']; ?>"/>			  
			<input type="hidden" id="hddCantidadEstudiantes" name="hddCantidadEstudiantes" value="<?php echo $info[0]['cantidad_estudiantes']; ?>"/>
                <div class="form-group">
                  <label for="exampleInputEmail1">Asignatura</label>
					<select name="asignatura" id="asignatura" class="form-control" >
						<option value=''>Select...</option>
						<?php for ($i = 0; $i < count($infoAsignaturas); $i++) { ?>
							<option value="<?php echo $infoAsignaturas[$i]["id_param_asignaturas"]; ?>" ><?php echo $infoAsignaturas[$i]["asignaturas"]; ?></option>	
						<?php } ?>
					</select>
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Tema</label>
					<select name="tema" id="tema" class="form-control" >

					</select>
                </div>
				
              <div class="box-footer">
				
				<button type="button" id="btnSubmit" name="btnSubmit" class='btn btn-primary'>
						Inscribirse <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true">
				</button>	
				
              </div>			
			  
				</form>
				
              </div>
              <!-- /.box-body -->



          </div>
          <!-- /.box -->
<?php } ?>
        </div>
        <!--/.col (left) -->


	</div>
					

      </div>
      <!-- /.row -->
	  
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->