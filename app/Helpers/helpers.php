<?php

if (!function_exists('mapUserRoleToString')) {
    function mapUserRoleToString($role) {
        $roleMapping = [
            0 => 'Client',
            1 => 'Admin',
            2 => 'Worker',
            3 => 'Driver',
        ];

        return $roleMapping[$role] ?? 'Unknown Role';
    }
}

if (!function_exists('mapVehicleTypeToString')) {
    function mapVehicleTypeToString($role) {
        $roleMapping = [
            1 => 'Moped',
            2 => 'Van',
            3 => 'Truck',
        ];

        return $roleMapping[$role] ?? 'Unknown Vehicle Type';
    }
}
