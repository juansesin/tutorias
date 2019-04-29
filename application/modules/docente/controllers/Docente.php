<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Docente extends CI_Controller {
	
    public function __construct() {
        parent::__construct();
		$this->load->model("docente_model");
		$this->load->model("general_model");
		$this->load->helper('form');
    }

	/**
	 * Buscar. Listado de tutorias para el perido vigente y para el docente
     * @since 27/3/2019
     * @author BMOTTAG
	 */
	public function index()
	{			
			$data['information'] = FALSE;
			
			//informacion periodo
			$arrParam = array("idEstado" => 1);
			$data['PERIODOS'] = $this->general_model->get_periodos($arrParam);

			//listado de tutorias principales
			$arrParam = array();
			$data['infoTutorias'] = $this->general_model->get_tutorias_docentes($arrParam);
				
			//Si envian los datos del filtro entonces muestro tutorias
			if($_POST)
			{				
				$arrParam = array(
								"fechaInicio" => $this->input->post('fechaInicio'),
								"fechaFin" => $this->input->post('fechaFin'),
								"Estado" => $this->input->post('Estado')
							);
				$data['infoTutorias'] = $this->general_model->get_tutorias_docentes($arrParam);
			}
			
			$data["view"] = 'form_busqueda_docente';
			$this->load->view("layout", $data);			
	}		
	
	/**
	 * Listado de inscritos a una tutoria, para confirmar la asistencia
     * @since 24/3/2019
     * @author BMOTTAG
	 */
	public function inscritos($idTutoria)
	{						
			$arrParam = array(
							"idTutoria" => $idTutoria,
							"fechaActual" => true
						);
			$data['info'] = $this->general_model->get_tutorias($arrParam);
			
			//listado de inscritos
			$arrParam = array("idTutoria" => $idTutoria);
			$data['infoInscritos'] = $this->general_model->get_inscritos_tutoria($arrParam);

			$data["view"] = 'listado_inscritos';
			$this->load->view("layout", $data);			
	}	
	
	/**
	 * Actualizar asistencia de los estudiantes
     * @since 24/3/2019
     * @author BMOTTAG
	 */
	public function update_asistencia()
	{	
			$idTutoriaPrincipal = $this->input->post('hddIdTutoriaPrincipal');
	
			if ($this->general_model->updateAsistencia()) {
				
				//consulto si todos los estudiantes que asistieron hicieron la calificacion del docente
				//si es asi entonces coloco la tutoria como cerrada
				$arrParam = array(
								"idTutoria" => $idTutoriaPrincipal, 
								"asistencia" => 1,
								"calificacion" => true 
								);
				$infoInscritosCalificaron = $this->general_model->get_inscritos_tutoria($arrParam);
				
if($infoInscritosCalificaron){
	$conteoCalificaron = count($infoInscritosCalificaron);
}else{
	$conteoCalificaron = 0;
}

				$arrParam2 = array(
								"idTutoria" => $idTutoriaPrincipal, 
								"asistencia" => 1
								);
				$infoInscritosAsistieron = $this->general_model->get_inscritos_tutoria($arrParam2);
if($infoInscritosAsistieron){
	$conteoAsistentes = count($infoInscritosAsistieron);
}else{
	$conteoAsistentes = 0;
}				
				
				
				if($conteoCalificaron == $conteoAsistentes){
					//actulizo el estado de la tutoria a cerrada y actualizo el campo de observacion
					$this->general_model->updateTutoriaCerrar();
				}
				
				//acutlizo de nuevo el campo de observacion y el campo asistencia
				$this->docente_model->updateTutoriaObservacion();
					
				$data["result"] = true;
				$this->session->set_flashdata('retornoExito', "Se guardó la Asistencia.");
			} else {
				$data["result"] = "error";
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ask for help');
			}

			redirect(base_url('docente/inscritos/' . $idTutoriaPrincipal), 'refresh');
	}

	
	
}