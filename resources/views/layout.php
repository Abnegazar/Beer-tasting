<?php
$connectedUser = Session::getConnectedUser();
?>
<!DOCTYPE html>
<html lang="en">

<head>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="../../assets/favicon.ico" />
        <!-- Bootstrap Icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
        <!-- SimpleLightbox plugin CSS-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../css/styles.css" rel="stylesheet" />
    <title><?php echo $var->title ?></title>
</head>

<body>
     <?php if ($connecteduser == null) {
         //Menu pour les visiteurs
        include_once("./partials/nav_1.php");
      } else{
        //Menu pour la page d'acceuil des connectés
     }
     ?>
    <?php echo $var->content ?>
      <!-- Footer-->
  <footer class="bg-light py-5">
            <div class="container px-4 px-lg-5"><div class="small text-center text-muted">Copyright &copy; 2021 - Tasting Beer</div></div>
        </footer>
  <!-- Bootstrap core JS-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
        <script src="../js/scripts.js"></script>
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>