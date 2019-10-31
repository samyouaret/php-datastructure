<?php

namespace DataStructure\Abstracts;

interface AbstractList
{
    public function push($item);
    public function get($index);
    public function remove($index): bool;
    public function removeItem($item): bool;
    public function pop();
    public function add($index, $item);
    public function first();
    public function last();
}
