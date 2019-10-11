<?php
namespace Flarum\Auth\Weibo;

class Weibo{

    /**
     * @var array
     */
    private $urls = [
        'authorize'         => 'https://api.weibo.com/oauth2/authorize',
        'access_token'      => 'https://api.weibo.com/oauth2/access_token',
        'get_token_info'    => 'https://api.weibo.com/oauth2/get_token_info',
    ];

    public function __construct(array $clientCredentials) {
    }
}
