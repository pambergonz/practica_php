<?php
$title = "Resgister";
require_once("partials/head.php");
require_once("controller.php");

var_dump($_FILES);

$countries = [
  'ar' => 'Argentina',
  'br' => 'Brasil',
  'bo' => 'Bolivia',
  'co' => 'Colombia',
  'cl' => 'Chile',
  'ec' => 'Ecuador',
  'pe' => 'Perú',
  've' => 'Venezuela',
];


if ($_POST) {
  $errorsInRegister = registerValidate();

  $fullNameInPost= $_POST['name'];
  $emailInPost= $_POST['email'];


  if (!$errorsInRegister){

    $_POST['laImagenFinal'] = savePic($_FILES['avatar']);

    saveUsers();


    header("location:perfil.php?email=$emailInPost");
  }
}

?>


<form method="post" enctype="multipart/form-data">
  <label> Nombre completo:
    <input type="text" name="name" value= "<?=isset($fullNameInPost) ? $fullNameInPost:"";?>" >
  </label>
  <?php if (isset($errorsInRegister['inFullName'])) : ?>
    <?=$errorsInRegister['inFullName']?>
  <?php endif; ?>
  <br>
  <label> Email:
  <input type="text" name="email" value="<?=isset($emailInPost) ? $emailInPost:"";?>">
  </label>
  <?php if (isset($errorsInRegister['inEmail'])) : ?>
    <?=$errorsInRegister['inEmail']?>
  <?php endif; ?>
  <br>
  <select name="nacionalidad">
    <option value=""> Elegi tu pais de residencia </option>
    <?php foreach ($countries as $code => $country): ?>
      <option value="<?= $code ?>"> <?= $country ?><br> </option>
    <?php endforeach; ?>
  </select>
  <?=isset($errorsInRegister['inCountry'])?$errorsInRegister['inCountry']: "" ?>

  <br>
  <label>Clave:
  <input type="password" name="password">
  </label>
  <?php if (isset($errorsInRegister['inPassword'])) : ?>
    <?=$errorsInRegister['inPassword']?>
  <?php endif; ?>
  <br>


  <label>Repeti Clave:
  <input type="password" name="repassword">
  </label>
  <?php if (isset($errorsInRegister['inrePassword'])) : ?>
    <?=$errorsInRegister['inrePassword']?>
  <?php endif; ?>
  <br>
  <label> Subi tu imagen
    <input type="file" name="avatar">
  </label>
  <input type="submit" value="Submit">

</form>

   </body>
 </html>
