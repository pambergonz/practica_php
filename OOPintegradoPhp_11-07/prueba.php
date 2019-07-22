<?php
declare(strict_types = 1);

require_once("usuario.php");
require_once("celular.php");
require_once("habilidad.php");
require_once("funciones.php");


$celular1 = new Celular("zapito","personal");
$celular1->setMarca("iphone");
$celular2 = new Celular("gigante","personal");
$celular2->setMarca("huwai");

$usuario1= new Usuario("Pablo","a@hotmail.com", 123456);
$usuario1->setNombre("Pablo");
$usuario1->setMail("pablito@hotmail.com");
$usuario1->setContraseña("123455");
$usuario1->saludar();
$usuario1->setCelular($celular1);
$usuario1->getCelular()->getMarca();
$usuario1->encriptarPass(11424255);
$usuario1->addHabilidad("nadar",1);
$usuario1->addHabilidad("bucear",2);
$usuario1->addHabilidad("correr",4);
$usuario1->setId(1);
$usuario1->guardar($usuario1);
echo $usuario1->getMarcaCelular();
debug($usuario1);

$usuario2 = new Usuario("Juan","a@hotmail.com", 123456);
$usuario2->setNombre("Marta");
$usuario2->setMail("marta@hotmail.com");
$usuario2->setContraseña(123455);
$usuario2->setCelular($celular2);
echo $usuario2->llamar($usuario1, 20);
$usuario2->addHabilidad("nadar",1);
$usuario2->addHabilidad("bucear",2);
$usuario2->addHabilidad("correr",4);
debug($usuario2);

$usuario3 = new Usuario("Pedro","pedro@hotmail.com",123456);
debug($usuario3);