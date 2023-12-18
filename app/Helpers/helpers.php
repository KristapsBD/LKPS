<?php

if (!function_exists('mapUserRoleToString')) {
    function mapUserRoleToString($role) {
        $roleMapping = [
            0 => 'Client',
            1 => 'Admin',
            2 => 'Courier',
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

if (!function_exists('getTariffIdBySize')) {
    function getTariffIdBySize($size)
    {
        // Define a mapping of size to tariff ID
        $sizeToTariffMapping = [
            's' => 1,
            'm' => 2,
            'l' => 3,
            'xl' => 4,
        ];

        return $sizeToTariffMapping[$size] ?? null;
    }
}

if (!function_exists('mapParcelStatusToValue')) {
    function mapParcelStatusToValue($status) {
        $statusMapping = [
            0 => 'Unpaid',
            1 => 'Processing',
            2 => 'In Transit',
            3 => 'Out For Delivery',
            4 => 'Delivered',
        ];

        return $statusMapping[$status] ?? 'Unknown Status';
    }
}
