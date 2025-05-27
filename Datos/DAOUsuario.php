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

    public function obtenerClientes()
    {
        try {
            $this->conectar();

            $lista = array();
            /*Se arma la sentencia sql para seleccionar todos los registros de la base de datos*/
            $sentenciaSQL = $this->conexion->prepare("SELECT  id_cliente, nombre, apellidos, tipousuario, email from clientes;");
            //Se ejecuta la sentencia sql, retorna un cursor con todos los elementos
            $sentenciaSQL->execute();
            //$resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
            $resultado = $sentenciaSQL->fetchAll(PDO::FETCH_OBJ);
            /*Podemos obtener un cursor (resultado con todos los renglones como 
            un arreglo de arreglos asociativos o un arreglo de objetos*/
            /*Se recorre el cursor para obtener los datos*/
            foreach ($resultado as $fila) {
                $cliente = new Usuario();
                $cliente->id_Cliente = $fila->id_cliente;
                $cliente->nombre = $fila->nombre;
                $cliente->apellidos = $fila->apellidos;
                $cliente->tipoUsuario = $fila->tipousuario;
                $cliente->correoE = $fila->email;
                $lista[] = $cliente;
            }

            return $lista;
        } catch (PDOException $e) {
            return null;
        } finally {
            Conexion::desconectar();
        }
    }

    public function obtenerProfesionales()
    {
        try {
            $this->conectar();

            $lista = array();
            /*Se arma la sentencia sql para seleccionar todos los registros de la base de datos*/
            $sentenciaSQL = $this->conexion->prepare("SELECT  id_profesional, nombre, apellidos, tipousuario, email from profesionales where tipousuario != 'admin      ';");
            //Se ejecuta la sentencia sql, retorna un cursor con todos los elementos
            $sentenciaSQL->execute();
            //$resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
            $resultado = $sentenciaSQL->fetchAll(PDO::FETCH_OBJ);
            /*Podemos obtener un cursor (resultado con todos los renglones como 
            un arreglo de arreglos asociativos o un arreglo de objetos*/
            /*Se recorre el cursor para obtener los datos*/
            foreach ($resultado as $fila) {
                $cliente = new Usuario();
                $cliente->id_Profesional = $fila->id_profesional;
                $cliente->nombre = $fila->nombre;
                $cliente->apellidos = $fila->apellidos;
                $cliente->tipoUsuario = $fila->tipousuario;
                $cliente->correoE = $fila->email;
                $lista[] = $cliente;
            }

            return $lista;
        } catch (PDOException $e) {
            return null;
        } finally {
            Conexion::desconectar();
        }
    }

    /**
     * Elimina el usuario con el id indicado como parámetro
     */
    public function eliminarCliente($id)
    {
        try {
            $this->conectar();

            $sentenciaSQL = $this->conexion->prepare("DELETE FROM Clientes WHERE id_cliente = ?");
            $resultado = $sentenciaSQL->execute(array($id));
            return $resultado;
        } catch (PDOException $e) {
            //Si quieres acceder expecíficamente al numero de error
            //se puede consultar la propiedad errorInfo
            echo "Error al eliminar: " . $e->getMessage();
            return false;
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