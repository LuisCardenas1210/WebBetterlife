<?php
require_once 'Conexion.php';
require_once 'Modelos/Usuario.php';
require_once 'Modelos/Cliente.php';
require_once 'Modelos/Profesional.php';

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
            $sentenciaSQL = $this->conexion->prepare("SELECT 
                    c.id_cliente, 
                    p.id_profesional,
                    COALESCE(c.nombre, p.nombre) AS nombre, 
                    COALESCE(c.apellidos, p.apellidos) AS apellidos,
                    COALESCE(c.tipousuario, p.tipousuario) AS tipoUsuario, 
                    COALESCE(c.status, p.status) AS status,
                    p.especialidad
                FROM Clientes c
                FULL OUTER JOIN Profesionales p ON 1=0 
                WHERE 
                    (c.email = ? AND c.contrasenia = sha224(?))
                    OR 
                    (p.email = ? AND p.contrasenia = sha224(?));
            ");
            $sentenciaSQL->execute([$correoE, $contrasenia, $correoE, $contrasenia]);

            $fila = $sentenciaSQL->fetch(PDO::FETCH_OBJ);
            if ($fila) {
                $obj = new Usuario();
                $obj->id_Cliente = $fila->id_cliente;
                $obj->id_Profesional = $fila->id_profesional;
                $obj->nombre = $fila->nombre;
                $obj->apellidos = $fila->apellidos;
                $obj->tipoUsuario = $fila->tipousuario;
                $obj->status = $fila->status;
                $obj->especialidad = isset($fila->especialidad) ? $fila->especialidad : null;
            }
            return $obj;
        } catch (Exception $e) {
            var_dump($e);
            return null;
        } finally {
            Conexion::desconectar();
        }
    }
}
