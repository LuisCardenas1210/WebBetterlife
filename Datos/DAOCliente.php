<?php
//importa la clase conexión y el modelo para usarlos
require_once 'Conexion.php';
require_once 'Modelos/Cliente.php';
require_once 'Modelos/Rutina.php';
require_once 'Modelos/Profesional.php';

class DAOCliente
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

    public function obtenerTodos()
    {
        try {
            $this->conectar();

            $lista = array();
            /*Se arma la sentencia sql para seleccionar todos los registros de la base de datos*/
            $sentenciaSQL = $this->conexion->prepare("SELECT c.nombre as nombreCliente, c.apellidos, c.edad, c.genero, s.tipoRutina, p.nombre as nombreProfesional
            FROM Clientes c JOIN solicitudes s ON c.id_Cliente=s.id_Cliente
            JOIN profesionales p ON p.id_profesional=s.id_profesional;");
            //Se ejecuta la sentencia sql, retorna un cursor con todos los elementos
            $sentenciaSQL->execute();
            //$resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
            $resultado = $sentenciaSQL->fetchAll(PDO::FETCH_OBJ);
            /*Podemos obtener un cursor (resultado con todos los renglones como 
            un arreglo de arreglos asociativos o un arreglo de objetos*/
            /*Se recorre el cursor para obtener los datos*/
            foreach ($resultado as $fila) {
                $cliente = new ClienteConRutina();
                $cliente->nombreCliente = $fila->nombrecliente;
                $cliente->apellidos = $fila->apellidos;
                $cliente->edad = $fila->edad;
                $cliente->genero = $fila->genero;
                $cliente->tipoRutina = $fila->tiporutina;
                $cliente->nombreProfesional = $fila->nombreprofesional;
                $lista[] = $cliente;
            }

            return $lista;
        } catch (PDOException $e) {
            return null;
        } finally {
            Conexion::desconectar();
        }
    }
}