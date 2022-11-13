<?php

namespace App\Controllers;

use App\Models\ConfiguracionModel;
use App\Models\RedesSocialesModel;
use App\Models\AcercaModel;
use App\Models\HabilidadesModel;
use App\Models\ExperienciasModel;
use App\Models\EducacionesModel;
use App\Models\CursosModel;
use App\Models\ProyectosModel;

class Home extends BaseController {

	public function __construct() {
        $this->session = \Config\Services::session();
        $this->session->start();
		$this->configuraciones = new ConfiguracionModel();
		$this->sociales = new RedesSocialesModel();
		$this->acercas = new AcercaModel();
		$this->habilidades = new HabilidadesModel();
		$this->experiencias = new ExperienciasModel();
		$this->educaciones = new EducacionesModel();
		$this->cursos = new CursosModel();
		$this->proyectos = new ProyectosModel();
	}

	public function index() {
		$configuracion = $this->configuraciones->first();
		if (!$configuracion) $this->generarDatosPagina();
		$datos = $this->datosPrincipales();
		$datos += $this->datosSecundarios();
		$datos += [
			'titulo' => 'Inicio',
		];
		return view('index', $datos);
	}

	public function datosPrincipales() {
		$configuracion = $this->configuraciones->first();
		$datos = [
			'configuracion' => $configuracion,
		];
		return $datos;
	}

	public function datosSecundarios() {
		$socialess = $this->sociales->orderBy('Enlace ASC')->findAll();
		$acerca = $this->acercas->first();
		$habilidadess = $this->habilidades->orderBy('Habilidad ASC')->findAll();
		$experienciass = $this->experiencias->orderBy('FechaInicio DESC')->findAll();
		$educacioness = $this->educaciones->orderBy('FechaInicio DESC')->findAll();
		$cursoss = $this->cursos->orderBy('FechaInicio DESC')->findAll();
		$proyectoss = $this->proyectos->orderBy('Fecha DESC')->findAll();
		$categorias = $this->proyectos->orderBy('Categoria ASC')->groupBy('Categoria')->findAll();
		$datos = [
			'socialess' => $socialess,
			'acerca' => $acerca,
			'habilidadess' => $habilidadess,
			'experienciass' => $experienciass,
			'educacioness' => $educacioness,
			'cursoss' => $cursoss,
			'proyectoss' => $proyectoss,
			'categorias' => $categorias,
		];
		return $datos;
	}

	public function generarDatosPagina() {
		$this->configuraciones->insert([
			'Nombre' => 'Nombre Completo',
			'Profesiones' => 'Profesional',
			'Icono' => '/custom/img/favicon.png',
			'Fondo' => '/custom/img/hero-bg.jpg',
			'Correo' => 'email@mail.com',
			'Direccion' => 'Dirección oficina',
			'Telefono' => 12345678,
			'Usuario' => 'admin',
			'Contraseña' => password_hash('admin', PASSWORD_DEFAULT),
		]);
	}

	public function subirArchivo($archivo, $carpeta, $nombre, $ancho, $alto) {
		$extension = $archivo->getExtension();
		$ruta = '/custom/img/';
		if ($carpeta) $ruta .= $carpeta.'/';
		$ruta .= $nombre.'.'.$extension;
		if (file_exists($ruta)) unlink('.'.$ruta);
		\Config\Services::image()
			->withFile($archivo)
			->resize($ancho, $alto, false, 'auto')
			->save('.'.$ruta);
		clearstatcache();
		return $ruta;
	}

	public function validarContacto($nombre, $correo, $asunto, $mensaje) {
		if (!$correo) return 'correo';
		if (!$nombre) return 'nombre';
		if (!$asunto) return 'asunto';
		if (!$mensaje) return 'mensaje';
		return 'ok';
	}

