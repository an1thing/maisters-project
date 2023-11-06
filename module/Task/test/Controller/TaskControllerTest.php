<?php

namespace TaskTest\Controller;

use Task\Controller\TaskController;
use Laminas\Stdlib\ArrayUtils;
use Laminas\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class TaskControllerTest extends AbstractHttpControllerTestCase
{
    public function setUp(): void
    {
        $this->setApplicationConfig(
            include __DIR__ . '/../../../../config/application.config.php'
        );
        parent::setUp();
    }

    public function testListAction(): void
    {
        $this->dispatch(
            '/task',
            'GET'
        );
    }

    public function testStoreAction(): void
    {
        $this->dispatch(
            '/task/store',
            'POST',
            [
                'title' => 'this is a test',
                'description' => 'this is a test where im storing data',
            ]
        );
    }

    public function testShowAction(): void
    {
        $this->dispatch(
            '/task/show/1',
            'GET'
        );
    }

    public function testUpdateAction(): void
    {
        $this->dispatch(
            '/task/update/1',
            'POST',
            [
                'title' => 'this is a test',
                'description' => 'updating a record on database by testing',
                'status' => 1,
            ]
        );
    }

    public function testDeleteAction(): void
    {
        $this->dispatch(
            '/task/delete/4',
            'DELETE'
        );
    }
}
