<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

use DataStructure\LinkedList\LinkedList;

class LinkedListTest extends TestCase
{
    /** @test */
    public function linked_list_is_instance_of_countable()
    {
        $list = new LinkedList();
        $this->assertInstanceOf(\Countable::class, $list);
    }

    /** @test */
    public function linked_list_is_empty()
    {
        $list = new LinkedList();
        $this->assertCount(0, $list);
        $this->assertSame(0, $list->count());
        $this->assertTrue($list->empty());
    }

    /** @test */
    public function construct_linked_list_with_intial_value()
    {
        $list = new LinkedList(15);
        $this->assertCount(1, $list);
    }
    /** @test */
    public function push_method()
    {
        $list = new LinkedList();
        $list->push(5);
        $list->push(10);
        $list->push(15);
        $this->assertCount(3, $list);
    }

    /** @test */
    public function first_method()
    {
        $list = new LinkedList();
        $list->push(5);
        $list->push(10);
        $this->assertSame(5, $list->first());
    }

    /** @test */
    public function first_method_raise_exception_when_list_is_empty()
    {
        $list = new LinkedList();
        $this->expectException(\OutOfBoundsException::class);
        $list->first();
    }

    /** @test */
    public function last_method()
    {
        $list = new LinkedList();
        $list->push(5);
        $list->push(10);
        $this->assertSame(10, $list->last());
    }
}
