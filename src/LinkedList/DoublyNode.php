<?php

namespace DataStructure\LinkedList;

class DoublyNode
{
    protected $value;
    protected $next;
    protected $prev;

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
        if ($node !== null && !$node instanceof self) {
            throw new \InvalidArgumentException('wrong node passed node expect ' . static::class);
        }
    }

    public function empty(): bool
    {
        return $this->value === null;
    }

    public function hasPrev(): bool
    {
        return $this->prev !== null;
    }

    public function setPrev($node)
    {
        $this->ensureNodeType($node);
        $this->prev = $node;
    }

    public function clearPrev()
    {
        $this->prev = null;
    }

    public function prev()
    {
        return $this->prev;
    }
}
