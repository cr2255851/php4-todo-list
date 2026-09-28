<?php 
class task{
    //conexion y nombre de la tabla
    private $conn;
    private $table_name ="tasks";

    //propiedades del objeto
    public $id;
    public $title;
    public $completed;
    
    //costructor: recibe la conexion a la base de datos cuando se inistancia el objetos
    public function __construct($db){
        $this->conn = $db;
    }

    //1.LEER TAREAS (READ)
    public function readAll(){
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    //2. CREAR TAREA (CREATE)
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (title) VALUE (:title)";
        $stmt = $this->conn->prepare($query);
        
        // Limpiar entrada (evitar html/scrip dañinos)
        $this->title = htmlspecialchars(strip_tags($this->title));

        //vincular parametros para prevenir sql injetion
        $stmt->bindparam(":title", $this->title);


        if($stmt->execute()) {
            return true;
        }
        return false;
    }
    //CAMBIAR ESTADO / COMPLETAR (UPDATE)
    public function toggleComplete() {
        $query = "UPDATE " . $this->table_name . " SET completed = :completed WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":completed", $this->completed);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }
    //4. ELIMINAR TAREA (DELETE) 
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $this->id);
        return $stmt->execute();
    }

}
?>