	public function enviarCorreo() {
		$nombre = ucwords($this->request->getPost('nombre'));
		$correo = $this->request->getPost('correo');
		$asunto = ucfirst($this->request->getPost('asunto'));
		$mensaje = $this->request->getPost('mensaje');
		$validar = $this->validarContacto($nombre, $correo, $asunto, $mensaje);
		if ($validar <> 'ok') return $validar;

		$configuracion = $this->configuraciones->first();
		$asunto = $asunto.' | '.$configuracion['NombrePagina'];
		$mensaje .= '<br><p>Atentamente <b>'.$nombre.'.</b></p>';
		// To send HTML mail, the Content-type header must be set
		$headers[] = 'MIME-Version: 1.0';
		$headers[] = 'Content-type: text/html; charset=iso-8859-1';
		// Additional headers
		$headers[] = 'To: '.$configuracion['Nombre'].' <'.$configuracion['Correo'].'>';
		$headers[] = 'From: '.$correo.' <'.$correo.'>';
		// If Mail it
		if (mail($configuracion['Correo'], $asunto, $mensaje, implode('\r\n', $headers))) return 'ok';
		else return 'error';
    }

	public function enviarWhatsApp() {
		$nombre = ucwords($this->request->getPost('nombre'));
		$correo = $this->request->getPost('correo');
		$asunto = ucfirst($this->request->getPost('asunto'));
		$mensaje = $this->request->getPost('mensaje');
		$validar = $this->validarContacto($nombre, $correo, $asunto, $mensaje);
		if ($validar <> 'ok') return $validar;
		
		$configuracion = $this->configuraciones->first();
        $whatsapp = 'https://wa.me/591'.$configuracion['Telefono'].'?text=';
		$mensaje = 'Saludos, '.$configuracion['Nombre'].' me dirijo hacia usted por el siguiente motivo:\n\n'.$mensaje.'\n\n';
		$mensaje .= 'Me despido atentamente\n';
		$mensaje .= $nombre.'\n';
		$mensaje .= $correo;
		$mensaje = str_replace(' ', '%20', $mensaje);
        $mensaje = str_replace('\n', '%0D%0A', $mensaje);
		$whatsapp .= $mensaje;
		return $whatsapp;
	}

	public function curriculum() {
		$configuracion = $this->configuraciones->first();
		$datos = $this->datosPrincipales();
		$datos += $this->datosSecundarios();
		$datos += [
			'titulo' => 'Curriculum',
		];
		return view('pdf/curriculum', $datos);
	}

	public function hoja() {
		$configuracion = $this->configuraciones->first();
		$datos = $this->datosPrincipales();
		$datos += $this->datosSecundarios();
		$datos += [
			'titulo' => 'Hoja',
		];
		return view('pdf/hoja', $datos);
	}

	public function generarCurriculum(){
		$configuracion = $this->configuraciones->first();
		$acerca = $this->acercas->first();
		$datos = $this->datosPrincipales();
		$datos += $this->datosSecundarios();
		$datos += [
			'acerca' => $acerca,
		];
        $dompdf = new \Dompdf\Dompdf(); 
        $dompdf->loadHtml(view('pdf/curriculum', $datos));
        $dompdf->setPaper('letter', 'portrait');
		$dompdf->set_option('defaultFont', 'Arial');
        $dompdf->render();
        $dompdf->stream('Curriculum Vitae - '.$configuracion['Nombre'].'.pdf', ['Attachment' => true]);
    }

	public function generarHoja(){
		$configuracion = $this->configuraciones->first();
		$acerca = $this->acercas->first();
		$datos = $this->datosPrincipales();
		$datos += $this->datosSecundarios();
		$datos += [
			'acerca' => $acerca,
		];
        $dompdf = new \Dompdf\Dompdf(); 
        $dompdf->loadHtml(view('pdf/hoja', $datos));
        $dompdf->setPaper('letter', 'portrait');
		$dompdf->set_option('defaultFont', 'Arial');
        $dompdf->render();
        $dompdf->stream('Hoja de vida - '.$configuracion['Nombre'].'.pdf', ['Attachment' => true]);
    }

	public function error404() {
		$datos = $this->datosPrincipales();
		$datos += [
			'titulo' => 'Página de error 404',
		];
		return view('404', $datos);
	}
}
