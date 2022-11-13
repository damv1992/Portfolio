<?php

namespace App\Controllers;

use App\Models\ConfiguracionModel;
use App\Models\CursosModel;

class Curso extends Home {

	public function __construct() {
        $this->session = \Config\Services::session();
        $this->session->start();
		$this->configuraciones = new ConfiguracionModel();
		$this->cursos = new CursosModel();
	}

	public function index() {
		if (!$_SESSION['Usuario']) return redirect()->to(base_url());
		$datos = $this->datosPrincipales();
		$datos += [
			'titulo' => 'Cursos',
		];
		return view('crud/curso/lista', $datos);
	}

	public function agregar() {
		if (!$_SESSION['Usuario']) return redirect()->to(base_url());
		$datos = $this->datosPrincipales();
		$datos += [
			'titulo' => 'Agregar curso'
		];
		return view('crud/curso/formulario', $datos);
	}

	public function editar($id) {
		if (!$_SESSION['Usuario']) return redirect()->to(base_url());
		$datos = $this->datosPrincipales();
		$curso = $this->cursos->where('IdCurso', $id)->first();
		$datos += [
			'titulo' => 'Modificar curso',
			'curso' => $curso
		];
		return view('crud/curso/formulario', $datos);
	}
	public function listar() {
		$cursoss = $this->cursos->orderBy('FechaInicio DESC')->findAll();
		$cantidad = count($cursoss);
		$datosJson = '{"data": [';
		$contador = 0;
		foreach ($cursoss as $curso) {
			$contador++;
			if ($curso['Presente']) $fin = 'Presente';
			else $fin = $curso['FechaFin'];
			$url = site_url('curso/editar/'.$curso['IdCurso']);
			$acciones = "<div class='btn-group'>";
			$acciones .= "<a href='".$url."' class='btn btn-warning'><i class='fa fa-pen'></i></a>";
			$acciones .= "<a class='btnBorrar btn btn-danger' codigo='".$curso['IdCurso']."'><i class='fa fa-trash'></i></a>";
			$acciones .= "</div>";

			$datosJson .= '[
				"' . $contador . '",
				"' . $curso['Curso'] . '",
				"' . $curso['Institucion'] . '",
				"' . $curso['FechaInicio'] . '",
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
		$curso = $this->request->getPost('curso');
		$institucion = $this->request->getPost('institucion');
		$fechaInicio = $this->request->getPost('fechaInicio');
		$fechaFin = $this->request->getPost('fechaFin');
		$presente = $this->request->getPost('presente');
		$campos = ''; $mensajes = ''; $contador = 0;
		if (!$curso) {
			$contador++; $campos .= 'curso,';
			$mensajes .= 'Este dato es obligatorio,';
		}
		if (!$institucion) {
			$contador++; $campos .= 'institucion,';
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
			'Curso' => mb_strtoupper($this->request->getPost('curso')),
			'Institucion' => ucwords($this->request->getPost('institucion')),
			'FechaInicio' => $this->request->getPost('fechaInicio'),
			'FechaFin' => $this->request->getPost('fechaFin'),
			'Presente' => $this->request->getPost('presente'),
		);
		if ($id) {
			$this->cursos->where([
				'IdCurso' => $id,
			])->set($datos)->update();
		} else {
			$id = $this->generarId();
			$datos['IdCurso'] = $id;
			$this->cursos->insert($datos);
		}
		return 'success';
    }

	public function borrar() {
		$id = $this->request->getPost('id');
		if (!$id) return 'error';
		if ($this->cursos->where('IdCurso', $id)->delete()) return 'ok';
		else return 'uso';
	}

	public function generarId() {
        $id = 0;
        while (true) {
            $id++;
            if (!$this->cursos->where('IdCurso', $id)->first()) return $id;
        }
	}
}