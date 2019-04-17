<script type="text/javascript" src="<?php echo base_url("assets/js/validate/tutorias/ajaxEscuela.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/validate/estudiante/ajaxPrograma.js"); ?>"></script>
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
          <h4>Atención!</h4>

          <p>No es posible inscribirse a una Tutoría. Usted supera el número de cancelaciones o fallas permitido para este periodo.</p>
        </div>
		
<?php }else{ ?>
	
            <!-- form start -->
			<form id="form" role="form" method="post">
		
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
					<div class="col-xs-2">
						<div class="form-group">
							<label for="exampleInputEmail1">Sede</label>
							<select name="Sede" id="Sede" class="form-control" >
								<option value=''>Select...</option>
								<?php for ($i = 0; $i < count($SEDE); $i++) { ?>
								<option value="<?php echo $SEDE[$i]["ID_SEDE"]; ?>" <?php if($information[0]["fk_sede"] == $SEDE[$i]["ID_SEDE"]) { echo "selected"; }  ?>><?php echo $SEDE[$i]["NOMBRE_SEDE"]; ?></option>	
								<?php } ?>
							</select>
						</div>
					</div>
						
					<div class="col-xs-4">
						<div class="form-group">
							<label for="exampleInputPassword1">Escuela</label>
							<select name="Escuela" id="Escuela" class="form-control" >

							</select>
						</div>
					</div>
					
					<div class="col-xs-3">
						<div class="form-group">
						<label for="exampleInputPassword1">Programa</label>
						<select name="Programa" id="Programa" class="form-control" >

						</select>
						</div>
					</div>
					
					<div class="col-xs-3">
						<div class="form-group">
						<label for="exampleInputPassword1">Docente</label>
						<select name="Docente" id="Docente" class="form-control" >

						</select>
						</div>
					</div>

				</div>
				
              <div class="box-footer">
	
				<button type="submit" id="btnSubmit" name="btnSubmit" class="btn btn-primary" style="margin-bottom: 10px;">
						Buscar Tutoría <span class="glyphicon glyphicon-search" aria-hidden="true">
				</button>
				<br>
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