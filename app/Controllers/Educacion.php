<?php

namespace App\Controllers;

use App\Models\ConfiguracionModel;
use App\Models\EducacionesModel;

class Educacion extends Home {

	public function __construct() {
        $this->session = \Config\Services::session();
        $this->session->start();
		$this->configuraciones = new ConfiguracionModel();
		$this->educaciones = new EducacionesModel();
	}

	public function index() {
		if (!$_SESSION['Usuario']) return redirect()->to(base_url());
		$datos = $this->datosPrincipales();
		$datos += [
			'titulo' => 'Educaciones',
		];
		return view('crud/educacion/lista', $datos);
	}

	public function agregar() {
		if (!$_SESSION['Usuario']) return redirect()->to(base_url());
		$datos = $this->datosPrincipales();
		$datos += [
			'titulo' => 'Agregar educación'
		];
		return view('crud/educacion/formulario', $datos);
	}

	public function editar($id) {
		if (!$_SESSION['Usuario']) return redirect()->to(base_url());
		$datos = $this->datosPrincipales();
		$educacion = $this->educaciones->where('IdEducacion', $id)->first();
		$datos += [
			'titulo' => 'Modificar educación',
			'educacion' => $educacion
		];
		return view('crud/educacion/formulario', $datos);
	}
	public function listar() {
		$educacioness = $this->educaciones->orderBy('FechaInicio DESC')->findAll();
		$cantidad = count($educacioness);
		$datosJson = '{"data": [';
		$contador = 0;
		foreach ($educacioness as $educacion) {
			$contador++;
			if ($educacion['Presente']) $fin = 'Presente';
			else $fin = $educacion['FechaFin'];
			$url = site_url('educacion/editar/'.$educacion['IdEducacion']);
			$acciones = "<div class='btn-group'>";
			$acciones .= "<a href='".$url."' class='btn btn-warning'><i class='fa fa-pen'></i></a>";
			$acciones .= "<a class='btnBorrar btn btn-danger' codigo='".$educacion['IdEducacion']."'><i class='fa fa-trash'></i></a>";
			$acciones .= "</div>";

			$datosJson .= '[
				"' . $contador . '",
				"' . $educacion['Educacion'] . '",
				"' . $educacion['Institucion'] . '",
				"' . $educacion['Ciudad'] . '",
				"' . $educacion['FechaInicio'] . '",
				"' . $fin . '",
				"' . $acciones . '"
			],';
		}
		$datosJson = rtrim($datosJson, ",");
		$datosJson .= ']}';
		return $datosJson;
    }

	public function validar() {
		$id = $this->request->getPost('id');
		$educacion = $this->request->getPost('educacion');
		$institucion = $this->request->getPost('institucion');
		$ciudad = $this->request->getPost('ciudad');
		$fechaInicio = $this->request->getPost('fechaInicio');
		$fechaFin = $this->request->getPost('fechaFin');
		$presente = $this->request->getPost('presente');
		$campos = ''; $mensajes = ''; $contador = 0;
		if (!$educacion) {
			$contador++; $campos .= 'educacion,';
			$mensajes .= 'Este dato es obligatorio,';
		}
		if (!$institucion) {
			$contador++; $campos .= 'institucion,';
			$mensajes .= 'Este dato es obligatorio,';
		}
		if (!$ciudad) {
			$contador++; $campos .= 'ciudad,';
			$mensajes .= 'Este dato es obligatorio,';
		}
		if (!$fechaInicio) {
			$contador++; $campos .= 'fechaInicio,';
			$mensajes .= 'Este dato es obligatorio,';
		}
		if (!$presente && !$fechaFin) {
			$contador++; $campos .= 'fechaFin,';
			$mensajes .= 'Este dato es obligatorio,';
		} else if ($fechaFin) {
			if (strtotime($fechaInicio) > strtotime($fechaFin)) {
				$contador++; $campos .= 'fechaFin,';
				$mensajes .= 'Este dato debe ser mayor al anterior,';
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
		$id = $this->request->getPost('id');
		$datos = array(
			'Educacion' => mb_strtoupper($this->request->getPost('educacion')),
			'Institucion' => ucwords($this->request->getPost('institucion')),
			'Ciudad' => ucwords($this->request->getPost('ciudad')),
			'FechaInicio' => $this->request->getPost('fechaInicio'),
			'FechaFin' => $this->request->getPost('fechaFin'),
			'Presente' => $this->request->getPost('presente'),
		);
		if ($id) {
			$this->educaciones->where([
				'IdEducacion' => $id,
			])->set($datos)->update();
		} else {
			$id = $this->generarId();
			$datos['IdEducacion'] = $id;
			$this->educaciones->insert($datos);
		}
		return 'success';
    }

	public function borrar() {
		$id = $this->request->getPost('id');
		if (!$id) return 'error';
		if ($this->educaciones->where('IdEducacion', $id)->delete()) return 'ok';
		else return 'uso';
	}

	public function generarId() {
        $id = 0;
        while (true) {
            $id++;
            if (!$this->educaciones->where('IdEducacion', $id)->first()) return $id;
        }
	}
}