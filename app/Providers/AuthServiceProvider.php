<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Policies\OrderPolicy;
use App\Policies\AddressPolicy;
use App\Models\Order;
use App\Models\Address;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Order::class => OrderPolicy::class,
        Address::class => AddressPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
