<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
    public function __construct() {
        parent::__construct();
		$this->load->model("dashboard_model");
		$this->load->model("general_model");
		$this->load->helper('form');
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

			//listado escuelas
			$arrParam = array(
				"table" => "escuela",
				"order" => "NOMBRE_ESCUELA",
				"id" => "x"
			);
			$data['ESCUELA'] = $this->general_model->get_basic_search($arrParam);

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
				if($this->input->post('DocenteId')){
					$docente = $this->input->post('DocenteId');
				}else{
					$docente = '';
				}
				
				if($this->input->post('SedeId')){
					$sede = $this->input->post('SedeId');
				}else{
					$sede = '';
				}

				if($this->input->post('EscuelaId')){
					$escuela = $this->input->post('EscuelaId');
				}else{
					$escuela = '';
				}

				if($this->input->post('AsignaturaId')){
					$asignaturas = $this->input->post('AsignaturaId');
				}else{
					$asignaturas = '';
				}
				
				$arrParam = array(
								"idSede" => $sede,
								"idEscuela" => $escuela,
								"idDocente" => $docente,
								"idAsignatura" => $this->input->post('AsignaturaId'),
								"Estado" => $this->input->post('Estado'),
								"fechaInicio" => $this->input->post('fechaInicio'),
								"fechaFin" => $this->input->post('fechaFin'),
							);
				$data['infoTutorias'] = $this->general_model->get_tutorias($arrParam);
			}
			
			$data["view"] = 'form_busqueda_admin';
			$this->load->view("layout", $data);			
	}		
	
	
}