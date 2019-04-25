$( document ).ready( function () {
				
	$(".btn-default").click(function () {	
			var oID = $(this).attr("id");
			
			//Activa icono guardando
			if(window.confirm('¿Esta seguro de que el docente no asistió?'))
			{
					$(".btn-default").attr('disabled','-1');
					$.ajax ({
						type: 'POST',
						url: base_url + 'estudiante/reportar_inasistencia',
						data: {'identificador': oID},
						cache: false,
						success: function(data){
												
							if( data.result == "error" )
							{
								alert(data.mensaje);
								$(".btn-default").removeAttr('disabled');							
								return false;
							} 
											
							if( data.result )//true
							{	                                                        
								$(".btn-default").removeAttr('disabled');

								var url = base_url + "estudiante/registros";
								$(location).attr("href", url);
							}
							else
							{
								alert('Error. Reload the web page.');
								$(".btn-default").removeAttr('disabled');
							}	
						},
						error: function(result) {
							alert('Error. Reload the web page.');
							$(".btn-default").removeAttr('disabled');
						}

					});
			}
	});
	

});
