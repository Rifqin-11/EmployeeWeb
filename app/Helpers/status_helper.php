<?php

if (!function_exists('status')) {
    function status($status)
    {
        switch ($status) {
            case 0:
                return '<span class="px-2 py-1 text-sm rounded-lg bg-yellow-200 text-yellow-700">Pending</span>';
            case 1:
                return '<span class="px-2 py-1 text-sm rounded-lg bg-green-200 text-green-700">Scheduled</span>';
            case 2:
                return '<span class="px-2 py-1 text-sm rounded-lg bg-blue-200 text-blue-700">Done</span>';
            default:
                return '<span class="px-2 py-1 text-sm rounded-lg bg-gray-200 text-gray-700">Unknown</span>';
        }
    }
}
