<?php

namespace DataStructure\Abstracts;

interface AbstractQueue
{
    public function __construct($value);
    public function enqueue($value);
    public function dequeue();
    public function peek();
}
