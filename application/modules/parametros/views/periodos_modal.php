<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

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

<script type="text/javascript" src="<?php echo base_url("assets/js/validate/parametros/periodos_v2.js"); ?>"></script>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="exampleModalLabel">Formulario Adicionar/Editar Periodos	</h4>
</div>

<div class="modal-body">
	<form name="form" id="form" role="form" method="post" >
		<input type="hidden" id="hddId" name="hddId" value="<?php echo $information?$information[0]["id_param_periodos"]:""; ?>"/>

		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="periodo">Nombre periodo</label>
					<input type="text" id="periodo" name="periodo" class="form-control" value="<?php echo $information?$information[0]["nombre_periodo"]:""; ?>" placeholder="Nombre Periodo" required >
				</div> 
			</div>

			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="estado">Estado</label>
					<select name="estado" id="estado" class="form-control" required>
						<option value="">Select...</option>
						<option value=1 <?php if($information[0]["estado"] == 1) { echo "selected"; }  ?>>Activo</option>
						<option value=2 <?php if($information[0]["estado"] == 2) { echo "selected"; }  ?>>Inactivo</option>
					</select>
				</div> 
			</div>
		</div>
		
<script>
	$( function() {
		var dateFormat = "mm/dd/yy",
		from = $( "#inicio_periodo" )
		.datepicker({
			changeMonth: true,
			numberOfMonths: 1
		})
		.on( "change", function() {
			to.datepicker( "option", "minDate", getDate( this ) );
		}),
		to = $( "#fin_periodo" ).datepicker({
			changeMonth: true,
			numberOfMonths: 1
		})
		.on( "change", function() {
			from.datepicker( "option", "maxDate", getDate( this ) );
		});

		function getDate( element ) {
			var date;
			try {
				date = $.datepicker.parseDate( dateFormat, element.value );
			} catch( error ) {
				date = null;
			}

			return date;
		}
	});
</script>

		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="inicio_periodo">Inicio Periodo</label>
					<input type="text" class="form-control" id="inicio_periodo" name="inicio_periodo" value="<?php echo $information?$information[0]["inicio_periodo"]:""; ?>" placeholder="Inicio Periodo" required />
				</div>
			</div>
			
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="fin_periodo">Fin Periodo</label>
					<input type="text" class="form-control" id="fin_periodo" name="fin_periodo" value="<?php echo $information?$information[0]["fin_periodo"]:""; ?>" placeholder="Fin Periodo" required />
				</div>
			</div>			
		</div>
		
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="tutorias_dias">Max. Tutorías por día por estudiante</label>
					<select name="tutorias_dias" id="tutorias_dias" class="form-control">
						<option value="">Select...</option>
						<?php for ($i = 1; $i <= 24; $i++) { ?>
							<option value='<?php echo $i; ?>' <?php if ($information && $i == $information[0]["tutorias_dias"]) { echo 'selected="selected"'; } ?> ><?php echo $i; ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="tutorias_semana">Max. Tutorías activas por semana</label>
					<select name="tutorias_semana" id="tutorias_semana" class="form-control">
						<option value="">Select...</option>
						<?php for ($i = 1; $i <= 24; $i++) { ?>
							<option value='<?php echo $i; ?>' <?php if ($information && $i == $information[0]["tutorias_semana"]) { echo 'selected="selected"'; } ?> ><?php echo $i; ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="tutorias_dias">Fallas o cancelaciones permitidas</label>
					<select name="cancelaciones" id="cancelaciones" class="form-control">
						<option value="">Select...</option>
						<?php for ($i = 1; $i <= 24; $i++) { ?>
							<option value='<?php echo $i; ?>' <?php if ($information && $i == $information[0]["cancelaciones"]) { echo 'selected="selected"'; } ?> ><?php echo $i; ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="tiempo_cancelacion">Tiempo permitido para cancelación </label>
					<select name="tiempo_cancelacion" id="tiempo_cancelacion" class="form-control">
						<option value="">Select...</option>
						<?php for ($i = 1; $i <= 24; $i++) { ?>
							<option value='<?php echo $i; ?>' <?php if ($information && $i == $information[0]["tiempo_cancelacion"]) { echo 'selected="selected"'; } ?> ><?php echo $i . " Hora(s)"; ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="horario_minimo">Horario permitido MIN</label>
					<select name="horario_minimo" id="horario_minimo" class="form-control" >
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
			</div>
			
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="horario_maximo">Horario permitido MAX</label>
					<select name="horario_maximo" id="horario_maximo" class="form-control" >
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
			</div>
		</div>
		
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="tutorias_dias">Días permitidos</label>
<br>

<input type="checkbox" id="lunes" name="lunes" value=1 <?php if($information && $information[0]["lunes"]){echo "checked";} ?> onclick="valid_dias()"> Lunes<br>
<input type="checkbox" id="martes" name="martes" value=1 <?php if($information && $information[0]["martes"]){echo "checked";} ?> onclick="valid_dias()"> Martes<br>
<input type="checkbox" id="miercoles" name="miercoles" value=1 <?php if($information && $information[0]["miercoles"]){echo "checked";} ?> onclick="valid_dias()"> Miércoles<br>
<input type="checkbox" id="jueves" name="jueves" value=1 <?php if($information && $information[0]["jueves"]){echo "checked";} ?> onclick="valid_dias()"> Jueves<br>
<input type="checkbox" id="viernes" name="viernes" value=1 <?php if($information && $information[0]["viernes"]){echo "checked";} ?> onclick="valid_dias()"> Viernes<br>
<input type="checkbox" id="sabado" name="sabado" value=1 <?php if($information && $information[0]["sabado"]){echo "checked";} ?> onclick="valid_dias()"> Sábado<br>


<input type="hidden" id="hddDias" name="hddDias" value=""/>

				</div>
			</div>
			
		</div>
				
		<div class="form-group">
			<div id="div_load" style="display:none">		
				<div class="progress progress-striped active">
					<div class="progress-bar" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
						<span class="sr-only">45% completado</span>
					</div>
				</div>
			</div>
			<div id="div_error" style="display:none">			
				<div class="alert alert-danger"><span class="glyphicon glyphicon-remove" id="span_msj">&nbsp;</span></div>
			</div>	
		</div>
		
		<div class="form-group">
			<div class="row" align="center">
				<div style="width:50%;" align="center">
					<button type="button" id="btnSubmit" name="btnSubmit" class="btn btn-primary" >
						Guardar <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true">
					</button> 
				</div>
			</div>
		</div>
			
	</form>
</div>
