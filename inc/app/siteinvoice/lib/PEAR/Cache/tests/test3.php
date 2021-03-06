<?php

// Test script of Cache_Lite_Function
// $Id: test3.php,v 1.1 2005/07/02 21:12:30 lux Exp $

require_once('Cache/Lite/Function.php');

$options = array(
    'cacheDir' => '/tmp/',
    'lifeTime' => 10
);

$cache = new Cache_Lite_Function($options);

$data = $cache->call('function_to_bench', 23, 66);
echo($data);

$object = new bench();
$object->test = 666;
$data = $cache->call('object->method_to_bench', 23, 66);
echo($data);

$data = $cache->call('bench::static_method_to_bench', 23, 66);
echo($data);

function function_to_bench($arg1, $arg2) 
{
    echo "This is the output of the function function_to_bench($arg1, $arg2) !<br>";
    return "This is the result of the function function_to_bench($arg1, $arg2) !<br>";
}

class bench
{
    var $test;

    function method_to_bench($arg1, $arg2)
    {
        echo "\$obj->test = $this->test and this is the output of the method \$obj->method_to_bench($arg1, $arg2) !<br>";
        return "\$obj->test = $this->test and this is the result of the method \$obj->method_to_bench($arg1, $arg2) !<br>";        
    }
    
    function static_method_to_bench($arg1, $arg2) {
        echo "This is the output of the function static_method_to_bench($arg1, $arg2) !<br>";
        return "This is the result of the function static_method_to_bench($arg1, $arg2) !<br>";
    }

}

?>