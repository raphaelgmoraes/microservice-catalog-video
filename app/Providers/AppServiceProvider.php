<?php

namespace App\Providers;

use App\Repositories\Eloquent\CategoryEloquentRepository;
use App\Services\AMQP\AMQPInterface;
use App\Services\AMQP\PhpAmqpService;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CategoryRepositoryInterface::class, CategoryEloquentRepository::class);
        $this->app->bind(AMQPInterface::class, PhpAmqpService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
