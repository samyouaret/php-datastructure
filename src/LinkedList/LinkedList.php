<?php

namespace DataStructure\LinkedList;

use DataStructure\Abstracts\AbstractList;

class LinkedList implements \Countable, AbstractList
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
            throw new \OutOfBoundsException('try to perform action on an empty list');
        }
    }

    public function push($value)
    {
        if ($this->empty()) {
            $this->insertWhenEmpty($value);
            return;
        }
        $this->insertAtLast($value);
    }

    protected function lastNode()
    {
        return $this->getNode($this->count());
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

    public function add(int $index, $value)
    {
        $this->ensureIndexIsInRange($index);
        //insert at last of list or in empty list
        if ($index == $this->count()) {
            return $this->push($value);
        }
        // insert at first of list
        if ($index == 0) {
            return $this->unshift($value);
        }
        // insert at other indexes
        $node = $this->getNode($index - 1);
        $next = $node->next();
        $node->setNext(new Node($value));
        $node->next()->setNext($next);
        $this->increment();
    }

    protected function ensureIndexIsInRange($index)
    {
        if ($index > $this->count()) {
            throw new \OutOfBoundsException('given index is out of range of list');
        }
    }

    public function unshift($value)
    {
        if ($this->empty()) {
            $this->insertWhenEmpty($value);
        }
        $node = new Node($value);
        $node->setNext($this->first);
        $this->first = $node;
        $this->increment();
    }

    public function insertAtLast($value)
    {
        $last = $this->lastNode();
        $last->setNext(new Node($value));
        $this->increment();
    }

    public function get(int $index)
    {
        return $this->getNode($index)->getValue();
    }

    public function getNode(int $index): Node
    {
        $this->ensureListNotEmpty();
        $node = $this->first;
        $i = 0;
        while ($node->hasNext() && $i < $index) {
            $node = $node->next();
            $i++;
        }
        return $node;
    }

    public function remove(int $index)
    {
        $this->ensureListNotEmpty();
        $this->ensureIndexIsInRange($index);
        if ($index == 0) {
            return $this->shift();
        }
        $node  = $this->getNode($index - 1);
        $toDelete = $node->next();
        if ($toDelete->hasNext()) {
            $node->setNext($toDelete->next());
        } else {
            $node->clearNext();
        }
        $value = $toDelete->getValue();
        $this->decrement();
        unset($toDelete);
        return $value;
    }

    public function shift()
    {
        $this->ensureListNotEmpty();
        $toDelete = $this->first;
        $value =  $this->first->getValue();
        if ($this->first->hasNext()) {
            $this->first = $this->first->next();
        } else {
            $this->first = null;
        }
        unset($toDelete);
        $this->decrement();
        return $value;
    }

    public function pop()
    {
        return $this->remove($this->count() - 1);
    }

    public function removeItem($item)
    {
        $this->ensureListNotEmpty();
        if ($this->first->getValue() == $item) {
            return $this->shift();
        }
        $node = $this->first;
        while ($node->hasNext()) {
            if ($node->next()->getValue() == $item) {
                $toDelete  = $node->next();
                if ($toDelete->hasNext()) {
                    $node->setNext($toDelete->next());
                } else {
                    $node->clearNext();
                }
                $value = $toDelete->getValue();
                $this->decrement();
                return $value;
            }
            $node = $node->next();
        }
        return false;
    }
}
