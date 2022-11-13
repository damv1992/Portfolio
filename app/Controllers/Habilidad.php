<?php

namespace App\Controllers;

use App\Models\ConfiguracionModel;
use App\Models\HabilidadesModel;

class Habilidad extends Home {

	public function __construct() {
        $this->session = \Config\Services::session();
        $this->session->start();
		$this->configuraciones = new ConfiguracionModel();
		$this->habilidades = new HabilidadesModel();
	}

	public function index() {
		if (!$_SESSION['Usuario']) return redirect()->to(base_url());
		$datos = $this->datosPrincipales();
		$datos += [
			'titulo' => 'Habilidades',
		];
		return view('crud/habilidad/lista', $datos);
	}

	public function agregar() {
		if (!$_SESSION['Usuario']) return redirect()->to(base_url());
		$datos = $this->datosPrincipales();
		$datos += [
			'titulo' => 'Agregar habilidad'
		];
		return view('crud/habilidad/formulario', $datos);
	}

	public function editar($id) {
		if (!$_SESSION['Usuario']) return redirect()->to(base_url());
		$datos = $this->datosPrincipales();
		$habilidad = $this->habilidades->where('IdHabilidad', $id)->first();
		$datos += [
			'titulo' => 'Modificar habilidad',
			'habilidad' => $habilidad
		];
		return view('crud/habilidad/formulario', $datos);
	}

	public function listar() {
		$habilidadess = $this->habilidades->orderBy('Habilidad ASC')->findAll();
		$cantidad = count($habilidadess);
		$datosJson = '{"data": [';
		$contador = 0;
		foreach ($habilidadess as $habilidad) {
			$contador++;
			$url = site_url('habilidad/editar/'.$habilidad['IdHabilidad']);
			$acciones = "<div class='btn-group'>";
			$acciones .= "<a href='".$url."' class='btn btn-warning'><i class='fa fa-pen'></i></a>";
			$acciones .= "<a class='btnBorrar btn btn-danger' codigo='".$habilidad['IdHabilidad']."'><i class='fa fa-trash'></i></a>";
			$acciones .= "</div>";

			$datosJson .= '[
				"' . $contador . '",
				"' . $habilidad['Habilidad'] . '",
				"' . $habilidad['Porcentaje'].' %' . '",
				"' . $acciones . '"
			],';
		}
		$datosJson = rtrim($datosJson, ",");
		$datosJson .= ']}';
		return $datosJson;
    }

	public function validar() {
		$id = $this->request->getPost('id');
		$habilidad = $this->request->getPost('habilidad');
		$porcentaje = $this->request->getPost('porcentaje');
		$campos = ''; $mensajes = ''; $contador = 0;
		if (!$habilidad) {
			$contador++; $campos .= 'habilidad,';
			$mensajes .= 'Este dato es obligatorio,';
		} else {
			$verificar = $this->habilidades->where('Habilidad', $habilidad)->first();
			if ($verificar && $verificar['IdHabilidad'] <> $id) {
				$contador++; $campos .= 'habilidad,';
				$mensajes .= 'Ya existe este registro,';
			}
		}
		if (!$porcentaje) {
			$contador++; $campos .= 'porcentaje,';
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
			'Habilidad' => mb_strtoupper($this->request->getPost('habilidad')),
			'Porcentaje' => $this->request->getPost('porcentaje'),
		);
		if ($id) {
			$this->habilidades->where([
				'IdHabilidad' => $id,
			])->set($datos)->update();
		} else {
			$id = $this->generarId();
			$datos['IdHabilidad'] = $id;
			$this->habilidades->insert($datos);
		}
		return 'success';
    }

	public function borrar() {
		$id = $this->request->getPost('id');
		if (!$id) return "error";
		if ($this->habilidades->where('IdHabilidad', $id)->delete()) return "ok";
		else return "uso";
	}

	public function generarId() {
        $id = 0;
        while (true) {
            $id++;
            if (!$this->habilidades->where('IdHabilidad', $id)->first()) return $id;
        }
	}
}