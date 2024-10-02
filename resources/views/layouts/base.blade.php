<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>GrafiTareas </title>

    <!-- Custom fonts for this template-->
    

   





    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
     <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
     <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">


     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" defer></script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" defer></script>
     <script src="https://cdn.jsdelivr.net/npm/chart.js" ></script>
 

     
    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- Asegúrate de que esto esté presente -->

    <!---->
</head>

<body id="page-top">
    
    <div id="loading" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 9999;">
        <h2>Cargando...</h2>
    </div>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- End of Sidebar -->
        @include('partials.sidebar') <!-- Incluir la vista de la card -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('partials.navbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->

                 @yield('content')

    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Custom scripts for all pages-->

    <!-- Page level plugins -->


    <script>
        // Mostrar el mensaje de carga al iniciar la carga de la página
        document.getElementById('loading').style.display = 'block';
    
        // Ocultar el mensaje de carga cuando la página esté completamente cargada
        window.onload = function() {
            document.getElementById('loading').style.display = 'none';
        };
    </script>


</body>

</html>