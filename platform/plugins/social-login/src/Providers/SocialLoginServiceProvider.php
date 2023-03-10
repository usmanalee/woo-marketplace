<?php

namespace Woo\SocialLogin\Providers;

use Woo\Base\Traits\LoadAndPublishDataTrait;
use Woo\SocialLogin\Facades\SocialServiceFacade;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class SocialLoginServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function boot(): void
    {
        $this->setNamespace('plugins/social-login')
            ->loadHelpers()
            ->loadAndPublishConfigurations(['permissions', 'general'])
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadRoutes()
            ->publishAssets();

        Event::listen(RouteMatched::class, function () {
            dashboard_menu()->registerItem([
                'id' => 'cms-plugins-social-login',
                'priority' => 5,
                'parent_id' => 'cms-core-settings',
                'name' => 'plugins/social-login::social-login.menu',
                'icon' => null,
                'url' => route('social-login.settings'),
                'permissions' => ['social-login.settings'],
            ]);
        });

        AliasLoader::getInstance()->alias('SocialService', SocialServiceFacade::class);

        $this->app->register(HookServiceProvider::class);
    }
}
