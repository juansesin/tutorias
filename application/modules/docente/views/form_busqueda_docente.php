<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/validate/cancelar_docente.js"); ?>"></script>
<link href="vendor/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="vendor/select2/dist/js/select2.min.js"></script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Tutorías</h1>
		<ol class="breadcrumb">
		<h4>Periodo: <?php echo $PERIODOS[0]['nombre_periodo']; ?></h4>
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

          <p>No es posible continuar porque existe mas de un periodo activo. Comuniquese con el administrador del sistema.</p>
        </div>
<?php
}else{
?>
		<div class="row">
		<!-- left column -->

			<div class="col-md-12">
	
				<!-- form start -->
				<form id="form" role="form" method="post" autocomplete="off">

					<!-- general form elements -->
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Buscar</h3>
						</div>
						<!-- /.box-header -->			
						
						<div class="box-body">

							<div class="row">
								<div class="col-md-2">
									<div class="form-group">
										<label for="exampleInputEmail1">Fecha inicio</label>

<script>
	$( function() {
		$.datepicker.regional['es'] = {
                closeText: 'Cerrar',
                prevText: '< Ant',
                nextText: 'Sig >',
                currentText: 'Hoy',
                monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
                dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
                dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
                weekHeader: 'Sm',
                dateFormat: 'dd/mm/yy',
                firstDay: 1,
                isRTL: false,
                showMonthAfterYear: false,
                yearSuffix: ''
                };
                $.datepicker.setDefaults($.datepicker.regional['es']);
		$( "#fechaInicio" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd'
		});
	});
</script>

<input type="text" class="form-control" id="fechaInicio" name="fechaInicio" value="<?php if($_POST) { echo $this->input->post('fechaInicio'); }  ?>" placeholder="Fecha inicio" />
										
									</div>
								</div>
									
								<div class="col-md-2">
									<div class="form-group">
										<label for="exampleInputPassword1">Fecha fin</label>
<script>
	$( function() {
                $.datepicker.setDefaults($.datepicker.regional['es']);
		$( "#fechaFin" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd'
		});
	});
</script>
<script type="text/javascript">
    function selectValue(url,id){
	var obj = document.getElementById("motivoCancelacion"+id);
        var motivo = obj.options[obj.selectedIndex];
        if (motivo.value != ""){
            window.location = url +'/'+ motivo.value;
        }
    }
