<?php
//importa la clase conexión y el modelo para usarlos
require_once 'Conexion.php';
require_once 'Modelos/Rutina.php';

class DAORutina
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
    public function obtenerRutinasPorCliente($id_cliente)
    {
        $this->conectar();

        $sql = "SELECT * FROM rutinas WHERE id_cliente = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute(['id' => $id_cliente]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}