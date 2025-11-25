<?php
namespace Core;

use PDO;
use PDOException;
class  Database {

    public $connection;

    public $statement;

    public function __construct($config,$username = 'admin',$password = 'admin')
    {
        try {
            $dsn = 'mysql:'.http_build_query($config, '',';');

            $this->connection = new PDO($dsn,$username,$password,[
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        } catch (PDOException $exception) {
            die("Connection failed: " . $exception->getMessage());
        }

    }
    public function query($query, $params = [])
    {
        try {

            $this -> statement = $this->connection->prepare($query);
            $this -> statement->execute($params);
        }catch (PDOException $exception) {

            die("Query failed: " . $exception->getMessage());
        }

        return $this;
    }

    public function get()
    {
        return $this->statement->fetchAll();
    }

    public function find(){
        return $this->statement->fetch();
    }

    public function findOrFail()
    {
        $result = $this->find();

        if (! $result){
            abort();
        }
        return $result;
    }

    public function beginTransaction()
    {
        $this->connection->beginTransaction();
    }

    public function commit()
    {
        $this->connection->commit();
    }

    public function rollBack()
    {
        $this->connection->rollBack();
    }

    public function closeConnection()
    {
        $this->connection = null;
    }
}