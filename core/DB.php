<?php

class DB
{

    private $pdo;
    private $host;
    private $dbname;
    private $username;
    private $password;

    public function __construct($host, $dbname, $username, $password)
    {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;
    }
    
    public function insert($query, $params = null)
    {
        $this->execute($query, $params);
        return $this->pdo->lastInsertId();
    }
    
    public function getAll($query, $params = null)
    {
        return $this->execute($query, $params)->fetchAll();
    }
    
    public function getRow($query, $params = null)
    {
        return $this->execute($query, $params)->fetch();
    }
    
    public function getColumn($query, $params = null)
    {
        return $this->execute($query, $params)->fetchAll(PDO::FETCH_COLUMN, 0);
    }

    public function getValue($query, $params = null)
    {
        return $this->execute($query, $params)->fetchColumn();
    }
    
    public function generate($query, $params = null)
    {
        $rows = $this->execute($query, $params);
        while($row = $rows->fetch()) yield $row;
    }

    private function execute($query, $params = null)
    {
        if(!$this->pdo) $this->connect();
        $statement = $this->pdo->prepare($query);
        if (!empty($params[0]) && is_array($params[0])) {
            foreach ($params as $param) $statement->execute($param);
        } else {
            $statement->execute($params);
        }
        return $statement;
    }

    private function connect()
    {
        try {
            $options = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            );
            $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname;charset=utf8mb4", $this->username, $this->password, $options);
        } catch (PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
    }
}