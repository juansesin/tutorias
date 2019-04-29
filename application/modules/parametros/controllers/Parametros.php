<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parametros extends CI_Controller {
	
    public function __construct() {
        parent::__construct();
        $this->load->model("parametros_model");
		$this->load->model("general_model");
		$this->load->helper('form');
    }
		
	/**
	 * Lista de lugares
     * @since 12/3/2019
     * @author BMOTTAG
	 */
	public function lugares()
	{			
			$arrParam = array();
			$data['info'] = $this->general_model->get_lugares($arrParam);

			$data["view"] = 'lugares';
			$this->load->view("layout", $data);
	}
	
    /**
     * Cargo modal - formulario lugares
     * @since 12/3/2019
     */
    public function cargarModalLugar() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
			
			$data['information'] = FALSE;
			$data["idLugar"] = $this->input->post("idLugar");	
			
			$arrParam = array(
				"table" => "sede",
				"order" => "NOMBRE_SEDE",
				"id" => "x"
			);
			$data['SEDE'] = $this->general_model->get_basic_search($arrParam);//programas list
			
			if ($data["idLugar"] != 'x') {
				$arrParam = array("idLugar" => $data["idLugar"]);
				$data['information'] = $this->general_model->get_lugares($arrParam);
			}
			
			$this->load->view("lugares_modal", $data);
    }
	
	/**
	 * Update lugar
     * @since 12/3/2019
     * @author BMOTTAG
	 */
	public function save_lugar()
	{			
			header('Content-Type: application/json');
			$data = array();
			
			$idLugar = $this->input->post('hddId');
			
			$msj = "Se adicionó un nuevo Lugar";
			if ($idLugar != '') {
				$msj = "Se editó un Lugar";
			}

			if ($idLugar = $this->parametros_model->saveLugar()) {
				$data["result"] = true;
				$data["idRecord"] = $idLugar;
				
				$this->session->set_flashdata('retornoExito', $msj);
			} else {
				$data["result"] = "error";
				$data["idRecord"] = "";
				
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ask for help');
			}

			echo json_encode($data);
    }
	
	/**
	 * Lista de programas
     * @since 12/3/2019
     * @author BMOTTAG
	 */
	public function programas()
	{
			$arrParam = array();
			$data['info'] = $this->general_model->get_programas($arrParam);
			
			$data["view"] = 'programas';
			$this->load->view("layout", $data);
	}
	
    /**
     * Cargo modal - formulario programas
     * @since 12/3/2019
     */
    public function cargarModalPrograma() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
			
			$data['information'] = FALSE;
			$data["idPrograma"] = $this->input->post("idPrograma");	
			
			$arrParam = array(
				"table" => "escuela",
				"order" => "NOMBRE_ESCUELA",
				"id" => "x"
			);
			$data['ESCUELA'] = $this->general_model->get_basic_search($arrParam);//ESCUELA list
			
			if ($data["idPrograma"] != 'x') {
				$this->load->model("general_model");
				$arrParam = array(
					"table" => "param_programas",
					"order" => "id_param_programas",
					"column" => "id_param_programas",
					"id" => $data["idPrograma"]
				);
				$data['information'] = $this->general_model->get_basic_search($arrParam);
			}
			
			$this->load->view("programas_modal", $data);
    }
	
	/**
	 * Update programas
     * @since 12/3/2019
     * @author BMOTTAG
	 */
	public function save_programa()
	{			
			header('Content-Type: application/json');
			$data = array();

			$idPrograma = $this->input->post('hddId');
			
			$msj = "Se adicionó un nuevo Programa";
			if ($idPrograma != '') {
				$msj = "Se editó un Programa";
			}

			if ($idPrograma = $this->parametros_model->savePrograma()) {
				$data["result"] = true;
				$data["idRecord"] = $idPrograma;
				
				$this->session->set_flashdata('retornoExito', $msj);
			} else {
				$data["result"] = "error";
				$data["idRecord"] = "";
				
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ask for help');
			}

			echo json_encode($data);
    }
	
	/**
	 * Lista de asignaturas
     * @since 12/3/2019
     * @author BMOTTAG
	 */
	public function asignaturas()
	{
			$this->load->model("general_model");
			$arrParam = array();
			$data['info'] = $this->general_model->get_asignaturas($arrParam);
			
			$data["view"] = 'asignaturas';
			$this->load->view("layout", $data);
	}
	
    /**
     * Cargo modal - formulario asignaturas
     * @since 12/3/2019
     */
    public function cargarModalAsignatura() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
			
			$data['information'] = FALSE;
			$data["idAsignatura"] = $this->input->post("idAsignatura");	
			
			$arrParam = array(
				"table" => "param_programas",
				"order" => "programa",
				"id" => "x"
			);
			$data['programa'] = $this->general_model->get_basic_search($arrParam);//programas list
			
			if ($data["idAsignatura"] != 'x') {
				$arrParam = array("idAsignatura" => $data["idAsignatura"]);
				$data['information'] = $this->general_model->get_asignaturas($arrParam);
			}
			
			$this->load->view("asignaturas_modal", $data);
    }
	
	/**
	 * Update asignatura
     * @since 12/3/2019
     * @author BMOTTAG
	 */
	public function save_asignatura()
	{			
			header('Content-Type: application/json');
			$data = array();

			$idAsignatura = $this->input->post('hddId');
			
			$msj = "Se adicionó una nueva Asignatura";
			if ($idAsignatura != '') {
				$msj = "Se editó una Asignatura";
			}

			if ($idAsignatura = $this->parametros_model->saveAsignatura()) {
				$data["result"] = true;
				$data["idRecord"] = $idAsignatura;
				
				$this->session->set_flashdata('retornoExito', $msj);
			} else {
				$data["result"] = "error";
				$data["idRecord"] = "";
				
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ask for help');
			}

			echo json_encode($data);
    }
	
	/**
	 * Lista de temas
     * @since 12/3/2019
     * @author BMOTTAG
	 */
	public function temas()
	{
			$this->load->model("general_model");
			$arrParam = array();
			$data['info'] = $this->general_model->get_temas($arrParam);
			
			$data["view"] = 'temas';
			$this->load->view("layout", $data);
	}
	
    /**
     * Cargo modal - formulario temas
     * @since 12/3/2019
     */
    public function cargarModalTema() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
			
			$data['information'] = FALSE;
			$data["idTema"] = $this->input->post("idTema");	
			
				$arrParam = array(
				"table" => "param_asignaturas",
				"order" => "asignaturas",
				"id" => "x"
			);
			$data['asignatura'] = $this->general_model->get_basic_search($arrParam);//asignaturas list
			
			if ($data["idTema"] != 'x') {
				$arrParam = array("idTema" => $data["idTema"]);
				$data['information'] = $this->general_model->get_temas($arrParam);
			}
			
			$this->load->view("temas_modal", $data);
    }
	
	/**
	 * Update tema
     * @since 12/3/2019
     * @author BMOTTAG
	 */
	public function save_tema()
	{			
			header('Content-Type: application/json');
			$data = array();

			$idTema = $this->input->post('hddId');
			
			$msj = "Se adicionó un nuevo Tema";
			if ($idTema != '') {
				$msj = "Se editó un Tema";
			}

			if ($idTema = $this->parametros_model->saveTema()) {
				$data["result"] = true;
				$data["idRecord"] = $idTema;
				
				$this->session->set_flashdata('retornoExito', $msj);
			} else {
				$data["result"] = "error";
				$data["idRecord"] = "";
				
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ask for help');
			}

			echo json_encode($data);
    }
	
	/**
	 * Lista de periodos
     * @since 13/3/2019
     * @author BMOTTAG
	 */
	public function periodos()
	{
			$this->load->model("general_model");
			$arrParam = array();
			$data['info'] = $this->general_model->get_periodos($arrParam);
			
			$data["view"] = 'periodos';
			$this->load->view("layout", $data);
	}

    /**
     * Cargo modal - formulario periodos
     * @since 13/3/2019
     */
    public function cargarModalPeriodos() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
			
			$data['information'] = FALSE;
			$data["idPeriodo"] = $this->input->post("idPeriodo");	
			
			$arrParamFiltro = array(
				"idHoraInicio" => 9,
				"idHoraFinal" => 19
			);
			$data['horas'] = $this->general_model->get_horas($arrParamFiltro);//LISTA DE HORAS
						
			if ($data["idPeriodo"] != 'x') {
				$arrParam = array("idPeriodo" => $data["idPeriodo"]);
				$data['information'] = $this->general_model->get_periodos($arrParam);
			}
			
			$this->load->view("periodos_modal", $data);
    }
	
	/**
	 * Update periodos
     * @since 13/3/2019
     * @author BMOTTAG
	 */
	public function save_periodo()
	{			
			header('Content-Type: application/json');
			$data = array();

			$idPeriodo = $this->input->post('hddId');
			
			$msj = "Se adicionó un nuevo Periodo";
			if ($idPeriodo != '') {
				$msj = "Se editó un Periodo";
			}

			if ($idPeriodo = $this->parametros_model->savePeriodo()) {
				$data["result"] = true;
				$data["idRecord"] = $idPeriodo;
				
				$this->session->set_flashdata('retornoExito', $msj);
			} else {
				$data["result"] = "error";
				$data["idRecord"] = "";
				
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ask for help');
			}

			echo json_encode($data);
    }

    /**
	 * Lista de usuarios
     * @since 17/4/2019
     * @author JSJL
	 */
	public function usuarios()
	{
			$this->load->model("general_model");
			$arrParam = array();
			$data['info'] = $this->general_model->get_usuarios($arrParam);
			
			$data["view"] = 'usuarios';
			$this->load->view("layout", $data);
	}
	
    /**
     * Cargo modal - formulario usuarios
     * @since 13/3/2019
     */
    public function cargarModalUsuarios() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
			
			$data['information'] = FALSE;
			$arrParam = array("idUser" => $this->input->post("idUser"));
			$data['information'] = $this->general_model->get_usuarios($arrParam);
			$this->load->view("usuarios_modal", $data);
    }

