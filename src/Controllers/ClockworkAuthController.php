<?php

namespace Reflar\Clockwork\Controllers;

use Illuminate\Support\Arr;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

class ClockworkAuthController implements RequestHandlerInterface
{

    /**
     * Handles a request and produces a response.
     *
     * May call other collaborating code to generate the response.
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $token = app('clockwork')->getAuthenticator()->attempt(
            Arr::only($request->getParsedBody(), [ 'username', 'password' ])
        );

        return new JsonResponse([ 'token' => $token ], $token ? 200 : 403);
    }
}