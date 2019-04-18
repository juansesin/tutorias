<script type="text/javascript" src="<?php echo base_url("assets/js/validate/tutorias/ajaxEscuela.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/validate/tutorias/tutorias_v2.js"); ?>"></script>
<script>
function valid_dias() 
{
	if(document.getElementById('lunes').checked || document.getElementById('martes').checked || document.getElementById('miercoles').checked || document.getElementById('jueves').checked || document.getElementById('viernes').checked || document.getElementById('sabado').checked){
		document.getElementById('hddDias').value = 1;
	}else{
		document.getElementById('hddDias').value = "";
	}
}
</script>

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
			<input type="hidden" id="inicio_periodo" name="inicio_periodo" value="<?php echo $PERIODOS[0]['inicio_periodo']; ?>"/>
			<input type="hidden" id="fin_periodo" name="fin_periodo" value="<?php echo $PERIODOS[0]['fin_periodo']; ?>"/>
		
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Crear Tutoría</h3>
            </div>
            <!-- /.box-header -->
						

              <div class="box-body">
			  
                <div class="form-group">
                  <label for="exampleInputEmail1">Sede</label>
					<select name="Sede" id="Sede" class="form-control" >
						<option value=''>Select...</option>
						<?php for ($i = 0; $i < count($SEDE); $i++) { ?>
							<option value="<?php echo $SEDE[$i]["ID_SEDE"]; ?>" <?php if($information[0]["fk_sede"] == $SEDE[$i]["ID_SEDE"]) { echo "selected"; }  ?>><?php echo $SEDE[$i]["NOMBRE_SEDE"]; ?></option>	
						<?php } ?>
					</select>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Escuela</label>
					<select name="Escuela" id="Escuela" class="form-control" >

					</select>
                </div>
				
                <div class="form-group">
                  <label for="exampleInputPassword1">Docente</label>
					<select name="Docente" id="Docente" class="form-control" >

					</select>
                </div>
				
                <div class="form-group">
                  <label for="exampleInputPassword1">Lugar</label>
					<select name="Lugar" id="Lugar" class="form-control" >

					</select>
                </div>
								
              <div class="form-group">
                <label>Asignaturas</label>
                <select name="Asignaturas[]" id="Asignaturas" class="form-control select2" multiple="multiple" data-placeholder="Asignaturas" style="width: 100%;">

                </select>
              </div>
				
                <div class="form-group">
                  <label for="exampleInputPassword1">Cantidad máxima de estudiantes</label>
					<select name="max_estudiante" id="max_estudiante" class="form-control">
						<option value="">Select...</option>
						<?php for ($i = 1; $i <= 24; $i++) { ?>
							<option value='<?php echo $i; ?>' <?php if ($information && $i == $information[0]["tutorias_dias"]) { echo 'selected="selected"'; } ?> ><?php echo $i; ?></option>
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
              <h3 class="box-title">Jornada y frecuencia</h3>
            </div>
            <div class="box-body">
			
              <div class="row">

<?php if($PERIODOS[0]['lunes']==1){ ?>
                <div class="col-xs-4">
				
<input type="checkbox" id="lunes" name="lunes" value=1 <?php if($information && $information[0]["lunes"]){echo "checked";} ?> onclick="valid_dias()"> Lunes<br>

                </div>
                <div class="col-xs-4">
					<select name="horario_minimo_lunes" id="horario_minimo_lunes" class="form-control" >
						<option value="">Select...</option>
						<?php for ($i = 0; $i < count($horas); $i++) { ?>
							<option value="<?php echo $horas[$i]["id_hora"]; ?>" 
							<?php 
							if ($information && $horas[$i]["id_hora"] == $information[0]["horario_minimo"]) 
							{ 
								echo 'selected="selected"'; 
							}  
							?> ><?php echo $horas[$i]["hora"]; ?>
							</option>
						<?php } ?>
					</select>
                </div>
                <div class="col-xs-4">
					<select name="horario_maximo_lunes" id="horario_maximo_lunes" class="form-control" >
						<option value="">Select...</option>
						<?php for ($i = 0; $i < count($horas); $i++) { ?>
							<option value="<?php echo $horas[$i]["id_hora"]; ?>" 
							<?php 
							if ($information && $horas[$i]["id_hora"] == $information[0]["horario_maximo"]) 
							{ 
								echo 'selected="selected"'; 
							}  
							?> ><?php echo $horas[$i]["hora"]; ?>
							</option>
						<?php } ?>
					</select>
                </div>
				
<?php }else{ ?>

<input type="hidden" id="lunes" name="lunes" >

<?php }  ?>
              </div>
              <div class="row">

<?php if($PERIODOS[0]['martes']==1){ ?>
                <div class="col-xs-4">
				
<input type="checkbox" id="martes" name="martes" value=1 <?php if($information && $information[0]["martes"]){echo "checked";} ?> onclick="valid_dias()"> Martes<br>

                </div>
                <div class="col-xs-4">
					<select name="horario_minimo_martes" id="horario_minimo_martes" class="form-control" >
						<option value="">Select...</option>
						<?php for ($i = 0; $i < count($horas); $i++) { ?>
							<option value="<?php echo $horas[$i]["id_hora"]; ?>" 
							<?php 
							if ($information && $horas[$i]["id_hora"] == $information[0]["horario_minimo"]) 
							{ 
								echo 'selected="selected"'; 
							}  
							?> ><?php echo $horas[$i]["hora"]; ?>
							</option>
						<?php } ?>
					</select>
                </div>
                <div class="col-xs-4">
					<select name="horario_maximo_martes" id="horario_maximo_martes" class="form-control" >
						<option value="">Select...</option>
						<?php for ($i = 0; $i < count($horas); $i++) { ?>
							<option value="<?php echo $horas[$i]["id_hora"]; ?>" 
							<?php 
							if ($information && $horas[$i]["id_hora"] == $information[0]["horario_maximo"]) 
							{ 
								echo 'selected="selected"'; 
							}  
							?> ><?php echo $horas[$i]["hora"]; ?>
							</option>
						<?php } ?>
					</select>
                </div>
				
<?php }else{ ?>

<input type="hidden" id="martes" name="martes" >

<?php }  ?>
              </div>
              <div class="row">

<?php if($PERIODOS[0]['miercoles']==1){ ?>
                <div class="col-xs-4">
				
<input type="checkbox" id="miercoles" name="miercoles" value=1 <?php if($information && $information[0]["miercoles"]){echo "checked";} ?> onclick="valid_dias()"> Miercoles<br>

                </div>
                <div class="col-xs-4">
					<select name="horario_minimo_miercoles" id="horario_minimo_miercoles" class="form-control" >
						<option value="">Select...</option>
						<?php for ($i = 0; $i < count($horas); $i++) { ?>
							<option value="<?php echo $horas[$i]["id_hora"]; ?>" 
							<?php 
							if ($information && $horas[$i]["id_hora"] == $information[0]["horario_minimo"]) 
							{ 
								echo 'selected="selected"'; 
							}  
							?> ><?php echo $horas[$i]["hora"]; ?>
							</option>
						<?php } ?>
					</select>
                </div>
                <div class="col-xs-4">
					<select name="horario_maximo_miercoles" id="horario_maximo_miercoles" class="form-control" >
						<option value="">Select...</option>
						<?php for ($i = 0; $i < count($horas); $i++) { ?>
							<option value="<?php echo $horas[$i]["id_hora"]; ?>" 
							<?php 
							if ($information && $horas[$i]["id_hora"] == $information[0]["horario_maximo"]) 
							{ 
								echo 'selected="selected"'; 
							}  
							?> ><?php echo $horas[$i]["hora"]; ?>
							</option>
						<?php } ?>
					</select>
                </div>
				
<?php }else{ ?>

<input type="hidden" id="miercoles" name="miercoles" >

<?php }  ?>
              </div>
              <div class="row">

<?php if($PERIODOS[0]['jueves']==1){ ?>
                <div class="col-xs-4">
				
<input type="checkbox" id="jueves" name="jueves" value=1 <?php if($information && $information[0]["jueves"]){echo "checked";} ?> onclick="valid_dias()"> Jueves<br>

                </div>
                <div class="col-xs-4">
					<select name="horario_minimo_jueves" id="horario_minimo_jueves" class="form-control" >
						<option value="">Select...</option>
						<?php for ($i = 0; $i < count($horas); $i++) { ?>
							<option value="<?php echo $horas[$i]["id_hora"]; ?>" 
							<?php 
							if ($information && $horas[$i]["id_hora"] == $information[0]["horario_minimo"]) 
							{ 
								echo 'selected="selected"'; 
							}  
							?> ><?php echo $horas[$i]["hora"]; ?>
							</option>
						<?php } ?>
					</select>
                </div>
                <div class="col-xs-4">
					<select name="horario_maximo_jueves" id="horario_maximo_jueves" class="form-control" >
						<option value="">Select...</option>
						<?php for ($i = 0; $i < count($horas); $i++) { ?>
							<option value="<?php echo $horas[$i]["id_hora"]; ?>" 
							<?php 
							if ($information && $horas[$i]["id_hora"] == $information[0]["horario_maximo"]) 
							{ 
								echo 'selected="selected"'; 
							}  
							?> ><?php echo $horas[$i]["hora"]; ?>
							</option>
						<?php } ?>
					</select>
                </div>
				
<?php }else{ ?>

<input type="hidden" id="jueves" name="jueves" >

<?php }  ?>
              </div>
              <div class="row">

<?php if($PERIODOS[0]['viernes']==1){ ?>
                <div class="col-xs-4">
				
<input type="checkbox" id="viernes" name="viernes" value=1 <?php if($information && $information[0]["viernes"]){echo "checked";} ?> onclick="valid_dias()"> Viernes<br>

                </div>
                <div class="col-xs-4">
					<select name="horario_minimo_viernes" id="horario_minimo_viernes" class="form-control" >
						<option value="">Select...</option>
						<?php for ($i = 0; $i < count($horas); $i++) { ?>
							<option value="<?php echo $horas[$i]["id_hora"]; ?>" 
							<?php 
							if ($information && $horas[$i]["id_hora"] == $information[0]["horario_minimo"]) 
							{ 
								echo 'selected="selected"'; 
							}  
							?> ><?php echo $horas[$i]["hora"]; ?>
							</option>
						<?php } ?>
					</select>
                </div>
                <div class="col-xs-4">
					<select name="horario_maximo_viernes" id="horario_maximo_viernes" class="form-control" >
						<option value="">Select...</option>
						<?php for ($i = 0; $i < count($horas); $i++) { ?>
							<option value="<?php echo $horas[$i]["id_hora"]; ?>" 
							<?php 
							if ($information && $horas[$i]["id_hora"] == $information[0]["horario_maximo"]) 
							{ 
								echo 'selected="selected"'; 
							}  
							?> ><?php echo $horas[$i]["hora"]; ?>
							</option>
						<?php } ?>
					</select>
                </div>
				
<?php }else{ ?>

<input type="hidden" id="viernes" name="viernes" >

<?php }  ?>
              </div>

              <div class="row">

<?php if($PERIODOS[0]['sabado']==1){ ?>
                <div class="col-xs-4">
				
<input type="checkbox" id="sabado" name="sabado" value=1 <?php if($information && $information[0]["sabado"]){echo "checked";} ?> onclick="valid_dias()"> Sabado<br>

                </div>
                <div class="col-xs-4">
					<select name="horario_minimo_sabado" id="horario_minimo_sabado" class="form-control" >
						<option value="">Select...</option>
						<?php for ($i = 0; $i < count($horas); $i++) { ?>
							<option value="<?php echo $horas[$i]["id_hora"]; ?>" 
							<?php 
							if ($information && $horas[$i]["id_hora"] == $information[0]["horario_minimo"]) 
							{ 
								echo 'selected="selected"'; 
							}  
							?> ><?php echo $horas[$i]["hora"]; ?>
							</option>
						<?php } ?>
					</select>
                </div>
                <div class="col-xs-4">
					<select name="horario_maximo_sabado" id="horario_maximo_sabado" class="form-control" >
						<option value="">Select...</option>
						<?php for ($i = 0; $i < count($horas); $i++) { ?>
							<option value="<?php echo $horas[$i]["id_hora"]; ?>" 
							<?php 
							if ($information && $horas[$i]["id_hora"] == $information[0]["horario_maximo"]) 
							{ 
								echo 'selected="selected"'; 
							}  
							?> ><?php echo $horas[$i]["hora"]; ?>
							</option>
						<?php } ?>
					</select>
                </div>
				
<?php }else{ ?>

<input type="hidden" id="sabado" name="sabado" >

<?php }  ?>


              </div>
			  
              <div class="row">

                <div class="col-xs-4">
					<input type="hidden" id="hddDias" name="hddDias" value=""/>	
				</div>
			</div>
            
			</div>
            <!-- /.box-body -->
          </div>
	</div>
		
		
		<div class="col-md-6">		
          <div class="box box-danger">

            <div class="box-body">
			
              <div class="box-footer">
				
				<button type="button" id="btnSubmit" name="btnSubmit" class='btn btn-primary'>
						Guardar Tutoría <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true">
				</button>	
				
              </div>			

              </div>


			</div>
            <!-- /.box-body -->
          </div>
	</div>
		
</form>			

      </div>
      <!-- /.row -->
	  
<?php
}
 ?>
	  
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>