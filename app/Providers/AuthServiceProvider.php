<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Book;
use App\Policies\BookPolicy; // Add this line

class AuthServiceProvider extends ServiceProvider
{
    // ...existing code...

    protected $policies = [
        Book::class => BookPolicy::class, // Add this line
    ];

    public function boot()
    {
        $this->registerPolicies();

        // ...existing code...
    }
}
