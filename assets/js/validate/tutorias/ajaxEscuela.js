/**
 * Lista de escuelas
 * @author bmottag
 * @since  15/3/2019
 */

$(document).ready(function () {
	
    $('#Sede').change(function () {
        $('#Sede option:selected').each(function () {
            var Sede = $('#Sede').val();
            if ((Sede > 0 || Sede != '') ) {
								
                $.ajax ({
                    type: 'POST',
                    url: base_url + 'tutorias/escuelaList',
                    data: {'Sede': Sede},
                    cache: false,
                    success: function (data)
                    {
                        $('#Escuela').html(data);
                    }
                });
				
                $.ajax ({
                    type: 'POST',
                    url: base_url + 'tutorias/lugarList',
                    data: {'Sede': Sede},
                    cache: false,
                    success: function (data)
                    {
                        $('#Lugar').html(data);
                    }
                });
				
            } else {
                var data = '';
                $('#Escuela').html(data);
				$('#Lugar').html(data);
            }
        });
    });
    
    $('#Escuela').change(function () {
        $('#Escuela option:selected').each(function () {
            var Escuela = $('#Escuela').val();
            if (Escuela > 0 || Escuela != '-') {
                $.ajax ({
                    type: 'POST',
					url: base_url + 'tutorias/docenteList',
                    data: {'Escuela': Escuela},
                    cache: false,
                    success: function (data)
                    {
                        $('#Docente').html(data);
                    }
                });
				
                $.ajax ({
                    type: 'POST',
					url: base_url + 'tutorias/asignaturasList',
                    data: {'Escuela': Escuela},
                    cache: false,
                    success: function (data)
                    {
                        $('#Asignaturas').html(data);
                    }
                });
				
            } else {
                var data = '';
                $('#Docente').html(data);
				$('#Asignaturas').html(data);
            }
        });
    });
    
});