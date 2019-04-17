<script>
$(function(){ 
	$(".btn-success").click(function () {	
			var oID = $(this).attr("id");
            $.ajax ({
                type: 'POST',
				url: base_url + 'parametros/cargarModalLugar',
                data: {'idLugar': oID},
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
		<h1>Parámetros -Lugares</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="#">Parámetros</a></li>
			<li class="active">Lugares</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">			
				<div class="box">
					<div class="box-header">
						<br>
						<button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#modal" id="x">
						<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar Lugares
						</button><br>
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
								<th>Dirección</th>
							</tr>
						</thead>
						<tbody>
						<?php
						foreach ($info as $lista):
							echo "<tr>";
							echo "<td class='text-center'>";
						?>
							<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal" id="<?php echo $lista['id_param_lugares']; ?>" >
								Editar <span class="glyphicon glyphicon-edit" aria-hidden="true">
							</button>
						<?php
							echo "</td>";
							echo "<td>" . $lista['NOMBRE_SEDE'] . "</td>";
							echo "<td>" . $lista['direccion'] . "</td>";
						endforeach;
						?>
						</tbody>
						<tfoot>
							<tr>
								<th>Editar</th>
								<th>Sede</th>
								<th>Dirección</th>
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