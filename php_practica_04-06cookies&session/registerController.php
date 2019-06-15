<?php

function loginValidate() {
  $errores = [];
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);

  if (empty($password)) {
    $errores['inPassword']="Completá tu contraseña";
  }
  elseif (passwordMatch($password)) {
    $errores['inPassword'] = "credenciales incorrectas";
  }
  elseif(emailExist($email) == false && passwordMatch($password) == true){
    $errores['inEmail']="Credenciales incorrectas, registrate acá";
  }

  if (empty($email)) {
    $errores['inEmail']="Completá tu email";
  }
  elseif(emailExist($email) == false && passwordMatch($password) == true){
    $errores['inEmail']=" ";
  }
  elseif(emailExist($email) == false){
    $errores['inEmail']="Credenciales incorrectas";
  }

  return $errores;
}

function registerValidate() {
  $errors = [];
  $fullName = trim($_POST['name']);
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);
  $repassword = trim($_POST['repassword']);
  $country= $_POST['nacionalidad'];

  if (empty($fullName)) {
    $errors['inFullName']="Completá tu nombre";
  }
  if (empty($email)) {
    $errors['inEmail']="Completá tu email";
  }
  elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
    $errors['inEmail'] = "Introducí un formato de mail correcto";
  }
  elseif (emailExist($email)) {
    $errors['inEmail'] = "el mail ya esta registrado";
  }
  if(empty($country)){
    $errors['inCountry'] = "completá tu nacionalidad";
  }
  if (empty($password)) {
    $errors['inPassword']="Completá tu contraseña";
  }
  elseif (strlen($password) < 6 ) {
    $errors['inPassword'] = "La contraseña debe tener mas de cinco caracteres";
  }
  if (empty($repassword)) {
    $errors['inrePassword']="Volvé a escribir tu contrasena";
  }
  elseif ($password !== $repassword) {
    $errors['inrePassword']="la contrasena no coinicide";
  }
  return $errors;
}

function saveUsers() {

  $allusersInArray = allUsers();

  $_POST["id"]= addUserId();
  unset($_POST["repassword"]);
  $_POST["password"] = password_hash($_POST["password"], PASSWORD_DEFAULT);
  //hay que trimmear cada campo antes de guardarlo en array. si no error ej caracteres en blanco no funcionaba emailexist()
  $allusersInArray[] = $_POST;

  $jsonNewUser= json_encode($allusersInArray, JSON_PRETTY_PRINT);

  FILE_PUT_CONTENTS("users.json", $jsonNewUser);
}

function allUsers(){
  $users = file_get_contents("users.json");
  return json_decode($users, true);
}

function emailExist($email){
  $allUsers = allUsers();
  foreach ($allUsers as $oneUser) {
    if ($oneUser["email"] == $email){
      return true;
    }
  }
     return false;
}

function addUserId(){
  $allUsers = allUsers();
  $lastUser = array_pop($allUsers);
  if (!$allUsers) {
  return $lastUser["id"] = 1;
  }
  else {
  return $lastUser["id"] + 1;
  }
}

function getAUserByEmail($email){
  $allUsers = allUsers();
  foreach ($allUsers as $oneUser) {
    if ($oneUser["email"] == $email){
      return $oneUser;
    }
  }
     return NULL;
}





function passwordMatch($password){
$allUsers = allUsers();
foreach ($allUsers as $oneUser) {
  if(password_verify($password,$oneUser["password"])){
    return false;
  }
 }
 if(password_verify($password,$oneUser["password"]) == false){
   return true;
 }
}

//cambiar las variables por parametros
function passEmailMatch($email,$password){
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);
  $allUsers = allUsers();
  foreach ($allUsers as $oneUser) {
    if(password_verify($password,$oneUser["password"]) && $oneUser["email"] == $email){
    return $oneUser;
    }
  }
}







 ?>
