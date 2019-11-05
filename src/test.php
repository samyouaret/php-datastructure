<?php

namespace DataStructure;

use DataStructure\LinkedList\DoublyLinkedList;

define('ROOT_PATH', dirname(__DIR__));
require_once ROOT_PATH . '/vendor/autoload.php';

$list = new \SplDoublyLinkedList();
dump($list instanceof \ArrayAccess);
