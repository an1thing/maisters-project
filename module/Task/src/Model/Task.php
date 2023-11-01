<?php

namespace Task\Model;

class Task
{
    public $id;
    public $title;
    public $description;
    public $creation_date;
    public $status;

    public function exchangeArray(array $data)
    {
        $this->id = !empty($data['id']) ? $data['id'] : null;
        $this->title = !empty($data['title']) ? $data['title'] : null;
        $this->description = !empty($data['description']) ? $data['description'] : null;
        $this->creation_data = !empty($data['creation_data']) ? $data['creation_data'] : null;
        $this->status = !empty($data['status']) ? $data['status'] : 'PENDING';
    }
}