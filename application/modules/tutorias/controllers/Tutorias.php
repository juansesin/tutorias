<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tutorias extends CI_Controller {
	
    public function __construct() {
        parent::__construct();
        $this->load->model("tutorias_model");
		$this->load->model("general_model");
		$this->load->helper('form');
    }
		
	/**
	 * Lista de tutorias
     * @since 14/3/2019
     * @author BMOTTAG
	 */
	public function listado()
	{
			$arrParam = array();
			$data['info'] = $this->general_model->get_tutorias($arrParam);
			
			$data["view"] = 'listado_tutorias';
			$this->load->view("layout", $data);
	}
	
	/**
	 * Adicionar tutorias
     * @since 15/3/2019
     * @author BMOTTAG
	 */
	public function adicionar()
	{			
			$data['information'] = FALSE;
			
			//listado sedes
			$arrParam = array(
				"table" => "sede",
				"order" => "NOMBRE_SEDE",
				"id" => "x"
			);
			$data['SEDE'] = $this->general_model->get_basic_search($arrParam);
						
			//informacion periodo
			$arrParam = array("idEstado" => 1);
			$data['PERIODOS'] = $this->general_model->get_periodos($arrParam);
			
			$arrParamFiltro = array(
				"idHoraInicio" => $data['PERIODOS'][0]['horario_minimo'],
				"idHoraFinal" => $data['PERIODOS'][0]['horario_maximo']
			);
			$data['horas'] = $this->general_model->get_horas($arrParamFiltro);//LISTA DE HORAS
	
			$data["view"] = 'form_tutorias';
			$this->load->view("layout", $data);			
	}	
	
	/**
	 * Guardar tutoria
     * @since 16/3/2019
	 */
	public function guardar_tutoria()
	{			
			header('Content-Type: application/json');

			$fechaInicio = $this->input->post('inicio_periodo');
			$fechaFin = $this->input->post('fin_periodo');
			$lunes = $this->input->post('lunes');
			$martes = $this->input->post('martes');
			$miercoles = $this->input->post('miercoles');
			$jueves = $this->input->post('jueves');
			$viernes = $this->input->post('viernes');
			$sabado = $this->input->post('sabado');
			
			$lunes_inicio = $this->input->post('horario_minimo_lunes');
			$lunes_fin = $this->input->post('horario_maximo_lunes');
			$martes_inicio = $this->input->post('horario_minimo_martes');
			$martes_fin = $this->input->post('horario_maximo_martes');
			$miercoles_inicio = $this->input->post('horario_minimo_miercoles');
			$miercoles_fin = $this->input->post('horario_maximo_miercoles');
			$jueves_inicio = $this->input->post('horario_minimo_jueves');
			$jueves_fin = $this->input->post('horario_maximo_jueves');
			$viernes_inicio = $this->input->post('horario_minimo_viernes');
			$viernes_fin = $this->input->post('horario_maximo_viernes');
			$sabado_inicio = $this->input->post('horario_minimo_sabado');
			$sabado_fin = $this->input->post('horario_maximo_sabado');
<<<<<<< HEAD
			//$fk_id_docente = $this->input->post('fk_id_docente');
		//$this->load->model("general_model");
		//$arrParam = array("fk_id_docente" => $fk_id_docente,"tutoria_lunes" => $lunes,"lunes_inicio" => $lunes_inicio);
		//$lista = $this->general_model->get_tutoria_docente_en_horario($arrParam);
		//print "<script type=\"text/javascript\">alert('Some text');</script>";
=======
			$fk_id_docente = $this->input->post('fk_id_docente');
		$this->load->model("general_model");
		$arrParam = array("fk_id_docente" => $fk_id_docente,"tutoria_lunes" => $lunes,"lunes_inicio" => $lunes_inicio);
		$lista = $this->general_model->get_tutoria_docente_en_horario($arrParam);
//print "<script type=\"text/javascript\">alert('Some text');</script>";
		//die(print_r($lista));				
>>>>>>> 9c057308de98162948ee0f2c65fe7318202e8ae6
			if ($idTutoria = $this->tutorias_model->saveTutoria()) 
			{
				//GUARDO ASIGNATURAS DE LA Tutorias
				$asignaturas = $this->input->post('Asignaturas');
				$numeroAsignaturas = count($asignaturas);
				for ($i = 0; $i < $numeroAsignaturas; $i++) {
					$idUser = $this->tutorias_model->saveTutoriaAsignaturas($idTutoria, $asignaturas[$i]);
				}
				
				
				//tutorias para los lunes
				if(isset($lunes)){
					$calculo = $this->calculo_algoritmo($fechaInicio, $fechaFin, 1, 'monday'); //fechas de lunes

					if ($calculo) {
						$tot = count($calculo);
						for ($i = 0; $i < $tot; $i++) {
														
							//revisar si las horas son consecutivas de lo contrario guardar un registro por cada hora
							$inicio = $lunes_inicio;
							$fin = $lunes_fin;
							
							$restaHoras = $fin - $inicio;

							for ($x = 0; $x < $restaHoras; $x++) {
								$fin = $inicio + 1;
								$idUser = $this->tutorias_model->saveTutoriaPrincipal($idTutoria, $calculo[$i], $inicio, $fin);
								$inicio = $fin;
							}
							
						}
					}
					
				}
				
				//tutorias para los martes
				if(isset($martes)){
					$calculo = $this->calculo_algoritmo($fechaInicio, $fechaFin, 2, 'tuesday'); //fechas de martes

					if ($calculo) {
						$tot = count($calculo);
						for ($i = 0; $i < $tot; $i++) {
							
							//revisar si las horas son consecutivas de lo contrario guardar un registro por cada hora
							$inicio = $martes_inicio;
							$fin = $martes_fin;
							
							$restaHoras = $fin - $inicio;

							for ($x = 0; $x < $restaHoras; $x++) {
								$fin = $inicio + 1;
								$idUser = $this->tutorias_model->saveTutoriaPrincipal($idTutoria, $calculo[$i], $inicio, $fin);
								$inicio = $fin;
							}
							
						}
					}
					
				}
				
				//tutorias para los miercoles
				if(isset($miercoles)){
					$calculo = $this->calculo_algoritmo($fechaInicio, $fechaFin, 3, 'wednesday'); //fechas de martes

					if ($calculo) {
						$tot = count($calculo);
						for ($i = 0; $i < $tot; $i++) {							
							//revisar si las horas son consecutivas de lo contrario guardar un registro por cada hora
							$inicio = $miercoles_inicio;
							$fin = $miercoles_fin;
							
							$restaHoras = $fin - $inicio;

							for ($x = 0; $x < $restaHoras; $x++) {
								$fin = $inicio + 1;
								$idUser = $this->tutorias_model->saveTutoriaPrincipal($idTutoria, $calculo[$i], $inicio, $fin);
								$inicio = $fin;
							}
						}
					}
					
				}
				
				//tutorias para los jueves
				if(isset($jueves)){
					$calculo = $this->calculo_algoritmo($fechaInicio, $fechaFin, 4, 'thursday'); //fechas de jueves

					if ($calculo) {
						$tot = count($calculo);
						for ($i = 0; $i < $tot; $i++) {							
							//revisar si las horas son consecutivas de lo contrario guardar un registro por cada hora
							$inicio = $jueves_inicio;
							$fin = $jueves_fin;
							
							$restaHoras = $fin - $inicio;

							for ($x = 0; $x < $restaHoras; $x++) {
								$fin = $inicio + 1;
								$idUser = $this->tutorias_model->saveTutoriaPrincipal($idTutoria, $calculo[$i], $inicio, $fin);
								$inicio = $fin;
							}
						}
					}
					
				}
				
				//tutorias para los viernes
				if(isset($viernes)){
					$calculo = $this->calculo_algoritmo($fechaInicio, $fechaFin, 5, 'friday'); //fechas de viernes

					if ($calculo) {
						$tot = count($calculo);
						for ($i = 0; $i < $tot; $i++) {							
							//revisar si las horas son consecutivas de lo contrario guardar un registro por cada hora
							$inicio = $viernes_inicio;
							$fin = $viernes_fin;
							
							$restaHoras = $fin - $inicio;

							for ($x = 0; $x < $restaHoras; $x++) {
								$fin = $inicio + 1;
								$idUser = $this->tutorias_model->saveTutoriaPrincipal($idTutoria, $calculo[$i], $inicio, $fin);
								$inicio = $fin;
							}
						}
					}
					
				}
				
				//tutorias para los sabado
				if(isset($sabado)){
					$calculo = $this->calculo_algoritmo($fechaInicio, $fechaFin, 6, 'saturday'); //fechas de sabado

					if ($calculo) {
						$tot = count($calculo);
						for ($i = 0; $i < $tot; $i++) {							
							//revisar si las horas son consecutivas de lo contrario guardar un registro por cada hora
							$inicio = $sabado_inicio;
							$fin = $sabado_fin;
							
							$restaHoras = $fin - $inicio;

							for ($x = 0; $x < $restaHoras; $x++) {
								$fin = $inicio + 1;
								$idUser = $this->tutorias_model->saveTutoriaPrincipal($idTutoria, $calculo[$i], $inicio, $fin);
								$inicio = $fin;
							}
						}
					}
					
				}
				
				
				$data["result"] = true;
				$data["idRecord"] = $idTutoria;
				$this->session->set_flashdata('retornoExito', 'Se guardó la información');
			} else {
				$data["result"] = "error";
				$data["idRecord"] = '';
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ask for help, contact the Admin.');
			}
			
			echo json_encode($data);
    }
	
	/**
	 * Lista de escuelas
     * @since 4/2/2017
     * @author BMOTTAG
	 */
    public function escuelaList() 
	{
        header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
        $Sede = $this->input->post('Sede');
		
		//company list
		$this->load->model("general_model");
		$arrParam = array("idSede" => $Sede);
		$lista = $this->general_model->get_escuelas($arrParam);//lista de escuelas

        echo "<option value=''>Select...</option>";
        if ($lista) {
            foreach ($lista as $fila) {
                echo "<option value='" . $fila["ID_ESCUELA"] . "' >" . $fila["NOMBRE_ESCUELA"] . "</option>";
            }
        }
    }
	
	/**
	 * Lista de escuelas
     * @since 4/2/2017
     * @author BMOTTAG
	 */
    public function docenteList() 
	{
        header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
        $Escuela = $this->input->post('Escuela');
		
		//company list
		$this->load->model("general_model");
		$arrParam = array("idEscuela" => $Escuela);
		$lista = $this->general_model->get_docentes($arrParam);//lista de escuelas

        echo "<option value=''>Select...</option>";
        if ($lista) {
            foreach ($lista as $fila) {
                echo "<option value='" . $fila["ID_DOCENTE"] . "' >" . $fila["NOMBRE"] . "</option>";
            }
        }
    }
	
	/**
	 * Lista de lugares
     * @since 4/2/2017
     * @author BMOTTAG
	 */
    public function lugarList() 
	{
        header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
        $Sede = $this->input->post('Sede');
		
		//listado de lugares para la sede seleccionada
		$this->load->model("general_model");
		$arrParam = array("idSede" => $Sede);
		$lista = $this->general_model->get_lugares($arrParam);//lista de lugares

        echo "<option value=''>Select...</option>";
        if ($lista) {
            foreach ($lista as $fila) {
                echo "<option value='" . $fila["id_param_lugares"] . "' >" . $fila["direccion"] . "</option>";
            }
        }
    }

	/**
	 * Lista de asignaturas
     * @since 15/3/2019
     * @author BMOTTAG
	 */
    public function asignaturasList() 
	{
        header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
        $Escuela = $this->input->post('Escuela');
		
		//company list
		$this->load->model("general_model");
		$arrParam = array("idEscuela" => $Escuela);
<<<<<<< HEAD
		$lista = $this->general_model->get_asignaturas_con_tema($arrParam);//lista de escuelas
=======
		$lista = $this->general_model->get_asignaturas($arrParam);//lista de escuelas
>>>>>>> 9c057308de98162948ee0f2c65fe7318202e8ae6

        echo "<option value=''>Select...</option>";
        if ($lista) {
            foreach ($lista as $fila) {
                echo "<option value='" . $fila["id_param_asignaturas"] . "' >" . $fila["asignaturas"] . "</option>";
            }
        }
    }
	
	/**
	 * Lista de progrmas
     * @since 28/3/2019
     * @author BMOTTAG
	 */
    public function programasList() 
	{
        header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
        $Escuela = $this->input->post('Escuela');
		
		//company list
		$this->load->model("general_model");
		$arrParam = array("idEscuela" => $Escuela);
		$lista = $this->general_model->get_programas($arrParam);//lista de programas

        echo "<option value=''>Select...</option>";
        if ($lista) {
            foreach ($lista as $fila) {
                echo "<option value='" . $fila["id_param_programas"] . "' >" . $fila["programa"] . "</option>";
            }
        }
    }

	/**
	 * Calculo de dias
     * @since 25/12/2018
     * @author BMOTTAG
	 */
	public function calculo_algoritmo($fechaNormalInicial, $fechaNormalFinal, $numeroDia, $diaLetras)
	{
<<<<<<< HEAD
              $fechaInicio = strtotime($fechaNormalInicial);
               $fechaFin = strtotime($fechaNormalFinal);
                // JSJL : SI LA FECHA DE INICIO ES MENOR QUE LA FECHA ACTUAL LA FECHA ACTUAL PASA A SER LA FECHA DE INICIO CON EL FIN DE CREAR LAS TUTORIAS SOLO A PARTIR DE ESA FECHA.
               $fechaActual = date_create(date('Y-m-d G:i'))->getTimestamp();
                if ($fechaInicio < $fechaActual)
                {
                        $fechaInicio = $fechaActual;
                        $fechaNormalInicial = gmdate("Y-m-d",$fechaActual);
                }
                $dia =  date('w', strtotime($fechaInicio));

                if($dia>$numeroDia){
                        //como es un dia despues del lunes entonces le sumo una semana para averiguar los lunes de la siguiente semana
                        $nuevafecha = strtotime ( '+7 day' , strtotime ( $fechaNormalInicial ) ) ;
                        $fechaNormalInicial = date ( 'Y-m-j' , $nuevafecha );
                }

                $fechaInicio = strtotime($fechaNormalInicial);
                //Recorro las fechas y con la función strotime obtengo los lunes
                $x=0;

                for ($i = $fechaInicio; $i <= $fechaFin; $i += 86400 * 7){
                        $lunes[$x] =  date("Y-m-d", strtotime($diaLetras . ' this week', $i));
                        $x++;
                }
=======
		$fechaInicio = strtotime($fechaNormalInicial);
		$fechaFin = strtotime($fechaNormalFinal);

		$dia =  date('w', $fechaInicio);

		if($dia>$numeroDia){
			//como es un dia despues del lunes entonces le sumo una semana para averiguar los lunes de la siguiente semana
			$nuevafecha = strtotime ( '+7 day' , strtotime ( $fechaNormalInicial ) ) ;
			$fechaNormalInicial = date ( 'Y-m-j' , $nuevafecha );
		}

		$fechaInicio = strtotime($fechaNormalInicial);
		//Recorro las fechas y con la función strotime obtengo los lunes
		$x=0;

		for ($i = $fechaInicio; $i <= $fechaFin; $i += 86400 * 7){
			$lunes[$x] =  date("Y-m-d", strtotime($diaLetras . ' this week', $i));
			$x++;
		}
>>>>>>> 9c057308de98162948ee0f2c65fe7318202e8ae6

		return $lunes;
	}
	
	/**
	 * Editar tutorias
     * @since 22/3/2019
     * @author BMOTTAG
	 */
	public function modificar($idTutoriaPrincipal)
	{			
			$data['information'] = FALSE;
									
			//informacion periodo
			$arrParam = array("idEstado" => 1);
			$data['PERIODOS'] = $this->general_model->get_periodos($arrParam);
			
			//informacion tutoria
			$arrParam = array(
							"idTutoria" => $idTutoriaPrincipal
						);
			$data['info'] = $this->general_model->get_tutorias($arrParam);
			
			$idTutoriaBase = $data['info'][0]['fk_id_tutorias_base'];
			$Escuela = $data['info'][0]['fk_id_escuela'];
			$idAsignatura = $data['info'][0]['fk_tp_id_param_asignaturas'];
//pr($data['info']); exit;
			//listado de docentes para la escuela de la tutoria
			$arrParam = array("idEscuela" => $Escuela);
			$data['listaDocentes'] = $this->general_model->get_docentes($arrParam);//lista de docentes
						
			//listado de lugares para la sede de la tutoria
			$arrParam = array("idSede" => $data['info'][0]['fk_id_sede']);
			$data['listaLugares'] = $this->general_model->get_lugares($arrParam);//lista de lugares

			//listado de asignaturas guardadas para la tutoria
			$arrParam = array("idTutoria" => $idTutoriaBase);
			$data['listaAsignaturas'] = $this->general_model->get_asignaturas_tutoria($arrParam);//lista de asignaturas
			
			//si ya se encuentra guardada la asignatura entonces busca la lista de los temas
			if($idAsignatura && ($idAsignatura != '' || $idAsignatura != 0)){
				$arrParam = array("idAsignatura" => $idAsignatura);
				$data['listaTemas'] = $this->general_model->get_temas($arrParam);//lista de temas
			}
			
			$arrParamFiltro = array(
				"idHoraInicio" => $data['PERIODOS'][0]['horario_minimo'],
				"idHoraFinal" => $data['PERIODOS'][0]['horario_maximo']
			);
			$data['horas'] = $this->general_model->get_horas($arrParamFiltro);//LISTA DE HORAS
	
			$data["view"] = 'form_modificar';
			$this->load->view("layout", $data);			
	}	
	
	/**
	 * Guardar tutoria
     * @since 23/3/2019
	 */
	public function guardar_edicion_tutoria()
	{			
			header('Content-Type: application/json');
			$idTutoria = $this->input->post('hddIdTutoriaPrincipal');
			$arrParam = array(
				"idTutoria" => $idTutoria
			);
			$data["result"] = true;
			$data["idRecord"] = $idTutoria;
			$infoTutoria = $this->general_model->get_tutorias($arrParam);
			if($infoTutoria){
				$fechaTutoria = $infoTutoria[0]['fecha_tutoria'];
				if($this->input->post('fecha') > $fechaTutoria){
					if ($idTutoria = $this->tutorias_model->updateTutoria()) 
					{				
						$data["result"] = true;
						$data["idRecord"] = $idTutoria;
						$this->session->set_flashdata('retornoExito', 'Se guardó la información');
					} else {
						$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ask for help, contact the Admin.');
					}
				}else{
					$this->session->set_flashdata('retornoError', '<strong>¡ERROR EN FECHA Y/O HORA!</strong> La tutoría se debe programar con 24 horas de anticipación');
				}
			}else{				
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> No existe la tutoria.'); 
			}
			echo json_encode($data);
    }
	
	/**
	 * Cancelar tutoria
	 * Se debe actualizar tabla de tutorias principal, actualizar el estado
     * @since 23/3/2019
	 */
	public function cancelar_tutoria($idTutoria,$idMotivoCancelacion)
	{			
			header('Content-Type: application/json');
			//$idMotivoCancelacion = $this->input->post('motivoCancelacion');
<<<<<<< HEAD
=======
			//die(print_r($idMotivoCancelacion));	
>>>>>>> 9c057308de98162948ee0f2c65fe7318202e8ae6
						
			if ($this->tutorias_model->updateTutoriaCancelar($idTutoria,$idMotivoCancelacion)) 
			{								
				$data["result"] = true;
				$this->session->set_flashdata('retornoExito', 'Se canceló la Tutoría.');
			} else {
				$data["result"] = "error";
				$data["mensaje"] = "Error!!! Contactarse con el Administrador.";
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el Administrador.');
			}				
			//echo json_encode($data);
			redirect(base_url('docente'), 'refresh');
    }
	
	/**
	 * Listado de inscritos a una tutoria, para confirmar la asistencia
     * @since 24/3/2019
     * @author BMOTTAG
	 */
	public function inscritos($idTutoria)
	{						
			$arrParam = array("idTutoria" => $idTutoria);
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
	public function update_asistencia_observaciones()
	{	
			$idTutoriaPrincipal = $this->input->post('hddIdTutoriaPrincipal');
	
			if ($this->general_model->updateAsistenciaObservaciones()) {
				
				//actulizo el estado de la tutoria a cerrada y actualizo el campo de observacion
				$data["result"] = true;
				$this->session->set_flashdata('retornoExito', "Se actualizaron las observaciones.");
			} else {
				$data["result"] = "error";
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ask for help');
			}

			redirect(base_url('tutorias/inscritos/' . $idTutoriaPrincipal), 'refresh');
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
				
				//actulizo el estado de la tutoria a cerrada y actualizo el campo de observacion
				$this->general_model->updateTutoriaCerrar();
				$data["result"] = true;
				$this->session->set_flashdata('retornoExito', "Se cerro la Tutoría.");
			} else {
				$data["result"] = "error";
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ask for help');
			}

			redirect(base_url('tutorias/inscritos/' . $idTutoriaPrincipal), 'refresh');
	}

	
	
	
}
