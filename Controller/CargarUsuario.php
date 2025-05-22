<?php
include_once 'Modelos/Usuario.php';
$Lista_usuarios=[];
$usuario=new Usuario();
$usuario->nombre="Luis Manuel";
$usuario->apellido="Cardenas Ibarra";
$usuario->edad=20;
$usuario->correoE="lcardenas@gmail.com";
$usuario->sexo="Masculino";
$usuario->fechaNac="04/11/2004";
$usuario->intereces="Ambas";
$usuario->contrasenia="1234";

$Lista_usuarios[] = $usuario;

?>