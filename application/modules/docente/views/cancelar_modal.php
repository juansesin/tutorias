<script type="text/javascript" src="<?php echo base_url("assets/js/validate/cancelar_tutoria.js"); ?>"></script>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="exampleModalLabel">Asignaturas
	<br><small>Cancelar tutoría</small>
	</h4>
</div>

<div class="modal-body">
	<form name="form" id="form" role="form" method="post" >
		<input type="hidden" id="hddId" name="hddId" value="<?php echo $information?$information[0]["motivocancelacion_id"]:""; ?>"/>

		<div class="row">
			<div class="col-sm-12">
				<div class="form-group text-left">
					<label for="type" class="control-label">Motivo de cancelación: *</label>
				<select name="motivoCancelacionId" id="motivoCancelacionId" class="form-control" >
					<option value=''>Seleccionar...</option>
					<?php for ($i = 0; $i < count($motivoCancelacionId); $i++) { ?>
						<option value="<?php echo $motivoCancelacionId[$i]["motivocancelacion_id"]; ?>" <?php if($information[0]["motivocancelacion_id"] == $motivoCancelacionId[$i]["motivoCancelacionId"]) { echo "selected"; }  ?>><?php echo $motivoCancelacionId[$i]["motivoCancelacionId"]; ?></option>	
					<?php } ?>
				</select>
				</div> 
			</div>
		</div>
		
		<div class="form-group">
			<div class="row" align="center">
				<div style="width:50%;" align="center">
					<input type="button" id="btnSubmit" name="btnSubmit" value="Cancelar" class="btn btn-primary"/>
				</div>
			</div>
		</div>
			
	</form>
</div>
