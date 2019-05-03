<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Parametros_model extends CI_Model {

		/**
		 * Add/Edit Escuela por sede
		 * @since 26/4/2019
		 * @author SDD
		 */
		public function saveEscuelaSede() 
		{
				$idEscuelaSede = $this->input->post('hddId');
				
				$data = array(
					'ID_SEDE' => $this->input->post('sede'),
					'ID_ESCUELA' => $this->input->post('escuela')
				);
				
				//revisar si es para adicionar o editar
				if ($idEscuelaSede == '') {
					$query = $this->db->insert('escuelasede', $data);
					$idEscuelaSede = $this->db->insert_id();				
				} else {
					$this->db->where('ID_ESCUELAS_X_SEDE', $idEscuelaSede);
					$query = $this->db->update('escuelasede', $data);
				}
				if ($query) {
					return $idEscuelaSede;
				} else {
					return false;
				}
		}
		
		/**
		 * Edit Escuela de un docente
		 * @since 25/4/2019
		 * @author SDD
		 */
		public function saveDocente() 
		{
				$idDocente = $this->input->post('hddId');
				
				$data = array(
					'ID_ESCUELA' => $this->input->post('escuela')
				);
				
				//revisar si es para adicionar o editar
				if ($idDocente != '') {
					$this->db->where('ID_DOCENTE', $idDocente);
					$query = $this->db->update('docente', $data);
				}
				if ($query) {
					return $id;
				} else {
					return false;
				}
		}

	    /**
		 * Add/Edit Escuela
		 * @since 25/4/2019
		 * @author SDD
		 */
		public function saveEscuela() 
		{
				$idEscuela = $this->input->post('hddId');
				
				$data = array(
					'NOMBRE_ESCUELA' => $this->input->post('escuela')
				);
				
				//revisar si es para adicionar o editar
				if ($idEscuela == '') {
					$query = $this->db->insert('escuela', $data);
					$idEscuela = $this->db->insert_id();				
				} else {
					$this->db->where('ID_ESCUELA', $idEscuela);
					$query = $this->db->update('escuela', $data);
				}
				if ($query) {
					return $idEscuela;
				} else {
					return false;
				}
		}

		/**
		 * Add/Edit Sede
		 * @since 25/4/2019
		 * @author SDD
		 */
		public function saveSede() 
		{
				$idSede = $this->input->post('hddId');
				
				$data = array(
					'NOMBRE_SEDE' => $this->input->post('sede')
				);
				
				//revisar si es para adicionar o editar
				if ($idSede == '') {
					$query = $this->db->insert('sede', $data);
					$idSede = $this->db->insert_id();				
				} else {
					$this->db->where('ID_SEDE', $idSede);
					$query = $this->db->update('sede', $data);
				}
				if ($query) {
					return $idSede;
				} else {
					return false;
				}
		}

		/**
		 * Add/Edit Usurio
		 * @since 12/3/2019
		 */
		public function saveUsuario() 
		{
				$idUsuario = $this->input->post('hddId');
				
				$data = array(
					'log_user' => $this->input->post('usuario'),
					'last_name' => $this->input->post('last_name'),
					'first_name' => $this->input->post('first_name'),
					'movil' => $this->input->post('movil'),
					'state' => $this->input->post('state'),
					'email' => $this->input->post('email'),
					'perfil' => $this->input->post('perfil')
				);
				
				//revisar si es para adicionar o editar
				if ($idUsuario == '') {
					$query = $this->db->insert('user', $data);
					$idUsuario = $this->db->insert_id();				
				} else {
					$this->db->where('id_user', $idUsuario);
					$query = $this->db->update('user', $data);
				}
				if ($query) {
					return $idUsuario;
				} else {
					return false;
				}
		}

		/**
		 * Add/Edit LUGARES
		 * @since 12/3/2019
		 */
		public function saveLugar() 
		{
				$idLugar = $this->input->post('hddId');
				
				$data = array(
					'fk_sede' => $this->input->post('sede'),
					'direccion' => $this->input->post('direccion')
				);
				
				//revisar si es para adicionar o editar
				if ($idLugar == '') {
					$query = $this->db->insert('param_lugares', $data);
					$idLugar = $this->db->insert_id();				
				} else {
					$this->db->where('id_param_lugares', $idLugar);
					$query = $this->db->update('param_lugares', $data);
				}
				if ($query) {
					return $idLugar;
				} else {
					return false;
				}
		}
		
		/**
		 * Add/Edit PROGRAMAS
		 * @since 12/3/2019
		 */
		public function savePrograma() 
		{
				$idPrograma = $this->input->post('hddId');
				
				$data = array(
					'fk_escuela' => $this->input->post('escuela'),
					'programa' => $this->input->post('programa')
				);
				
				//revisar si es para adicionar o editar
				if ($idPrograma == '') {
					$query = $this->db->insert('param_programas', $data);
					$idPrograma = $this->db->insert_id();				
				} else {
					$this->db->where('id_param_programas', $idPrograma);
					$query = $this->db->update('param_programas', $data);
				}
				if ($query) {
					return $idPrograma;
				} else {
					return false;
				}
		}
		
		/**
		 * Add/Edit ASIGNATURAS
		 * @since 12/3/2019
		 */
		public function saveAsignatura() 
		{
				$idAsignatura = $this->input->post('hddId');
				
				$data = array(
					'fk_id_param_programas' => $this->input->post('programa'),
					'asignaturas' => $this->input->post('asignatura')
				);
				
				//revisar si es para adicionar o editar
				if ($idAsignatura == '') {
					$query = $this->db->insert('param_asignaturas', $data);
					$idAsignatura = $this->db->insert_id();				
				} else {
					$this->db->where('id_param_asignaturas', $idAsignatura);
					$query = $this->db->update('param_asignaturas', $data);
				}
				if ($query) {
					return $idAsignatura;
				} else {
					return false;
				}
		}

		/**
		 * Add/Edit TEMAS
		 * @since 12/3/2019
		 */
		public function saveTema() 
		{
				$idTema = $this->input->post('hddId');
				
				$data = array(
					'fk_id_param_asignaturas' => $this->input->post('asignatura'),
					'temas' => $this->input->post('tema')
				);
				
				//revisar si es para adicionar o editar
				if ($idTema == '') {
					$query = $this->db->insert('param_temas', $data);
					$idTema = $this->db->insert_id();				
				} else {
					$this->db->where('id_param_temas', $idTema);
					$query = $this->db->update('param_temas', $data);
				}
				if ($query) {
					return $idTema;
				} else {
					return false;
				}
		}
		
		/**
		 * Add/Edit PERIODOS
		 * @since 13/3/2019
		 */
		public function savePeriodo() 
		{
				$idTema = $this->input->post('hddId');
				$fechaInicio = date_create($this->input->post('inicio_periodo'));
				$fechaFin = date_create($this->input->post('fin_periodo'));

				$inicio_periodo = date_format($fechaInicio, 'Y-m-d');
				$fin_periodo = date_format($fechaFin, 'Y-m-d');
				
				$data = array(
					'nombre_periodo' => $this->input->post('periodo'),
					'inicio_periodo' => $inicio_periodo,
					'fin_periodo' => $fin_periodo,
					'estado' => $this->input->post('estado'),
					'tutorias_dias' => $this->input->post('tutorias_dias'),
					'tutorias_semana' => $this->input->post('tutorias_semana'),
					'cancelaciones' => $this->input->post('cancelaciones'),
					'tiempo_cancelacion' => $this->input->post('tiempo_cancelacion'),
					'horario_minimo' => $this->input->post('horario_minimo'),
					'horario_maximo' => $this->input->post('horario_maximo'),
					'lunes' => $this->input->post('lunes'),
					'martes' => $this->input->post('martes'),
					'miercoles' => $this->input->post('miercoles'),
					'jueves' => $this->input->post('jueves'),
					'viernes' => $this->input->post('viernes'),
					'sabado' => $this->input->post('sabado')
				);
				
				//revisar si es para adicionar o editar
				if ($idTema == '') {
					$query = $this->db->insert('param_periodos', $data);
					$idTema = $this->db->insert_id();				
				} else {
					$this->db->where('id_param_periodos', $idTema);
					$query = $this->db->update('param_periodos', $data);
				}
				if ($query) {
					return $idTema;
				} else {
					return false;
				}
		}


	
		
	    
	}
