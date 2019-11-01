<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use DataStructure\Abstracts\AbstractNode;
use DataStructure\LinkedList\Node;

class NodeTest extends TestCase
{

    protected function setUp(): void
    {
        $this->node = new Node();
    }

    /** @test */
    public function node_implements_abstract_node_interface()
    {
        $node = new Node(5);
        $this->assertInstanceOf(AbstractNode::class, $node);
    }

    /** @test */
    public function get_value_method()
    {
        $node = new Node(5);
        $this->assertSame(5, $node->getValue());
    }

    /** @test */
    public function set_value_method()
    {
        $this->node->setValue(5);
        $this->assertSame(5, $this->node->getValue());
    }

    /** @test */
    public function instantiate_node_with_empty_constructor()
    {
        $this->assertSame(null, $this->node->getValue());
    }

    /** @test */
    public function has_next_method()
    {
        $this->assertFalse($this->node->hasNext());
    }

    /** @test */
    public function set_next_method()
    {
        $this->node->setNext(new Node);
        $this->assertTrue($this->node->hasNext());
    }

    /** @test */
    public function clear_next_method()
    {
        $this->node->setNext(new Node);
        $this->node->clearNext(new Node);
        $this->assertFalse($this->node->hasNext());
    }

    /** @test */
    public function next_method()
    {
        $next  = new Node;
        $this->node->setNext($next);
        $this->assertSame($this->node->next(), $next);
    }

    /** @test */
    public function node_is_empty_when_value_is_not_set()
    {
        $this->assertTrue($this->node->empty());
    }

    /** @test */
    public function node_is_not_empty_when_value_is_set()
    {
        $this->node->setValue(5);
        $this->assertFalse($this->node->empty());
    }
}
