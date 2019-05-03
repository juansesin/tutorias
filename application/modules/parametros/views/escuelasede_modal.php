<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript" src="<?php echo base_url("assets/js/validate/parametros/escuelasede.js"); ?>"></script>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="exampleModalLabel">Formulario Adicionar/Editar Relación Escuela y Sede	</h4>
</div>

<div class="modal-body">
	<form name="form" id="form" role="form" method="post" >
		<input type="hidden" id="hddId" name="hddId" value="<?php echo $information?$information[0]["ID_ESCUELAS_X_SEDE"]:""; ?>"/>

		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="tutorias_dias">Escuela</label>
					<select name="escuela" id="escuela" class="form-control">
						<option value="">Seleccionar...</option>
						<?php for ($i = 1; $i <= 24; $i++) { ?>
							<option value='<?php echo $i; ?>' <?php if ($information && $i == $information[0]["tutorias_dias"]) { echo 'selected="selected"'; } ?> ><?php echo $i; ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="tutorias_semana">Sede</label>
					<select name="sede" id="sede" class="sede">
						<option value="">Select...</option>
						<?php for ($i = 1; $i <= 24; $i++) { ?>
							<option value='<?php echo $i; ?>' <?php if ($information && $i == $information[0]["tutorias_semana"]) { echo 'selected="selected"'; } ?> ><?php echo $i; ?></option>
						<?php } ?>
					</select>
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
