<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Clase para consultas generales a una tabla
 */
class General_model extends CI_Model {

    /**
     * Consulta BASICA A UNA TABLA
     * @param $TABLA: nombre de la tabla
     * @param $ORDEN: orden por el que se quiere organizar los datos
     * @param $COLUMNA: nombre de la columna en la tabla para realizar un filtro (NO ES OBLIGATORIO)
     * @param $VALOR: valor de la columna para realizar un filtro (NO ES OBLIGATORIO)
     * @since 8/11/2016
     */
    public function get_basic_search($arrData) {
        if ($arrData["id"] != 'x')
            $this->db->where($arrData["column"], $arrData["id"]);
        $this->db->order_by($arrData["order"], "ASC");
        $query = $this->db->get($arrData["table"]);
//die(print_r($this->db));
        if ($query->num_rows() >= 1) {
            return $query->result_array();
        } else
            return false;
    }
	
    /**
     * Asignaturas
     * Modules: Parametros
     * @since 12/3/2019
     */
    public function get_asignaturas($arrData) 
	{
        $this->db->select();
        $this->db->join('param_programas P', 'P.id_param_programas = A.fk_id_param_programas', 'INNER');
		
        if (array_key_exists("idAsignatura", $arrData)) {
            $this->db->where('A.id_param_asignaturas', $arrData["idAsignatura"]);
        }
        if (array_key_exists("idEscuela", $arrData)) {
            $this->db->where('P.fk_escuela', $arrData["idEscuela"]);
        }
		
		$this->db->order_by('P.programa', 'asc');
		$query = $this->db->get('param_asignaturas A');

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
	
    /**
     * Temas
     * Modules: Parametros
     * @since 12/3/2019
     */
    public function get_temas($arrData) 
	{
        $this->db->select();
        $this->db->join('param_asignaturas A', 'A.id_param_asignaturas = T.fk_id_param_asignaturas', 'INNER');
		
        if (array_key_exists("idTema", $arrData)) {
            $this->db->where('T.id_param_temas', $arrData["idTema"]);
        }
		
        if (array_key_exists("idAsignatura", $arrData)) {
            $this->db->where('T.fk_id_param_asignaturas', $arrData["idAsignatura"]);
        }
		
		$this->db->order_by('A.asignaturas', 'asc');
		$query = $this->db->get('param_temas T');

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

      /**
     * MOtivosCancelaciones
     * Modules: MOtivosCancelaciones
     * @since 13/3/2019
     */
    public function get_motivosCancelaciones($arrData) 
    {
        $this->db->select("*");
        
        $this->db->order_by('motivocancelacion', 'asc');
        $query = $this->db->get('motivocancelacion');

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }   

    /**
     * periodos
     * Modules: Parametros
     * @since 13/3/2019
     */
    public function get_periodos($arrData) 
	{
        $this->db->select("P.*, H.hora minimo, X.hora maximo");
		$this->db->join('param_horas H', 'H.id_hora = P.horario_minimo', 'INNER');
		$this->db->join('param_horas X', 'X.id_hora = P.horario_maximo', 'INNER');
		
        if (array_key_exists("idPeriodo", $arrData)) {
            $this->db->where('P.id_param_periodos', $arrData["idPeriodo"]);
        }
        if (array_key_exists("idEstado", $arrData)) {
            $this->db->where('P.estado', $arrData["idEstado"]);
        }
		
		$this->db->order_by('P.id_param_periodos', 'desc');
		$query = $this->db->get('param_periodos P');

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }	
	
		/**
		 * Lista de horas
		 * si es un usuario gestor se filtra por las horas configuradas en la tabla param generales
		 * @since 22/4/2018
		 * @review 23/4/2018
		 */
		public function get_horas($arrData) 
		{
			if (array_key_exists("idHoraInicio", $arrData)) {
				$this->db->where('id_hora >=', $arrData["idHoraInicio"]);
			}
			if (array_key_exists("idHoraFinal", $arrData)) {
				$this->db->where('id_hora <=', $arrData["idHoraFinal"]);
			}
			$this->db->order_by("id_hora", "ASC");
			$query = $this->db->get("param_horas");

			if ($query->num_rows() >= 1) {
				return $query->result_array();
			} else
				return false;
		}
		
    /**
     * Temas
     * Modules: Parametros
     * @since 15/3/2019
     */
    public function get_lugares($arrData) 
	{
        $this->db->select();
        $this->db->join('sede S', 'S.ID_SEDE = L.fk_sede', 'INNER');
		
        if (array_key_exists("idLugar", $arrData)) {
            $this->db->where('L.id_param_lugares', $arrData["idLugar"]);
        }
		
        if (array_key_exists("idSede", $arrData)) {
            $this->db->where('L.fk_sede', $arrData["idSede"]);
        }
		
		$this->db->order_by('S.NOMBRE_SEDE', 'asc');
		$query = $this->db->get('param_lugares L');

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
	
    /**
     * Temas
     * Modules: Parametros
     * @since 15/3/2019
     */
    public function get_programas($arrData) 
	{
        $this->db->select();
        $this->db->join('escuela E', 'E.ID_ESCUELA = P.fk_escuela', 'INNER');
		
        if (array_key_exists("idPrograma", $arrData)) {
            $this->db->where('P.id_param_programas', $arrData["idPrograma"]);
        }
		
        if (array_key_exists("idEscuela", $arrData)) {
            $this->db->where('P.fk_escuela', $arrData["idEscuela"]);
        }
		
		$this->db->order_by('E.NOMBRE_ESCUELA', 'asc');
		$query = $this->db->get('param_programas P');

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    /**
     * Temas
     * Modules: TUTORIAS
     * @since 15/3/2019
     */
    public function get_tutorias($arrData) 
	{
        $this->db->select("T.*, S.NOMBRE_SEDE, E.NOMBRE_ESCUELA, D.NOMBRE, L.direccion, H.hora minimo, H.formato_24 formato_minimo, X.hora maximo, X.formato_24 formato_maximo, Y.asignaturas, Z.temas");
        $this->db->join('sede S', 'S.ID_SEDE = T.fk_id_sede', 'INNER');
		$this->db->join('escuela E', 'E.ID_ESCUELA = T.fk_id_escuela', 'INNER');
		$this->db->join('docente D', 'D.ID_DOCENTE = T.fk_id_docente', 'INNER');
		$this->db->join('param_lugares L', 'L.id_param_lugares = T.fk_id_lugar', 'INNER');
		$this->db->join('param_horas H', 'H.id_hora = T.hora_inicio', 'INNER');
		$this->db->join('param_horas X', 'X.id_hora = T.hora_fin', 'INNER');
		$this->db->join('param_asignaturas Y', 'Y.id_param_asignaturas = T.fk_tp_id_param_asignaturas', 'LEFT');
		$this->db->join('param_temas Z', 'Z.id_param_temas = T.fk_tp_id_param_temas', 'LEFT');
		
        if (array_key_exists("idTutoria", $arrData)) {
            $this->db->where('T.id_tutorias_principal', $arrData["idTutoria"]);
        }
		
        if (array_key_exists("idSede", $arrData)) {
            $this->db->where('T.fk_id_sede', $arrData["idSede"]);
        }
		
		if (array_key_exists("idEscuela", $arrData) && $arrData["idEscuela"] != '') {
            $this->db->where('T.fk_id_escuela', $arrData["idEscuela"]);
        }
	       
		if (array_key_exists("idDocente", $arrData) && $arrData["idDocente"] != '') {
            $this->db->where('T.fk_id_docente', $arrData["idDocente"]);
        }
		
		if (array_key_exists("idAsignatura", $arrData) && $arrData["idAsignatura"] != '') {
            $this->db->where('T.fk_tp_id_param_asignaturas', $arrData["idAsignatura"]);
        }
		
		if (array_key_exists("Estado", $arrData) && $arrData["Estado"] != '') {
            $this->db->where('T.estado_tutoria', $arrData["Estado"]);
        }
		
		if (array_key_exists("idPrograma", $arrData) && $arrData["idPrograma"] != '') {
            $this->db->where('Y.fk_id_param_programas', $arrData["idPrograma"]);
        }
		
        if (array_key_exists("fechaActual", $arrData)) {
			$fechaActual = date('Y-m-d');
            $this->db->where('T.fecha_tutoria >=', $fechaActual);
        }
		
		$query = $this->db->get('tutorias_principal T');

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
	
    /**
     * ESCUELAS
     * Modules: TUTORIAS
     * @since 15/3/2019
     */
    public function get_escuelas($arrData) 
	{
        $this->db->select();
        $this->db->join('escuelas_x_sede S', 'S.ID_ESCUELA = E.ID_ESCUELA', 'INNER');
		
        if (array_key_exists("idSede", $arrData)) {
            $this->db->where('S.ID_SEDE', $arrData["idSede"]);
        }
		
		$query = $this->db->get('escuela E');

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
	
    /**
     * DOCENTES
     * Modules: TUTORIAS
     * @since 15/3/2019
     */
    public function get_docentes($arrData) 
	{
        $this->db->select();
		
        if (array_key_exists("idEscuela", $arrData)) {
            $this->db->where('D.ID_ESCUELA', $arrData["idEscuela"]);
        }
		
		$this->db->order_by('D.NOMBRE', 'asc');
		$query = $this->db->get('docente D');

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
	
    /**
     * Asignaturas de una tutoria
     * Modules: ESTUDIATE
     * @since 20/3/2019
     */
    public function get_asignaturas_tutoria($arrData) 
	{
        $this->db->select();
		$this->db->join('param_asignaturas X', 'X.id_param_asignaturas = A.fk_ta_param_asignaturas', 'INNER');
		
        if (array_key_exists("idTutoria", $arrData)) {
            $this->db->where('A.fk_ta_tutoria_base', $arrData["idTutoria"]);
        }
		
		$query = $this->db->get('tutorias_asignaturas A');

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
	
    /**
     * Listado estudiates de una tutoria
     * Modules: ESTUDIATE
     * @since 20/3/2019
     */
    public function get_inscritos_tutoria($arrData) 
	{
        $this->db->select();
		$this->db->join('user U', 'U.id_user = E.fk_te_id_user', 'INNER');
		
        if (array_key_exists("idTutoria", $arrData)) {
            $this->db->where('E.fk_te_id_tutorias_principal', $arrData["idTutoria"]);
        }
		
        if (array_key_exists("idEstudiante", $arrData)) {
            $this->db->where('E.fk_te_id_user', $arrData["idEstudiante"]);
        }
		
        if (array_key_exists("asistencia", $arrData)) {
            $this->db->where('E.asistencia', $arrData["asistencia"]);
        }
		
        if (array_key_exists("calificacion", $arrData)) {
            $this->db->where('E.calificacion !=', 0);
        }
		
		$query = $this->db->get('tutorias_estudiante E');

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
	
    /**
     * Temas
     * Modules: TUTORIAS
     * @since 15/3/2019
     */
    public function get_tutorias_inscritos() 
	{
		$idUser = $this->session->userdata("id");
		
        $this->db->select("T.*, D.NOMBRE, L.direccion, H.hora minimo, H.formato_24 formato_minimo, X.hora maximo, Y.asignaturas, Z.temas, W.calificacion_texto, W.calificacion, W.id_tutorias_estudiante");
        $this->db->join('tutorias_principal T', 'T.id_tutorias_principal = W.fk_te_id_tutorias_principal', 'INNER');
		$this->db->join('docente D', 'D.ID_DOCENTE = T.fk_id_docente', 'INNER');
		$this->db->join('param_lugares L', 'L.id_param_lugares = T.fk_id_lugar', 'INNER');
		$this->db->join('param_horas H', 'H.id_hora = T.hora_inicio', 'INNER');
		$this->db->join('param_horas X', 'X.id_hora = T.hora_fin', 'INNER');
		$this->db->join('param_asignaturas Y', 'Y.id_param_asignaturas = T.fk_tp_id_param_asignaturas', 'LEFT');
		$this->db->join('param_temas Z', 'Z.id_param_temas = T.fk_tp_id_param_temas', 'LEFT');
		
		$this->db->where('W.fk_te_id_user', $idUser);
       
		$this->db->order_by("fecha_tutoria", "DESC");
		$query = $this->db->get('tutorias_estudiante W');

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
	
    /**
     * Lista numero de cancelaciones de un usuario para un periodos
     * Modules: ESTUDIATE
     * @since 25/3/2019
     */
    public function get_cancelaciones_estudiante($arrData) 
	{
        $this->db->select();
		
        if (array_key_exists("idPeriodo", $arrData)) {
            $this->db->where('fk_ec_id_param_periodos', $arrData["idPeriodo"]);
        }
		
        if (array_key_exists("idEstudiante", $arrData)) {
            $this->db->where('fk_ec_id_user', $arrData["idEstudiante"]);
        }
		
		$query = $this->db->get('estudiante_cancelaciones');

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
	
    /**
     * Temas
     * Modules: DOCENTES
     * @since 27/3/2019
     */
    public function get_tutorias_docentes($arrData) 
	{
		$idUser = $this->session->userdata("id");
		
        $this->db->select("T.*, D.NOMBRE, L.direccion, H.hora minimo, H.formato_24 formato_minimo, X.hora maximo, X.formato_24 formato_maximo, Y.asignaturas, Z.temas");
        $this->db->join('docente D', 'D.ID_DOCENTE = M.fk_id_docente', 'INNER');
		$this->db->join('tutorias_principal T', 'T.fk_id_docente = D.ID_DOCENTE', 'INNER');
		$this->db->join('param_lugares L', 'L.id_param_lugares = T.fk_id_lugar', 'INNER');
		$this->db->join('param_horas H', 'H.id_hora = T.hora_inicio', 'INNER');
		$this->db->join('param_horas X', 'X.id_hora = T.hora_fin', 'INNER');
		$this->db->join('param_asignaturas Y', 'Y.id_param_asignaturas = T.fk_tp_id_param_asignaturas', 'LEFT');
		$this->db->join('param_temas Z', 'Z.id_param_temas = T.fk_tp_id_param_temas', 'LEFT');
		
		$this->db->where('M.fk_id_user', $idUser);
		
		
        if (array_key_exists("fechaInicio", $arrData) && $arrData["fechaInicio"] != '') {
            $this->db->where('T.fecha_tutoria >=', $arrData["fechaInicio"]);
        }
		
		if (array_key_exists("fechaFin", $arrData) && $arrData["fechaFin"] != '') {
            $this->db->where('T.fecha_tutoria <=', $arrData["fechaFin"]);
        }		
		
		if (array_key_exists("Estado", $arrData) && $arrData["Estado"] != '') {
            $this->db->where('T.estado_tutoria', $arrData["Estado"]);
        }
		
		$this->db->order_by("fecha_tutoria", "DESC");
		$query = $this->db->get('docente_x_user M');

        if ($query->num_rows() > 0) {
            return $query->result_array();
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
					'estado_tutoria' => 5,
					'observaciones' => $this->input->post('observaciones')
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
		 * Actualizar asistencia
		 * @since 24/3/2019
		 */
		public function updateAsistencia() 
		{
			$idTutoriaPrincipal = $this->input->post('hddIdTutoriaPrincipal');
			
			//se actualiza todas los estudiantes como no asistieron
			$data['asistencia'] = 2;
			$this->db->where('fk_te_id_tutorias_principal', $idTutoriaPrincipal);
			$query = $this->db->update('tutorias_estudiante', $data);

			//actualizo asistencia 
			$query = 1;
			if ($estudiante = $this->input->post('estudiante')) {
				$tot = count($estudiante);
				for ($i = 0; $i < $tot; $i++) {
					$data['asistencia'] = 1;
					$this->db->where('id_tutorias_estudiante', $estudiante[$i]);
					$query = $this->db->update('tutorias_estudiante', $data);
				}
			}
			if ($query) {
				return true;
			} else{
				return false;
			}
		}



}