/**
	 * Update usuarios
     * @since 12/3/2019
     * @author JSJL
	 */
	public function save_usuario()
	{			
			header('Content-Type: application/json');
			$data = array();
			
			$idUsuario = $this->input->post('hddId');
			
			$msj = "Se adicionó un nuevo Usuario";
			if ($idUsuario != '') {
				$msj = "Se editó un Usuario";
			}

			if ($idUsuario = $this->parametros_model->saveUsuario()) {
				$data["result"] = true;
				$data["idRecord"] = $idUsuario;
				
				$this->session->set_flashdata('retornoExito', $msj);
			} else {
				$data["result"] = "error";
				$data["idRecord"] = "";
				
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ask for help');
			}

			echo json_encode($data);
    }

    /**
	 * Lista de sedes
     * @since 25/4/2019
     * @author SDD
	 */
	public function sede()
	{
			$this->load->model("general_model");
			$arrParam = array();
			$data['info'] = $this->general_model->get_sede($arrParam);
			
			$data["view"] = 'sede';
			$this->load->view("layout", $data);

	}
	
    /**
     * Cargo modal - formulario sede
     * @since 25/4/2019
     * @author SDD
     */
    public function cargarModalSede() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
			
			$data['information'] = FALSE;
			$arrParam = array("idSede" => $this->input->post("idSede"));
			$data['information'] = $this->general_model->get_sede($arrParam);
			$this->load->view("sede_modal", $data);
    }

