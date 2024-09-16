<?php
session_start();
// Define default title, additional CSS, and additional JS
$title = "School Management System";
$additionalCss = "";
$additionalJs = "";

if (isset($pageTitle)) {
  $title = $pageTitle;
}
if (isset($pageCss)) {
  $additionalCss = $pageCss;
}
if (isset($pageJs)) {
  $additionalJs = $pageJs;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo htmlspecialchars($title); ?></title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./cdns/css/fontawesome/all.min.css">
  <link rel="stylesheet" href="./cdns/css/fontawesome/fontawesome.min.css">
  <!-- Google Fonts -->
  <link rel="stylesheet" href="./cdns/css/googlefont.css">
  <!-- Bootstrap core CSS -->
  <link href="./cdns/css/bootstrap.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="./cdns/css/md.css" rel="stylesheet">
  <!-- Additional CSS -->
  <?php echo $additionalCss; ?>
  <!-- JQuery -->
  <script type="text/javascript" src="./cdns/js/jquery.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="./cdns/js/bootstraptooltips.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="./cdns/js/bootstrapcore.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="./cdns/js/md.js"></script>
  <!-- Additional JS -->
  <?php echo $additionalJs; ?>
</head>