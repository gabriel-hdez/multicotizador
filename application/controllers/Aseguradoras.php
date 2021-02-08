<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aseguradoras extends CI_Controller {

	//	FUNCION PADRE CONSTRUCTURA, CARGA GLOBAL DE LIBRERIAS EN TODAS LAS FUNCIONES
	public function __construct()
	{
		parent::__construct();
		if ($_SESSION['login']['check'] == FALSE) { redirect(base_url()); }
	}

	//	FUNCION POR DEFECTO, CARGA LISTADO DE aseguradoras
	public function index()
	{
		// verificar duplicidad de imagenes de las aseguradoras
		/*$this->load->helper('file');
		$imagenes = get_filenames('./app/files/aseguradoras/');*/
		if ($_SESSION['login']['rol'] == 'Usuario') { redirect(base_url('inicio/bienvenido')); }

		$data['data'] = array(
		 	'select' => '*', 
		 	'table'  => 'aseguradoras', 
		 	'order'  => 'aseguradora ASC',
		 	//'where'  => 'estado_aseguradora = "1"',
		 	'return' => 'result', 
		);
		$data['aseguradoras'] = $this->crud->read($data['data']);

		$data['titulo'] = 'Listado de aseguradoras';
		$data['contenido'] = 'aseguradoras/listado';
		$this->load->view('render', $data);
	}

	public function nuevo()
	{
		if ($_SESSION['login']['rol'] == 'Usuario') { redirect(base_url('inicio/bienvenido')); }

		$config['js'] = array('forms');
		$this->resources->initialize($config);

		$data['titulo'] = 'Nueva aseguradora';
		$data['contenido'] = 'aseguradoras/nuevo';
		$this->load->view('render', $data);
	}

	public function guardar()
	{
		if ($this->input->is_ajax_request()) 
		{
			$keys_post = array_keys($this->input->post());
	 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }
	 		
	 		if ($this->form_validation->run('aseguradoras') == TRUE) 
	 		{
                $this->load->library('upload'); 
	 			$config['upload_path']          = './app/files/aseguradoras/';
                $config['allowed_types']        = 'gif|jpg|png';
                //$config['max_size']             = 100;
                $this->upload->initialize($config);

                if ($this->upload->do_upload('imagen'))
                {

                    $data['upload_data'] = $this->upload->data();
                     
		 			$data['data'] = array(
		 				'aseguradora'   => $aseguradora, 
		 				'rif'        	=> $rif, 
		 				'tlf'        	=> $tlf,  
		 				'correo'     	=> $correo, 
		 				'img'        	=> $data['upload_data']['file_name'] 
		 			);
		 			$data['table'] = 'aseguradoras';

		 			if ($this->crud->create($data) == TRUE) 
		 			{
		 				$json = array(
		            		'respuesta' => 'alert', 
		            		'tipo'  	=> 'success',
		            		'texto'     => '¡Aseguradora '.$aseguradora.', creada exitosamente!',  
		            		'redirigir'  => base_url('aseguradoras') 
		            	);
		            	echo json_encode($json);
		 			} 
		 			else 
		 			{
						$json = array(
			            	'respuesta' => 'toast',  
			            	'tipo'      => 'error',  
			            	'texto'     => 'Ops! Error al crear la aseguradora' 
			            );
			            echo json_encode($json);
		 			}

                }
                else
                {
                    $json = array(
		            	'respuesta' => 'toast',  
		            	'tipo'      => 'error',  
		            	'texto'     => 'Ops! Error al subir imagen de aseguradora' 
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
		 	'where'  => 'aseguradoras.id_aseguradora = '.$id, 
		 	'return' => 'row', 
		);
		$data['aseguradora'] = $this->crud->read($data['data']);

		$data['titulo'] = 'Editar aseguradora';
		$data['contenido'] = 'aseguradoras/editar';
		$this->load->view('render', $data);
	}

	public function eliminar($id)
	{
		if ($_SESSION['login']['rol'] == 'Usuario') { redirect(base_url('inicio/bienvenido')); }
		
		$config['js'] = array('forms');
		$this->resources->initialize($config);

		$data['data'] = array(
		 	'select' => '*', 
		 	'table'  => 'aseguradoras', 
		 	'where'  => 'aseguradoras.id_aseguradora = '.$id, 
		 	//'order'  => 'id_usuario DESC',
		 	'return' => 'row', 
		);
		$aseguradora = $data['aseguradora'] = $this->crud->read($data['data']);

		if ($aseguradora->estado_aseguradora == "1") {
		  $data['estado'] = 'Eliminar';
		} else {
		  $data['estado'] = 'Restaurar';
		}

		$data['titulo'] = $data['estado'].' aseguradora';
		$data['contenido'] = 'aseguradoras/eliminar';
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
			    		'table'  => 'aseguradoras', 
			    		'where'  => 'aseguradoras.id_aseguradora = "'.$id.'"',
			    	);
			    	$data['set'] = array(
		 				'estado_aseguradora'   => '0', 
		 			);
			    	if ($this->crud->edit($data) == TRUE) 
	            	{
	            		$json = array(
				    		'respuesta' 	=> 'alert',
				    		'tipo' 			=> 'success',
				    		'texto' 		=> 'Aseguradora eliminada exitosamente' ,
				    		'redirigir'  	=> base_url('aseguradoras')
				    	);
				    	echo json_encode($json);
	            	} 
	            	else 
	            	{
	            		$json = array(
				    		'respuesta' => 'toast',
				    		'tipo' 		=> 'error',
				    		'texto' 	=> 'Error al eliminar la aseguradora'
				    	);
				    	echo json_encode($json);
	            	}	
 				} 
 				else 
 				{
 					$data = array(
			    		'table'  => 'aseguradoras', 
			    		'where'  => 'aseguradoras.id_aseguradora = "'.$id.'"',
			    	);
			    	$data['set'] = array(
		 				'estado_aseguradora'   => '1', 
		 			);
			    	if ($this->crud->edit($data) == TRUE) 
	            	{
	            		$json = array(
				    		'respuesta' 	=> 'alert',
				    		'tipo' 			=> 'success',
				    		'texto' 		=> 'Aseguradora restaurada exitosamente' ,
				    		'redirigir'  	=> base_url('aseguradoras')
				    	);
				    	echo json_encode($json);
	            	} 
	            	else 
	            	{
	            		$json = array(
				    		'respuesta' => 'toast',
				    		'tipo' 		=> 'error',
				    		'texto' 	=> 'Error al restaurar la aseguradora'
				    	);
				    	echo json_encode($json);
	            	}
 				}
 				
 			} 
 			// sino el token es editar
 			else 
 			{
				if ($this->form_validation->run('aseguradoras_editar') == TRUE) 
				{
		 			// se valida que la cedula sea unica pero igual a la existente
		 			$data = array(
			    		'select' => '*', 
			    		'table'  => 'aseguradoras', 
			    		'where'  => 'aseguradoras.aseguradora ="'.$aseguradora.'" AND aseguradoras.id_aseguradora <> "'.$id.'"',
			    		'return'  => 'check'
			    	);
			    	if ($this->crud->read($data) == TRUE)
			    	{
			    		$json = array('aseguradora' => 'La aseguradora '.$aseguradora.' ya existe');
	            		echo json_encode($json);
			    	}
			    	else
			    	{
			    		$data = array(
				    		'select' => '*', 
				    		'table'  => 'aseguradoras', 
				    		'where'  => 'aseguradoras.rif ="'.$rif.'" AND aseguradoras.id_aseguradora <> "'.$id.'"',
				    		'return'  => 'check'
				    	);
			    		if ($this->crud->read($data) == TRUE) {
			    			$json = array('rif' => 'El RIF '.$rif.' ya existe');
	            			echo json_encode($json);
			    		} 
			    		else 
			    		{
					    	// se setean los datos para actualizar el usuario
			    			$data = array(
			            		'table' => 'aseguradoras', 
			            		'where' => 'aseguradoras.id_aseguradora = '.$id, 
			            	);
			            	if ($imagenActual == '') {
			            		// sin imagen
				            	$data['set'] = array(
					 				'aseguradora'   => $aseguradora, 
					 				'rif'        	=> $rif, 
					 				'tlf'        	=> $tlf,  
					 				'correo'     	=> $correo, 
					 				//'img'        	=> $data['upload_data']['file_name'] 
					 			);
					 			if ($this->crud->edit($data) == TRUE) 
				            	{
				            		$json = array(
							    		'respuesta' 	=> 'alert',
							    		'tipo' 			=> 'success',
							    		'texto' 		=> 'Aseguradora '.$aseguradora.' actualizada exitosamente' ,
							    		'redirigir'  	=> base_url('aseguradoras')
							    	);
							    	echo json_encode($json);
				            	} 
				            	else 
				            	{
				            		$json = array(
							    		'respuesta' => 'toast',
							    		'tipo' 		=> 'error',
							    		'texto' 	=> 'Error al actualizar la aseguradora'
							    	);
							    	echo json_encode($json);
				            	}
			            	} 
			            	else 
			            	{
			            		// con imagen
			            		$this->load->library('upload'); 
					 			$config['upload_path']          = './app/files/aseguradoras/';
				                $config['allowed_types']        = 'gif|jpg|png';
				                //$config['max_size']             = 100;
				                $this->upload->initialize($config);

				                if ($this->upload->do_upload('imagen'))
				                {

				                    $data['upload_data'] = $this->upload->data();
				                     
						 			$data['set'] = array(
						 				'aseguradora'   => $aseguradora, 
						 				'rif'        	=> $rif, 
						 				'tlf'        	=> $tlf,  
						 				'correo'     	=> $correo, 
						 				'img'        	=> $data['upload_data']['file_name'] 
						 			);

						 			if ($this->crud->edit($data) == TRUE) 
					            	{
					            		$json = array(
								    		'respuesta' 	=> 'alert',
								    		'tipo' 			=> 'success',
								    		'texto' 		=> 'Aseguradora '.$aseguradora.' actualizada exitosamente' ,
								    		'redirigir'  	=> base_url('aseguradoras')
								    	);
								    	echo json_encode($json);
					            	} 
					            	else 
					            	{
					            		$json = array(
								    		'respuesta' => 'toast',
								    		'tipo' 		=> 'error',
								    		'texto' 	=> 'Error al actualizar la aseguradora'
								    	);
								    	echo json_encode($json);
					            	}

				                }
				                else
				                {
				                    $json = array(
						            	'respuesta' => 'toast',  
						            	'tipo'      => 'error',  
						            	'texto'     => 'Ops! Error al subir imagen de aseguradora' 
						            );
						            echo json_encode($json);
				                }		            		
			            	}	
			    		}
			    		
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
