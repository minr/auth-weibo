<?php

/*
 * This file is part of Flarum.
 *
 * (c) Toby Zerner <toby.zerner@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Flarum\User\User;

return [
    'up' => function () {
        foreach (User::whereNotNull('weibo_id')->cursor() as $user) {
            $user->loginProviders()->create([
                'provider' => 'weibo',
                'identifier' => $user->weibo_id
            ]);
        }
    },
    'down' => function () {
        // do nothing
    }
];
