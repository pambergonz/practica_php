<?php
//si el usuario no está logueado no deberia acceder a perfil.php
require_once("registerController.php");
require_once("partials/head.php");

if (isset($_SESSION["email"])) {
echo "hola " . $_SESSION['email'] . "!!!!!!Gracias por ser parte de Digicom!!";
echo "hola " . $_COOKIE['email'] . "!!!!!!Gracias por ser parte de Digicom!!";
}

echo "<pre>";
var_dump($_COOKIE);
echo "</pre>";
echo "<pre>";
var_dump($_SESSION);
echo "</pre>";



?>

  <!-- si preguno si session tiene algo adentro-->
<?php /*if (session_start()): */ ?>

<?php if ($_SESSION == TRUE): ?>
  <a href="logout.php">deslogueate</a><br>
  <a href="modificarperfil.php">Modificá tu información personal haciendo clik acá</a>
<?php endif; ?>
