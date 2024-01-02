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
    function mapVehicleTypeToString($type) {
        $roleMapping = [
            1 => 'Moped',
            2 => 'Van',
            3 => 'Truck',
        ];

        return $roleMapping[$type] ?? 'Unknown Vehicle Type';
    }
}

if (!function_exists('mapVehicleStatusToString')) {
    function mapVehicleStatusToString($status) {
        $roleMapping = [
            0 => 'Out Of Order',
            1 => 'Operational',
        ];

        return $roleMapping[$status] ?? 'Unknown Status';
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

if (!function_exists('mapParcelSizeToValue')) {
    function mapParcelSizeToValue($status)
    {
        $statusMapping = [
            's' => 'Small',
            'm' => 'Medium',
            'l' => 'Large',
            'xl' => 'Extra Large',
        ];

        return $statusMapping[$status] ?? 'Unknown Size';
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
            5 => 'On Hold',
        ];

        return $statusMapping[$status] ?? 'Unknown Status';
    }

    if (!function_exists('calculateTotal')) {
        function calculateTotal($parcel)
        {
            $tariffPrice = optional($parcel->tariff)->price ?? 0;
            $weightMultiplier = round($parcel->weight * 0.1, 2);

            return $tariffPrice + $weightMultiplier;
        }
    }
}
