<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Policies\FolderPolicy;
use App\Models\Folder;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Folder::class => FolderPolicy::class,
    ];
    
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
