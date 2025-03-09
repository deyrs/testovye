<?php

namespace App\Models;

abstract class AbstractModel
{
    public const TABLE = '';
    public $rowid;

    public static function findAll()
    {
        $database = new \App\Database();

        $sql = 'SELECT rowid, * FROM ' . static::TABLE;
        return $database->query(
            $sql,
            static::class
        );
    }

    public function __construct($id = null)
    {
        if (!is_null($id)) {
            $database = new \App\Database();

            $sql = 'SELECT rowid, * FROM ' . static::TABLE . " WHERE ROWID = :id";
            $res = $database->query(
                $sql,
                static::class,
                [$id]
            );

            if (empty($res)) {
                throw new \Exception('Нет элемента с таким id');
            }

            foreach ($res[0] as $key => $value) {
                $this->$key = $value;
            }
        }
    }

    public function create()
    {
        $fields = array_filter(get_object_vars($this), fn($var) => (isset($var)));

        $cols = [];
        $data = [];

        foreach ($fields as $name => $value) {
            $cols[] = $name;
            $data[':' . $name] = $value;
        }

        if (empty($data)) {
            throw new \Exception('Проверьте корректность введеных данных');
        }

        $sql = 'INSERT INTO ' . static::TABLE .
            '(' . implode(', ', $cols) . ')' .
            ' VALUES ' .
            '(' . implode(', ', array_keys($data)) . ')';

        $database = new \App\Database();
        $database->execute($sql, $data);

        $this->rowid = $database->getLastId();
    }

    public function update()
    {
        $fields = array_filter(get_object_vars($this), fn($var) => (isset($var)));

        $data = [];
        $tempSql = [];

        foreach ($fields as $name => $value) {
            if ($name == 'rowid') continue;
            $tempSql[] = "$name = :$name";
            $data[$name] = $value;
        }
        
        if (empty($data)) {
            throw new \Exception('Проверьте корректность введеных данных');
        }

        $sql = 'UPDATE ' . static::TABLE .
            ' SET ' . implode(', ', $tempSql) .
            ' WHERE rowid = ' . $this->rowid;

        $database = new \App\Database();
        $database->execute($sql, $data);
    }

    public function save()
    {
        if (isset($this->rowid)) {
            return $this->update();
        } else {
            return $this->create();
        }
    }

    public function delete()
    {
        $sql = 'DELETE FROM ' . static::TABLE .
            ' WHERE rowid = ' . $this->rowid;

        $database = new \App\Database();
        $database->execute($sql);
    }
}
