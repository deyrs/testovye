<?php

namespace App\Models;

class Task extends AbstractModel
{
    public static function findAllWithParams(array $params)
    {
        $database = new \App\Database();

        $data = [];
        $sql = 'SELECT rowid, * FROM ' . static::TABLE;

        if (!isset($params['search']) && !isset($params['sort']) && !isset($params['page']) && !isset($params['limit'])) {
            throw new \Exception('Недопустимые параметры поиска или сортировки');
        }

        if (isset($params['search'])) {
            $sql .= ' WHERE title = :searchBy';
            $data['searchBy'] = $params['search'];
        }
        if (isset($params['sort'])) {
            $sql .= ' ORDER BY :sortBy';
            $data['sortBy'] = $params['sort'];
        }
        if (isset($params['limit'])) {
            $limit = (int)$params['limit'];
            $sql .= " LIMIT $limit";
        }
        if (isset($params['page']) && isset($params['limit'])) {
            $offset = ((int)$params['page'] - 1) * (int)$params['limit'];
            $sql .= " OFFSET $offset";
        }

        return $database->query(
            $sql,
            static::class,
            $data
        );
    }

    public const TABLE = 'tasks';

    public $title;
    public $description;
    public $due_date;
    public $create_date;
    public $status;
    public $priority;
    public $category;
}