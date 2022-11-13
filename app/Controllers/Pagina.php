<?php

namespace App\Controllers;

use App\Models\ConfiguracionModel;

class Pagina extends Home {

	public function __construct() {
        $this->session = \Config\Services::session();
        $this->session->start();
		$this->configuraciones = new ConfiguracionModel();
	}

	public function index() {
		if (!$_SESSION['Usuario']) return redirect()->to(base_url());
		$datos = $this->datosPrincipales();
		$datos += [
			'titulo' => 'Página',
		];
		return view('crud/pagina', $datos);
	}

	public function validar() {
		$nombre = ucwords($this->request->getPost('nombre'));
		$profesiones = ucwords($this->request->getPost('profesiones'));
		$correo = $this->request->getPost('correo');
		$direccion = ucwords($this->request->getPost('direccion'));
		$telefono = $this->request->getPost('telefono');
		$usuario = $this->request->getPost('usuario');
		$contraseña = $this->request->getPost('contraseña');

		$icono = $this->request->getFile('icono');
		$fondo = $this->request->getFile('fondo');

		$configuracion = $this->configuraciones->first();
		$campos = ''; $mensajes = ''; $contador = 0;

		if (!$nombre) {
			$contador++; $campos .= 'nombre,';
			$mensajes .= 'Este dato es obligatorio,';
		}
		if (!$profesiones) {
			$contador++; $campos .= 'profesiones,';
			$mensajes .= 'Este dato es obligatorio,';
		}
		if (!$correo) {
			$contador++; $campos .= 'correo,';
			$mensajes .= 'Este dato es obligatorio,';
		}
		if (!$telefono) {
			$contador++; $campos .= 'telefono,';
			$mensajes .= 'Este dato es obligatorio,';
		}
		if (!$usuario) {
			$contador++; $campos .= 'usuario,';
			$mensajes .= 'Este dato es obligatorio,';
		}
		if (($icono == null) && (!$configuracion['Icono'])) {
			$contador++; $campos .= 'icono,';
			$mensajes .= 'El archivo es obligatorio,';
		} else if ($icono <> null) {
			$extension = $icono->getExtension();
			if ($extension <> 'png') {
				$contador++; $campos .= 'icono,';
				$mensajes .= 'El archivo debe tener la extensión .png,';
			}
		}
		if (($fondo == null) && (!$configuracion['Fondo'])) {
			$contador++; $campos .= 'fondo,';
			$mensajes .= 'El archivo es obligatorio,';
		} else if ($fondo <> null) {
			$extension = $fondo->getExtension();
			if (($extension <> 'png') && ($extension <> 'jpg')) {
				$contador++; $campos .= 'fondo,';
				$mensajes .= 'El archivo debe tener la extensión .png o .jpg,';
			}
		}
		$json = array(
			'contador' => $contador,
			'mensajes' => $mensajes,
			'campos' => $campos
		);
		return json_encode($json);
    }

	public function guardar() {
		$configuracion = $this->configuraciones->first();
		$nombre = ucwords($this->request->getPost('nombre'));
		$profesiones = ucwords($this->request->getPost('profesiones'));
		$correo = $this->request->getPost('correo');
		$direccion = ucwords($this->request->getPost('direccion'));
		$telefono = $this->request->getPost('telefono');
		$usuario = $this->request->getPost('usuario');
		$contraseña = $this->request->getPost('contraseña');

		$icono = $this->request->getFile('icono');
		$fondo = $this->request->getFile('fondo');
		if ($icono <> null) $rIcono = $this->subirArchivo($icono, '', 'favicon', 32, 32);
		else $rIcono = $configuracion['Icono'];
		if ($fondo <> null) $rFondo = $this->subirArchivo($fondo, '', 'hero-bg', 1920, 1053);
		else $rFondo = $configuracion['Fondo'];
		if ($contraseña) $contraseña = password_hash($contraseña, PASSWORD_DEFAULT);
		else $contraseña = $configuracion['Contraseña'];
		$this->configuraciones->set([
			'Nombre' => $nombre,
			'Profesiones' => $profesiones,
			'Correo' => $correo,
			'Direccion' => $direccion,
			'Telefono' => $telefono,
			'Usuario' => $usuario,
			'Contraseña' => $contraseña,
			'Icono' => $rIcono,
			'Fondo' => $rFondo,
		])->update();
		$configuracion = $this->configuraciones->first();
		$this->session->set($configuracion);
		return 'success';
    }
}