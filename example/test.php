<?php

include dirname(__DIR__) . '/vendor/autoload.php';

class TestClass {
    use \Jelibeen\EEZE\DynamicObject;

    public $var2 = 'hey';
}

$t = new TestClass();
$t->test = 'borrito';
var_dump($t->test);

var_dump($t->var = '123');
var_dump($t->var);

var_dump($t->setVar('3333'));
var_dump($t->var);
var_dump($t->getVar());