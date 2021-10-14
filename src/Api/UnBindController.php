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

use Fig\Http\Message\StatusCodeInterface;
use Laminas\Diactoros\Response\EmptyResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class UnBindController implements RequestHandlerInterface {
    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface {
        $actor = $request->getAttribute('actor');
        $actorLoginProviders = $actor->loginProviders()->where('provider', 'weibo')->first();

        if (!$actorLoginProviders) {
            return new EmptyResponse(StatusCodeInterface::STATUS_BAD_REQUEST);
        }

        $actorLoginProviders->delete();

        return new EmptyResponse(StatusCodeInterface::STATUS_OK);
    }
}