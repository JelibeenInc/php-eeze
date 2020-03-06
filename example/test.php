<?php

include dirname(__DIR__) . '/vendor/autoload.php';

class TestClass {
    use \Jelibeen\EEZE\DynamicObject;

    public $var = 'hey';
}

$t = new TestClass();
$t->test = 'borrito';
var_dump($t->test);

var_dump($t->var);
var_dump($t->var = '123');
var_dump($t->var);