/**
	 * Update sede
     * @since 25/4/2019
     * @author SDD
	 */
	public function save_sede()
	{			
			header('Content-Type: application/json');
			$data = array();
			
			$idSede = $this->input->post('hddId');
			
			$msj = "Se adicionó una nueva sede";
			if ($idSede != '') {
				$msj = "Se editó una sede";
			}

			if ($idSede = $this->parametros_model->saveSede()) {
				$data["result"] = true;
				$data["idRecord"] = $idSede;
				
				$this->session->set_flashdata('retornoExito', $msj);
			} else {
				$data["result"] = "error";
				$data["idRecord"] = "";
				
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ask for help');
			}

			echo json_encode($data);
    }

/**
	 * Lista de escuelas
     * @since 25/4/2019
     * @author SDD
	 */
	public function escuela()
	{
			$this->load->model("general_model");
			$arrParam = array();
			$data['info'] = $this->general_model->get_escuelas($arrParam);
			
			$data["view"] = 'escuela';
			$this->load->view("layout", $data);

	}
	
    /**
     * Cargo modal - formulario escuela
     * @since 25/4/2019
     * @author SDD
     */
    public function cargarModalEscuela() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
			
			$data['information'] = FALSE;
			$arrParam = array("idEscuela" => $this->input->post("idEscuela"));
			$data['information'] = $this->general_model->get_escuelas($arrParam);
			$this->load->view("escuela_modal", $data);
    }

