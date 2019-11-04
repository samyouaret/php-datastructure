<?php

namespace DataStructure\LinkedList;

class DoublyLinkedListIterator implements \Iterator
{
    const ITERATE_FORWARD = 0;
    const ITERATE_REVERSE = 1;
    /**iterator variables */
    protected $iterator_position;
    /**
     * The node that hold the current node for iterator.
     *
     * @var DoublyNode
     */
    protected $current;
    protected $instance;

    public function __construct(DoublyLinkedList $instance)
    {
        $this->instance = $instance;
    }

    public function current()
    {
        return $this->current->getValue();
    }

    public function next()
    {
        ++$this->iterator_position;
        $this->current = $this->instance->getIterationMode() == self::ITERATE_FORWARD
            ? $this->current->next() : $this->current->prev();
    }

    public function key()
    {
        return $this->iterator_position;
    }

    public function valid()
    {
        return $this->iterator_position < $this->instance->count();
    }

    public function rewind()
    {
        $this->iterator_position = 0;
        $this->current = $this->instance->getIterationMode() == self::ITERATE_FORWARD
            ? $this->instance->firstNode() : $this->instance->lastNode();
    }

    public static function ensureValidIterationMode(int $mode)
    {
        if ($mode !== self::ITERATE_FORWARD && $mode !== self::ITERATE_REVERSE) {
            throw new \InvalidArgumentException('invalid iteration mode');
        }
    }
}
