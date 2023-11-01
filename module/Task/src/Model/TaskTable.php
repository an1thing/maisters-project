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

    public function get()
    {
        return $this->tableGateway->select();
    }

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
}