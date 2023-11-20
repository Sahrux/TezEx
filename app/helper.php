<?php 
if (!function_exists('has_access_to')) {
    function has_access_to($key)
    {
       $privs = auth()->user()->role->load("privileges")->toArray();
       $priv_arr = $privs["privileges"] ?? [];
       if(!$priv_arr) return false;
       $keys = [];
       foreach($priv_arr as $priv){
        $keys[] = $priv["key"];
       }
    //    dd($keys);
       return in_array($key,$keys);
    }
}