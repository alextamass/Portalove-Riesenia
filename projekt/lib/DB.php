<?php

namespace lib;

class DB
{
    private $host = "localhost";
    private $port = 3306;
    private $username = "root";
    private $password = "";
    private $dbName = "projekt";

    private \PDO $connection;

    public function __construct(
        string $host = "",
        int $port = 3306,
        string $username = "",
        string $password = "",
        string $dbName = ""
    )
    {
        if(!empty($host)) {
            $this->host = $host;
        }

        if(!empty($port)) {
            $this->port = $port;
        }

        if(!empty($username)) {
            $this->username = $username;
        }

        if(!empty($password)) {
            $this->password = $password;
        }

        if(!empty($dbName)) {
            $this->dbName = $dbName;
        }

        try {
            $this->connection = new \PDO(
                "mysql:host=$this->host;dbname=$this->dbName;charset=utf8mb4",
                $this->username,
                $this->password
            );
            // set the PDO error mode to exception
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch(\PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function getDeals(): array
    {
        $sql = "SELECT * FROM deals";
        $query = $this->connection->query($sql);
        $data = $query->fetchAll(\PDO::FETCH_ASSOC);

        return $data;
    }

    public function insertMenuRecord(string $pageName, string $url): bool
    {
        $sql = "INSERT INTO deals(nazov, img_url) VALUE ('" . $pageName . "', '" . $url . "')";
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute();
    }

    public function getNavigation(): array
    {
        $sql = "SELECT Meno, URL FROM navigation";
        $query = $this->connection->query($sql);
        $data = $query->fetchAll(\PDO::FETCH_ASSOC);
        $finalMenu = [];

        foreach ($data as $menuItem) {
            $finalMenu[$menuItem['Meno']] = $menuItem['URL'];
        }

        return $finalMenu;
    }

    public function getMenu(): array
    {
        $sql = "SELECT * FROM deals";
        $query = $this->connection->query($sql);
        $data = $query->fetchAll(\PDO::FETCH_ASSOC);

        return $data;
    }

    public function getMenuItem(int $id): array
    {
        $sql = "SELECT * FROM deals WHERE id = ".$id;
        $query = $this->connection->query($sql);
        $data = $query->fetch(\PDO::FETCH_ASSOC);

        return $data;
    }

    public function deleteMenuItem(int $id): bool
    {
        $sql = "DELETE FROM deals WHERE id = ".$id;
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute();
    }

    public function updateMenuItem(int $id, string $pageName = "", string $url = ""): bool
    {
        $sql = "UPDATE deals SET ";

        if(!empty($pageName)) {
            $sql .= " nazov = '" . $pageName . "'";
        }

        if(!empty($url)) {
            $sql .= ", img_url = '" . $url . "'";
        }

        $sql .= " WHERE id = ". $id;

        $stmt = $this->connection->prepare($sql);
        return $stmt->execute();
    }
}