<?php
//importa la clase conexión y el modelo para usarlos
require_once 'Conexion.php';
require_once 'Modelos/Usuario.php';

class DAOUsuario
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

    public function autenticar($correoE, $contrasenia)
    {
        try {
            $this->conectar();

            //Almacenará el registro obtenido de la BD
            $obj = null;
            $correoE2 = $correoE;
            $contrasenia2 = $contrasenia;
            $sentenciaSQL = $this->conexion->prepare("SELECT c.id_cliente, p.id_profesional,
            COALESCE(c.nombre, p.nombre) AS nombre, COALESCE(c.apellidos, p.apellidos) AS apellidos,
            COALESCE(c.tipousuario, p.tipousuario) AS tipoUsuario FROM Clientes c
            FULL OUTER JOIN Profesionales p ON 1=0 WHERE (c.email=? AND c.contrasenia=sha224(?))
            or (p.email=? AND p.contrasenia=sha224(?));");
            $sentenciaSQL->execute([$correoE, $contrasenia, $correoE2, $contrasenia2]);

            /*Obtiene los datos*/
            $fila = $sentenciaSQL->fetch(PDO::FETCH_OBJ);
            if ($fila) {
                $obj = new Usuario();
                $obj->id_Cliente = $fila->id_cliente;
                $obj->id_Profesional = $fila->id_profesional;
                $obj->nombre = $fila->nombre;
                $obj->apellidos = $fila->apellidos;
                $obj->tipoUsuario = $fila->tipousuario;
            }
            return $obj;
        } catch (Exception $e) {
            var_dump($e);
            return null;
        } finally {
            Conexion::desconectar();
        }
    }

    

    /**
     * Función para editar al empleado de acuerdo al objeto recibido como parámetro
     */
    public function editar(Usuario $obj)
    {
        try {
            $sql = "UPDATE usuarios
                    SET
                    nombre = ?,
                    apellido1 = ?,
                    apellido2 = ?,
                    email = ?,
                    genero = ?,
                    telefono = ?,
                    rol = ?,
                    contrasenia = sha224(?)
                    WHERE id = ?;";

            $this->conectar();

            $sentenciaSQL = $this->conexion->prepare($sql);
            $sentenciaSQL->execute(
                array(
                    $obj->nombre,
                    $obj->apellido1,
                    $obj->apellido2,
                    $obj->correo,
                    $obj->genero,
                    $obj->telefono,
                    $obj->rol,
                    $obj->contrasenia,
                    $obj->id
                )
            );
            return true;
        } catch (PDOException $e) {

            //var_dump($e);
            //Si quieres acceder expecíficamente al numero de error
            //se puede consultar la propiedad errorInfo
            return false;
        } finally {
            Conexion::desconectar();
        }
    }
}