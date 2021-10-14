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

use League\OAuth2\Client\Provider\ResourceOwnerInterface;

class WeiboResourceOwner implements ResourceOwnerInterface {
    /**
     * Raw response
     *
     * @var array
     */
    protected $response;
    /**
     * Creates new resource owner.
     *
     * @param array  $response
     */
    public function __construct(array $response = array()) {
        $this->response = $response;
    }
    /**
     * Get resource owner id
     *
     * @return string|null
     */
    public function getId(){
        return;
    }
    /**
     * Return all of the owner details available as an array.
     *
     * @return array
     */
    public function toArray(){
        return $this->response;
    }
}