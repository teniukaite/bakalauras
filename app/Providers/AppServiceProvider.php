<?php

namespace App\Providers;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use App\Http\Service\RabbitMQ\RabbitService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Faker\Generator as FakerGenerator;
use Faker\Factory as FakerFactory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(FakerGenerator::class, function () {
            return FakerFactory::create('lt_LT');
        });

        $this->app->singleton(RabbitService::class, function () {
            $connection = new AMQPStreamConnection(getenv('RABBIT_HOST'), getenv('RABBIT_PORT'), getenv('RABBIT_USER'), getenv('RABBIT_PASSWORD'));

            return new RabbitService($connection);
        });


        Paginator::useBootstrap();
    }
}
