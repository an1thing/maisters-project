<?php

namespace Task;

use Task\Controller\TaskController;
use Task\Model\Task;
use Task\Model\TaskTable;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                TaskController::class => function ($container) {
                    return new TaskController($container->get(TaskTable::class));
                }
            ]
        ];
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                TaskTable::class => function ($container) {
                    $tableGateway = $container->get(Model\TaskTableGateway::class);
                    return new TaskTable($tableGateway);
                },
                Model\TaskTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Task());
                    return new TableGateway('tasks', $dbAdapter, null, $resultSetPrototype);
                },
            ],
        ];
    }
}