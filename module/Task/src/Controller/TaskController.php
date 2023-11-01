<?php

namespace Task\Controller;

use Task\Model\Task;
use Task\Model\TaskTable;
use Laminas\Mvc\Controller\AbstractActionController;

class TaskController extends AbstractActionController
{
    private $table;

    public function __construct(TaskTable $table)
    {
        $this->table = $table;
    }

    /**
     * show all tasks
     */
    public function indexAction()
    {
        return $this->table->show(1);
    }
}
