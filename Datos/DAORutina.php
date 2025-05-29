<?php
//importa la clase conexión y el modelo para usarlos
require_once 'Conexion.php';
require_once 'Modelos/Rutina.php';
require_once 'Modelos/Cliente.php';

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
    public function obtenerUno($id)
    {
        try {
            $this->conectar();

            //Almacenará el registro obtenido de la BD
            $obj = null;

            $sentenciaSQL = $this->conexion->prepare("SELECT nombre, edad, peso, estatura, brazoR, brazoC, cintura, pierna from clientes where id_Cliente=?;");
            //Se ejecuta la sentencia sql con los parametros dentro del arreglo 
            $sentenciaSQL->execute([$id]);

            /*Obtiene los datos*/
            $fila = $sentenciaSQL->fetch(PDO::FETCH_OBJ);

            $obj = null;
            if ($fila) {
                $obj = new Cliente();
                $obj->nombre = $fila->nombre;
                $obj->edad = $fila->edad;
                $obj->peso = $fila->peso;
                $obj->estatura = $fila->estatura;
                $obj->brazoR = $fila->brazor;
                $obj->brazoC = $fila->brazoc;
                $obj->cintura = $fila->cintura;
                $obj->pierna = $fila->pierna;
            }

            return $obj;
        } catch (Exception $e) {
            return null;
        } finally {
            Conexion::desconectar();
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

    public function Agregar(Rutina $obj)
    {
        $clave = 0;
        try {
            $sql = "INSERT INTO RUTINAS (id_cliente, id_profesional, descripcionrutina, tiporutina,
            lunes, detallesl, martes, detallesm, miercoles, detallesw, jueves, detallesj, viernes, detallesv,
            sabado, detalless, domingo, detallesd)
    VALUES
	(:id_cliente, :id_profesional, :descripcionrutina, :tiporutina, :lunes, :detallesl, :martes, :detallesm,
    :miercoles, :detallesw, :jueves, :detallesj, :viernes, :detallesv, :sabado, :detalless, :domingo, :detallesd);";

            $this->conectar();
            $this->conexion->prepare($sql)
                ->execute(array(
                    ':id_cliente' => $obj->id_Cliente,
                    ':id_profesional' => $obj->id_Profesional,
                    ':descripcionrutina' => $obj->descripcionRutina,
                    ':tiporutina' => $obj->tiporutina,
                    ':lunes' => $obj->lunes,
                    ':detallesl' => $obj->detallesL,
                    ':martes' => $obj->martes,
                    ':detallesm' => $obj->detallesM,
                    ':miercoles' => $obj->miercoles,
                    ':detallesw' => $obj->detallesW,
                    ':jueves' => $obj->jueves,
                    ':detallesj' => $obj->detallesJ,
                    ':viernes' => $obj->viernes,
                    ':detallesv' => $obj->detallesV,
                    ':sabado' => $obj->sabado,
                    ':detalless' => $obj->detallesS,
                    ':domingo' => $obj->domingo,
                    ':detallesd' => $obj->detallesD
                ));

            $clave = $this->conexion->lastInsertId();
            return $clave;
        } catch (Exception $e) {

            return $clave;
        } finally {
            Conexion::desconectar();
        }
    }
}