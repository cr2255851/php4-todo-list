<?php 
class Database{
    private $host = "localhost";
    private $db_name = "todo_db_carla";
    private $username = "root";
    private $password ="";
    private $conn;

    public function getConnection() {
        $this->conn = null;

        try{
            $this->conn new PDO(
                "mysql:host=" .$this->host . "; dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            this->conn->setAttribute(PDO:: ATT_ERMODE, PDO:: ERRMODE_EXCEPTION);
        }catch(PDOException $exception) {
            echo "Error de conexion:" .$execetion->getMessage();
        }
    }
}
?>
