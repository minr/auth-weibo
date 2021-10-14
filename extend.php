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

return [
    new AddFofComponents(),

    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__ . '/less/forum.less'),

    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js'),

    (new Extend\Routes('forum'))
        ->get('/auth/weibo', 'auth.weibo', Minr\Auth\Weibo\WeiboAuthController::class),

    (new Extend\Locales(__DIR__ . '/locale')),
];