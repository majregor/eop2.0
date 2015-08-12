<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: GMajwega
 * Date: 7/31/15
 * Time: 10:27 AM
 */
if(!function_exists('objectToArray')){
    function objectToArray($d){
        if(is_object($d)){
            $d = get_object_vars($d);
            foreach($d as &$value){
                if(is_object($value)){
                    $value = get_object_vars($value);
                }
            }
            return $d;
        }else{
            return $d;
        }
    }
}