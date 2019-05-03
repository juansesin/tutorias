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
		<div class="row">
			<div class="col-xs-12">			
				<div class="box">
					<div class="box-header">
						<br>
						
<a href="<?php echo base_url("tutorias/adicionar"); ?>" class="btn btn-success btn-block"><i class="fa fa-plus"></i> Adicionar Tutoría</a>
						
						<br>
					</div>
					
					<!-- /.box-header -->
					<div class="box-body">

<?php
$retornoExito = $this->session->flashdata('retornoExito');
if ($retornoExito) {
?>
	<div class="col-lg-12">	
		<div class="alert alert-success ">
		<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
		<?php echo $retornoExito ?>		
		</div>
	</div>
<?php
}

$retornoError = $this->session->flashdata('retornoError');
if ($retornoError) {
?>
	<div class="col-lg-12">	
		<div class="alert alert-danger ">
		<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
		<?php echo $retornoError ?>
		</div>
	</div>
<?php
}
?> 

				<?php
				if($info){
				?>				

					<table id="example1" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>Editar</th>
								<th>Sede</th>
								<th>Escuela</th>
								<th>Docente</th>
								<th>Fecha</th>
								<th>Horario</th>
							</tr>
						</thead>
						<tbody>
						<?php
						foreach ($info as $lista):
							echo "<tr>";
							echo "<td class='text-center'>";

							$estadoTutoria = $lista["estado_tutoria"];
							if($estadoTutoria != 4){
						?>
						
							<a class='btn btn-success btn-xs' href='<?php echo base_url('tutorias/modificar/' . $lista['id_tutorias_principal']) ?>'>
								Editar <span class="glyphicon glyphicon-edit" aria-hidden="true">
							</a>
							
						<?php
							}else{
								echo "Tutoría cancelada";
							}
							echo "</td>";
							echo "<td>" . $lista['NOMBRE_SEDE'] . "</td>";
							echo "<td>" . $lista['NOMBRE_ESCUELA'] . "</td>";
							echo "<td>" . $lista['NOMBRE'] . "</td>";
							echo "<td>" . $lista['fecha_tutoria'] . "</td>";
							echo "<td>" . $lista['minimo'] . ' - ' . $lista['maximo'] . "</td>";
						endforeach;
						?>
						</tbody>
						<tfoot>
							<tr>
								<th>Editar</th>
								<th>Sede</th>
								<th>Escuela</th>
							</tr>
						</tfoot>
					</table>

				<?php } ?>

					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->

				<!-- /.box -->
				</div>
				
			<!-- /.col -->
			</div>

	  <!-- /.row -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

  
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
  })
</script>