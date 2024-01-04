<?php

// Function to map user role to string representation
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

// Function to map vehicle type to string representation
if (!function_exists('mapVehicleTypeToString')) {
    function mapVehicleTypeToString($type) {
        $typeMapping = [
            1 => 'Moped',
            2 => 'Van',
            3 => 'Truck',
        ];

        return $typeMapping[$type] ?? 'Unknown Vehicle Type';
    }
}

// Function to map vehicle status to string representation
if (!function_exists('mapVehicleStatusToString')) {
    function mapVehicleStatusToString($status) {
        $statusMapping = [
            0 => 'Out Of Order',
            1 => 'Operational',
        ];

        return $statusMapping[$status] ?? 'Unknown Status';
    }
}

// Function to get tariff ID by parcel size
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

// Function to map parcel size to string representation
if (!function_exists('mapParcelSizeToValue')) {
    function mapParcelSizeToValue($size)
    {
        $sizeMapping = [
            's' => 'Small',
            'm' => 'Medium',
            'l' => 'Large',
            'xl' => 'Extra Large',
        ];

        return $sizeMapping[$size] ?? 'Unknown Size';
    }
}

// Function to map parcel status to string representation
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

    // Function to calculate the total cost of a parcel
    if (!function_exists('calculateTotal')) {
        function calculateTotal($parcel)
        {
            // Check if $parcel is not null and is an object
            if ($parcel && is_object($parcel)) {
                $tariffPrice = optional($parcel->tariff)->price ?? 0;
                $weightMultiplier = round($parcel->weight * 0.1, 2);
                return $tariffPrice + $weightMultiplier;
            }
            // Default value if $parcel is not defined or doesn't have the expected structure
            return 0;
        }
    }
}
