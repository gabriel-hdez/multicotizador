<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
    //  --------------------------------------------------------------------    login
    'login' => array(
        array(
            'field' => 'correo',
            'label' => 'correo electrónico',
            'rules' => 'required|max_length[100]|valid_email'
        ),
        array(
            'field' => 'clave',
            'label' => 'contraseña',
            'rules' => 'required'
        )
    ),
    //  --------------------------------------------------------------------    usuarios
    'usuarios' => array(
        array(
            'field' => 'nombre',
            'label' => 'nombre y apellido',
            'rules' => 'required|max_length[50]|letras'
        ),
        array(
            'field' => 'correo',
            'label' => 'correo electrónico',
            'rules' => 'required|max_length[80]|valid_email|is_unique[usuarios.correo]'
        ),
        array(
            'field' => 'pregunta',
            'label' => 'pregunta de seguridad',
            'rules' => 'required|max_length[50]|alpha_numeric_spaces'
        ),
        array(
            'field' => 'respuesta',
            'label' => 'respuesta de seguridad',
            'rules' => 'required|max_length[50]|alpha_numeric_spaces'
        ),
        array(
            'field' => 'clave',
            'label' => 'contraseña',
            'rules' => 'required|matches[repetir]'
        ),
         array(
            'field' => 'repetir',
            'label' => 'repetir contraseña',
            'rules' => 'required|matches[clave]'
        ),
    ),
    'usuarios_editar' => array(
        array(
            'field' => 'nombre',
            'label' => 'nombre y apellido',
            'rules' => 'required|max_length[50]|letras'
        ),
        array(
            'field' => 'correo',
            'label' => 'correo electrónico',
            'rules' => 'required|max_length[80]|valid_email'
        ),
        array(
            'field' => 'pregunta',
            'label' => 'pregunta de seguridad',
            'rules' => 'required|max_length[50]|alpha_numeric_spaces'
        ),
        array(
            'field' => 'respuesta',
            'label' => 'respuesta de seguridad',
            'rules' => 'required|max_length[50]|alpha_numeric_spaces'
        ),
        array(
            'field' => 'clave',
            'label' => 'contraseña',
            'rules' => 'matches[repetir]'
        ),
         array(
            'field' => 'repetir',
            'label' => 'repetir contraseña',
            'rules' => 'matches[clave]'
        ),
    ),
    //  --------------------------------------------------------------------    aseguradoras
    'aseguradoras' => array(
        array(
            'field' => 'aseguradora',
            'label' => 'aseguradora',
            'rules' => 'required|max_length[100]|is_unique[aseguradoras.aseguradora]'
        ),
        array(
            'field' => 'rif',
            'label' => 'rif',
            'rules' => 'required|max_length[25]|alpha_dash|is_unique[aseguradoras.rif]'
        ),
        array(
            'field' => 'tlf',
            'label' => 'telefono',
            'rules' => 'required|max_length[11]|numeric'
        ),
        array(
            'field' => 'correo',
            'label' => 'correo electrónico',
            'rules' => 'required|max_length[80]|valid_email'
        ),
    ),
    'aseguradoras_editar' => array(
        array(
            'field' => 'aseguradora',
            'label' => 'aseguradora',
            'rules' => 'required|max_length[100]'
        ),
        array(
            'field' => 'rif',
            'label' => 'rif',
            'rules' => 'required|max_length[25]|alpha_dash'
        ),
        array(
            'field' => 'tlf',
            'label' => 'telefono',
            'rules' => 'required|max_length[11]|numeric'
        ),
        array(
            'field' => 'correo',
            'label' => 'correo electrónico',
            'rules' => 'required|max_length[80]|valid_email'
        ),
    ),
    //  --------------------------------------------------------------------    planes
    'planes' => array(
        array(
            'field' => 'plan',
            'label' => 'nombre del plan',
            'rules' => 'required|max_length[100]'
        ),
        array(
            'field' => 'suma',
            'label' => 'suma asegurada',
            'rules' => 'required|max_length[16]|decimal'
        ),
        array(
            'field' => 'Dnacional',
            'label' => 'deducible nacional',
            'rules' => 'required|max_length[16]|decimal'
        ), array(
            'field' => 'Dexterior',
            'label' => 'deducible exterior',
            'rules' => 'required|max_length[16]|decimal'
        ),
        array(
            'field' => 'plazo',
            'label' => 'plazo en meses',
            'rules' => 'required|max_length[3]|numeric'
        ),
        array(
            'field' => 'titular9',
            'label' => 'prima titular de 0-9 años',
            'rules' => 'required|max_length[16]|decimal'
        ),
        array(
            'field' => 'titular19',
            'label' => 'prima titular de 10-19 años',
            'rules' => 'required|max_length[16]|decimal'
        ),
        array(
            'field' => 'titular29',
            'label' => 'prima titular de 20-29 años',
            'rules' => 'required|max_length[16]|decimal'
        ),
        array(
            'field' => 'titular39',
            'label' => 'prima titular de 30-39 años',
            'rules' => 'required|max_length[16]|decimal'
        ),
        array(
            'field' => 'titular49',
            'label' => 'prima titular de 40-49 años',
            'rules' => 'required|max_length[16]|decimal'
        ),
        array(
            'field' => 'titular54',
            'label' => 'prima titular de 50-54 años',
            'rules' => 'required|max_length[16]|decimal'
        ),
        array(
            'field' => 'titular59',
            'label' => 'prima titular de 55-59 años',
            'rules' => 'required|max_length[16]|decimal'
        ), 
        array(
            'field' => 'titular69',
            'label' => 'prima titular de 60-69 años',
            'rules' => 'required|max_length[16]|decimal'
        ),
        array(
            'field' => 'titular75',
            'label' => 'prima titular mayor de 70 años',
            'rules' => 'required|max_length[16]|decimal'
        ),
        array(
            'field' => 'beneficiario9',
            'label' => 'prima beneficiario de 0-9 años',
            'rules' => 'required|max_length[16]|decimal'
        ),
        array(
            'field' => 'beneficiario19',
            'label' => 'prima beneficiario de 10-19 años',
            'rules' => 'required|max_length[16]|decimal'
        ),
        array(
            'field' => 'beneficiario29',
            'label' => 'prima beneficiario de 20-29 años',
            'rules' => 'required|max_length[16]|decimal'
        ),
        array(
            'field' => 'beneficiario39',
            'label' => 'prima beneficiario de 30-39 años',
            'rules' => 'required|max_length[16]|decimal'
        ),
        array(
            'field' => 'beneficiario49',
            'label' => 'prima beneficiario de 40-49 años',
            'rules' => 'required|max_length[16]|decimal'
        ),
        array(
            'field' => 'beneficiario54',
            'label' => 'prima beneficiario de 50-54 años',
            'rules' => 'required|max_length[16]|decimal'
        ),
        array(
            'field' => 'beneficiario59',
            'label' => 'prima beneficiario de 55-59 años',
            'rules' => 'required|max_length[16]|decimal'
        ), 
        array(
            'field' => 'beneficiario69',
            'label' => 'prima beneficiario de 60-69 años',
            'rules' => 'required|max_length[16]|decimal'
        ),
        array(
            'field' => 'beneficiario75',
            'label' => 'prima beneficiario mayor de 70 años',
            'rules' => 'required|max_length[16]|decimal'
        ),
        array(
            'field' => 'tipo',
            'label' => 'tipo de servicio en el exterior',
            'rules' => 'required|max_length[25]'
        ),
        array(
            'field' => 'maternidad',
            'label' => 'gastos por maternidad',
            'rules' => 'required|max_length[16]|decimal'
        ),
        array(
            'field' => 'viaje',
            'label' => 'asistencia en viaje internacional',
            'rules' => 'required|max_length[16]|decimal'
        ),
        array(
            'field' => 'funerario',
            'label' => 'gastos funerarios',
            'rules' => 'required|max_length[16]|decimal'
        ),
        
    ),
     //  --------------------------------------------------------------------    titular
    'titular' => array(
        array(
            'field' => 'nombres',
            'label' => 'nombres',
            'rules' => 'required|max_length[50]|letras'
        ),
        array(
            'field' => 'apellidos',
            'label' => 'apellidos',
            'rules' => 'required|max_length[50]|letras'
        ), 
        array(
            'field' => 'dni',
            'label' => 'cedula',
            'rules' => 'required|max_length[12]|numeric'
        ),
        array(
            'field' => 'correo',
            'label' => 'correo electrónico',
            'rules' => 'max_length[80]|valid_email'
        ),
        array(
            'field' => 'tlf',
            'label' => 'telefono',
            'rules' => 'max_length[11]|numeric'
        ),
        array(
            'field' => 'nacimiento',
            'label' => 'nacimiento',
            'rules' => 'required'
        ),
    ),    
     //  --------------------------------------------------------------------    usuarios
    'beneficiarios' => array(
        array(
            'field' => 'Bnombres',
            'label' => 'nombres',
            'rules' => 'max_length[50]|letras'
        ),
        array(
            'field' => 'Bapellidos',
            'label' => 'apellidos',
            'rules' => 'max_length[50]|letras'
        ), 
        array(
            'field' => 'Bdni',
            'label' => 'cedula',
            'rules' => 'max_length[12]|numeric'
        ),
        array(
            'field' => 'Bcorreo',
            'label' => 'correo electrónico',
            'rules' => 'max_length[80]|valid_email'
        ),
        array(
            'field' => 'Btlf',
            'label' => 'telefono',
            'rules' => 'max_length[11]|numeric'
        ),
        array(
            'field' => 'Bnacimiento',
            'label' => 'nacimiento',
            'rules' => 'required'
        ),
    ),    
   



);