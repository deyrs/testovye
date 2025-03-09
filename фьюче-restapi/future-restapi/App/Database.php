<?php

namespace App;

class Database
{
    public $dbh;

    public function __construct()
    {
        $this->dbh = new \PDO('sqlite:' . __DIR__ . '/restapi.db');
        $this->dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function execute(string $sql, array $params = [])
    {
        return $this->dbh->prepare($sql)->execute($params);
    }

    public function query(string $sql, string $className, array $params = [])
    {
        $sth = $this->dbh->prepare($sql);
        $res = $sth->execute($params);
        if (!$res) {
            throw new \Exception('404');
        }
        return $sth->fetchAll(\PDO::FETCH_CLASS, $className);
    }

    public function getLastId()
    {
        return $this->dbh->lastInsertId();
    }
}