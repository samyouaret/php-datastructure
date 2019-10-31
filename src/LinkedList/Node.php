<?php

namespace DataStructure\LinkedList;

use  DataStructure\Abstracts\AbstractNode;

class Node implements AbstractNode
{
    protected $value;
    protected $next;

    public function __construct($value = null)
    {
        $this->setValue($value);
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function hasNext(): bool
    {
        return $this->next !== null;
    }

    public function setNext(AbstractNode $node)
    {
        $this->next = $node;
    }

    public function next(): AbstractNode
    {
        return $this->next;
    }

    public function empty(): bool
    {
        return $this->value === null;
    }
}
