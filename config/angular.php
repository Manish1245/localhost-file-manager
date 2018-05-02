<?php

return [
    "apps" => [
            [
            "name" => "file-manager",
            "dependencies" => [
                "ngMaterial",
                "ngRouteTitle",
                "ngCrud",
                "ui.router",
                "ui.ace"
            ],
            "site" => [
                "route" => "/"
            ],
            "services" => [
                "controller" => \App\Http\Controllers\Webservice::class,
                "url" => env("APP_URL") . "/services/file-manager"
            ],
            "assets" => [
                "url" => env("APP_URL") . "/assets/file-manager"
            ],
            "templates" => [
                "url" => env("APP_URL") . "/templates/file-manager"
            ],
            "bower" => [
                "components" => [
                    "jquery",
                    "angular",
                    "angular-material",
                    "angular-ui-router",
                    "angular-ui-ace",
                    "angular-crud",
                    "ng-route-title",
                    "bootstrap",
                    "font-awesome",
                    "animate.css"
                ]
            ]
        ]
    ]
];
