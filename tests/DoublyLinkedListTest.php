<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

use DataStructure\LinkedList\DoublyLinkedList;

class DoublyLinkedListTest extends TestCase
{
    /** @test */
    public function linked_list_is_instance_of_countable()
    {
        $list = new DoublyLinkedList();
        $this->assertInstanceOf(\Countable::class, $list);
    }

    /** @test */
    public function linked_list_is_instance_of_abstract_list()
    {
        $list = new DoublyLinkedList();
        $this->assertInstanceOf(\DataStructure\Abstracts\AbstractList::class, $list);
    }

    /** @test */
    public function linked_list_is_empty()
    {
        $list = new DoublyLinkedList();
        $this->assertCount(0, $list);
        $this->assertSame(0, $list->count());
        $this->assertTrue($list->empty());
    }

    /** @test */
    public function construct_linked_list_with_intial_value()
    {
        $list = new DoublyLinkedList(15);
        $this->assertCount(1, $list);
    }

    /** @test */
    public function push_method()
    {
        $list = new DoublyLinkedList();
        $list->push(5);
        $list->push(10);
        $list->push(15);
        $this->assertCount(3, $list);
        $this->assertSame(15, $list->last());
    }

    /** @test */
    public function get_node_at_given_index()
    {
        $list = new DoublyLinkedList();
        $list->push(5);
        $list->push(10);
        $list->push(15);
        $list->push(17);
        $this->assertSame(5, $list->getNode(0)->getValue());
        $this->assertSame(10, $list->getNode(1)->getValue());
        $this->assertSame(15, $list->getNode(2)->getValue());
    }

    /** @test */
    public function get_node_at_raise_exception_when_index_is_out_of_range()
    {
        $list = new DoublyLinkedList();
        $list->push(5);
        $list->push(15);
        $this->expectException(\OutOfBoundsException::class);
        $list->getNode(4)->getValue();
    }

    /** @test */
    public function unshift_method()
    {
        $list = new DoublyLinkedList();
        $list->unshift(5);
        $list->unshift(10);
        $list->unshift(15);
        $this->assertCount(3, $list);
        $this->assertSame(15, $list->first());
    }

    /** @test */
    public function first_method()
    {
        $list = new DoublyLinkedList();
        $list->push(5);
        $list->push(10);
        $this->assertSame(5, $list->first());
    }

    /** @test */
    public function first_method_raise_exception_when_list_is_empty()
    {
        $list = new DoublyLinkedList();
        $this->expectException(\OutOfBoundsException::class);
        $list->first();
    }

    /** @test */
    public function last_method()
    {
        $list = new DoublyLinkedList();
        $list->push(5);
        $list->push(10);
        $this->assertSame(10, $list->last());
    }

    /** @test */
    public function last_method_raise_exception_when_list_is_empty()
    {
        $list = new DoublyLinkedList();
        $this->expectException(\OutOfBoundsException::class);
        $list->last();
    }

    /** @test */
    public function list_can_add_item_at_given_index()
    {
        $list = new DoublyLinkedList();
        $list->add(0, 5);
        $list->add(1, 10);
        $list->add(2, 15);
        $list->add(2, 13);
        $this->assertCount(4, $list);
        $this->assertSame(5, $list->first());
        $this->assertSame(15, $list->last());
    }

    /** @test */
    public function list_can_add_item_at_last()
    {
        $list = new DoublyLinkedList();
        $list->add(0, 5);
        $list->add(1, 10);
        $list->add(2, 15);
        $this->assertCount(3, $list);
        $this->assertSame(15, $list->last());
    }

    /** @test */
    public function list_can_add_item_at_first_uses_unshift_method()
    {
        $list = new DoublyLinkedList();
        $list->add(0, 5);
        $list->add(1, 10);
        $list->unshift(15);
        $this->assertCount(3, $list);
        $this->assertSame(15, $list->first());
    }

    /** @test */
    public function get_item_at_given_index_raise_exception_when_list_is_empty()
    {
        $list = new DoublyLinkedList();
        $this->expectException(\OutOfBoundsException::class);
        $list->get(0);
    }

    /** @test */
    public function get_item_at_given_index()
    {
        $list = new DoublyLinkedList();
        $list->add(0, 5);
        $list->add(1, 10);
        $list->add(2, 15);
        $list->add(3, 20);
        $this->assertSame(5, $list->get(0));
        $this->assertSame(15, $list->get(2));
        $this->assertSame(20, $list->get(3));
    }

