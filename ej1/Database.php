<?php
// Connect to the database, and execute a query
class  Database {

    public $connection;
    public function __construct()
    {
        $dsn = "mysql:host=100.74.167.64;port=3306;user=admin;password=admin;dbname=mi_base;";
        $this->connection = new PDO($dsn);
    }
    public function  query($query)
    {

        $statement = $this->connection->prepare($query);
        $statement->execute();

        return $statement;
    }
}