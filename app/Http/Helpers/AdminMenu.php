<?php

namespace App\Http\Helpers;

class AdminMenu {
    public function GetMenu(string $lang):array {
        return [
            [
                "code" => 'page_admin_dashboard',
                "link" => "/{$lang}/panel",
                "icon" => "ChartPie"
            ],
            [
                "code" => 'page_admin_bookings',
                "link" => "/{$lang}/panel/bookings",
                "icon" => 'CalendarDays'
            ],
            [
                "code" => 'page_admin_users',
                "link" => "/{$lang}/panel/users",
                "icon" => "Users"
            ],
            // [
            //     "code" => 'page_admin_products',
            //     "link" => "/{$lang}/panel/products",
            //     "icon" => "Box"
            // ],
            // [
            //     "code" => 'page_admin_customers',
            //     "link" => "",
            //     "icon" => "PersonStanding",
            //     "items" => [
            //         [
            //             "code" => 'page_admin_customers',
            //             "link" => "/{$lang}/panel/customers",
            //             "icon" => "PersonStanding"
            //         ]
            //     ]
            // ]
            [
                "code" => 'page_admin_customers',
                "link" => "/{$lang}/panel/customers",
                "icon" => "PersonStanding"
            ]
        ];
    }
}