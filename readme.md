PHP data structure package
==========================

This package was not intended to replace the data structure provided by standard PHP library
(**SPL**) , this is package created just for teaching and teaching purposes and contains the
implementation details to basic operations performed by legacy data structure like linked lists providing classes like DoublyLinkedList, Stack and Queue to achieve desired tasks.


Requirements
------------

PHP needs to be a minimum version of PHP 7.1.0.

Installation
------------

at the moment the package is not published at packagist yet, you can clone the package :

.. code-bock:: bash

    $ git clone https://github.com/samyouaret/php-datastructure.git

Usage
------------

``DoublyLinkedList`` provides rich api the perform mostly tasks needed by linked list 
and stacks and queues.
create instance of ``DoublyLinkedList`` and push to it :

.. code-bock:: php

        $this->list = new DoublyLinkedList();
        $this->list->push(5);

``DoublyLinkedList`` implements ``AbstractList`` so you can use all methods listed below :

.. code-bock:: php

    public function __construct($value); // optional initial value
    public function empty(): bool;
    public function push($item); 
    public function first(); //return first item of list
    public function last();  //return last item of list
    public function add(int $index, $item); //add item at given index
    public function get(int $index);  //return item at given index
    public function remove(int $index); //remove and return item at given index
    public function pop();  //remove and return last item
    public function removeItem($item); //search and remove item return it,accepts callback compare     
    public function search($item); //search and item return it,accepts callback compare     
    public function clear(); //clear all items of list
 
``Stack`` is a child of ``DoublyLinkedList` and provide alias to last method as top of list :

.. code-bock:: php

           public function top();//return top of list

``Queue`` is a child of ``DoublyLinkedList`` implements ``AbstractQueue`` so it provides methods listed below just for convention and clarity since are just wrappers of ``doublylinkedList`` methods:

.. code-bock:: php

    public function enqueue($value);
    public function dequeue();
    public function peek();