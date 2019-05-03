<script>

function seleccionar_todo(){
   for (i=0;i<document.asistencia.elements.length;i++)
      if(document.asistencia.elements[i].type == "checkbox")
         document.asistencia.elements[i].checked=1
} 


function deseleccionar_todo(){
   for (i=0;i<document.asistencia.elements.length;i++)
      if(document.asistencia.elements[i].type == "checkbox")
         document.asistencia.elements[i].checked=0
} 



</script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Tutorías
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Reporte de Asistencia</li>
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

<?php 
if(!$info)
{
?>

<div class="callout callout-info">
	<h4>Información</h4>

	<p>No se encuentra inscrito en ninguna Tutoría.</p>
</div>

<?php
}
?>
	
		<!-- Small boxes (Stat box) -->
		<div class="row">
		
			<?php 
			if($info)
			{	
			?>

				<!-- left column -->
				<div class="col-md-5">
				<!-- general form elements -->
					<!-- About Me Box -->
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">REPORTE DE ASISTENCIA</h3>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
						
							<p>
							<strong><i class="fa fa-tag margin-r-5"></i> Asignatura: </strong>
							<br><?php echo $info[0]['asignaturas']; ?>
							</p>
							
							<p>
							<strong><i class="fa fa-pencil margin-r-5"></i> Tema: </strong>
							<br><?php echo $info[0]['temas']; ?>
							</p>
						
							<p>
							<strong><i class="fa fa-calendar margin-r-5"></i> Fecha - Horario: </strong>
							<br><?php echo $info[0]['fecha_tutoria'] . ' - ' . $info[0]['minimo'] . ' / ' . $info[0]['maximo']; ?>
							</p>

							<p>
							<strong><i class="fa fa-thumb-tack margin-r-5"></i> Lugar: </strong>
							<br><?php echo $info[0]['direccion']; ?>
							</p>

							<p>
							<strong><i class="fa fa-user margin-r-5"></i> Docente: </strong>
							<br><?php echo $info[0]['NOMBRE']; ?>
							</p>
							
							<p>
							<strong><i class="fa fa-users margin-r-5"></i> Estudiantes inscritos: </strong>
							<br><?php echo $info[0]['numero_inscritos']; ?>
							</p>
							
						</div>
						<!-- /.box-body -->
					</div>
					<!-- /.box -->
				</div>


				<!--listado de inscritos-->
				<!-- left column -->
				<div class="col-md-7">
				<!-- general form elements -->

					<div class="box box-danger">
						<div class="box-header">
							<h3 class="box-title">LISTADO DE ESTUDIANTES</h3>
						</div>
						<!-- /.box-header -->
					<div class="box-body no-padding">
					
<form  name="asistencia" id="asistencia" method="post" action="<?php echo base_url("docente/update_asistencia"); ?>">
	<input type="hidden" id="hddIdTutoriaPrincipal" name="hddIdTutoriaPrincipal" value="<?php echo $info[0]["id_tutorias_principal"]; ?>"/>
	
					
						<table class="table table-striped">
							<tr>
								<th style="width: 10px">#</th>
								<th>Nombre</th>
								<th class='text-center'>

Asistencia
<br>
<a href="javascript:seleccionar_todo()">Todos</a> |
<a href="javascript:deseleccionar_todo()">Ninguno</a> 

								</th>
								
								<th class='text-center'>
								Calificación
								</th>
							</tr>
					<?php 
						$i = 0;
						foreach ($infoInscritos as $lista): 
							$i++;
					?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $lista['first_name'] . ' ' . $lista['last_name']; ?></td>
								<td class='text-center'>
								<?php
									switch ($lista['asistencia']) {
										case 1:
											$valor = 'Asistió';
											$clase = "text-success";
											$estado = TRUE;
											break;
										case 2:
											$valor = 'No asistió';
											$clase = "text-danger";
											$estado = FALSE;
											break;
									}
									echo '<p class="' . $clase . '"><strong>' . $valor . '</strong>';
									
									
									$data = array(
										'name' => 'estudiante[]',
										'id' => 'estudiante',
										'value' => $lista['id_tutorias_estudiante'],
										'checked' => $estado,
										'style' => 'margin:10px'
									);
									echo form_checkbox($data);
									
									echo '</p>'; ?>
								</td>
								<td class='text-center'>
								<?php
								if($lista['asistencia'] == 1 && $lista["calificacion"]){
									echo "OK";
								}elseif($lista['asistencia'] == 1){
									echo "NO";
								}else{
									echo "NA";
								}
								?>
								</td>
							</tr>
					<?php endforeach; ?>
						
						</table>
						
						<hr>
						<div class="box-header">
							<h3 class="box-title">OBSERVACIONES</h3>
						</div>
						
						<div class="box-body">
							<div class="form-group">
								<textarea id="observaciones" name="observaciones" class="form-control" rows="3"><?php echo $info[0]['observaciones'] ?></textarea>
							</div>
						</div>
						
						<div class="box-footer">
							<button type="submit" id="btnSubmit2" name="btnSubmit2" class='btn btn-info'>
									Guardar Asistencia <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true">
							</button>	
						</div>	
						
</form>
						
					</div>
					<!-- /.box-body -->
					</div>
					<!-- /.box -->
				
				</div>

				
				
			<?php
				
			}
			?>
		
		</div>
		<!-- /.row -->


	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->