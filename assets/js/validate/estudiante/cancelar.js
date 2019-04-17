$( document ).ready( function () {
				
	$(".btn-danger").click(function () {	
			var oID = $(this).attr("id");
			
			//Activa icono guardando
			if(window.confirm('¿Esta seguro de cancelar la inscripción?  \n Recuerde que si supera 3 cancelaciones o inasistencias no podrá acceder de nuevo a este servicio durante el periodo.'))
			{
					$(".btn-danger").attr('disabled','-1');
					$.ajax ({
						type: 'POST',
						url: base_url + 'estudiante/cancelar_inscripcion',
						data: {'identificador': oID},
						cache: false,
						success: function(data){
												
							if( data.result == "error" )
							{
								alert(data.mensaje);
								$(".btn-danger").removeAttr('disabled');							
								return false;
							} 
											
							if( data.result )//true
							{	                                                        
								$(".btn-danger").removeAttr('disabled');

								var url = base_url + "estudiante/registros";
								$(location).attr("href", url);
							}
							else
							{
								alert('Error. Reload the web page.');
								$(".btn-danger").removeAttr('disabled');
							}	
						},
						error: function(result) {
							alert('Error. Reload the web page.');
							$(".btn-danger").removeAttr('disabled');
						}

					});
			}
	});
	

});