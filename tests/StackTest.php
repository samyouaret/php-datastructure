<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use DataStructure\LinkedList\DoublyLinkedList;
use DataStructure\Stack;

class StackTest extends TestCase
{

    protected function setUp(): void
    {
        $this->stack = new Stack();
        $this->stack->push(5);
        $this->stack->push(10);
    }

    /** @test */
    public function stack_is_instance_of_doubly_linked_list()
    {
        $this->assertInstanceOf(DoublyLinkedList::class, $this->stack);
    }

    /** @test */
    public function stack_adding_items_with_lifo_mode()
    {
        $this->assertSame(10, $this->stack->last());
    }

    /** @test */
    public function stack_remove_items_with_lifo_mode()
    {
        $this->assertSame(10, $this->stack->pop());
    }
}
