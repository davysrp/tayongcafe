<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Seller;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use League\OAuth1\Client\Server\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        ResetPassword::createUrlUsing(function (Seller $seller, string $token) {
            return route('resetPasswordSendLink',['token'=>$token]);
        });
    }
}
