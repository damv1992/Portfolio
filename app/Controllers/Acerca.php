<?php

namespace App\Controllers;

use App\Models\ConfiguracionModel;
use App\Models\AcercaModel;

class Acerca extends Home {

	public function __construct() {
        $this->session = \Config\Services::session();
        $this->session->start();
		$this->configuraciones = new ConfiguracionModel();
		$this->acercas = new AcercaModel();
	}

	public function index() {
		if (!$_SESSION['Usuario']) return redirect()->to(base_url());
		$datos = $this->datosPrincipales();
		$acerca = $this->acercas->first();
		$datos += [
			'titulo' => 'Acerca',
			'acerca' => $acerca,
		];
		return view('crud/acerca', $datos);
	}

	public function validar() {
		$titulo = ucwords($this->request->getPost('titulo'));
		$descripcion = ucfirst($this->request->getPost('descripcion'));
		$cumpleaños = $this->request->getPost('cumpleaños');
		$ciudad = $this->request->getPost('ciudad');
		$grado = $this->request->getPost('grado');

		$imagen = $this->request->getFile('imagen');

		$acerca = $this->acercas->first();
		$campos = ''; $mensajes = ''; $contador = 0;

		if (!$titulo) {
			$contador++; $campos .= 'titulo,';
			$mensajes .= 'Este dato es obligatorio,';
		}
		if (!$descripcion) {
			$contador++; $campos .= 'descripcion,';
			$mensajes .= 'Este dato es obligatorio,';
		}
		if (!$cumpleaños) {
			$contador++; $campos .= 'cumpleaños,';
			$mensajes .= 'Este dato es obligatorio,';
		}
		if (!$ciudad) {
			$contador++; $campos .= 'ciudad,';
			$mensajes .= 'Este dato es obligatorio,';
		}
		if (!$grado) {
			$contador++; $campos .= 'grado,';
			$mensajes .= 'Este dato es obligatorio,';
		}
		if (($imagen == null) && (!$acerca['Foto'])) {
			$contador++; $campos .= 'imagen,';
			$mensajes .= 'El archivo es obligatorio,';
		} else if ($imagen <> null) {
			$extension = $imagen->getExtension();
			if (($extension <> 'png') && ($extension <> 'jpg')) {
				$contador++; $campos .= 'imagen,';
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
		$acerca = $this->acercas->first();
		$imagen = $this->request->getFile('imagen');
		if ($imagen <> null) $ruta = $this->subirArchivo($imagen, '', 'profile-img', 600, 600);
		else $ruta = $acerca['Foto'];
		$datos = array(
			'Frase' => ucfirst($this->request->getPost('frase')),
			'Titulo' => ucwords($this->request->getPost('titulo')),
			'Descripcion' => ucfirst($this->request->getPost('descripcion')),
			'Cumpleaños' => $this->request->getPost('cumpleaños'),
			'Ciudad' => ucwords($this->request->getPost('ciudad')),
			'Grado' => $this->request->getPost('grado'),
			'Matricula' => $this->request->getPost('matricula'),
			'Freelance' => $this->request->getPost('freelance'),
			'Foto' => $ruta,
		);
		if ($acerca) $this->acercas->set($datos)->update();
		else $this->acercas->insert($datos);
		return 'success';
    }
}