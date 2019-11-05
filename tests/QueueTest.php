<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use DataStructure\LinkedList\DoublyLinkedList;
use DataStructure\Queue;

class QueueTest extends TestCase
{
    protected function setUp(): void
    {
        $this->queue = new Queue();
        $this->queue->enqueue(5);
        $this->queue->enqueue(10);
    }

    /** @test */
    public function queue_is_instance_of_doubly_linked_list()
    {
        $this->assertInstanceOf(DoublyLinkedList::class, $this->queue);
    }

    /** @test */
    public function queue_adding_items_with_fifo_mode()
    {
        $this->assertSame(5, $this->queue->peek());
    }

    /** @test */
    public function queue_remove_items_with_fifo_mode()
    {
        $this->assertSame(5, $this->queue->dequeue());
        $this->assertCount(1, $this->queue);
    }
}
