<?php

namespace Task\Model;

use Laminas\InputFilter\InputFilter;
use Laminas\InputFilter\InputFilterAwareInterface;
use Laminas\InputFilter\InputFilterInterface;

class Task implements InputFilterAwareInterface
{
    public $id;
    public $title;
    public $description;
    public $creation_date;
    public $status;
    private $inputFilter;

    public function exchangeArray(array $data)
    {
        $this->id = !empty($data['id']) ? $data['id'] : null;
        $this->title = !empty($data['title']) ? $data['title'] : null;
        $this->description = !empty($data['description']) ? $data['description'] : null;
        $this->status = !empty($data['status']) ? $data['status'] : 0;
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new DomainException(sprintf(
            '%s does not allow injection of an alternate input filter',
            __CLASS__
        ));
    }

    public function getInputFilter()
    {
        if ($this->inputFilter) {
            return $this->inputFilter;
        }

        $inputFilter = new InputFilter();

        $inputFilter->add([
            'name' => 'title',
            'required' => true,
        ]);

        $inputFilter->add([
            'name' => 'description',
            'required' => false,
        ]);

        $inputFilter->add([
            'name' => 'status',
            'required' => false,
        ]);

        $this->inputFilter = $inputFilter;
        return $this->inputFilter;
    }
}