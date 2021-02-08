<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

	//	FUNCION PADRE CONSTRUCTURA, CARGA GLOBAL DE LIBRERIAS EN TODAS LAS FUNCIONES
	public function __construct()
	{
		parent::__construct();
		if ($_SESSION['login']['check'] == FALSE) { redirect(base_url()); }
	}

	//	FUNCION POR DEFECTO, CARGA LISTADO DE USUARIOS
	public function index()
	{
		$config['js'] = array('forms');
		$this->resources->initialize($config);
		// se consultan los usuarios
		$data['data'] = array(
		 	'select' => '*', 
		 	'table'  => 'usuarios', 
		 	'where'  => 'usuarios.id_usuario = '.$_SESSION['login']['id'], 
		 	'return' => 'row', 
		);
		$usuario = $data['usuario'] = $this->crud->read($data['data']);

		$data['titulo'] = 'Editar mis datos';
		$data['contenido'] = 'usuario/editar';
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
					    		'texto' 		=> 'Datos actualizados exitosamente, se cerrara sesion por seguridad' ,
					    		'redirigir'  	=> base_url('inicio/logout')
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
