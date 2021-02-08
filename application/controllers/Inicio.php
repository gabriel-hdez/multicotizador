<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$config['js'] = array('forms');
		$this->resources->initialize($config);
		$this->load->view('inicio/login');
	}

	//	INICIAR SESION
	public function login()
	{

		if ($this->input->is_ajax_request()) 
		{
			$keys_post = array_keys($this->input->post());
	 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }

	 		if ($this->form_validation->run('login') == TRUE)
	        {
	        	$data = array('correo' => $correo);
	        	
        		$login = $this->crud->login($data);

        		if($login == TRUE)
        		{
	        		if ($clave == $this->encryption->decrypt($login->clave)) 
	        		{
	        			$_SESSION['login']['check']   = TRUE ;
	        			$_SESSION['login']['rol']     = $login->rol ;
	        			$_SESSION['login']['usuario'] = $login->nombre;
	        			$_SESSION['login']['correo']  = $login->correo ;
	        			$_SESSION['login']['id']      = $login->id_usuario ;
	        			//$_SESSION['login']['avatar']  = $login->id_usuario ;
	        			$json = array(
				    		'respuesta' 	=> 'alert',
				    		'tipo' 			=> 'success',
				    		'texto' 		=> 'Bienvenido, '.$_SESSION['login']['usuario'],
				    		'redirigir'  	=> base_url('inicio/bienvenido')
				    	);
				    	echo json_encode($json);
	        		} 
	        		else 
	        		{
	        			$json = array(
				    		'texto' 	=> 'Verifique sus credenciales',
				    		'respuesta' => 'toast',
				    		'tipo' 		=> 'error',
				    	);
				    	echo json_encode($json);
	        		}        	
        		}
        		else
        		{
        			$json = array(
			    		'texto' 	=> 'Usuario deshabilitado, contacte un administrador',
			    		'respuesta' => 'toast',
			    		'tipo' 		=> 'error',
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

	//	CARGA BIENVENIDA AL SISTEMA
	public function bienvenido()
	{

		$data['titulo'] = '';
		$data['contenido'] = 'inicio/bienvenido';
		$this->load->view('render', $data);
	}

	//	CERRAR SESION
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url());	
	}
}
