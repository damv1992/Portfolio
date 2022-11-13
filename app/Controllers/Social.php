<?php

namespace App\Controllers;

use App\Models\ConfiguracionModel;
use App\Models\RedesSocialesModel;

class Social extends Home {

	public function __construct() {
        $this->session = \Config\Services::session();
        $this->session->start();
		$this->configuraciones = new ConfiguracionModel();
		$this->sociales = new RedesSocialesModel();
	}

	public function index() {
		if (!$_SESSION['Usuario']) return redirect()->to(base_url());
		$datos = $this->datosPrincipales();
		$datos += [
			'titulo' => 'Redes Sociales',
		];
		return view('crud/social/lista', $datos);
	}

	public function agregar() {
		if (!$_SESSION['Usuario']) return redirect()->to(base_url());
		$datos = $this->datosPrincipales();
		$datos += [
			'titulo' => 'Agregar red social'
		];
		return view('crud/social/formulario', $datos);
	}

	public function editar($id) {
		if (!$_SESSION['Usuario']) return redirect()->to(base_url());
		$datos = $this->datosPrincipales();
		$social = $this->sociales->where('IdRedSocial', $id)->first();
		$datos += [
			'titulo' => 'Modificar red social',
			'social' => $social
		];
		return view('crud/social/formulario', $datos);
	}

	public function listar() {
		$socialess = $this->sociales->orderBy('Enlace ASC')->findAll();
		$cantidad = count($socialess);
		$datosJson = '{"data": [';
		$contador = 0;
		foreach ($socialess as $social) {
			$contador++;
			$icono = "<i class='".$social['Icono']."'></i>";
			$enlace = "<a href='".$social['Enlace']."'>".$social['Enlace']."</a>";
			$url = site_url('social/editar/'.$social['IdRedSocial']);
			$acciones = "<div class='btn-group'>";
			$acciones .= "<a href='".$url."' class='btn btn-warning'><i class='fa fa-pen'></i></a>";
			$acciones .= "<a class='btnBorrar btn btn-danger' codigo='".$social['IdRedSocial']."'><i class='fa fa-trash'></i></a>";
			$acciones .= "</div>";

			$datosJson .= '[
				"' . $contador . '",
				"' . $icono . '",
				"' . $enlace . '",
				"' . $acciones . '"
			],';
		}
		$datosJson = rtrim($datosJson, ",");
		$datosJson .= ']}';
		return $datosJson;
    }

	public function validar() {
		$id = $this->request->getPost('id');
		$icono = $this->request->getPost('icono');
		$enlace = $this->request->getPost('enlace');
		$campos = ''; $mensajes = ''; $contador = 0;
		if (!$icono) {
			$contador++; $campos .= 'icono,';
			$mensajes .= 'Este dato es obligatorio,';
		} else {
			$verificar = $this->sociales->where('Icono', $icono)->first();
			if ($verificar && $verificar['IdRedSocial'] <> $id) {
				$contador++; $campos .= 'icono,';
				$mensajes .= 'Ya existe este registro,';
			}
		}
		if (!$enlace) {
			$contador++; $campos .= 'enlace,';
			$mensajes .= 'Este dato es obligatorio,';
		}
		$json = array(
			'contador' => $contador,
			'mensajes' => $mensajes,
			'campos' => $campos
		);
		return json_encode($json);
    }

	public function guardar() {
		$id = $this->request->getPost('id');
		$datos = array(
			'Icono' => $this->request->getPost('icono'),
			'Enlace' => $this->request->getPost('enlace'),
		);
		if ($id) {
			$this->sociales->where([
				'IdRedSocial' => $id,
			])->set($datos)->update();
		} else {
			$id = $this->generarId();
			$datos['IdRedSocial'] = $id;
			$this->sociales->insert($datos);
		}
		return 'success';
    }

	public function borrar() {
		$id = $this->request->getPost('id');
		if (!$id) return "error";
		if ($this->sociales->where('IdRedSocial', $id)->delete()) return "ok";
		else return "uso";
	}

	public function generarId() {
        $id = 0;
        while (true) {
            $id++;
            if (!$this->sociales->where('IdRedSocial', $id)->first()) return $id;
        }
	}
}