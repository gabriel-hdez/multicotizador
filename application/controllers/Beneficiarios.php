<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beneficiarios extends CI_Controller {

	//	FUNCION PADRE CONSTRUCTURA, CARGA GLOBAL DE LIBRERIAS EN TODAS LAS FUNCIONES
	public function __construct()
	{
		parent::__construct();
		if ($_SESSION['login']['check'] == FALSE) { redirect(base_url()); }
		$this->load->library("udp_cart");//load library
    	$this->shop1 = new Udp_cart("shop1");

	}

	/*public function guardar()
	{
		if ($this->input->is_ajax_request()) 
		{
			$keys_post = array_keys($this->input->post());
	 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }
	 		
	 		if ($this->form_validation->run('beneficiarios') == TRUE) 
	 		{
	 			$data = array(
			    	'select' => '*', 
		    		'table'  => 'beneficiarios', 
		    		'where'  => 'beneficiarios.dni ="'.$Bdni.'"',
		    		'return'  => 'check'
		    	);
		    	if ($this->crud->read($data) == TRUE)
		    	{
		    		$data = array(
						'select' => 'id_beneficiario, dni', 
						'table'  => 'beneficiarios', 
						'where'  => 'beneficiarios.dni = "'.$Bdni.'"', 
						'return' => 'row'
					);
					$beneficiario = $this->crud->read($data);
					$data['data'] = array( 
		 				'id_beneficiario'   => $beneficiario->id_beneficiario, 
		 				'id_cotizacion'   	=> 0, 
		 				'parentesco'    	=> $Bparentesco, 	
		 			);
		 			$data['table'] = 'parentescos';
		 			$this->crud->create($data);

		 			$data = array(
	            		'table' => 'beneficiarios', 
	            		'where' => 'beneficiarios.id_beneficiario = '.$beneficiario->id_beneficiario, 
	            	);
		 			$data['set'] = array(
		 				'estado'  	=> "0", 
		 			);
		 			$this->crud->edit($data);

	 				$json = array(
	            		'respuesta' => 'alert', 
	            		'tipo'  	=> 'success',
	            		'texto'     => '¡Beneficiario agregado exitosamente!',  
	            		'redirigir'  => base_url('cotizaciones/nuevo') 
	            	);
	            	echo json_encode($json);
		    	}
		    	else
		    	{
		 			$data['data'] = array( 
		 				'nombres'    	=> $Bnombres, 
		 				'apellidos'    	=> $Bapellidos, 
		 				'dni'    		=> $Bdni, 
		 				'genero'    	=> $Bgenero, 
		 				'tlf'    		=> $Btlf, 
		 				'correo'    	=> $Bcorreo,  
		 				'nacimiento'    => $Bnacimiento,  
		 				'estado'    	=> '0',  
		 			);
		 			$data['table'] = 'beneficiarios';

		 			if ($this->crud->create($data) == TRUE) 
		 			{
		 				$data = array(
							'select' => 'id_beneficiario, dni', 
							'table'  => 'beneficiarios', 
							'where'  => 'beneficiarios.dni = "'.$Bdni.'"', 
							'return' => 'row'
						);
						$beneficiario = $this->crud->read($data);

						$data['data'] = array( 
			 				'id_beneficiario'   => $beneficiario->id_beneficiario, 
			 				'id_cotizacion'   		=> 0, 
			 				'parentesco'    	=> $Bparentesco, 	
			 			);
			 			$data['table'] = 'parentescos';
			 			$this->crud->create($data);

		 				$json = array(
		            		'respuesta' => 'alert', 
		            		'tipo'  	=> 'success',
		            		'texto'     => '¡Beneficiario agregado exitosamente!',  
		            		'redirigir'  => base_url('cotizaciones/nuevo') 
		            	);
		            	echo json_encode($json);
		 			} 
		 			else 
		 			{
						$json = array(
			            	'respuesta' => 'toast',  
			            	'tipo'      => 'error',  
			            	'texto'     => 'Ops! Error al crear el beneficiario' 
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
		else 
		{
			show_404();
		}
	}

	public function quitar()
	{
			$keys_post = array_keys($this->input->post());
 			foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }
			
			$data = array(
	    		'table'  => 'parentescos', 
	    		'where'  => 'parentescos.id_beneficiario = "'.$id.'"',
	    		//'where'  => 'parentescos.id_beneficiario = "'.$id.'" AND parentescos.id_cotizacion = "'..'"',
	    	);
	    	if ($this->crud->erase($data) == TRUE) 
	    	{
	    		$json = array(
		    		'respuesta' 	=> 'alert',
		    		'tipo' 			=> 'success',
		    		'texto' 		=> 'Beneficiario eliminado de la cotizacion exitosamente' ,
		    		'redirigir'  	=> base_url('cotizaciones/nuevo')
		    	);
		    	echo json_encode($json);
	    	} 
	    	else 
	    	{
	    		$json = array(
		    		'respuesta' => 'toast',
		    		'tipo' 		=> 'error',
		    		'texto' 	=> 'Error al eliminar el beneficiario'
		    	);
		    	echo json_encode($json);
	    	}
	  	
	}

	public function editar($id)
	{
		$config['js'] = array('forms');
		$this->resources->initialize($config);

		$data['data'] = array(
		 	'select' => '*', 
		 	'table'  => 'beneficiarios', 
		 	'join'   => array(
		 		'parentescos' => 'parentescos.id_beneficiario = beneficiarios.id_beneficiario',
		 	),
		 	'where'  => 'beneficiarios.id_beneficiario = '.$id, 
		 	//'order'  => 'id_usuario DESC',
		 	'return' => 'row', 
		);
		$beneficiario = $data['beneficiario'] = $this->crud->read($data['data']);

		if ($beneficiario->genero == "1") { $genero = '<option value="1">Femenino</option>
                    <option value="2">Masculino</option>
                    <option value="3">Genero indefinido</option>'; }
        if ($beneficiario->genero == "2") { $genero = '<option value="2">Masculino</option>
                    <option value="1">Femenino</option>
                    <option value="3">Genero indefinido</option>'; } 
        if ($beneficiario->genero == "3") { $genero = '<option value="3">Genero indefinido</option>
        			<option value="2">Masculino</option>
                    <option value="1">Femenino</option>'; }
		

		echo '<div class="modal-header">
        <h4 class="modal-title">Editar beneficiario</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="beneficiarioForm" class="row" enctype="multipart/form-data" method="post" action="'.base_url("beneficiarios/actualizar").'">

                <div class="form-group input-field col-lg-6">
                  <input type="text" name="Bdni" id="Bdni" class="form-control validate" value="'.$beneficiario->dni.'" disabled>
                  <label class="active" for="Bdni">Cedula</label>
                  <span  class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                </div>
                <div class="form-group input-field col-lg-6">
                  <input type="text" name="Bnombres" id="Bnombres" class="form-control validate" value="'.$beneficiario->nombres.'">
                  <label class="active" for="Bnombres">Nombres</label>
                  <span  class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                </div>
                <div class="form-group input-field col-lg-6">
                  <input type="text" name="Bapellidos" id="Bapellidos" class="form-control validate" value="'.$beneficiario->apellidos.'">
                  <label class="active" for="Bapellidos">Apellidos</label>
                  <span  class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                </div>
                 <div class="form-group col-lg-6">
                    <div class="form-group" >
                       <input type="text" class="form-control date" id="Bdatepicker" name="Bnacimiento" placeholder="Fecha de nacimiento" value="'.$beneficiario->nacimiento.'"/>
                    </div>
                 </div>
                <div class="form-group  col-lg-6">
                  <select class="form-control select2 genero" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" name="Bgenero">
                    '.$genero.'
                  </select>
                </div>
                <div class="form-group  col-lg-6">
                  <select class="form-control select2 parentesco" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" name="Bparentesco">
                    <option value="'.$beneficiario->parentesco.'">'.$beneficiario->parentesco.'</option disabled>
                      <option value="madre">Madre</option>
                      <option value="hija">Hija</option>
                      <option value="hermana">Hermana</option>
                      <option value="tia">Tia</option>
                      <option value="prima">Prima</option>
                      <option value="abuela">Abuela</option>
                      <option value="esposa">Esposa</option> 
                      <option value="padre">Padre</option>
                      <option value="hijo">Hijo</option>
                      <option value="hermano">Hermano</option>
                      <option value="tio">Tio</option>
                      <option value="primo">Primo</option>
                      <option value="abuelo">Abuelo</option>
                      <option value="esposo">Esposo</option>        
                  </select>
                </div>
                <div class="form-group input-field col-lg-6">
                  <input type="text" name="Bcorreo" id="Bcorreo" class="form-control validate" value="'.$beneficiario->correo.'">
                  <label class="active" for="Bcorreo">Correo electronico</label>
                  <span  class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                </div>
                <div class="form-group input-field col-lg-6">
                  <input type="text" name="Btlf" id="Btlf" class="form-control validate" value="'.$beneficiario->tlf.'">
                  <label class="active" for="Btlf">Telefono</label>
                  <span  class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                </div>

                <div class="col-lg-12 mt-4">
                  <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
              </form></div>';
	}*/

	public function buscar()
	{
		$keys_post = array_keys($this->input->post());
 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }

 		/*if($_SESSION['titular']['dni'] != NULL)
 		{*/
	 		$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'beneficiarios', 
			 	'where'  => 'beneficiarios.dni = "'.$buscar.'"',  
			 	'return' => 'row', 
			);
			$beneficiario = $this->crud->read($data['data']);

			if ($beneficiario != NULL) 
			{
				$json = array(
		    		'id_beneficiario'  	=> $beneficiario->id_beneficiario, 
		    		'Bnombres'      	=> $beneficiario->nombres, 
		    		'Bapellidos'   		=> $beneficiario->apellidos, 
		    		'Btlf'         		=> $beneficiario->tlf, 
		    		'Bcorreo'      		=> $beneficiario->correo, 
		    		'Bdatepicker'  		=> $beneficiario->nacimiento, 
		    	);
			}
			else
			{
				$json = array(
		    		'id_beneficiario'  => '', 
		    		'Bcorreo'      => '', 
		    		'Bnombres'     => '', 
		    		'Bapellidos'   => '', 
		    		'Btlf'         => '', 
		    		'Bdatepicker'  => '', 
		    		'inexistente'  => 'Puedes registrar este beneficiario', 
		    	); 
			}

	    	echo json_encode($json);
 		/*}
 		else
 		{
 			$json = array(
	    		'respuesta' 	=> 'alert',
	    		'tipo' 			=> 'warning',
	    		'texto' 		=> 'Primero debe ingresar los datos del titular' ,
	    		'redirigir'  	=> base_url('cotizaciones/nuevo')
	    	);
	    	echo json_encode($json);
 		}*/
	}

	public function guardar()
	{
		$keys_post = array_keys($this->input->post());
 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }

    	$article = array(
    		"id" => rand(),
    		"qty" => 1,
    		"name" => $Bnombres.' '.$Bapellidos,
    		"price" => 1.0
    	);
    	$article["options"] = array(
    		"Bdni" => $Bdni,
    		"Bnombres" => $Bnombres,
    		"Bapellidos" => $Bapellidos,
    		"Bnacimiento" => $Bnacimiento,
    		"Bgenero" => $Bgenero,
    		"Bparentesco" => $Bparentesco,
    		"Bcorreo" => $Bcorreo,
    		"Btlf" => $Btlf,
    	);

    	$this->shop1->insert($article);

    	//$_SESSION['alert'] = 'add';
		//redirect('cotizaciones/nuevo');
		$json = array(
    		'respuesta' 	=> 'alert',
    		'tipo' 			=> 'success',
    		'texto' 		=> 'beneficiario agregado exitosamente' ,
    		'redirigir'  	=> base_url('cotizaciones/nuevo')
    	);
    	echo json_encode($json);	
	}

	public function quitar()
	{
		$keys_post = array_keys($this->input->post());
 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }
 		
 		/*$article = array(
    		"rowid" => $id,
    	);*/
		if(isset($id)){
			$this->shop1->remove_item($id);
			$json = array(
	    		'respuesta' 	=> 'alert',
	    		'tipo' 			=> 'success',
	    		'texto' 		=> 'Beneficiario quitado exitosamente' ,
	    		'redirigir'  	=> base_url('cotizaciones/nuevo')
	    	);
	    	echo json_encode($json);
		}

		//$_SESSION['alert'] = 'add';
		//redirect('cotizaciones/nuevo');
	}
}
