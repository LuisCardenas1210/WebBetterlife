<?php
//importa la clase conexión y el modelo para usarlos
require_once 'Conexion.php';
require_once 'Modelos/Usuario.php';
require_once 'Modelos/Cliente.php';
require_once 'Modelos/Profesional.php';

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
            COALESCE(c.tipousuario, p.tipousuario) AS tipoUsuario, COALESCE(c.status, p.status) AS status
            FROM Clientes c
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
                $obj->status = $fila->status;
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
            $sentenciaSQL = $this->conexion->prepare("SELECT  id_cliente, nombre, apellidos, tipousuario, email, status from clientes");
            //Se ejecuta la sentencia sql, retorna un cursor con todos los elementos
            $sentenciaSQL->execute();
            //$resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
            $resultado = $sentenciaSQL->fetchAll(PDO::FETCH_OBJ);
            /*Podemos obtener un cursor (resultado con todos los renglones como 
            un arreglo de arreglos asociativos o un arreglo de objetos*/
            /*Se recorre el cursor para obtener los datos*/
            foreach ($resultado as $fila) {
                $cliente = new Cliente();
                $cliente->id_Cliente = $fila->id_cliente;
                $cliente->nombre = $fila->nombre;
                $cliente->apellidos = $fila->apellidos;
                $cliente->tipoUsuario = $fila->tipousuario;
                $cliente->email = $fila->email;
                $cliente->status = $fila->status;
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
            $sentenciaSQL = $this->conexion->prepare("SELECT  id_profesional, nombre, apellidos, tipousuario, email, status from profesionales where tipousuario != 'admin';");
            //Se ejecuta la sentencia sql, retorna un cursor con todos los elementos
            $sentenciaSQL->execute();
            //$resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
            $resultado = $sentenciaSQL->fetchAll(PDO::FETCH_OBJ);
            /*Podemos obtener un cursor (resultado con todos los renglones como 
            un arreglo de arreglos asociativos o un arreglo de objetos*/
            /*Se recorre el cursor para obtener los datos*/
            foreach ($resultado as $fila) {
                $cliente = new Profesional();
                $cliente->id_Profesional = $fila->id_profesional;
                $cliente->nombreProfesional = $fila->nombre;
                $cliente->apellidos = $fila->apellidos;
                $cliente->tipoUsuario = $fila->tipousuario;
                $cliente->email = $fila->email;
                $lista[] = $cliente;
            }

            return $lista;
        } catch (PDOException $e) {
            return null;
        } finally {
            Conexion::desconectar();
        }
    }

    public function cambiarEstadoCliente($idCliente, $nuevoEstado){
        try {
            $this->conectar();
            $sql = $this->conexion->prepare("UPDATE clientes SET status = :estado WHERE id_cliente = :id");
            $sql->bindParam(':estado', $nuevoEstado, PDO::PARAM_BOOL);
            $sql->bindParam(':id', $idCliente, PDO::PARAM_INT);
            $sql->execute();
        } catch (PDOException $e) {
            // Manejo de errores
        } finally {
            Conexion::desconectar();
        }
    }

    public function obtenerClientePorId($idCliente){
        try {
            $this->conectar();

            $sql = $this->conexion->prepare("SELECT id_cliente, nombre, apellidos, tipousuario, email, status FROM clientes WHERE id_cliente = :id");
            $sql->bindParam(':id', $idCliente, PDO::PARAM_INT);
            $sql->execute();
            $fila = $sql->fetch(PDO::FETCH_OBJ);

            if ($fila) {
                $cliente = new Cliente();
                $cliente->id_Cliente = $fila->id_cliente;
                $cliente->nombre = $fila->nombre;
                $cliente->apellidos = $fila->apellidos;
                $cliente->tipoUsuario = $fila->tipousuario;
                $cliente->email = $fila->email;
                $cliente->status = $fila->status;
                return $cliente;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            return null;
        } finally {
            Conexion::desconectar();
        }
    }


    /**
     * Función para editar al empleado de acuerdo al objeto recibido como parámetro
     */
    /* public function editar(Usuario $obj)
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
    } */
}