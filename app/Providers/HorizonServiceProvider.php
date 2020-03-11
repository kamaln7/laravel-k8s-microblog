<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Laravel\Horizon\Horizon;
use Laravel\Horizon\HorizonApplicationServiceProvider;

class HorizonServiceProvider extends HorizonApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        // Horizon::routeSmsNotificationsTo('15556667777');
        // Horizon::routeMailNotificationsTo('example@example.com');
        // Horizon::routeSlackNotificationsTo('slack-webhook-url', '#channel');

        // Horizon::night();
    }

    /**
     * Register the Horizon gate.
     *
     * This gate determines who can access Horizon in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewHorizon', function ($user = null) {
            // HTTP Basic auth for Horizon
            $horizon_key = env('HORIZON_KEY');
            if (!$horizon_key) {
                return false;
            }

            $username = $_SERVER['PHP_AUTH_USER'] ?? '';
            $password = $_SERVER['PHP_AUTH_PW'] ?? '';

            if (
                $username == ''
                || $password == ''
                || $username != $horizon_key
                || $password != $horizon_key
                ) {
                header('WWW-Authenticate: Basic realm="Protected Area"');
                header('HTTP/1.0 401 Unauthorized');
                
                exit;
            }

            return true;
        });
    }
}
