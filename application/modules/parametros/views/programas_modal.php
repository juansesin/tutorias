<script type="text/javascript" src="<?php echo base_url("assets/js/validate/parametros/programas.js"); ?>"></script>

<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="exampleModalLabel">Programas
	<br><small>Adicionar/Editar Programas</small>
	</h4>
</div>

<div class="modal-body">
	<form name="form" id="form" role="form" method="post" >
		<input type="hidden" id="hddId" name="hddId" value="<?php echo $information?$information[0]["id_param_programas"]:""; ?>"/>

		<div class="row">
			<div class="col-sm-12">
				<div class="form-group text-left">
					<label for="type" class="control-label">Escuela : *</label>
					<select name="escuela" id="escuela" class="form-control" >
						<option value=''>Seleccionar...</option>
						<?php for ($i = 0; $i < count($ESCUELA); $i++) { ?>
							<option value="<?php echo $ESCUELA[$i]["ID_ESCUELA"]; ?>" <?php if($information[0]["fk_escuela"] == $ESCUELA[$i]["ID_ESCUELA"]) { echo "selected"; }  ?>><?php echo $ESCUELA[$i]["NOMBRE_ESCUELA"]; ?></option>	
						<?php } ?>
					</select>
				</div> 
			</div>
		</div>
		
		<div class="row">			
			<div class="col-sm-12">
				<div class="form-group text-left">
					<label for="type" class="control-label">Programa : *</label>
					<input type="text" id="programa" name="programa" class="form-control" value="<?php echo $information?$information[0]["programa"]:""; ?>" placeholder="Programa" required >
				</div> 
			</div>
		</div>
		
		<div class="form-group">
			<div class="row" align="center">
				<div style="width:50%;" align="center">
					<input type="button" id="btnSubmit" name="btnSubmit" value="Guardar" class="btn btn-primary"/>
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
			
	</form>
</div>