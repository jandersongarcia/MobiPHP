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

    // Função para criar um novo registro
    public function create($table, $data) {
        $columns = implode(', ', array_keys($data));
        $values = "'" . implode("', '", array_values($data)) . "'";
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        return $this->conn->query($sql);
    }

    // Função para ler registros da tabela com opção de condições
    public function read($table, $conditions = array(), $select = '*') {
        $conditionStr = '';
        if (!empty($conditions)) {
            $conditionStr = ' WHERE ';
            foreach ($conditions as $column => $value) {
                $conditionStr .= "$column = '$value' AND ";
            }
            $conditionStr = rtrim($conditionStr, ' AND ');
        }
        $sql = "SELECT $select FROM $table$conditionStr";
        $result = $this->conn->query($sql);
        $data = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    }

    // Função para atualizar registros na tabela com base em condições
    public function update($table, $data, $conditions = array()) {
        $setStr = '';
        foreach ($data as $column => $value) {
            $setStr .= "$column = '$value', ";
        }
        $setStr = rtrim($setStr, ', ');
        $conditionStr = '';
        if (!empty($conditions)) {
            $conditionStr = ' WHERE ';
            foreach ($conditions as $column => $value) {
                $conditionStr .= "$column = '$value' AND ";
            }
            $conditionStr = rtrim($conditionStr, ' AND ');
        }
        $sql = "UPDATE $table SET $setStr$conditionStr";
        return $this->conn->query($sql);
    }

    // Função para excluir registros da tabela com base em condições
    public function delete($table, $conditions = array()) {
        $conditionStr = '';
        if (!empty($conditions)) {
            $conditionStr = ' WHERE ';
            foreach ($conditions as $column => $value) {
                $conditionStr .= "$column = '$value' AND ";
            }
            $conditionStr = rtrim($conditionStr, ' AND ');
        }
        $sql = "DELETE FROM $table$conditionStr";
        return $this->conn->query($sql);
    }
}
