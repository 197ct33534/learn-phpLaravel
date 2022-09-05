<?php

use App\Models\Doctors;

function is_active($email)
{
    $count = Doctors::where('email', $email)->where('is_active', 1)->count();
    $result = $count > 0 ?  true :  false;
    return  $result;
}
