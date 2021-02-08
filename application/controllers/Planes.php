<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Planes extends CI_Controller {

	//	FUNCION PADRE CONSTRUCTURA, CARGA GLOBAL DE LIBRERIAS EN TODAS LAS FUNCIONES
	public function __construct()
	{
		parent::__construct();
		if ($_SESSION['login']['check'] == FALSE) { redirect(base_url()); }
	}

	//	FUNCION POR DEFECTO, CARGA LISTADO DE aseguradoras
	public function index()
	{
		if ($_SESSION['login']['rol'] == 'Usuario') { redirect(base_url('inicio/bienvenido')); }
		// verificar duplicidad de imagenes de las aseguradoras
		/*$this->load->helper('file');
		$imagenes = get_filenames('./app/files/aseguradoras/');*/

		$data['data'] = array(
		 	'select' => '	planes.id_plan, 
							planes.id_aseguradora, 
							planes.plan, 
							planes.suma_asegurada,
							planes.estado,
							aseguradoras.id_aseguradora, 
							aseguradoras.aseguradora, 
							aseguradoras.img, 
						', 
		 	'table'  => 'planes',
		 	'join'   => array(
		 		'aseguradoras' => 'aseguradoras.id_aseguradora = planes.id_aseguradora',
		 	),
		 	'order'  => 'id_plan DESC',
		 	//'where'  => 'planes.estado = "1"',
		 	'return' => 'result', 
		);
		$data['planes'] = $this->crud->read($data['data']);

		$data['titulo'] = 'Listado de planes';
		$data['contenido'] = 'planes/listado';
		$this->load->view('render', $data);
	}

	public function nuevo()
	{
		if ($_SESSION['login']['rol'] == 'Usuario') { redirect(base_url('inicio/bienvenido')); }

		$config['js'] = array('forms');
		$this->resources->initialize($config);

		$data['data'] = array(
		 	'select' => '*', 
		 	'table'  => 'aseguradoras', 
		 	'order'  => 'aseguradora ASC',
		 	'where'  => 'estado_aseguradora = "1"',
		 	'return' => 'result', 
		);
		$data['aseguradoras'] = $this->crud->read($data['data']);

		$data['titulo'] = 'Nuevo plan';
		$data['contenido'] = 'planes/nuevo';
		$this->load->view('render', $data);
	}

	public function guardar()
	{
		if ($this->input->is_ajax_request()) 
		{
			$keys_post = array_keys($this->input->post());
	 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }
	 		
	 		if ($this->form_validation->run('planes') == TRUE) 
	 		{ 
	 			$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
				$codigo = substr(str_shuffle($permitted_chars), 0, 10);

	 			$data['data'] = array(
	 				'id_aseguradora'   		=> $aseguradora, 
	 				'codigo'        		=> $codigo, 
	 				'plan'        			=> $plan, 
	 				'suma_asegurada'       	=> $suma,  
	 				'deducible_nacional'   	=> $Dnacional, 
	 				'deducible_exterior'   	=> $Dexterior, 
	 				'plazo'        			=> $plazo 
	 			);
	 			$data['table'] = 'planes';

	 			if ($this->crud->create($data) == TRUE) 
	 			{
	 				$data = array(
								'select' => 'id_plan, codigo', 
								'table'  => 'planes', 
								'where'  => 'planes.codigo = "'.$codigo.'"', 
								'return' => 'row'
							);
					$plan_creado = $this->crud->read($data);

					$data['data'] = array(
		 				'id_plan'  	=> $plan_creado->id_plan, 
		 				'titular_9'  	=> $titular9, 	
		 				'titular_19'  	=> $titular19, 	
		 				'titular_29'  	=> $titular29, 	
		 				'titular_39'  	=> $titular39, 	
		 				'titular_49'  	=> $titular49, 	
		 				'titular_54'  	=> $titular54, 	
		 				'titular_59'  	=> $titular59, 	
		 				'titular_69'  	=> $titular69, 	
		 				'titular_75'  	=> $titular75,
		 				'beneficiario_9'  	=> $beneficiario9, 	
		 				'beneficiario_19'  	=> $beneficiario19, 	
		 				'beneficiario_29'  	=> $beneficiario29, 	
		 				'beneficiario_39'  	=> $beneficiario39, 	
		 				'beneficiario_49'  	=> $beneficiario49, 	
		 				'beneficiario_54'  	=> $beneficiario54, 	
		 				'beneficiario_59'  	=> $beneficiario59, 	
		 				'beneficiario_69'  	=> $beneficiario69, 	
		 				'beneficiario_75'  	=> $beneficiario75, 	
		 			);
		 			$data['table'] = 'primas';
		 			$this->crud->create($data);

		 			if(isset($atencion) && $atencion != NULL){ $atencion_primaria = $atencion; }else{ $atencion_primaria = NULL; } 
		 			if(isset($vida) && $vida != NULL){ $vida = $vida; }else{ $vida = NULL;  }
		 			if(isset($ambulancia) && $ambulancia != NULL){ $ambulancia = $ambulancia; }else{ $ambulancia = NULL;  }
		 			if(isset($odontologia) && $odontologia != NULL){ $odontologia = $odontologia; }else{ $odontologia = NULL;  }
		 			if(isset($oftalmologia) && $oftalmologia != NULL){ $oftalmologia = $oftalmologia; }else{ $oftalmologia = NULL;  }
		 			if(isset($psicologia) && $psicologia != NULL){ $psicologia = $psicologia; }else{ $psicologia = NULL;  }
		 			if(isset($nutricion) && $nutricion != NULL){ $nutricion = $nutricion; }else{  $nutricion = NULL; }
		 			if(isset($fisioterapia) && $fisioterapia != NULL){ $fisioterapia = $fisioterapia; }else{  $fisioterapia = NULL; }
		 			if(isset($dermatologia) && $dermatologia != NULL){ $dermatologia = $dermatologia; }else{  $dermatologia = NULL; }
		 			if(isset($muerte) && $muerte != NULL){ $muerte_accidental = $muerte; }else{ $muerte_accidental = NULL;  }
		 			if(isset($invalidez) && $invalidez != NULL){ $invalidez_permanente = $invalidez; }else{ $invalidez_permanente = NULL;  }
		 			if(isset($orientacion) && $orientacion != NULL){ $orientacion_medica_tlf = $orientacion; }else{ $orientacion_medica_tlf = NULL;  }
		 			if(isset($bariatica) && $bariatica != NULL){ $cirugia_bariatica = $bariatica; }else{ $cirugia_bariatica = NULL;  }
		 			if(isset($profilactica) && $profilactica != NULL){ $cirugia_profilactica_cancer = $profilactica; }else{ $cirugia_profilactica_cancer = NULL;  }
		 			if(isset($congenita) && $congenita != NULL){ $condicion_congenita = $congenita; }else{ $condicion_congenita = NULL;  }
		 			if(isset($vih) && $vih != NULL){ $tratamiento_vih_sida = $vih; }else{  $tratamiento_vih_sida = NULL; }
		 			if(isset($transplante) && $transplante != NULL){ $transplante = $transplante; }else{ $transplante = NULL;  }
		 			if(isset($complicacionN) && $complicacionN != NULL){ $complicacion_nacimiento = $complicacionN; }else{ $complicacion_nacimiento = NULL;  }
		 			if(isset($complicacionM) && $complicacionM != NULL){ $complicacion_maternidad = $complicacionM; }else{ $complicacion_maternidad = NULL;  }		 			

		 			$data['data'] = array(
		 				'id_plan'  	=> $plan_creado->id_plan, 
		 				'tipo_servicio'			=> $tipo, 	
		 				'maternidad'  			=> $maternidad, 	
		 				'viaje_internacional'  	=> $viaje, 	
		 				'gastos_funerarios'  	=> $funerario,

		 				'atencion_primaria'  			=> $atencion_primaria, 	
		 				'vida'  						=> $vida, 	
		 				'ambulancia'  					=> $ambulancia, 	
		 				'odontologia'  					=> $odontologia, 	
		 				'oftalmologia'  				=> $oftalmologia, 	
		 				'psicologia'  					=> $psicologia, 	
		 				'nutricion'  					=> $nutricion, 	
		 				'fisioterapia'  				=> $fisioterapia, 	
		 				'dermatologia'  				=> $dermatologia, 	
		 				'muerte_accidental'  			=> $muerte_accidental, 	
		 				'invalidez_permanente'  		=> $invalidez_permanente, 	
		 				'orientacion_medica_tlf'  		=> $orientacion_medica_tlf, 	
		 				'cirugia_bariatica'  			=> $cirugia_bariatica, 	
		 				'cirugia_profilactica_cancer'	=> $cirugia_profilactica_cancer, 	
		 				'condicion_congenita'  			=> $condicion_congenita, 	
		 				'tratamiento_vih_sida'  		=> $tratamiento_vih_sida, 	
		 				'transplante'  					=> $transplante, 	
		 				'complicacion_nacimiento'  		=> $complicacion_nacimiento, 	
		 				'complicacion_maternidad'  		=> $complicacion_maternidad, 	
		 			);
		 			$data['table'] = 'condiciones';
		 			$this->crud->create($data);

	 				$json = array(
	            		'respuesta' => 'alert', 
	            		'tipo'  	=> 'success',
	            		'texto'     => '¡'.$plan.', creado exitosamente!',  
	            		'redirigir'  => base_url('planes') 
	            	);
	            	echo json_encode($json);
	 			} 
	 			else 
	 			{
					$json = array(
		            	'respuesta' => 'toast',  
		            	'tipo'      => 'error',  
		            	'texto'     => 'Ops! Error al crear el plan' 
		            );
		            echo json_encode($json);
	 			}
	 		} 
	 		else 
	 		{
	 			echo json_encode($this->form_validation->error_array());
	 		}
		} 
		else 
		{
			show_404();
		}
	}

	public function editar($id)
	{
		if ($_SESSION['login']['rol'] == 'Usuario') { redirect(base_url('inicio/bienvenido')); }

		$config['js'] = array('forms');
		$this->resources->initialize($config);

		$data['data'] = array(
		 	'select' => '*', 
		 	'table'  => 'aseguradoras', 
		 	'order'  => 'aseguradora ASC',
		 	'where'  => 'estado_aseguradora = "1"',
		 	'return' => 'result', 
		);
		$data['aseguradoras'] = $this->crud->read($data['data']);

		$data['data'] = array(
		 	'select' => '*', 
		 	'table'  => 'planes',
		 	'join'   => array(
		 		'aseguradoras' => 'aseguradoras.id_aseguradora = planes.id_aseguradora',
		 		'primas' => 'primas.id_plan = planes.id_plan',
		 		'condiciones' => 'condiciones.id_plan = planes.id_plan',
		 	),
		 	//'order'  => 'id_plan DESC',
		 	'where'  => 'planes.id_plan = "'.$id.'"',
		 	'return' => 'row', 
		);
		$data['plan'] = $this->crud->read($data['data']);

		$data['titulo'] = 'Editar plan';
		$data['contenido'] = 'planes/editar';
		$this->load->view('render', $data);
	}

	public function eliminar($id)
	{
		if ($_SESSION['login']['rol'] == 'Usuario') { redirect(base_url('inicio/bienvenido')); }
		
		$config['js'] = array('forms');
		$this->resources->initialize($config);

		$data['data'] = array(
		 	'select' => '*', 
		 	'table'  => 'planes',
		 	'join'   => array(
		 		'aseguradoras' => 'aseguradoras.id_aseguradora = planes.id_aseguradora',
		 		'primas' => 'primas.id_plan = planes.id_plan',
		 		'condiciones' => 'condiciones.id_plan = planes.id_plan',
		 	),
		 	//'order'  => 'id_plan DESC',
		 	'where'  => 'planes.id_plan = "'.$id.'"',
		 	'return' => 'row', 
		);
		$plan = $data['plan'] = $this->crud->read($data['data']);

		if ($plan->estado == "1") {
		  $data['estado'] = 'Eliminar';
		} else {
		  $data['estado'] = 'Restaurar';
		}

		$data['titulo'] = $data['estado'].' plan';
		$data['contenido'] = 'planes/eliminar';
		$this->load->view('render', $data);
	}

	public function actualizar()
	{
		if ($this->input->is_ajax_request()) 
		{
			$keys_post = array_keys($this->input->post());
 			foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }

 			// verifica token para saber si se va a editar, eliminar o restaurar un usuario...
 			// si el token es eliminar
 			if ($token == 'eliminar') 
 			{
 				if ($estado == "1") 
 				{
 	 				$data = array(
			    		'table'  => 'planes', 
			    		'where'  => 'planes.id_plan = "'.$id.'"',
			    	);
			    	$data['set'] = array(
		 				'planes.estado'   => '0', 
		 			);
			    	if ($this->crud->edit($data) == TRUE) 
	            	{
	            		$json = array(
				    		'respuesta' 	=> 'alert',
				    		'tipo' 			=> 'success',
				    		'texto' 		=> 'Plan eliminado exitosamente' ,
				    		'redirigir'  	=> base_url('planes')
				    	);
				    	echo json_encode($json);
	            	} 
	            	else 
	            	{
	            		$json = array(
				    		'respuesta' => 'toast',
				    		'tipo' 		=> 'error',
				    		'texto' 	=> 'Error al eliminar el plan'
				    	);
				    	echo json_encode($json);
	            	}	
 				} 
 				else 
 				{
 					$data = array(
			    		'table'  => 'planes', 
			    		'where'  => 'planes.id_plan = "'.$id.'"',
			    	);
			    	$data['set'] = array(
		 				'planes.estado'   => '1', 
		 			);
			    	if ($this->crud->edit($data) == TRUE) 
	            	{
	            		$json = array(
				    		'respuesta' 	=> 'alert',
				    		'tipo' 			=> 'success',
				    		'texto' 		=> 'Plan restaurado exitosamente' ,
				    		'redirigir'  	=> base_url('planes')
				    	);
				    	echo json_encode($json);
	            	} 
	            	else 
	            	{
	            		$json = array(
				    		'respuesta' => 'toast',
				    		'tipo' 		=> 'error',
				    		'texto' 	=> 'Error al restaurar el plan'
				    	);
				    	echo json_encode($json);
	            	}
 				}
 				
 			} 
 			// sino el token es editar
 			else 
 			{
				if ($this->form_validation->run('planes') == TRUE) 
				{
			    	// se setean los datos para actualizar el usuario
	    			$data = array(
	            		'table' => 'planes', 
	            		'where' => 'planes.id_plan = '.$id, 
	            	);
	            	
	            	$data['set'] = array(
		 				'id_aseguradora' 	=> $aseguradora, 
		 				'plan'        		=> $plan, 
		 				'suma_asegurada'	=> $suma,  
		 				'deducible_nacional'=> $Dnacional,  
		 				'deducible_exterior'=> $Dexterior,  
		 				'plazo'     		=> $plazo, 
		 			);
		 			if ($this->crud->edit($data) == TRUE) 
	            	{

			 			$data = array(
		            		'table' => 'primas', 
		            		'where' => 'primas.id_plan = '.$id, 
		            	);
						$data['set'] = array( 
			 				'titular_9'  	=> $titular9, 	
			 				'titular_19'  	=> $titular19, 	
			 				'titular_29'  	=> $titular29, 	
			 				'titular_39'  	=> $titular39, 	
			 				'titular_49'  	=> $titular49, 	
			 				'titular_54'  	=> $titular54, 	
			 				'titular_59'  	=> $titular59, 	
			 				'titular_69'  	=> $titular69, 	
			 				'titular_75'  	=> $titular75,
			 				'beneficiario_9'  	=> $beneficiario9, 	
			 				'beneficiario_19'  	=> $beneficiario19, 	
			 				'beneficiario_29'  	=> $beneficiario29, 	
			 				'beneficiario_39'  	=> $beneficiario39, 	
			 				'beneficiario_49'  	=> $beneficiario49, 	
			 				'beneficiario_54'  	=> $beneficiario54, 	
			 				'beneficiario_59'  	=> $beneficiario59, 	
			 				'beneficiario_69'  	=> $beneficiario69, 	
			 				'beneficiario_75'  	=> $beneficiario75, 	
			 			);
			 			$this->crud->edit($data);

			 			if(isset($atencion) && $atencion != NULL){ $atencion_primaria = $atencion; }else{ $atencion_primaria = NULL; } 
			 			if(isset($vida) && $vida != NULL){ $vida = $vida; }else{ $vida = NULL;  }
			 			if(isset($ambulancia) && $ambulancia != NULL){ $ambulancia = $ambulancia; }else{ $ambulancia = NULL;  }
			 			if(isset($odontologia) && $odontologia != NULL){ $odontologia = $odontologia; }else{ $odontologia = NULL;  }
			 			if(isset($oftalmologia) && $oftalmologia != NULL){ $oftalmologia = $oftalmologia; }else{ $oftalmologia = NULL;  }
			 			if(isset($psicologia) && $psicologia != NULL){ $psicologia = $psicologia; }else{ $psicologia = NULL;  }
			 			if(isset($nutricion) && $nutricion != NULL){ $nutricion = $nutricion; }else{  $nutricion = NULL; }
			 			if(isset($fisioterapia) && $fisioterapia != NULL){ $fisioterapia = $fisioterapia; }else{  $fisioterapia = NULL; }
			 			if(isset($dermatologia) && $dermatologia != NULL){ $dermatologia = $dermatologia; }else{  $dermatologia = NULL; }
			 			if(isset($muerte) && $muerte != NULL){ $muerte_accidental = $muerte; }else{ $muerte_accidental = NULL;  }
			 			if(isset($invalidez) && $invalidez != NULL){ $invalidez_permanente = $invalidez; }else{ $invalidez_permanente = NULL;  }
			 			if(isset($orientacion) && $orientacion != NULL){ $orientacion_medica_tlf = $orientacion; }else{ $orientacion_medica_tlf = NULL;  }
			 			if(isset($bariatica) && $bariatica != NULL){ $cirugia_bariatica = $bariatica; }else{ $cirugia_bariatica = NULL;  }
			 			if(isset($profilactica) && $profilactica != NULL){ $cirugia_profilactica_cancer = $profilactica; }else{ $cirugia_profilactica_cancer = NULL;  }
			 			if(isset($congenita) && $congenita != NULL){ $condicion_congenita = $congenita; }else{ $condicion_congenita = NULL;  }
			 			if(isset($vih) && $vih != NULL){ $tratamiento_vih_sida = $vih; }else{  $tratamiento_vih_sida = NULL; }
			 			if(isset($transplante) && $transplante != NULL){ $transplante = $transplante; }else{ $transplante = NULL;  }
			 			if(isset($complicacionN) && $complicacionN != NULL){ $complicacion_nacimiento = $complicacionN; }else{ $complicacion_nacimiento = NULL;  }
			 			if(isset($complicacionM) && $complicacionM != NULL){ $complicacion_maternidad = $complicacionM; }else{ $complicacion_maternidad = NULL;  }


			 			$data = array(
		            		'table' => 'condiciones', 
		            		'where' => 'condiciones.id_plan = '.$id, 
		            	);
			 			$data['set'] = array(
			 				'tipo_servicio'			=> $tipo, 	
			 				'maternidad'  			=> $maternidad, 	
			 				'viaje_internacional'  	=> $viaje, 	
			 				'gastos_funerarios'  	=> $funerario,

			 				'atencion_primaria'  			=> $atencion_primaria, 	
			 				'vida'  						=> $vida, 	
			 				'ambulancia'  					=> $ambulancia, 	
			 				'odontologia'  					=> $odontologia, 	
			 				'oftalmologia'  				=> $oftalmologia, 	
			 				'psicologia'  					=> $psicologia, 	
			 				'nutricion'  					=> $nutricion, 	
			 				'fisioterapia'  				=> $fisioterapia, 	
			 				'dermatologia'  				=> $dermatologia, 	
			 				'muerte_accidental'  			=> $muerte_accidental, 	
			 				'invalidez_permanente'  		=> $invalidez_permanente, 	
			 				'orientacion_medica_tlf'  		=> $orientacion_medica_tlf, 	
			 				'cirugia_bariatica'  			=> $cirugia_bariatica, 	
			 				'cirugia_profilactica_cancer'	=> $cirugia_profilactica_cancer, 	
			 				'condicion_congenita'  			=> $condicion_congenita, 	
			 				'tratamiento_vih_sida'  		=> $tratamiento_vih_sida, 	
			 				'transplante'  					=> $transplante, 	
			 				'complicacion_nacimiento'  		=> $complicacion_nacimiento, 	
			 				'complicacion_maternidad'  		=> $complicacion_maternidad, 	
			 			);
			 			$this->crud->edit($data);
	
	            		$json = array(
				    		'respuesta' 	=> 'alert',
				    		'tipo' 			=> 'success',
				    		'texto' 		=> $plan.' actualizado exitosamente' ,
				    		'redirigir'  	=> base_url('planes')
				    	);
				    	echo json_encode($json);
	            	} 
	            	else 
	            	{
	            		$json = array(
				    		'respuesta' => 'toast',
				    		'tipo' 		=> 'error',
				    		'texto' 	=> 'Error al actualizar el plan'
				    	);
				    	echo json_encode($json);
	            	}	
				} 
				else 
				{
					echo json_encode($this->form_validation->error_array());
				}
 			}
		} 
		else 
		{
			show_404();
		}	
	}

}
