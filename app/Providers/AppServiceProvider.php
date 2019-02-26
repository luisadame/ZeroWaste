<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Laravel\Telescope\TelescopeServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('flang', function ($expression) {
            [$message, $ucfirst] = explode(',', $expression);

            return $ucfirst ? "<?php echo ucfirst(__($message)); ?>" : "<?php echo __($message); ?>";
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal() && !$this->app->runningUnitTests()) {
            $this->app->register(TelescopeServiceProvider::class);
        }
    }
}
