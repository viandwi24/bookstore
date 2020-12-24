<?php

namespace Viandwi24\LaravelExtension\Extension;

class BridgeServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected $provider;

    public function __construct($app, $provider)
    {
        parent::__construct($app);
        $this->provider = $provider;
    }

    /**
     * run register method in extension service provider
     *
     * @return mixed
     */
    public function register()
    {
        return app()->make($this->provider)->register();
    }

    /**
     * run register method in extension service provider
     *
     * @return mixed
     */
    public function boot()
    {
        return app()->make($this->provider)->boot();
    }
}