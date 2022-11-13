<?php

namespace App\Controllers;

use App\Models\ConfiguracionModel;
use App\Models\ExperienciasModel;

class Experiencia extends Home {

	public function __construct() {
        $this->session = \Config\Services::session();
        $this->session->start();
		$this->configuraciones = new ConfiguracionModel();
		$this->experiencias = new ExperienciasModel();
	}

	public function index() {
		if (!$_SESSION['Usuario']) return redirect()->to(base_url());
		$datos = $this->datosPrincipales();
		$datos += [
			'titulo' => 'Experiencias',
		];
		return view('crud/experiencia/lista', $datos);
	}

	public function agregar() {
		if (!$_SESSION['Usuario']) return redirect()->to(base_url());
		$datos = $this->datosPrincipales();
		$datos += [
			'titulo' => 'Agregar experiencia'
		];
		return view('crud/experiencia/formulario', $datos);
	}

	public function editar($id) {
		if (!$_SESSION['Usuario']) return redirect()->to(base_url());
		$datos = $this->datosPrincipales();
		$experiencia = $this->experiencias->where('IdExperiencia', $id)->first();
		$datos += [
			'titulo' => 'Modificar experiencia',
			'experiencia' => $experiencia
		];
		return view('crud/experiencia/formulario', $datos);
	}
	public function listar() {
		$experienciass = $this->experiencias->orderBy('FechaInicio DESC')->findAll();
		$cantidad = count($experienciass);
		$datosJson = '{"data": [';
		$contador = 0;
		foreach ($experienciass as $experiencia) {
			$contador++;
			if ($experiencia['Presente']) $fin = 'Presente';
			else $fin = $experiencia['FechaFin'];
			$url = site_url('experiencia/editar/'.$experiencia['IdExperiencia']);
			$acciones = "<div class='btn-group'>";
			$acciones .= "<a href='".$url."' class='btn btn-warning'><i class='fa fa-pen'></i></a>";
			$acciones .= "<a class='btnBorrar btn btn-danger' codigo='".$experiencia['IdExperiencia']."'><i class='fa fa-trash'></i></a>";
			$acciones .= "</div>";

			$datosJson .= '[
				"' . $contador . '",
				"' . $experiencia['Cargo'] . '",
				"' . $experiencia['Empresa'] . '",
				"' . $experiencia['Ciudad'] . '",
				"' . $experiencia['FechaInicio'] . '",
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
		$empresa = ucfirst($this->request->getPost('empresa'));
		$cargo = ucfirst($this->request->getPost('cargo'));
		$ciudad = ucwords($this->request->getPost('ciudad'));
		$fechaInicio = $this->request->getPost('fechaInicio');
		$fechaFin = $this->request->getPost('fechaFin');
		$presente = $this->request->getPost('presente');
		$funciones = $this->request->getPost('funciones');
		$campos = ''; $mensajes = ''; $contador = 0;
		if (!$empresa) {
			$contador++; $campos .= 'empresa,';
			$mensajes .= 'Este dato es obligatorio,';
		}
		if (!$cargo) {
			$contador++; $campos .= 'cargo,';
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
		if (!$funciones) {
			$contador++; $campos .= 'funciones,';
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
			'Empresa' => ucfirst($this->request->getPost('empresa')),
			'Cargo' => mb_strtoupper($this->request->getPost('cargo')),
			'Ciudad' => ucwords($this->request->getPost('ciudad')),
			'FechaInicio' => $this->request->getPost('fechaInicio'),
			'FechaFin' => $this->request->getPost('fechaFin'),
			'Presente' => $this->request->getPost('presente'),
			'Funciones' => $this->request->getPost('funciones'),
		);
		if ($id) {
			$this->experiencias->where([
				'IdExperiencia' => $id,
			])->set($datos)->update();
		} else {
			$id = $this->generarId();
			$datos['IdExperiencia'] = $id;
			$this->experiencias->insert($datos);
		}
		return 'success';
    }

	public function borrar() {
		$id = $this->request->getPost('id');
		if (!$id) return 'error';
		if ($this->experiencias->where('IdExperiencia', $id)->delete()) return 'ok';
		else return 'uso';
	}

	public function generarId() {
        $id = 0;
        while (true) {
            $id++;
            if (!$this->experiencias->where('IdExperiencia', $id)->first()) return $id;
        }
	}
}