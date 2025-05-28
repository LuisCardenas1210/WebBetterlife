<?php
//importa la clase conexión y el modelo para usarlos
require_once 'Conexion.php';
require_once 'Modelos/Profesional.php';

class DAOProfesional
{

    private $conexion;

    /**
     * Permite obtener la conexión a la BD
     */
    private function conectar()
    {
        try {
            $this->conexion = Conexion::conectar();
        } catch (Exception $e) {
            die($e->getMessage()); /*Si la conexion no se establece se cortara el flujo enviando un mensaje con el error*/
        }
    }

    public function agregarProfesional(Profesional $obj)
    {
        $clave = 0;
        try {
            $sql = "INSERT into Profesionales (nombre,apellidos,email,contrasenia,especialidad,enfoque,eslogan,tipoUsuario)
            values (:nombre,:apellidos,:email,sha224(:contrasenia),:especialidad,:enfoque,:eslogan,:tipoUsuario);";

            $this->conectar();
            $this->conexion->prepare($sql)
                ->execute(array(
                ':nombre' => $obj->nombreProfesional,
                ':apellidos' => $obj->apellidos,
                ':email'=> $obj->email,
                ':contrasenia'=> $obj->contrasenia,
                ':edad'=> $obj->especialidad,
                ':peso'=> $obj->enfoque,
                ':estatura'=> $obj->eslogan,
                ':tipoUsuario'=> $obj->tipoUsuario
                ));

            $clave = $this->conexion->lastInsertId();
            return $clave;
        } catch (Exception $e) {

            return $clave;
        } finally {

            /*En caso de que se necesite manejar transacciones, 
            no deberá desconectarse mientras la transacción deba 
            persistir*/

            Conexion::desconectar();
        }
    }
}