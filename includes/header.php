<?php
session_start(); // Start the session to manage user state

// Define default values for the title, additional CSS, and additional JS variables
$title = "School Management System";
$additionalCss = "";
$additionalJs = "";

// If specific values for the title, additional CSS, and JS are provided, update the defaults
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
  <meta name="description" content="School Management System for managing courses, timetable, and student information.">
  <meta name="keywords" content="school, management, system, student, courses, timetable">
  <meta name="author" content="Piyus H Kumar">

  <!-- Dynamic Title -->
  <title><?php echo htmlspecialchars($title); ?></title>

  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="./cdns/css/fontawesome/all.min.css">
  <link rel="stylesheet" href="./cdns/css/fontawesome/fontawesome.min.css">

  <!-- Google Fonts CSS -->
  <link rel="stylesheet" href="./cdns/css/googlefont.css">

  <!-- Bootstrap core CSS -->
  <link href="./cdns/css/bootstrap.css" rel="stylesheet">

  <!-- Material Design Bootstrap CSS -->
  <link href="./cdns/css/md.css" rel="stylesheet">

  <!-- Additional CSS: Injected dynamically if defined -->
  <?php echo $additionalCss; ?>

  <!-- Favicon for the webpage -->
  <link rel="shortcut icon" href="teacher/assets/images/favicon.png" />

  <!-- jQuery Library -->
  <script type="text/javascript" src="./cdns/js/jquery.js"></script>

  <!-- Bootstrap Tooltips JavaScript -->
  <script type="text/javascript" src="./cdns/js/bootstraptooltips.js"></script>

  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="./cdns/js/bootstrapcore.js"></script>

  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="./cdns/js/md.js"></script>

  <!-- Additional JS: Injected dynamically if defined -->
  <?php echo $additionalJs; ?>
</head>


