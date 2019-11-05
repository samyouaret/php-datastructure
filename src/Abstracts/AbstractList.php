<?php

namespace DataStructure\Abstracts;

interface AbstractList
{
    public function __construct($value);
    public function empty(): bool;
    public function push($item);
    public function first();
    public function last();
    public function add(int $index, $item);
    public function get(int $index);
    public function remove(int $index);
    public function pop();
    public function removeItem($item);
    public function search($item);
    public function clear();
}
