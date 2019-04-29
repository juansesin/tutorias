<script>
$(function(){ 
	$(".btn-success").click(function () {	
			var oID = $(this).attr("id");
            $.ajax ({
                type: 'POST',
				url: base_url + 'parametros/cargarModalDocente',
                data: {'idDocente': oID},
                cache: false,
                success: function (data) {
                    $('#tablaDatos').html(data);
                }
            });
	});	
});
</script>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Parámetros - Docente por escuela</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="#">Parámetros</a></li>
			<li class="active">Docente por escuela</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">			
				<div class="box">
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
								<th>Nombre de docente</th>
								<th>Escuela</th>
								
							</tr>
						</thead>
						<tbody>
						<?php
						foreach ($info as $lista):
							echo "<tr>";
							echo "<td class='text-center'>";
						?>
							<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal" id="<?php echo $lista['ID_DOCENTE']; ?>" >
								Editar <span class="glyphicon glyphicon-edit" aria-hidden="true">
							</button>
						<?php
							echo "</td>";
							echo "<td>" . $lista['NOMBRE'] . "</td>";
							echo "<td>" . $lista['NOMBRE_ESCUELA'] . "</td>";
						endforeach;
						?>
						</tbody>
						<tfoot>
							<tr>
								<th>Editar</th>
								<th>Docente</th>
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


<!--INICIO Modal para adicionar HAZARDS -->
<div class="modal fade text-center" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">    
	<div class="modal-dialog" role="document">
		<div class="modal-content" id="tablaDatos">

		</div>
	</div>
</div>                       
<!--FIN Modal para adicionar HAZARDS -->
  
  
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
  })
</script>