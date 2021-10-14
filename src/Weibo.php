<?php
/*
 * This file is part of minr/flarum-ext-auth-weibo.
 *
 * Copyright (c) 2021 Minr.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Minr\Auth\Weibo;

use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Token\AccessTokenInterface;
use League\OAuth2\Client\Tool\BearerAuthorizationTrait;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Weibo extends AbstractProvider{
    use BearerAuthorizationTrait;

    /**
     * @var
     */
    public $openid;

    /**
     * @var string
     */
    public $domain = "https://api.weibo.com";

    /**
     * Get authorization url to begin OAuth flow
     *
     * @return string
     */
    public function getBaseAuthorizationUrl (): string {
        return $this->domain . '/oauth2/authorize';
    }

    /**
     * Get access token url to retrieve token
     * @param array $params
     * @return string
     */
    public function getBaseAccessTokenUrl (array $params): string {
        return $this->domain . '/oauth2/access_token';
    }

    /**
     * Get provider url to fetch user details
     *
     * @param AccessToken $token
     * @return void
     */
    public function getResourceOwnerDetailsUrl(AccessToken $token) {}


    /**
     * Get openid url to fetch it
     * @param AccessToken $token
     * @return string
     */
    protected function getOpenidUrl(AccessToken $token): string {
        $uid = $token->getValues()['uid'] ?? 0;
        return $this->domain . '/2/users/show.json?access_token=' . $token . '&uid='. $uid;
    }


    /**
     * Get openid
     *
     * @param AccessToken $token
     * @return mixed
     * @throws IdentityProviderException
     */
    public function fetchOpenid(AccessToken $token) {
        $url     = $this->getOpenidUrl($token);
        $request = $this->getAuthenticatedRequest(self::METHOD_GET, $url, $token);
        return $this->getSpecificResponse($request);
    }


    /**
     * get accesstoken
     *
     * The Content-type of server's returning is 'text/html;charset=utf-8'
     * so it has to be rewritten
     *
     * @param mixed $grant
     * @param array $options
     * @return AccessTokenInterface
     * @throws IdentityProviderException
     */
    public function getAccessToken($grant, array $options = []): AccessTokenInterface {
        $grant = $this->verifyGrant($grant);
        $params = [
            'client_id'     => $this->clientId,
            'client_secret' => $this->clientSecret,
            'redirect_uri'  => $this->redirectUri,
        ];
        $params   = $grant->prepareRequestParameters($params, $options);
        $request  = $this->getAccessTokenRequest($params);
        $response = $this->getParsedResponse($request);
        if(is_null($response)){
            throw new \UnexpectedValueException(
                'Invalid response received from Authorization Server. Expected JSON.'
            );
        }
        $prepared = $this->prepareAccessTokenResponse($response);
        return $this->createAccessToken($prepared, $grant);
    }


    /**
     * @param RequestInterface $request
     * @return mixed
     * @throws IdentityProviderException
     */
    protected function getSpecificResponse(RequestInterface $request) {
        $response = $this->getResponse($request);
        $parsed   = $this->parseSpecificResponse($response);
        $this->checkResponse($response, $parsed);
        return $parsed;
    }


    /**
     * A specific parseResponse function
     * @param ResponseInterface $response
     * @return mixed
     */
    protected function parseSpecificResponse(ResponseInterface $response) {
        $content = (string)$response->getBody();
        return json_decode($content, true);
    }


    /**
     * Check a provider response for errors.
     *
     * @throws IdentityProviderException
     * @param  ResponseInterface $response
     * @param  void $data Parsed response data
     * @return void
     */
    protected function checkResponse(ResponseInterface $response, $data) {
        if(isset($data['error'])) {
            throw new IdentityProviderException($data['error_description'], $response->getStatusCode(), $response);
        }
    }
    /**
     * Get the default scopes used by this provider.
     *
     * This should not be a complete list of all scopes, but the minimum
     * required for the provider user interface!
     *
     * @return array
     */
    protected function getDefaultScopes(): array {
        return [];
    }
    /**
     * Generate a user object from a successful user details request.
     * @param array $response
     * @param AccessToken $token
     * @return WeiboResourceOwner
     */
    protected function createResourceOwner(array $response, AccessToken $token): WeiboResourceOwner {
        return new WeiboResourceOwner($response);
    }
}
