<script type="text/javascript" src="<?php echo base_url("assets/js/validate/tutorias/ajaxEscuela.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/validate/estudiante/ajaxPrograma.js"); ?>"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link href="vendor/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="vendor/select2/dist/js/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/validate/estudiante/buscar.js"); ?>"></script>



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
}elseif($infoEstudianteCancelaciones && ($infoEstudianteCancelaciones[0]['numero_cancelaciones'] >= $PERIODOS[0]['cancelaciones'] || $infoEstudianteCancelaciones[0]['numero_fallas'] >= $PERIODOS[0]['cancelaciones'])){
//si el numero de cancelaciones o el numero de fallas es igual al numero permitido de cancelaciones por periodo
// entonces no e puede inscribir a mas tutorias
?>

        <div class="callout callout-danger">
          <h4>¡Atención!</h4>

          <p>No es posible inscribirse a una tutoría. Usted superó el número máximo de cancelaciones o fallas permitidas para este periodo.</p>
        </div>
		
<?php }else{ ?>
	
            <!-- form start -->
			<form id="form" role="form" method="post" autocomplete="off">
		
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
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
						<label for="exampleInputPassword1">Programa</label><br>
						<select name="ProgramaId" id="ProgramaId" class="form-control" style="width:80%;display:inline-block;">
                <option value=''>Seleccionar...</option>
								<?php foreach($PROGRAMA as $programa) { ?>
								<option value="<?php echo $programa["id_param_programas"]; ?>"><?php echo $programa["programa"]; ?></option>	
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

				</div>

			<div class="row">
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

					<div class="col-md-3">
						<div class="form-group">
							<label for="exampleInputEmail1">Fecha</label><br>
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
							<br>
							<script>
								$( function() {
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

              <div class="box-footer">
	
				<!--<button type="submit" id="btnSubmit" name="btnSubmit" class="btn btn-primary" style="margin-bottom: 10px;">
						Buscar Tutoría <span class="glyphicon glyphicon-search" aria-hidden="true">
				</button>
				<br>-->
				<i> Apreciado estudiante, si usted está buscando una Tutoría que no aparece creada, por favor acérquese a Decanatura de Estudiantes para que programen su tema</i>
						
              </div>			
								
              </div>
              <!-- /.box-body -->



          </div>
          <!-- /.box -->

        </div>
        <!--/.col (left) -->
		

	</div>
		
</form>			

      </div>
      <!-- /.row -->

<?php } ?>
	  
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
