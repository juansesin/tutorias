/**
 * Lista de escuelas
 * @author bmottag
 * @since  15/3/2019
 */

$(document).ready(function () {
	
    $('#asignatura').change(function () {
        $('#asignatura option:selected').each(function () {
            var asignatura = $('#asignatura').val();
            if ((asignatura > 0 || asignatura != '') ) {
								
                $.ajax ({
                    type: 'POST',
                    url: base_url + 'estudiante/temaList',
                    data: {'asignatura': asignatura},
                    cache: false,
                    success: function (data)
                    {
                        $('#tema').html(data);
                    }
                });
								
            } else {
                var data = '';
                $('#tema').html(data);
            }
        });
    });
    
});