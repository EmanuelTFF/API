<?php
// models/Tarefa.php

class Tarefas
{
    private $conn;
    private $table_name = "tarefas";

    public $id_tarefa;
    public $nome;
    public $descricao;
    public $id_usuario;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTarefaById($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_tarefa = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTarefasByUsuarioId($id_usuario)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_usuario = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id_usuario);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " SET nome=:nome, descricao=:descricao, id_usuario=:id_usuario";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":descricao", $this->descricao);
        $stmt->bindParam(":id_usuario", $this->id_usuario);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update()
    {
        $query = "UPDATE " . $this->table_name . " SET nome=:nome, descricao=:descricao, id_usuario=:id_usuario WHERE id_tarefa=:id_tarefa";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id_tarefa", $this->id_tarefa);
        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":descricao", $this->descricao);
        $stmt->bindParam(":id_usuario", $this->id_usuario);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function remove()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_tarefa = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_tarefa);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
