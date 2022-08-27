<?php

use App\Models\Groups;

function uppercase($value, $message, $fail)
{
    if ($value  !== mb_strtoupper($value, 'UTF-8')) {
        $fail($message);
    }
}

function getAllGroups()
{
    $group = new Groups();
    return $group->getAll();
}