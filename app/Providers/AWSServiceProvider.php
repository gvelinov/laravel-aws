<?php

namespace App\Providers;

use App\Http\AWS\S3;
use Aws\S3\S3Client;
use Illuminate\Support\ServiceProvider;
use Aws\Sdk;

class AWSServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Sdk::class, function () {
            return new Sdk(config('aws'));
        });

        $this->app->bind(S3::class, function () {
            return new S3(new S3Client(config('aws')));
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */

}
