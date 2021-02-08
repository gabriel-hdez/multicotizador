<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cotizaciones extends CI_Controller {

	//	FUNCION PADRE CONSTRUCTURA, CARGA GLOBAL DE LIBRERIAS EN TODAS LAS FUNCIONES
	public function __construct()
	{
		parent::__construct();
		if ($_SESSION['login']['check'] == FALSE) { redirect(base_url()); }
		$this->load->library('cart');
		$_SESSION['alert'] = NULL;
		$this->load->library("udp_cart");//load library
    	$this->shop1 = new Udp_cart("shop1");
		//$this->load->library('pdf');
	}

	//	FUNCION POR DEFECTO, CARGA LISTADO DE aseguradoras
	public function index()
	{
		if ($_SESSION['login']['rol'] == 'Usuario') 
		{ 
			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'cotizaciones',
			 	'order'  => 'id_cotizacion DESC',
			 	'where'  => 'id_usuario = "'.$_SESSION['login']['id'].'"',
			 	'return' => 'result', 
			);
			$cotizacion = $data['cotizaciones'] = $this->crud->read($data['data']);
		}
		else
		{
			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'cotizaciones',
			 	'order'  => 'id_cotizacion DESC',
			 	'join'   => array(
			 		'usuarios' => 'usuarios.id_usuario = cotizaciones.id_usuario',
			 	),
			 	//'where'  => 'estado = "1" AND id_usuario = "'.$_SESSION['login']['id'].'"',
			 	'return' => 'result', 
			);
			$cotizacion = $data['cotizaciones'] = $this->crud->read($data['data']);
		}
		
		$data['titulo'] = 'Listado de cotizaciones';
		$data['contenido'] = 'cotizaciones/listado';
		$this->load->view('render', $data);
	}

	public function nuevo()
	{
		$config['js'] = array('forms', 'datatables', 'search');
		$this->resources->initialize($config);

		if (!isset($_SESSION['titular'])){
			$_SESSION['titular']['dni'] 		= NULL;
 			$_SESSION['titular']['nombres'] 	= NULL;
 			$_SESSION['titular']['apellidos'] 	= NULL;
 			$_SESSION['titular']['correo'] 		= NULL;
 			$_SESSION['titular']['tlf'] 		= NULL;
 			$_SESSION['titular']['genero'] 		= NULL;
 			$_SESSION['titular']['nacimiento'] 	= NULL;
		}

		$data['data'] = array(
		 	'select' => '*', 
		 	'table'  => 'planes',
		 	'join'   => array(
		 		'aseguradoras' => 'aseguradoras.id_aseguradora = planes.id_aseguradora',
		 	),
		 	'order'  => 'id_plan DESC',
		 	'where'  => 'planes.estado = "1"',
		 	'return' => 'result', 
		);
		$data['planes'] = $this->crud->read($data['data']);

		/*$data['data'] = array(
		 	'select' => '*', 
		 	'table'  => 'beneficiarios',
		 	'join'   => array(
		 		'parentescos' => 'parentescos.id_beneficiario = beneficiarios.id_beneficiario',
		 	),
		 	//'order'  => 'id_beneficiario DESC',
		 	'where'  => 'estado = "0"',
		 	'return' => 'result', 
		);
		$data['beneficiarios'] = $this->crud->read($data['data']);*/

		$data['titulo'] = 'Nueva cotizacion';
		$data['contenido'] = 'cotizaciones/nuevo';


		switch ( $_SESSION['alert'] ) 
		{
			case 'add':
				$data['tipo'] ='success';
				$data['alert'] ='Item agregado exitosamente';
			break;
			case 'update':
				$data['tipo'] ='info';
				$data['alert'] ='Item actualizado exitosamente';
			break;
			case 'remove':
				$data['tipo'] ='info';
				$data['alert'] ='Item eliminado exitosamente';
			break;
			case 'delete':
				$data['tipo'] ='info';
				$data['alert'] ='Todos los items eliminados exitosamente';
			break;
			case 'valid_number':
				$data['tipo'] ='error';
				$data['alert'] ='Cantidad debe ser mayor que cero';
			break;
			case 'valid_stock':
				$data['tipo'] ='error';
				$data['alert'] ='Cantidad debe ser menor o igual a la existencial';
			break;
			default:
				//$data['alert'] ='Ha ocurrido un error';
			break;
		}

		$this->load->view('render', $data);
	}

	public function detalles($id)
	{
		$data['data'] = array(
		 	'select' => '*', 
		 	'table'  => 'planes',
		 	'join'   => array(
		 		'aseguradoras' => 'aseguradoras.id_aseguradora = planes.id_aseguradora',
		 		'primas' => 'primas.id_plan = planes.id_plan',
		 		'condiciones' => 'condiciones.id_plan = planes.id_plan',
		 	),
		 	'where'  => 'planes.id_plan = "'.$id.'"',
		 	'return' => 'row', 
		);
		$plan = $this->crud->read($data['data']);

		echo '<div class="modal-header">
        <h4 class="modal-title">'.$plan->plan.'</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12" align="center" style="margin-bottom: 2rem;">
             <img alt="logo"  src="'.base_url('app/files/aseguradoras/'.$plan->img).'" style="width: 250px; height: 250px; ">
          </div>
          <div class="form-group col-lg-6">
          	<label>Aseguradora</label>
            <input type="text" name="plan" id="plan" class="form-control" placeholder="Nombre del seguro : RIF" value="'.$plan->aseguradora.' : '.$plan->rif.'" disabled>
            <span id="plan-error" class="error invalid-feedback helper-text"></span>
          </div>
          <div class="form-group col-lg-6">
          	<label>Suma asegurada</label>
            <input type="text" name="suma" id="suma" class="form-control" placeholder="Suma asegurada (Ej. 1000.00)" value="'.number_format($plan->suma_asegurada ,2,',','.').'" disabled>
            <span id="suma-error" class="error invalid-feedback helper-text"></span>
          </div>
          <div class="form-group col-lg-6">
          	<label>Deducible nacional</label>
            <input type="text" name="Dnacional" id="Dnacional" class="form-control" placeholder="Deducible nacional (Ej. 1000.00)" value="'.number_format($plan->deducible_nacional ,2,',','.').'" disabled>
            <span id="Dnacional-error" class="error invalid-feedback helper-text"></span>
          </div>
          <div class="form-group col-lg-6">
          	<label>Deducible exterior</label>
            <input type="text" name="Dexterior" id="Dexterior" class="form-control" placeholder="Deducible exterior (Ej. 1000.00)" value="'.number_format($plan->deducible_exterior ,2,',','.').'" disabled>
            <span id="Dexterior-error" class="error invalid-feedback helper-text"></span>
          </div>
          <div class="form-group col-lg-6">
          	<label>Plazo</label>
            <input type="text" name="plazo" id="plazo" class="form-control" placeholder="Plazo en meses" value="'.$plan->plazo.' meses" disabled>
            <span id="plazo-error" class="error invalid-feedback helper-text"></span>
          </div>          
       
      <h4 class="col-lg-12">Primas por titular</h4>
          <div class="form-group col-lg-6">
          	<label>Monto para edades entre 0-9 años</label>
            <input type="text" name="titular9" id="titular9" class="form-control" value="'.$plan->titular_9.'" disabled>
            <span id="titular9-error" class="error invalid-feedback helper-text"></span>
          </div>
          <div class="form-group col-lg-6">
          	<label>Monto para edades entre 10-19 años</label>
            <input type="text" name="titular19" id="titular19" class="form-control" value="'.$plan->titular_19.'" disabled>
            <span id="titular19-error" class="error invalid-feedback helper-text"></span>
          </div>
          <div class="form-group col-lg-6">
          	<label>Monto para edades entre 20-29 años</label>
            <input type="text" name="titular29" id="titular29" class="form-control" value="'.$plan->titular_29.'" disabled>
            <span id="titular29-error" class="error invalid-feedback helper-text"></span>
          </div>
          <div class="form-group col-lg-6">
          	<label>Monto para edades entre 30-39 años</label>
            <input type="text" name="titular39" id="titular39" class="form-control" value="'.$plan->titular_39.'" disabled>
            <span id="titular39-error" class="error invalid-feedback helper-text"></span>
          </div>
          <div class="form-group col-lg-6">
          	<label>Monto para edades entre 40-49 años</label>
            <input type="text" name="titular49" id="titular49" class="form-control" value="'.$plan->titular_49.'" disabled>
            <span id="titular49-error" class="error invalid-feedback helper-text"></span>
          </div>
          <div class="form-group col-lg-6">
          	<label>Monto para edades entre 50-54 años</label>
            <input type="text" name="titular54" id="titular54" class="form-control" value="'.$plan->titular_54.'" disabled>
            <span id="titular54-error" class="error invalid-feedback helper-text"></span>
          </div>
          <div class="form-group col-lg-6">
          	<label>Monto para edades entre 55-59 años</label>
            <input type="text" name="titular59" id="titular59" class="form-control" value="'.$plan->titular_59.'" disabled>
            <span id="titular59-error" class="error invalid-feedback helper-text"></span>
          </div>
          <div class="form-group col-lg-6">
          	<label>Monto para edades entre 60-69 años</label>
            <input type="text" name="titular69" id="titular69" class="form-control" value="'.$plan->titular_69.'" disabled>
            <span id="titular69-error" class="error invalid-feedback helper-text"></span>
          </div>
          <div class="form-group col-lg-6">
          	<label>Monto para edades mayores de 70 años</label>
            <input type="text" name="titular75" id="titular75" class="form-control" value="'.$plan->titular_75.'" disabled>
            <span id="titular75-error" class="error invalid-feedback helper-text"></span>
          </div>

          <h4 class="col-lg-12">Primas por beneficiario</h4>
          <div class="form-group col-lg-6">
          	<label>Monto para edades entre 0-9 años</label>
            <input type="text" name="beneficiario9" id="beneficiario9" class="form-control"  value="'.$plan->beneficiario_9.'" disabled>
            <span id="beneficiario9-error" class="error invalid-feedback helper-text"></span>
          </div>
          <div class="form-group col-lg-6">
          	<label>Monto para edades entre 10-19 años</label>
            <input type="text" name="beneficiario19" id="beneficiario19" class="form-control"  value="'.$plan->beneficiario_19.'" disabled>
            <span id="beneficiario19-error" class="error invalid-feedback helper-text"></span>
          </div>
          <div class="form-group col-lg-6">
          	<label>Monto para edades entre 20-29 años</label>
            <input type="text" name="beneficiario29" id="beneficiario29" class="form-control"  value="'.$plan->beneficiario_29.'" disabled>
            <span id="beneficiario29-error" class="error invalid-feedback helper-text"></span>
          </div>
          <div class="form-group col-lg-6">
          	<label>Monto para edades entre 30-39 años</label>
            <input type="text" name="beneficiario39" id="beneficiario39" class="form-control"  value="'.$plan->beneficiario_39.'" disabled>
            <span id="beneficiario39-error" class="error invalid-feedback helper-text"></span>
          </div>
          <div class="form-group col-lg-6">
          	<label>Monto para edades entre 40-49 años</label>
            <input type="text" name="beneficiario49" id="beneficiario49" class="form-control"  value="'.$plan->beneficiario_49.'" disabled>
            <span id="beneficiario49-error" class="error invalid-feedback helper-text"></span>
          </div>
          <div class="form-group col-lg-6">
          	<label>Monto para edades entre 50-54 años</label>
            <input type="text" name="beneficiario54" id="beneficiario54" class="form-control"  value="'.$plan->beneficiario_54.'" disabled>
            <span id="beneficiario54-error" class="error invalid-feedback helper-text"></span>
          </div>
          <div class="form-group col-lg-6">
          	<label>Monto para edades entre 55-59 años</label>
            <input type="text" name="beneficiario59" id="beneficiario59" class="form-control"  value="'.$plan->beneficiario_59.'" disabled>
            <span id="beneficiario59-error" class="error invalid-feedback helper-text"></span>
          </div>
          <div class="form-group col-lg-6">
          	<label>Monto para edades entre 60-69 años</label>
            <input type="text" name="beneficiario69" id="beneficiario69" class="form-control"  value="'.$plan->beneficiario_69.'" disabled>
            <span id="beneficiario69-error" class="error invalid-feedback helper-text"></span>
          </div>
          <div class="form-group col-lg-6">
          	<label>Monto para edades mayores de 70 años</label>
            <input type="text" name="beneficiario75" id="beneficiario75" class="form-control"  value="'.$plan->beneficiario_75.'" disabled>
            <span id="beneficiario75-error" class="error invalid-feedback helper-text"></span>
          </div>
        </div>
      </div>
        ';      
	}

	public function carrito_agregar()
	{
		$keys_post = array_keys($this->input->post());
 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }

 		foreach ($IDplan as $key => $value) 
 		{ 
 			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'planes',
			 	'join'   => array(
		 			'aseguradoras'	=> 'aseguradoras.id_aseguradora = planes.id_aseguradora',
		 		), 
			 	'where'  => 'planes.id_plan = "'.$value.'"',  
			 	'return' => 'row', 
			);
			$plan = $this->crud->read($data['data']);

			$data = array(
	        	'id'    => $plan->id_plan,
		        'qty'   => 1,
		        'price' => $plan->suma_asegurada,
		        'name'  => $plan->plan,
		        'seguro'=> $plan->aseguradora,
		 	);
		 	$this->cart->insert($data);
 		}

		$_SESSION['alert'] = 'add';
		redirect('cotizaciones/nuevo');	
	}

	public function carrito_eliminar()
	{
		$keys_post = array_keys($this->input->post());
 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }
 		
 		foreach ($IDplan as $key => $value) {
 			$data = array(
		        'rowid'   => $value,
		        'qty'     => 0,
		 	);
		 	$this->cart->update($data);
 		}

	 	$_SESSION['alert'] = 'remove';
	 	redirect('cotizaciones/nuevo');
	}

	public function titular_buscar()
	{
		$keys_post = array_keys($this->input->post());
 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }

 		$data['data'] = array(
		 	'select' => '*', 
		 	'table'  => 'cotizaciones', 
		 	'where'  => 'cotizaciones.dni = "'.$buscar.'"',  
		 	'return' => 'row', 
		);
		$titular = $this->crud->read($data['data']);

		if ($titular != NULL) 
		{
			$json = array(
	    		'nombres'      		=> $titular->nombres, 
	    		'apellidos'   		=> $titular->apellidos, 
	    		'tlf'         		=> $titular->tlf, 
	    		'correo'      		=> $titular->correo, 
	    		'genero'      		=> $titular->genero, 
	    		'datepicker'  		=> $titular->nacimiento, 
	    	);
		}
		else
		{
			$json = array(
	    		'correo'      => '', 
	    		'nombres'     => '', 
	    		'apellidos'   => '', 
	    		'tlf'         => '', 
	    		'datepicker'  => '', 
	    		'genero'  	  => '', 
	    		'inexistente'  => 'Puedes registrar este beneficiario', 
	    	); 
		}
    	echo json_encode($json);
	}

	public function titular()
	{
		if ($this->input->is_ajax_request()) 
		{
			$keys_post = array_keys($this->input->post());
	 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }

	 		if ($this->form_validation->run('titular') == TRUE) 
	 		{
	 			$_SESSION['titular']['dni'] 		= $dni;
	 			$_SESSION['titular']['nombres'] 	= $nombres;
	 			$_SESSION['titular']['apellidos'] 	= $apellidos;
	 			$_SESSION['titular']['correo'] 		= $correo;
	 			$_SESSION['titular']['tlf'] 		= $tlf;
	 			$_SESSION['titular']['genero'] 		= $genero;
	 			$_SESSION['titular']['nacimiento'] 	= $nacimiento;

	 			$json = array(
            		'respuesta' => 'toast', 
            		'tipo'  	=> 'success',
            		'texto'     => 'Titular agregado exitosamente',  
            		//'redirigir'  => base_url('cotizaciones/nuevo') 
            	);
            	echo json_encode($json);
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

	public function procesar()
	{
		if ($this->input->is_ajax_request()) 
		{
			$keys_post = array_keys($this->input->post());
	 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }
	 		
	 		/*if ($this->form_validation->run('beneficiarios') == TRUE) 
	 		{*/   
	 			if($this->cart->total_items() > 0)
	 			{              
					$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
					$codigo = substr(str_shuffle($permitted_chars), 0, 10);

		 			$data['data'] = array( 
		 				'id_usuario'  		=> $_SESSION['login']['id'], 
		 				'codigo'  			=> $codigo, 
		 				'nombres'   		=> $_SESSION['titular']['nombres'], 
		 				'apellidos'        	=> $_SESSION['titular']['apellidos'], 
		 				'dni'       		=> $_SESSION['titular']['dni'],  
		 				'genero'   			=> $_SESSION['titular']['genero'], 
		 				'tlf'   			=> $_SESSION['titular']['tlf'], 
		 				'correo'        	=> $_SESSION['titular']['correo'], 
		 				'nacimiento'       	=> $_SESSION['titular']['nacimiento'] 
		 			);
		 			$data['table'] = 'cotizaciones';

		 			if ($this->crud->create($data) == TRUE) 
		 			{
		 				$data = array(
							'select' => 'id_cotizacion, codigo', 
							'table'  => 'cotizaciones', 
							'where'  => 'cotizaciones.codigo = "'.$codigo.'"', 
							'return' => 'row'
						);
						$cotizacion = $this->crud->read($data);

						foreach ($this->cart->contents() as $items) 
						{
							$data['data'] = array(
				 				'id_cotizacion'  	=> $cotizacion->id_cotizacion, 
				 				'id_plan' 			=> $items['id'], 
				 				//'requerido'    		=> $items['qty'], 
				 			);
				 			$data['table'] = 'detalles_cotizacion';
				 			$this->crud->create($data);
				 		}

				 		if ($this->shop1->get_content() != NULL) 
				 		{
					 		foreach ($this->shop1->get_content() as $beneficiario) 
					 		{
								$data['data'] = array( 
					 				'id_cotizacion'		=> $cotizacion->id_cotizacion,  
					 				'dni'       		=> $beneficiario['options']['Bdni'],  
					 				'nombres'   		=> $beneficiario['options']['Bnombres'], 
					 				'apellidos'        	=> $beneficiario['options']['Bapellidos'], 
					 				'genero'   			=> $beneficiario['options']['Bgenero'], 
					 				'tlf'   			=> $beneficiario['options']['Btlf'], 
					 				'correo'        	=> $beneficiario['options']['Bcorreo'], 
					 				'nacimiento'       	=> $beneficiario['options']['Bnacimiento'], 
					 				'parentesco'       	=> $beneficiario['options']['Bparentesco'], 
					 			);
					 			$data['table'] = 'beneficiarios';
					 			$this->crud->create($data);
					 		}
				 		}
						unset($_SESSION['titular']);
				 		$this->cart->destroy();
				 		$this->shop1->destroy();

		 				$json = array(
		            		'respuesta' => 'alert', 
		            		'tipo'  	=> 'success',
		            		'texto'     => '¡Cotizacion procesada exitosamente!',  
		            		'redirigir'  => base_url('cotizaciones/visualizar/'.$cotizacion->id_cotizacion) 
		            	);
		            	echo json_encode($json);
			 				 			
		 			} 
		 			else 
		 			{
		 				$json = array(
			            	'respuesta' => 'toast',  
			            	'tipo'      => 'error',  
			            	'texto'     => 'Ops! Error al crear cotizacion' 
			            );
			            echo json_encode($json);
		 			}
		 		}
	 			else 
				{
					$json = array(
		            	'respuesta' => 'toast',  
		            	'tipo'      => 'error',  
		            	'texto'     => 'Debe agregar algun plan para crear la cotizacion' 
		            );
		            echo json_encode($json);
				}
	 		/*} 
	 		else 
	 		{
	 			echo json_encode($this->form_validation->error_array());
	 		}*/
		} 
		else 
		{
			show_404();
		}
	}

	public function visualizar($id)
	{
		$data['data'] = array(
		 	'select' => '*', 
		 	'table'  => 'cotizaciones',
		 	'where'  => 'cotizaciones.id_cotizacion = "'.$id.'"',
		 	'return' => 'row', 
		);
		$data['cotizacion'] = $this->crud->read($data['data']);

		$data['data'] = array(
		 	'select' => '* , COUNT(detalles_cotizacion.id_plan) AS contador', 
		 	'table'  => 'detalles_cotizacion',
		 	'join'   => array(
		 		'planes'	=> 'planes.id_plan = detalles_cotizacion.id_plan',
		 		'aseguradoras'	=> 'aseguradoras.id_aseguradora = planes.id_aseguradora',
		 	),
		 	'where'  => 'detalles_cotizacion.id_cotizacion = "'.$id.'" GROUP BY aseguradoras.id_aseguradora ORDER BY aseguradoras.id_aseguradora',
		 	'return' => 'result', 
		);
		$data['aseguradoras'] = $this->crud->read($data['data']);

		$data['data'] = array(
		 	'select' => '*', 
		 	'table'  => 'detalles_cotizacion',
		 	'join'   => array(
		 		'planes'	=> 'planes.id_plan = detalles_cotizacion.id_plan',
		 		'primas'	=> 'planes.id_plan = primas.id_plan',
		 		'condiciones'	=> 'planes.id_plan = condiciones.id_plan',
		 	),
		 	'where'  => 'detalles_cotizacion.id_cotizacion = "'.$id.'" ORDER BY planes.id_aseguradora',
		 	'return' => 'result', 
		);
		$data['planes'] = $this->crud->read($data['data']);
		
		$data['data'] = array(
		 	'select' => '*', 
		 	'table'  => 'cotizaciones',
		 	'where'  => 'cotizaciones.id_cotizacion = "'.$id.'"',
		 	'return' => 'row', 
		);
		$cotizacion = $data['titular'] = $this->crud->read($data['data']);

		$data['data'] = array(
		 	'select' => '*', 
		 	'table'  => 'beneficiarios',
		 	'where'  => 'beneficiarios.id_cotizacion = "'.$cotizacion->id_cotizacion.'"',
		 	'return' => 'result', 
		);
		$data['beneficiarios'] = $this->crud->read($data['data']);


		$data['titulo'] = '';
		$data['contenido'] = 'cotizaciones/visualizar';
		$this->load->view('render', $data);
	}

	public function estado($id)
	{
		$config['js'] = array('forms');
		$this->resources->initialize($config);

		$data['data'] = array(
		 	'select' => '*', 
		 	'table'  => 'cotizaciones',
		 	'where'  => 'cotizaciones.id_cotizacion = "'.$id.'"',
		 	'return' => 'row', 
		);
		$cotizacion = $data['cotizacion'] = $this->crud->read($data['data']);

		$data['data'] = array(
		 	'select' => '* , COUNT(detalles_cotizacion.id_plan) AS contador', 
		 	'table'  => 'detalles_cotizacion',
		 	'join'   => array(
		 		'planes'	=> 'planes.id_plan = detalles_cotizacion.id_plan',
		 		'aseguradoras'	=> 'aseguradoras.id_aseguradora = planes.id_aseguradora',
		 	),
		 	'where'  => 'detalles_cotizacion.id_cotizacion = "'.$id.'" GROUP BY aseguradoras.id_aseguradora ORDER BY aseguradoras.id_aseguradora',
		 	'return' => 'result', 
		);
		$data['aseguradoras'] = $this->crud->read($data['data']);

		$data['data'] = array(
		 	'select' => '*', 
		 	'table'  => 'detalles_cotizacion',
		 	'join'   => array(
		 		'planes'	=> 'planes.id_plan = detalles_cotizacion.id_plan',
		 		'primas'	=> 'planes.id_plan = primas.id_plan',
		 		'condiciones'	=> 'planes.id_plan = condiciones.id_plan',
		 	),
		 	'where'  => 'detalles_cotizacion.id_cotizacion = "'.$id.'" ORDER BY planes.id_aseguradora',
		 	'return' => 'result', 
		);
		$data['planes'] = $this->crud->read($data['data']);
		
		$data['data'] = array(
		 	'select' => '*', 
		 	'table'  => 'cotizaciones',
		 	'where'  => 'cotizaciones.id_cotizacion = "'.$id.'"',
		 	'return' => 'row', 
		);
		$data['titular'] = $this->crud->read($data['data']);

		$data['data'] = array(
		 	'select' => '*', 
		 	'table'  => 'beneficiarios',
		 	'join'   => array(
		 		'parentescos'	=> 'beneficiarios.id_beneficiario = parentescos.id_beneficiario',
		 	),
		 	'where'  => 'parentescos.id_cotizacion = "'.$cotizacion->id_cotizacion.'"',
		 	'return' => 'result', 
		);
		$data['beneficiarios'] = $this->crud->read($data['data']);

		$data['titulo'] = '';
		$data['contenido'] = 'cotizaciones/eliminar';
		$this->load->view('render', $data);
	}

	public function actualizar()
	{
		if ($this->input->is_ajax_request()) 
		{
			$keys_post = array_keys($this->input->post());
 			foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }

 			if ($estado == "1") 
 				{
 	 				$data = array(
			    		'table'  => 'cotizaciones', 
			    		'where'  => 'cotizaciones.id_cotizacion = "'.$id.'"',
			    	);
			    	$data['set'] = array(
		 				'estado'   => '0', 
		 			);
			    	if ($this->crud->edit($data) == TRUE) 
	            	{
	            		$json = array(
				    		'respuesta' 	=> 'alert',
				    		'tipo' 			=> 'success',
				    		'texto' 		=> 'Cotizacion anulada exitosamente' ,
				    		'redirigir'  	=> base_url('cotizaciones')
				    	);
				    	echo json_encode($json);
	            	} 
	            	else 
	            	{
	            		$json = array(
				    		'respuesta' => 'toast',
				    		'tipo' 		=> 'error',
				    		'texto' 	=> 'Error al eliminar la cotizacion'
				    	);
				    	echo json_encode($json);
	            	}	
 				} 
 				else 
 				{
 					$data = array(
			    		'table'  => 'cotizaciones', 
			    		'where'  => 'cotizaciones.id_cotizacion = "'.$id.'"',
			    	);
			    	$data['set'] = array(
		 				'estado'   => '1', 
		 			);
			    	if ($this->crud->edit($data) == TRUE) 
	            	{
	            		$json = array(
				    		'respuesta' 	=> 'alert',
				    		'tipo' 			=> 'success',
				    		'texto' 		=> 'Cotizacion restaurada exitosamente' ,
				    		'redirigir'  	=> base_url('cotizaciones')
				    	);
				    	echo json_encode($json);
	            	} 
	            	else 
	            	{
	            		$json = array(
				    		'respuesta' => 'toast',
				    		'tipo' 		=> 'error',
				    		'texto' 	=> 'Error al restaurar la cotizacion'
				    	);
				    	echo json_encode($json);
	            	}
 				}
		}
		else
		{
			show_404();
		}
	}



}
