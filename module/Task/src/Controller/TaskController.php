<?php

namespace Task\Controller;

use Task\Form\TaskForm;
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
     * list tasks
     */
    public function indexAction()
    {
        $this->table->get();
    }

    /**
     * store task
     */
    public function storeAction()
    {
        $form = new TaskForm();
        $request = $this->getRequest();

        $task = new Task();
        $form->setInputFilter($task->getInputFilter());
        $form->setData($request->getPost());

        if (!$form->isValid()) {
            $messages = $form->getMessages();
            return $messages;
        }

        $task->exchangeArray($form->getData());
        $this->table->store($task);
    }

    /**
     * show task
     */
    public function showAction()
    {
        $id = $this->params()->fromRoute('id', 0);
        $this->table->show($id);
    }

    /**
     * update task
     */
    public function updateAction()
    {
        $id = $this->params()->fromRoute('id', 0);

        $form = new TaskForm();
        $request = $this->getRequest();

        $task = new Task();
        $form->setInputFilter($task->getInputFilter());
        $form->setData($request->getPost());

        if (!$form->isValid()) {
            $messages = $form->getMessages();
            return $messages;
        }

        $task->exchangeArray($form->getData());
        $this->table->update($task, $id);
    }

    /**
     * delete task
     */
    public function deleteAction()
    {
        $id = $this->params()->fromRoute('id', 0);
        $this->table->delete($id);
    }
}
