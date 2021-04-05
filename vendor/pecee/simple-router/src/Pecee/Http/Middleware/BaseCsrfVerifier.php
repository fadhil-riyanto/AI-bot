<?php

namespace Pecee\Http\Middleware;

use Pecee\Http\Middleware\Exceptions\TokenMismatchException;
use Pecee\Http\Request;
use Pecee\Http\Security\CookieTokenProvider;
use Pecee\Http\Security\ITokenProvider;

class BaseCsrfVerifier implements IMiddleware
{
    public const POST_KEY = 'csrf_token';
    public const HEADER_KEY = 'X-CSRF-TOKEN';

    protected $except;
    protected $tokenProvider;

    /**
     * BaseCsrfVerifier constructor.
     */
    public function __construct()
    {
        $this->tokenProvider = new CookieTokenProvider();
    }

    /**
     * Check if the url matches the urls in the except property
     * @param Request $request
     * @return bool
     */
    protected function skip(Request $request): bool
    {
        if ($this->except === null || count($this->except) === 0) {
            return false;
        }

        $max = count($this->except) - 1;

        for ($i = $max; $i >= 0; $i--) {
            $url = $this->except[$i];

            $url = rtrim($url, '/');
            if ($url[strlen($url) - 1] === '*') {
                $url = rtrim($url, '*');
                $skip = $request->getUrl()->contains($url);
            } else {
                $skip = ($url === $request->getUrl()->getOriginalUrl());
            }

            if ($skip === true) {
                return true;
            }
        }

        return false;
    }

    /**
     * Handle request
     *
     * @param Request $request
     * @throws TokenMismatchException
     */
    public function handle(Request $request): void
    {
        if ($this->skip($request) === false && $request->isPostBack() === true) {

            $token = $request->getInputHandler()->value(
                static::POST_KEY,
                $request->getHeader(static::HEADER_KEY),
                Request::$requestTypesPost
            );

            if ($this->tokenProvider->validate((string)$token) === false) {
                throw new TokenMismatchException('Invalid CSRF-token.');
            }

        }

        // Refresh existing token
        $this->tokenProvider->refresh();
    }

    public function getTokenProvider(): ITokenProvider
    {
        return $this->tokenProvider;
    }

    /**
     * Set token provider
     * @param ITokenProvider $provider
     */
    public function setTokenProvider(ITokenProvider $provider): void
    {
        $this->tokenProvider = $provider;
    }

}