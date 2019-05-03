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

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        } else
            return false;
    }
	
    /**
     * Verifica si ya existe una tutoria para un docente en un dia a una hora
     * Modules: 
     * @since 12/4/2019
     * JSJL 
     */
    public function get_tutoria_docente_en_horario($arrData) 
	{
        $this->db->select();
		
        if (array_key_exists("fk_id_docente", $arrData) and array_key_exists("tutoria_lunes", $arrData) and array_key_exists("lunes_inicio", $arrData)) {
            $this->db->where('fk_id_docente', $arrData["fk_id_docente"]);
            $this->db->where('tutoria_lunes', $arrData["tutoria_lunes"]);
            $this->db->where('lunes_inicio', $arrData["lunes_inicio"]);
        }
	$query = $this->db->get('tutorias_base');
	$mensaje = "Existe una tutoría para el docente";
        if ($query->num_rows() > 0) 
	{
            $mensaje_lunes = "el lunes a las ".$arrData["lunes_inicio"];
        } 
	else 
	{
            return false;
        }
    }

    /**
     * Verifica si un estudiante ya tiene tutoria el mismo día a la misma hora
     * Modules: Parametros
     * @since 12/3/2019
     * select * from tutorias_principal, tutorias_estudiante where tutorias_principal.id_tutorias_principal = tutorias_estudiante.fk_te_id_tutorias_principal and tutorias_principal.fk_id_docente =1901 and fk_te_id_user =21;
     * JSJL 
     */
    public function get_tutoria_en_horario($arrData) 
	{
        $this->db->select();
        $this->db->join('tutorias_principal tp', 'tp.id_tutorias_principal = te.fk_te_id_tutorias_principal', 'INNER');
		
        if (array_key_exists("fechaTutoria", $arrData)) {
            $this->db->where('tp.fecha_tutoria', $arrData["fechaTutoria"]);
        }
        if (array_key_exists("horaInicio", $arrData)) {
            $this->db->where('tp.hora_inicio', $arrData["horaInicio"]);
        }
        if (array_key_exists("idUser", $arrData)) {
            $this->db->where('te.fk_te_id_user', $arrData["idUser"]);
        }
	$query = $this->db->get('tutorias_estudiante te');
        if ($query->num_rows() > 0) 
	{
            return true;
        } 
	else 
	{
            return false;
        }
    }

    /**
     * Verifica si un estudiante tiene tutorias con un profesor
     * Modules: Parametros
     * @since 12/3/2019
     * select * from tutorias_principal, tutorias_estudiante where tutorias_principal.id_tutorias_principal = tutorias_estudiante.fk_te_id_tutorias_principal and tutorias_principal.fk_id_docente =1901 and fk_te_id_user =21;
     * JSJL 
     */
    public function get_tutoria_con_docente($arrData) 
	{
        $this->db->select();
        $this->db->join('tutorias_principal tp', 'tp.id_tutorias_principal = te.fk_te_id_tutorias_principal', 'INNER');
		
        if (array_key_exists("idDocente", $arrData)) {
            $this->db->where('tp.fk_id_docente', $arrData["idDocente"]);
        }
        if (array_key_exists("idUser", $arrData)) {
            $this->db->where('te.fk_te_id_user', $arrData["idUser"]);
        }
		
	$query = $this->db->get('tutorias_estudiante te');
        if ($query->num_rows() > 0) 
	{
            return true;
        } 
	else 
	{
            return false;
        }
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
     * Asignaturas
     * Modules: Parametros
     * @since 12/3/2019
     */
    public function get_asignaturas_con_tema($arrData) 
	{
        $this->db->select();
        $this->db->join('param_programas P', 'P.id_param_programas = A.fk_id_param_programas', 'INNER');
        $this->db->join('param_temas T', 'T.fk_id_param_asignaturas = A.id_param_asignaturas', 'INNER');
		
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
     * usuarios
     * Modules: Parametros
     * @since 13/3/2019
     */
    public function get_usuarios($arrData) 
	{
        $this->db->select("U.*");
        $this->db->where('U.state', 1);
        if (array_key_exists("idUser", $arrData)) {
            $this->db->where('U.id_user', $arrData["idUser"]);
        }
	$this->db->order_by('U.log_user', 'desc');
	$query = $this->db->get('user U');
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
        
        $this->db->order_by('id_motivo_cancelacion', 'asc');
        $query = $this->db->get('motivo_cancelacion');

        if ($query->num_rows() > 0) {
            return $query->result();
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
//$this->db->where('id_hora >=', $arrData["idHoraInicio"]);
                $this->db->where('id_hora >=', 0);
			}
			if (array_key_exists("idHoraFinal", $arrData)) {
                //$this->db->where('id_hora <=', $arrData["idHoraFinal"]);
                $this->db->where('id_hora <=', 24);
			}
			$this->db->order_by("id_hora", "ASC");
			$query = $this->db->get("param_horas");

			if ($query->num_rows() >= 1) {
				return $query->result_array();
			} else
				return false;
		}
		
    /**
     * SEDE
     * Modules: Parametros
     * @since 25/4/2019
     * @author SDD
     */
    public function get_sede($arrData) 
	{
        $this->db->select("S.*");
        if (array_key_exists("idSede", $arrData)) {
            $this->db->where('S.ID_SEDE', $arrData["idSede"]);
        }
	$this->db->order_by('S.NOMBRE_SEDE', 'ASC');
	$query = $this->db->get('sede S');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    /**
     * LUGARES
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
     * PROGRAMAS
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
     * TEMAS
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
        $this->db->order_by("fecha_tutoria", "ASC");
        
        if (array_key_exists("idTutoria", $arrData)) {
            $this->db->where('T.id_tutorias_principal', $arrData["idTutoria"]);
        }
		
        if (array_key_exists("idSede", $arrData) && $arrData["idSede"] != '') {
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

        if (array_key_exists("fechaInicio", $arrData) && $arrData["fechaInicio"] != '') {
            $this->db->where('T.fecha_tutoria >=', $arrData["fechaInicio"]);
        }
        
        if (array_key_exists("fechaFin", $arrData) && $arrData["fechaFin"] != '') {
            $this->db->where('T.fecha_tutoria <=', $arrData["fechaFin"]);
        }   
		
		if (array_key_exists("Estado", $arrData) && $arrData["Estado"] != '') {
            $this->db->where('T.estado_tutoria', $arrData["Estado"]);
        }

        if (array_key_exists("listaEstadosTutoria", $arrData) && !empty($arrData["listaEstadosTutoria"])) {
            $this->db->where_in('T.estado_tutoria', $arrData["listaEstadosTutoria"]);
        }
		
		if (array_key_exists("idPrograma", $arrData) && $arrData["idPrograma"] != '') {
            $this->db->where('Y.fk_id_param_programas', $arrData["idPrograma"]);
        }
		
        if (array_key_exists("fechaActual", $arrData)) {
			$fechaActual = date('Y-m-d');
            $this->db->where('T.fecha_tutoria >=', $fechaActual);
        }
		
		$query = $this->db->get('tutorias_principal T');
//die(print_r($this->db->last_query()));
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }


    /**
     * CREAR ESCUELAS
     * Modules: Parametros
     * @since 25/4/2019
     * @author SDD
     
    public function get_param_escuela($arrData) 
	{
        $this->db->select("E.*");
        if (array_key_exists("idEscuela", $arrData)) {
            $this->db->where('E.ID_ESCUELA', $arrData["idEscuela"]);
        }
	$this->db->order_by('E.NOMBRE_ESCUELA', 'ASC');
	$query = $this->db->get('escuela E');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }*/
	
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
        if (array_key_exists("idEscuela", $arrData)) {
            $this->db->where('E.ID_ESCUELA', $arrData["idEscuela"]);
        }
		$this->db->order_by('E.NOMBRE_ESCUELA', 'ASC');
		$query = $this->db->get('escuela E');

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

     /**
     * TEMAS
     * Modules: TUTORIAS
     * @since 15/3/2019
     */
    public function get_escuela_sede($arrData) 
    {
        $this->db->select("T.*, S.NOMBRE_SEDE, E.NOMBRE_ESCUELA");
        $this->db->join('sede S', 'S.ID_SEDE = T.ID_SEDE', 'LEFT');
        $this->db->join('escuela E', 'E.ID_ESCUELA = T.ID_ESCUELA', 'LEFT');
        $this->db->order_by('NOMBRE_ESCUELA', "ASC");
        
        if (array_key_exists("idEscuelaSede", $arrData)) {
            $this->db->where('T.ID_ESCUELAS_X_SEDE', $arrData["idEscuelaSede"]);
        }
        
        if (array_key_exists("idSede", $arrData) && $arrData["idSede"] != '') {
            $this->db->where('T.ID_SEDE', $arrData["idSede"]);
        }
        
        if (array_key_exists("idEscuela", $arrData) && $arrData["idEscuela"] != '') {
            $this->db->where('T.ID_ESCUELA', $arrData["idEscuela"]);
        }
        
        $query = $this->db->get("escuelasede");

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
        $this->db->join('escuela E', 'E.ID_ESCUELA = D.ID_ESCUELA', 'INNER');
		
        if (array_key_exists("idEscuela", $arrData)) {
            $this->db->where('D.ID_ESCUELA', $arrData["idEscuela"]);
        }

		if (array_key_exists("idDocente", $arrData)) {
            $this->db->where('D.ID_DOCENTE', $arrData["idDocente"]);
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
     * Modules: ESTUDIANTE
     * @since 20/3/2019
     */
    public function get_asignaturas_tutoria($arrData) 
	{
        $this->db->select();
		$this->db->join('param_asignaturas X', 'X.id_param_asignaturas = A.fk_ta_param_asignaturas', 'INNER');
		
        if (array_key_exists("idTutoria", $arrData)) {
            $this->db->where('A.fk_ta_tutoria_base', $arrData["idTutoria"]);
        }
		$this->db->order_by('X. Asignaturas', 'ASC');
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
		
        $this->db->select("T.*, D.NOMBRE, L.direccion, H.hora minimo, H.formato_24 formato_minimo, X.hora maximo, X.formato_24 formato_maximo, Y.asignaturas, Z.temas, W.calificacion_texto, W.calificacion, W.estado as estadoInscripcion, W.id_tutorias_estudiante, W.asistencia_docente");
        $this->db->join('tutorias_principal T', 'T.id_tutorias_principal = W.fk_te_id_tutorias_principal', 'INNER');
		$this->db->join('docente D', 'D.ID_DOCENTE = T.fk_id_docente', 'INNER');
		$this->db->join('param_lugares L', 'L.id_param_lugares = T.fk_id_lugar', 'INNER');
		$this->db->join('param_horas H', 'H.id_hora = T.hora_inicio', 'INNER');
		$this->db->join('param_horas X', 'X.id_hora = T.hora_fin', 'INNER');
		$this->db->join('param_asignaturas Y', 'Y.id_param_asignaturas = T.fk_tp_id_param_asignaturas', 'LEFT');
		$this->db->join('param_temas Z', 'Z.id_param_temas = T.fk_tp_id_param_temas', 'LEFT');
		
		$this->db->where('W.fk_te_id_user', $idUser);
        //$this->db->where('W.estado', 1);
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
     * Búsqueda del perfil "Docente"
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
		
		$this->db->order_by("fecha_tutoria", "ASC");
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
		 * Actualizar datos de la tutoria, se cierrar tutoria
		 * @since 27/3/2019
		 */
		public function updateAsistenciaObservaciones() 
		{				
				$idTutoria = $this->input->post('hddIdTutoriaPrincipal');
		
				$concatenado = $this->input->post('observaciones')."\n".$this->input->post('observaciones2');
				$data = array('observaciones' => $concatenado);
				
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
