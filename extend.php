<?php
use Minr\Auth\Weibo\WeiboAuthController;
use Flarum\Extend;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__.'/less/forum.less'),
    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js'),
    (new Extend\Routes('forum'))
        ->get('/auth/weibo', 'auth.weibo', WeiboAuthController::class),
    (new Extend\Locales(__DIR__ . '/locale')),
];