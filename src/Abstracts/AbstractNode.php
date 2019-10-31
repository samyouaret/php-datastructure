<?php

namespace DataStructure\Abstracts;

interface AbstractNode
{
    public function __construct($value);
    public function getValue();
    public function setValue($value);
    public function hasNext(): bool;
    public function setNext(AbstractNode $node);
    public function next(): AbstractNode;
    public function empty(): bool;
}
