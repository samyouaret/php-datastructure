<?php

namespace DataStructure\LinkedList;

use DataStructure\Abstracts\AbstractList;

class DoublyLinkedList implements \Countable, AbstractList, \IteratorAggregate
{
    protected $length = 0;
    protected $first;
    protected $last;
    protected $iterationMode = DoublyLinkedListIterator::ITERATE_FORWARD;

    public function __construct($value = null)
    {
        if ($value) {
            $this->insertWhenEmpty($value);
        }
    }

    public function setIterationMode(int $mode)
    {
        DoublyLinkedListIterator::ensureValidIterationMode($mode);
        $this->iterationMode = $mode;
    }

    public function getIterator()
    {
        return new DoublyLinkedListIterator($this);
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

    /**
     * return first element of list.
     *
     * @return mixed
     */
    public function first()
    {
        return $this->firstNode()->getValue();
    }

    public function firstNode()
    {
        $this->ensureListNotEmpty();

        return $this->first;
    }

    /**
     * return last element of list.
     *
     * @return mixed
     */
    public function last()
    {
        return $this->lastNode()->getValue();
    }

    public function lastNode()
    {
        $this->ensureListNotEmpty();

        return $this->last;
    }

    /**
     * add an element to list at given index.
     *
     * @param int   $index
     * @param mixed $value
     */
    public function add(int $index, $value)
    {
        $this->ensureIndexIsInRange($index);
        //insert at last of list or in empty list
        if ($index == $this->count()) {
            return $this->push($value);
        }
        // insert at first of list
        if ($this->isFirstIndex($index)) {
            return $this->unshift($value);
        }
        // insert at other indexes
        $this->insertAt($index, $value);
    }

    public function isFirstIndex(int $index)
    {
        return $index == 0;
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

    /**
     * push an element to the list.
     *
     * @param mixed $value
     */
    public function push($value)
    {
        if ($this->empty()) {
            return $this->insertWhenEmpty($value);
        }
        $this->insertAtLast($value);
    }

    /**
     * add element to first of the list.
     *
     * @param mixed $value
     */
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

    protected function insertWhenEmpty($value)
    {
        $this->first = $this->last = new DoublyNode($value);
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

    /**
     * get an element from list at given index.
     *
     * @param int $index
     *
     * @return mixed
     */
    public function get(int $index)
    {
        return $this->getNode($index)->getValue();
    }

    /**
     * get an node from list at given index.
     *
     * @param int   $index
     * @param mixed $value
     *
     * @return DoublyNode
     */
    public function getNode(int $index): DoublyNode
    {
        $this->ensureListNotEmpty();
        $this->ensureIndexIsInRange($index);
        // target node is the last node
        if ($this->isLastIndex($index)) {
            return $this->last;
        }
        $node = $this->first;
        $i = 0;
        while ($node->hasNext() && $i < $index) {
            $node = $node->next();
            ++$i;
        }

        return $node;
    }

    /**
     * remove an element from list at given index.
     *
     * @param int $index
     *
     * @return mixed
     */
    public function remove(int $index)
    {
        $this->ensureListNotEmpty();
        $this->ensureIndexIsInRangeForRemove($index);
        if ($this->isFirstIndex($index)) {
            return $this->shift();
        }
        if ($this->isLastIndex($index)) {
            return $this->pop();
        }

        return $this->removeAt($index);
    }

    public function isLastIndex(int $index)
    {
        return $index == $this->count() - 1;
    }

    protected function removeAt(int $index)
    {
        $beforeNode = $this->getNode($index - 1);
        $value = $beforeNode->next()->getValue();
        if ($beforeNode->next()->hasNext()) {
            $beforeNode->next()->next()->setPrev($beforeNode);
        }
        $beforeNode->setNext($beforeNode->next()->next());
        $this->decrement();

        return $value;
    }

    /**
     * remove last element from list.
     *
     * @return mixed
     */
    public function pop()
    {
        $this->ensureListNotEmpty();
        $value = $this->last->getValue();
        if ($this->count() == 1) {
            $this->clearHeads();
        } else {
            $this->last->prev()->clearNext();
            $this->last = $this->last->prev();
        }
        $this->decrement();

        return $value;
    }

    /**
     * remove first element from list.
     *
     * @param int $index
     */
    public function shift()
    {
        $this->ensureListNotEmpty();
        $value = $this->first->getValue();
        if ($this->count() == 1) {
            $this->clearHeads();
        } else {
            $this->first = $this->first->next();
            $this->first->clearPrev();
        }
        $this->decrement();

        return $value;
    }

    protected function clearHeads()
    {
        $this->first = $this->last = null;
    }

    /**
     * remove an element from list based on given value of item.
     *
     * @param mixed $item
     *
     * @return mixed
     */
    public function removeItem($item)
    {
        $this->ensureListNotEmpty();
        $compare = $this->getCallback($item);
        //item is at first of list
        if ($compare($this->first->getValue(), $item)) {
            return $this->shift();
        }
        $node = $this->first;
        while ($node->hasNext()) {
            $value = $node->next()->getValue();
            if ($compare($value, $item)) {
                // check wether next of node is not last item in list
                if ($node->next()->hasNext()) {
                    $node->next()->next()->setPrev($node);
                } else {
                    // update last
                    $this->last = $node;
                }
                $node->setNext($node->next()->next());
                $this->decrement();

                return $value;
            }
            $node = $node->next();
        }

        return false;
    }

    /**
     * search an element in list based on given value of item.
     *
     * @param mixed $item
     *
     * @return mixed
     */
    public function search($item)
    {
        $this->ensureListNotEmpty();
        $compare = $this->getCallback($item);
        if (
            $compare($this->first->getValue(), $item) ||
            $compare($this->last->getValue(), $item)
        ) {
            return true;
        }
        foreach ($this as  $value) {
            if ($compare($value, $item)) {
                return true;
            }
        }

        return false;
    }

    public function getCallback($callback)
    {
        return is_callable($callback) ? $callback : self::class . '::compareItem';
    }

    public function compareItem($value, $item)
    {
        return $item === $value;
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
        ++$this->length;
    }

    protected function decrement()
    {
        --$this->length;
    }

    public function map(callable $callback)
    {
        $list  = new DoublyLinkedList();
        $this->each(function ($item) use ($list, $callback) {
            $list->push($callback($item));
        });
        return $list;
    }

    public function filter(callable $callback)
    {
        $list  = new DoublyLinkedList();
        $this->each(function ($item) use ($list, $callback) {
            if ($callback($item)) {
                $list->push($item);
            }
        });
        return $list;
    }

    public function merge(DoublyLinkedList $list)
    {
        $newList = new DoublyLinkedList();
        $closure = function ($item) use ($newList) {
            $newList->push($item);
        };
        $this->each($closure);
        $list->each($closure);
        return $newList;
    }

    public function mergeWith(DoublyLinkedList $list)
    {
        $list->each(function ($item) {
            $this->push($item);
        });
    }

    public function reverse()
    {
        $newList = new DoublyLinkedList();
        $mode = $this->getIterationMode();
        $this->setIterationMode(DoublyLinkedListIterator::ITERATE_REVERSE);
        $this->each(function ($item) use ($newList) {
            $newList->push($item);
        });
        $this->setIterationMode($mode);
        return $newList;
    }

    public function each(callable $callback)
    {
        foreach ($this as $item) {
            $callback($item);
        }
    }

    public function toArray()
    {
        return iterator_to_array($this);
    }
}
