<?php

namespace Modules\Traccar\Providers;

use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Traccar\Events\Handlers\RegisterTraccarSidebar;

class TraccarServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
        $this->app['events']->listen(BuildingSidebar::class, RegisterTraccarSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('tokens', Arr::dot(trans('traccar::tokens')));
            // append translations

        });
    }

    public function boot()
    {
        $this->publishConfig('traccar', 'permissions');

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Traccar\Repositories\TokenRepository',
            function () {
                $repository = new \Modules\Traccar\Repositories\Eloquent\EloquentTokenRepository(new \Modules\Traccar\Entities\Token());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Traccar\Repositories\Cache\CacheTokenDecorator($repository);
            }
        );
// add bindings

    }
}
