<?php

/*
 * This file is part of fof/clockwork.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\Clockwork\Clockwork;

use Clockwork\Authentication\AuthenticatorInterface;

class FlarumAuthenticator implements AuthenticatorInterface
{
    protected $groupId;

    public function __construct($groupId)
    {
        $this->groupId = $groupId;
    }

    public function attempt(array $credentials)
    {
        return true;
    }

    public function check($request)
    {
        $user = $request->getAttribute('actor');

        return $user != null ? $user->groups->contains($this->groupId) : false;
    }

    public function requires()
    {
        return [];
    }
}