    /** @test */
    public function list_can_remove_last_item_with_pop_method()
    {
        $list = new DoublyLinkedList();
        $list->push(5);
        $list->push(10);
        // dump($list);
        $list->print();
        $this->assertSame(10, $list->pop());
        $this->assertSame(5, $list->pop());
        $this->assertCount(0, $list);
    }

    /** @test */
    public function list_can_remove_last_item_with_shift_method()
    {
        $list = new DoublyLinkedList();
        $list->push(5);
        $list->push(10);
        $this->assertSame(5, $list->shift());
        $this->assertSame(10, $list->shift());
        $this->assertCount(0, $list);
    }

    /** @test */
    public function remove_method_raise_exception_when_list_is_empty()
    {
        $list = new DoublyLinkedList();
        $this->expectException(\OutOfBoundsException::class);
        $list->remove(0);
    }

    /** @test */
    public function remove_method_raise_exception_when_index_out_of_bound()
    {
        $list = new DoublyLinkedList();
        $list->push(5);
        $list->push(10);
        $this->expectException(\OutOfBoundsException::class);
        $list->remove(3);
    }

    /** @test */
    public function list_can_remove_first_item()
    {
        $list = new DoublyLinkedList();
        $list->push(5);
        $list->push(10);
        $this->assertSame(5, $list->remove(0));
        $this->assertCount(1, $list);
    }

    /** @test */
    public function list_can_remove_single_item()
    {
        $list = new DoublyLinkedList();
        $list->push(5);
        $this->assertSame(5, $list->remove(0));
        $this->assertCount(0, $list);
    }

    /** @test */
    public function list_can_remove_last_item()
    {
        $list = new DoublyLinkedList();
        $list->push(5);
        $list->push(10);
        $this->assertSame(10, $list->remove(1));
        $this->assertCount(1, $list);
    }

    /** @test */
    public function list_can_remove_item_at_given_index()
    {
        $list = new DoublyLinkedList();
        $list->push(5);
        $list->push(10);
        $list->push(15);
        $list->push(20);
        $this->assertSame(10, $list->remove(1));
        $this->assertSame(20, $list->remove(2));
        // dump($list);
        $this->assertSame(15, $list->remove(1));
        $this->assertSame(5, $list->remove(0));
        $this->assertCount(0, $list);
    }

    /** @test */
    public function remove__item_method_raise_exception_when_list_is_empty()
    {
        $list = new DoublyLinkedList();
        $this->expectException(\OutOfBoundsException::class);
        $list->removeItem(15);
    }

    /** @test */
    public function  list_can_remove_given_item__at_first()
    {
        $list = new DoublyLinkedList();
        $list->push(5);
        $this->assertSame(5, $list->removeItem(5));
        $this->assertCount(0, $list);
    }

    /** @test */
    public function list_can_remove_given_item_at_last()
    {
        $list = new DoublyLinkedList();
        $list->push(5);
        $list->push(10);
        $list->push(15);
        $this->assertSame(15, $list->removeItem(15));
        $this->assertCount(2, $list);
    }

    /** @test */
    public function list_can_remove_search_item_and_remove_it()
    {
        $list = new DoublyLinkedList();
        $list->push(5);
        $list->push(10);
        $list->push(15);
        $this->assertSame(10, $list->removeItem(10));
        // print_r($list);
        $this->assertCount(2, $list);
    }

    /** @test */
    public function list_can_be_iterated()
    {
        $list = new DoublyLinkedList();
        $list->push(5);
        $list->push(10);
        $list->push(15);
        $result = [];
        foreach ($list as $key => $value) {
            $result[$key] = $value;
        }
        $this->assertSame([5, 10, 15], $result);
        $this->assertCount(3, $result);
    }

    /** @test */
    public function list_can_be_iterated_in_reverse()
    {
        $list = new DoublyLinkedList();
        $list->push(5);
        $list->push(10);
        $list->push(15);
        $list->setIterationMode(DoublyLinkedList::ITERATE_REVERSE);
        $result = [];
        foreach ($list as $key => $value) {
            $result[$key] = $value;
        }
        $this->assertSame([15, 10, 5], $result);
        $this->assertCount(3, $result);
    }
}
