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
    <?= $this->renderSection('contenido') ?>

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
    <?= $this->renderSection('scripts') ?>
</body>

</html>