/**
	 * Update escuela
     * @since 25/4/2019
     * @author SDD
	 */
	public function save_escuela()
	{			
			header('Content-Type: application/json');
			$data = array();
			
			$idEscuela = $this->input->post('hddId');
			
			$msj = "Se adicionó una nueva escuela";
			if ($idEscuela != '') {
				$msj = "Se editó una escuela";
			}

			if ($idEscuela = $this->parametros_model->saveEscuela()) {
				$data["result"] = true;
				$data["idRecord"] = $idEscuela;
				
				$this->session->set_flashdata('retornoExito', $msj);
			} else {
				$data["result"] = "error";
				$data["idRecord"] = "";
				
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ask for help');
			}

			echo json_encode($data);
    }   

/**
	 * Lista de docentes
     * @since 25/4/2019
     * @author SDD
	 */
	public function docente()
	{
			$this->load->model("general_model");
			$arrParam = array();
			$data['info'] = $this->general_model->get_docentes($arrParam);
			
			$data["view"] = 'docente';
			$this->load->view("layout", $data);

	}
	
    /**
     * Cargo modal - formulario docente
     * @since 25/4/2019
     * @author SDD
     */
    public function cargarModalDocente() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
			
			$data['information'] = FALSE;
			
			$arrParam = array("idDocente" => $this->input->post("idDocente"));
			$data['information'] = $this->general_model->get_docentes($arrParam);

			$arrParam = array(
				"table" => "escuela",
				"order" => "NOMBRE_ESCUELA",
				"id" => "x"
			);
			$data['ESCUELA'] = $this->general_model->get_basic_search($arrParam);//ESCUELA list
	
			$this->load->view("docente_modal", $data);
    }

/**
	 * Update escuela docente
     * @since 25/4/2019
     * @author SDD
	 */
	public function save_docente()
	{			
			header('Content-Type: application/json');
			$data = array();
			
			$idDocente = $this->input->post('hddId');
			
			$msj = "Se adicionó un docente";
			if ($idDocente != '') {
				$msj = "Se editó la escuela del docente";
			}

			if ($idDocente = $this->parametros_model->saveDocente()) {
				$data["result"] = true;
				$data["idRecord"] = $idDocente;
				
				$this->session->set_flashdata('retornoExito', $msj);
			} else {
				$data["result"] = "error";
				$data["idRecord"] = "";
				
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ask for help');
			}

			echo json_encode($data);
    }

    /**
	 * Lista de escuela y sede
     * @since 26/4/2019
     * @author SDD
	 */
	public function escuelasede()
	{
			$this->load->model("general_model");
			$arrParam = array();
			$data['info'] = $this->general_model->get_escuela_sede($arrParam);
			
			$data["view"] = 'escuelasede';
			$this->load->view("layout", $data);
	}
	
    /**
     * Cargo modal - formulario escuela y sede
     * @since 26/4/2019
     */
    public function cargarModalEscuelaSede() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
			
			$data['information'] = FALSE;
			$arrParam = array("idEscuelaSede" => $this->input->post("idEscuelaSede"));
			$data['information'] = $this->general_model->get_escuela_sede($arrParam);

			$arrParam = array(
				"table" => "escuela",
				"order" => "NOMBRE_ESCUELA",
				"id" => "x"
			);
			$data['ESCUELA'] = $this->general_model->get_basic_search($arrParam);//ESCUELA list


			$arrParam = array(
				"table" => "sede",
				"order" => "NOMBRE_SEDE",
				"id" => "x"
			);
			$data['SEDE'] = $this->general_model->get_basic_search($arrParam);//SEDE list


			$this->load->view("escuelasede_modal", $data);
    }

/**
	 * Update escuela y sede
     * @since 26/4/2019
     * @author SDD
	 */
	public function save_escuelasede()
	{			
			header('Content-Type: application/json');
			$data = array();
			
			$idEscuelaSede = $this->input->post('hddId');
			
			$msj = "Se adicionó una nueva relación";
			if ($idEscuelaSede != '') {
				$msj = "Se editó la relación seleccionada";
			}

			if ($idEscuelaSede = $this->parametros_model->saveEscuelaSede()) {
				$data["result"] = true;
				$data["idRecord"] = $idEscuelaSede;
				
				$this->session->set_flashdata('retornoExito', $msj);
			} else {
				$data["result"] = "error";
				$data["idRecord"] = "";
				
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ask for help');
			}

			echo json_encode($data);
    } 
	
}
