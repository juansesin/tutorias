$( document ).ready( function () {

//nueva regla para terminar la encuesta
jQuery.validator.addMethod("validarHoras", function(value, element, param) {
	var horario_minimo = $('#horario_minimo').val();
	var horario_maximo = $('#horario_maximo').val();
	if (horario_minimo >= horario_maximo) {
		return false;
	}else{
		return true;
	}
}, "Debe ser mayor a horario mínimo.");
	
	$( "#form" ).validate( {
		rules: {
			periodo:				{ required: true, minlength: 3, maxlength:100 },
			estado:					{ required: true },
			inicio_periodo:			{ required: true },
			fin_periodo:			{ required: true },
			tutorias_dias:			{ required: true },
			tutorias_semana:		{ required: true },
			cancelaciones:			{ required: true },
			tiempo_cancelacion:		{ required: true },
			horario_minimo:			{ required: true },
			horario_maximo:			{ required: true, validarHoras: true },
			hddDias:				{ required: true }
		},
		errorElement: "em",
		errorPlacement: function ( error, element ) {
			// Add the `help-block` class to the error element
			error.addClass( "help-block" );
			error.insertAfter( element );

		},
		highlight: function ( element, errorClass, validClass ) {
			$( element ).parents( ".col-sm-6" ).addClass( "has-error" ).removeClass( "has-success" );
		},
		unhighlight: function (element, errorClass, validClass) {
			$( element ).parents( ".col-sm-6" ).addClass( "has-success" ).removeClass( "has-error" );
		},
		submitHandler: function (form) {
			return true;
		}
	});
	
	$("#btnSubmit").click(function(){		
	
		if ($("#form").valid() == true){
		
				//Activa icono guardando
				$('#btnSubmit').attr('disabled','-1');
				$("#div_error").css("display", "none");
				$("#div_load").css("display", "inline");
			
				$.ajax({
					type: "POST",	
					url: base_url + "parametros/save_periodo",	
					data: $("#form").serialize(),
					dataType: "json",
					contentType: "application/x-www-form-urlencoded;charset=UTF-8",
					cache: false,
					
					success: function(data){
                                            
						if( data.result == "error" )
						{
							$("#div_load").css("display", "none");
							$('#btnSubmit').removeAttr('disabled');							
							return false;
						} 

						if( data.result )//true
						{	                                                        
							$("#div_load").css("display", "none");
							$('#btnSubmit').removeAttr('disabled');

							var url = base_url + "parametros/periodos";
							$(location).attr("href", url);
						}
						else
						{
							alert('Error. Reload the web page.');
							$("#div_load").css("display", "none");
							$("#div_error").css("display", "inline");
							$('#btnSubmit').removeAttr('disabled');
						}	
					},
					error: function(result) {
						alert('Error. Reload the web page.');
						$("#div_load").css("display", "none");
						$("#div_error").css("display", "inline");
						$('#btnSubmit').removeAttr('disabled');
					}
					
		
				});	
		
		}//if			
	});
});