<?php
class Cliente
{
    public $id_Cliente = 0;
    public $nombreCliente = "";
    public $apellidos = "";
    public $email = "";
    public $contrasenia = "";
    public $edad = 0;
    public $peso = "";
    public $estatura = "";
    public $brazoR = "";
    public $brazoC = "";
    public $cintura = "";
    public $pierna = "";
    public $intereses = "";
    public $genero = "";
    public $tipoUsuario = "";
    public $status = "";
}

class ClienteConRutina{
    public $id_Cliente;
    public $id_Solicitud;
    public $nombreCliente;
    public $apellidos;
    public $edad;
    public $genero;
    public $tipoRutina;
    public $nombreProfesional;
}
?>