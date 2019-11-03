<?php

namespace DataStructure\LinkedList;


class DoublyNode extends Node
{
    protected $prev;

    public function __construct($value = null)
    {
        parent::__construct($value);
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
