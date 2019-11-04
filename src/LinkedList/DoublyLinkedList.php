<?php

namespace DataStructure\LinkedList;

use DataStructure\Abstracts\AbstractList;

/** 
 * TODO :
 * clean code and make methods smaller
 * document and comment code
 * revise code
 * publish to github
 * implements array access
 */

class DoublyLinkedList implements \Countable, AbstractList, \Iterator
{
    protected $length = 0;
    protected $first;
    protected $last;
    /**iterator variables */
    protected $iterator_position;
    protected $current;
    const ITERATE_FORWARD = 0;
    const ITERATE_REVERSE = 1;
    protected $iterationMode = 0;

    public function __construct($value = null)
    {
        if ($value) {
            $this->insertWhenEmpty($value);
        }
        $this->rewind();
    }

    public function current()
    {
        return $this->current->getValue();
    }

    public function next()
    {
        $this->iterator_position++;
        $this->current = $this->iterationMode == self::ITERATE_FORWARD
            ? $this->current->next() : $this->current->prev();
    }

    public function key()
    {
        return $this->iterator_position;
    }

    public function valid()
    {
        return $this->iterator_position < $this->length;
    }

    public function rewind()
    {
        $this->iterator_position = 0;
        $this->current = $this->iterationMode == self::ITERATE_FORWARD
            ? $this->first : $this->last;
    }

    public function setIterationMode(int $mode)
    {
        if ($mode !== self::ITERATE_FORWARD && $mode !== self::ITERATE_REVERSE) {
            throw new \InvalidArgumentException("invalid iteration mode");
        }
        $this->iterationMode = $mode;
    }

    public function getIterationMode()
    {
        return $this->iterationMode;
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
        return $this->last->getValue();
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
        $this->insertAt($index, $value);
    }

    protected function insertAt(int $index, $value)
    {
        $beforeNode = $this->getNode($index - 1);
        $newNode = new DoublyNode($value);
        $newNode->setPrev($beforeNode);
        $newNode->setNext($beforeNode->next());
        $beforeNode->next()->setPrev($newNode);
        $beforeNode->setNext($newNode);
        $this->increment();
    }

    public function push($value)
    {
        if ($this->empty()) {
            return $this->insertWhenEmpty($value);
        }
        $this->insertAtLast($value);
    }

    public function unshift($value)
    {
        if ($this->empty()) {
            return $this->insertWhenEmpty($value);
        }
        $node = new DoublyNode($value);
        $this->first->setPrev($node);
        $node->setNext($this->first);
        $this->first = $node;
        $this->increment();
    }

    protected function insertAtLast($value)
    {
        $this->ensureListNotEmpty();
        $node = new DoublyNode($value);
        $this->last->setNext($node);
        $node->setPrev($this->last);
        $this->last = $node;
        $this->increment();
    }

    protected function insertWhenEmpty($value)
    {
        $this->first = $this->last = new DoublyNode($value);
        $this->increment();
    }

    public function get(int $index)
    {
        return $this->getNode($index)->getValue();
    }

    public function getNode(int $index): DoublyNode
    {
        $this->ensureListNotEmpty();
        $this->ensureIndexIsInRange($index);
        if ($index == $this->count() - 1) {
            return $this->last;
        }
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
        $this->ensureIndexIsInRangeForRemove($index);
        if ($index == 0) {
            return $this->shift();
        }
        if ($index == $this->count() - 1) {
            return $this->pop();
        }
        return $this->removeAt($index);
    }

    protected function removeAt(int $index)
    {
        $beforeNode  = $this->getNode($index - 1);
        $value = $beforeNode->next()->getValue();
        if ($beforeNode->next()->hasNext()) {
            $beforeNode->next()->next()->setPrev($beforeNode);
        }
        $beforeNode->setNext($beforeNode->next()->next());
        $this->decrement();
        return $value;
    }

    public function pop()
    {
        $this->ensureListNotEmpty();
        $value  = $this->last->getValue();
        if ($this->count() == 1) {
            $this->first = $this->last = null;
        } else {
            $this->last->prev()->clearNext();
            $this->last = $this->last->prev();
        }
        $this->decrement();
        return $value;
    }

    public function shift()
    {
        $this->ensureListNotEmpty();
        $value =  $this->first->getValue();
        if ($this->count() == 1) {
            $this->first = $this->last = null;
        } else {
            $this->first = $this->first->next();
        }
        $this->decrement();
        return $value;
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

    protected function ensureIndexIsInRange($index)
    {
        if ($index > $this->count()) {
            throw new \OutOfBoundsException('given index is out of range of list');
        }
    }

    protected function ensureIndexIsInRangeForRemove($index)
    {
        if ($index >= $this->count()) {
            throw new \OutOfBoundsException('given index is out of range of list');
        }
    }

    protected function ensureListNotEmpty()
    {
        if ($this->first === null) {
            throw new \OutOfBoundsException('try to perform action on an empty list');
        }
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
