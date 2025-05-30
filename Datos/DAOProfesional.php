<?php
require_once 'Conexion.php';
require_once 'Modelos/Profesional.php';

class DAOProfesional
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

            

            Conexion::desconectar();
        }
    }
    public function eliminarProfesional($id)
    {
        try {
            $this->conectar();

            $sentenciaSQL = $this->conexion->prepare("DELETE FROM Profesionales WHERE id_profesional = ?");
            $resultado = $sentenciaSQL->execute(array($id));
            return $resultado;
        } catch (PDOException $e) {
            echo "Error al eliminar: " . $e->getMessage();
            return false;
        } finally {
            Conexion::desconectar();
        }
    }
    public function obtenerProfesionales()
    {
        try {
            $this->conectar();

            $lista = array();
            $sentenciaSQL = $this->conexion->prepare("SELECT  id_profesional, nombre, apellidos, tipousuario, email, status from profesionales where tipousuario != 'admin';");
            $sentenciaSQL->execute();
            $resultado = $sentenciaSQL->fetchAll(PDO::FETCH_OBJ);
            
            foreach ($resultado as $fila) {
                $Profesional = new Profesional();
                $Profesional->id_Profesional = $fila->id_profesional;
                $Profesional->nombreProfesional = $fila->nombre;
                $Profesional->apellidos = $fila->apellidos;
                $Profesional->tipoUsuario = $fila->tipousuario;
                $Profesional->email = $fila->email;
                $Profesional->status = $fila->status;
                $lista[] = $Profesional;
            }

            return $lista;
        } catch (PDOException $e) {
            return null;
        } finally {
            Conexion::desconectar();
        }
    }

    public function cambiarEstadoProfesional($idProfesional, $nuevoEstado){
        try {
            $this->conectar();
            $sql = $this->conexion->prepare("UPDATE profesionales SET status = :estado WHERE id_profesional = :id;");
            $sql->bindParam(':estado', $nuevoEstado, PDO::PARAM_BOOL);
            $sql->bindParam(':id', $idProfesional, PDO::PARAM_INT);
            $sql->execute();
        } catch (PDOException $e) {
        } finally {
            Conexion::desconectar();
        }
    }

    public function obtenerProfesionalPorId($idProfesional){
        try {
            $this->conectar();

            $sql = $this->conexion->prepare("SELECT id_profesional, nombre, apellidos, tipousuario, email, status FROM profesionales WHERE id_profesional = :id;");
            $sql->bindParam(':id', $idProfesional, PDO::PARAM_INT);
            $sql->execute();
            $fila = $sql->fetch(PDO::FETCH_OBJ);

            if ($fila) {
                $Profesional = new Profesional();
                $Profesional->id_Profesional = $fila->id_profesional;
                $Profesional->nombre = $fila->nombre;
                $Profesional->apellidos = $fila->apellidos;
                $Profesional->tipoUsuario = $fila->tipousuario;
                $Profesional->email = $fila->email;
                $Profesional->status = $fila->status;
                return $Profesional;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            return null;
        } finally {
            Conexion::desconectar();
        }
    }
    public function actualizarCorreoYContrasena($id, $nuevoCorreo, $nuevaContrasena) {
        try {
            $conn = Conexion::conectar();
            $sql = $conn->prepare("UPDATE profesionales SET email = :email, contrasenia = sha224(:contrasenia) WHERE id_profesional = :id");
            $sql->bindParam(':email', $nuevoCorreo, PDO::PARAM_STR);
            $sql->bindParam(':contrasenia', $nuevaContrasena, PDO::PARAM_STR);
            $sql->bindParam(':id', $id, PDO::PARAM_INT);
            $sql->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error PDO: " . $e->getMessage();
            return false;
        } finally {
            Conexion::desconectar();
        }
    }

}