<?php
/***
***  create by Amarjit Singh **
***/
function pr($data,$exit = false){
    echo '<pre>';
    print_r($data);
    if($exit)
        die;
}