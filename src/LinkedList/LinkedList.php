<?php

namespace DataStructure\LinkedList;

class LinkedList implements \Countable
{
    protected $length = 0;
    protected $first;

    public function __construct($value = null)
    {
        if ($value) {
            $this->insertWhenEmpty($value);
        }
    }

    public function count(): int
    {
        return $this->length;
    }

    public function empty(): bool
    {
        return $this->length == 0;
    }

    public function first()
    {
        $this->ensureListNotEmpty();
        return $this->first->getValue();
    }

    public function last()
    {
        $this->ensureListNotEmpty();
        return $this->lastNode()->getValue();
    }

    protected function ensureListNotEmpty()
    {
        if ($this->first === null) {
            throw new \OutOfBoundsException('cannot access item of an empty list');
        }
    }

    public function push($value)
    {
        if ($this->empty()) {
            $this->insertWhenEmpty($value);
            return;
        }
        $last = $this->lastNode();
        $last->setNext(new Node($value));
        $this->increment();
    }

    protected function lastNode()
    {
        $last = $this->first;
        $i = 0;
        while ($last->hasNext() && $i < $this->count()) {
            $last = $last->next();
            $i++;
        }
        return $last;
    }

    protected function insertWhenEmpty($value)
    {
        $this->first = new Node($value);
        $this->increment();
    }

    protected function increment()
    {
        $this->length++;
    }

    protected function decrement()
    {
        $this->length--;
    }
}
