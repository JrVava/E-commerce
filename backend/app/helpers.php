<?php
use Illuminate\Support\Str;

    if(!function_exists('uuid')){
        function uuid(){
            $uuid = Str::uuid();
            return $uuid;
        }
    }
?>