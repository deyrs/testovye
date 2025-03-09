<?php

namespace App\Controllers;

class Task
{
    public function findOne($id)
    {
        try {
            $task = new \App\Models\Task($id);

            echo json_encode($task, JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            http_response_code(404);
            echo json_encode(array(
                'error' => $e->getMessage()
                ), JSON_UNESCAPED_UNICODE
            );
        }
    }

    public function findAll()
    {
        echo json_encode(\App\Models\Task::findAll(), JSON_UNESCAPED_UNICODE);
    }

    public function findAllWithParams($params)
    {
        try {
            echo json_encode(\App\Models\Task::findAllWithParams($params), JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            http_response_code(404);
            echo json_encode(array(
                'error' => $e->getMessage()
                ), JSON_UNESCAPED_UNICODE
            );
        }
    }

    public function create(object $obj)
    {
        $task = new \App\Models\Task();

        foreach ($obj as $key => $value) {
            if (property_exists($task, $key)) {
                $task->{$key} = $value;
            }
        }

        try {
            $task->save();

            http_response_code(201);
            echo json_encode(array(
                "id" => $task->rowid,
                "message" => "Task created successfully"
            ), JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            http_response_code(400);
            echo json_encode(array(
                'error' => $e->getMessage()
                ), JSON_UNESCAPED_UNICODE
            );
        }
    }

    public function update(string $id, object $obj)
    {
        try {
            $task = new \App\Models\Task($id);

            foreach ($obj as $key => $value) {
                if (property_exists($task, $key)) {
                    $task->{$key} = $value;
                }
            }
    
            $task->update();
    
            echo json_encode(array(
                "id" => $task->rowid,
                "message" => "Task updated successfully"
            ), JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            http_response_code(400);
            echo json_encode(array(
                'error' => $e->getMessage()
                ), JSON_UNESCAPED_UNICODE
            );
        }
    }

    public function delete(string $id)
    {
        try {
            $task = new \App\Models\Task($id);
            $task->delete();

            echo json_encode(array(
                "message" => "Task deleted successfully"
            ), JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            http_response_code(404);
            echo json_encode(array(
                'error' => $e->getMessage()
                ), JSON_UNESCAPED_UNICODE
            );
        }
    }
}