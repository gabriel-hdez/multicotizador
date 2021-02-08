<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	//	FUNCION PADRE CONSTRUCTURA, CARGA GLOBAL DE LIBRERIAS EN TODAS LAS FUNCIONES
	public function __construct()
	{
		parent::__construct();
		if ($_SESSION['login']['check'] == FALSE) { redirect(base_url()); }
	}

	//	FUNCION POR DEFECTO, CARGA LISTADO DE USUARIOS
	public function index()
	{
		if ($_SESSION['login']['rol'] == 'Usuario') { redirect(base_url('inicio/bienvenido')); }

		$data['data'] = array(
		 	'select' => '*', 
		 	'table'  => 'usuarios', 
		 	'order'  => 'id_usuario DESC',
		 	'return' => 'result', 
		);
		$data['usuarios'] = $this->crud->read($data['data']);

		$data['titulo'] = 'Listado de usuarios';
		//$data['breadcrumbs'] = array('Listado de usuarios' => 'usuarios' );
		$data['contenido'] = 'usuarios/listado';
		$this->load->view('render', $data);
	}

	public function nuevo()
	{
		if ($_SESSION['login']['rol'] == 'Usuario') { redirect(base_url('inicio/bienvenido')); }

		$config['js'] = array('forms');
		$this->resources->initialize($config);

		$data['titulo'] = 'Nuevo usuario';
		$data['contenido'] = 'usuarios/nuevo';
		$this->load->view('render', $data);
	}

	public function guardar()
	{
		if ($this->input->is_ajax_request()) 
		{
			$keys_post = array_keys($this->input->post());
	 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }
	 		
	 		// VALIDA DATOS DEL USUARIO
	 		if ($this->form_validation->run('usuarios') == TRUE) 
	 		{
	 			$data['data'] = array(
	 				'id_rol'    => 2, 
	 				'nombre'    => $nombre, 
	 				'correo'    => $correo,  
	 				'clave'     => $this->encryption->encrypt($clave), 
	 				'pregunta'  => $this->encryption->encrypt($pregunta), 
	 				'respuesta' => $this->encryption->encrypt($respuesta), 
	 			);
	 			$data['table'] = 'usuarios';

	 			if ($this->crud->create($data) == TRUE) 
	 			{
	 				$json = array(
	            		'respuesta' => 'alert', 
	            		'tipo'  	=> 'success',
	            		'texto'     => '¡Usuario '.$nombre.', creado exitosamente!',  
	            		'redirigir'  => base_url('usuarios') 
	            	);
	            	echo json_encode($json);
	 			} 
	 			else 
	 			{
					$json = array(
		            	'respuesta' => 'toast',  
		            	'tipo'      => 'error',  
		            	'texto'     => 'Ops! Error al crear el usuario' 
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
		 	'table'  => 'usuarios', 
		 	'where'  => 'usuarios.id_usuario = '.$id, 
		 	//'order'  => 'id_usuario DESC',
		 	'return' => 'row', 
		);
		$data['usuario'] = $this->crud->read($data['data']);

		$data['titulo'] = 'Editar usuario';
		$data['contenido'] = 'usuarios/editar';
		$this->load->view('render', $data);
	}

	public function eliminar($id)
	{
		if ($_SESSION['login']['rol'] == 'Usuario') { redirect(base_url('inicio/bienvenido')); }
		
		$config['js'] = array('forms');
		$this->resources->initialize($config);

		$data['data'] = array(
		 	'select' => '*', 
		 	'table'  => 'usuarios', 
		 	'where'  => 'usuarios.id_usuario = '.$id, 
		 	//'order'  => 'id_usuario DESC',
		 	'return' => 'row', 
		);
		$data['usuario'] = $this->crud->read($data['data']);

		$data['titulo'] = 'Eliminar usuario';
		$data['contenido'] = 'usuarios/eliminar';
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
 				$data = array(
		    		'table'  => 'usuarios', 
		    		'where'  => 'usuarios.id_usuario = "'.$id.'"',
		    	);
		    	if ($this->crud->erase($data) == TRUE) 
            	{
            		$json = array(
			    		'respuesta' 	=> 'alert',
			    		'tipo' 			=> 'success',
			    		'texto' 		=> 'Usuario eliminado exitosamente' ,
			    		'redirigir'  	=> base_url('usuarios')
			    	);
			    	echo json_encode($json);
            	} 
            	else 
            	{
            		$json = array(
			    		'respuesta' => 'toast',
			    		'tipo' 		=> 'error',
			    		'texto' 	=> 'Error al eliminar el usuario'
			    	);
			    	echo json_encode($json);
            	}	
 			} 
 			// sino el token es editar
 			else 
 			{
				if ($this->form_validation->run('usuarios_editar') == TRUE) 
				{
		 			// se valida que la cedula sea unica pero igual a la existente
		 			$data = array(
			    		'select' => '*', 
			    		'table'  => 'usuarios', 
			    		'where'  => 'usuarios.correo ="'.$correo.'" AND usuarios.id_usuario <> "'.$id.'"',
			    		'return'  => 'check'
			    	);
			    	if ($this->crud->read($data) == TRUE)
			    	{
			    		$json = array('correo' => 'El correo '.$correo.' ya existe');
	            		echo json_encode($json);
			    	}
			    	else
			    	{
				    		// se setean los datos para actualizar el usuario
		    			$data = array(
		            		'table' => 'usuarios', 
		            		'where' => 'usuarios.id_usuario = '.$id, 
		            	);
		            	if ($clave != NULL) {
			            	$data['set'] = array(
			            		'nombre' 	=> $nombre,
			            		'correo' 	=> $correo,
			            		'pregunta'  => $this->encryption->encrypt($pregunta), 
		 						'respuesta' => $this->encryption->encrypt($respuesta), 
		 						'clave' 	=> $this->encryption->encrypt($clave), 
			            	);
		            	} else {
		            		$data['set'] = array(
			            		'nombre' 	=> $nombre,
			            		'correo' 	=> $correo,
			            		'pregunta'  => $this->encryption->encrypt($pregunta), 
		 						'respuesta' => $this->encryption->encrypt($respuesta), 
			            	);
		            	}
		            	
		            	if ($this->crud->edit($data) == TRUE) 
		            	{
		            		$json = array(
					    		'respuesta' 	=> 'alert',
					    		'tipo' 			=> 'success',
					    		'texto' 		=> 'Usuario '.$nombre.' actualizado exitosamente' ,
					    		'redirigir'  	=> base_url('usuarios')
					    	);
					    	echo json_encode($json);
		            	} 
		            	else 
		            	{
		            		$json = array(
					    		'respuesta' => 'toast',
					    		'tipo' 		=> 'error',
					    		'texto' 	=> 'Error al actualizar el usuario'
					    	);
					    	echo json_encode($json);
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
