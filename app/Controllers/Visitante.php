<?php

namespace App\Controllers;

use App\Models\ConfiguracionModel;
use App\Models\VisitantesModel;

class Visitante extends Home {

	public function __construct() {
        $this->session = \Config\Services::session();
        $this->session->start();
		$this->configuraciones = new ConfiguracionModel();
		$this->visitantes = new VisitantesModel();
	}

	public function index() {
		if (!$_SESSION['Usuario']) return redirect()->to(base_url());
		$datos = $this->datosPrincipales();
		$datos += [
			'titulo' => 'Visitantes',
		];
		return view('crud/visitante/lista', $datos);
	}

	public function editar($id) {
		if (!$_SESSION['Usuario']) return redirect()->to(base_url());
		$datos = $this->datosPrincipales();
		$visitantes = $this->visitantes->where('Ip', $id)->first();
		$datos += [
			'titulo' => 'Modificar visitante',
			'visitante' => $visitantes
		];
		return view('crud/visitante/formulario', $datos);
	}

	public function listar() {
		$visitantess = $this->visitantes->orderBy('FechaVisita DESC')->findAll();
		$cantidad = count($visitantess);
		$datosJson = '{"data": [';
		$contador = 0;
		foreach ($visitantess as $visitante) {
			$contador++;
			$url = site_url('visitante/editar/'.$visitante['Ip']);
			$acciones = "<div class='btn-group'>";
			$acciones .= "<a href='".$url."' class='btn btn-warning'><i class='fa fa-pen'></i></a>";
			$acciones .= "<a class='btnBorrar btn btn-danger' codigo='".$visitante['Ip']."'><i class='fa fa-trash'></i></a>";
			$acciones .= "</div>";

			$datosJson .= '[
				"' . $contador . '",
				"' . $visitante['Ip'] . '",
				"' . $visitante['Perteneciente'] . '",
				"' . $visitante['FechaVisita'] . '",
				"' . $acciones . '"
			],';
		}
		$datosJson = rtrim($datosJson, ",");
		$datosJson .= ']}';
		return $datosJson;
    }

	public function validar() {
		$ip = $this->request->getPost('ip');
		$campos = ''; $mensajes = ''; $contador = 0;
		if (!$ip) {
			$contador++; $campos .= 'ip,';
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
		$ip = $this->request->getPost('ip');
		$this->visitantes->where([
			'Ip' => $ip,
		])->set([
			'Perteneciente' => $this->request->getPost('perteneciente'),
		])->update();
		return 'success';
    }

	public function borrar() {
		$ip = $this->request->getPost('id');
		if (!$ip) return "error";
		if ($this->visitantes->where('Ip', $ip)->delete()) return "ok";
		else return "uso";
	}
}