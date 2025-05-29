<?php
//importa la clase conexión y el modelo para usarlos
require_once 'Conexion.php';
require_once 'Modelos/Solicitud.php';

class DAOSolicitud
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

    public function obtenerTipoRutina($idSolicitud){
        try {
            $this->conectar();

            $sql = $this->conexion->prepare("SELECT tiporutina from solicitudes where id_Solicitud=?;");
            $sql->bindParam(1, $idSolicitud, PDO::PARAM_INT);
            $sql->execute();
            $fila = $sql->fetch(PDO::FETCH_OBJ);

            if ($fila) {
                return $fila->tiporutina;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            return null;
        } finally {
            Conexion::desconectar();
        }
    }
}