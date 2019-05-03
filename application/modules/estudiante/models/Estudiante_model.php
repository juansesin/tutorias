<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Estudiante_model extends CI_Model {

		/**
		 * Actualizar datos de la auditoria con la asignatura, tema seleccionados y estado
		 * @since 12/3/2019
		 */
		public function updateTutoria() 
		{
				$idTutoria = $this->input->post('hddIdTutoria');
				
				$data = array(
					'estado_tutoria' => 2,
					'fk_tp_id_param_asignaturas' => $this->input->post('asignatura'),
					'fk_tp_id_param_temas' => $this->input->post('tema'),
					'numero_inscritos' => 1
				);
				
				$this->db->where('id_tutorias_principal', $idTutoria);
				$query = $this->db->update('tutorias_principal', $data);
			
				if ($query) {
					return true;
				} else {
					return false;
				}
		}
		
		/**
		 * Add/Edit ESTUDIANTES A UNA TUTORIA
		 * @since 20/3/2019
		 */
		public function saveEstudiante() 
		{				
				$idUser = $this->session->userdata("id");
				
				$data = array(
					'fk_te_id_user' => $idUser,
					'fk_te_id_tutorias_principal' => $this->input->post('hddIdTutoria')
				);
				

				$query = $this->db->insert('tutorias_estudiante', $data);

				if ($query) {
					return true;
				} else {
					return false;
				}
		}
		
		/**
		 * Actualizar datos de la tutoria con nuevo inscrito
		 * @since 20/3/2019
		 */
		public function updateNuevoInscritoTutoria() 
		{
				$idTutoria = $this->input->post('hddIdTutoria');
				$numeroInscrito = $this->input->post('hddNumeroInscritos');
				
				$numeroInscritos = $numeroInscrito + 1;
								
				$data = array(
					'numero_inscritos' => $numeroInscritos
				);
				
				$this->db->where('id_tutorias_principal', $idTutoria);
				$query = $this->db->update('tutorias_principal', $data);
			
				if ($query) {
					return true;
				} else {
					return false;
				}
		}
		
		/**
		 * Reportar inasistencia del docente
		 * @since 12/3/2019
		 */
		public function updateTutoriaInasistencia($idTutoria) 
		{				
				$data = array(
					'asistencia_docente' => false
				);
				$idEstudiante = $this->session->userdata("id");	
				$this->db->where('fk_te_id_tutorias_principal', $idTutoria);
				$this->db->where('fk_te_id_user', $idEstudiante);
				$query = $this->db->update('tutorias_estudiante', $data);
			
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
		public function updateTutoriaCancelacion($idTutoria, $numeroInscritos) 
		{				
				$data = array(
					'numero_inscritos' => $numeroInscritos
				);
				
				$this->db->where('id_tutorias_principal', $idTutoria);
				$query = $this->db->update('tutorias_principal', $data);
			
				if ($query) {
					return true;
				} else {
					return false;
				}
		}
		
		/**
		 * Delete inscripcion estudiante
		 * @since 21/3/2019
		 */
		public function deleteInscripcionEstudiante($idTutoria, $idEstudiante) 
		{
			//$query = $this->db->delete("tutorias_estudiante", array("fk_te_id_user" => $idEstudiante, "fk_te_id_tutorias_principal" => $idTutoria));
			$data = array(
				'estado' => 0
			);
			$this->db->where('fk_te_id_user', $idEstudiante);
			$this->db->where('fk_te_id_tutorias_principal', $idTutoria);
			$query = $this->db->update('tutorias_estudiante', $data);

			if ($query) {
				return true;
			} else {
				return false;
			}
		}
		
		/**
		 * Add/Edit numero de cancelaciones estudiante
		 * @since 12/3/2019
		 */
		public function updateNumeroCancelaciones($arrData) 
		{				
				$data = array(
					'numero_cancelaciones' => $arrData["numeroCancelaciones"]
				);
				
				//revisar si es para adicionar o editar
				if ($arrData["idEstudianteCancelaciones"] == '') {
					$data['fk_ec_id_user'] = $arrData["idEstudiante"];
					$data['fk_ec_id_param_periodos'] = $arrData["idPeriodo"];
					$data['numero_fallas'] = 0;
					$query = $this->db->insert('estudiante_cancelaciones', $data);			
				} else {
					$this->db->where('id_estudiante_cancelaciones', $arrData["idEstudianteCancelaciones"]);
					$query = $this->db->update('estudiante_cancelaciones', $data);
				}
				if ($query) {
					return true;
				} else {
					return false;
				}
		}
		
		/**
		 * GUARDAR CALIFICACION
		 * @since 27/3/2019
		 */
		public function guardarCalificacion() 
		{
				$idTutoriaEstudiante = $this->input->post('hddIdTutoriaEstudiante');
				
				$data = array(
					'calificacion_texto' => $this->input->post('calificacion_texto'),
					'calificacion' => $this->input->post('calificacion'),
				);
				
				$this->db->where('id_tutorias_estudiante', $idTutoriaEstudiante);
				$query = $this->db->update('tutorias_estudiante', $data);

				if ($query) {
					return true;
				} else {
					return false;
				}
		}
		
		/**
		 * Actualizar datos de la tutoria, se cierrar tutoria
		 * @since 27/3/2019
		 */
		public function updateTutoriaCerrar() 
		{				
				$idTutoria = $this->input->post('hddIdTutoriaPrincipal');
		
				$data = array(
					'estado_tutoria' => 5
				);
				
				$this->db->where('id_tutorias_principal', $idTutoria);
				$query = $this->db->update('tutorias_principal', $data);
			
				if ($query) {
					return true;
				} else {
					return false;
				}
		}
		
		
		
	    
	}
