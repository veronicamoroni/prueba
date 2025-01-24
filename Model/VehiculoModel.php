<?php

class Vehiculo {
    private $db;
    public $patente;
    public $marca;
    public $modelo;
    public $dni_cliente;
    public $table = "vehiculos"; 

    public function __construct($db) {
        $this->db = $db;
    }

    
    public function crearVehiculo() { 
        // Verificar si la patente ya existe en la base de datos
        $query = "SELECT COUNT(*) FROM vehiculos WHERE patente = :patente";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':patente', $this->patente);
        $stmt->execute();
        $result = $stmt->fetchColumn();
    
        // Si la patente ya existe, devolver un error
        if ($result > 0) {
            return "Error: La patente ya está registrada.";
        }
    
        // Si la patente no existe, proceder con la inserción
        $query = "INSERT INTO vehiculos (patente, marca, modelo, dni_cliente) VALUES (:patente, :marca, :modelo, :dni_cliente)";
        $stmt = $this->db->prepare($query);
    
        // Enlace de parámetros
        $stmt->bindParam(':patente', $this->patente);
        $stmt->bindParam(':marca', $this->marca);
        $stmt->bindParam(':modelo', $this->modelo);
        $stmt->bindParam(':dni_cliente', $this->dni_cliente);
    
        if ($stmt->execute()) {
            return true;
        } else {
            return "Error: No se pudo crear el vehículo.";
        }
    }
// Método para modificar un vehículo
// Método para modificar un vehículo
public function modificarVehiculo() {
    // Query SQL para actualizar los datos del vehículo, incluyendo la patente
    $query = "UPDATE vehiculos 
              SET patente = :nueva_patente, marca = :marca, modelo = :modelo, dni_cliente = :dni_cliente 
              WHERE patente = :patente";

    // Preparar la consulta
    $stmt = $this->db->prepare($query);

    // Enlazar los parámetros
    $stmt->bindParam(':patente', $this->patente);
    $stmt->bindParam(':nueva_patente', $this->nueva_patente);
    $stmt->bindParam(':marca', $this->marca);
    $stmt->bindParam(':modelo', $this->modelo);
    $stmt->bindParam(':dni_cliente', $this->dni_cliente);

    // Ejecutar la consulta y devolver el resultado
    return $stmt->execute();
}


    // Eliminar vehículo
    public function eliminarVehiculo() {
        $query = "DELETE FROM vehiculos WHERE patente = :patente";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':patente', $this->patente);

        return $stmt->execute();
    }
   

    // Obtener vehículo por patente
    public function obtenerVehiculoPorPatente() {
        $query = "SELECT * FROM vehiculos WHERE patente = :patente LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':patente', $this->patente);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

      
   
    public function obtenerVehiculos() {
        $query = "SELECT * FROM " . $this->table; // Asegúrate de que $this->table sea la tabla de vehículos
    
        $stmt = $this->db->prepare($query);
        $stmt->execute();
    
        return $stmt;
    }
    
}
?>
