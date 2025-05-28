<?php
require_once 'Conexion.php';
require_once 'Modelos/Usuario.php';

class DAOUsuario
{
    private $conexion;

    private function conectar()
    {
        try {
            $this->conexion = Conexion::conectar();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function autenticar($correoE, $contrasenia)
    {
        try {
            $this->conectar();

            $obj = null;
            $sentenciaSQL = $this->conexion->prepare("
                SELECT id_cliente AS id, nombre, apellidos, tipousuario, email, 'cliente' AS tipo 
                FROM Clientes 
                WHERE email = ? AND contrasenia = sha224(?)
                
                UNION
                
                SELECT id_profesional AS id, nombre, apellidos, tipousuario, email, 'profesional' AS tipo 
                FROM Profesionales 
                WHERE email = ? AND contrasenia = sha224(?)
            ");
            $sentenciaSQL->execute([$correoE, $contrasenia, $correoE, $contrasenia]);

            $fila = $sentenciaSQL->fetch(PDO::FETCH_OBJ);
            if ($fila) {
    $obj = new Usuario();
    // asigna el ID al campo correcto:
    if ($fila->tipo === 'cliente') {
        $obj->id_Cliente = $fila->id;
    } else {
        $obj->id_Profesional = $fila->id;
    }
    $obj->nombre      = $fila->nombre;
    $obj->apellidos   = $fila->apellidos;
    $obj->tipoUsuario = $fila->tipousuario;
    $obj->correoE     = $fila->email;
    // el campo $fila->tipo ('cliente'|'profesional') podrías guardarlo en, por ejemplo:
    $obj->sexo        = $fila->tipo;  // o crea una propiedad 'rol'
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
            $sentenciaSQL = $this->conexion->prepare("SELECT id_cliente, nombre, apellidos, tipousuario, email, status FROM clientes");
            $sentenciaSQL->execute();
            $resultado = $sentenciaSQL->fetchAll(PDO::FETCH_OBJ);

            foreach ($resultado as $fila) {
                $cliente = new Usuario();
                $cliente->id_Cliente = $fila->id_cliente;
                $cliente->nombre = $fila->nombre;
                $cliente->apellidos = $fila->apellidos;
                $cliente->tipoUsuario = $fila->tipousuario;
                $cliente->correoE = $fila->email;
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
            $sentenciaSQL = $this->conexion->prepare("SELECT id_profesional, nombre, apellidos, tipousuario, email, status FROM profesionales WHERE tipousuario != 'admin'");
            $sentenciaSQL->execute();
            $resultado = $sentenciaSQL->fetchAll(PDO::FETCH_OBJ);

            foreach ($resultado as $fila) {
                $profesional = new Usuario();
                $profesional->id_Profesional = $fila->id_profesional;
                $profesional->nombre = $fila->nombre;
                $profesional->apellidos = $fila->apellidos;
                $profesional->tipoUsuario = $fila->tipousuario;
                $profesional->correoE = $fila->email;
                $lista[] = $profesional;
            }

            return $lista;
        } catch (PDOException $e) {
            return null;
        } finally {
            Conexion::desconectar();
        }
    }

    public function cambiarEstadoCliente($idCliente, $nuevoEstado)
    {
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

    public function obtenerClientePorId($idCliente)
    {
        try {
            $this->conectar();

            $sql = $this->conexion->prepare("SELECT id_cliente, nombre, apellidos, tipousuario, email, status FROM clientes WHERE id_cliente = :id");
            $sql->bindParam(':id', $idCliente, PDO::PARAM_INT);
            $sql->execute();
            $fila = $sql->fetch(PDO::FETCH_OBJ);

            if ($fila) {
                $cliente = new Usuario();
                $cliente->id_Cliente = $fila->id_cliente;
                $cliente->nombre = $fila->nombre;
                $cliente->apellidos = $fila->apellidos;
                $cliente->tipoUsuario = $fila->tipousuario;
                $cliente->correoE = $fila->email;
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

    public function editar(Usuario $obj)
    {
        try {
            $sql = "UPDATE usuarios
                    SET nombre = ?, apellido1 = ?, apellido2 = ?, email = ?, genero = ?, telefono = ?, rol = ?, contrasenia = sha224(?)
                    WHERE id = ?";

            $this->conectar();

            $sentenciaSQL = $this->conexion->prepare($sql);
            $sentenciaSQL->execute([
                $obj->nombre,
                $obj->apellido1,
                $obj->apellido2,
                $obj->correo,
                $obj->genero,
                $obj->telefono,
                $obj->rol,
                $obj->contrasenia,
                $obj->id
            ]);
            return true;
        } catch (PDOException $e) {
            return false;
        } finally {
            Conexion::desconectar();
        }
    }
}
