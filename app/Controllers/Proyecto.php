<?php

namespace App\Controllers;

use App\Models\ConfiguracionModel;
use App\Models\ProyectosModel;
use App\Models\CapturasModel;

class Proyecto extends Home {

	public function __construct() {
        $this->session = \Config\Services::session();
        $this->session->start();
		$this->configuraciones = new ConfiguracionModel();
		$this->proyectos = new ProyectosModel();
		$this->capturas = new CapturasModel();
	}

	public function index() {
		if (!$_SESSION['Usuario']) return redirect()->to(base_url());
		$datos = $this->datosPrincipales();
		$datos += [
			'titulo' => 'Proyecto',
		];
		return view('crud/proyecto/lista', $datos);
	}

	public function agregar() {
		if (!$_SESSION['Usuario']) return redirect()->to(base_url());
		$datos = $this->datosPrincipales();
		$datos += [
			'titulo' => 'Agregar proyecto',
		];
		return view('crud/proyecto/formulario', $datos);
	}

	public function editar($id) {
		if (!$_SESSION['Usuario']) return redirect()->to(base_url());
		$datos = $this->datosPrincipales();
		$proyecto = $this->proyectos->where('IdProyecto', $id)->first();
		$datos += [
			'titulo' => 'Modificar proyecto',
			'proyecto' => $proyecto,
		];
		return view('crud/proyecto/formulario', $datos);
	}

	public function capturas($id) {
		if (!$_SESSION['Usuario']) return redirect()->to(base_url());
		$datos = $this->datosPrincipales();
		$proyecto = $this->proyectos->where('IdProyecto', $id)->first();
		$datos += [
			'titulo' => $proyecto['Titulo'],
			'proyecto' => $proyecto,
		];
		return view('crud/captura/lista', $datos);
	}

	public function detalle($id) {
		$datos = $this->datosPrincipales();
		$proyecto = $this->proyectos->where('IdProyecto', $id)->first();
		$capturass = $this->capturas->where('Proyecto', $id)->findAll();
		$datos += [
			'titulo' => $proyecto['Titulo'],
			'proyecto' => $proyecto,
			'capturass' => $capturass,
		];
		return view('crud/proyecto/detalle', $datos);
	}

	public function listar() {
		$proyectoss = $this->proyectos->orderBy('Fecha DESC')->findAll();
		$cantidad = count($proyectoss);
		$datosJson = '{"data": [';
		$contador = 0;
		foreach ($proyectoss as $proyecto) {
			$contador++;
			$url = site_url('proyecto/editar/'.$proyecto['IdProyecto']);
			$capturas = site_url('proyecto/capturas/'.$proyecto['IdProyecto']);
			$acciones = "<div class='btn-group'>";
			$acciones .= "<a href='".$url."' class='btn btn-warning'><i class='fa fa-pen'></i></a>";
			$acciones .= "<a class='btnBorrar btn btn-danger' codigo='".$proyecto['IdProyecto']."'><i class='fa fa-trash'></i></a>";
			$acciones .= "<a href='".$capturas."' class='btn btn-success'><i class='fa fa-camera'></i></a>";
			$acciones .= "</div>";

			$datosJson .= '[
				"' . $contador . '",
				"' . $proyecto['Titulo'] . '",
				"' . $proyecto['Categoria'] . '",
				"' . $proyecto['Enlace'] . '",
				"' . $proyecto['Cliente'] . '",
				"' . $proyecto['Fecha'] . '",
				"' . $acciones . '"
			],';
		}
		$datosJson = rtrim($datosJson, ",");
		$datosJson .= ']}';
		return $datosJson;
    }

	public function validar() {
		$titulo = $this->request->getPost('titulo');
		$categoria = $this->request->getPost('categoria');
		$cliente = $this->request->getPost('cliente');
		$enlace = $this->request->getPost('enlace');
		$fecha = $this->request->getPost('fecha');
		$descripcion = $this->request->getPost('descripcion');
		$campos = ''; $mensajes = ''; $contador = 0;
		if (!$titulo) {
			$contador++; $campos .= 'titulo,';
			$mensajes .= 'Este dato es obligatorio,';
		}
		if (!$categoria) {
			$contador++; $campos .= 'categoria,';
			$mensajes .= 'Este dato es obligatorio,';
		}
		if (!$cliente) {
			$contador++; $campos .= 'cliente,';
			$mensajes .= 'Este dato es obligatorio,';
		}
		if (!$enlace) {
			$contador++; $campos .= 'enlace,';
			$mensajes .= 'Este dato es obligatorio,';
		}
		if (!$fecha) {
			$contador++; $campos .= 'fecha,';
			$mensajes .= 'Este dato es obligatorio,';
		}
		if (!$descripcion) {
			$contador++; $campos .= 'descripcion,';
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
			'Titulo' => ucfirst($this->request->getPost('titulo')),
			'Categoria' => mb_strtoupper($this->request->getPost('categoria')),
			'Cliente' => ucwords($this->request->getPost('cliente')),
			'Enlace' => $this->request->getPost('enlace'),
			'Fecha' => $this->request->getPost('fecha'),
			'Descripcion' => $this->request->getPost('descripcion'),
		);
		if ($id) {
			$this->proyectos->where([
				'IdProyecto' => $id,
			])->set($datos)->update();
		} else {
			$id = $this->generarId();
			$datos['IdProyecto'] = $id;
			$this->proyectos->insert($datos);
		}
		return 'success';
    }

	public function borrar() {
		$id = $this->request->getPost('id');
		if (!$id) return 'error';
		if ($this->proyectos->where('IdProyecto', $id)->delete()) return 'ok';
		else return 'uso';
	}

	public function generarId() {
        $id = 0;
        while (true) {
            $id++;
            if (!$this->proyectos->where('IdProyecto', $id)->first()) return $id;
        }
	}
}