<?php
use Core\errorMessage;
class mobiSQL {
    private $conn;
    
    public function __construct($host, $username, $password, $database) {
        set_error_handler([$this, 'customErrorHandler']); // Define o manipulador de erros personalizado

        $this->conn = new mysqli($host, $username, $password, $database);

        restore_error_handler(); // Restaura o manipulador de erros padrão

        if ($this->conn->connect_error) {
            $error = new errorMessage();
            $title = $error->title;
            $messageError = "Connection error: " . $this->conn->connect_error;
            require_once('core/template/error.php');
            die();
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    public function closeConnection() {
        if ($this->conn) {
            $this->conn->close();
        }
    }

    public function customErrorHandler($errno, $errstr, $errfile, $errline) {
        // Trate o erro de acordo com suas necessidades
        // Neste exemplo, apenas exibimos uma mensagem genérica
        #echo "Ocorreu um erro na conexão com o banco de dados.";
    }
}