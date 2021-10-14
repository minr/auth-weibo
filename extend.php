<?php
/*
 * This file is part of minr/flarum-ext-auth-weibo.
 *
 * Copyright (c) 2021 Minr.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use Flarum\Api\Serializer\UserSerializer;
use Flarum\Extend;
use FoF\Components\Extend\AddFofComponents;
use Minr\Auth\Weibo\Api\BindController;
use Minr\Auth\Weibo\Api\UnBindController;
use Minr\Auth\Weibo\AuthController;

return [
    new AddFofComponents(),

    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__ . '/less/forum.less'),

    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js'),

    (new Extend\Routes('forum'))
        ->get('/auth/weibo', 'auth.weibo', AuthController::class),

    (new Extend\Routes('api'))
        ->get('/auth/weibo/bind', 'auth.weibo.api.bind', BindController::class)
        ->post('/auth/weibo/unbind', 'auth.weibo.api.unbind', UnBindController::class),

    (new Extend\Locales(__DIR__ . '/locale')),

    (new Extend\ApiSerializer(UserSerializer::class))
        ->attributes(function($serializer, $user, $attributes){
            $loginProviders = $user->loginProviders();

            $steamProvider = $loginProviders->where('provider', 'weibo')->first();

            $attributes['WeiboAuth'] = [
                'isLinked' => $steamProvider !== null,
                'identifier' => null, // Hidden, don't expose this information
                'providersCount' => $loginProviders->count()
            ];

            return $attributes;
        }),
];