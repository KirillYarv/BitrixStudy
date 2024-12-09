<?php
use Bitrix\Main\Routing\RoutingConfigurator;

return function (RoutingConfigurator $routes) {
    $routes->prefix("a_")->name('a_')->group(
        function (RoutingConfigurator $routes)
        {
            $routes->name('countries_num')->get('countries', function () {
                return "123";
            });
            $routes->name('rew_num')->get('rew', function () {
                return "rew123";
            });
        });

    $routes->name('news_by_id')->get("/news/{newsId}/", function ($newsId) {
        return "{newsId}";
    });
};  