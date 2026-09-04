<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\Auth\UserRepositoryInterface;
use App\Repositories\Auth\UserRepository;
use App\Interfaces\Auth\UserInterface;
use App\Services\Auth\UserService;
use App\Interfaces\TypeAccount\TypeAccountRepositoryInterface;
use App\Repositories\TypeAccount\TypeAccountRepository;
use App\Interfaces\TypeAccount\TypeAccountInterface;
use App\Services\TypeAccount\TypeAccountService;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(UserInterface::class, UserService::class);

        $this->app->bind(TypeAccountRepositoryInterface::class, TypeAccountRepository::class);
        $this->app->bind(TypeAccountInterface::class, TypeAccountService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
