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

    public function setNext($node)
    {
        $this->ensureNodeType($node);
        $this->next = $node;
    }

    public function clearNext()
    {
        $this->next = null;
    }

    public function next()
    {
        return $this->next;
    }

    public function ensureNodeType($node)
    {
        if ($this->next !== null && !$node instanceof self) {
            throw new \OutOfBoundsException('try to access undefined node');
        }
    }

    public function empty(): bool
    {
        return $this->value === null;
    }
}
