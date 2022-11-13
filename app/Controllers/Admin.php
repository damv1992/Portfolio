<?php

namespace App\Controllers;

use App\Models\ConfiguracionModel;

class Admin extends Home {

	public function __construct() {
        $this->session = \Config\Services::session();
        $this->session->start();
		$this->configuraciones = new ConfiguracionModel();
	}

	public function index() {
		if (!$_SESSION['Usuario']) return redirect()->to(base_url());
		$datos = $this->datosPrincipales();
		$datos += [
			'titulo' => 'Administración',
		];
		return view('crud/admin', $datos);
	}

    public function login() {
        $usuario = $this->request->getPost('usuario');
        $contraseña = $this->request->getPost('contraseña');
        $campos = ''; $mensajes = ''; $contador = 0;
        $configuracion = $this->configuraciones->first();
        if (!$usuario) {
            $contador++; $campos .= 'txtUsuario,';
            $mensajes .= 'Este dato es obligatorio,';
        } else {
            if ($usuario != $configuracion['Usuario']) {
                $contador++; $campos .= 'txtUsuario,';
                $mensajes .= 'Nombre de usuario incorrecto,';
            }
        }
        if (!$contraseña) {
            $contador++; $campos .= 'txtContraseña,';
            $mensajes .= 'Este dato es obligatorio,';
        } else {
            if (!password_verify($contraseña, $configuracion['Contraseña'])) {
                $contador++; $campos .= 'txtContraseña,';
                $mensajes .= 'Contraseña incorrecta,';
            }
        }
        $json = array(
            'contador' => $contador,
            'mensajes' => $mensajes,
            'campos' => $campos
        );
        if ($contador == 0) $this->session->set($configuracion);
        return json_encode($json);
    }

    public function logout() {
        $this->session->destroy();
        return redirect()->to(base_url());
    }
}