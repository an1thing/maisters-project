<?php

namespace Task\Model;

use Task\Model\Task;
use Laminas\Db\TableGateway\TableGatewayInterface;
use RuntimeException;

class TaskTable
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    /**
     * get data
     * 
     * @return mixed
     */
    public function get()
    {
        return $this->tableGateway->select();
    }

    /**
     * store data
     * 
     * @param Task $task
     * @return mixed
     */
    public function store(Task $task)
    {
        $data = [
            'title' => $task->title,
            'description' => $task->description,
        ];

        try {
            return $this->tableGateway->insert($data);
        } catch (RuntimeException $e) {
            throw new RuntimeException(
                sprintf("Can't store data", $e)
            );
        }
    }

    /**
     * show data
     * 
     * @param int $id
     * @return mixed
     */
    public function show(int $id)
    {
        $task = $this->tableGateway->select(['id' => $id]);
        $data = $task->current();
        if (!$data) {
            throw new RuntimeException(
                sprintf("Data not found", $id)
            );
        }
        return $data;
    }

    /**
     * update data
     * 
     * @param Task $task
     * @param int $id
     * @return mixed
     */
    public function update(Task $task, int $id)
    {
        $data = [
            'title' => $task->title,
            'description' => $task->description,
            'status' => $task->status,
        ];

        try {
            $task = $this->show($id);
            return $this->tableGateway->update($data, ['id' => $task->id]);
        } catch (RuntimeException $e) {
            throw new RuntimeException(
                sprintf("Can't update data", $id)
            );
        }
    }

    /**
     * delete data
     * 
     * @param int $id
     * @return mixed
     */
    public function delete(int $id)
    {
        try {
            $task = $this->show($id);
            return $this->tableGateway->delete(['id' => $task->id]);
        } catch (RuntimeException $e) {
            throw new RuntimeException(
                sprintf("Can't delete data", $id)
            );
        }
    }
}