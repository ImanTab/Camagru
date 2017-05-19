<link rel="stylesheet" type="text/css" href="css/main.css" />
<html>
  <head>
      <meta charset="utf-8" />
      <link rel="stylesheet" href="style.css" />
      <title>Camagru - Accueil</title>
  </head>
  <body>
<?php

require 'header.php';

if (isset($_SESSION['pseudo']) && $_SESSION['id'] == true)
{
?>
<section class="main_section">
  <div id="cam_section">
    <button id="cam_on">Lancer la cam</button>
    <button id="cam_off">Fermer la cam</button>
    <!-- <video id="video"></video> -->
  <button id="startbutton">Prendre une photo</button>
  </div>
  <div id="gallery">
    <canvas id="canvas"></canvas>
  </div>
</section>

<aside>

</aside>
<?php require "footer.php";
}
else {
  header('Location: ./index.php');
  exit();
}
?>
<script src="js/cam_script.js"></script>
</body>
</html>
