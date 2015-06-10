<?php
/**
 * Created by PhpStorm.
 * User: godfreymajwega
 * Date: 6/5/15
 * Time: 11:33 PM
 */
foreach($dump as $key=>$value){
    echo("KEY - $key=>");
    foreach($value as $m=>$v){
        echo("------------ $m=>");
        print_r($v);
        echo("<br>");
    }
    echo("<br>");
}