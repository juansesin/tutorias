<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estudiante extends CI_Controller {
	
    public function __construct() {
        parent::__construct();
		$this->load->model("general_model");
		$this->load->model("estudiante_model");
    }

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{	

	}
	
	/**
	 * Buscar
     * @since 15/3/2019
     * @author BMOTTAG
	 */
	public function buscar()
	{			
			$data['information'] = FALSE; 
			
			//listado sedes
			$arrParam = array(
				"table" => "sede",
				"order" => "NOMBRE_SEDE",
				"id" => "x"
			);
			$data['SEDE'] = $this->general_model->get_basic_search($arrParam);

			//listado escuelas
			$arrParam = array(
				"table" => "escuela",
				"order" => "NOMBRE_ESCUELA",
				"id" => "x"
			);
			$data['ESCUELA'] = $this->general_model->get_basic_search($arrParam);

			//listado programas
			$arrParam = array(
				"table" => "param_programas",
				"order" => "programa",
				"id" => "x"
			);
			$data['PROGRAMA'] = $this->general_model->get_basic_search($arrParam);

			//listado asignaturas
			$arrParam = array(
				"table" => "param_asignaturas",
				"order" => "asignaturas",
				"id" => "x"
			);
			$data['ASIGNATURA'] = $this->general_model->get_basic_search($arrParam);

			//listado docentes
			$arrParam = array(
				"table" => "docente",
				"order" => "NOMBRE",
				"id" => "x"
			);
			$data['DOCENTE'] = $this->general_model->get_basic_search($arrParam);
						
			//informacion periodo
			$arrParam = array("idEstado" => 1);
			$data['PERIODOS'] = $this->general_model->get_periodos($arrParam);
			
			$idEstudiante = $this->session->userdata("id");
			$idPeriodo = $data['PERIODOS'][0]['id_param_periodos'];

			//busco informacion en la tabla ESTUDIANTE_CANCELACIONES si existe registro
			$arrParam = array("idEstudiante" => $idEstudiante, "idPeriodo" => $idPeriodo);
			$data['infoEstudianteCancelaciones'] = $this->general_model->get_cancelaciones_estudiante($arrParam);		
			
			$arrParamFiltro = array(
				"idHoraInicio" => $data['PERIODOS'][0]['horario_minimo'],
				"idHoraFinal" => $data['PERIODOS'][0]['horario_maximo']
			);
			$data['horas'] = $this->general_model->get_horas($arrParamFiltro);//LISTA DE HORAS
	
			$data["view"] = 'form_busqueda';
			
			//Si envian los datos del filtro entonces muestro tutorias
			if($this->input->post('SedeId') || $this->input->post('EscuelaId') || $this->input->post('ProgramaId') || $this->input->post('DocenteId') || $this->input->post('AsignaturaId') || $this->input->post('fechaInicio') || $this->input->post('fechaFin'))
			{
				$data["view"] = 'listado_tutorias';

				if($this->input->post('DocenteId')){
					$docente = $this->input->post('DocenteId');
				}else{
					$docente = '';
				}
				
				if($this->input->post('ProgramaId')){
					$programa = $this->input->post('ProgramaId');
				}else{
					$programa = '';
				}
				
				$arrParam = array(
								"fechaActual" => true,
								"idSede" => $this->input->post('SedeId'),
								"idEscuela" => $this->input->post('EscuelaId'),
								"idDocente" => $docente,
								"idPrograma" => $programa,
								"idAsignatura" => $this->input->post('AsignaturaId'),
								"fechaInicio" => $this->input->post('fechaInicio'),
								"fechaFin" => $this->input->post('fechaFin'),
								"listaEstadosTutoria" => [1, 2]
							);
				$data['info'] = $this->general_model->get_tutorias($arrParam);
			}

			$this->load->view("layout", $data);
	}		
	
	/**
	 * Inscribirse a una tutoría
     * @since 15/3/2019
     * @author BMOTTAG
	 */
	public function inscripcion($idTutoria)
	{						
			$arrParam = array(
							"idTutoria" => $idTutoria,
							"fechaActual" => true
						);
			$data['info'] = $this->general_model->get_tutorias($arrParam);
			
			$arrParam = array("idTutoria" => $data['info'][0]['fk_id_tutorias_base']);
			$data['infoAsignaturas'] = $this->general_model->get_asignaturas_tutoria($arrParam);
			
			//verificar si se encuentra inscrito en la tutoria			
			$arrParam = array(
							"idTutoria" => $idTutoria,
							"idEstudiante" => $this->session->userdata("id")
							);
			$data['infoInscrito'] = $this->general_model->get_inscritos_tutoria($arrParam);
				
			$data["view"] = 'form_inscripcion';
			$this->load->view("layout", $data);			
	}	
	
	/**
	 * Guardar inscripcion
     * @since 20/3/2019
	 */
	public function guardar_inscripcion()
	{			
			header('Content-Type: application/json');
			
			$idTutoria = $this->input->post('hddIdTutoria');
						
			if ($this->estudiante_model->updateTutoria()) 
			{
				//guardo datos del usuario inscrito
				$this->estudiante_model->saveEstudiante();

				$data["result"] = true;
				$data["idRecord"] = $idTutoria;
				$this->session->set_flashdata('retornoExito', 'Se ha inscrito a la tutoría satisfactoriamente.');
			} else {
				$data["result"] = "error";
				$data["idRecord"] = '';
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ask for help, contact the Admin.');
			}
				
			echo json_encode($data);
    }
	
	/**
	 * Confirmar inscripcion
     * @since 20/3/2019
	 */
	public function confirmar_inscripcion()
	{			
			header('Content-Type: application/json');
			
			$idTutoria = $this->input->post('hddIdTutoria');
						
			if ($this->estudiante_model->updateNuevoInscritoTutoria()) 
			{
				//guardo datos del usuario inscrito
				$this->estudiante_model->saveEstudiante();

				$data["result"] = true;
				$data["idRecord"] = $idTutoria;
				$this->session->set_flashdata('retornoExito', 'Se guardó la información');
			} else {
				$data["result"] = "error";
				$data["idRecord"] = '';
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ask for help, contact the Admin.');
			}
				
			echo json_encode($data);
    }
	
	/**
	 * Lista de temas para una asignatura
     * @since 20/3/2019
     * @author BMOTTAG
	 */
    public function temaList() 
	{
        header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
        $asignatura = $this->input->post('asignatura');
		
		//tema list
		$arrParam = array("idAsignatura" => $asignatura);
		$lista = $this->general_model->get_temas($arrParam);//lista de temas

        echo "<option value=''>Select...</option>";
        if ($lista) {
            foreach ($lista as $fila) {
                echo "<option value='" . $fila["id_param_temas"] . "' >" . $fila["temas"] . "</option>";
            }
        }
    }
	
	/**
	 * Listado de tutorias en la que se encuentra inscrito
     * @since 20/3/2019
     * @author BMOTTAG
	 */
	public function registros()
	{						
			$data['info'] = $this->general_model->get_tutorias_inscritos();
						
			$data["view"] = 'listado_tutorias_inscrito';
			$this->load->view("layout", $data);			
	}	
	
	/**
	 * Reportar inasistencia
	 */
	public function reportar_inasistencia()
	{			
			header('Content-Type: application/json');
			$data = array();
			
			$idEstudiante = $this->session->userdata("id");
			$idTutoria = $this->input->post('identificador');
			if ($this->estudiante_model->updateTutoriaInasistencia($idTutoria, $idEstudiante)) 
			{
				$data["result"] = true;
				$this->session->set_flashdata('retornoExito', 'Se reportó la inasistencia del profesor.');
			} else {
				$data["result"] = "error";
				$data["mensaje"] = "Error!!! Contactarse con el Administrador.";
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el Administrador.');
			}				

			echo json_encode($data);
    }
	
	/**
	 * Cancelar inscricion
	 * Se debe actualizar tabla de TUTORIAS_PRINCIPAL, actualizar el estado y la cantidad de inscritos
	 * eliminar el registro de la tabla TUTORIAS_ESTUDIANTE
	 * aumentar el numero de cancelaciones en la tabla ESTUDIANTE_CANCELACIONES
     * @since 21/3/2019
	 */
	public function cancelar_inscripcion()
	{			
			header('Content-Type: application/json');
			$data = array();
			
			$idEstudiante = $this->session->userdata("id");
			$idTutoria = $this->input->post('identificador');

			//busco numero de inscritos a la tutoria para restarle uno
			$arrParam = array(
							"idTutoria" => $idTutoria
						);
			$info = $this->general_model->get_tutorias($arrParam);
			
			$numeroInscritos = $info[0]['numero_inscritos'] - 1;
			
			if ($this->estudiante_model->updateTutoriaCancelacion($idTutoria, $numeroInscritos)) 
			{
				//elimino el resgistro de inscripcion del estudiante
				$this->estudiante_model->deleteInscripcionEstudiante($idTutoria, $idEstudiante);

				//aumentar en 1 el numero de cancelaciones del estudiante para el periodo activo
				$resultado = $this->update_numero_cancelaciones();
				
								
				$data["result"] = true;
				$this->session->set_flashdata('retornoExito', 'Se canceló la inscripción de una Tutoría.');
			} else {
				$data["result"] = "error";
				$data["mensaje"] = "Error!!! Contactarse con el Administrador.";
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el Administrador.');
			}				

			echo json_encode($data);
    }
	
	/**
	 * aumentar en 1 el numero de cancelaciones del estudiante para el periodo activo
     * @since 25/12/2018
     * @author BMOTTAG
	 */
	public function update_numero_cancelaciones()
	{
		//informacion periodo para saber el id del periodo
		$arrParam = array("idEstado" => 1);
		$data['PERIODOS'] = $this->general_model->get_periodos($arrParam);
		
		$idEstudiante = $this->session->userdata("id");
		$idPeriodo = $data['PERIODOS'][0]['id_param_periodos'];
		//busco informacion en la tabla ESTUDIANTE_CANCELACIONES si existe registro
		$arrParam = array("idEstudiante" => $idEstudiante, "idPeriodo" => $idPeriodo);
		$infoEstudiante = $this->general_model->get_cancelaciones_estudiante($arrParam);		
		
		if($infoEstudiante)
		{
			//aumentar en 1 el numero de cancelaciones del estudiante para el periodo activo
			$numeroCancelaciones = $infoEstudiante[0]['numero_cancelaciones'] + 1;
			
			$arrParam = array(
						"idEstudianteCancelaciones" => $infoEstudiante[0]['id_estudiante_cancelaciones'], 
						"numeroCancelaciones" => $numeroCancelaciones
						);
		}else{
			
			$arrParam = array(
						"idEstudianteCancelaciones" => '', 
						"idEstudiante" => $idEstudiante, 
						"idPeriodo" => $idPeriodo,
						"numeroCancelaciones" => 1
						);
		}
		
		$this->estudiante_model->updateNumeroCancelaciones($arrParam);	


		return true;
	}
	
	/**
	 * Guardar tutoria
     * @since 23/3/2019
	 */
	public function guardar_calificacion()
	{			
			header('Content-Type: application/json');
			
			$idTutoriaPrincipal = $this->input->post('hddIdTutoriaPrincipal');
			$hddAsistencia = $this->input->post('hddAsistencia');

			if ($idTutoria = $this->estudiante_model->guardarCalificacion()) 
			{				
				//consulto si todos los estudiantes que asistieron hicieron la calificacion del docente
				//si es asi y el docente realizo la asistencia entonces coloco la tutoria como cerrada
				$arrParam = array(
								"idTutoria" => $idTutoriaPrincipal, 
								"asistencia" => 1,
								"calificacion" => true 
								);
				$infoInscritosCalificaron = $this->general_model->get_inscritos_tutoria($arrParam);
				
				$arrParam = array(
								"idTutoria" => $idTutoriaPrincipal, 
								"asistencia" => 1
								);
				$infoInscritosAsistieron = $this->general_model->get_inscritos_tutoria($arrParam);
				
				if(count($infoInscritosCalificaron) == count($infoInscritosAsistieron) && $hddAsistencia == 1){
					//actulizo el estado de la tutoria a cerrada y actualizo el campo de observacion
					$this->estudiante_model->updateTutoriaCerrar();
				}
		
		
		
				$data["result"] = true;
				$this->session->set_flashdata('retornoExito', 'Se guardó la calificación');
			} else {
				$data["result"] = "error";
				$data["idRecord"] = '';
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ask for help, contact the Admin.');
			}

			echo json_encode($data);
    }
	
	
}
