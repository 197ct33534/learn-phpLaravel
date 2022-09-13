<?php

function is_Role($dataRole, $moduleName, $roleName = "view")
{
    // check datarole not empty array
    if (!empty($dataRole[$moduleName])) {
        // get module from parameters $moduleName
        $module = $dataRole[$moduleName];
        // check module not empty array
        if (!empty($module) && in_array($roleName, $module)) {
            // loop in module array and check if key same parameter $roleName => return true

            return true;
        }
    }
    return false;
}
