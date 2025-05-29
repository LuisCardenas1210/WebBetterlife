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
            $sentenciaSQL = $this->conexion->prepare("SELECT c.id_Cliente, s.id_solicitud, c.nombre as nombreCliente, c.apellidos, c.edad, c.genero, s.tipoRutina, p.nombre as nombreProfesional
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
                $cliente->id_Cliente = $fila->id_cliente;
                $cliente->id_Solicitud = $fila->id_solicitud;
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

    public function agregarCliente(Cliente $obj)
    {
        $clave = 0;
        try {
            $sql = "INSERT INTO Clientes (nombre, apellidos, email, contrasenia, edad, peso, estatura, brazoR, brazoC, cintura, pierna, intereses, genero, tipoUsuario)
            values(
            :nombre, :apellidos, :email, SHA224(:contrasenia), :edad, :peso, :estatura, :brazoR, :brazoC, :cintura, :pierna, :intereses, :genero, :tipoUsuario);";

            $this->conectar();
            $this->conexion->prepare($sql)
                ->execute(array(
                ':nombre' => $obj->nombreCliente,
                ':apellidos' => $obj->apellidos,
                ':email'=> $obj->email,
                ':contrasenia'=> $obj->contrasenia,
                ':edad'=> $obj->edad,
                ':peso'=> $obj->peso,
                ':estatura'=> $obj->estatura,
                ':brazoR'=> $obj->brazoR,
                ':brazoC'=> $obj->brazoC,
                ':cintura'=> $obj->cintura,
                ':pierna'=> $obj->pierna,
                ':intereses'=> $obj->intereses,
                ':genero'=> $obj->genero,
                ':tipoUsuario'=> $obj->tipoUsuario
                ));

            $clave = $this->conexion->lastInsertId();
            return $clave;
        } catch (Exception $e) {

            return $clave;
        } finally {

            /*En caso de que se necesite manejar transacciones, 
            no deberá desconectarse mientras la transacción deba 
            persistir*/

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
                $cliente->nombreCliente = $fila->nombre;
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

    public function cambiarEstadoCliente($idCliente, $nuevoEstado){
        try {
            $this->conectar();
            $sql = $this->conexion->prepare("UPDATE clientes SET status = :estado WHERE id_cliente = :id;");
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

            $sql = $this->conexion->prepare("SELECT id_cliente, nombre, apellidos, tipousuario, email, status FROM clientes WHERE id_cliente = :id;");
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

    public function modificarCliente($id, $nombre, $apellidos, $email) {
        try {
            $conn = Conexion::conectar();
            $sql = $conn->prepare("UPDATE clientes SET nombreCliente = :nombre, apellidos = :apellidos, email = :email WHERE id_cliente = :id");
            $sql->bindParam(':nombre', $nombre);
            $sql->bindParam(':apellidos', $apellidos);
            $sql->bindParam(':email', $email);
            $sql->bindParam(':id', $id, PDO::PARAM_INT);
            $sql->execute();
        } catch (PDOException $e) {
        } finally {
            Conexion::desconectar($conn);
        }
    }


    public function actualizarCorreoYContrasena($id, $nuevoCorreo, $nuevaContrasena) {
        try {
            $conn = Conexion::conectar();
            $sql = $conn->prepare("UPDATE clientes SET email = :email, contrasenia = sha224(:contrasenia) WHERE id_cliente = :id");
            $sql->bindParam(':email', $nuevoCorreo, PDO::PARAM_STR);
            $sql->bindParam(':contrasenia', $nuevaContrasena, PDO::PARAM_STR);
            $sql->bindParam(':id', $id, PDO::PARAM_INT);
            $sql->execute();
            return true; // actualización exitosa
        } catch (PDOException $e) {
            // Muestra el error real (solo para desarrollo)
            echo "Error PDO: " . $e->getMessage();
            return false;
        } finally {
            Conexion::desconectar();
        }
    }



}