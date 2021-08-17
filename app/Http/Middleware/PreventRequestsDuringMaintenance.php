<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance as Middleware;

class PreventRequestsDuringMaintenance extends Middleware
{
    /**
     * The URIs that should be reachable while maintenance mode is enabled.
     *
     * @var array
     */
    protected $except = [
        'up',
        'admin',
        'admin/withdraw',
        'admin/pin/{email}',
        'admin/pin',
        'admin/user',
        'admin/gift/edit/single_card_details/{id}',
        'admin/gift/single_card_details/{id}',
        'admin/gift/card_details/{id}/{name}',
        'admin/gift/details',
    ];
}
