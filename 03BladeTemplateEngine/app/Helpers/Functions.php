<?php
function uppercase ($value,$message,$fail){
    if ($value  !== mb_strtoupper($value,'UTF-8')) {
            $fail($message);
        }
}

?>
