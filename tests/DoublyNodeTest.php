<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use DataStructure\LinkedList\Node;
use DataStructure\LinkedList\DoublyNode;

class DoublyNodeTest extends TestCase
{

    protected function setUp(): void
    {
        $this->node = new DoublyNode();
    }

    /** @test */
    public function node_is_a_node_instance()
    {
        $node = new DoublyNode(5);
        $this->assertInstanceOf(Node::class, $node);
    }

    /** @test */
    public function has_prev_method()
    {
        $this->assertFalse($this->node->hasPrev());
    }

    /** @test */
    public function set_prev_method()
    {
        $this->node->setPrev(new DoublyNode);
        $this->assertTrue($this->node->hasPrev());
    }

    /** @test */
    public function clear_prev_method()
    {
        $this->node->setPrev(new DoublyNode);
        $this->node->clearPrev(new DoublyNode);
        $this->assertFalse($this->node->hasPrev());
    }

    /** @test */
    public function prev_method()
    {
        $prev  = new DoublyNode;
        $this->node->setPrev($prev);
        $this->assertSame($this->node->prev(), $prev);
    }
}
