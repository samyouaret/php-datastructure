<?php

namespace DataStructure;

use DataStructure\LinkedList\DoublyLinkedList;

class Stack extends DoublyLinkedList
{
    public function top()
    {
        return $this->last();
    }
}
