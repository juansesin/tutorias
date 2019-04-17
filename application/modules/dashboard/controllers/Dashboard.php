<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
    public function __construct() {
        parent::__construct();
		$this->load->model("dashboard_model");
		$this->load->model("general_model");
    }

	/**
	 * Buscar. Listado de tutorias para el perido vigente
     * @since 15/3/2019
     * @author BMOTTAG
	 */
	public function index()
	{			
			$data['information'] = FALSE;
			
			//informacion periodo
			$arrParam = array("idEstado" => 1);
			$data['PERIODOS'] = $this->general_model->get_periodos($arrParam);
			
			//listado sedes
			$arrParam = array(
				"table" => "sede",
				"order" => "NOMBRE_SEDE",
				"id" => "x"
			);
			$data['SEDE'] = $this->general_model->get_basic_search($arrParam);
									
			$arrParamFiltro = array(
				"idHoraInicio" => $data['PERIODOS'][0]['horario_minimo'],
				"idHoraFinal" => $data['PERIODOS'][0]['horario_maximo']
			);
			$data['horas'] = $this->general_model->get_horas($arrParamFiltro);//LISTA DE HORAS

			//listado de tutorias principales
			$arrParam = array();
			$data['infoTutorias'] = $this->general_model->get_tutorias($arrParam);
				
			//Si envian los datos del filtro entonces muestro tutorias
			if($_POST)
			{
				if($this->input->post('Docente')){
					$docente = $this->input->post('Docente');
				}else{
					$docente = '';
				}
				
				if($this->input->post('Asignaturas')){
					$asignaturas = $this->input->post('Asignaturas');
				}else{
					$asignaturas = '';
				}
				
				$arrParam = array(
								"idSede" => $this->input->post('Sede'),
								"idEscuela" => $this->input->post('Escuela'),
								"idDocente" => $docente,
								"idAsignatura" => $asignaturas,
								"Estado" => $this->input->post('Estado')
							);
				$data['infoTutorias'] = $this->general_model->get_tutorias($arrParam);
			}
			
			$data["view"] = 'form_busqueda_admin';
			$this->load->view("layout", $data);			
	}		
	
	
}