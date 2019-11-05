<?php

namespace DataStructure;

use DataStructure\Abstracts\AbstractQueue;
use DataStructure\LinkedList\DoublyLinkedList;

class Queue extends DoublyLinkedList implements AbstractQueue
{

    public function __construct($value = null)
    {
        parent::__construct($value);
    }

    public function enqueue($value)
    {
        $this->push($value);
    }

    public function dequeue()
    {
        return $this->shift();
    }
}
