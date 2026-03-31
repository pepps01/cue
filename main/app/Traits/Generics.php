<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

trait Generics
{
    // a function that generates a random unique ID
    function generateId()
    {
        $unique_id = (string) Str::uuid();
        $exploded = explode('-', $unique_id);
        $n_unique_id = $exploded[4];
        return $n_unique_id;
    }

    // a function that generates random letters
    function randomLetters($len)
    {
        $str = '';
        $a = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $b = str_split($a);
        for ($i = 1; $i <= $len; $i++) {
            $str .= $b[rand(0, strlen($a) - 1)];
        }
        return $str;
    }


    // a function that generates unique random id with reference to a specific table
    function createUniqueID($table, $column)
    {
        $unique_id = (string) Str::uuid();
        $exploded = explode('-', $unique_id);
        $id = $exploded[4];
        return DB::table($table)->where($column, $id)->first() ? $this->createUniqueID($table, $column) :  $id;
    }


    // a function that generates unique random numbers with reference to a specific table
    function createUniqueRand($table, $column)
    {
        $id = rand(1000000, 9999999);
        return DB::table($table)->where($column, $id)->first() ? $this->createUniqueRand($table, $column) :  $id;
    }

    function uniqueRefCode($table, $name)
    {
        $randomString = Str::random(6);
        $combine = strtoupper($name . '' . $randomString);
        return DB::table($table)->where('ref_code', $combine)->first() ? $this->createUniqueID($table, $name) :  $combine;
    }
}
