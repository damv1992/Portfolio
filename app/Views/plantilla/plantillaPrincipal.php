<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <?= $this->renderSection('estilos') ?>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicon -->
    <link href="<?=base_url($configuracion['Icono'])?>" rel="icon">

    <!-- Vendor CSS Files -->
    <link href="<?=base_url()?>/MyResume/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="<?=base_url()?>/MyResume/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>/MyResume/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?=base_url()?>/MyResume/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?=base_url()?>/MyResume/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="<?=base_url()?>/MyResume/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- DataTables -->
    <link rel="stylesheet"
        href="https://adminlte.io/themes/v3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="https://adminlte.io/themes/v3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet"
        href="https://adminlte.io/themes/v3/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <!-- Template Main CSS File -->
    <link href="<?=base_url()?>/MyResume/assets/css/style.css" rel="stylesheet">

    <script src="https://cdn.ckeditor.com/ckeditor5/28.0.0/decoupled-document/ckeditor.js"></script>

    <!-- =======================================================
  * Template Name: MyResume - v4.9.2
  * Template URL: https://bootstrapmade.com/free-html-bootstrap-template-my-resume/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
    <input class="site_url" value="<?=site_url()?>" type="hidden">
    <!-- MODAL LOGIN -->
    <div class="modalLogin modal fade" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <!-- HEADER MODAL -->
                    <div class="modal-header">
                        <h4 class="modal-title">Ingresar al Sistema</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- BODY MODAL -->
                    <div class="modal-body">
                        <div class="box-body">
                            <!-- FORMULARIO -->
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="bx bx-user"></i></span>
                                <input class="txtUsuario form-control" placeholder="Usuario" type="text">
                            </div>

                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="bx bx-key"></i></span>
                                <input class="txtContraseña form-control" placeholder="Contraseña" type="password">
                            </div>
                        </div>
                    </div>
                    <!-- FOOTER MODAL -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary float-start"
                            data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btnLogin btn btn-primary">Iniciar Sesión</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ======= Mobile nav toggle button ======= -->
    <!-- <button type="button" class="mobile-nav-toggle d-xl-none"><i class="bi bi-list mobile-nav-toggle"></i></button> -->
    <i class="bi bi-list mobile-nav-toggle d-lg-none"></i>
    <!-- ======= Header ======= -->
    <header id="header" class="d-flex flex-column justify-content-center">

        <nav id="navbar" class="navbar nav-menu">
            <ul>
                <li><a href="<?=base_url()?>" class="nav-link scrollto active"><i class="bx bx-home"></i>
                        <span>Inicio</span></a>
                </li>
                <li><a href="<?=base_url()?>#about" class="nav-link scrollto"><i class="bx bx-user"></i>
                        <span>Acerca</span></a>
                </li>
                <li><a href="<?=base_url()?>#resume" class="nav-link scrollto"><i class="bx bx-file-blank"></i>
                        <span>Resumen</span></a></li>
                <li><a href="<?=base_url()?>#portfolio" class="nav-link scrollto"><i
                            class="bx bx-book-content"></i><span>Proyectos</span></a></li>
                <li><a href="<?=base_url()?>#contact" class="nav-link scrollto"><i class="bx bx-envelope"></i>
                        <span>Contacto</span></a></li>
                <li><a href="<?=site_url('home/generarCurriculum')?>" class="nav-link scrollto"><i class='bx bxs-file-pdf'></i>
                        <span>Curriculum Vitae</span></a></li>
                <li><a href="<?=site_url('home/generarHoja')?>" class="nav-link scrollto"><i class='bx bxs-file-pdf'></i>
                        <span>Hoja de vida</span></a></li>
                <?php if ($_SESSION['Usuario']) { ?>
                <li><a href="<?=site_url('admin')?>" class="admins nav-link scrollto"><i class="bx bxs-dashboard"></i>
                        <span><?=ucfirst($_SESSION['Usuario'])?></span></a></li>
                <li><a href="<?=site_url('admin/logout')?>" class="nav-link scrollto"><i class="bx bx-log-out"></i>
                        <span>Salir</span></a></li>
                <?php } else { ?>
                <li><a data-bs-toggle="modal" data-bs-target=".modalLogin" class="nav-link scrollto"><i
                            class="bx bx-log-in"></i> <span>Acceso</span></a></li>
                <?php } ?>
            </ul>
        </nav><!-- .nav-menu -->

    </header><!-- End Header -->

    <?= $this->renderSection('contenido') ?>

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="<?=base_url()?>/MyResume/assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="<?=base_url()?>/MyResume/assets/vendor/aos/aos.js"></script>
    <script src="<?=base_url()?>/MyResume/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?=base_url()?>/MyResume/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="<?=base_url()?>/MyResume/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="<?=base_url()?>/MyResume/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="<?=base_url()?>/MyResume/assets/vendor/typed.js/typed.min.js"></script>
    <script src="<?=base_url()?>/MyResume/assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="<?=base_url()?>/MyResume/assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="<?=base_url()?>/MyResume/assets/js/main.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/4e9b2e5c90.js"></script>

    <!-- DataTables & Plugins -->
    <script src="https://adminlte.io/themes/v3/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="https://adminlte.io/themes/v3/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://adminlte.io/themes/v3/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="https://adminlte.io/themes/v3/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="https://adminlte.io/themes/v3/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="https://adminlte.io/themes/v3/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="https://adminlte.io/themes/v3/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="https://adminlte.io/themes/v3/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="https://adminlte.io/themes/v3/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="<?=base_url()?>/custom/js/ajax.js"></script>
    <script src="<?=base_url()?>/custom/js/usuario.js"></script>
    <script src="<?=base_url()?>/custom/js/contacto.js"></script>
    <?= $this->renderSection('scripts') ?>
</body>

</html>