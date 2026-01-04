<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body style="height: 3000px">
  <!-- Header -->
  <?php include "header.php"; ?>
  <!-- End Header -->
  <div class="container-lg">
    <div class="row">
      <!-- sidebar -->
      <?php include "sidebar.php"; ?>
      <!-- end sidebar -->

      <!-- Content -->
      <?php
      // Debug dulu
      echo "<!-- DEBUG: GET parameter = ";
      print_r($_GET);
      echo " -->";

      $page = isset($_GET['x']) ? $_GET['x'] : 'home';
      $allowed_pages = ['home', 'order', 'customer', 'product', 'report'];

      echo "<!-- Page: $page -->";
      echo "<!-- File: " . $page . ".php -->";

      if (in_array($page, $allowed_pages) && file_exists($page . '.php')) {
        echo "<!-- Including: " . $page . ".php -->";
        include $page . '.php';
      } else {
        echo "<!-- Fallback to home.php -->";
        include 'home.php';
      }
      ?>
    </div>
    <!-- End Content -->
    <div class="fixed-bottom text-center mb-2">
      Copyright 2025 sticky button
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>
</body>

</html>