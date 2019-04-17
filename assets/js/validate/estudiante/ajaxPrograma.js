/**
 * Lista de escuelas
 * @author bmottag
 * @since  15/3/2019
 */

$(document).ready(function () {
	    
    $('#Escuela').change(function () {
        $('#Escuela option:selected').each(function () {
            var Escuela = $('#Escuela').val();
            if (Escuela > 0 || Escuela != '-') {
                $.ajax ({
                    type: 'POST',
					url: base_url + 'tutorias/programasList',
                    data: {'Escuela': Escuela},
                    cache: false,
                    success: function (data)
                    {
                        $('#Programa').html(data);
                    }
                });
								
            } else {
                var data = '';
                $('#Programa').html(data);
            }
        });
    });
    
});