<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Docente_model extends CI_Model {

		
		/**
		 * Actualizar datos de la tutoria, se cierrar tutoria
		 * @since 27/3/2019
		 */
		public function updateTutoriaObservacion() 
		{				
				$idTutoria = $this->input->post('hddIdTutoriaPrincipal');
		
				$data = array(
					'observaciones' => $this->input->post('observaciones'),
					'asistencia' => 1
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