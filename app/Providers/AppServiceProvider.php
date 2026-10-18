<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator; // <--- Не забудьте імпортувати

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Примусово використовуємо просту/сумісну пагінацію без зламаного Tailwind
        //Paginator::useBootstrapFive();
    }
}
