<?php

namespace Task\Controller;

use Task\Form\TaskForm;
use Task\Model\Task;
use Task\Model\TaskTable;
use Laminas\Mvc\Controller\AbstractRestfulController;
use Laminas\View\Model\ViewModel;

class TaskController extends AbstractRestfulController
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
        return new ViewModel(['tasks' => $this->table->get()]);
    }

    /**
     * add task
     */
    public function addAction()
    {
        return new ViewModel(['task']);
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

        return $this->redirect()->toRoute('task');
    }

    /**
     * edit task
     */
    public function editAction()
    {
        $id = $this->params()->fromRoute('id', 0);

        try {
            $task = $this->table->show($id);
        } catch (\Exception $e) {
            $this->redirect()->toRoute('task');
        }

        return new ViewModel(['task' => $task]);
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

        return $this->redirect()->toRoute('task');
    }

    /**
     * delete task
     */
    public function deleteAction()
    {
        $id = $this->params()->fromRoute('id', 0);
        $this->table->delete($id);

        return $this->redirect()->toRoute('task');
    }
}
