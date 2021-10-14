<?php
/*
 * This file is part of minr/flarum-ext-auth-weibo.
 *
 * Copyright (c) 2021 Minr.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */
namespace Minr\Auth\Weibo\Api;

use Flarum\Http\UrlGenerator;
use Flarum\Settings\SettingsRepositoryInterface;
use Flarum\User\LoginProvider;
use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\EmptyResponse;

class BindController implements RequestHandlerInterface {
    /**
     * @var LoginProvider
     */
    private $loginProvider;
    /**
     * @var SettingsRepositoryInterface
     */
    private $settings;
    /**
     * @var UrlGenerator
     */
    private $url;

    /**
     * @param LoginProvider $loginProvider
     * @param SettingsRepositoryInterface $settings
     * @param UrlGenerator $url
     */
    public function __construct(LoginProvider $loginProvider, SettingsRepositoryInterface $settings, UrlGenerator $url) {
        $this->loginProvider = $loginProvider;
        $this->settings = $settings;
        $this->url = $url;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface {
        $actor = $request->getAttribute('actor');
        $actorLoginProviders = $actor->loginProviders()->where('provider', 'wechat')->first();

        if (!$actorLoginProviders) {
            return $this->response();
        }

        $redirectUri = $this->url->to('api')->route('auth.weibo.api.bind');

    }

    /**
     * @param string $returnCode
     * @return HtmlResponse
     */
    private function response($returnCode = 'done'): HtmlResponse {
        $content = "<script>window.close();window.opener.app.weibo.showRep('{$returnCode}');</script>";

        return new HtmlResponse($content);
    }

}