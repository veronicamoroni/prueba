<?php
class Servicio {
    private $db;
    public $table = "servicios"; // Nombre de la tabla para los servicios
    public $id;
    public $descripcion;
    public $costo;

    // Constructor, recibe la conexión a la base de datos
    public function __construct($db) {
        $this->db = $db;
    }

    // Crear un nuevo servicio
    public function crearServicio() {
        // Verificar si ya existe el servicio con la misma descripción (nombre)
        $queryCheck = "SELECT COUNT(*) FROM " . $this->table . " WHERE descripcion = :descripcion";
        $stmtCheck = $this->db->prepare($queryCheck);
        
        // Limpiar y enlazar los parámetros
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $stmtCheck->bindParam(':descripcion', $this->descripcion);
        
        // Ejecutar la consulta de verificación
        $stmtCheck->execute();
        
        // Si ya existe un servicio con la misma descripción, retornar el mensaje
        $count = $stmtCheck->fetchColumn();
        if ($count > 0) {
            return "El servicio ya existe.";
        }
    
        // Si no existe, proceder con la inserción
        // Si no se proporciona costo, se insertará NULL en la base de datos
        $query = "INSERT INTO " . $this->table . " (descripcion, costo) VALUES (:descripcion, :costo)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':descripcion', $this->descripcion);
        
        // Si el costo es proporcionado, lo asignamos
        if (isset($this->costo)) {
            $stmt->bindParam(':costo', $this->costo);
        } else {
            // Si no se proporciona costo, se inserta NULL
            $stmt->bindValue(':costo', null, PDO::PARAM_NULL);
        }
        
        // Ejecutar la inserción y retornar el resultado
        if ($stmt->execute()) {
            return "El servicio se ha guardado exitosamente.";
        } else {
            return "Error al guardar el servicio.";
        }
    }
    
    
    // Modificar un servicio
    public function modificarServicio() {
        // Verificar si el servicio con el ID proporcionado existe
        $queryVerificar = "SELECT COUNT(*) FROM servicios WHERE id = :id";
        $stmtVerificar = $this->db->prepare($queryVerificar);
        $stmtVerificar->bindParam(':id', $this->id);
        $stmtVerificar->execute();
        $result = $stmtVerificar->fetchColumn();
    
        // Si no se encuentra el servicio con el ID proporcionado, retornar false
        if ($result == 0) {
            return false; // Servicio no encontrado
        }
    
        // Si el servicio existe, proceder con la actualización
        $query = "UPDATE servicios 
                SET descripcion = :descripcion, costo = :costo
                WHERE id = :id";
    
        // Preparar la consulta
        $stmt = $this->db->prepare($query);
    
        // Limpiar los datos (por si acaso no se han limpiado en el setter del modelo)
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->costo = htmlspecialchars(strip_tags($this->costo));
        $this->id = htmlspecialchars(strip_tags($this->id));
    
        // Enlazar los parámetros
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':costo', $this->costo);
    
        // Ejecutar la consulta y devolver el resultado
        return $stmt->execute();
    }
    
    public function eliminarServicio() {
        try {
            // Comprobamos si el servicio con el ID existe en la tabla servicios
            $checkStmt = $this->db->prepare("SELECT COUNT(*) FROM " . $this->table . " WHERE id = :id");
            $checkStmt->bindParam(':id', $this->id);
            $checkStmt->execute();
    
            if ($checkStmt->fetchColumn() == 0) {
                return "El servicio no existe.";
            }
    
            // Intentamos eliminar el servicio
            $stmt = $this->db->prepare("DELETE FROM " . $this->table . " WHERE id = :id");
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
    
            return true;
        } catch (PDOException $e) {
            // Si el error es por clave foránea (servicio con asociaciones)
            if ($e->getCode() == '23503') {
                return "No se puede eliminar el servicio .";
            }
            return "Error al eliminar el servicio.";
        }
    }
    
    
    
    // Obtener todos los servicios
    public function obtenerServicios() {
        $query = "SELECT * FROM " . $this->table;

        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt;
    }
    
    // Obtener un servicio por ID
    public function obtenerServicioPorId() {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 0,1";

        $stmt = $this->db->prepare($query);

        // Enlazar el parámetro ID
        $stmt->bindParam(':id', $this->id);

        $stmt->execute();

        // Obtener la fila del servicio
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            // Asignar los valores obtenidos a las propiedades del servicio
            $this->descripcion = $row['descripcion'];
            $this->costo = $row['costo'];
        }
    }
}
?>
