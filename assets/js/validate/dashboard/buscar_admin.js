		$( document ).ready( function () {

			var $select = $('select').select2({
			       placeholder: 'Seleccionar',
			       allowClear: true
			});

			 /*
			  * When you change the value the select via select2, it triggers
			  * a 'change' event, but the jquery validation plugin
			  * only re-validates on 'blur'
			  */
			$select.on('change', function() {
					$(this).trigger('blur');
			});

			$('#form').validate({
				        ignore: 'input[type=hidden], .select2-input, .select2-focusser'
			});
			
			
			$( "#form" ).validate( {
				rules: {

				},
				errorElement: "em",
				errorPlacement: function ( error, element ) {
					// Add the `help-block` class to the error element
					error.addClass( "help-block" );
					error.insertAfter( element );

				},
				highlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".col-sm-3" ).addClass( "has-error" ).removeClass( "has-success" );
				},
				unhighlight: function (element, errorClass, validClass) {
					$( element ).parents( ".col-sm-3" ).addClass( "has-success" ).removeClass( "has-error" );
				},
				submitHandler: function (form) {
					return true;
				}
			});
			
			$("#btnSubmit").click(function(){		
				if ($("#form").valid() == true){
					var form = document.getElementById('form');
					form.submit();	
				}else
				{
					//alert('Error.');
				}
			});

		});