</script>
<input type="text" class="form-control" id="fechaFin" name="fechaFin" value="<?php if($_POST) { echo $this->input->post('fechaFin'); }  ?>" placeholder="Fecha fin" />
									</div>
								</div>
								
								<div class="col-md-3">
									<div class="form-group">
										<label for="exampleInputEmail1">Estado</label>
										<select name="Estado" id="Estado" class="form-control" >
											<option value="">Select...</option>
											<option value=1 >Nueva</option>
											<option value=2 >Pendiente/Programada</option>
											<option value=4 >Cancelada</option>
											<option value=5 >Cerrada</option>
										</select>
									</div>
								</div>

							</div>

							<div class="box-footer">

							<button type="submit" id="btnSubmit" name="btnSubmit" class='btn btn-primary'>
									Buscar Tutoría <span class="glyphicon glyphicon-search" aria-hidden="true">
							</button>	


							</div>			
											
						</div>
						<!-- /.box-body -->

					</div>
					<!-- /.box -->
					
				</form>
				

		<!-- INICIO LISTADO -->
		
		<!-- Small boxes (Stat box) -->		
			<?php 
			if(!$infoTutorias)
			{
			?>
				<div class="col-lg-12 col-xs-12">
					<div class="callout callout-danger">
						<h4>Información</h4>
						<p>No hay Tutorías con los filtros seleccionados.</p>
					</div>
				</div>
			
			<?php
			}else{
								
				foreach ($infoTutorias as $lista):
				
					$bandera = false; //se coloca bandera para ver inscritos
					
					//si esta en 2 pero ya paso la fecha de programacion colocarlo en amarillo
					$fechaTutoriaInicio = $lista["fecha_tutoria"] . " " . $lista['formato_minimo'];
					$fechaCompletaFin = $lista["fecha_tutoria"] . " " . $lista['formato_maximo'];
					
					$fechaTutoriaInicio = date_create($fechaTutoriaInicio);
					$fechaTutoriaFin = date_create($fechaCompletaFin);
					$fechaActual = date_create(date('Y-m-d G:i'));
					
					if($fechaActual >= $fechaTutoriaInicio && $fechaActual <= $fechaTutoriaFin){
						$bandera = true; 
					}
				
					$estadoTutoria = $lista["estado_tutoria"];
					$numero_inscritos = $lista["numero_inscritos"];
									
					switch($estadoTutoria){
						case 1: //nueva tutoria
								$estilos = "bg-gray";
								break;
						case 2: //tutoria programada
								$estilos = "bg-aqua";
								
								if($fechaActual > $fechaTutoriaFin){
									$estilos = "bg-yellow";
								}
								break;
						case 3: //tutoria pendiente, paso la fecha y no se ha cerrado
								$estilos = "bg-yellow";
								break;
						case 4: //tutoria cancelada
								$estilos = "bg-red";
								break;
						case 5: //tutoria cerrada
								$estilos = "bg-green";
								break;
						default: //tutoria nueva
								$estilos = "bg-gray";
								break;
					}
						
				?>
					<div class="col-md-6 col-md-6">
						<!-- small box -->
						<div class="small-box <?php echo $estilos; ?>">
							<div class="inner">
								<h3>Inscritos <?php echo $numero_inscritos; ?></h3>

								<p>
		
									<?php if($lista['asignaturas']){ ?>
									<strong>Asignatura: </strong><?php echo $lista['asignaturas']; ?>

									<?php
									}else{
										//buscar asignaturas
										$arrParam = array("idTutoria" => $lista['fk_id_tutorias_base']);
										$infoAsignaturas = $this->general_model->get_asignaturas_tutoria($arrParam);
										
										echo "<strong>Asignaturas: </strong>";
										foreach ($infoAsignaturas as $datos):
											echo "<br>" . $datos['asignaturas'];
										endforeach;
										
									}
									?>									
									
									<?php if($lista['temas']){ ?>
										<br><strong>Tema: </strong><?php echo $lista['temas']; ?>
									<?php } ?>
									<br><strong>Horario: </strong><?php echo $lista['fecha_tutoria'] . ' / ' . $lista['minimo'] . '-' . $lista['maximo']; ?>
									<br><strong>Lugar: </strong><?php echo $lista['direccion']; ?>
									<br><strong>Docente: </strong><?php echo $lista['NOMBRE']; ?>
								</p>
							</div>
							<div class="icon">
								<i class="fa fa-user"></i>
							</div>
							<?php
							//si la tutoria es nueva o esta pendiente se puede editar
							if($estadoTutoria < 4){
							?>
							

	<div class="btn-group">
		
<?php if($bandera && $numero_inscritos > 0){ ?>
		<a href="<?php echo base_url('docente/inscritos/' . $lista['id_tutorias_principal']); ?>" class="btn btn-info btn-xs">Ver inscritos <i class="fa fa-eye"></i></a>
<?php }
 if($estadoTutoria != 5){
   
	?>
		<a data-target="#modalCancelar<?php echo $lista['id_tutorias_principal'];?>" data-toggle="modal" title="Cancelar tutoría" class="MainNavText" id="MainNavHelp" href="#myModal<?php echo $lista['id_tutorias_principal'];?>"><i class="fa fa-trash" style="float:right; color:white;"></i></a>
		   <!--<button type="button" id="<?php echo $lista['id_tutorias_principal']; ?>" class="btn btn-danger btn-xs"> Cancelar <i class="fa fa-trash"></i></button>-->
		   
   <?php } ?>

		
	</div>
							

							<?php }elseif($estadoTutoria == 4){ ?>
							
<div class="small-box-footer">Cancelada </div>
							<?php }elseif($estadoTutoria == 5){ ?>
							
<div class="small-box-footer">Cerrada </div>
							<?php } ?>
							
						</div>
					</div>
				<div class="modal fade bd-example-modal-sm" id="modalCancelar<?php echo $lista['id_tutorias_principal'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Cancelar tutoría</h4>
                                        </div>
                                        <div class="modal-body">
                                                Elija el motivo de cancelación:<br>
					<form><select id="motivoCancelacion<?php echo $lista['id_tutorias_principal'];?>">
					<?php
						$arrData = '';
						$motivosCancelacion = $this->general_model->get_motivosCancelaciones($arrData);
						foreach ($motivosCancelacion as $row):
                					echo '<option value="'.$row->id_motivo_cancelacion.'">'.$row->motivo_cancelacion.'</option>';
        					endforeach;
					?>
          				</select></form><br>
                                                ¿Está seguro de cancelar esta tutoría?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                            <button type="button" class="btn btn-primary" onclick="selectValue('<?php echo base_url();?>tutorias/cancelar_tutoria/<?php echo $lista['id_tutorias_principal'];?>','<?php echo $lista['id_tutorias_principal'];?>')">Cancelar tutoría</button>
                                            <!--<button type="button" class="btn btn-primary" onclick="window.location.href='<?php //echo base_url();?>/tutorias/cancelar_tutoria/<?php //echo $lista['id_tutorias_principal'];?>'">Cancelar tutoría</button>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
				<?php
				endforeach;
			}
			?>
		
		</div>
		<!-- /.row -->

		
		<!-- FIN LISTADO -->
				
				
			</div>
			<!--/.col (left) -->

		</div>
		<!-- /.row -->

		
		

		
		
		
		

<?php
}
?>
	  
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
