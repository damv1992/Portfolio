<?php

namespace App\Controllers;

use App\Models\ConfiguracionModel;
use App\Models\ProyectosModel;
use App\Models\CapturasModel;

class Captura extends Home {

	public function __construct() {
        $this->session = \Config\Services::session();
        $this->session->start();
		$this->configuraciones = new ConfiguracionModel();
		$this->proyectos = new ProyectosModel();
		$this->capturas = new CapturasModel();
	}

	public function agregar($id) {
		if (!$_SESSION['Usuario']) return redirect()->to(base_url());
		$datos = $this->datosPrincipales();
		$datos += [
			'titulo' => 'Agregar captura',
			'proyecto' => $id,
		];
		return view('crud/captura/formulario', $datos);
	}

	public function editar($id) {
		if (!$_SESSION['Usuario']) return redirect()->to(base_url());
		$datos = $this->datosPrincipales();
		$captura = $this->capturas->where('IdCaptura', $id)->first();
		$datos += [
			'titulo' => 'Modificar captura',
			'proyecto' => $captura['Proyecto'],
			'captura' => $captura,
		];
		return view('crud/captura/formulario', $datos);
	}

	public function listar() {
		$capturass = $this->capturas->findAll();
		$cantidad = count($capturass);
		$datosJson = '{"data": [';
		$contador = 0;
		foreach ($capturass as $captura) {
			$contador++;
			$imagen = "<img src='".base_url($captura['Captura'])."' height='50'>";
			$url = site_url('captura/editar/'.$captura['IdCaptura']);
			$acciones = "<div class='btn-group'>";
			$acciones .= "<a href='".$url."' class='btn btn-warning'><i class='fa fa-pen'></i></a>";
			$acciones .= "<a class='btnBorrar btn btn-danger' codigo='".$captura['IdCaptura']."'><i class='fa fa-trash'></i></a>";
			$acciones .= "</div>";

			$datosJson .= '[
				"' . $contador . '",
				"' . $imagen . '",
				"' . $acciones . '"
			],';
		}
		$datosJson = rtrim($datosJson, ",");
		$datosJson .= ']}';
		return $datosJson;
    }

	public function validar() {
		$imagen = $this->request->getFile('imagen');
		$campos = ''; $mensajes = ''; $contador = 0;
		if ($imagen == null) {
			$contador++; $campos .= 'imagen,';
			$mensajes .= 'El archivo es obligatorio,';
		} else {
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
		$proyecto = $this->request->getPost('proyecto');
		$id = $this->request->getPost('id');
		$imagen = $this->request->getFile('imagen');
		$datos = array(
			'Proyecto' => $proyecto,
		);
		mkdir(base_url('custom/img/proyectos'), 0700);
		if ($id) {
			$ruta = $this->subirArchivo($imagen, 'proyectos', $id, 800, 450);
			$datos['Captura'] = $ruta;
			$this->capturas->where([
				'IdCaptura' => $id,
			])->set($datos)->update();
		} else {
			$id = $this->generarId();
			$ruta = $this->subirArchivo($imagen, 'proyectos', $id, 800, 450);
			$datos['IdCaptura'] = $id;
			$datos['Captura'] = $ruta;
			$this->capturas->insert($datos);
		}
		return 'success';
    }

	public function borrar() {
		$id = $this->request->getPost('id');
		if (!$id) return 'error';
		if ($this->capturas->where('IdCaptura', $id)->delete()) return 'ok';
		else return 'uso';
	}

	public function generarId() {
        $id = 0;
        while (true) {
            $id++;
            if (!$this->capturas->where('IdCaptura', $id)->first()) return $id;
        }
	}
}