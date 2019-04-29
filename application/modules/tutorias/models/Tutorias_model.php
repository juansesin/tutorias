<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Tutorias_model extends CI_Model {

	    		
		/**
		 * Add/Edit TUTORIA
		 * @since 16/3/2019
		 */
		public function saveTutoria() 
		{
				$idLugar = $this->input->post('hddId');
				
				$data = array(
					'fk_id_sede' => $this->input->post('Sede'),
					'fk_id_escuela' => $this->input->post('Escuela'),
					'fk_id_docente' => $this->input->post('Docente'),
					'fk_id_lugar' => $this->input->post('Lugar'),
					'cantidad_estudiantes' => $this->input->post('max_estudiante'),
					'tutoria_lunes' => $this->input->post('lunes'),
					'tutoria_martes' => $this->input->post('martes'),
					'tutoria_miercoles' => $this->input->post('miercoles'),
					'tutoria_jueves' => $this->input->post('jueves'),
					'tutoria_viernes' => $this->input->post('viernes'),
					'tutoria_sabado' => $this->input->post('sabado'),
					'lunes_inicio' => $this->input->post('horario_minimo_lunes'),
					'lunes_fin' => $this->input->post('horario_maximo_lunes'),
					'martes_inicio' => $this->input->post('horario_minimo_martes'),
					'martes_fin' => $this->input->post('horario_maximo_martes'),
					'miercoles_inicio' => $this->input->post('horario_minimo_miercoles'),
					'miercoles_fin' => $this->input->post('horario_maximo_miercoles'),
					'jueves_inicio' => $this->input->post('horario_minimo_jueves'),
					'jueves_fin' => $this->input->post('horario_maximo_jueves'),
					'viernes_inicio' => $this->input->post('horario_minimo_viernes'),
					'viernes_fin' => $this->input->post('horario_maximo_viernes'),
					'sabado_inicio' => $this->input->post('horario_minimo_sabado'),
					'sabado_fin' => $this->input->post('horario_maximo_sabado')
				);
				

				$query = $this->db->insert('tutorias_base', $data);
				$idTutoria = $this->db->insert_id();				

				if ($query) {
					return $idTutoria;
				} else {
					return false;
//"Error: " .  $this->db->_error_message();
				}
		}
		
		/**
		 * Add/Edit TUTORIA
		 * @since 16/3/2019
		 */
		public function saveTutoriaPrincipal($idTutoria, $fecha, $horaInicio, $horaFin) 
		{
				
				$data = array(
					'fk_id_tutorias_base' => $idTutoria,
					'fk_id_sede' => $this->input->post('Sede'),
					'fk_id_escuela' => $this->input->post('Escuela'),
					'fk_id_docente' => $this->input->post('Docente'),
					'fk_id_lugar' => $this->input->post('Lugar'),
					'fecha_tutoria' => $fecha,
					'cantidad_estudiantes' => $this->input->post('max_estudiante'),
					'hora_inicio' => $horaInicio,
					'hora_fin' => $horaFin
				);
				

				$query = $this->db->insert('tutorias_principal', $data);

				if ($query) {
					return true;
				} else {
					return false;
				}
		}
		
		/**
		 * Add/Edit AIGNATURAS DE LA TUTORIA
		 * @since 19/3/2019
		 */
		public function saveTutoriaAsignaturas($idTutoria, $asignatura) 
		{
				
				$data = array(
					'fk_ta_tutoria_base' => $idTutoria,
					'fk_ta_param_asignaturas' => $asignatura
				);
				
				$query = $this->db->insert('tutorias_asignaturas', $data);	

				if ($query) {
					return true;
				} else {
					return false;
				}
		}
		
		/**
		 * UPDATE TUTORIA
		 * @since 23/3/2019
		 */
		public function updateTutoria() 
		{
				$idTutoriaPrincipal = $this->input->post('hddIdTutoriaPrincipal');
				
				$data = array(
					'fk_id_docente' => $this->input->post('Docente'),
					'fk_id_lugar' => $this->input->post('Lugar'),
					'fecha_tutoria' => $this->input->post('fecha'),
					'hora_inicio' => $this->input->post('horarioInicio'),
					'hora_fin' => $this->input->post('horarioFin')
				);
				
				$this->db->where('id_tutorias_principal', $idTutoriaPrincipal);
				$query = $this->db->update('tutorias_principal', $data);

				if ($query) {
					return true;
				} else {
					return false;
				}
		}
		
		/**
		 * Actualizar datos de la tutoria, se cancela un estudiante
		 * @since 12/3/2019
		 */
		public function updateTutoriaCancelar($idTutoria,$idMotivoCancelacion) 
		{				
				//$idTutoria = $this->input->post('identificador');
		
				$data = array(
					'estado_tutoria' => 4,
					'fk_id_motivo_cancelacion' => $idMotivoCancelacion
				);
				
				$this->db->where('id_tutorias_principal', $idTutoria);
				$query = $this->db->update('tutorias_principal', $data);
		//die(print_r($this->db->last_query()));	
				if ($query) {
					return true;
				} else {
					return false;
				}
		}
		

		


		


	
		
	    
	}
