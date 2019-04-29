<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript" src="<?php echo base_url("assets/js/validate/parametros/usuarios.js"); ?>"></script>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="exampleModalLabel">Formulario Adicionar/Editar Usuarios	</h4>
</div>

<div class="modal-body">
	<form name="form" id="form" role="form" method="post" >
		<input type="hidden" id="hddId" name="hddId" value="<?php echo $information?$information[0]["id_user"]:""; ?>"/>

		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="login">Login</label>
					<input type="text" id="usuario" name="usuario" class="form-control" value="<?php echo $information?$information[0]["log_user"]:""; ?>" placeholder="Login" required >
				</div> 
			</div>

			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="estado">Estado</label>
					<select name="state" id="state" class="form-control" required>
						<option value="">Select...</option>
						<option value=1 <?php if($information[0]["state"] == 1) { echo "selected"; }  ?>>Activo</option>
						<option value=2 <?php if($information[0]["state"] == 2) { echo "selected"; }  ?>>Inactivo</option>
					</select>
				</div> 
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="nombre">Nombre</label>
					<input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $information?$information[0]["first_name"]:""; ?>" placeholder="Nombre" required />
				</div>
			</div>
			
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="apellidos">Apellidos</label>
					<input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $information?$information[0]["last_name"]:""; ?>" placeholder="Apellidos" required />
				</div>
			</div>			
		</div>
		
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="movil">Móvil</label>
					<input type="text" class="form-control" id="movil" name="movil" value="<?php echo $information?$information[0]["movil"]:""; ?>" placeholder="Móvil" required />
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="email">Email</label>
					<input type="text" class="form-control" id="email" name="email" value="<?php echo $information?$information[0]["email"]:""; ?>" placeholder="Email" required />
				</div>
			</div>			
		</div>
				
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="movil">Perfil</label>
					<input type="text" class="form-control" id="perfil" name="perfil" value="<?php echo $information?$information[0]["perfil"]:""; ?>" placeholder="Perfil" required />
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
